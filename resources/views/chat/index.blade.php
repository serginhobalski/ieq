@extends('layouts.app')

@section('title')
    Chat
@endsection

@section('content')
    <div class="container-fluid h-100 p-0 mt-4">
        <div class="row g-0 h-100" style="min-height: calc(100vh - 100px);">

            <!-- SIDEBAR (Salas) -->
            <div class="col-md-3 border-end bg-white d-none d-md-block">
                <div class="p-3 border-bottom bg-light">
                    <h5 class="mb-0">Canais</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action active" onclick="switchRoom('geral')">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1"># Chat Geral</h6>
                        </div>
                        <small>Interação de todos os membros</small>
                    </a>
                    <!-- Futuramente você pode listar os GCs aqui -->
                    <a href="#" class="list-group-item list-group-item-action disabled">
                        <h6 class="mb-1"><i class="bi bi-lock"></i> Meu GC (Em breve)</h6>
                    </a>
                </div>
            </div>

            <!-- ÁREA DO CHAT -->
            <div class="col-md-9 d-flex flex-column bg-light">

                <!-- Header -->
                <div class="p-3 border-bottom bg-white d-flex align-items-center shadow-sm" style="height: 60px;">
                    <span class="fs-5 fw-bold text-primary" id="roomTitle"># Chat Geral</span>
                    <span class="ms-2 badge bg-success rounded-pill" id="statusBadge">Online</span>
                </div>

                <!-- Área de Mensagens (Scroll) -->
                <div id="messagesArea" class="flex-grow-1 p-4"
                    style="overflow-y: auto; background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png');">
                    <!-- As mensagens serão inseridas aqui via JS -->
                </div>

                <!-- Área de Input -->
                <div class="p-3 bg-white border-top">
                    <!-- Removemos o ID do form, pois não vamos mais usar o evento 'submit' do form -->
                    <div class="d-flex gap-2">
                        <input type="text" id="messageInput" class="form-control" placeholder="Digite sua mensagem..."
                            autocomplete="off">

                        <!-- MUDANÇA AQUI: type="button" e id="btnSend" -->
                        <button type="button" id="btnSend" class="btn btn-primary px-4">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts do Chat --}}
    <script type="module">
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Iniciando Script do Chat...");

            // 1. Definições Iniciais
            const currentUserId = {{ auth()->id() }};
            const currentRoom = 'geral';

            const messagesArea = document.getElementById('messagesArea');
            const messageInput = document.getElementById('messageInput');
            const btnSend = document.getElementById('btnSend');

            // Verificação de segurança (Debug)
            if (!messageInput || !btnSend) {
                console.error("Erro: Input ou Botão de enviar não foram encontrados no HTML.");
                return;
            }

            // 2. Função para adicionar mensagem visualmente
            function appendMessage(data) {
                const isMyMessage = data.user_id === currentUserId;
                const div = document.createElement('div');

                div.className = `d-flex mb-3 ${isMyMessage ? 'justify-content-end' : 'justify-content-start'}`;

                div.innerHTML = `
                <div class="d-flex ${isMyMessage ? 'flex-row-reverse' : ''} align-items-end" style="max-width: 70%;">
                    <img src="${data.user_avatar}" class="rounded-circle border" width="30" height="30" style="object-fit:cover; margin: 0 8px;">
                    <div class="p-2 rounded shadow-sm position-relative ${isMyMessage ? 'bg-primary text-white' : 'bg-white text-dark'}">
                        ${!isMyMessage ? `<div class="fw-bold small text-secondary mb-1">${data.user_name}</div>` : ''}
                        <div>${data.content}</div>
                        <div class="text-end" style="font-size: 0.7rem; opacity: 0.7; margin-top: 4px;">${data.created_at}</div>
                    </div>
                </div>
            `;

                messagesArea.appendChild(div);
                scrollToBottom();
            }

            function scrollToBottom() {
                if (messagesArea) {
                    messagesArea.scrollTop = messagesArea.scrollHeight;
                }
            }

            // 3. Função de Enviar (Centralizada)
            window.sendMessage = function() {
                const content = messageInput.value.trim();
                if (!content) return;

                // Limpa o input visualmente
                messageInput.value = '';

                // Envia para o servidor
                if (window.axios) {
                    window.axios.post('{{ route('chat.send') }}', {
                        content: content,
                        room: currentRoom
                    }).catch(error => {
                        console.error('Erro no envio:', error);
                        alert('Erro ao enviar mensagem.');
                    });
                } else {
                    console.error("Axios não está carregado.");
                }
            }

            // 4. Event Listeners (Aguardando o DOM estar pronto)

            // Clique no botão
            btnSend.addEventListener('click', function(e) {
                e.preventDefault(); // Previne qualquer comportamento padrão estranho
                console.log("Botão clicado");
                sendMessage();
            });

            // Enter no input
            messageInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault(); // Impede o "submit" de form se houver
                    console.log("Enter pressionado");
                    sendMessage();
                }
            });

            // 5. Carregar Histórico e Conectar no Reverb
            // Usamos setTimeout para garantir que window.Echo e window.axios do Laravel/Vite já carregaram
            setTimeout(() => {
                if (window.axios) {
                    window.axios.get(`{{ route('chat.history') }}?room=${currentRoom}`)
                        .then(response => {
                            response.data.forEach(msg => appendMessage(msg));
                        })
                        .catch(err => console.error("Erro ao carregar histórico:", err));
                }

                if (window.Echo) {
                    window.Echo.channel(`chat.${currentRoom}`)
                        .listen('MessageSent', (e) => {
                            console.log('Nova mensagem via Reverb:', e);
                            appendMessage(e);
                        });
                } else {
                    console.error("Laravel Echo não detectado. Verifique se 'npm run dev' está rodando.");
                }
            }, 500); // Meio segundo de delay para garantir carregamento das libs
        });
    </script>
@endsection
