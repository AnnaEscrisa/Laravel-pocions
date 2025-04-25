<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $request){

        $opcions = $this->setHomeCookies($request);

        $users = User::orderBy($opcions['order'])
            ->paginate($opcions['paginacio']);
        return view('users', [
            'opcions' => $opcions,
            'users' => $users,
            'Ruta' => 'Admin'
        ]);
    }

    public function profile($id){
        $user = User::find($id);
        if ($user->id != auth()->user()->id && !auth()->user()->isAdmin) {
            abort(403);
        }
        if (!$user) {
            return redirect()->route('home')->with('error', 'Usuari no trobat');
        }

        return view('profile')->with('user', $user);
    }

    public function editView($id){
        $user = User::find($id);
        if ($user->id != auth()->user()->id && !auth()->user()->isAdmin) {
            abort(403);
        }
        if (!$user) {
            return redirect()->route('home')->with('error', 'Usuari no trobat');
        }

        return view('profile-edit')->with('user', $user);
    }

    public function update(Request $request, $id = null)
    {
        $user = User::find($id);
        if ($user->id != auth()->user()->id && !auth()->user()->isAdmin) {
            abort(403);
        }
        if (!$user) {
            return redirect()->route('home')->with('error', 'Usuari no trobat');
        }

        $validator = $this->validateUpdate($request, $id);
        if ($validator->fails()) {
            return back()->withInput()->with('message', [
                'text' => $validator->errors()->first(),
                'type' => 'error'
            ]);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->user = $request->input('user');
        $user->save();

        return redirect()->route('profile', ['id' => $user->id])->with('message', [
            'text' => config('message.success_r2'),
            'type' => 'success'
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user->id != auth()->user()->id && !auth()->user()->isAdmin) {
            abort(403);
        }
        if (!$user) {
            return redirect()->route('home')->with('error', 'Usuari no trobat');
        }

        $user->delete();

        return redirect()->route('home')->with('message', [
            'text' => config('message.success_r3'),
            'type' => 'success'
        ]);
    }

    private function setHomeCookies(Request $request)
    {
        $max_users = $request['selectPagines'] ?? Cookie::get('paginacioUsers') ?? 6;
        $ordenacio_users = $request['selectOrder'] ?? Cookie::get('order_users') ?? 'id';
        Cookie::queue('paginacioHome', $max_users);
        Cookie::queue('order_art', $ordenacio_users);

        return [
            'paginacio' => $max_users,
            'order' => $ordenacio_users
        ];
    }

    private function validateUpdate($request, $id = null)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50',
            'user' => ['required','string','max:40',Rule::unique('users')->ignore($id)],
        ], [
            'name.required' => config('message.error_g1'),
            'email.required' => config('message.error_g1'),
            'user.unique' => config('message.error_r2'),
            'name.max' => config('message.error_g2'),
            'email.max' => config('message.error_g2'),
            'email.email' => config('message.error_r4'),
        ]);
    }

}