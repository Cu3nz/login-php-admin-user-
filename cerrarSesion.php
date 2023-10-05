<?php 
//! Vamos a destruir la sesion para que asi podamos cerrar la sesion
session_start();
session_destroy();
header("Location:login.php");
?>