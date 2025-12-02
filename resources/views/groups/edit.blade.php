@extends('layouts.app')

@section('title')
    Editar Grupo de Comunhão
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
                <form action="{{ route('groups.update', $group->id) }}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nome do Grupo</label>
                            <input type="text" name="name" class="form-control" placeholder="Ex: GC Jovens Radicais"
                                required value="{{ $group->name }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Líder Responsável</label>

                            <select name="leader_id" class="form-select" required>
                                @foreach($leaders as $leader)
                                    <option value="{{ $leader->id }}" {{ $group->leader_id == $leader->id ? 'selected' : '' }}>
                                        {{ $leader->name }}
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
                                <option value="Segunda-feira" {{ $group->meeting_day == 'Segunda-feira' ? 'selected' : '' }}>Segunda-feira</option>
                                <option value="Terça-feira" {{ $group->meeting_day == 'Terça-feira' ? 'selected' : '' }}>Terça-feira</option>
                                <option value="Quarta-feira" {{ $group->meeting_day == 'Quarta-feira' ? 'selected' : '' }}>Quarta-feira</option>
                                <option value="Quinta-feira" {{ $group->meeting_day == 'Quinta-feira' ? 'selected' : '' }}>Quinta-feira</option>
                                <option value="Sexta-feira" {{ $group->meeting_day == 'Sexta-feira' ? 'selected' : '' }}>Sexta-feira</option>
                                <option value="Sábado" {{ $group->meeting_day == 'Sábado' ? 'selected' : '' }}>Sábado</option>
                                <option value="Domingo" {{ $group->meeting_day == 'Domingo' ? 'selected' : '' }}>Domingo</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Horário</label>
                            <input type="time" name="meeting_time" class="form-control" required value="{{ $group->meeting_time }}">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Endereço Completo</label>
                            <input type="text" name="address" class="form-control" placeholder="Rua, Número, Bairro" value="{{ $group->address }}">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Salvar Grupo</button>
                        <a href="{{ route('groups.index') }}" class="btn btn-link text-muted">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection