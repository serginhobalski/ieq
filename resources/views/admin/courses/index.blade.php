@extends('layouts.app')

@section('title')
    Ensino
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Escola Bíblica & Trilho de Crescimento</h2>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Novo Curso
            </a>
        </div>

        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <!-- Capa do Curso -->
                        @if ($course->cover_image)
                            <img src="{{ asset('storage/'.$course->cover_image) }}"
                                class="card-img-top" alt="..." style="height: 150px; object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/img/elearning/courses/' . $course->category . '.png') }}"
                                class="card-img-top" alt="..." style="height: 150px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                @if ($course->category == 'debq')
                                    <span class="badge bg-primary">DEBQ</span>
                                @else
                                    <span class="badge bg-success">Trilho</span>
                                @endif

                                @if (!$course->is_published)
                                    <span class="badge bg-warning text-dark">Não publicado</span>
                                @endif
                            </div>

                            <h5 class="card-title text-truncate">{{ $course->title }}</h5>
                            <p class="card-text small text-muted flex-grow-1">{{ Str::limit($course->description, 80) }}</p>

                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit"></i> Gerenciar Aulas ({{ $course->lessons_count }})
                                </a>
                                <div class="btn-group">
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-light btn-sm border"
                                        data-bs-toggle="modal" data-bs-target="#modalEditCourse{{ $course->id }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <!-- Botão de exclusão (Form) -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de Edição do Curso -->
                <div class="modal fade" id="modalEditCourse{{ $course->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.courses.update', $course->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf

                                <div class="modal-header">
                                    <h5 class="modal-title">ALterar {{ $course->title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Título do Curso</label>
                                        <input type="text" name="title" class="form-control" placeholder="Título..."
                                            value="{{ $course->title }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Categoria do Curso</label>
                                        <select name="category" class="form-select" required>
                                            <option value="">Selecione...</option>
                                            <option value="debq" {{ $course->category == 'debq' ? 'selected' : '' }}>
                                                DEBQ
                                            </option>
                                            <option value="trilho" {{ $course->category == 'trilho' ? 'selected' : '' }}>
                                                Trilho
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Descrição do Curso</label>
                                        <input type="text" name="description" class="form-control"
                                            placeholder="Descrição..." value="{{ $course->description }}">
                                    </div>
                                    <div class="mb-3">
                                        <label>Capa do Curso</label>
                                        <input type="file" name="cover" accept=".jpg,.jpeg,.png" class="form-control"
                                            placeholder="Imagem de capa...">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_published"
                                                {{ $course->is_published == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label">Publicar imediatamente</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Salvar Curso</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
