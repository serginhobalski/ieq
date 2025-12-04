@extends('layouts.app')

@section('title')
    Chat
@endsection

@section('content')
    <div class="card card-chat">
        <div class="card-body d-flex p-0 h-100">

            {{-- 1. SIDEBAR (Esquerda) --}}
            <div class="chat-sidebar border-end" style="background: #222222;">
                <div class="chat-sidebar-header p-3 border-bottom text-center">
                    <h6 class="mb-0 text-primary">Canais & Grupos</h6>
                </div>

                <div class="contacts-list scrollbar-overlay" style="overflow-y: auto; flex: 1;">
                    <div class="nav flex-column">

                        {{-- Botão Geral --}}
                        <div class="chat-contact p-3 border-bottom hover-bg-light cursor-pointer active" id="btn-geral"
                            onclick="switchRoom('geral', 'Chat Geral')">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl me-3">
                                    <span
                                        class="avatar-name rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                        style="width: 40px; height: 40px;">
                                        <i class="fas fa-comments"></i>
                                    </span>
                                </div>
                                <div class="flex-1 d-none d-md-block">
                                    <h6 class="mb-0 text-truncate">Chat Geral</h6>
                                    <small class="text-muted text-truncate d-block">Interação geral</small>
                                </div>
                            </div>
                        </div>

                        {{-- Separador --}}
                        <div class="p-2 text-center text-uppercase fs-11 fw-bold text-primary mt-2" style="background: #222222;">Meus GCs</div>

                        {{-- Loop Grupos --}}
                        @forelse($myGroups as $group)
                            <div class="chat-contact p-3 border-bottom hover-bg-light cursor-pointer"
                                id="btn-group_{{ $group->id }}"
                                onclick="switchRoom('group_{{ $group->id }}', '{{ $group->name }}')">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl me-3">
                                        <span
                                            class="avatar-name rounded-circle bg-success text-white d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <i class="fas fa-users"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1 d-none d-md-block">
                                        <h6 class="mb-0 text-truncate">{{ $group->name }}</h6>
                                        <small class="text-muted text-truncate d-block">Grupo</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-3 text-center small text-muted">
                                Sem grupos.
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

            {{-- 2. ÁREA PRINCIPAL (Direita) --}}
            <div class="chat-main d-flex flex-column flex-1 w-100">

                {{-- A. Cabeçalho --}}
                <div class="chat-header p-3 border-bottom d-flex justify-content-between align-items-center "
                    style="height: 70px;">
                    <div>
                        <h5 class="mb-0 text-primary" id="roomTitle">Chat Geral</h5>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-success rounded-circle me-1" style="width: 8px; height: 8px;"></span>
                            <small class="text-success">Conectado</small>
                        </div>
                    </div>
                </div>

                {{-- B. Corpo de Mensagens (Onde estava o problema) --}}
                {{-- Flex-grow-1 força ocupar todo o espaço disponível, overflow-y permite scroll --}}
                <div class="chat-body p-3 flex-grow-1" id="messagesArea"
                    style="overflow-y: auto; background-color: #333333;">
                    {{-- JS preenche aqui --}}
                </div>

                {{-- C. Editor (Input) --}}
                {{-- Flex-shrink-0 impede que esta área seja esmagada --}}
                <div class="chat-footer p-3 border-top bg-white d-flex align-items-center" style="flex-shrink: 0;">
                    <input type="text" id="messageInput" class="form-control border-0 bg-light me-2"
                        placeholder="Digite sua mensagem..." autocomplete="off" style="box-shadow: none;">

                    <button type="button" id="btnSend" class="btn btn-primary rounded-circle"
                        style="width: 45px; height: 45px;">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script type="module">
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Iniciando Chat Simplificado...");

            const currentUserId = {{ auth()->id() }};
            let currentRoom = 'geral';
            let echoChannel = null;

            const messagesArea = document.getElementById('messagesArea');
            const messageInput = document.getElementById('messageInput');
            const btnSend = document.getElementById('btnSend');
            const roomTitle = document.getElementById('roomTitle');

            const historyRoute = '{{ route('chat.history') }}';
            const sendRoute = '{{ route('chat.send') }}';

            // --- Renderização ---
            function appendMessage(data) {
                const isMy = data.user_id === currentUserId;

                // Usando estrutura simples e robusta
                const html = `
                <div class="d-flex mb-3 ${isMy ? 'justify-content-end' : 'justify-content-start'}">
                    ${!isMy ? `<img src="${data.user_avatar}" class="rounded-circle me-2" width="35" height="35" style="align-self: flex-end;">` : ''}
                    
                    <div class="${isMy ? 'text-end' : ''}" style="max-width: 75%;">
                        <div class="p-2 rounded-3 ${isMy ? 'bg-primary text-white' : 'bg-white border text-dark shadow-sm'}">
                            ${!isMy ? `<div class="fw-bold small mb-1">${data.user_name}</div>` : ''}
                            <div style="word-break: break-word;">${data.content}</div>
                        </div>
                        <small class="text-muted fs-10 mt-1 d-block">${data.created_at}</small>
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

            // --- Salas ---
            window.switchRoom = function(roomKey, title) {
                if (currentRoom === roomKey && echoChannel) return;

                // UI
                document.querySelectorAll('.chat-contact').forEach(el => el.classList.remove('active',
                    'bg-light'));
                const btn = document.getElementById(`btn-${roomKey}`);
                if (btn) btn.classList.add('active', 'bg-light');

                roomTitle.innerText = title;

                // Lógica
                clearMessages();
                if (echoChannel && window.Echo) window.Echo.leave(`chat.${currentRoom}`);

                currentRoom = roomKey;
                loadHistoryAndConnect();
            };

            // --- Rede ---
            function loadHistoryAndConnect() {
                if (!window.axios || !window.Echo) return;

                window.axios.get(historyRoute, {
                        params: {
                            room: currentRoom
                        }
                    })
                    .then(res => {
                        res.data.forEach(msg => appendMessage(msg));

                        echoChannel = window.Echo.channel(`chat.${currentRoom}`)
                            .listen('MessageSent', (e) => appendMessage(e));
                    })
                    .catch(err => console.error(err));
            }

            function sendMessage() {
                const txt = messageInput.value.trim();
                if (!txt) return;

                messageInput.value = '';

                window.axios.post(sendRoute, {
                        content: txt,
                        room: currentRoom
                    })
                    .catch(err => {
                        console.error(err);
                        messageInput.value = txt;
                        alert('Erro ao enviar.');
                    });
            }

            // --- Init ---
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

            setTimeout(loadHistoryAndConnect, 500);
        });
    </script>

    <style>
        /* CSS para forçar layout */
        .card-chat {
            height: calc(100vh - 120px);
            /* Ajuste conforme seu header/footer */
            min-height: 500px;
            display: flex;
            flex-direction: column;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            /* Importante para bordas arredondadas */
        }

        /* Sidebar */
        .chat-sidebar {
            width: 280px;
            display: flex;
            flex-direction: column;
            background: white;
        }

        /* Responsividade Sidebar */
        @media (max-width: 768px) {
            .chat-sidebar {
                width: 70px;
            }

            .flex-1 {
                display: none;
            }

            /* Esconde texto em mobile */
            .chat-sidebar-header {
                display: none;
            }
        }

        /* Utilitários */
        .hover-bg-light:hover {
            background-color: #333333;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .active {
            background-color: #333333 !important;
            border-left: 3px solid #0d6efd;
        }

        .fs-10 {
            font-size: 10px;
        }
    </style>
@endsection
