@extends('layout')

@section('content')
<main class="main_login">
    <form action="" method="post" class="form_section">
        @csrf
        <div class="hstack">
            <div class="form-group">
                <label class="form-label">Usuari</label>
                <input name="user" class="form-control" type="text" required value="{{ old('user') | '' }}">
            </div>

            <div class="form-group">
                <label class="form-label">Nom</label>
                <input name="name" type="text" class="form-control" required value="{{ old('name') | '' }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Contrasenya</label>
            <input name="password" type="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label">Repetir contrasenya</label>
            <input name="password_confirmation" type="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="form-label">Email</label>
            <input name="email" type="email" class="form-control" required value="{{ old('email') | '' }}">
        </div>
        <button type="submit" class="button button-lil">Registrar-se</button>
    </form>
</main>

@endsection
