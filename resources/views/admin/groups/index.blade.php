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
            <a href="{{ route('admin.groups.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Novo Grupo
            </a>
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
                                <h5 class="card-title fw-bold text-primary">{{ $group->name }}</h5>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.groups.edit', $group) }}">Editar</a></li>
                                        <li>
                                            <form action="{{ route('admin.groups.destroy', $group) }}" method="POST"
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
                                <a href="{{ route('admin.groups.edit', $group->id) }}" class="btn btn-info"
                                    title="Atualizar Grupo">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.groups.destroy', $group->id) }}" class="btn btn-danger"
                                    title="Deletar Grupo"
                                    onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <form id="delete-form" action="{{ route('admin.groups.destroy', $group->id) }}"
                                    method="POST" class="d-none">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <a href="{{ route('groups_members.store') }}" class="btn btn-success"
                                    title="Acrescentar membros" data-bs-toggle="modal"
                                    data-bs-target="#addMemberModal-{{ $group->id }}">
                                    <i class="fas fa-user-plus"></i>
                                </a>
                                <!-- MODAL DE ADICIONAR MEMBRO (Específica para este ID de departamento) -->
                                <div class="modal fade" id="addMemberModal-{{ $group->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('groups_members.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Adicionar ao {{ $group->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Selecione o Membro</label>
                                                        <select name="user_id" class="form-select" required>
                                                            <option value="">Escolha um usuário...</option>
                                                            @foreach ($users as $user)
                                                                @if ()
                                                                    
                                                                @endif
                                                                <option value="{{ $user->id }}">
                                                                    {{ $user->name }} ({{ $user->email }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <small class="text-muted">
                                                            Certifique-se de não selecionar alguém que já faz parte da
                                                            equipe.
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- FIM DA MODAL -->
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
