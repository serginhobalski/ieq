@extends('layouts.app')

@section('title')
    Devocionais
@endsection

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary mb-0">Palavra do Dia</h2>
                <p class="text-muted">Alimento diário para sua fé.</p>
            </div>

            <!-- Botão só aparece para Admin ou Pastor -->
            @if (Auth::user()->is_admin || Auth::user()->role == 'pastor')
                <a href="{{ route('devotionals.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-pen-alt"></i> Escrever Novo
                </a>
            @endif
        </div>

        <div class="row">
            @foreach ($devotionals as $devotional)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('devotionals.show', $devotional) }}" class="text-decoration-none text-dark">
                        <div class="card h-100 shadow-sm border-0 hover-card">
                            <div class="position-relative">
                                <!-- Imagem de Capa -->
                                <img src="{{ $devotional->cover_url }}" class="card-img-top"
                                    style="height: 200px; object-fit: cover;">
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-white text-dark shadow-sm">
                                        {{ $devotional->published_at->format('d/m') }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-2">{{ $devotional->title }}</h5>
                                <p class="card-text text-muted small">
                                    {{ Str::limit(strip_tags($devotional->content), 100) }}
                                </p>
                                <div class="d-flex align-items-center mt-3 pt-3 border-top">
                                    <img src="{{ $devotional->author->avatar_url }}" class="rounded-circle me-2"
                                        width="25" height="25">
                                    <small class="text-muted">{{ $devotional->author->name }}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row g-3 flex-center justify-content-md-between">
                    <div class="col-auto">
                        <form class="row gx-2">
                            <div class="col-auto"><small>Devocionais postados:</small></div>
                            <div class="col-auto"> <select class="form-select form-select-sm" aria-label="Show courses">
                                    <option selected="selected" value="{{ $devotionals->count() }}">
                                        {{ $devotionals->count() }} <!-- Total de cursos -->
                                    </option>
                                </select></div>
                        </form>
                    </div>

                    <div class="col-auto">
                        {{-- TODO: Remover e substituir por $courses->links() --}}
                        {{-- <button class="btn btn-falcon-default btn-sm me-2" type="button" disabled="disabled" ...>
                            <a class="btn btn-sm btn-falcon-default text-primary me-2" href="#!"> 1 </a>
                            ...
                        </button> --}}
                        {{-- {{ $devotionals->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s;
        }
    </style>
@endsection
