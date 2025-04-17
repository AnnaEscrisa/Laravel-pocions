<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Models\Articles;

class PocionsController extends Controller
{
    public function index(Request $request)
    {
        $opcions = $this->setHomeCookies($request);
        $articleName = $request['buscadorArticle'] ?? null;;

        $possiblePocio = Articles::where('titol', $articleName)->first();
        $pocions = $possiblePocio ?? Articles::withUserName()
        ->orderBy($opcions['order'])
        ->paginate($opcions['paginacio']);
        return view('home', [
            'opcions' => $opcions,
            'pocions' => $pocions,
            'Ruta' => 'Pocions'
        ]);
    }

    public function privades($user_id, Request $request)
    {
        if(isset($_SESSION['user'])){

            $opcions = $this->setHomeCookies($request);
            $articleName = $_POST['buscadorArticle'] ?? null;

            $possiblePocio = Articles::where('titol', $articleName)->first();
            $pocions = $possiblePocio ?? Articles::where('user_id', $user_id)
            ->orderBy($opcions['order'])
            ->paginate($opcions['paginacio']);

            return view('home', [
                'opcions' => $opcions,
                'pocions' => $pocions,
                'Ruta' => 'Les meves pocions'
            ]);
        }  
    }

    public function setHomeCookies(Request $request)
    {
        $max_articles = $request['selectPagines'] ?? Cookie::get('paginacioHome') ?? 6;
        $ordenacio_art = $request['selectOrder'] ?? Cookie::get('order_art') ?? 'titol';
        Cookie::queue('paginacioHome', $max_articles);
        Cookie::queue('order_art', $ordenacio_art);

        return [
            'paginacio' => $max_articles,
            'order' => $ordenacio_art
        ];
    }


}
