@extends('layouts.app')

@section('title')
    Lista de Departamentos
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Departamentos da Igreja</h2>

            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                data-bs-target="#addDepartmentModal">
                <i class="fas fa-folder-plus"></i> Novo Departamento
            </button>
        </div>
        <!-- MODAL DE CRIAÇÃO DE DEPARTAMENTO -->
        <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.departments.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Criar Departamento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" name="name" class="form-control" id="departmentName" required>
                                <small class="text-muted">
                                    Certifique-se de não criar departamento repetido.
                                </small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sigla (slug)</label>
                                <input type="text" name="slug" class="form-control" id="departmentSlug" required>
                            </div>

                            <script>
                                document.getElementById('departmentName').addEventListener('blur', function() {
                                    const slug = this.value
                                        .toLowerCase()
                                        .trim()
                                        .replace(/\s+/g, '-')
                                        .replace(/[^\w-]/g, '');
                                    document.getElementById('departmentSlug').value = slug;
                                });
                            </script>

                            <div class="mb-3">
                                <label class="form-label">Descrição</label>
                                <input type="text" name="description" class="form-control" id="departmentDescription">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- FIM DA MODAL -->

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            @foreach ($departments as $department)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <!-- Cabeçalho do Card -->
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title fw-bold text-primary">{{ $department->name }}</h5>
                                <span class="badge bg-light text-dark border">
                                    {{ $department->members->count() }} membros
                                </span>
                            </div>

                            <div class="row">
                                <!-- Informações do Líder -->
                                <div class="d-flex align-items-center col-12 mb-4">
                                    <img src="{{ $department->leader->avatar_url ?? 'https://ui-avatars.com/api/?name=L' }}"
                                        class="rounded-circle me-2" width="40" height="40" alt="Líder">
                                    <div>
                                        <small class="text-muted d-block">Líder</small>
                                        <span class="fw-bold">{{ $department->leader->name ?? 'Sem líder' }}</span>
                                    </div>
                                </div>

                                <!-- Botões de Ação -->
                                <div class="col-4 d-grid">
                                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#addMemberModal-{{ $department->id }}">
                                        <i class="fas fa-user-plus"></i> Add
                                    </button>
                                </div>
                                <div class="col-4 d-grid">
                                    <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editDepartmentModal-{{ $department->id }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                </div>
                                <div class="col-4 d-grid">
                                    <form action="{{ route('admin.departments.destroy', $department) }}" method="POST"
                                        onsubmit="return confirm('Excluir este departamento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Excluir
                                        </button>
                                    </form>
                                </div>

                            </div>
                            <hr>
                            <!-- Lista de membros do departamento -->
                            <span class="mt-4">Membros - {{ $department->name }} </span class="mt-2">
                            <ol>
                                @foreach ($department->members as $member)
                                    <li>
                                        {{ $member->name }}
                                        @if ($member->role == 'member')
                                            <span class="badge bg-info text-dark">Membro</span>
                                        @elseif ($member->role == 'leader')
                                            <span class="badge bg-warning">Líder</span>
                                        @elseif ($member->role == 'pastor')
                                            <span class="badge bg-success">Pastor(a)</span>
                                        @else
                                            <span class="badge bg-secondary">Visitante</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>

                    <!-- MODAL DE ADICIONAR MEMBRO (Específica para este ID de departamento) -->
                    <div class="modal fade" id="addMemberModal-{{ $department->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.departments.addMember', $department) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Adicionar ao {{ $department->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Selecione o Membro</label>
                                            <select name="user_id" class="form-select" required>
                                                <option value="">Escolha um usuário...</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->name }} ({{ $user->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">
                                                Certifique-se de não selecionar alguém que já faz parte da equipe.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- FIM DA MODAL -->

                    <!-- MODAL DE EDITAR DEPARTAMENTO -->
                    <div class="modal fade" id="editDepartmentModal-{{ $department->id }}" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('admin.departments.update', $department->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title">Atualizar {{ $department->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nome do Departamento</label>
                                            <input type="text" name="name" id="" class="form-control"
                                                value="{{ $department->name }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Descrição do Departamento</label>
                                            <input type="text" name="description" id="" class="form-control"
                                                value="{{ $department->description }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Sigla do Departamento</label>
                                            <input type="text" name="slug" id="" class="form-control"
                                                value="{{ $department->slug }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Líder do Departamento</label>
                                            <select name="leader_id" class="form-select" required>
                                                <option value="">--Selecione--</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ $user->id == $department->leader_id ? 'selected' : '' }}>
                                                        {{ $user->name }}                                                        
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- FIM DA MODAL -->

                </div>
            @endforeach
        </div>
    </div>
@endsection
