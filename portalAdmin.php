<?php

session_start();

//todo Validacion para que nadie pueda entrar a esta pagina sin haber iniciado sesion.
//? Si no existe una sesion de email, entonces es que no has iniciado sesion.
if (!isset($_SESSION['email'])) {
    echo '<script>alert("A donde vas pichón, metiendote en páginas sin iniciar sesión, encima en la de admin, no eres listo ni na 😈"); window.location = "login.php";</script>';
    //header("Location:login.php");
    die();
}

//? Puede pasar que haya iniciado sesion, pero que el valor del perfil sea de 1, por lo tanto no deberia de estar aqui.
//* si el valor de perfil es distinto de 0
if (($_SESSION['perfil'] != 100)) {
    header("Location:preLogin.php");
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- CDN Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Portal de admin</title>
</head>

<body>
    <style>
        .email {
            color: red;
            font-size: 20px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        img {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 1200px;
        }
    </style>
    <div class="flex my-4 p-8">
        <div class="flex-1 w-full">
            <h1>Bienvenido, has iniciado sesión con el correo: <span class='email'><?php echo $_SESSION['email']; ?></span></h1>
        </div>

        <img src="https://elcandelerotecnologico.files.wordpress.com/2021/07/varios_iebs_administrador-de-sistemas.jpg" alt="">

        <div>
            <a href="preLogin.php" class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"><i class="fa-solid fa-house"></i> Ir a Home</a>
        </div>
    </div>
</body>

</html>