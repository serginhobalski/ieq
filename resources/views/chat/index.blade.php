@extends('layouts.app')

@section('title')
    Chat
@endsection

@section('content')
    <div class="card card-chat overflow-hidden">
        <div class="card-body d-flex p-0 h-100">
            <div class="chat-sidebar">
                <div class="contacts-list scrollbar-overlay">
                    <div class="nav nav-tabs border-0 flex-column" role="tablist" aria-orientation="vertical">
                        {{-- Botão do Chat Geral --}}
                        <div class="hover-actions-trigger chat-contact nav-item active" role="tab" id="chat-link-0"
                            data-bs-toggle="tab" data-bs-target="#chat-0" aria-controls="chat-0" aria-selected="true">
                            
                            <div class="d-flex p-3">
                                <div class="avatar avatar-xl">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <div class="flex-1 chat-contact-body ms-2 d-md-none d-lg-block">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0 chat-contact-title">Chat Geral</h6>
                                        <span class="message-time fs-11"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Botões dos Grupos --}}
                        <div class="hover-actions-trigger chat-contact nav-item" role="tab" id="chat-link-2"
                            data-bs-toggle="tab" data-bs-target="#chat-2" aria-controls="chat-2" aria-selected="false">
                            
                            <div class="d-flex p-3">
                                <div class="avatar avatar-xl">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="flex-1 chat-contact-body ms-2 d-md-none d-lg-block">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0 chat-contact-title">Nome do Grupo</h6>
                                        <span class="message-time fs-11"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Fim dos Botões dos Grupos --}}
                    </div>
                </div>
                <form class="contacts-search-wrapper">
                    <div class="form-group mb-0 position-relative d-md-none d-lg-block w-100 h-100">
                        <input class="form-control form-control-sm chat-contacts-search border-0 h-100" type="text"
                            placeholder="Pesquisar Grupos ..." />
                            <span class="fas fa-search contacts-search-icon"></span>
                    </div>
                    <button class="btn btn-sm btn-transparent d-none d-md-inline-block d-lg-none">
                        <span class="fas fa-search fs-10"></span>
                    </button>
                </form>
            </div>
            <div class="tab-content card-chat-content">
                {{-- Mensagens do Chat Geral --}}
                <div class="tab-pane card-chat-pane active" id="chat-0" role="tabpanel"
                    aria-labelledby="chat-link-0">
                    <div class="chat-content-header">
                        <div class="row flex-between-center">
                            <div class="col-6 col-sm-8 d-flex align-items-center">
                                <a class="pe-3 text-700 d-md-none contacts-list-show" href="#!">
                                    <div class="fas fa-chevron-left"></div>
                                </a>
                                <div class="min-w-0">
                                    <h5 class="mb-0 text-truncate fs-9">Chat Geral</h5>
                                    <div class="fs-11 text-400"></div>
                                </div>
                            </div>
                            {{--  --}}
                        </div>
                    </div>
                    <div class="chat-content-body" style="display: inherit;">
                        <div class="conversation-info" data-index="0">
                            <div class="h-100 overflow-auto scrollbar">
                                <div class="d-flex position-relative align-items-center p-3 border-bottom">
                                    <div class="avatar avatar-xl status-online">
                                        <i class="fas fa-comments fa-3x"></i>
                                    </div>
                                    <div class="flex-1 ms-2 d-flex flex-between-center">
                                        <h6 class="mb-0 text-700">Chat Geral</h6>
                                        
                                    </div>
                                </div>
                                
                                <hr class="my-2" />
                                
                            </div>
                        </div>
                        <div class="chat-content-scroll-area scrollbar">
                            <div class="d-flex position-relative p-3 border-bottom mb-3 align-items-center">
                                <div class="avatar avatar-2xl me-3">
                                    <i class="fas fa-comments fa-3x"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 text-700">Chat Geral</a></h6>
                                    <p class="mb-0">Descrição do chat</p>
                                </div>
                            </div>

                            {{-- Marcação de dia da mensagem --}}
                            <div class="text-center fs-11 text-500"><span>5 de Maio de 2025</span></div>

                            {{-- Mensagem de outros usuários --}}
                            <div class="d-flex p-3">
                                <div class="avatar avatar-l me-2">
                                    <img class="rounded-circle" src="{{asset('')}}assets/img/team/2.jpg" alt="" />
                                </div>
                                <div class="flex-1">
                                    <div class="w-xxl-75">
                                        <div class="hover-actions-trigger d-flex align-items-center">
                                            <div class="chat-message bg-200 p-2 rounded-2">Mensagem de outro usuário...</div>
                                            {{-- Ações --}}
                                            <ul class="hover-actions position-relative list-inline mb-0 text-400 ms-2">
                                                <li class="list-inline-item">
                                                    <a class="chat-option" href="#!"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Encaminhar">
                                                        <span class="fas fa-share"></span>
                                                    </a>
                                                </li>                                                
                                            </ul>
                                        </div>
                                        <div class="text-400 fs-11"><span>13:54</span></div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Mensagem do usuário logado --}}
                            <div class="d-flex p-3">
                                <div class="flex-1 d-flex justify-content-end">
                                    <div class="w-100 w-xxl-75">
                                        <div class="hover-actions-trigger d-flex flex-end-center">
                                            {{-- Ações --}}
                                            <ul class="hover-actions position-relative list-inline mb-0 text-400 me-2">
                                                <li class="list-inline-item">
                                                    <a class="chat-option" href="#!"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Encaminhar"><span class="fas fa-share"></span>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="chat-option" href="#!"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Editar"><span class="fas fa-edit"></span>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="chat-option" href="#!"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Apagar"><span class="fas fa-trash-alt"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="bg-primary text-white p-2 rounded-2 chat-message"
                                                data-bs-theme="light">Mensagem do usuário logado</div>
                                        </div>
                                        <div class="text-400 fs-11 text-end">13:54<span
                                                class="fas fa-check ms-2 text-success"></span></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Mensagens dos Grupos --}}
                <div class="tab-pane card-chat-pane" id="chat-2" role="tabpanel" aria-labelledby="chat-link-2">
                    <div class="chat-content-header">
                        <div class="row flex-between-center">
                            <div class="col-6 col-sm-8 d-flex align-items-center"><a
                                    class="pe-3 text-700 d-md-none contacts-list-show" href="#!">
                                    <div class="fas fa-chevron-left"></div>
                                </a>
                                <div class="min-w-0">
                                    <h5 class="mb-0 text-truncate fs-9">Nome do Grupo</h5>
                                    <div class="fs-11 text-400"></div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <div class="chat-content-body" style="display: inherit;">
                        <div class="conversation-info" data-index="2">
                            <div class="h-100 overflow-auto scrollbar">
                                <div class="d-flex position-relative align-items-center p-3 border-bottom">
                                    <div class="avatar avatar-xl">
                                        <i class="fas fa-users fa-3x"></i>
                                    </div>
                                    <div class="flex-1 ms-2 d-flex flex-between-center">
                                        <h6 class="mb-0 text-700">Nome do Grupo</h6>                                        
                                    </div>
                                </div>                                
                                <hr class="my-2" />                                
                            </div>
                        </div>
                        <div class="chat-content-scroll-area scrollbar">
                            <div class="d-flex position-relative p-3 border-bottom mb-3 align-items-center">
                                <div class="avatar avatar-2xl me-3">
                                    <i class="fas fa-users fa-3x"></i>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 text-700">Nome do Grupo</h6>
                                    <p class="mb-0">Descrição do grupo</p>
                                </div>
                            </div>

                            {{-- Marcação de data --}}
                            <div class="text-center fs-11 text-500"><span>5 de Maio de 2025</span></div>

                            {{-- Mensagem de outros usuários --}}
                            <div class="d-flex p-3">
                                <div class="avatar avatar-l me-2">
                                    <img class="rounded-circle" src="{{asset('')}}assets/img/team/12.jpg" alt="" />
                                </div>
                                <div class="flex-1">
                                    <div class="w-xxl-75">
                                        <div class="hover-actions-trigger d-flex align-items-center">
                                            <div class="chat-message bg-200 p-2 rounded-2">Mensagem de outro usuário...</div>
                                            {{-- Ações --}}
                                            <ul class="hover-actions position-relative list-inline mb-0 text-400 ms-2">
                                                <li class="list-inline-item">
                                                    <a class="chat-option" href="#!"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Encaminhar">
                                                        <span class="fas fa-share"></span>
                                                    </a>
                                                </li>                                                
                                            </ul>
                                        </div>
                                        <div class="text-400 fs-11"><span>13:54</span></div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Mensagem do usuário logado --}}
                            <div class="d-flex p-3">
                                <div class="flex-1 d-flex justify-content-end">
                                    <div class="w-100 w-xxl-75">
                                        <div class="hover-actions-trigger d-flex flex-end-center">
                                            {{-- Ações --}}
                                            <ul class="hover-actions position-relative list-inline mb-0 text-400 me-2">
                                                <li class="list-inline-item">
                                                    <a class="chat-option" href="#!"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Encaminhar"><span class="fas fa-share"></span>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="chat-option" href="#!"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Editar"><span class="fas fa-edit"></span>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="chat-option" href="#!"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Apagar"><span class="fas fa-trash-alt"></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="bg-primary text-white p-2 rounded-2 chat-message"
                                                data-bs-theme="light">Mensagem do usuário logado</div>
                                        </div>
                                        <div class="text-400 fs-11 text-end">13:54<span
                                                class="fas fa-check ms-2 text-success"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Fim Mensagens dos Grupos --}}


                <form class="chat-editor-area">
                    <div class="emojiarea-editor outline-none scrollbar" contenteditable="true"></div>
                    <button class="btn btn-sm btn-send shadow-none" type="submit"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>


    <div class="container-fluid h-100 p-0 mt-4">
        <div class="row g-0 h-100" style="min-height: calc(100vh - 100px);">

            <!-- SIDEBAR (Salas) -->
            <div class="col-md-3 border-end bg-white d-none d-md-block">
                <div class="p-3 border-bottom bg-light">
                    <h5 class="mb-0 text-dark"><i class="far fa-comments fa-2x"></i> Canais</h5>
                </div>
                <div class="list-group list-group-flush">
                    <!-- Botão Chat Geral -->
                    <button type="button" class="list-group-item list-group-item-action active channel-btn"
                        id="btn-geral" onclick="switchRoom('geral', 'Chat Geral')">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1 text-white"><i class="fas fa-comments"></i> Chat Geral</h6>
                        </div>
                        <small>Interação de todos os membros</small>
                    </button>

                    <!-- Título GCs -->
                    <div class="p-3 bg-light border-top border-bottom mt-2">
                        <small class="fw-bold text-uppercase text-primary">Meus Grupos (GC)</small>
                    </div>

                    <!-- Loop dos Grupos do Usuário -->
                    @forelse($myGroups as $group)
                        <button type="button" class="list-group-item list-group-item-action channel-btn"
                            id="btn-group_{{ $group->id }}"
                            onclick="switchRoom('group_{{ $group->id }}', '{{ $group->name }}')">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 text-truncate"><i class="fas fa-users"></i> {{ $group->name }}
                                </h6>
                            </div>
                        </button>
                    @empty
                        <div class="p-3 text-dark small text-center">
                            Você não participa de nenhum grupo ainda.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- ÁREA DO CHAT -->
            <div class="col-md-9 d-flex flex-column bg-light">

                <!-- Header -->
                <div class="p-3 border-bottom bg-white d-flex align-items-center shadow-sm" style="height: 60px;">
                    <span class="fs-5 fw-bold text-primary" id="roomTitle"># Chat Geral</span>
                    <span class="ms-2 badge bg-success rounded-pill" id="statusBadge">Conectado</span>
                </div>

                <!-- Área de Mensagens -->
                <div id="messagesArea" class="flex-grow-1 p-4" style="overflow-y: auto; background-color: #e5ddd5;">
                    <!-- As mensagens serão inseridas aqui via JS -->
                </div>

                <!-- Área de Input -->
                <div class="p-3 bg-white border-top">
                    <div class="d-flex gap-2">
                        <input type="text" id="messageInput" name="content" class="form-control"
                            placeholder="Digite sua mensagem..." autocomplete="off">
                        <button type="button" id="btnSend" class="btn btn-primary px-4">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Iniciando Chat Multi-Sala...");

            // Configurações Iniciais
            const currentUserId = {{ auth()->id() }};
            let currentRoom = 'geral'; // Sala inicial
            let echoChannel = null; // Variável para guardar a inscrição atual no Reverb

            // Elementos DOM
            const messagesArea = document.getElementById('messagesArea');
            const messageInput = document.getElementById('messageInput');
            const btnSend = document.getElementById('btnSend');
            const roomTitle = document.getElementById('roomTitle');

            // --- FUNÇÕES VISUAIS ---

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
                if (messagesArea) messagesArea.scrollTop = messagesArea.scrollHeight;
            }

            function clearMessages() {
                messagesArea.innerHTML = '';
            }

            // --- LÓGICA DE TROCA DE SALA ---

            window.switchRoom = function(roomKey, title) {
                console.log(`Trocando para sala: ${roomKey}`);

                // 1. Atualiza UI (Botões ativos)
                document.querySelectorAll('.channel-btn').forEach(btn => btn.classList.remove('active'));
                const activeBtn = document.getElementById(`btn-${roomKey}`);
                if (activeBtn) activeBtn.classList.add('active');

                roomTitle.innerText = '# ' + title;

                // 2. Se for a mesma sala, não faz nada
                if (currentRoom === roomKey && echoChannel) return;

                // 3. Limpa chat antigo e atualiza variável
                clearMessages();

                // 4. Desconecta do canal anterior (IMPORTANTE para não receber msg duplicada)
                if (echoChannel && window.Echo) {
                    window.Echo.leave(`chat.${currentRoom}`);
                }

                currentRoom = roomKey;

                // 5. Carrega novas mensagens e Reconecta
                loadHistoryAndConnect();
            };

            // --- FUNÇÕES DE REDE (AXIOS & ECHO) ---

            function loadHistoryAndConnect() {
                if (!window.axios || !window.Echo) {
                    console.error("Axios ou Echo não carregados.");
                    return;
                }

                // A. Carregar Histórico
                window.axios.get(`{{ route('chat.history') }}?room=${currentRoom}`)
                    .then(response => {
                        response.data.forEach(msg => appendMessage(msg));

                        // B. Conectar no Reverb (WebSocket) APÓS carregar histórico
                        // O nome do canal será 'chat.geral' ou 'chat.group_1', 'chat.group_5', etc.
                        echoChannel = window.Echo.channel(`chat.${currentRoom}`)
                            .listen('MessageSent', (e) => {
                                console.log('Nova mensagem:', e);
                                appendMessage(e);
                            });
                    })
                    .catch(err => console.error("Erro histórico:", err));
            }

            function sendMessage() {
                const content = messageInput.value.trim();
                if (!content) return;

                messageInput.value = ''; // Limpa input

                window.axios.post('{{ route('chat.send') }}', {
                    content: content,
                    room: currentRoom // Envia para a sala atual (geral ou group_X)
                }).catch(error => {
                    console.error('Erro envio:', error);
                    alert('Erro ao enviar mensagem.');
                });
            }

            // --- INICIALIZAÇÃO ---

            // Listeners de Input
            if (btnSend) btnSend.addEventListener('click', (e) => {
                e.preventDefault();
                sendMessage();
            });
            if (messageInput) messageInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    sendMessage();
                }
            });

            // Delay para garantir que o Vite carregou o app.js
            setTimeout(() => {
                loadHistoryAndConnect();
            }, 500);
        });
    </script>
@endsection
