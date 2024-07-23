<?php
require_once 'D:\servidor\www\Practica5\vendor\autoload.php'; // Asegúrate de que la ruta sea correcta
require_once 'D:\servidor\www\Practica5\model\model.php';
require_once 'D:\servidor\www\Practica5\controllers\mail.php';
require_once 'D:\servidor\www\Practica5\controllers\usuarios.php';



if ($_GET) {
    if (isset($_GET['reg']) && !empty($_GET['reg'])) {
        // Llegamos desde el link de email
        if (base64_decode($_GET['reg']) == 'REG_APP_MAIL') {
            if (isset($_GET['id']) && !empty($_GET['id'])) {

                // filtramos los datos del link y recogemos el nombre de usuario.
                $user_mail = htmlspecialchars(base64_decode($_GET['id']));

                $User = new Usuarios();
                $User->VerificarUsuario($user_mail);
                if ($User->getValidar()) {
                    // enviar el 2ª mail
                    $res = "Cuenta activada, ya puede iniciar Logearse";
                    header('location:https://practica5.test/index.php?res=' . $res);
                } else {

                    $res = "El usuario no existe regístrese!!!!!!";
                    header('location:https://practica5.test/index.php?res=' . $res);
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
}

if ($_POST) {
    if (isset($_POST['accion']) and !empty($_POST['accion'])) {
        if (htmlspecialchars($_POST['accion']) == 'FORM_REG_LOGIN') {
            $db = new UsuariosDB();
            if ($resmysql = $db->GuardarUsuariosBD($_POST)) {

                if ($mail = new Mail(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['user']))) {

                    $res = '<div class="alert alert-success">
                                Dato almacenado correctamente!!!<br>
                                Revise su correo electrónico para validar su usuario.
                            </div>';
                } else {
                    $res = '<div class="alert alert-success">Dato almacenado correctamente!!!</div>';
                }
            } else {
                $res = '<div class="alert alert-danger">Error almacenando los datos!!!</div>';
            }
            /* La función de php rawurlencode() nos permite codificar la url para que las comillas no sean previamente interpretadas */
            header("Location:https://practica5.test/index.php?res=" . rawurlencode($res));
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
                    $_SESSION['rowid'] = $dtUser['rowid'];
                    $validacion = true;
                    break;
                }
            }

            if ($validacion == true) {
                header('location:https://practica5.test/index.php');
            } else {
                header('location:https://practica5.test/index.php');
            }
        }
    }
}

class FiltrarDatos
{

    public function Filtrar($datos)
    {
        // Verificar el contenido del array de datos para depuración.
        foreach ($datos as $key => $value) {
            echo "Los indices son: $key, los valores de los indices son: $value</br>";
        }
        foreach ($datos as $key => $value) {
            if (is_string($datos)) {
                $datos = trim($datos);
                $datos = stripslashes($datos);
                $datos = htmlspecialchars($datos);

                // Convertir el password a MD5
                if (isset($datos['pass'])) {
                    $datos['pass'] = MD5($datos['pass']);
                }
            }
        }
        // Retornar el array $datos filtrado.
        return $datos;
    }
}
