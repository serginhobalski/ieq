@extends('layouts.app')

@section('title')
    Criar Curso
@endsection

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white text-dark">Novo Curso / Módulo</div>
        <div class="card-body">
            <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Título</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Categoria</label>
                        <select name="category" class="form-select">
                            <option value="debq">Escola Bíblica (DEBQ)</option>
                            <option value="trilho">Trilho de Crescimento</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Descrição</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Capa do Curso</label>
                        <input type="file" name="cover" class="form-control" accept="image/*">
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_published" checked>
                            <label class="form-check-label">Publicar imediatamente</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Salvar e Adicionar Aulas</button>
                </div>
            </form>
            <div class="mt-3">
                <a href="{{route('admin.courses.index')}}" class="btn btn-warning">
                    <i class="fas fa-undo-alt"></i>Voltar para Cursos
                </a>
            </div>
        </div>
    </div>
</div>
@endsection