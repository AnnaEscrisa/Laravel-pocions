@extends('layout')
@section('content')
<main>
    <form action="" class="form_section form_section_h">
        <section class="form_main">
            @foreach (array_filter(Auth::user()->toArray(), function ($value, $key) {
            return $key !== 'id' && $key !== 'password' && $key !== 'isAdmin';
            }, ARRAY_FILTER_USE_BOTH) as $key => $value)
            <div class="form-group">
                <label class="form-label">{{$key == 'isSocial' ? 'Accés social' : $key}}</label>
                <input class="form-control unselectable"
                    value="{{ $key == 'isSocial' ? ($value == 1 ? 'Sí' : 'No') : $value }}">
            </div>
            @endforeach
            <a class="button" href="profile/edit">Editar dades</a>
        </section>
        <img src="{{ asset('img/users/none.webp')}}" alt="">
    </form>
    @if( !Auth::user()->isSocial)
    <section class="form_section">
        <a class="button" href="new_pass">Canviar contrasenya</a>
    </section>
    @endif

</main>
@endsection