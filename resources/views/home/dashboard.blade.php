@extends('layouts.app')


@section('title')
    Painel
@endsection


@section('styles')
@endsection


@section('content')
    <div class="row g-0 align-items-stretch h-100">
        <div class="col-lg-6 pe-lg-2 mb-3">
            <div class="card mb-3 mb-lg-0 h-100">
                <div class="card-header bg-body-tertiary">
                    <h5 class="mb-0">Eventos</h5>
                </div>
                <div class="card-body fs-10">
                    <div class="d-flex btn-reveal-trigger">
                        <div class="calendar"><span class="calendar-month">Nov</span><span class="calendar-day">09</span>
                        </div>
                        <div class="flex-1 position-relative ps-3">
                            <h6 class="fs-9 mb-0"><a href="app/events/event-detail.html">Santa Ceia</a></h6>
                            <p class="mb-1"><a href="#!" class="text-700">Quadrangular Taquara</a></p>
                            <p class="text-1000 mb-0">Horário: 09:00</p>
                            <p class="text-1000 mb-0">---</p>Local: Rua Nacional, 618, Taquara<div
                                class="border-bottom border-dashed my-3"></div>
                        </div>
                    </div>
                </div>
                <div class="card-body fs-10">
                    <div class="d-flex btn-reveal-trigger">
                        <div class="calendar"><span class="calendar-month">Nov</span><span
                                class="calendar-day">16</span></div>
                        <div class="flex-1 position-relative ps-3">
                            <h6 class="fs-9 mb-0"><a href="app/events/event-detail.html">Culto da Família</a></h6>
                            <p class="mb-1"><a href="#!" class="text-700">Quadrangular Taquara</a></p>
                            <p class="text-1000 mb-0">Horário: 09:00</p>
                            <p class="text-1000 mb-0">---</p>Local: Rua Nacional, 618, Taquara<div
                                class="border-bottom border-dashed my-3"></div>
                        </div>
                    </div>
                </div>
                <div class="card-body fs-10">
                    <div class="d-flex btn-reveal-trigger">
                        <div class="calendar"><span class="calendar-month">Nov</span><span
                                class="calendar-day">23</span></div>
                        <div class="flex-1 position-relative ps-3">
                            <h6 class="fs-9 mb-0"><a href="app/events/event-detail.html">Culto da Família</a></h6>
                            <p class="mb-1"><a href="#!" class="text-700">Quadrangular Taquara</a></p>
                            <p class="text-1000 mb-0">Horário: 09:00</p>
                            <p class="text-1000 mb-0">---</p>Local: Rua Nacional, 618, Taquara<div
                                class="border-bottom border-dashed my-3"></div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-body-tertiary p-0 border-top">
                    <a class="btn btn-link d-block w-100" href="#">Todos os Eventos<svg
                            class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false"
                            data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 320 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z">
                            </path>
                        </svg><!-- <span class="fas fa-chevron-right ms-1 fs-11"></span> Font Awesome fontawesome.com --></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 ps-lg-2 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Notificações</h5>
                </div>
                <div class="card-body p-0">
                    <a class="border-bottom-0 notification rounded-0 border-x-0 border-300" href="#!">
                        <div class="notification-avatar">
                            <div class="avatar avatar-xl me-3">
                                <img class="rounded-circle" src="assets/img/team/1.jpg" alt="">
                            </div>
                        </div>
                        <div class="notification-body">
                            <p class="mb-1">Announcing the winners of the <strong>The only book awards</strong> decided
                                by
                                you, the readers. Check out the champions and runners-up in all 21 categories now!</p>
                            <span class="notification-time"><span class="me-2" role="img"
                                    aria-label="Emoji">📢</span>Just Now</span>
                        </div>
                    </a>

                    <a class="border-bottom-0 notification-unread notification rounded-0 border-x-0 border-300"
                        href="#!">
                        <div class="notification-avatar">
                            <div class="avatar avatar-xl me-3">
                                <img class="rounded-circle" src="assets/img/team/2.jpg" alt="">
                            </div>
                        </div>
                        <div class="notification-body">
                            <p class="mb-1">Last chance to vote in <strong>The 2018 Falcon Choice Awards</strong>! See
                                what made it to the Final Round and help your favorites take home the win. Voting closes on
                                November 26</p>
                            <span class="notification-time"><span class="me-2" role="img"
                                    aria-label="Emoji">🏆</span>15m</span>
                        </div>
                    </a>

                    <a class="border-bottom-0 notification rounded-0 border-x-0 border-300" href="#!">
                        <div class="notification-avatar">
                            <div class="avatar avatar-xl me-3">
                                <img class="rounded-circle" src="assets/img/team/3.jpg" alt="">
                            </div>
                        </div>
                        <div class="notification-body">
                            <p class="mb-1"><strong>Jennifer Kent</strong> declared you as a <strong>President</strong>
                                of
                                Computer Science and Engineering Society</p>
                            <span class="notification-time"><span class="me-2" role="img"
                                    aria-label="Emoji">📢</span>1h</span>
                        </div>
                    </a>

                    <a class="border-bottom-0 notification-unread notification rounded-0 border-x-0 border-300"
                        href="#!">
                        <div class="notification-avatar">
                            <div class="avatar avatar-xl me-3">
                                <img class="rounded-circle" src="assets/img/team/4.jpg" alt="">
                            </div>
                        </div>
                        <div class="notification-body">
                            <p class="mb-1">Congratulate <strong>Woody Allen</strong> for starting a new position as
                                Business Development Manager &amp; Implementation Engineer at <strong>Hewlett Packard
                                    Enterprise(HP)</strong></p>
                            <span class="notification-time"><span class="me-2" role="img"
                                    aria-label="Emoji">🎁</span>6h</span>
                        </div>
                    </a>
                </div>
                <div class="card-footer bg-body-tertiary py-0 border-top"><a class="btn btn-link d-block w-100"
                        href="app/social/notifications.html">Todas as Notificações</a></div>
            </div>
        </div>
    </div>

    <div class="card overflow-hidden">
        <div class="card-header">
            <div class="row gx-0 align-items-center">
                <div class="col-auto d-flex justify-content-end order-md-1"><button
                        class="btn icon-item icon-item-sm shadow-none p-0 me-1 ms-md-2" type="button" data-event="prev"
                        data-bs-toggle="tooltip" title="Previous"><span class="fas fa-arrow-left"></span></button><button
                        class="btn icon-item icon-item-sm shadow-none p-0 me-1 me-lg-2" type="button" data-event="next"
                        data-bs-toggle="tooltip" title="Next"><span class="fas fa-arrow-right"></span></button></div>
                <div class="col-auto col-md-auto order-md-2">
                    <h4 class="mb-0 fs-9 fs-sm-8 fs-lg-7 calendar-title"></h4>
                </div>
                <div class="col col-md-auto d-flex justify-content-end order-md-3"><button
                        class="btn btn-falcon-primary btn-sm" type="button" data-event="today">Hoje</button></div>
                <div class="col-md-auto d-md-none">
                    <hr />
                </div>
                <div class="col-auto d-flex order-md-0"><button class="btn btn-primary btn-sm" type="button"
                        data-bs-toggle="modal" data-bs-target="#addEventModal"> <span
                            class="fas fa-plus me-2"></span>Criar compromisso</button></div>
                <div class="col d-flex justify-content-end order-md-2">
                    <div class="dropdown font-sans-serif me-md-2">
                        <button
                            class="btn btn-falcon-default text-600 btn-sm dropdown-toggle dropdown-caret-none"
                            type="button" id="email-filter" data-bs-toggle="dropdown" data-boundary="viewport"
                            aria-haspopup="true" aria-expanded="false">
                            <span data-view-title="data-view-title">Ver Mês</span>
                            <span class="fas fa-sort ms-2 fs-10"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="email-filter">
                            <a
                                class="active dropdown-item d-flex justify-content-between" href="#!"
                                data-fc-view="dayGridMonth">
                                Ver Mês
                                <span class="icon-check">
                                    <span class="fas fa-check" data-fa-transform="down-4 shrink-4"></span>
                                </span>
                            </a>
                            <a
                                class="dropdown-item d-flex justify-content-between" href="#!"
                                data-fc-view="timeGridWeek">Ver Semana
                                <span class="icon-check">
                                    <span class="fas fa-check"
                                        data-fa-transform="down-4 shrink-4">
                                    </span>
                                </span>
                            </a>
                            <a
                                class="dropdown-item d-flex justify-content-between" href="#!"
                                data-fc-view="timeGridDay">Ver Dia
                                <span class="icon-check">
                                    <span class="fas fa-check"
                                        data-fa-transform="down-4 shrink-4">
                                    </span>
                                </span>
                            </a>
                            <a
                                class="dropdown-item d-flex justify-content-between" href="#!"
                                data-fc-view="listWeek">Ver Lista
                                <span class="icon-check">
                                    <span class="fas fa-check"
                                        data-fa-transform="down-4 shrink-4">
                                    </span>
                                </span>
                            </a>
                            <a
                                class="dropdown-item d-flex justify-content-between" href="#!"
                                data-fc-view="listYear">Ver Ano
                                <span class="icon-check">
                                    <span class="fas fa-check"
                                        data-fa-transform="down-4 shrink-4">
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0 scrollbar">
            <div class="calendar-outline" id="appCalendar"></div>
        </div>
    </div>
@endsection


@section('scripts')
@endsection
