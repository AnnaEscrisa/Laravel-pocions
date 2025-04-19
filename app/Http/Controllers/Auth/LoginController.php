<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = $this->validateLogin($request);

        if ($validator->fails()) {
            return back()->withInput()->with('message', [
                'text' => $validator->errors()->first(),
                'type' => 'error'
            ]);
        }

        $credentials = [
            'user' => $request->usuari,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $this->setLoginCookies($request);
            $user = Auth::user();
            $request->session()->put('user', [
                'id' => $user->id,
                'name' => $user->name,
                'is_Admin' => $user->is_Admin,
                'is_Social' => $user->is_Social,
            ]);

            return redirect()->route('mine')->with('message', [
                'text' => config('message.success_l1'),
                'type' => 'success'
            ]);
        }

        $intents = (int) Cookie::get('intentsLogin', 0);
        Cookie::queue('intentsLogin', $intents + 1, 10 * 60);

        return back()->withInput()->with('message', [
            'text' => config('message.error_l1'),
            'type' => 'error',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('message', [
            'text' => config('message.success_l2'),
            'type' => 'success'
        ]);
    }

    public function validateLogin(Request $request)
    {
        return Validator::make($request->all(), [
            'usuari' => ['required'],
            'password' => ['required'],
            'g-recaptcha-response' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (Cookie::get('intentsLogin') >= 3 && !$value) {
                        $fail(config('message.error_l3'));
                    }
                }
            ],
        ], [
            'usuari.required' => config('message.error_g1'),
            'password.required' => config('message.error_g1'),
        ]);
    }

    private function setLoginCookies(Request $request)
    {
        $remember = $request->boolean('recorda');
        Cookie::queue('intentsLogin', 0, 10 * 60);
        if ($remember) {
            Cookie::queue('recorda', $request->usuari, 60 * 24 * 10); 
        } else {
            Cookie::queue(Cookie::forget('recorda'));
        }
    }

    public function index()
    {
        return view('login');
    }
}
