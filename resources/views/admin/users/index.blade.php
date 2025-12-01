@extends('layouts.app')

@section('title')
    Usuários
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Membros da Igreja</h2>
        
        <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Buscar por nome ou email..." value="{{ request('search') }}">
            <button class="btn btn-outline-primary me-2" type="submit">Buscar</button>
            <a class="btn btn-info" title="Criar membro" href="{{route('admin.users.create')}}">
                <i class="fas fa-user-plus"></i> Criar membro
            </a>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm mt-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">Foto</th>
                        <th>Nome / Email</th>
                        <th>Função</th>
                        <th>Acesso</th>
                        <th>Cadastro</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <img src="{{ $user->avatar_url }}" class="rounded-circle" width="40" height="40" alt="avatar">
                        </td>
                        <td>
                            <div class="fw-bold">{{ $user->name }}</div>
                            <div class="text-muted small">{{ $user->email }}</div>
                        </td>
                        <td>
                            <span class="badge bg-info text-dark">{{ ucfirst($user->role ?? 'Membro') }}</span>
                        </td>
                        <td>
                            @if($user->is_admin)
                                <span class="badge bg-danger">ADMIN</span>
                            @else
                                <span class="badge bg-light text-dark border">Usuário</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este membro?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white text-info">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection