@extends('layouts.app')

@section('title')
    {{ $course->title }}
@endsection

@section('content')
    <div class="container">
        <!-- Cabeçalho do Curso -->
        <div class="card mb-4 border-0 shadow-sm bg-primary text-white">
            <div class="card-body d-flex align-items-center">
                <img src="{{ $course->cover_url }}" class="rounded me-3 border border-white" width="80" height="80"
                    style="object-fit: cover">
                <div>
                    <span class="badge bg-white text-primary mb-1">{{ strtoupper($course->category) }}</span>
                    <h2 class="h4 mb-0">{{ $course->title }}</h2>
                    <small class="opacity-75">{{ $course->lessons->count() }} aulas cadastradas</small>
                </div>
                <div class="ms-auto">
                    @if (Auth::user()->is_admin == 1)                        
                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-outline-light btn-sm">Editar
                        Detalhes
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Lista de Aulas -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">Grade Curricular</div>
                    <ul class="list-group list-group-flush">
                        @forelse($course->lessons as $lesson)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="badge bg-light text-dark me-3 border rounded-pill">{{ $lesson->order }}</span>
                                    <div>
                                        <div class="fw-bold">{{ $lesson->title }}</div>
                                        @if ($lesson->video_url)
                                            <small class="text-muted"><i class="bi bi-camera-video"></i> Vídeo
                                                incluído</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="btn-group">
                                    @if (Auth::user()->is_admin == 1)
                                    <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST"
                                        onsubmit="return confirm('Apagar aula?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-link text-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center py-4 text-muted">
                                Nenhuma aula cadastrada ainda. Use o formulário ao lado.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Formulário para Adicionar Aula -->
            <div class="col-md-4">
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    @if (Auth::user()->is_admin == 1)
                    <div class="card-header bg-success text-white">
                        <i class="bi bi-plus-circle"></i> Adicionar Nova Aula
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.courses.lessons.store', $course) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Título da Aula</label>
                                <input type="text" name="title" class="form-control"
                                    placeholder="Ex: Introdução ao Gênesis" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Link do Vídeo (YouTube/Vimeo)</label>
                                <input type="url" name="video_url" class="form-control"
                                    placeholder="https://youtube.com/...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Conteúdo / Resumo</label>
                                <textarea name="content" class="form-control" rows="3" placeholder="Texto de apoio para o aluno..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Adicionar Aula</button>
                        </form>
                    </div>
                    @endif
                    <div class="mb-3 mt-3 text-center">
                        <a href="{{ route($course->category) }}" class="btn btn-warning">
                            <i class="fas fa-undo-alt"></i>Voltar para Cursos
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
