<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================--><!--    Document Title--><!-- ===============================================-->
    <title>IEQ | @yield('title')</title>

    <!-- ===============================================--><!--    Favicons--><!-- ===============================================-->

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icon.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('icon.png') }}">
    <link rel="manifest" href="{{ asset('') }}assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="{{ asset('') }}assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('') }}assets/js/config.js"></script>
    <script src="{{ asset('') }}vendors/simplebar/simplebar.min.js"></script>

    <!-- ===============================================--><!--    Stylesheets--><!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="{{ asset('') }}vendors/flatpickr/flatpickr.min.css" rel="stylesheet">
    <link href="{{ asset('') }}vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="{{ asset('') }}vendors/prism/prism-okaidia.css" rel="stylesheet">
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
    <!-- Scripts 'resources/sass/app.scss',  -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <!-- =======--><!--    Main Content--><!--=======================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>
            <!-- MENU TOPO =======-->
            <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg"
                data-double-top-nav="data-double-top-nav" style="display: none;">
                <div class="w-100">
                    <div class="d-flex flex-between-center">
                        <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#navbarDoubleTop" aria-controls="navbarDoubleTop"
                            aria-expanded="false" aria-label="Toggle Navigation">
                            <span class="navbar-toggle-icon">
                                <span class="toggle-line"></span>
                            </span>
                        </button>
                        <a class="navbar-brand me-1 me-sm-3" href="#">
                            <div class="d-flex align-items-center">
                                <img class="me-2" src="{{ asset('logo-taquara.png') }}" alt width="120" />
                            </div>
                        </a>
                        <ul class="navbar-nav align-items-center d-none d-lg-block">
                            <li class="nav-item"></li>
                        </ul>
                        <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                            <!-- tema =======-->
                            <li class="nav-item ps-2 pe-0">
                                <div class="dropdown theme-control-dropdown">
                                    <a class="nav-link d-flex align-items-center dropdown-toggle fa-icon-wait fs-9 pe-1 py-0"
                                        href="#" role="button" id="themeSwitchDropdown" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <span class="fas fa-sun fs-7" data-fa-transform="shrink-2"
                                            data-theme-dropdown-toggle-icon="light"></span>
                                        <span class="fas fa-moon fs-7" data-fa-transform="shrink-3"
                                            data-theme-dropdown-toggle-icon="dark"></span>
                                        <span class="fas fa-adjust fs-7" data-fa-transform="shrink-2"
                                            data-theme-dropdown-toggle-icon="auto"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-caret border py-0 mt-3"
                                        aria-labelledby="themeSwitchDropdown">
                                        <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                            <button class="dropdown-item d-flex align-items-center gap-2"
                                                type="button" value="light" data-theme-control="theme">
                                                <span class="fas fa-sun"></span>
                                                Light
                                                <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                            </button>
                                            <button class="dropdown-item d-flex align-items-center gap-2"
                                                type="button" value="dark" data-theme-control="theme">
                                                <span class="fas fa-moon" data-fa-transform></span>
                                                Dark
                                                <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                            </button>
                                            <button class="dropdown-item d-flex align-items-center gap-2"
                                                type="button" value="auto" data-theme-control="theme">
                                                <span class="fas fa-adjust" data-fa-transform></span>
                                                Auto
                                                <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- notificações =======-->
                            <li class="nav-item dropdown">
                                <a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait"
                                    id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false"
                                    data-hide-on-body-scroll="data-hide-on-body-scroll">
                                    <span class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;">
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg"
                                    aria-labelledby="navbarDropdownNotification">
                                    <div class="card card-notification shadow-none">
                                        <div class="card-header">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-auto">
                                                    <h6 class="card-header-title mb-0">Notificações</h6>
                                                </div>
                                                <div class="col-auto ps-0 ps-sm-3">
                                                    <a class="card-link fw-normal" href="#">
                                                        Marcar todas como lidas
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="scrollbar-overlay" style="max-height:19rem">
                                            <div class="list-group list-group-flush fw-normal fs-10">
                                                <div class="list-group-title border-bottom">NEW</div>
                                                <div class="list-group-item">
                                                    <a class="notification notification-flush notification-unread"
                                                        href="#!">
                                                        <div class="notification-avatar">
                                                            <div class="avatar avatar-2xl me-3">
                                                                <img class="rounded-circle"
                                                                    src="{{asset('')}}assets/img/team/1-thumb.png" 
                                                                    alt />
                                                            </div>
                                                        </div>
                                                        <div class="notification-body">
                                                            <p class="mb-1">
                                                                <strong>Maria Exemplo</strong>
                                                                respondeu ao seu comentário:
                                                                "Hello! 😍"
                                                            </p>
                                                            <span class="notification-time">
                                                                <span class="me-2" role="img"
                                                                    aria-label="Emoji">💬
                                                                </span>
                                                                Agora
                                                            </span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="list-group-item">
                                                    <a class="notification notification-flush notification-unread"
                                                        href="#!">
                                                        <div class="notification-avatar">
                                                            <div class="avatar avatar-2xl me-3">
                                                                <div class="avatar-name rounded-circle">
                                                                    <span>FQ</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="notification-body">
                                                            <p class="mb-1">
                                                                <strong>Fulaninho Qualquer</strong>
                                                                resposdeu ao status:
                                                                <strong>Fulaninha</strong>
                                                            </p>
                                                            <span class="notification-time">
                                                                <span class="me-2 fab fa-gratipay text-danger">
                                                                </span>
                                                                9hr
                                                            </span>
                                                        </div>
                                                    </a>
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="card-footer text-center border-top">
                                            <a class="card-link d-block" href="#">
                                                Ver tudo
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- usuário =======-->
                            <li class="nav-item dropdown">
                                <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="avatar avatar-xl">
                                        <img class="rounded-circle" src="{{ Auth::user()->avatar_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                                    aria-labelledby="navbarDropdownUser">
                                    <div class="bg-white dark__bg-1000 rounded-2 py-2">

                                        <center>
                                            <span class="fw-bold text-warning text-center">
                                                {{ Auth::user()->name }}
                                            </span>
                                        </center>

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="{{ route('home') }}">
                                            <i class="fas fa-house-user"></i> Meu Painel
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="{{ route('profile') }}">
                                            <i class="fas fa-id-card-alt"></i> Perfil
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> Sair
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <hr class="my-2 d-none d-lg-block" />
                    <div class="collapse navbar-collapse scrollbar py-lg-2" id="navbarDoubleTop">
                        <!-- navegação =======-->
                        <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
                            <!-- =======-->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Painel</a>
                            </li>
                            <!--  -->
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" id="apps">App</a>
                                <div class="dropdown-menu dropdown-caret dropdown-menu-card border-0 mt-0"
                                    aria-labelledby="apps">
                                    <div class="card navbar-card-app shadow-none dark__bg-1000">
                                        <div class="card-body scrollbar max-h-dropdown"><img class="img-dropdown"
                                                src="{{ asset('') }}assets/img/icons/spot-illustrations/authentication-corner.png"
                                                width="130" alt />
                                            <div class="row">
                                                <div class="col-6 col-md-4">
                                                    <div class="nav flex-column">
                                                        <a class="nav-link py-1 link-600 fw-medium" href="#">
                                                            Eventos
                                                        </a>
                                                        <a class="nav-link py-1 link-600 fw-medium"
                                                            title="Grupos de Comunhão" href="#">
                                                            GC's
                                                        </a>
                                                        <a class="nav-link py-1 link-600 fw-medium" href="#">
                                                            Voluntariado
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="nav flex-column">
                                                        <p class="nav-link text-700 mb-0 fw-bold">Ensino</p>
                                                        <a class="nav-link py-1 link-600 fw-medium"
                                                            href="#">DEBQ</a>
                                                        <a class="nav-link py-1 link-600 fw-medium"
                                                            href="#">Trilho</a>
                                                        <a class="nav-link py-1 link-600 fw-medium"
                                                            href="#">Devocional</a>

                                                        <p class="nav-link text-700 mb-0 fw-bold">Interação</p>
                                                        <a class="nav-link py-1 link-600 fw-medium"
                                                            href="#">Chat</a>
                                                        <a class="nav-link py-1 link-600 fw-medium"
                                                            href="#">Pedidos de Oração</a>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4">
                                                    <div class="nav flex-column">
                                                        <a class="nav-link py-1 link-600 fw-medium" href="#">
                                                            Bíblia
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
                <script>
                    var navbarStyle = localStorage.getItem("navbarStyle");
                    if (navbarStyle && navbarStyle !== 'transparent') {
                        document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
                    }
                </script>
                <div class="d-flex align-items-center">
                    <div class="toggle-icon-wrapper">
                        <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle"
                            data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation">
                            <span class="navbar-toggle-icon">
                                <span class="toggle-line"></span>
                            </span>
                        </button>
                    </div>
                    <!--  branding =======-->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <div class="d-flex align-items-center py-3">
                            <img class="me-2" src="{{ asset('logo-taquara.png') }}" alt width="120" />
                        </div>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                    <div class="navbar-vertical-content scrollbar">
                        <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                            <!-- navegação PRINCIPAL =======-->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <span class="fas fa-house-user"></span>
                                        </span>
                                        <span class="nav-link-text ps-1">Painel</span>
                                    </div>
                                </a>

                            </li>
                            <!-- Painel ADMIN =======-->
                            @if (Auth::user()->is_admin == true)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}" role="button">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-icon">
                                                <span class="fas fa-cogs"></span>
                                            </span>
                                            <span class="nav-link-text ps-1">Painel Admin</span>
                                        </div>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <!-- APP =======-->
                                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                    <div class="col-auto navbar-vertical-label">App</div>
                                    <div class="col ps-0">
                                        <hr class="mb-0 navbar-vertical-divider" />
                                    </div>
                                </div>
                                <a class="nav-link" href="{{ route('events') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-calendar-alt"></span></span>
                                        <span class="nav-link-text ps-1">Eventos</span>
                                    </div>
                                </a>
                                <a class="nav-link" href="{{ route('groups.index') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-share-alt"></span></span>
                                        <span class="nav-link-text ps-1">Grupos de Comunhão</span>
                                    </div>
                                </a>
                                <a class="nav-link" href="{{ route('volunteers') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-people-carry"></span></span>
                                        <span class="nav-link-text ps-1">Voluntariado</span>
                                    </div>
                                </a>
                                <a class="nav-link" href="{{ route('bible.index') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-bible"></span></span>
                                        <span class="nav-link-text ps-1">Bíblia<span
                                                class="badge rounded-pill ms-2 badge-subtle-success">App</span></span>
                                    </div>
                                </a>

                                <!-- Ensino =======-->
                                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                    <div class="col-auto navbar-vertical-label">Ensino</div>
                                    <div class="col ps-0">
                                        <hr class="mb-0 navbar-vertical-divider" />
                                    </div>
                                </div>
                                <a class="nav-link" href="{{ route('debq') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-book"></span></span>
                                        <span class="nav-link-text ps-1">DEBQ</span>
                                    </div>
                                </a>
                                <a class="nav-link" href="{{ route('trilho') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-subway"></span></span>
                                        <span class="nav-link-text ps-1">Trilho</span>
                                    </div>
                                </a>
                                <a class="nav-link" href="{{ route('devotionals') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-book-reader"></span></span>
                                        <span class="nav-link-text ps-1">Deocionais</span>
                                    </div>
                                </a>

                                <!-- Interação =======-->
                                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                    <div class="col-auto navbar-vertical-label">Interação</div>
                                    <div class="col ps-0">
                                        <hr class="mb-0 navbar-vertical-divider" />
                                    </div>
                                </div>
                                <a class="nav-link" href="{{ route('chat.index') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-comments"></span></span>
                                        <span class="nav-link-text ps-1">Chat IEQ</span>
                                    </div>
                                </a>
                                <a class="nav-link" href="{{ route('prayers.index') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon"><span class="fas fa-pray"></span></span>
                                        <span class="nav-link-text ps-1">Pedidos de Oração</span>
                                    </div>
                                </a>

                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;">
                <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard"
                    aria-expanded="false" aria-label="Toggle Navigation">
                    <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
                </button>
                <!-- branding =======-->
                <a class="navbar-brand me-1 me-sm-3" href="#">
                    <div class="d-flex align-items-center">
                        <img class="me-2" src="{{ asset('logo-taquara.png') }}" alt width="120" />
                    </div>
                </a>
                <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
                    <!-- navegação =======-->
                    <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
                    </ul>
                </div>
                <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                    <!-- Botão tema -->
                    <li class="nav-item ps-2 pe-0">
                        <div class="dropdown theme-control-dropdown">
                            <a class="nav-link d-flex align-items-center dropdown-toggle fa-icon-wait fs-9 pe-1 py-0"
                                href="#" role="button" id="themeSwitchDropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="fas fa-sun fs-7" data-fa-transform="shrink-2"
                                    data-theme-dropdown-toggle-icon="light"></span>
                                <span class="fas fa-moon fs-7" data-fa-transform="shrink-3"
                                    data-theme-dropdown-toggle-icon="dark"></span>
                                <span class="fas fa-adjust fs-7" data-fa-transform="shrink-2"
                                    data-theme-dropdown-toggle-icon="auto"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-caret border py-0 mt-3"
                                aria-labelledby="themeSwitchDropdown">
                                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                    <button class="dropdown-item d-flex align-items-center gap-2" type="button"
                                        value="light" data-theme-control="theme">
                                        <span class="fas fa-sun"></span>Light<span
                                            class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                    </button>
                                    <button class="dropdown-item d-flex align-items-center gap-2" type="button"
                                        value="dark" data-theme-control="theme">
                                        <span class="fas fa-moon" data-fa-transform></span>
                                        Dark<span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                    </button>
                                    <button class="dropdown-item d-flex align-items-center gap-2" type="button"
                                        value="auto" data-theme-control="theme">
                                        <span class="fas fa-adjust" data-fa-transform></span>
                                        Auto<span
                                            class="fas fa-check dropdown-check-icon ms-auto text-600"></span></button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Notificações -->
                    <li class="nav-item dropdown">
                        <a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait"
                            id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"
                            data-hide-on-body-scroll="data-hide-on-body-scroll"><span class="fas fa-bell"
                                data-fa-transform="shrink-6" style="font-size: 33px;"></span></a>
                        <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg"
                            aria-labelledby="navbarDropdownNotification">
                            <div class="card card-notification shadow-none">
                                <div class="card-header">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h6 class="card-header-title mb-0">Notificações</h6>
                                        </div>
                                        <div class="col-auto ps-0 ps-sm-3">
                                            <a class="card-link fw-normal" href="#">
                                                Marcar todas como lidas
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="scrollbar-overlay" style="max-height:19rem">
                                    <div class="list-group list-group-flush fw-normal fs-10">
                                        <div class="list-group-title border-bottom">NEW</div>
                                        <div class="list-group-item">
                                            <a class="notification notification-flush notification-unread"
                                                href="#!">
                                                <div class="notification-avatar">
                                                    <div class="avatar avatar-2xl me-3">
                                                        <img class="rounded-circle"
                                                            src="{{ asset('') }}assets/img/team/1-thumb.png"
                                                            alt />
                                                    </div>
                                                </div>
                                                <div class="notification-body">
                                                    <p class="mb-1">
                                                        <strong>Mariazinha Exemplo</strong>
                                                        respondeu ao seu:
                                                        "Olá, pessoal! 😍"
                                                    </p>
                                                    <span class="notification-time">
                                                        <span class="me-2" role="img" aria-label="Emoji">
                                                            💬
                                                        </span>Agora
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center border-top">
                                    <a class="card-link d-block" href="#">
                                        Ver todos
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Usuário -->
                    <li class="nav-item dropdown">
                        <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-xl">
                                <img class="rounded-circle" src="{{ Auth::user()->avatar_url }}"
                                    alt="{{ explode(' ', Auth::user()->name)[0] }}" />
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                            aria-labelledby="navbarDropdownUser">
                            <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                <center>
                                    <span class="text-warning text-center">{{ Auth::user()->name }}</span>
                                </center>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('home')}}">
                                    <i class="fas fa-house-user"></i> Meu Painel
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('profile')}}">
                                    <i class="fas fa-id-card-alt"></i> Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('logout')}}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>

                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="content">
                <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="display: none;">
                    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                        aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
                        <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
                    </button>
                    <!-- branding =======-->
                    <a class="navbar-brand me-1 me-sm-3" href="#">
                        <div class="d-flex align-items-center">
                            <img class="me-2" src="{{ asset('logo-taquara.png') }}" alt width="120" />
                        </div>
                    </a>
                    <ul class="navbar-nav align-items-center d-none d-lg-block">
                        <li class="nav-item"></li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                        <!-- tema =======-->
                        <li class="nav-item ps-2 pe-0">
                            <div class="dropdown theme-control-dropdown">
                                <a class="nav-link d-flex align-items-center dropdown-toggle fa-icon-wait fs-9 pe-1 py-0"
                                    href="#" role="button" id="themeSwitchDropdown" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-sun fs-7" data-fa-transform="shrink-2"
                                        data-theme-dropdown-toggle-icon="light"></span>
                                    <span class="fas fa-moon fs-7" data-fa-transform="shrink-3"
                                        data-theme-dropdown-toggle-icon="dark"></span>
                                    <span class="fas fa-adjust fs-7" data-fa-transform="shrink-2"
                                        data-theme-dropdown-toggle-icon="auto"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-caret border py-0 mt-3"
                                    aria-labelledby="themeSwitchDropdown">
                                    <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                        <button class="dropdown-item d-flex align-items-center gap-2" type="button"
                                            value="light" data-theme-control="theme">
                                            <span class="fas fa-sun"></span>
                                            Light
                                            <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                        </button>
                                        <button class="dropdown-item d-flex align-items-center gap-2" type="button"
                                            value="dark" data-theme-control="theme">
                                            <span class="fas fa-moon" data-fa-transform></span>
                                            Dark
                                            <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                        </button>
                                        <button class="dropdown-item d-flex align-items-center gap-2" type="button"
                                            value="auto" data-theme-control="theme">
                                            <span class="fas fa-adjust" data-fa-transform></span>
                                            Auto
                                            <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- notificações?? =======-->
                        <li class="nav-item dropdown">
                            <a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait"
                                id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"
                                data-hide-on-body-scroll="data-hide-on-body-scroll">
                                <span class="fas fa-bell" data-fa-transform="shrink-6"
                                    style="font-size: 33px;"></span>
                            </a>
                            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg"
                                aria-labelledby="navbarDropdownNotification">
                                <div class="card card-notification shadow-none">
                                    <div class="card-header">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <h6 class="card-header-title mb-0">Notificações</h6>
                                            </div>
                                            <div class="col-auto ps-0 ps-sm-3">
                                                <a class="card-link fw-normal" href="#">
                                                    Marcar tudo como visto
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="scrollbar-overlay" style="max-height:19rem">
                                        <div class="list-group list-group-flush fw-normal fs-10">
                                            <div class="list-group-title border-bottom">NEW</div>
                                            <div class="list-group-item">
                                                <a class="notification notification-flush notification-unread"
                                                    href="#!">
                                                    <div class="notification-avatar">
                                                        <div class="avatar avatar-2xl me-3">
                                                            <img class="rounded-circle"
                                                                src="{{ asset('') }}assets/img/team/1-thumb.png"
                                                                alt />
                                                        </div>
                                                    </div>
                                                    <div class="notification-body">
                                                        <p class="mb-1">
                                                            <strong>Maria Exemplo</strong>
                                                            respondeu ao seu:
                                                            "Olá, pessoal!😍"
                                                        </p>
                                                        <span class="notification-time">
                                                            <span class="me-2" role="img" aria-label="Emoji">💬
                                                            </span>Agora
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center border-top">
                                        <a class="card-link d-block" href="#">
                                            Ver tudo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- usuário =======-->
                        <li class="nav-item dropdown">
                            <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-xl">
                                    <img class="rounded-circle" src="{{ Auth::user()->avatar_url }}"
                                        alt="{{ explode(' ', Auth::user()->name)[0] }}" />
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                                aria-labelledby="navbarDropdownUser">
                                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                    <center>
                                        <span class="text-warning text-center">{{ Auth::user()->name }}</span>
                                    </center>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        <i class="fas fa-house-user"></i> Meu Painel
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fas fa-id-card-alt"></i> Perfil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Sair
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>

                <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;"
                    data-move-target="#navbarVerticalNav" data-navbar-top="combo">
                    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                        aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
                        <span class="navbar-toggle-icon">
                            <span class="toggle-line"></span>
                        </span>
                    </button>
                    <!-- branding =======-->
                    <a class="navbar-brand me-1 me-sm-3" href="#">
                        <div class="d-flex align-items-center">
                            <img class="me-2" src="{{ asset('logo-taquara.png') }}" alt width="120" />
                        </div>
                    </a>

                    <!-- navegação =======-->
                    <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
                        <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
                        </ul>
                    </div>

                    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                        <!-- tema =======-->
                        <li class="nav-item ps-2 pe-0">
                            <div class="dropdown theme-control-dropdown">
                                <a class="nav-link d-flex align-items-center dropdown-toggle fa-icon-wait fs-9 pe-1 py-0"
                                    href="#" role="button" id="themeSwitchDropdown" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-sun fs-7" data-fa-transform="shrink-2"
                                        data-theme-dropdown-toggle-icon="light">
                                    </span>
                                    <span class="fas fa-moon fs-7" data-fa-transform="shrink-3"
                                        data-theme-dropdown-toggle-icon="dark">
                                    </span>
                                    <span class="fas fa-adjust fs-7" data-fa-transform="shrink-2"
                                        data-theme-dropdown-toggle-icon="auto">
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-caret border py-0 mt-3"
                                    aria-labelledby="themeSwitchDropdown">
                                    <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                        <button class="dropdown-item d-flex align-items-center gap-2" type="button"
                                            value="light" data-theme-control="theme">
                                            <span class="fas fa-sun"></span>
                                            Light
                                            <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                        </button>
                                        <button class="dropdown-item d-flex align-items-center gap-2" type="button"
                                            value="dark" data-theme-control="theme">
                                            <span class="fas fa-moon" data-fa-transform></span>
                                            Dark
                                            <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                        </button>
                                        <button class="dropdown-item d-flex align-items-center gap-2" type="button"
                                            value="auto" data-theme-control="theme">
                                            <span class="fas fa-adjust" data-fa-transform></span>
                                            Auto
                                            <span class="fas fa-check dropdown-check-icon ms-auto text-600"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- notificações =======-->
                        <li class="nav-item dropdown">
                            <a class="nav-link notification-indicator notification-indicator-primary px-0 fa-icon-wait"
                                id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"
                                data-hide-on-body-scroll="data-hide-on-body-scroll">
                                <span class="fas fa-bell" data-fa-transform="shrink-6"
                                    style="font-size: 33px;"></span>
                            </a>
                            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg"
                                aria-labelledby="navbarDropdownNotification">
                                <div class="card card-notification shadow-none">
                                    <div class="card-header">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto">
                                                <h6 class="card-header-title mb-0">Notificações</h6>
                                            </div>
                                            <div class="col-auto ps-0 ps-sm-3">
                                                <a class="card-link fw-normal" href="#">
                                                    Marcar todas como vistas
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="scrollbar-overlay" style="max-height:19rem">
                                        <div class="list-group list-group-flush fw-normal fs-10">
                                            <div class="list-group-title border-bottom">NEW</div>

                                            <!-- Exemplo de notificação -->
                                            <div class="list-group-item">
                                                <a class="notification notification-flush notification-unread"
                                                    href="#!">
                                                    <div class="notification-avatar">
                                                        <div class="avatar avatar-2xl me-3">
                                                            <img class="rounded-circle"
                                                                src="{{asset('assets/img/team/1-thumb.png')}}" alt />
                                                        </div>
                                                    </div>
                                                    <div class="notification-body">
                                                        <p class="mb-1">
                                                            <strong>Maria Fulaninha</strong>
                                                            respondeu seu comentário:
                                                            "Valeu!😍"
                                                        </p>
                                                        <span class="notification-time">
                                                            <span class="me-2" role="img" aria-label="Emoji">💬
                                                            </span>
                                                            Agora
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="list-group-item">
                                                <a class="notification notification-flush notification-unread"
                                                    href="#!">
                                                    <div class="notification-avatar">
                                                        <div class="avatar avatar-2xl me-3">
                                                            <div class="avatar-name rounded-circle"><span>FQ</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="notification-body">
                                                        <p class="mb-1">
                                                            <strong>Fulano Qualquer</strong>
                                                            reagiu ao status de
                                                            <strong>Maria Fulaninha</strong>
                                                        </p>
                                                        <span class="notification-time">
                                                            <span class="me-2 fab fa-gratipay text-danger"></span>
                                                            9hr
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="list-group-title border-bottom">Anteriores</div>
                                            
                                        </div>
                                    </div>
                                    <div class="card-footer text-center border-top">
                                        <a class="card-link d-block" href="#">
                                            Ver todas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- usuário VERDADEIRO =======-->
                        <li class="nav-item dropdown">
                            <a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-xl">
                                    <img class="rounded-circle" src="{{ Auth::user()->avatar_url }}"
                                        alt="{{ Auth::user()->name }}" />
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                                aria-labelledby="navbarDropdownUser">
                                <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                    <center>
                                        <span class="text-warning text-center">
                                            {{ explode(' ', Auth::user()->name)[0] }}
                                        </span>
                                    </center>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('home')}}">
                                        <i class="fas fa-id-card-alt"></i> Meu Painel
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('profile')}}">
                                        <i class="fas fa-id-card-alt"></i> Meu Perfil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Sair
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
                <script>
                    var navbarPosition = localStorage.getItem('navbarPosition');
                    var navbarVertical = document.querySelector('.navbar-vertical');
                    var navbarTopVertical = document.querySelector('.content .navbar-top');
                    var navbarTop = document.querySelector('[data-layout] .navbar-top:not([data-double-top-nav');
                    var navbarDoubleTop = document.querySelector('[data-double-top-nav]');
                    var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

                    if (localStorage.getItem('navbarPosition') === 'double-top') {
                        document.documentElement.classList.toggle('double-top-nav-layout');
                    }

                    if (navbarPosition === 'top') {
                        navbarTop.removeAttribute('style');
                        navbarTopVertical.remove(navbarTopVertical);
                        navbarVertical.remove(navbarVertical);
                        navbarTopCombo.remove(navbarTopCombo);
                        navbarDoubleTop.remove(navbarDoubleTop);
                    } else if (navbarPosition === 'combo') {
                        navbarVertical.removeAttribute('style');
                        navbarTopCombo.removeAttribute('style');
                        navbarTop.remove(navbarTop);
                        navbarTopVertical.remove(navbarTopVertical);
                        navbarDoubleTop.remove(navbarDoubleTop);
                    } else if (navbarPosition === 'double-top') {
                        navbarDoubleTop.removeAttribute('style');
                        navbarTopVertical.remove(navbarTopVertical);
                        navbarVertical.remove(navbarVertical);
                        navbarTop.remove(navbarTop);
                        navbarTopCombo.remove(navbarTopCombo);
                    } else {
                        navbarVertical.removeAttribute('style');
                        navbarTopVertical.removeAttribute('style');
                        navbarTop.remove(navbarTop);
                        navbarDoubleTop.remove(navbarDoubleTop);
                        navbarTopCombo.remove(navbarTopCombo);
                    }
                </script>
                <div class="row g-3 mb-3">

                    @yield('content')

                    <footer class="footer">
                        <div class="row g-0 justify-content-between fs-10 mt-4 mb-3">
                            <div class="col-12 col-sm-auto text-center">
                                <p class="mb-0 text-600">
                                    Igreja do Evangelho Quadrangular
                                    <span class="d-none d-sm-inline-block">|
                                    </span><br class="d-sm-none" /> {{ date('Y') }} &copy; <a
                                        href="https://quadrangulartaquara.org.br">IEQ Taquara</a>
                                </p>
                            </div>
                            <div class="col-12 col-sm-auto text-center">
                                <p class="mb-0 text-600"><img src="{{ asset('favicon.png') }}" width="20"
                                        alt=""></p>
                            </div>
                        </div>
                    </footer>
                </div>
                <div class="modal fade" id="authentication-modal" tabindex="-1" role="dialog"
                    aria-labelledby="authentication-modal-label" aria-hidden="true">
                    <div class="modal-dialog mt-6" role="document">
                        <div class="modal-content border-0">
                            <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                                <div class="position-relative z-1">
                                    <h4 class="mb-0 text-white" id="authentication-modal-label">Cadastro</h4>
                                    <p class="fs-10 mb-0 text-white">Favor, crie uma conta gratuita</p>
                                </div>
                                <div data-bs-theme="dark"><button
                                        class="btn-close position-absolute top-0 end-0 mt-2 me-2"
                                        data-bs-dismiss="modal" aria-label="Close"></button></div>
                            </div>
                            
                            <div class="modal-body py-4 px-5">
                                <form>
                                    <div class="mb-3"><label class="form-label" for="modal-auth-name">Nome
                                            completo</label><input class="form-control" type="text"
                                            autocomplete="on" id="modal-auth-name" /></div>
                                    <div class="mb-3"><label class="form-label" for="modal-auth-email">E-mail
                                            address</label><input class="form-control" type="email"
                                            autocomplete="on" id="modal-auth-email" /></div>
                                    <div class="row gx-2">
                                        <div class="mb-3 col-sm-6"><label class="form-label"
                                                for="modal-auth-password">Senha</label><input class="form-control"
                                                type="password" autocomplete="on" id="modal-auth-password" /></div>
                                        <div class="mb-3 col-sm-6"><label class="form-label"
                                                for="modal-auth-confirm-password">Confirmação de
                                                Senha</label><input class="form-control" type="password"
                                                autocomplete="on" id="modal-auth-confirm-password" /></div>
                                    </div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox"
                                            id="modal-auth-register-checkbox" /><label class="form-label"
                                            for="modal-auth-register-checkbox">I
                                            accept the <a href="#!">termos
                                            </a>e <a class="white-space-nowrap" href="#!">política de
                                                privacidade</a></label></div>
                                    <div class="mb-3"><button class="btn btn-primary d-block w-100 mt-3"
                                            type="submit" name="submit">Cadastrar</button></div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <!-- ===============================================--><!--    End of Main Content--><!-- ===============================================-->


    <!-- ===============================================--><!--    JavaScripts--><!-- ===============================================-->
    <script src="{{ asset('') }}vendors/popper/popper.min.js"></script>
    {{-- <script src="{{ asset('') }}vendors/bootstrap/bootstrap.min.js"></script> --}}
    <script src="{{ asset('') }}vendors/anchorjs/anchor.min.js"></script>
    <script src="{{ asset('') }}vendors/is/is.min.js"></script>
    <script src="{{ asset('') }}vendors/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('') }}vendors/prism/prism.js"></script>
    <script src="{{ asset('') }}vendors/echarts/echarts.min.js"></script>
    <script src="{{ asset('') }}vendors/fullcalendar/index.global.min.js"></script>
    <script src="{{ asset('') }}vendors/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('') }}vendors/dayjs/dayjs.min.js"></script>
    <script src="{{ asset('') }}vendors/fontawesome/all.min.js"></script>
    <script src="{{ asset('') }}vendors/lodash/lodash.min.js"></script>
    <script src="{{ asset('') }}vendors/list.js/list.min.js"></script>
    <script src="{{ asset('') }}assets/js/theme.js"></script>

    @yield('scripts')
</body>

</html>
