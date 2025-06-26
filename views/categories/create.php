<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaugă Categorie</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
            padding-top: 50px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #e2a03f; /* Culoare aurie, asortată cu tema apicolă */
        }

        .form-container .form-control {
            border-radius: 10px;
            box-shadow: none;
        }

        .form-container .btn {
            width: 100%;
            font-size: 1.1rem;
            padding: 12px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-container .btn-dark {
            background-color: #343a40;
            border: none;
            color: #fff;
        }

        .form-container .btn-dark:hover {
            background-color: #23272b;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .form-container label {
            font-weight: bold;
            color: #555;
        }

        .form-container .mb-3 {
            margin-bottom: 20px;
        }

        .form-container .form-control:focus {
            border-color: #e2a03f; /* Culoare focus similară cu aurul */
            box-shadow: 0 0 5px rgba(226, 160, 63, 0.5);
        }

        .form-container .form-control::placeholder {
            color: #888;
        }

        .form-container .btn-sm {
            width: auto;
            margin-top: 20px;
        }

        .form-container .form-select, .form-control {
            background-color: #f8f9fa;
        }

        .form-container .form-select:focus, .form-control:focus {
            border-color: #e2a03f;
            box-shadow: 0 0 5px rgba(226, 160, 63, 0.5);
        }
    </style>
</head>
<body>
    <?php include '../views/navbar.php'; ?>
    
    <div class="container">
        <div class="row py-2 justify-content-center h5">
            <h3 class="text-center">Adaugă Categorie Nouă</h3>
        </div>
        <div class="row">
            <div class="col-md-6 m-auto form-container">
                <!-- Formular pentru crearea categoriei -->
                <form action="/categories/store" method="post">
                    <div class="mb-3">
                        <label for="nume">Nume Categorie</label>
                        <input type="text" name="nume" id="nume" class="form-control" placeholder="Introduceti numele categoriei" required>
                    </div>
                    <button type="submit" class="btn btn-dark btn-sm">Salvează Categorie</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
