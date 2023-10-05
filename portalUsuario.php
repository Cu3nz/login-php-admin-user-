<?php
session_start();

//todo Validacion para que solo se pueda acceder a esta pagina si ha iniciado sesion 

//* Si NO existe la sesion de email, es porque el email y la contraseña NO concuerdan 
if (!isset($_SESSION['email'])){
    echo '<script>alert("A donde vas pichón, Inicia sesion anda."); window.location = "login.php";</script>';

}

echo "<h1>Estas en el portal de usuarios con el correo de: {$_SESSION['email']}</h1>";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- CDN Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Portal de usuario</title>
</head>
<body>

<style>
    img{
        width: 300px;
        position: absolute;
        top: 20%;
        left: 50%;
  transform: translate(-50%, -50%);

    }
</style>

    <img src="https://static.vecteezy.com/system/resources/previews/007/033/150/non_2x/group-of-users-people-icon-group-team-vector.jpg" alt="">
    <br>
    <div>
            <a href="preLogin.php" class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"><i class="fa-solid fa-house"></i> Ir a Home</a>
        </div>
</body>
</html>