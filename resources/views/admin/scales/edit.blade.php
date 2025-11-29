@extends('layouts.app')

@section('title')
    Montar Escala
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="alert alert-info d-flex align-items-center">
        <i class="bi bi-calendar-check me-2 display-6"></i>
        <div>
            <strong>Escala para: {{ $event->title }}</strong><br>
            {{ $event->start_at->format('d/m/Y H:i') }} - {{ $event->location }}
        </div>
    </div>

    <div class="row">
        @foreach($departments as $dept)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span class="fw-bold">{{ $dept->name }}</span>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd{{ $dept->id }}">
                        <i class="bi bi-plus"></i> Escalar
                    </button>
                </div>
                
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tbody>
                            @if(isset($scales[$dept->id]))
                                @foreach($scales[$dept->id] as $scale)
                                <tr>
                                    <td class="ps-3 align-middle">
                                        <img src="{{ $scale->user->avatar_url }}" width="24" class="rounded-circle me-1">
                                        {{ $scale->user->name }}
                                        <div class="small text-muted fst-italic">{{ $scale->role_in_event }}</div>
                                    </td>
                                    <td class="text-end align-middle">
                                        <form action="{{ route('admin.scales.destroy', $scale->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-link text-danger btn-sm"><i class="bi bi-x-lg"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr><td colspan="2" class="text-center text-muted py-3">Ninguém escalado.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="modalAdd{{ $dept->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.scales.store', $event) }}" method="POST">
                            @csrf
                            <input type="hidden" name="department_id" value="{{ $dept->id }}">
                            
                            <div class="modal-header">
                                <h5 class="modal-title">Escalar para {{ $dept->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Voluntário (Apenas membros do {{ $dept->name }})</label>
                                    <select name="user_id" class="form-select" required>
                                        <option value="">Selecione...</option>
                                        @foreach($dept->members as $member)
                                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($dept->members->isEmpty())
                                        <div class="text-danger small mt-1">Nenhum membro cadastrado neste ministério. Vá em Departamentos > Gerenciar Membros.</div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label>Função Específica (Opcional)</label>
                                    <input type="text" name="role_in_event" class="form-control" placeholder="Ex: Backvocal, Camera 2, Recepção...">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Salvar Escala</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        @endforeach
    </div>
</div>
@endsection