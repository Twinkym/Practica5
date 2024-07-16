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
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php'; // Asegúrate de que la ruta sea correcta
require_once $_SERVER['DOCUMENT_ROOT'].'/model/model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/mail.php';


if ($_GET) {
    if (isset($_GET['reg']) && !empty($_GET['reg'])) {
        //Llegamos desde el link de email.
        if (base64_decode($_GET['reg']) == 'REG_APP_MAIL') {
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                // Filtramos los datos del link y recogemos el nombre de usuario.
                $user_mail = htmlspecialchars(base64_decode($_GET['id']));

                $User = new Usuarios();
                $User->VerificarUsuario($user_mail);
                if ($User->getValidar()) {
                    # Enviar el 2º mail.
                    $res = "Cuenta activada, ya puede iniciar Sesión";
                    header('location:https://Practica5.test/index.php?=' . $res); // Redirigimos a la página de inicio.
                } else {
                    $res = "El usuario no existe regístrese!!!!";
                    header('location:https://Practica5.test/index.php?=' . $res); // Redirigimos a la página de inicio.
                }
            }
        }
    }

    if (isset($_GET['accion']) && !empty($_GET['accion'])) {
        if ($_GET['accion'] == 'cerrar') {

            unset($_SESSION);
            session_destroy();
        }
    }
    if (isset($_GET['views']) && !empty($_GET['views'])) {
        if ($_GET['views'] == 'usuarios') {
            $UserDB = new UsuariosDB();
            $DatosUsers = $UserDB->ConsultarUsuariosDB();
        }
    }
}


if ($_POST) {
    if (isset($_POST['accion']) and !empty($_POST['accion'])) {
        # Comprobación de la acción del Formulario.
        # Se verifica si la acción enviada en el formulario es 'FORM_REG_LOGIN'.
        # HSC func. se usa para convertir caracteres especiales en entidades HTML, esto 
        # ayuda a prevenir Inject HTML y para evitar ataques XSS.
        if (htmlspecialchars($_POST['accion']) == 'FORM_REG_LOGIN') {
            # Instanciamos la clase UsuarisDB que debe gestionar las OPS. de la DB con usuarios.
            $db = new UsuariosDB();
            # Llamamos a la func. GuardarUsuariosBD. para almacenar los datos del form. exito = next step.
            if ($resmysql = $db->GuardarUsuariosBD($_POST)) {
                    # Si guardado exitoso se envia un mail, y se muestra el msg de exito. si no solo se muestra el mail.
                $res = ($mail = new Mail(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['user']))) ? '<div class="alert alert-success">Dato almacenado correctamente!!!<br>Revise su correo electrónico para validar su usuario.</div>' : '<div class="alert alert-success">Dato almacenado correctamente!!!</div>';
            } else { $res = '<div class="alert alert-danger">Error almacenando los datos!!!</div>';}
            /* La función de php rawurlencode() nos permite codificar la url para que las comillas no sean previamente interpretadas */
            header("Location:https://Practia5.test/index.php?res="
            .rawurlencode($res));
        }

        if ($_POST['accion'] == 'FORM_LOGIN') {

            // Acción de Logear un Usuario.
            // filtrar los datos que llegan por POST.
            $datos['user'] = trim(htmlspecialchars_decode($_POST['user']));
            $datos['pass'] = trim(htmlspecialchars_decode($_POST['pass']));
            /// Trabajo con un modelo
            $UserDB = new UsuariosDB();
            $dtUsers = $UserDB->ConsultarUsuariosDB();
            $validacion = false;
            foreach ($dtUsers as $dtUser) {
                if ($dtUser['email'] === $datos['user'] && $dtUser['pass'] === MD5($datos['pass']) && $dtUser['status'] == 2) {
                    session_start();
                    $_SESSION['email'] = $dtUser['email'];
                    $_SESSION['user'] = $dtUser['name'];
                    $validacion = true;
                    break;
                }
            }

            switch ($validacion) {
                case true:
                    header('location:https://Practica5.test/index.php');
                    break;
                default:
                    header('location:https://Practica5.test/index.php');
                    break;
            }
        }
    }
}


class Usuarios
{
    public $user;
    public $validar = "false";

    public function getUser()
    {
        return $this->user;
    }
    public function getValidar()
    {
        return $this->validar;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function VerificarUsuario($user)
    {
        // Buscar en la BD si el usuario que trae el link está previamente registrado.
        // cambiar el estado de 1 a 2.
        $UserDB = new UsuariosDB();
        if ($UserDB->CambiarEstadoUsuariosBD($user)) {
            $this->validar = true;
        }
    }
}
