@extends('layouts.app')

@section('title')
    Lista de Grupos de Comunhão
@endsection

@section('styles')
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Grupos de Conexão</h2>
            @if (Auth::user()->is_admin == 1)
                <a href="{{ route('groups.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Novo Grupo
                </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @foreach ($groups as $group)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title fw-bold text-primary">
                                    {{ $group->name }}
                                </h5>
                                <span class="badge bg-primary">
                                    {{ $group->members->count() }} Membros
                                </span>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('groups.edit', $group) }}">Editar</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('groups.destroy', $group) }}" method="POST"
                                                onsubmit="return confirm('Excluir este grupo?')">
                                                @csrf @method('DELETE')
                                                <button class="dropdown-item text-danger">Excluir</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $group->leader->avatar_url }}" class="rounded-circle me-2" width="40"
                                    height="40" alt="Líder">
                                <div>
                                    <small class="text-muted d-block">Líder</small>
                                    <span class="fw-bold">{{ $group->leader->name }}</span>
                                </div>
                            </div>

                            <ul class="list-unstyled mb-0 small text-secondary">
                                <li class="mb-2"><i class="bi bi-calendar-event me-2"></i> {{ $group->meeting_day }} às
                                    {{ \Carbon\Carbon::parse($group->meeting_time)->format('H:i') }}</li>
                                <li><i class="bi bi-geo-alt me-2"></i> {{ $group->address ?? 'Endereço não informado' }}
                                </li>
                            </ul>

                            <div class="mb-3 mt-2">
                                <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-info">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                @if (Auth::user()->id == $group->leader_id || Auth::user()->is_admin == 1)
                                    <a href="#" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalAdd{{ $group->id }}">
                                        <i class="fas fa-user-plus"></i>
                                    </a>

                                    <div class="modal fade" id="modalAdd{{ $group->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('groups_members.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="group_id" value="{{ $group->id }}">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Ingressar no
                                                            {{ $group->name }}
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <input type="text hidden" name="group_id"
                                                                value="{{ $group->id }}" hidden>
                                                            <label>
                                                                Selecionar Membro do Grupo
                                                            </label>
                                                            <select name="user_id" class="form-select" required>
                                                                <option value="">Selecione...</option>
                                                                @foreach ($members as $member)
                                                                    <option value="{{ $member->id }}">
                                                                        {{ $member->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="is_co_leader">
                                                                <label class="form-check-label">
                                                                    É co-líder do grupo
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">
                                                            Salvar Membro no Grupo de Comunhão
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if (Auth::user()->is_admin == 1)
                                    <a href="{{ route('groups.destroy', $group->id) }}" class="btn btn-danger"
                                        onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <form id="delete-form" action="{{ route('groups.destroy', $group->id) }}"
                                        method="POST" class="d-none">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                @endif
                            </div>

                            <hr>

                            <h6 class="fw-bold">Membros do Grupo:</h6>
                            <div class="d-flex flex-wrap align-items-center">
                                <!-- Lista de Membros -->
                                @foreach ($group->members as $member)
                                    <div class="text-center me-3 mb-2" title="{{ $member->name }}">
                                        <!-- Dica: Adicionei um fallback caso a imagem quebre ou seja nula -->
                                        <img src="{{ $member->avatar_url }}" class="rounded-circle border" width="50"
                                            height="50" style="object-fit: cover;" alt="{{ $member->name }}">
                                        <div class="small text-truncate" style="max-width: 60px;">
                                            {{ explode(' ', $member->name)[0] }} <!-- Mostra só o primeiro nome -->
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr>

                            <div class="d-flex align-items-center mt-3">
                                {{-- Lógica de Botões --}}
                                @if ($group->members->contains(Auth::user()->id))
                                    <span class="me-2 text-success">Você participa deste grupo.</span>

                                    {{-- BOTÃO SAIR --}}
                                    @if (Auth::user()->is_admin == 1)                                        
                                    <form action="{{ route('groups.leave', $group->id) }}" method="POST"
                                        onsubmit="return confirm('Tem certeza que deseja sair deste grupo?');">                                        
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-sign-out-alt me-1"></i> Sair do Grupo
                                        </button>
                                    </form>
                                    @endif
                                @else
                                    <span class="me-2">Deseja participar das reuniões?</span>

                                    {{-- BOTÃO ENTRAR --}}
                                    <form action="{{ route('groups.join', $group->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-user-plus me-1"></i> Ingressar no Grupo
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
@endsection
