<?php
//* las variable de sesiones se guardan en el navegador y se utilizan cuando queramos siempre se inicializan al principio de la pagina
session_start(); //? Esto siempre tenemos que poner para poder utilizar las sesiones.

//* Funcion que muestra un mensaje de error y despues destruye la sesion
function mostrarErrores($nombre_varSesion)
{
    //* Si existe un error de sesion (puede ser de email, contraseña o validacion)
    if (isset($_SESSION[$nombre_varSesion])) {
        echo "<p class='mt-2 text-red-700 text-sm italic'>{$_SESSION[$nombre_varSesion]}</p>"; //? muestra el mensaje de error
        unset($_SESSION[$nombre_varSesion]); //! destruye la sesion.
    }
}



//todo Poder utilizar el archivo usuarios.php en esta pagina, basicamente como si fuera un archivo externo de css o de js.

require "usuarios.php"; //? Para poder trabajar con el array en este archivo, para futuras verificaciones de usuario y poder iniciar sesion.
$errores = false; //? definimos una variable de error a false



//Todo Verificacion de que el usuario ha pulsado el boton de enviar el formulario.

if (isset($_POST['btnlogin'])) { //* si existe el post del boton de login es porque el usuario ha pulsado el boton de enviar el login
    
    //todo Almacenamos el email y la contraseña en las variables con su correspodinete seguridad.
    
    $email = htmlspecialchars(trim($_POST['email']));
    $pass = htmlspecialchars(trim($_POST['password']));
    
    
    //todo Hacemos las verificaciones de email (que pase el filtro) y password
    
    //* Si el email que se ha introducido por el formulario no pasa los filtros, mostramos un mensaje de error. 
    //* La variable $errores la pones a true
    //* Creamos una variable $mensaje donde se almacena el mensaje de error
    //? Creamos una sesion llamada err_email , la utilizaremos justo debajo de los input de tipo correo y password
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores = true;
        $mensaje = "****** Escribe un email correcto";
        $_SESSION['err_email'] = $mensaje;
    }
    
    //todo Validar si el correo que introduce el usuario, esta dentro del array
    if (!in_array($email, $usuarios)) {
        $noarray = "No existe el correo que has introducido en el array";
    }
    
    
    

    //* Si el numero de caracteres que tiene la contraseña es = 0 mostramos el siguiente error. 

    if (strlen($pass) == 0) {
        $errores = true;
        $_SESSION['err_pass'] = "Error la contraseña no puede estar vacia"; //? Lo que hay dentro de los corchetes es el nombre de la sesion

    }

    //! Si hay algun tipo de error volvemos a cargar la pagina de login

    if ($errores) { //! si hay errores, vuelvo a cargar la pagina y dejo de ejecutar php
        // voy a validar al usuario.
        header("Location:{$_SERVER['PHP_SELF']}");
        die(); //* deja de ejecutar php 
    }

    //todo Si llego aqui es porque el email y la contraseña es correcta.

    $validacion = false;
    //* Ahora vamos a comprobar con el foreach que si el correo y la contraseña que ha introducido el usuario concuerda.


    foreach ($usuarios as $usuario) {
        //* Si el email que ha introducido el usuario es igual a alguno que hay en la posicion 0  en el array y ademas concuerda con la contraseña que se almacena en la posicion 1 del array
        if ($email == $usuario[0] && $pass == $usuario[1]) { //! Cuidado es $usuario, donde se almacena los correos, contraseña y el perfil 
            //? Guardamos en una sesion el email , para luego hacer verificaciones de que si el usuario ha iniciado sesion o no.
            //? Guardamos en la sesion perfil el valor de 1 o 100, para luego hacer validaciones de quien se loguea como admin o como usuario.
            $_SESSION['email'] = $email;
            $_SESSION['perfil'] = $usuario[2];
            $validacion = true;
            break;
        }
    }

    //todo Si $validacion es true nos lleva a la siguiente pagina de login

    if ($validacion) {
        header("Location:preLogin.php");
        die();
    }

    //todo si he llegado aqui es porque el email esta mal, la contraseña o ambos

    $_SESSION['errorValidacion'] = "***** Email o contrasña incorrecto o ambos";
    header("Location: {$_SERVER['PHP_SELF']}");
} else { //! Abro la llave de cierre del else 

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
        <title>Login</title>
    </head>

    <body>

        <section class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Sign in to your account
                        </h1>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">

                                <!--//todo Para que aparezca el mensaje de error debajo del input de correo-->
                                <?php

                                /*if (isset($_SESSION['err_email'])){
                                echo "<p class='mt-2 text-red-700 text-sm italic'>{$_SESSION['err_email']}</p>"; //? muestra el mensaje de error
                                }
                                unset($_SESSION['err_email']);*/
                                //* Utilizando la funcion 
                               mostrarErrores('err_email');
                                ?>

                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <?php

                                //? Si existe un error de sesion con el nombre err_pass me muestra el siguiente mensaje y luego se destruye.
                                /*if (isset($_SESSION['err_pass'])){
                                    echo "<p class='mt-2 text-red-700 text-sm italic'>{$_SESSION['err_pass']}</p>"; //? muestra el mensaje de error  
                                    unset($_SESSION['err_pass']);
                                }*/

                                //todo trabajando con una funcion

                                MostrarErrores('err_pass');


                                ?>

                            </div>

                            <br>
                            <button type="submit" name="btnlogin" class="w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Login</button>

                            <?php
                            mostrarErrores('errorValidacion');

                            /*if (isset($_SESSION['errorValidacion'])){
                                
                            echo "<p class='text-red-600 text-sm italic'>{$_SESSION['errorValidacion']}</p>";

                            unset($_SESSION['errorValidacion']); //* 
                            
                            }*/
                            ?>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>

    </html>
<?php
} //! cierro la llave del else, por si hay algun problema en el login que vuelva a cargar el formumlario
?>