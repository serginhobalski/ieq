@extends('layouts.app')

@section('title')
    Criar Usuário
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0 text-info">Criar Membro:</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nome Completo</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nome de usuário</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Telefone</label>
                                <input type="tel" name="phone" class="form-control" >
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Endereço completo</label>
                                <input type="tex" name="address" class="form-control" >
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Função na Igreja</label>
                                <select name="role" class="form-select">
                                    <option value="member">Membro Comum</option>
                                    <option value="leader">Líder de Grupo ou Área</option>
                                    <option value="pastor">Pastor(a)</option>
                                    <option value="visitor">Visitante</option>
                                </select>
                                <div class="form-text">Isso define a hierarquia para GCs e Departamentos.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Senha</label>
                                <input type="password" name="password" class="form-control" placeholder="Deixe em branco para manter">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirmação de Senha</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Deixe em branco para manter">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Foto de perfil</label>
                                <input type="file" accept=".jpg,.jpeg,.png,.gif" name="avatar" class="form-control">
                            </div>

                            <div class="col-12 mt-4">
                                <div class="card bg-light border-warning">
                                    <div class="card-body">
                                        <h6 class="card-title text-warning fw-bold"> <i class="bi bi-shield-lock"></i> Acesso Administrativo</h6>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_admin" id="adminCheck">
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
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection