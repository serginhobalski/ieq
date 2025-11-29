@extends('layouts.app')

@section('title')
    Membros do departamento
@endsection

@section('styles')
@endsection

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Equipe: {{ $department->name }}</h3>
            <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Voltar</a>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">Adicionar Voluntário</div>
                    <div class="card-body">
                        <form action="{{ route('admin.departments.addMember', $department) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Selecionar Membro da Igreja</label>
                                <select name="user_id" class="form-select" required>
                                    <option value="">Escolha...</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary w-100">Adicionar à Equipe</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">Voluntários Ativos ({{ $department->members->count() }})</div>
                    <ul class="list-group list-group-flush">
                        @foreach ($department->members as $member)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $member->avatar_url }}" width="32" class="rounded-circle me-2">
                                    {{ $member->name }}
                                </div>
                                <form action="{{ route('admin.departments.removeMember', [$department, $member]) }}"
                                    method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Remover</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
