@extends('layouts.app')

@section('title')
    Criar Grupo de Comunhão
@endsection

@section('styles')
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h4 class="mb-0 text-dark">Novo Grupo</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.groups.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nome do Grupo</label>
                            <input type="text" name="name" class="form-control" placeholder="Ex: GC Jovens Radicais"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Líder Responsável</label>
                            <select name="leader_id" class="form-select" required>
                                <option value="">Selecione um líder...</option>
                                @foreach ($leaders as $leader)
                                    <option value="{{ $leader->id }}">{{ $leader->name }} ({{ ucfirst($leader->role) }})
                                    </option>
                                @endforeach
                            </select>
                            @if ($leaders->isEmpty())
                                <div class="form-text text-danger">Nenhum usuário com permissão de Líder encontrado. Edite
                                    um usuário em "Membros" primeiro.</div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Dia do Encontro</label>
                            <select name="meeting_day" class="form-select" required>
                                <option value="Segunda-feira">Segunda-feira</option>
                                <option value="Terça-feira">Terça-feira</option>
                                <option value="Quarta-feira">Quarta-feira</option>
                                <option value="Quinta-feira">Quinta-feira</option>
                                <option value="Sexta-feira">Sexta-feira</option>
                                <option value="Sábado">Sábado</option>
                                <option value="Domingo">Domingo</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Horário</label>
                            <input type="time" name="meeting_time" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Endereço Completo</label>
                            <input type="text" name="address" class="form-control" placeholder="Rua, Número, Bairro">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Salvar Grupo</button>
                        <a href="{{ route('admin.groups.index') }}" class="btn btn-link text-muted">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
