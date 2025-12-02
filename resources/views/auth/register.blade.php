@extends('layouts.auth')

@section('title')
    Cadastro
@endsection

@section('link')
    <p class="text-white">Já tem login e senha?<br>
        <a class="text-decoration-underline link-light" href="{{ route('login') }}">
            Faça login aqui!
        </a>
    </p>
@endsection

@section('form')
    <div class="col-md-7 d-flex flex-center">
        <div class="p-4 p-md-5 flex-grow-1">
            <div class="row flex-between-center">
                <div class="col-auto">
                    <h3>Fazer Cadastro</h3>
                </div>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="card-name">
                        Nome completo
                    </label>
                    <input 
                        class="form-control @error('name') is-invalid @enderror" 
                        name="name" id="card-name" type="text" 
                        value="{{ old('name') }}" autocomplete="name" required
                    />
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="card-username">
                        Nome de usuário
                    </label>
                    <input 
                        class="form-control @error('username') is-invalid @enderror" 
                        name="username" id="card-username" type="text" 
                        value="{{ old('username') }}" required autocomplete="username"
                    />
                    <small class="text-danger">*Não coloque espaços nem caixa alta no nome de usuário.</small>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="card-email">
                        E-mail ou nome de usuário
                    </label>
                    <input 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="login" id="card-email" type="text" 
                        value="{{ old('email') }}" required autocomplete="email"
                    />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="card-phone">
                        Telefone
                    </label>
                    <input 
                        class="form-control @error('phone') is-invalid @enderror" 
                        name="phone" id="card-phone" type="text" 
                        value="{{ old('phone') }}" required autocomplete="phone"
                    />
                    @error('login')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="card-address">
                        Endereço completo
                    </label>
                    <input 
                        class="form-control @error('address') is-invalid @enderror" 
                        name="address" id="card-address" type="text" 
                        value="{{ old('address') }}" required autocomplete="address"
                    />
                    @error('login')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="card-birth_date">
                        Data de nascimento
                    </label>
                    <input 
                        class="form-control @error('birth_date') is-invalid @enderror" 
                        name="address" id="card-birth_date" type="date" 
                        value="{{ old('birth_date') }}" autocomplete="birth_date"
                    />
                    @error('birth_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label" for="card-avatar">
                        Imagem de perfil
                    </label>
                    <input 
                        class="form-control @error('avatar') is-invalid @enderror" 
                        name="address" id="card-avatar" type="file" accept=".jpg,.jpeg,.png,.gif"
                        value="{{ old('avatar') }}" autocomplete="avatar"
                    />
                    @error('avatar')
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
                    <input 
                        class="form-control @error('password') is-invalid @enderror" 
                        id="card-password" name="password" type="password" required autocomplete="new-password"
                    />
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="card-password-conf">
                            Confirmação de Senha
                        </label>
                    </div>
                    <input 
                        class="form-control" id="card-password-conf" 
                        name="password_confirmation" type="password" 
                        autocomplete="new-password" required
                    />
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
