<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acces interzis</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqjSvhOTqFOaNCeUsy5zVrFfak1bm5D1ZZgdd8E6c7k+k" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
        }

        .centered {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

    <div class="centered">
        <div class="container">
            <div class="alert alert-danger">
                <h1 class="display-4">Eroare 403: Acces interzis :(</h1>
                <p class="lead">Nu aveți acces la această pagină. Vă rugăm să vă conectați ca administrator.</p>
                <a href="/users/login" class="btn btn-custom btn-lg">Înapoi la pagina de autentificare</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy6t4vVXy2pPF+v" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqjSvhOTqFOaNCeUsy5zVrFfak1bm5D1ZZgdd8E6c7k+k" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqjSvhOTqFOaNCeUsy5zVrFfak1bm5D1ZZgdd8E6c7k+k" crossorigin="anonymous"></script>

</body>
</html>
