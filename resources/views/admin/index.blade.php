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
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <div class="card">
                                <a href="{{ route('admin.events.index') }}" class="btn btn-info">
                                    <i class="fas fa-calendar-alt"></i> Eventos
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="card">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-info">
                                    <i class="fas fa-users"></i> Membros
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="card">
                                <a href="{{ route('admin.groups.index') }}" class="btn btn-info">
                                    <i class="fas fa-share-alt"></i> Grupos
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="card">
                                <a href="{{ route('admin.departments.index') }}" class="btn btn-info">
                                    <i class="fas fa-folder-open"></i> Departamentos
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="card">
                                <a href="{{ route('admin.courses.index') }}" class="btn btn-info">
                                    <i class="fas fa-book"></i> Cursos
                                </a>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </div>

    <hr>

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
