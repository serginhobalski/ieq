@extends('layouts.app')

@section('title')
    Pedidos de Oração
@endsection

@section('styles')
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- TÍTULO -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold text-primary"><i class="bi bi-heart-pulse"></i> Mural de Oração</h2>
                </div>

                <!-- FORMULÁRIO DE NOVO PEDIDO -->
                <div class="card shadow-sm mb-5 border-0 bg-white">
                    <div class="card-body p-4">
                        <div class="d-flex mb-3">
                            <img src="{{ Auth::user()->avatar_url }}" class="rounded-circle me-3" width="50"
                                height="50">
                            <div class="flex-grow-1">
                                <h5 class="fw-bold mb-0 text-dark">Como podemos orar por você hoje?</h5>
                                <small class="text-dark">Compartilhe sua carga, estamos juntos nessa.</small>
                            </div>
                        </div>

                        <form action="{{ route('prayers.store') }}" method="POST">
                            @csrf
                            <textarea name="request" class="form-control mb-3 bg-light" rows="3" placeholder="Escreva seu pedido aqui..."
                                required style="resize: none;"></textarea>

                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex gap-3">
                                    <!-- Opção Público/Privado -->
                                    <div class="form-check form-switch" title="Se desligado, apenas pastores verão">
                                        <input class="form-check-input" type="checkbox" name="is_public" id="checkPublic"
                                            checked>
                                        <label class="form-check-label small" for="checkPublic">Público</label>
                                    </div>

                                    <!-- Opção Anônimo -->
                                    <div class="form-check form-switch" title="Seu nome não aparecerá">
                                        <input class="form-check-input" type="checkbox" name="is_anonymous" id="checkAnon">
                                        <label class="form-check-label small" for="checkAnon">Anônimo</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                    <i class="bi bi-send"></i> Postar Pedido
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- FEED DE ORAÇÕES -->
                @forelse($prayers as $prayer)
                    <div class="card shadow-sm mb-3 border-0">
                        <div class="card-body">
                            <!-- Cabeçalho do Card -->
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="d-flex align-items-center">
                                    <!-- Avatar (Lógica no Model trata se é anônimo) -->
                                    <img src="{{ $prayer->author_avatar }}" class="rounded-circle me-2" width="40"
                                        height="40">
                                    <div>
                                        <h6 class="fw-bold mb-0 {{ $prayer->is_anonymous ? 'text-muted fst-italic' : '' }}">
                                            {{ $prayer->author_name }}
                                        </h6>
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            {{ $prayer->created_at->diffForHumans() }}
                                            @if (!$prayer->is_public)
                                                <span class="badge bg-secondary ms-1"><i class="bi bi-lock-fill"></i>
                                                    Privado</span>
                                            @endif
                                        </small>
                                    </div>
                                </div>

                                <!-- Menu de Opções (Apagar) -->
                                @if (Auth::id() === $prayer->user_id || Auth::user()->is_admin)
                                    <div class="dropdown">
                                        <button class="btn btn-link text-muted p-0" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <form action="{{ route('prayers.destroy', $prayer) }}" method="POST"
                                                    onsubmit="return confirm('Remover pedido?')">
                                                    @csrf @method('DELETE')
                                                    <button class="dropdown-item text-danger">Excluir</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <!-- Conteúdo -->
                            <p class="card-text fs-6 text-primary mt-3 mb-4" style="white-space: pre-wrap;">
                                {{ $prayer->request }}</p>

                            <!-- Rodapé (Botão de Oração) -->
                            <div class="border-top pt-3 d-flex align-items-center">
                                <form action="{{ route('prayers.pray', $prayer) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-sm {{ $prayer->i_have_prayed ? 'btn-success' : 'btn-outline-secondary' }} rounded-pill px-3">
                                        <i class="bi bi-hands-praying"></i>
                                        {{ $prayer->i_have_prayed ? 'Eu orei' : 'Vou orar' }}
                                    </button>
                                </form>

                                <small class="text-muted ms-3">
                                    <strong>{{ $prayer->intercessors_count }}</strong> pessoas oraram por isso.
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-chat-heart display-1 opacity-25"></i>
                        <p class="mt-3">Nenhum pedido de oração no momento.</p>
                    </div>
                @endforelse

                <div class="mt-4">
                    {{ $prayers->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
