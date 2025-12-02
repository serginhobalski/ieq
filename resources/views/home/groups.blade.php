@extends('layouts.app')

@section('title')
    Lista de Grupos de Comunhão
@endsection

@section('styles')
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Grupos de Conexão</h2>
            @if (Auth::user()->is_admin == 1)
            <a href="{{ route('admin.groups.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Novo Grupo
            </a>
            @endif
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @foreach ($groups as $group)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title fw-bold text-primary">{{ $group->name }}</h5>
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-0" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="">
                                                Ver
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('admin.groups.edit', $group) }}">Editar
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('admin.groups.destroy', $group) }}" method="POST"
                                                onsubmit="return confirm('Excluir este grupo?')">
                                                @csrf @method('DELETE')
                                                <button class="dropdown-item text-danger">Excluir</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $group->leader->avatar_url }}" class="rounded-circle me-2" width="40"
                                    height="40" alt="Líder">
                                <div>
                                    <small class="text-muted d-block">Líder</small>
                                    <span class="fw-bold">{{ $group->leader->name }}</span>
                                </div>
                            </div>

                            <ul class="list-unstyled mb-0 small text-secondary">
                                <li class="mb-2"><i class="bi bi-calendar-event me-2"></i> {{ $group->meeting_day }} às
                                    {{ \Carbon\Carbon::parse($group->meeting_time)->format('H:i') }}</li>
                                <li><i class="bi bi-geo-alt me-2"></i> {{ $group->address ?? 'Endereço não informado' }}
                                </li>
                            </ul>

                            <div class="mb-3 mt-2">
                                <a href="" class="btn btn-info">
                                    <i class="fas fa-external-link-alt"></i> Ver
                                </a>
                                @if (Auth::user()->id == $group->leader_id)
                                <a href="{{route('groups.edit', $group->id)}}" class="btn btn-success">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                @endif
                                @if (Auth::user()->is_admin == 1)
                                <a href="{{route('admin.groups.edit', $group->id)}}" class="btn btn-info">
                                    <i class="fas fa-edit"></i>Ver
                                </a>
                                <a href="{{route('admin.groups.destroy', $group->id)}}" class="btn btn-danger"
                                    onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <form  id="delete-form" action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" class="d-none">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
@endsection
