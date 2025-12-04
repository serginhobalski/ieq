@extends('layouts.app')

@section('title')
    Bíblia Sagrada -ARC
@endsection

@section('content')
    <div class="container-fluid h-100 mt-4">
        <div class="row h-100">

            <!-- COLUNA DE NAVEGAÇÃO (Livros e Capítulos) -->
            <div class="col-md-3 col-lg-2 border-end bg-white" style="height: calc(100vh - 100px); overflow-y: auto;">
                <div class="p-3">
                    <h5 class="fw-bold text-primary mb-3">Livros</h5>
                    <select id="bookSelect" class="form-select mb-3 shadow-sm">
                        <option selected disabled>Escolha um livro...</option>
                        <!-- Preenchido via JS -->
                    </select>

                    <h6 class="fw-bold text-secondary mb-2">Capítulo</h6>
                    <div id="chapterGrid" class="d-flex flex-wrap gap-2">
                        <small class="text-muted">Selecione um livro primeiro.</small>
                    </div>
                </div>
            </div>

            <!-- COLUNA DE LEITURA -->
            <div class="col-md-9 col-lg-10 bg-light" style="height: calc(100vh - 100px); overflow-y: auto;">
                <div class="container py-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-5">

                            <!-- Cabeçalho do Capítulo -->
                            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                                <h2 id="readingTitle" class="fw-bold mb-0">Bíblia Sagrada</h2>
                                <span class="badge bg-primary">Almeida</span>
                            </div>

                            <!-- Área de Loading -->
                            <div id="loadingSpinner" class="text-center py-5 d-none">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Carregando...</span>
                                </div>
                                <p class="mt-2 text-muted">Buscando as escrituras...</p>
                            </div>

                            <!-- Texto Bíblico -->
                            <div id="bibleText" class="bible-text fs-5" style="line-height: 1.8; text-align: justify;">
                                <div class="text-center text-muted py-5">
                                    <i class="bi bi-book display-1 text-secondary opacity-25"></i>
                                    <p class="mt-3">Selecione um livro e capítulo no menu ao lado para começar a leitura.
                                    </p>
                                </div>
                            </div>

                            <!-- Navegação de Rodapé -->
                            <div id="footerNav" class="d-flex justify-content-between mt-5 d-none">
                                <button class="btn btn-outline-secondary" onclick="prevChapter()">
                                    <i class="bi bi-arrow-left"></i> Anterior
                                </button>
                                <button class="btn btn-outline-primary" onclick="nextChapter()">
                                    Próximo <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--<script>
        -- >

        <
        !--
    </script>-->
    <script type="module">
        document.addEventListener('DOMContentLoaded', function() {
            console.log("🚀 [Chat] Iniciando script...");

            // 1. Definições
            const currentUserId = {{ auth()->id() }};
            let currentRoom = 'geral';
            let echoChannel = null;

            const messagesArea = document.getElementById('messagesArea');
            const messageInput = document.getElementById('messageInput');
            const btnSend = document.getElementById('btnSend');
            const roomTitle = document.getElementById('roomTitle');

            // Proteção contra elementos faltantes
            if (!messagesArea || !messageInput || !btnSend) return console.error(
            "Elementos de UI não encontrados.");

            const historyRoute = '{{ route('chat.history') }}';
            const sendRoute = '{{ route('chat.send') }}';

            // 2. Renderização
            function appendMessage(data) {
                const isMy = data.user_id === currentUserId;

                const html = `
                <div class="d-flex mb-3 ${isMy ? 'justify-content-end' : 'justify-content-start'}">
                    ${!isMy ? `<img src="${data.user_avatar}" class="rounded-circle me-2 border" width="35" height="35" style="align-self: flex-end; object-fit: cover;">` : ''}
                    
                    <div class="${isMy ? 'text-end' : ''}" style="max-width: 75%;">
                        <div class="p-2 px-3 rounded-3 ${isMy ? 'bg-primary text-white' : 'bg-white border text-dark shadow-sm'}">
                            ${!isMy ? `<div class="fw-bold small mb-1" style="font-size: 0.8rem;">${data.user_name}</div>` : ''}
                            <div style="word-break: break-word; line-height: 1.4;">${data.content}</div>
                        </div>
                        <small class="text-muted" style="font-size: 0.65rem; margin-top: 2px; display: block;">${data.created_at}</small>
                    </div>
                </div>
            `;

                messagesArea.insertAdjacentHTML('beforeend', html);
                scrollToBottom();
            }

            function scrollToBottom() {
                messagesArea.scrollTop = messagesArea.scrollHeight;
            }

            function clearMessages() {
                messagesArea.innerHTML = '';
            }

            // 3. Salas
            window.switchRoom = function(roomKey, title) {
                if (currentRoom === roomKey && echoChannel) return;

                document.querySelectorAll('.chat-contact').forEach(el => el.classList.remove('active',
                    'bg-light'));
                const btn = document.getElementById(`btn-${roomKey}`);
                if (btn) btn.classList.add('active', 'bg-light');

                if (roomTitle) roomTitle.innerText = title;

                clearMessages();
                if (echoChannel && window.Echo) window.Echo.leave(`chat.${currentRoom}`);

                currentRoom = roomKey;
                messagesArea.innerHTML =
                    '<div class="text-center p-3 text-muted"><div class="spinner-border spinner-border-sm"></div> Carregando...</div>';

                // Reinicia verificação de conexão
                waitForAxios(fetchMessagesAndConnect);
            };

            // 4. Lógica de Rede (CORRIGIDA)
            function waitForAxios(callback, attempts = 0) {
                if (window.axios && window.Echo) {
                    console.log("✅ [Chat] Bibliotecas prontas.");
                    // Habilita o botão apenas quando pronto
                    btnSend.disabled = false;
                    messageInput.disabled = false;
                    callback();
                } else {
                    if (attempts > 30) { // 15 segundos
                        console.error("❌ [Chat] Falha: Axios não carregou.");
                        messagesArea.innerHTML =
                            '<div class="alert alert-danger m-3">Erro: Bibliotecas não carregadas. Verifique o console.</div>';
                        return;
                    }
                    if (attempts === 0) {
                        console.log("⏳ [Chat] Aguardando carregamento...");
                        // Desabilita para evitar clique antes da hora
                        btnSend.disabled = true;
                        messageInput.disabled = true;
                    }
                    setTimeout(() => waitForAxios(callback, attempts + 1), 500);
                }
            }

            function fetchMessagesAndConnect() {
                window.axios.get(historyRoute, {
                        params: {
                            room: currentRoom
                        }
                    })
                    .then(res => {
                        clearMessages();
                        if (res.data.length === 0) {
                            messagesArea.innerHTML =
                                '<div class="text-center p-4 text-muted small">Nenhuma mensagem aqui ainda.</div>';
                        } else {
                            res.data.forEach(msg => appendMessage(msg));
                        }

                        echoChannel = window.Echo.channel(`chat.${currentRoom}`)
                            .listen('MessageSent', (e) => {
                                if (messagesArea.innerText.includes('Nenhuma mensagem')) clearMessages();
                                appendMessage(e);
                            });
                    })
                    .catch(err => {
                        console.error("Erro histórico:", err);
                        messagesArea.innerHTML =
                            '<div class="text-center text-danger p-3">Falha de conexão.</div>';
                    });
            }

            function sendMessage() {
                // PROTEÇÃO EXTRA AQUI
                if (!window.axios) {
                    alert("Erro: O sistema ainda está carregando. Aguarde um momento.");
                    return;
                }

                const txt = messageInput.value.trim();
                if (!txt) return;

                messageInput.value = '';
                messageInput.focus();

                window.axios.post(sendRoute, {
                        content: txt,
                        room: currentRoom
                    })
                    .catch(err => {
                        console.error("Erro envio:", err);
                        messageInput.value = txt;
                        alert('Não foi possível enviar.');
                    });
            }

            // 5. Inicialização
            if (btnSend) btnSend.onclick = (e) => {
                e.preventDefault();
                sendMessage();
            };
            if (messageInput) messageInput.onkeypress = (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    sendMessage();
                }
            };

            // Inicia
            waitForAxios(fetchMessagesAndConnect);
        });
    </script>

    <style>
        /* CSS HARDCODED PARA GARANTIR VISIBILIDADE */
        .card-chat {
            height: calc(100vh - 120px) !important;
            min-height: 500px;
            display: flex;
            flex-direction: column;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: white;
        }

        .card-body {
            flex: 1;
            overflow: hidden;
            /* Impede scroll duplo */
        }

        /* Sidebar */
        .chat-sidebar {
            width: 280px;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #eee;
            background: #fff;
        }

        /* Área Principal */
        .chat-main {
            display: flex;
            flex-direction: column;
            flex: 1;
            /* Ocupa o resto da largura */
            min-width: 0;
            /* Corrige bug flexbox */
            background: #f5f7fa;
        }

        .chat-body {
            flex: 1;
            /* Ocupa altura disponível */
            overflow-y: auto;
            /* Scroll apenas aqui */
            padding: 1rem;
        }

        .chat-footer {
            flex-shrink: 0;
            /* Não encolhe */
            background: white;
            padding: 1rem;
            border-top: 1px solid #eee;
        }

        /* Utilitários */
        .hover-bg-light:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }

        .active {
            background-color: #eef2f7 !important;
            border-left: 3px solid #0d6efd;
        }

        /* Mobile */
        @media (max-width: 768px) {
            .chat-sidebar {
                width: 70px;
            }

            .flex-1,
            .chat-sidebar-header {
                display: none !important;
            }

            .avatar {
                margin: 0 auto;
            }
        }
    </style>
@endsection
