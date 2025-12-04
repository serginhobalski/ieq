@extends('layouts.app')

@section('title')
    Criar Devocional
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header py-3">
                    <h5 class="mb-0 fw-bold text-primary">Escrever Devocional</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('devotionals.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Título da Mensagem</label>
                            <input type="text" name="title" class="form-control form-control-lg" placeholder="Ex: O Poder da Oração..." required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Data de Publicação</label>
                                <input type="date" name="published_at" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Imagem de Capa (Opcional)</label>
                                <input type="file" name="cover" class="form-control" accept="image/*">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Conteúdo</label>
                            <textarea name="content" class="form-control" rows="12" placeholder="Escreva sua mensagem aqui..." required></textarea>
                            <div class="form-text">Você pode usar parágrafos simples. Eles serão formatados automaticamente.</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('devotionals.index') }}" class="btn btn-link text-muted">Cancelar</a>
                            <button type="submit" class="btn btn-success px-5">Publicar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection