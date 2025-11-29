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
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Novo Evento
            </a>
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
                            <th class="text-end">Ações</th>
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
                                <td class="text-end">
                                    <a href="{{ route('admin.events.edit', $event) }}"
                                        class="btn btn-sm btn-outline-secondary">Editar</a>
                                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Tem certeza?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Excluir</button>
                                    </form>
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
@endsection


@section('scripts')
@endsection
