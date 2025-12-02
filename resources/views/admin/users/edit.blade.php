@extends('layouts.app')

@section('title')
    Editar Usuário
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0 text-info">Editar Membro: {{ $user->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ $user->avatar_url }}" class="rounded-circle shadow-sm" width="100" height="100">
                    </div>

                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nome Completo</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Função na Igreja</label>
                                <select name="role" class="form-select">
                                    <option value="member" {{ ($user->role ?? '') == 'member' ? 'selected' : '' }}>Membro Comum</option>
                                    <option value="leader" {{ ($user->role ?? '') == 'leader' ? 'selected' : '' }}>Líder de Grupo/Departamento</option>
                                    <option value="pastor" {{ ($user->role ?? '') == 'pastor' ? 'selected' : '' }}>Pastor</option>
                                    <option value="visitor" {{ ($user->role ?? '') == 'visitor' ? 'selected' : '' }}>Visitante</option>
                                </select>
                                <div class="form-text">Isso define a hierarquia para GCs e Departamentos.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Alterar Senha (Opcional)</label>
                                <input type="password" name="password" class="form-control" placeholder="Deixe em branco para manter">
                            </div>

                            <div class="col-12 mt-4">
                                <div class="card bg-light border-warning">
                                    <div class="card-body">
                                        <h6 class="card-title text-warning fw-bold"> <i class="bi bi-shield-lock"></i> Acesso Administrativo</h6>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_admin" id="adminCheck" {{ $user->is_admin ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="adminCheck">
                                                Conceder acesso ao Painel Admin?
                                            </label>
                                        </div>
                                        <div class="small text-muted mt-1">
                                            Cuidado: Usuários com essa opção marcada poderão acessar esta área, editar eventos e excluir membros.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-link text-muted">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection