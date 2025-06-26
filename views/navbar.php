<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazin Apicole</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff8e1;
        }

        .navbar {
            background-color: #ffeb3b;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
            color: #3e2723;
        }

        .navbar-toggle {
            font-size: 30px;
            cursor: pointer;
            color: #3e2723;
        }

        /* Стиль для выезжающего меню справа */
        .side-menu {
            height: 100%;
            width: 0;
            position: fixed;
            top: 0;
            right: 0;
            background-color: #3e2723;
            color: white;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .side-menu a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: white;
            display: block;
            transition: 0.3s;
        }

        .side-menu a:hover {
            color: #ffeb3b;
        }

        .side-menu .close-btn {
            position: absolute;
            top: 0;
            left: 25px;
            font-size: 36px;
            color: white;
            padding: 20px;
        }

        /* Кнопки внизу меню */
        .side-menu .bottom-links {
            margin-top: auto; /* Отодвигает эти ссылки в нижнюю часть */
            padding: 20px;
            text-align: center;
        }

        .bottom-links a {
            padding: 10px 15px;
            font-size: 18px;
            color: white;
            text-decoration: none;
            display: block;
            transition: 0.3s;
        }

        .bottom-links a:hover {
            color: #ffeb3b;
        }

        .content {
            padding: 20px;
        }

    </style>
</head>

<body>

    <div class="navbar">
        <span class="navbar-brand"><a href="/products" class="navbar-brand">Magazin Apicol</a></span>
        <span class="navbar-toggle" onclick="openMenu()">&#9776;</span>
    </div>

<!-- Меню, которое появляется справа -->
<div id="sideMenu" class="side-menu">
    <a href="javascript:void(0)" class="close-btn" onclick="closeMenu()">&times;</a>
    <a href="/products">Produse</a>
    <a href="/categories">Categorii</a>
    <a href="/products/create">Adaugă produs</a>
    <a href="/categories/create">Adaugă categorie</a>
    <a href="/orders">Comenzi</a>

    <!-- Кнопки для логина, профиля и выхода -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="bottom-links">
        <a href="/users/profile/<?php echo $_SESSION['user_id']; ?>">Profil</a>
            <a href="/users/logout">Ieșire</a>
        </div>
    <?php else: ?>
        <div class="bottom-links">
            <a href="/users/login">Autentificare</a>
            <a href="/users/register">Înregistrare</a>
        </div>
    <?php endif; ?>
</div>


    <div class="content">
        <h1>Bine ați venit la Magazinul Apicol!</h1>
        <p>Aici puteți găsi cele mai bune produse apicole.</p>
    </div>

    <script>
        // Функция для открытия меню
        function openMenu() {
            document.getElementById('sideMenu').style.width = '250px'; // Ширина меню
        }

        // Функция для закрытия меню
        function closeMenu() {
            document.getElementById('sideMenu').style.width = '0'; // Меню закрывается
        }
    </script>

</body>

</html>
