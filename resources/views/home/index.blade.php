<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title>{{ env('APP_NAME') }} | @yield('title')</title>

    <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('') }}assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('icon.png') }}">
    <link rel="manifest" href="{{ asset('') }}assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="{{ asset('icon.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('') }}assets/js/config.js"></script>
    <script src="{{ asset('') }}vendors/simplebar/simplebar.min.js"></script>

    <!-- ===============================================--><!--    Stylesheets--><!-- ===============================================-->
    <link href="{{ asset('') }}vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('') }}vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="{{ asset('') }}assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('') }}assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="{{ asset('') }}assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('') }}assets/css/user.min.css" rel="stylesheet" id="user-style-default">
    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>

<body>
    <!--    Main Content--><!-- ===============================================-->
    <main class="main" id="top">
        <!-- MENU TOPO ========================-->
        <nav class="navbar navbar-standard navbar-expand-lg fixed-top navbar-dark"
            data-navbar-darken-on-scroll="data-navbar-darken-on-scroll">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('logo-taquara.png') }}" width="100" alt="">
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
                    <!-- NAVEGAÇÃO DA PÁGINA -->
                    <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
                        <li class="nav-item"><a class="nav-link" href="#dna" role="button">Nosso DNA</a></li>
                        <li class="nav-item"><a class="nav-link" href="#doutrina" role="button">Doutrina</a></li>
                        <li class="nav-item"><a class="nav-link" href="#missao" role="button">Missão</a></li>
                        <li class="nav-item"><a class="nav-link" href="#programacao" role="button">Cultos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#lema" role="button">Lema</a></li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <!-- MUDANÇA DE TEMA -->
                        <li class="nav-item d-flex align-items-center me-2">
                            <div class="dropdown theme-control-dropdown landing-drop"><a
                                    class="nav-link d-flex align-items-center dropdown-toggle fa-icon-wait pe-1"
                                    href="#" role="button" id="themeSwitchDropdown" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"><span class="d-none d-lg-block"><span
                                            class="fas fa-sun" data-theme-dropdown-toggle-icon="light"></span><span
                                            class="fas fa-moon" data-theme-dropdown-toggle-icon="dark"></span><span
                                            class="fas fa-adjust"
                                            data-theme-dropdown-toggle-icon="auto"></span></span><span
                                        class="d-lg-none">Mudar tema</span></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-caret border py-0 mt-1"
                                    aria-labelledby="themeSwitchDropdown">
                                    <div class="bg-white dark__bg-1000 rounded-2 py-2"><button
                                            class="dropdown-item link-600 d-flex align-items-center gap-2"
                                            type="button" value="light" data-theme-control="theme"><span
                                                class="fas fa-sun"></span>Claro<span
                                                class="fas fa-check dropdown-check-icon ms-auto text-600"></span></button><button
                                            class="dropdown-item link-600 d-flex align-items-center gap-2"
                                            type="button" value="dark" data-theme-control="theme"><span
                                                class="fas fa-moon" data-fa-transform=""></span>Escuro<span
                                                class="fas fa-check dropdown-check-icon ms-auto text-600"></span></button><button
                                            class="dropdown-item link-600 d-flex align-items-center gap-2"
                                            type="button" value="auto" data-theme-control="theme"><span
                                                class="fas fa-adjust" data-fa-transform=""></span>Automático<span
                                                class="fas fa-check dropdown-check-icon ms-auto text-600"></span></button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @guest
                        <!-- AUTENTICAÇÃO -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownLogin" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Entrar
                            </a>
                            <div class="dropdown-menu dropdown-caret dropdown-menu-end dropdown-menu-card"
                                aria-labelledby="navbarDropdownLogin">
                                <div class="card shadow-none navbar-card-login">
                                    <div class="card-body fs-10 p-4 fw-normal">
                                        <div class="row text-start justify-content-between align-items-center mb-2">
                                            <div class="col-auto">
                                                <h5 class="mb-0">Entrar</h5>
                                            </div>
                                            <div class="col-auto">
                                                <p class="fs-10 text-600 mb-0">ou
                                                    <a href="#!" data-bs-toggle="modal"
                                                        data-bs-target="#registerModal">
                                                        Criar uma conta
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <input class="form-control" type="email" name="email"
                                                    placeholder="E-mail" />
                                            </div>
                                            <div class="mb-3">
                                                <input class="form-control" name="password" type="password"
                                                    placeholder="Senha" />
                                            </div>
                                            <div class="row flex-between-center">
                                                <div class="col-auto">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="modal-checkbox" />
                                                        <label class="form-check-label mb-0"
                                                            for="modal-checkbox">Lembrar</label>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <a class="fs-10" href="#">Esqueceu a Senha?</a>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                                    name="submit">Entrar</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- CADASTRO -->
                        <li class="nav-item">
                            <a class="nav-link" href="#!" data-bs-toggle="modal"
                                data-bs-target="#registerModal">
                                Cadastrar
                            </a>
                        </li>
                        @else
                        <!-- PAINEL -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('home') }}">
                                <img src="{{ Auth::user()->avatar_url }}" 
                                    alt="{{ Auth::user()->name }}" 
                                    class="rounded-circle me-2" 
                                    width="40" height="40" 
                                    style="object-fit: cover;">
                            </a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Modal de Cadastro -->
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="row text-start justify-content-between align-items-center mb-2">
                            <div class="col-auto">
                                <h5 id="modalLabel">Cadastrar Usuário</h5>
                            </div>
                            <div class="col-auto">
                                <p class="fs-10 text-600 mb-0">Já possui um conta?
                                    <a href="#">Clique em "Entrar"</a>
                                </p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input name="name" class="form-control" type="text" autocomplete="on" value="{{ old('name') }}"
                                    placeholder="Nome completo" />
                            </div>
                            <div class="mb-3">
                                <input name="username" class="form-control" type="text" autocomplete="on" value="{{ old('username') }}"
                                    placeholder="Nome de usuário" />
                            </div>
                            <div class="mb-3">
                                <input name="email" class="form-control" type="email" autocomplete="on" value="{{ old('email') }}"
                                    placeholder="E-mail" />
                            </div>
                            <div class="mb-3">
                                <input name="phone" class="form-control" type="tel" autocomplete="on" value="{{ old('phone') }}"
                                    placeholder="Telefone" />
                            </div>
                            <div class="mb-3">
                                <input name="address" class="form-control" type="text" autocomplete="on" value="{{ old('address') }}"
                                    placeholder="Endereço completo" />
                            </div>
                            <div class="mb-3">
                                <input name="birth_date" class="form-control" type="date" autocomplete="on" value="{{ old('birth_date') }}"
                                    placeholder="Data de nascimento" />

                                <input name="is_admin"  type="text" value="0" hidden readonly/>
                            </div>
                            <div class="mb-3">
                                <input name="avatar" class="form-control" type="file" autocomplete="on" value="{{ old('avatar_path') }}"
                                    placeholder="Foto de perfil" />
                            </div>
                            <div class="row gx-2">
                                <div class="mb-3 col-sm-6">
                                    <input name="password" class="form-control" type="password" autocomplete="on"
                                        placeholder="Senha" />
                                </div>
                                <div class="mb-3 col-sm-6">
                                    <input name="password_confirmation" class="form-control" type="password"
                                        autocomplete="on" placeholder="Confirmação de Senha" />
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="modal-register-checkbox" />
                                <label class="form-label" for="modal-register-checkbox">
                                    Eu aceito os <a href="#!">termos </a>e <a class="white-space-nowrap"
                                        href="#!">política de privacidade</a>
                                </label>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                    name="submit">Cadastrar
                                </button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================--><!-- <section> begin ============================-->
        <section class="py-0 overflow-hidden" id="banner" data-bs-theme="light">
            <div class="bg-holder overlay"
                style="background-image:url({{ asset('') }}assets/img/generic/bg.jpg);background-position: center bottom;">
            </div><!--/.bg-holder-->
            <div class="container">
                <div class="row flex-center pt-8 pt-lg-10 pb-lg-9 pb-xl-0">
                    <div class="col-md-11 col-lg-8 col-xl-4 pb-7 pb-xl-9 text-center text-xl-start">

                        <h1 class="text-white fw-light">Igreja <span class="typed-text fw-bold"
                                data-typed-text='["viva","atual","acessível","bíblica"]'></span><br />do Evangelho
                            Quadrangular</h1>
                        <p class="lead text-white opacity-75">Existimos para manifestar o reino de Deus e promover o
                            seu crescimento na terra.</p><a
                            class="btn btn-outline-light border-2 rounded-pill btn-lg mt-4 fs-9 py-2"
                            href="#programacao">⏰Programação Semanal<span class="fas fa-play ms-2"
                                data-fa-transform="shrink-6 down-1"></span></a>
                    </div>
                    <div class="col-xl-7 offset-xl-1 align-self-end mt-4 mt-xl-0"><a
                            class="img-landing-banner rounded" href="{{ asset('') }}index.html"><img
                                class="img-fluid d-dark-none" src="{{ asset('') }}assets/img/1501x1669.png"
                                alt="" /><img class="img-fluid d-light-none"
                                src="{{ asset('') }}assets/img/1501x1669.png" alt="" /></a></div>
                </div>
            </div><!-- end of .container-->
        </section>
        <!-- <section> close ============================--><!-- ============================================-->


        <!-- DNA============================================--><!-- <section> begin ============================-->
        <section id="dna" class="bg-body-tertiary dark__bg-opacity-50 text-center">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 class="fs-7 fs-sm-5 fs-md-4"><em>Nosso</em> DNA</h1>
                        {{-- <p class="lead"></p> --}}
                    </div>
                </div>
                <div class="row mt-6">
                    <div class="col-lg-4">
                        <div class="card card-span h-100">
                            <div class="card-span-img"><span class="fas fa-bible fs-5 text-info"></span></div>
                            <div class="card-body pt-6 pb-4">
                                <h5 class="mb-2">Bíblico</h5>
                                <p>A Palavra de Deus é a base de tudo o que cremos, pensamos e fazemos.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-6 mt-lg-0">
                        <div class="card card-span h-100">
                            <div class="card-span-img"><span class="fas fa-calendar-check fs-4 text-success"></span>
                            </div>
                            <div class="card-body pt-6 pb-4">
                                <h5 class="mb-2">Atual</h5>
                                <p>Jesus é o mesmo ontem, hoje e sempre (Hb 4.18) e a nossa igreja deve se conectar com
                                    a geração atual.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-6 mt-lg-0">
                        <div class="card card-span h-100">
                            <div class="card-span-img"><span class="fas fa-users fs-3 text-danger"></span></div>
                            <div class="card-body pt-6 pb-4">
                                <h5 class="mb-2">Acessível</h5>
                                <p>O Reino está ao alcance de todos, independente de idade, gênero ou status social.
                                    TODOS são bem-vindos!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end of .container-->
        </section>
        <!-- <section> close ============================--><!-- ============================================-->

        <!-- == MISSÃO ================================================================================-->
        <section id="missao" class="bg-dark" data-bs-theme="light">
            <div class="bg-holder overlay"
                style="background-image:url({{ asset('') }}assets/img/generic/bg2.jpg);background-position: center top;">
            </div>
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <p class="fs-6 fs-sm-5 text-white">
                        <h2 class="text-white"><strong>Nossa <em>Missão</em> </strong> </h2>
                        <strong class="text-white">ADORAÇÃO</strong> - <em>Amar a Deus</em><br>
                        <strong class="text-white">SERVIÇO</strong> - <em>Amar ao próximo</em><br>
                        <strong class="text-white">EVANGELIZAÇÃO</strong> - <em>Alcançar o perdido</em><br>
                        <strong class="text-white">COMUNHÃO</strong> - <em>Conectar a Cristo e </em><br>
                        <strong class="text-white">DISCIPULADO</strong> - <em>Formar seguidores de Cristo</em><br>
                        </p>
                        {{-- <button
                            class="btn btn-outline-light border-2 rounded-pill btn-lg mt-4 fs-9 py-2"
                            type="button">Start your webapp</button> --}}
                    </div>
                </div>
            </div><!-- end of .container-->
        </section>
        <!-- <section> close ============================--><!-- ============================================-->

        <!-- ============================================--><!-- <section> begin ============================-->
        <section id="programacao">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8 col-xl-7 col-xxl-6">
                        <h1 class="fs-7 fs-sm-5 fs-md-4">Programação Semanal</h1>
                        <p class="lead">A semana na Quadrangular Taquara.</p>
                    </div>
                </div>
                <div class="row flex-center mt-8">
                    <div class="col-md col-lg-5 col-xl-4 ps-lg-6"><img class="img-fluid px-6 px-md-0"
                            src="{{ asset('') }}assets/img/icons/1.png" alt="" />
                    </div>
                    <div class="col-md col-lg-5 col-xl-4 mt-0 mt-md-0">
                        <h5 class="text-danger"><span class="far fa-clock me-2"></span>08H30</h5>
                        <h3>Segunda a Sexta </h3>
                        <p>Reunião de oração, louvor e adoração.</p>
                        <p>Local: Rua Nacional, 618, Taquara.</p>
                    </div>
                </div>
                <div class="row flex-center mt-7">
                    <div class="col-md col-lg-5 col-xl-4 pe-lg-6 order-md-2"><img class="img-fluid px-6 px-md-0"
                            src="{{ asset('') }}assets/img/icons/2.png" alt="" />
                    </div>
                    <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
                        <h5 class="text-danger"> <span class="far fa-clock me-2"></span>16H</h5>
                        <h3>Segunda</h3>
                        <p>"Por esta causa me coloco de joelhos..." - Reunião de oração e intercessão.</p>
                        <p>Local: Rua Nacional, 618, Taquara.</p>
                    </div>
                </div>
                <div class="row flex-center mt-7">
                    <div class="col-md col-lg-5 col-xl-4 ps-lg-6"><img class="img-fluid px-6 px-md-0"
                            src="{{ asset('') }}assets/img/icons/3.png" alt="" />
                    </div>
                    <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
                        <h5 class="text-success"><span class="far fa-clock me-2"></span>20H45</h5>
                        <h3>Terça & Quarta<span class="badge rounded-pill bg-danger">Live YouTube</span></h3>
                        <p>*Terça | 20:45 - Live de oração e intercessão. <br>
                            *Quarta | 20:45 - (Live) Escola de Vencedores. <br>
                            <strong>OBS:</strong>Lives transmitidas semanalmente no YouTube, no <a
                                href="https://www.youtube.com/@quadrangulartaquara" target="_blank"><span
                                    class="badge rounded-pill bg-danger">Canal Quadrangular Taquara</span></a>
                        </p>
                    </div>
                </div>
                <div class="row flex-center mt-7">
                    <div class="col-md col-lg-5 col-xl-4 pe-lg-6 order-md-2"><img class="img-fluid px-6 px-md-0"
                            src="{{ asset('') }}assets/img/icons/4.png" alt="" />
                    </div>
                    <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
                        <h5 class="text-danger"> <span class="far fa-clock me-2"></span>19H30</h5>
                        <h3>Sexta</h3>
                        <p>Sexta Profética. Dia de unção, </p>
                        <p>Local: Rua Nacional, 618, Taquara.</p>
                    </div>
                </div>
                <div class="row flex-center mt-7">
                    <div class="col-md col-lg-5 col-xl-4 ps-lg-6"><img class="img-fluid px-6 px-md-0"
                            src="{{ asset('') }}assets/img/icons/5.png" alt="" />
                    </div>
                    <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
                        <h5 class="text-success"><span class="far fa-clock me-2"></span>08H, 09H30</h5>
                        <h3>Domingo</h3>
                        <p>
                            *08H00 - Escola Bíliba <br>
                            *09H30 - Culto da Família.
                        </p>
                    </div>
                </div>
            </div><!-- end of .container-->
        </section>
        <!-- <section> close ============================--><!-- ============================================-->

        <!-- DOUTRINA============================================--><!-- <section> begin ============================-->
        <section id="doutrina" class="bg-200 text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <h1 class="fs-7 fs-sm-5 fs-md-4"><em>Nossa</em> Doutrina</h1>
                    <div class="col-lg-9 col-xl-8">
                        <div class="swiper theme-slider"
                            data-swiper='{"autoplay":true,"spaceBetween":5,"loop":true,"loopedSlides":5,"slideToClickedSlide":true}'>

                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="px-5 px-sm-6">
                                        <p class="fs-sm-8 fs-md-7 fst-italic text-1100">
                                            Jesus Salva
                                        </p>
                                        <p class="fs-9 text-600">- Doutrina Quadrangular</p>
                                        <i class="fas fa-cross fa-3x w-auto mx-auto text-danger"></i>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="px-5 px-sm-6">
                                        <p class="fs-sm-8 fs-md-7 fst-italic text-1100">
                                            Jesus Cura
                                        </p>
                                        <p class="fs-9 text-600">- Doutrina Quadrangular</p>
                                        <i class="fas fa-glass-martini fa-3x w-auto mx-auto text-info"></i>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="px-5 px-sm-6">
                                        <p class="fs-sm-8 fs-md-7 fst-italic text-1100">
                                            Jesus Batiza no E. Santo
                                        </p>
                                        <p class="fs-9 text-600">- Doutrina Quadrangular</p>
                                        <i class="fas fa-dove fa-3x w-auto mx-auto text-warning"></i>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="px-5 px-sm-6">
                                        <p class="fs-sm-8 fs-md-7 fst-italic text-1100">
                                            Jesus Voltará
                                        </p>
                                        <p class="fs-9 text-600">- Doutrina Quadrangular</p>
                                        <i class="fas fa-crown fa-3x w-auto mx-auto text-purple"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="swiper-nav">
                                <div class="swiper-button-next swiper-button-white"></div>
                                <div class="swiper-button-prev swiper-button-white"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end of .container-->
        </section>
        <!-- <section> close ============================--><!-- ============================================-->

        <!-- == LEMA ================================================================================-->
        <section id="lema" class="bg-dark" data-bs-theme="light">
            <div class="bg-holder overlay"
                style="background-image:url({{ asset('') }}assets/img/generic/bg1.jpg);background-position: center top;">
            </div>
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8">
                        <p class="fs-6 fs-sm-5 text-white">
                            Jesus Cristo é o mesmo ontem, hoje e para sempre. <br>
                        <h2 class="text-white">Hebreus 13:8</h2>
                        </p>
                        {{-- <button
                            class="btn btn-outline-light border-2 rounded-pill btn-lg mt-4 fs-9 py-2"
                            type="button">Start your webapp</button> --}}
                    </div>
                </div>
            </div><!-- end of .container-->
        </section>
        <!-- <section> close ============================--><!-- ============================================-->



        <!-- ============================================--><!-- <section> begin ============================-->
        <section class="bg-dark pt-8 pb-4" data-bs-theme="light">
            <div class="container">
                <div class="position-absolute btn-back-to-top bg-dark"><a class="text-600" href="#banner"
                        data-bs-offset-top="0"><span class="fas fa-chevron-up"
                            data-fa-transform="rotate-45"></span></a></div>
                <div class="row">
                    <div class="col-lg-12">
                        <img src="{{ asset('logo-taquara.png') }}" width="200" alt="">
                        <h5 class="text-uppercase text-white opacity-85 mb-3">Lugar de comunhão</h5>
                        <p class="text-600">Existimos para manifestar o reino de Deus e promover o seu crescimento na
                            terra.</p>
                        <div class="icon-group mt-4">
                            <a class="icon-item bg-white text-facebook" href="#!">
                                <span class="fab fa-facebook"></span>
                            </a>
                            <a class="icon-item bg-white text-instagram" href="#!">
                                <span class="fab fa-instagram"></span>
                            </a>
                            <a class="icon-item bg-white text-youtube" href="#!">
                                <span class="fab fa-youtube"></span>
                            </a>
                            <a class="icon-item bg-white text-whatsapp" href="#!">
                                <span class="fab fa-whatsapp"></span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- <section> close ============================--><!-- ============================================-->



        <!-- ============================================--><!-- <section> begin ============================-->
        <section class="py-0 bg-dark" data-bs-theme="light">
            <div>
                <hr class="my-0 text-600 opacity-25" />
                <div class="container py-3">
                    <div class="row justify-content-between fs-10">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600 opacity-85">Igreja do Evangelho Quadrangular <span
                                    class="d-none d-sm-inline-block">| </span><br class="d-sm-none" />
                                {{ date('Y') }} &copy; <a class="text-white opacity-85"
                                    href="https://quadrangulartaquara.org.br">IEQ Taquara</a></p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600 opacity-85">{{ date('d/m/Y - H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div><!-- end of .container-->
        </section>
        <!-- <section> close ============================--><!-- ============================================-->

        <div class="modal fade" id="authentication-modal" tabindex="-1" role="dialog"
            aria-labelledby="authentication-modal-label" aria-hidden="true">
            <div class="modal-dialog mt-6" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                        <div class="position-relative z-1">
                            <h4 class="mb-0 text-white" id="authentication-modal-label">Register</h4>
                            <p class="fs-10 mb-0 text-white">Please create your free Falcon account</p>
                        </div>
                        <div data-bs-theme="dark"><button class="btn-close position-absolute top-0 end-0 mt-2 me-2"
                                data-bs-dismiss="modal" aria-label="Close"></button></div>
                    </div>
                    <div class="modal-body py-4 px-5">
                        <form>
                            <div class="mb-3"><label class="form-label" for="modal-auth-name">Name</label><input
                                    class="form-control" type="text" autocomplete="on" id="modal-auth-name" />
                            </div>
                            <div class="mb-3"><label class="form-label" for="modal-auth-email">Email
                                    address</label><input class="form-control" type="email" autocomplete="on"
                                    id="modal-auth-email" /></div>
                            <div class="row gx-2">
                                <div class="mb-3 col-sm-6"><label class="form-label"
                                        for="modal-auth-password">Password</label><input class="form-control"
                                        type="password" autocomplete="on" id="modal-auth-password" /></div>
                                <div class="mb-3 col-sm-6"><label class="form-label"
                                        for="modal-auth-confirm-password">Confirm Password</label><input
                                        class="form-control" type="password" autocomplete="on"
                                        id="modal-auth-confirm-password" /></div>
                            </div>
                            <div class="form-check"><input class="form-check-input" type="checkbox"
                                    id="modal-auth-register-checkbox" /><label class="form-label"
                                    for="modal-auth-register-checkbox">I accept the <a href="#!">terms </a>and <a
                                        class="white-space-nowrap" href="#!">privacy policy</a></label></div>
                            <div class="mb-3"><button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                    name="submit">Register</button></div>
                        </form>
                        <div class="position-relative mt-5">
                            <hr />
                            <div class="divider-content-center">or register with</div>
                        </div>
                        <div class="row g-2 mt-2">
                            <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100"
                                    href="#"><span class="fab fa-google-plus-g me-2"
                                        data-fa-transform="grow-8"></span> google</a></div>
                            <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100"
                                    href="#"><span class="fab fa-facebook-square me-2"
                                        data-fa-transform="grow-8"></span> facebook</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===============================================--><!--    End of Main Content--><!-- ===============================================-->


    <!-- ===============================================--><!--    JavaScripts--><!-- ===============================================-->
    <script src="{{ asset('') }}vendors/popper/popper.min.js"></script>
    <script src="{{ asset('') }}vendors/bootstrap/bootstrap.min.js"></script>
    <script src="{{ asset('') }}vendors/anchorjs/anchor.min.js"></script>
    <script src="{{ asset('') }}vendors/is/is.min.js"></script>
    <script src="{{ asset('') }}vendors/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('') }}vendors/typed.js/typed.umd.js"></script>
    <script src="{{ asset('') }}vendors/fontawesome/all.min.js"></script>
    <script src="{{ asset('') }}vendors/lodash/lodash.min.js"></script>
    <script src="{{ asset('') }}vendors/list.js/list.min.js"></script>
    <script src="{{ asset('') }}assets/js/theme.js"></script>
</body>

</html>
