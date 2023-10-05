<?php
session_start();
//todo Validacion para que ningun usuario pueda acceder a esta pagina sin iniciar sesion

if (!isset($_SESSION['email'])){
    
    header("Location:login.php");
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
    <title>Despues de login</title>
</head>

<body>



<style>
    h1{
        position: relative;
        left: 30px;
    }

    h2{
        position: relative;
        left: 30px;
    }

    .admin{ /** Para saber que he iniciado sesion con un administrador esta en el h2  */
        color: red;
        font-size: 20px;
        text-decoration: underline;
    }

    .usuario{ /**Para saber que he iniciado sesion con un usuario esta en el h2 */
        color: red;
        text-decoration: underline;

    }

    .body_usuario{ /**Fondo cuando incias sesion con un usuario */
        
       background-color: #ADD8E6; 
       color: green;
       font-size: 20px;

    }

    .body_usuario button{ /**Mover el boton de cerrar sesion cuando inicias sesion con un usuario. */
        position: relative;
        left: 30px;
    }



    .body_admin{ /**Fondo y color de letra cuando inicia sesion un administrador */
        background-color: #000;
        color: #fff;
    }

    .email{ /** Email con el que inicia sesion el usuario, cambiar la letra, el color y el tamaño */
        color: red;
        font-size: 20px;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }
</style>


    

    <?php 
//? Si la sesion que guarda el perfil, es 100 es porque ha entrado como administrador (esta definido en el array de $usuarios) y pinto el fondo negro con las letras blancas junto con un mensaje y el correo con el que ha iniciado sesion (de color rojo) y otro mensaje diciendo que has iniciado sesion con un administrador
if ($_SESSION['perfil'] == 100) {
    echo "<body class='body_admin'>";
    echo "<h1>Bienvenido, has iniciado sesión con el correo: <span class='email'>" . $_SESSION['email'] . "</span></h1>";
    echo "<h2>Has iniciado sesion como un <span class='admin'><i>Administrador</i></span></h2>";

    echo "<button class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full'><a href='portalUsuario.php'>Ir al portal de usuario</a></button>"; //todo Boton para ir al panel de usuario
    
    echo "<button class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full'><a href='portalAdmin.php'>Ir al portal de Administracion</a></button>"; //todo Boton para ir al panel de administrador
    
    
} else { //! si no, es que has iniciado sesion con un usuario (valor en el array de 1) 
    //? Me va a pintar el fondo de azul, la letra verde, menos el correo con el que inicia sesion y el mesaje de que ha iniciado sesion con un usuario en rojo.
    echo "<body class='body_usuario'>";
    echo "<h1>Bienvenido, has iniciado sesión con el correo: <span class='email'>" . $_SESSION['email'] . "</span></h1>";
    echo "<h2>Has iniciado sesion como un <span class='usuario'><i>Usuario</i></span></h2>";
    echo "<br>";
    echo "<button class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full'><a href='portalUsuario.php'>Ir al portal de usuario</a></button>"; //todo Boton para ir al panel de usuario
}
    ?>

<br><br>

<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"><a href="cerrarSesion.php">Cerrar Sesion</a></button>
    
</body>

</html>

