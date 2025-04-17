@extends('layout')

@section('content')

<main class="main_login">
    <form action="" method="post" class="form_section">
        <section class="form_main">
            <div class="form-group">
                <label class="form-label">Usuari *</label>
                <input name="usuari" class="form-control" type="text" value="<?= $_COOKIE['recorda'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Contrasenya *</label>
                <input name="password" type="password" class="form-control">
            </div>
            <div class="form-group">

                <label class="form-label checkbox">
                    <input type="checkbox" name="recorda" class="hidden-accessible">
                    <span class="checkbox-container"></span>
                    Recorda'm
                </label>

                @if (isset($_COOKIE['intentsLogin']) && $_COOKIE['intentsLogin'] >= 3): ?>
                <div class='g-recaptcha' data-sitekey="<?= env('CAPTCHA_KEY')  ?>"></div>
                @endif
                <p> <a href="recuperacio">Has oblidat la contrasenya? </a> </p>
            </div>
            <div class="form-group">
                <button class="button button-lil">Login</button>
                <p> No tens compte d'usuari? <a href="registre">Registra't</a> </p>
            </div>
        </section>

        <section class="form_social">
            <a class="button button-lil" role="button" href="login?github=true">Iniciar sessio amb GitHub</a>
            <a class="button button-lil" role="button" href="login?deviantart=true">Iniciar sessio amb
                DeviantArt</a>
        </section>
    </form>
</main>

@endsection