<?php
/**
 * Importaciones de document. 
 * 
 * @category    PHP_Web_Application
 * @package     PHP_Web_Application
 * @author      "David De La Puente <ddelapuenteenriquez@gmail.com>"
 * @license     http://opensource.org/licenses/MIT MIT License
 * @version     GIT: https://github.com/
 * @php_version PHP 8.3.3
 * @link        https://www.example.com
 */

session_start();

require_once './views/header.php';
require_once './controllers/controller.php';


    if (isset($_SESSION['user']) && !empty($_SESSION['name'])) {
        require_once './views/main.php';
    } 
 else {
    require_once './views/login.php';
}

require_once './views/footer.php';
