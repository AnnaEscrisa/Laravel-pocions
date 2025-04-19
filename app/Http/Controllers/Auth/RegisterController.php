<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {

    public function register(Request $request) {
        $validator = $this->validateRegister($request);
        
        if ($validator->fails()) {
            return back()->withInput()->with('message', [
                'text' => $validator->errors()->first(),
                'type' => 'error'
            ]);
        }

        $user = User::create([
            'user' => $request->user,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_Social' => 0,
            'is_Admin' => 0
        ]);

        return redirect()->route('home')->with('message', [
            'text' => config('message.success_r1'),
            'type' => 'success'
        ]);
    }

    public function validateRegister(Request $request) {
        return Validator::make($request->all(), [
            'user' => 'required|string|max:40|unique:users',
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'password' => 'required|string|min:8|max:300|confirmed'
        ],
        [
            'user.required' => config('message.error_g1'),
            'name.required' => config('message.error_g1'),
            'email.required' => config('message.error_g1'),
            'password.required' => config('message.error_g1'),
            'password.confirmed' => config('message.error_r3'),
            'user.unique' => config('message.error_r2'),
            'user.max' => config('message.error_g2'),
            'name.max' => config('message.error_g2'),
            'email.max' => config('message.error_g2'),
            'password.min' => config('message.error_r5'),
            'password.max' => config('message.error_g2'),
            'email.email' => config('message.error_r4'),
        ]);

        //if user name is not unique, return error message

     
    }

    public function index() {
        return view('register');
    }
}