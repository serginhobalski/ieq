<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:50', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['nullable', 'string', 'max:255'],
            'birth_date' => ['nullable', 'string', 'max:255'],
            'is_admin' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // return User::create([
        //     'name' => $data['name'],
        //     'username' => $data['phone'],
        //     'email' => $data['email'],
        //     'phone' => $data['phone'],
        //     'address' => $data['address'],
        //     'birth_date' => $data['birth_date'],
        //     'is_admin' => $data['is_admin'],
        //     'avatar_path' => $data['avatar_path'],
        //     'password' => Hash::make($data['password']),
        // ]);
        $avatarPath = null;

        // Verifica se a imagem foi enviada no array $data
        if (isset($data['avatar'])) {
            // Salva na pasta 'storage/app/public/avatars' e retorna o caminho
            $avatarPath = $data['avatar']->store('avatars', 'public');
        }

        return User::create([
            'name' => $data['name'],
            'username' => $data['username'], // Novo campo
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar_path' => $avatarPath, // Salva o caminho (ex: avatars/nome-do-arquivo.jpg)
            'phone' => $data['phone'] ?? null,     // Caso você adicione o input depois
            'address' => $data['address'] ?? null, // Caso você adicione o input depois
            'birth_date' => $data['birth_date'] ?? null,
            'is_admin' => false, // Padrão
        ]);
    }
}
