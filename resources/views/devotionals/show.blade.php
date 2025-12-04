@extends('layouts.app')

@section('title')
    Devocional: {{ $devotional->title }}
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-9">

                <a href="{{ route('devotionals.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>

                <div class="card shadow-sm border-0 overflow-hidden">
                    <!-- Imagem Gigante de Capa -->
                    <div
                        style="height: 300px; background-image: url('{{ $devotional->cover_url }}'); background-size: cover; background-position: center;">
                    </div>

                    <div class="card-body p-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-light text-dark border">
                                <i class="fas fa-calendar-alt"></i> {{ $devotional->published_at->format('d de F, Y') }}
                            </span>

                            @if (Auth::user()->is_admin || Auth::id() == $devotional->user_id)
                                <form action="{{ route('devotionals.destroy', $devotional->id) }}" method="POST"
                                    onsubmit="return confirm('Apagar devocional?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            @endif
                        </div>

                        <h1 class="fw-bold mb-4 display-6">{{ $devotional->title }}</h1>

                        <!-- Avatar do Autor -->
                        <div class="d-flex align-items-center mb-5 pb-4 border-bottom">
                            <img src="{{ $devotional->author->avatar_url }}" class="rounded-circle me-3 border"
                                width="50" height="50">
                            <div>
                                <div class="fw-bold">{{ $devotional->author->name }}</div>
                                <small class="text-muted">Autor</small>
                            </div>
                        </div>

                        <!-- Conteúdo do Texto (nl2br converte quebras de linha em <br>) -->
                        <div class="fs-5 lh-lg text-secondary">
                            {!! nl2br(e($devotional->content)) !!}
                        </div>

                    </div>
                </div>

                <!-- Botão de Compartilhar (Exemplo simples) -->
                <div class="text-center mt-4">
                    <p class="text-muted">Gostou dessa palavra? Compartilhe com alguém!</p>
                    <a href="https://wa.me/?text={{ urlencode('Leia este devocional: ' . $devotional->title . ' - ' . route('devotionals.show', $devotional)) }}"
                        target="_blank" class="btn btn-success rounded-pill">
                        <i class="bi bi-whatsapp"></i> Compartilhar no WhatsApp
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
