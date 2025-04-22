@extends('layout')
@section('content')
<main class="main_login">
    <form action="" method="post" class="form_section">
        @csrf
        <input type="hidden" name="user_id" value="{{ $id ?? Auth::user()->id }}"  />
        <div class="form-group">
            @if (Auth::user())
            <label class="form-label">Antiga Contrasenya</label>
            <input name="oldPassword" type="password" class="form-control" required>
            @else
            <input name="oldPassword" type="password" class="form-control hidden" value="{{ $oldPass }}" required>
            @endif
        </div>
        <div class="form-group">
            <label class="form-label">Nova Contrasenya</label>
            <input name="password" type="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Repetir contrasenya</label>
            <input name="password_confirmation" type="password" class="form-control" required>
        </div>
        <button type="submit" class="button">Canvia</button>
    </form>
</main>
@endsection