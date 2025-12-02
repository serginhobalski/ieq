@extends('layouts.app')


@section('title')
    Lista de Eventos
@endsection


@section('styles')
@endsection


@section('content')
    <div class="container-fluid pt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Eventos</h2>
            @if (Auth::user()->is_admin)
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Novo Evento
            </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Tipo</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->start_at->format('d/m/Y H:i') }}</td>
                                <td><span class="badge bg-info text-dark">{{ ucfirst($event->type) }}</span></td>
                                <td>
                                    @if ($event->is_published)
                                        <span class="badge bg-success">Publicado</span>
                                    @else
                                        <span class="badge bg-secondary">Rascunho</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $events->links() }} </div>
    </div>

    <div class="container-fluid pt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Calendário Geral</h2>
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
                events: "{{ route('calendar.feed') }}",

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
