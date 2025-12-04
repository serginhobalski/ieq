@extends('layouts.app')

@section('title')
    Avisos e Novidades
@endsection

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-primary mb-0">Mural de Avisos</h2>
                <p class="text-muted">Fique por dentro do que acontece na IEQ.</p>
            </div>

            @if (Auth::user()->role == 'pastor' || Auth::user()->is_admin == 1)
                <a href="{{ route('notices.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-bullhorn"></i><i class="fas fa-plus-circle"></i> Novo Aviso
                </a>                
            @endif
        </div>

        <div class="row">
            @forelse($notices as $notice)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 position-relative notice-card">
                        <!-- Pin visual (opcional) -->
                        <div class="position-absolute top-0 start-50 translate-middle" style="z-index: 10;">
                            <i class="fas fa-thumbtack text-danger fs-3"></i>
                        </div>

                        <div class="card-body pt-4 d-flex flex-column">
                            <!-- Badges -->
                            <div class="mb-2 text-center">
                                @if ($notice->target_audience == 'leaders')
                                    <span class="badge bg-danger text-white">Liderança</span>
                                @elseif($notice->target_audience == 'youth')
                                    <span class="badge bg-danger text-white">Jovens</span>
                                @else
                                    <span class="badge bg-danger text-white">Geral</span>
                                @endif
                            </div>

                            <h5 class="card-title fw-bold text-center text-success mb-3">{{ $notice->title }}</h5>

                            <div class="card-text text-dark flex-grow-1 text-center" style="white-space: pre-wrap;">
                                {{ $notice->content }}
                            </div>

                            <hr class="border-light">

                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <small class="text-dark fst-italic">
                                    Por: {{ $notice->author->name }}
                                </small>

                                @if (Auth::user()->is_admin || Auth::id() == $notice->author_id)
                                    <form action="{{ route('notices.destroy', $notice) }}" method="POST"
                                        onsubmit="return confirm('Retirar aviso?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm text-danger p-0"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                @endif
                            </div>

                            @if ($notice->expires_at)
                                <div class="text-center mt-2">
                                    <small class="text-danger" style="font-size: 0.7rem;">
                                        Expira em: {{ $notice->expires_at->format('d/m/Y') }}
                                    </small>                                    
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted">
                        <i class="bi bi-clipboard-check display-1 opacity-25"></i>
                        <p class="mt-3">Nenhum aviso no mural hoje.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $notices->links() }}
        </div>
    </div>

    <style>
        /* Efeito sutil de "papel" */
        .notice-card {
            background-color: #fff9c4;
            /* Amarelo clarinho tipo post-it */
            transition: transform 0.2s;
        }

        .notice-card:hover {
            transform: translateY(-5px);
        }

        /* Variação de cores aleatórias via CSS nth-child seria legal também */
        .col-md-6:nth-child(even) .notice-card {
            background-color: #e1f5fe;
        }

        /* Azulzinho */
        .col-md-6:nth-child(3n) .notice-card {
            background-color: #fce4ec;
        }

        /* Rosinha */
    </style>
@endsection
