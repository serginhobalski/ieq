@extends('layouts.app')


@section('title')
    Editar Evento
@endsection


@section('styles')
@endsection


@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h4 class="mb-0">Editar Evento: {{ $event->title }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Título do Evento</label>
                        <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label">Tipo</label>
                        <select name="type" class="form-select">
                            <option value="culto" {{ $event->type == 'culto' ? 'selected' : '' }}>Culto</option>
                            <option value="evento" {{ $event->type == 'evento' ? 'selected' : '' }}>Evento Especial</option>
                            <option value="ensaio" {{ $event->type == 'ensaio' ? 'selected' : '' }}>Ensaio</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Início</label>
                        <input type="datetime-local" name="start_at" class="form-control" value="{{ $event->start_at->format('Y-m-d\TH:i') }}">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Fim</label>
                        <input type="datetime-local" name="end_at" class="form-control" value="{{ $event->end_at->format('Y-m-d\TH:i') }}">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Local</label>
                        <input type="text" name="location" class="form-control" value="{{ $event->location }}">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Descrição</label>
                        <textarea name="description" class="form-control" rows="4">{{ $event->description }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Alterar Banner</label>
                        <input type="file" name="banner" class="form-control">
                        @if($event->banner_path)
                            <div class="mt-2 text-muted small">Banner atual existente</div>
                        @endif
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_published" id="publishCheck" {{ $event->is_published ? 'checked' : '' }}>
                            <label class="form-check-label" for="publishCheck">Publicado?</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Atualizar Evento</button>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-link text-muted">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('scripts')
@endsection
