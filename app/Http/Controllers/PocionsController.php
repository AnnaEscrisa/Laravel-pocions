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
        $articleName = $request['buscadorArticle'] ?? null;
        ;

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

    public function privades(Request $request)
    {
        $user_id = Auth()->user()->id;

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

    public function insert(Request $request)
    {
        $validator = $this->validateArticle($request);

        if ($validator->fails()) {
            return back()->withInput()->with('message', [
                'text' => $validator->errors()->first(),
                'type' => 'error'
            ]);
        }

            $article = new Articles();
            $article->titol = $request->input('titol');
            $article->cos = $request->input('cos');
            $article->user_id = Auth()->user()->id;
         
            if ($article->save()) {
                
            }
    }

    private function validateArticle(Request $request)
    {
        return $request->validate([
            'titol' => 'required|string|max:40|unique:articles',
            'cos' => 'required|string|max:400',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'titol.required' => 'message.error_g1',
            'titol.string' => 'message.error_g4',
            'titol.max' => 'message.error_g2',
            'titol.unique' => 'message.error_a1',
            'cos.required' => 'message.error_g1',
            'cos.string' => 'message.error_g4',
            'cos.max' => 'message.error_g2',
            'image.image' => 'message.error_i1',
            'image.mimes' => 'message.error_i1',
            'image.max' => 'message.error_i2'
        ]);
    }

    public function formView(Request $request)
    {
        return view('articles-form'); 
    }


}
