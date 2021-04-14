<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controle de Série</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

@auth()
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-center-between">
    <div class="container-fluid">
        <a class="navbar-brand" href="/series">Home</a>
        <a class="navbar-brand text-danger" href="/logout">Sair</a>
    </div>
</nav>
@endauth

<div class="container">
    <div class="jumbotron">
        <h1> @yield('cabecalho')</h1>
    </div>

    @yield('conteudo')

</div>

</body>
</html>
