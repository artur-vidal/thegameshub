<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Login</title>
</head>
<body>
    @foreach ($errors->all() as $error)
        <p style="border: 1px solid red; padding: .5rem;">{{ $error }}</p>
    @endforeach

    <h1>Login</h1>

    <form action="{{ route('login') }}" method="post">
        @csrf

        <div>
            <label for="login-field"> Nome de Usuário ou Email </label>
            <input type="text" name="login-field" id="login-field">
        </div>

        <div>
            <label for="password"> Senha </label>
            <input type="password" name="password" id="password">
        </div>

        <button> Entrar </button>
    </form>
</body>
</html>