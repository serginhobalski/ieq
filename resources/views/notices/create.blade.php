@extends('layouts.app')

@section('title')
    Criar Novo Aviso
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-bullhorn me-2"></i> Criar Novo Aviso</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('notices.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Título</label>
                                <input type="text" name="title" class="form-control" placeholder="Ex: Culto da Virada"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Público Alvo</label>
                                <select name="target_audience" class="form-select">
                                    <option value="all">Toda a Igreja</option>
                                    <option value="leaders">Apenas Líderes</option>
                                    <option value="teens">Rede de Adolescentes</option>
                                    <option value="youth">Rede de Jovens</option>
                                    <option value="kids">Departamento Infantil</option>
                                    <option value="women">Departamento de Mulheres</option>
                                    <option value="men">Departamento de Homens</option>
                                    <option value="couples">Departamento de Casais</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Conteúdo</label>
                                <textarea name="content" class="form-control" rows="4" placeholder="Detalhes do aviso..." required></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Data de Expiração (Opcional)</label>
                                <input type="date" name="expires_at" class="form-control">
                                <div class="form-text">O aviso sumirá do mural automaticamente após esta data.</div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Publicar Aviso</button>
                                <a href="{{ route('notices.index') }}" class="btn btn-link text-muted">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
