<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Get the login username to be used by the controller.
     * Sobrescreve para usar o nome do campo do formulário, 
     * que passamos como 'login' na nossa lógica.
     *
     * @return string
     */
    public function username()
    {
        return 'login'; // 'login' é o campo que você deve usar no formulário.
    }

    /**
     * Validate the user login request.
     * * Adiciona a validação para o novo campo 'login'.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }


    /**
     * Get the needed authorization credentials from the request.
     * * Traduz o campo 'login' do formulário para o campo correto ('email' ou 'username') 
     * que será usado na busca do banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        // Pega o valor do campo 'login' do formulário.
        $login = $request->get($this->username());

        // Verifica se o valor é um email (ex: contém @).
        // Se for email, usa 'email' como chave de login.
        if ($this->isEmail($login)) {
            return [
                'email' => $login,
                'password' => $request->get('password'),
            ];
        }

        // Se não for email, assume que é 'username'.
        return [
            'username' => $login,
            'password' => $request->get('password'),
        ];
    }
    
    /**
     * Verifica se a string fornecida parece um endereço de email.
     *
     * @param  string  $value
     * @return bool
     */
    protected function isEmail($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
