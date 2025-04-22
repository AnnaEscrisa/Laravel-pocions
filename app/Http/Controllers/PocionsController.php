<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $article->id . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/articles/'), $filename);
                $article->update(['image' => $filename]);
            }
            return redirect()->route('home')->with('message', [
                'text' => config('message.success_a1'),
                'type' => 'success'
            ]);
        }
    }

    public function edit(Request $request, $id)
    {
        $validator = $this->validateArticle($request, $id);

        if ($validator->fails()) {
            return back()->withInput()->with('message', [
                'text' => $validator->errors()->first(),
                'type' => 'error'
            ]);
        }
        $article = Articles::find($id);

        $article->titol = $request->input('titol');
        $article->cos = $request->input('cos');

        if ($article->update(['titol' => $article->titol, 'cos' => $article->cos])) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $article->id . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/articles/'), $filename);
                $article->update(['image' => $filename]);
            }
            return redirect()->route('home')->with('message', [
                'text' => config('message.success_a2'),
                'type' => 'success'
            ]);
        }
    }

    public function clone(Request $request)
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
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $article->id . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/articles/'), $filename);
                $article->update(['image' => $filename]);
            }
            return redirect()->route('home')->with('message', [
                'text' => config('message.success_a1'),
                'type' => 'success'
            ]);
        }
    }

    public function delete($id)
    {
        $article = Articles::find($id);
        if ($article) {
            $this->checkPermissions($article);
            $article->delete();
            return redirect()->route('home')->with('message', [
                'text' => config('message.success_g1'),
                'type' => 'success'
            ]);
        } else {
            return redirect()->route('home')->with('message', [
                'text' => config('message.error_a4'),
                'type' => 'error'
            ]);
        }
    }

    private function validateArticle(Request $request, $articleId = null)
    {
        return Validator::make($request->all(), [
            'titol' => ['required','string','max:40',Rule::unique('articles')->ignore($articleId)],
            'cos' => 'required|string|max:400',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'titol.required' => config('message.error_g1'),
            'titol.unique' => config('message.error_a1'),
            'titol.max' => config('message.error_g2'),
            'titol.string' => config('message.error_g4'),

            'cos.required' => config('message.error_g1'),
            'cos.max' => config('message.error_g2'),
            'cos.string' => config('message.error_g4'),

            'image.image' => config('message.error_i1'),
            'image.mimes' => config('message.error_i1'),
            'image.max' => config('message.error_i2')
        ]);
    }

    private function checkExistance($articleId)
    {
        $article = Articles::find($articleId);
        if (!$article) {
            abort(404, 'article_not_found');
        }
        return $article;
    }

    private function checkPermissions($article)
    {
        if ($article->user_id !== Auth()->user()->id) {
            abort(403, 'permis_pocio_denegat');
        }
    }

    public function formView(Request $request, $articleId = null, $clone = false, )
    {
        if ($articleId && $clone) {
            $article = $this->checkExistance($articleId);

            $dadesBuides = ['titol', 'descripcio', 'ingredients', 'imatge'];

            foreach ($dadesBuides as $dada) {
                if ($request->query($dada) === 'false') {
                    $article->$dada = ''; 
                }
            }

        } elseif ($articleId) {
            $article = $this->checkExistance($articleId);
            $this->checkPermissions($article);
        } else {
            $article = new Articles();
        }

        return view('articles-form', ['article' => $article]);
    }

    public function cloneView(Request $request, $articleId)
    {
        return $this->formView($request, $articleId, true);
    }
}
