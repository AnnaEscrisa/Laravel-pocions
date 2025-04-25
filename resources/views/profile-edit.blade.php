@extends('layout')
@section('content')
<main class="home_main">
    <form action="" method="post" class="form_section">
        @csrf
        <div class="form-group">
            <label for="usuari" class="form-label">Usuari</label>
            <input id="usuari" name="usuari" class="form-control" type="text" value="{{ $user->user}}">
        </div>
        <input name="id" class="form-control" type="text" value="{{ $user->id}}" hidden required>

        <div class="form-group">
            <label for="nom">Nom</label>
            <input id="nom" name="nom" type="text" class="form-control" value="{{ $user->name}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ $user->email}}">
        </div>
        <button type="submit" class="button">Edita</button>
    </form>
</main>
@endsection