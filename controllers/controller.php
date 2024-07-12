<?php

/**
 * Do
 * 
 * @category    Description
 * @package     Category
 * @author      David De La Puente <ddelapuente@gmail.com>
 * @license     http://opensource.org/licenses/MIT MIT License
 * @link        http://url.com
 * @version     PHP 8.3.3 (cli) (built: Feb 13 2024 23:17:12) (ZTS Visual C++ 2019 x64)
 */



require './vendor/autoload.php'; // Asegúrate de que la ruta sea correcta
require_once './model/model.php';
require_once 'mail.php';

echo print_r([]);

if ($_GET) {
    if (isset($_GET['reg']) && !empty($_GET['reg'])) {
        echo print_r($_GET['reg']);
        // Llegamos desde el link de email.
        if (base64_decode($_GET['reg']) == 'REG_APP_MAIL') {
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                // Filtramos los datos del link y recogemos el nombre de usuario.
                $user_mail = htmlspecialchars(base64_decode($_GET['id']));
                // inistanciar nuevo usuario.
                $User = new Usuarios();
                $User->VerificarUsuario($user_mail);
                if ($user->getvalidar()) {
                    // enviar el 2º mail.
                    $res = "Cuenta activada, ya puede iniciar Logearse";
                    header('Location:https://Practica5.test/index.php?res=' . $res);
                } else {
                    $res = "El usuario no existe registrese!!!!!!!!";
                    header('location:https://Practica5.test/index.php?=' . $res);
                }
            }
        }
    }
    if(isset($_GET['accion']) && !empty($_GET['accion'])) {
        if($_GET['accion'] == 'cerrrar'){
            unset($_SESSION);
            session_destroy();
        }
    }
};

if ($_POST) {
    if (isset($_POST['accion']) and !empty($_POST['accion'])) {
        if (htmlspecialchars($_POST['accion']) == 'FORM_REG_LOGIN') {
            $db = new UsuariosDB();
            if ($resmysql = $db->GuardarUsuariosBD($_POST)) {
                if ($mail = new Mail(htmlspecialchars($_POST['email']),htmlspecialchars($_POST['user']))) {
                    $res = '<div class="alert alert-success">
                        Dato almacenado correctamente!!!<br>
                        Revise su correo electrónico para validar su usuario.
                    </div>';
                }
                else{
                    $res = '<div class="alert alert-success">Dato almacenado correctamente!!!</div>';
                }
            }
              else {
                    $res = '<div class="alert alert-danger">Error almacenando los datos!!!</div>';
            }
            /* La función de php rawurlencode() nos permite codificar 
            * la url para que las comillas no sean previamente interpretadas 
            */
            header("Location:https://practica5.test/index.php?res=" . rawurlencode($res));
        }
        if ($_POST['accion'] == 'FORM_LOGIN') {
            //  Accion Logear un Usuario.
            //  Filtrar los datos que llegan por POST.
            $datos['user'] = trim(htmlspecialchars_decode($_POST['user']));
            $datos['pass'] = trim(htmlspecialchars_decode($_POST['pass']));
            // Trabajo con un modelo.
            $UserDB = new UsuariosDB();
            $dtUsers = $UserDB->ConsultarUsuariosDB();
            $validacion == false;
            foreach ($dtUsers as $dtuser) {
                if ($dtUser['email'] === $datos['user'] && $dtUser['pass'] === MD5($datos['pass']) && $dtUser['status'] == 2) {
                    session_start();
                    $_SESSION['email'] = $dtUser['email'];
                    $_SESSION['user'] = $dtUser['name'];
                    header('location:https://Practica5.test/index.php');
                } else {
                    header('location:https://Practica5.test/index.php');
                }
            }
            echo print_r($_POST['accion']);
        }
    }
}

/**
 * Summary of Mail
 * 
 * @category Mail
 * @package  PHPmail
 * @author   David De La Puente <ddelapuente@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://url.com/php
 */

/**
 * Summary of Usuarios
 * 
 * @category Description
 * @package  Category
 * @author   David De La Puente <ddelapuente@gmail.com>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://url.com
 */
class Usuarios
{
    public $user;
    public $validar = "false";
    /**
     * Summary of getuser
     * 
     * @return mixed
     */
    public function getuser()
    {
        return $this->user;
    }
    /**
     * Summary of setUser
     *
     * @param mixed $user parameters used $user & return mixed values
     * 
     * @return void
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    /**
     * Summary of getvalidar
     * 
     * @return mixed
     */
    public function getvalidar()
    {
        return $this->validar;
    }
    /**
     * Summary of validar
     * 
     * @return mixed
     */
    public function validar()
    {
        $UserDB = new UsuariosDB();
        if ($UserDB->CambiarEstadoUsuariosBD($this->user)) {
            $this->validar = true;
        }
    }
    /**
     * Summary of cambiarEstadoUsuario
     *
     * @param bool $user    parameters used $user & return
     * @param bool $validar parameters used $user & return
     *              
     * @return void
     */
    public function CambiarEstadoUsuario($user, $validar)
    {
        if ($validar) {
            $this->validar = $user;
            $this->validar = $validar;
        }
    }
    public function EnviarMail($email){
        $this->user = $email;
        $this->validar = (string) $email;
        $this->validar = "";
    }
}
