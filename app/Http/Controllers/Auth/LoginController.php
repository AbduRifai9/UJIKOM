<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

// <-- Pindahkan ke sini

class LoginController extends Controller
{
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
     * Redirect user after login based on role.
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin === 1) {
            return redirect('admin/home'); // bisa juga pakai ->route() jika route diberi nama
        } else {
            return redirect('/');
        }
    }
}
