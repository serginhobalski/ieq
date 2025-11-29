<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    // Exibe a tela com o calendário vazio
    public function index()
    {
        return view('admin.calendar.index');
    }

    // Retorna o JSON que o FullCalendar vai consumir via AJAX
    public function events(Request $request)
    {
        // O FullCalendar envia automaticamente parâmetros 'start' e 'end' 
        // para carregar apenas o mês visível. Vamos filtrar para performance.
        $start = $request->get('start');
        $end = $request->get('end');

        $events = Event::where('is_published', true)
            ->whereBetween('start_at', [$start, $end]) // Filtra pela data
            ->get()
            ->map(function ($event) {
                // Mapeia as cores baseadas no tipo do evento
                $color = match ($event->type) {
                    'culto' => '#0d6efd',    // Azul
                    'ensaio' => '#ffc107',   // Amarelo
                    'evento' => '#198754',   // Verde
                    'reuniao' => '#6c757d',  // Cinza
                    default => '#3788d8',
                };

                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->start_at->toIso8601String(),
                    'end' => $event->end_at->toIso8601String(),
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    // Opcional: Link para editar ao clicar
                    // 'url' => route('admin.events.edit', $event->id),
                    'extendedProps' => [
                        'location' => $event->location,
                        'description' => $event->description,
                    ]
                ];
            });

        return response()->json($events);
    }
}