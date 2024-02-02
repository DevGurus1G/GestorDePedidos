<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recuperar Mail</title>
</head>
<style>
    .header {
        background: #3f3e3e;
        color: #ececec;
        font-family: Arial, Helvetica, sans-serif;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 1em;
    }

    .header img {
        height: 80px;
        width: 80px;
        border-radius: 50%;
    }

    p {
        font-family: Arial, Helvetica, sans-serif
    }

    p span {
        padding: .25em;
        border-radius: .125em;
        background: #3f3e3e;
        color: #ececec
    }
</style>

<body>
    <div class="header">
        <img src="{{ url('img/logo_empresa.png') }}" alt="logo">
        <h1>Killer Cervezas</h1>
    </div>
    <p>Su clave de acceso es <span>{{ $cliente->codigo_acceso }}</span></p>
</body>

</html>
