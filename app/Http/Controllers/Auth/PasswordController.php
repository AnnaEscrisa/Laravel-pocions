<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\UserCode;
use App\Models\User;

class PasswordController extends Controller
{
    //mostrar formulari de recuperacio
    public function recuperaView()
    {
        return view('recupera');
    }

    //mostrar formulari de canvi de contrasenya
    public function canviView($token = null)
    {
        if (Auth::check()) {
            return view('new_pass');
        }

        if ($token) {
            $validCode = UserCode::where('code', $token)
                ->where('expiration', '>', now())
                ->with('user')
                ->first();

            if ($validCode) {
                return view('new_pass')->with([
                    'id' => $validCode->user->id,
                    'oldPass' => $validCode->user->password
                ]);
            } else {
                return redirect()->route('login')->with('message', [
                    'text' => config('message.error_rec2'),
                    'type' => 'error'
                ]);
            }
        }
        return redirect()->route('login')->with('message', [
            'text' => config('message.error_a5'),
            'type' => 'error'
        ]);
    }

    //enviar email de recuperacio
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'user' => 'required|string|max:50',
        ], [
            'user.required' => config('message.error_g1')
        ]);

        $user = User::where('user', $request->user)->first();
        if ($user) {

            //eliminem per no acumular codis
            UserCode::where('user_id', $user->id)->delete();

            $code = sha1(uniqid(rand(), true));
            UserCode::create([
                'user_id' => $user->id,
                'code' => $code,
                'expiration' => now()->addMinutes(90)->timestamp,
            ]);

            try {
                $this->sendMail($user, $code);

                return back()->with('message', [
                    'text' => config('message.success_rec1'),
                    'type' => 'success'
                ]);
            } catch (\Throwable $th) {
                return back()->withInput()->with('message', [
                    'text' => 'Error enviant el mail. Torna-ho a intentar més tard',
                    'type' => 'error'
                ]);
            }

        } else {
            return back()->withInput()->with('message', [
                'text' => config('message.error_rec1'),
                'type' => 'error'
            ]);
        }
    }

    //enviar formulari de canvi de contrasenya
    public function canviPass(Request $request)
    {
        $validator = $this->passwordValidation($request);
        if ($validator->fails()) {
            return back()->with('message', [
                'text' => $validator->errors()->first(),
                'type' => 'error'
            ]);
        }

        $user = User::find($request->user_id);
        if ($user) {

            if (!Hash::check($request->oldPass, $user->password)) {
                return back()->with('message', [
                    'text' => config('message.error_r6'),
                    'type' => 'error'
                ]);
            }

            $password = bcrypt($request->password);
            $user->update([
                'password' => $password,
            ]);
            return redirect()->route('login')->with('message', [
                'text' => config('message.success_rec2'),
                'type' => 'success'
            ]);
        } else {
            return redirect()->route('login')->with('message', [
                'text' => config('message.error_rec2'),
                'type' => 'error'
            ]);
        }
    }

    public function sendMail($user, $token)
    {
        $link = route('new_pass', ['token' => $token]);

        Mail::to($user->email)->send(new ResetMail($link, $user));
    }

    private function passwordValidation($request)
    {
        return Validator::make($request->all(), [

            'password' => 'required|string|min:8|confirmed'
        ], [
            'password.required' => config('message.error_g1'),
            'password.min' => config('message.error_r5'),
            'password.confirmed' => config('message.error_r3')
        ]);
    }
}