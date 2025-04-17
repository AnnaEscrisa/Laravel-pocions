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
        $this->validateLogin($request);

        $credentials = [
            'user' => $request->usuari,
            'password' => $request->password,
        ];

        $remember = $request->boolean('recorda');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            Cookie::queue('intentsLogin', 0, 10 * 60);
            if ($remember) {
                Cookie::queue('recorda', $request->usuari, 60 * 24 * 10); // 10 days
            } else {
                Cookie::queue(Cookie::forget('recorda'));
            }

            return redirect()->route('My-Articles')->with('message', [
                'text' => success_l1,
                'type' => 'success'
            ]);
        }

        $intents = (int) Cookie::get('intentsLogin', 0);
        Cookie::queue('intentsLogin', $intents + 1, 10 * 60);

        return back()->withInput()->with('message', [
            'text' => error_l1,
            'type' => 'error',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('message', [
            'text' => success_l2,
            'type' => 'success'
        ]);
    }

    public function validateLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usuari' => ['required'],
            'password' => ['required'],
            'g-recaptcha-response' => ['nullable', function ($attribute, $value, $fail) {
                if (Cookie::get('intentsLogin') >= 3 && !$value) {
                    $fail(error_l3);
                }
            }],
        ], [
            'usuari.required' => error_g1,
            'password.required' => error_g1,
        ]);
    
        if ($validator->fails()) {
            $messageText = $validator->errors()->first();

            return back()->withInput()->with('message', [
                'text' => $messageText,
                'type' => 'error'
            ]);
        }
    }

    public function index()
    {
        return view('login');
    }
}
