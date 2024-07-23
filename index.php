<?php
// Gestion de sesiones inicia una sesion.
session_start();

// Inclusion de archivos requeridos, header incluye el encabezado.
// controller incluye la lógica principal del controlador de la aplicación.
require_once './views/header.php';
require_once './controllers/controller.php';

// Verifica si la variable $_SESSION['user'] esta establecida y no está vacía.
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    /* Si user a iniciado sesión llama al archivo mian.php, 
 * que contiene la vista main.php para los usuarios logeados.
 * Si los datos no son coincidentes se mantiene la vista login.
 */
    require_once './views/main.php';
} 
else {
   require_once './views/login.php';
}

// incluye el archivo footer.php que renderiza el pie de pagina.
require_once './views/footer.php';



//echo print_r($GLOBALS);






