@if (session('message'))
<div id='alerta_miss' class='alert alert-dismissible alert-{{ session('message.type') }}' role='alert'>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Tancar missatge'></button>
    <h4>{{ session('message.text') }}</h4>
</div>
@endif