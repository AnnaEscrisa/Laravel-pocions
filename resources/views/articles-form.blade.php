@extends('layout')

@section('content')
<main class="home_main">
    <section class="hm_menu">
        <p> <a href="/">Pocions</a> > {{$Ruta }} </p>
    </section>
    <form action="" method="post" class="form_section article" enctype="multipart/form-data" id="article_form">
        @csrf
        <input hidden class="form-control" type="text" name="id" value="<?= $_GET['id'] ?? '' ?>">
        <div class="form-group">
            <label for="titol" class="form-label">Títol*</label>
            <input id="titol" class="form-control" type="text" name="titol" placeholder="Títol de l'article"
            value="{{ old('titol', $article->titol ?? '') }}">
        </div>

        <div class="form-group">
            <label for="cos" class="form-label">Descripció*</label>
            <textarea id="cos" class="form-control" name="cos"
                placeholder="Descripció de l'article">{{ old('cos', $article->cos ?? '') }}</textarea>
        </div>

        <!--no implementat a backend -->
        <div class="form-group">
            <label for="tipus" class="form-label">Tipus</label>
            <select name="tipus" id="tipus">
                <optgroup>
                    <option value="proteccio">Protecció</option>
                    <option value="malediccio">Maledicció</option>
                    <option value="encanteri">Encanteri</option>
                    <option value="endevinacio">Endevinacio</option>
                </optgroup>
            </select>
        </div>

        <!--no implementat a backend -->
        <div class="form-group">
            <label class="form-label"> Ingredients</label>
            <div class="hstack">
                <button type="button" class="button" data-ingredients
                    onclick="showSidebar('vegetals', 'form')">Vegetals</button>
                <button type="button" class="button" data-ingredients
                    onclick="showSidebar('animals', 'form')">Animals</button>
                <button type="button" class="button" data-ingredients
                    onclick="showSidebar('minerals', 'form')">Minerals</button>
            </div>
        </div>

        <div class="form-group">
            <label for="image" class="form-label">Imatge</label>
            <input id="image" type="file" name="image" class="form-control" placeholder="Imatge">
            <input type="hidden" name="imatgePrevia" value="{{ old('image', $article->image ?? 'none.webp') }}">
        </div>

        <button type="submit" class="button button-lil">
            {{ $Ruta != 'Nou Article' ? 'Editar' : 'Inserir'}}
        </button>
    </form>
</main>

@endsection