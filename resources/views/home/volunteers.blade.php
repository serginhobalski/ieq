@extends('layouts.app')


@section('title')
    Voluntariado
@endsection


@section('styles')
@endsection


@section('content')
    <div class="carousel slide" id="carouselExampleCaptions" data-ride="carousel">
        <div class="carousel-indicators"><button class="active" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide-to="0" aria-current="true" aria-label="Slide 1"></button><button type="button"
                data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button><button
                type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner rounded-1" data-bs-theme="light">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('assets/img/generic/volunt1.jpg')}}"
                    alt="First slide" />
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-white">Transforme Vidas (a Sua Incluída)</h5>
                    <p>O voluntariado na igreja é mais do que fazer tarefas; é sobre ser um instrumento de amor e mudança. Descubra o impacto real de dedicar seu tempo.</p>
                </div>
            </div>
            <div class="carousel-item"><img class="d-block w-100" src="{{asset('assets/img/generic/volunt2.jpg')}}" alt="Second slide" />
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-white">Deus Precisa dos Seus Talentos. Seja a Resposta!</h5>
                    <p>Todos temos dons únicos. Não importa se é organizar, ensinar ou acolher, seu serviço é essencial para a obra d'Ele.</p>
                </div>
            </div>
            <div class="carousel-item"><img class="d-block w-100" src="{{asset('assets/img/generic/volunt3.jpg')}}"
                    alt="Third slide" />
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-white">Seu Lugar é Aqui. Conecte-se com Propósito.</h5>
                    <p>Voluntariar é o coração da nossa comunidade. Junte-se a nós para construir laços de fé e amizade enquanto servimos juntos.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>
@endsection


@section('scripts')
@endsection
