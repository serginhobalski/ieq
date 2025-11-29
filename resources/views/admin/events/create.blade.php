@extends('layouts.app')


@section('title')
    Criar Evento
@endsection


@section('styles')
@endsection


@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h4 class="mb-0">Novo Evento</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Título do Evento</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">Tipo</label>
                        <select name="type" class="form-select">
                            <option value="culto">Culto</option>
                            <option value="evento">Evento Especial</option>
                            <option value="ensaio">Ensaio</option>
                            <option value="reuniao">Reunião</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Início</label>
                        <input type="datetime-local" name="start_at" class="form-control" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Fim</label>
                        <input type="datetime-local" name="end_at" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Local</label>
                        <input type="text" name="location" class="form-control" placeholder="Ex: Nave Principal">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Descrição</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Banner (Capa)</label>
                        <input type="file" name="banner" class="form-control">
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_published" id="publishCheck" checked>
                            <label class="form-check-label" for="publishCheck">Publicar Imediatamente?</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Salvar Evento</button>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-link text-muted">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('scripts')
@endsection
