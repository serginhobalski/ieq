@extends('layouts.app')


@section('title')
    Painel Admin
@endsection


@section('styles')
@endsection


@section('content')
    <div class="car mb-3">
        <div class="card-body px-xl-0 pt-4">
            <div class="row g-0">
                <center>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-info"><i
                            class="fas fa-calendar-alt"></i>Gerenciar Eventos</a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-info">
                        <i class="fas fa-users"></i>Gerenciar Membros
                    </a>
                    <a href="{{ route('admin.groups.index') }}" class="btn btn-info">
                        <i class="fas fa-share-alt"></i>Gerenciar Grupos
                    </a>
                    <a href="{{ route('admin.departments.index') }}" class="btn btn-info">
                        <i class="fas fa-folder-open"></i>Gerenciar Departamentos
                    </a>
                </center>
            </div>
        </div>
    </div>

    {{-- <div class="card overflow-hidden">
        <div class="card-header">
            <div class="row gx-0 align-items-center">
                <div class="col-auto d-flex justify-content-end order-md-1">
                    <button class="btn icon-item icon-item-sm shadow-none p-0 me-1 ms-md-2" type="button" data-event="prev"
                        data-bs-toggle="tooltip" title="Previous">
                        <span class="fas fa-arrow-left"></span>
                    </button>
                    <button class="btn icon-item icon-item-sm shadow-none p-0 me-1 me-lg-2" type="button" data-event="next"
                        data-bs-toggle="tooltip" title="Next">
                        <span class="fas fa-arrow-right"></span>
                    </button>
                </div>
                <div class="col-auto col-md-auto order-md-2">
                    <h4 class="mb-0 fs-9 fs-sm-8 fs-lg-7 calendar-title"></h4>
                </div>
                <div class="col col-md-auto d-flex justify-content-end order-md-3">
                    <button class="btn btn-falcon-primary btn-sm" type="button" data-event="today">
                        Hoje
                    </button>
                </div>
                <div class="col-md-auto d-md-none">
                    <hr />
                </div>
                <div class="col-auto d-flex order-md-0">
                    <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                        data-bs-target="#addEventModal">
                        <span class="fas fa-plus me-2"></span>
                        + Compromisso
                    </button>
                </div>
                <div class="col d-flex justify-content-end order-md-2">
                    <div class="dropdown font-sans-serif me-md-2">
                        <button class="btn btn-falcon-default text-600 btn-sm dropdown-toggle dropdown-caret-none"
                            type="button" id="email-filter" data-bs-toggle="dropdown" data-boundary="viewport"
                            aria-haspopup="true" aria-expanded="false">
                            <span data-view-title="data-view-title">Ver Mês</span>
                            <span class="fas fa-sort ms-2 fs-10"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="email-filter">
                            <a class="active dropdown-item d-flex justify-content-between" href="#!"
                                data-fc-view="dayGridMonth"> Ver Mês
                                <span class="icon-check">
                                    <span class="fas fa-check" data-fa-transform="down-4 shrink-4"></span>
                                </span>
                            </a>
                            <a class="dropdown-item d-flex justify-content-between" href="#!"
                                data-fc-view="timeGridWeek">
                                Ver Semana
                                <span class="icon-check">
                                    <span class="fas fa-check" data-fa-transform="down-4 shrink-4"></span>
                                </span>
                            </a>
                            <a class="dropdown-item d-flex justify-content-between" href="#!"
                                data-fc-view="timeGridDay">
                                Ver Dia
                                <span class="icon-check">
                                    <span class="fas fa-check" data-fa-transform="down-4 shrink-4"></span>
                                </span>
                            </a>
                            <a class="dropdown-item d-flex justify-content-between" href="#!" data-fc-view="listWeek">
                                Ver Lista
                                <span class="icon-check">
                                    <span class="fas fa-check" data-fa-transform="down-4 shrink-4"></span>
                                </span>
                            </a>
                            <a class="dropdown-item d-flex justify-content-between" href="#!"
                                data-fc-view="listYear">Ver Ano<span class="icon-check"><span class="fas fa-check"
                                        data-fa-transform="down-4 shrink-4"></span></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0 scrollbar">
            <div class="calendar-outline" id="appCalendar"></div>
        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Calendário Geral</h2>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Novo Evento
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-3">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                // Configurações Básicas
                initialView: 'dayGridMonth',
                locale: 'pt-br', // Importante para ficar em português
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },

                // Fonte de Dados (Nossa Rota JSON)
                events: "{{ route('admin.calendar.feed') }}",

                // Comportamento
                navLinks: true, // permite clicar no dia/semana
                editable: false, // true se quiser arrastar e soltar (precisa implementar lógica no backend)
                dayMaxEvents: true, // "mais..." link quando tem muitos eventos

                // Tooltip simples ao passar o mouse (Opcional)
                eventDidMount: function(info) {
                    var tooltip = new bootstrap.Tooltip(info.el, {
                        title: info.event.title + (info.event.extendedProps.location ? ' - ' +
                            info.event.extendedProps.location : ''),
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                },

                // Ação ao clicar no evento
                eventClick: function(info) {
                    // Exemplo: Redirecionar para edição
                    // window.location.href = "/admin/events/" + info.event.id + "/edit";

                    // Ou mostrar um alert simples
                    alert('Evento: ' + info.event.title + '\nLocal: ' + info.event.extendedProps
                        .location);
                }
            });

            calendar.render();
        });
    </script>

    <style>
        /* Ajuste de altura para ficar bonito na tela */
        #calendar {
            min-height: 700px;
        }

        /* Remover sublinhado dos eventos */
        .fc-event {
            cursor: pointer;
            text-decoration: none;
        }
    </style>
@endsection
