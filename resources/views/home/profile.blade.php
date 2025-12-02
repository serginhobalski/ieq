@extends('layouts.app')

@section('title')
    Perfil de {{ Auth::user()->name }}
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        
        <!-- COLUNA DA ESQUERDA: FOTO -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center p-4">
                <div class="mb-3 position-relative d-inline-block">
                    <!-- Preview da Imagem -->
                    <img id="avatarPreview" src="{{ $user->avatar_url }}" 
                         class="rounded-circle shadow-sm border border-3 border-white" 
                         style="width: 150px; height: 150px; object-fit: cover;">
                </div>
                
                <h5 class="fw-bold">{{ $user->name }}</h5>
                <p class="text-muted mb-1">{{ '@' . $user->username }}</p>
                <span class="badge bg-primary">
                    @if ($user->role == 'member')
                        Membro
                    @endif
                    @if ($user->role == 'leader')
                        Líder de Grupo/Departamento
                    @endif
                    @if ($user->role == 'pastor')
                        Pastor
                    @endif
                    @if ($user->role == 'visitor')
                        Visitante
                    @endif
                </span>
                
                <div class="mt-4 text-start">
                    <small class="text-muted"><i class="bi bi-envelope"></i> {{ $user->email }}</small><br>
                    <small class="text-muted"><i class="bi bi-calendar"></i> Membro desde {{ $user->created_at->format('M/Y') }}</small>
                </div>
            </div>
        </div>

        <!-- COLUNA DA DIREITA: FORMULÁRIO -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 text-primary fw-bold"><i class="fas fa-user-cog"></i> Editar Meus Dados</h4>
                </div>
                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Seção Dados Pessoais -->
                        <h5 class="text-muted border-bottom pb-2 mb-3">
                            <i class="fas fa-id-card"></i> Informações Pessoais
                        </h5>
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label">Alterar Foto de Perfil</label>
                                <input type="file" name="avatar" id="avatarInput" class="form-control" accept="image/*">
                                <div class="form-text">Recomendado: Quadrada, JPG ou PNG.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nome Completo</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Nome de Usuário (Login)</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Celular / WhatsApp</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Data de Nascimento</label>
                                <input type="date" name="birth_date" class="form-control" 
                                value="{{ old('birth_date', $user->birth_date) }}"
                                {{-- value="{{ old('birth_date', $user->birth_date ? $user->birth_date->format('Y-m-d') : '') }}" --}}
                                >
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Endereço</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                            </div>
                        </div>

                        <!-- Seção Segurança -->
                        <h5 class="border-bottom pb-2 mb-3 mt-4 text-danger">
                            <i class="fas fa-shield-alt"></i> Segurança (Alterar Senha)
                        </h5>
                        
                        <div class="alert alert-light border small text-danger">
                            Deixe os campos abaixo <strong>em branco</strong> se não quiser alterar sua senha.
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Nova Senha</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirmar Nova Senha</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-lg"></i> Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script para Preview da Imagem em Tempo Real --}}
<script>
    document.getElementById('avatarInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection