@extends('layout')
@section('content')
<main class="home_main">
    <section class="hm_menu">
        <p> <a href="admin">Admin </a> </p>
        <div class="icons">
            <form action="" method="POST">
                @csrf
                <div class="dropdown">
                    <div tabindex="0" class="button button-lil" role="button" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" id="orderButton">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-label="Selecciona l'ordre dels elements" width="24"
                            height="24" viewBox="0 0 24 24" fill="none">
                            <title>Selecciona l'ordre dels elements</title>
                            <path
                                d="M2 4H15V6H2V4ZM2 11H15V13H2V11ZM3 18H2V20H13V18H3ZM19 21.414L19.707 20.707L22.707 17.707L23.414 17L22 15.586L21.293 16.293L20 17.586V4H18V17.586L16.707 16.293L16 15.586L14.586 17L15.293 17.707L18.293 20.707L19 21.414Z"
                                fill="black" />
                        </svg>
                    </div>
                    <ul class="dropdown-menu">
                        <li><button type="submit" class="dropdown-item" name="selectOrder" value="id">Id</button>
                        </li>
                        <li><button type="submit" class="dropdown-item" name="selectOrder" value="user">User</button>
                        </li>
                        <li><button type="submit" class="dropdown-item" name="selectOrder" value="mail">Mail</button>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </section>

    <section class="cards_container">
        @if($users)
        @foreach ($users as $user)
        @if ($user->user != 'Admin' && $user->user != 'Anon')
        <div class="grid_card">
            <article class="article_card" tabindex="0" role="button"
                onclick="showSidebar({{ json_encode($user) }}, 'user')">
                <img src="{{ asset('img/users/' . $user->image) }}"
                    alt="{{ $user->image == 'none.webp' ? 'Imatge no disponible' : " Imatge
                    d'usuari " . $user->user }}">
                <div class="ac_banner">
                    <h4 class="a_title"> {{ $user->user }}></h4>
                </div>

            </article>
        </div>
        @endif
        @endforeach
        @else
        No hi ha usuaris per mostrar
        @endif
    </section>
    @include ('partials._modal-delete')
    <section class="pages">
        <form action="" method="POST">
            @csrf
            <label for="paginacio" class="hidden-accessible">Selecciona la quantitat de articles per pàgina</label>
            <select id="paginacio" name="selectPagines" onchange="this.form.submit();">
                <option value="6" @selected($opcions['paginacio']==6)>6</option>
                <option value="12" @selected($opcions['paginacio']==12)>12</option>
                <option value="15" @selected($opcions['paginacio']==15)>15</option>
            </select>
        </form>
        @if($users)
        {{ $users->links() }}
        @endif

    </section>
</main>
@endsection