<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Register</title>
</head>
<body>
    @foreach ($errors->all() as $error)
        <p style="border: 1px solid red; padding: .5rem;">{{ $error }}</p>
    @endforeach

    <h1> Registrar Usuário </h1>

    <form action="{{ route('user.store') }}" method="post">
        @csrf

        <div>
            <label for="username"> Nome de Usuário </label>
            <input type="text" name="username" id="username">
        </div>

        <div>
            <label for="name"> Nome de Exibição </label>
            <input type="text" name="name" id="name">
        </div>

        <div>
            <label for="email"> E-mail </label>
            <input type="email" name="email" id="email">
        </div>

        <div>
            <label for="password"> Senha </label>
            <input type="password" name="password" id="password">
        </div>

        <button> Registre-se </button>
    </form>
</body>
</html>