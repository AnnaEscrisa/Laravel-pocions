<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Articles;

class PocionController extends Controller
{
    public function index()
    {
        return response()->json(Articles::all());
    }

    public function show($id)
    {
        $article = Articles::find($id);
        if (!$article) {
            return response()->json(['message' => 'Article no trobat'], 404);
        }
        return response()->json($article);
    }
}

   

    
