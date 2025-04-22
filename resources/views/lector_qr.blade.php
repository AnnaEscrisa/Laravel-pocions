@extends('layout')
@section('content')
<main>
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <label class="form-label">Codi:</label>
        <input type="file" name="imatge" class="form-control" placeholder="Codi QR">
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
</main>
@endsection