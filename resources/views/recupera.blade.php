@extends('layout')
@section('content')
<main class="container">

    <form action="" method="post">
        @csrf
        <label class="form-label">Usuari</label>
        <input name="user" class="form-control" type="text" type="text">
        <p>Si hi ha un correu associat a aquest usuari, se li enviarà un codi de confirmació</p>
        <input type="submit" class="button" value="Envia mail"></input>
    </form>

</main>
@endsection