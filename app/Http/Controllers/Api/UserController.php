<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        if(!auth()->user()->isAdmin) {
            return response()->json(['message' => 'No tens permisos per accedir a aquesta informació'], 403);
        }
        return response()->json(User::all());
    }

    public function show($id)
    {
        if(!auth()->user()->isAdmin) {
            return response()->json(['message' => 'No tens permisos per accedir a aquesta informació'], 403);
        }
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuari no trobat'], 404);
        }
        return response()->json($user);
    }
}
