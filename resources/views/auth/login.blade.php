@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('link')
    <p class="text-white">Ainda não possui cadastro?<br>
        <a class="text-decoration-underline link-light" href="{{ route('register') }}">
            Cadastre-se aqui!
        </a>
    </p>
@endsection

@section('form')
    <div class="col-md-7 d-flex flex-center">
        <div class="p-4 p-md-5 flex-grow-1">
            <div class="row flex-between-center">
                <div class="col-auto">
                    <h3>Fazer Login</h3>
                </div>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="card-email">
                        E-mail ou nome de usuário
                    </label>
                    <input class="form-control @error('login') is-invalid @enderror" name="login" id="card-email"
                        type="text" />
                    @error('login')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="card-password">
                            Senha
                        </label>
                    </div>
                    <input class="form-control @error('password') is-invalid @enderror" id="card-password" name="password"
                        type="password" />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row flex-between-center">
                    <div class="col-auto">
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" id="card-checkbox" checked="checked" />
                            <label class="form-check-label mb-0" for="card-checkbox">
                                Lembrar-me
                            </label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <a class="fs-10" href="#">
                            Esqueceu a senha?
                        </a>
                    </div>
                </div>
                <div class="mb-3"><button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Log
                        in</button></div>
            </form>
            <div class="position-relative mt-4">
                <hr />
                <div class="divider-content-center">---</div>
            </div>

        </div>
    </div>
@endsection
