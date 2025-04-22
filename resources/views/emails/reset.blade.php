<!DOCTYPE html>
<html>

<head>
    <title>Recuperar contrasenya</title>
</head>

<body>
    <p>Hola {{$user->name}},</p>
    <p>Aquest és el teu codi de recuperació per la teva contrasenya:</p>
    <a href='{{$link}}'>Recupera la contrasenya</a>
</body>

</html>