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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'D:\servidor\www\CURSO_OBJ\php\practicasGenericas\Practica5\vendor\autoload.php'; // Asegúrate de que la ruta sea correcta
require_once 'D:\servidor\www\CURSO_OBJ\php\practicasGenericas\Practica5\model\model.php';

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
                    header('Location:http://curso_obj.test/php/practicasGenericas/Practica5/index.php?res=' . $res);
                } else {
                    $res = "El usuario no existe registrese!!!!!!!!";
                    header('location:http://curso_obj.test/php/practicasGenericas/Practica5/index.php?=' . $res);
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
            header("Location:https://cursoobj.test/php/practica5/index.php?res=" . rawurlencode($res));
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
                    header('location:https://curso_obj.test/php/practicasGenericas/Practica5/index.php');
                } else {
                    header('location:https://curso_obj.test/php/practicasGenericas/Practica5/index.php');
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
class Mail
{
    public $user;
    public $to;
    public $subject;
    public $message;
    public $headers;
    public $from = 'ddelapuenteenriquez@gmail.com'; // tu cuenta de google.
    public $cco;
    public $cc;
    private $pass = ""; // password de aplicacion de Google.
    private $mail;
    public $enviado = false;

    /**
     * Summary of __construct
     * 
     * @param mixed $to   is the recipient's container email address
     * @param mixed $user is the user's container email address
     *                    Undocumented function to return
     * 
     * @return mixed
     */
    public function __construct($to, $user)
    {
        $this->to = $to;
        $this->user = $user;
        $this->mail = new PHPMailer(true);
        $this->ConstruirMail();
        $this->ConfigurarMail();
        $this->CrearCabeceras();
        $this->EnviarMail();
    }

    /**
     * Builds the email content.
     * 
     * @return ${:mixed}
     */
    private function ConstruirMail()
    {
        $this->subject = "Registro en aplicacion MVC";
        $this->message = '        
            <html>
            <head>
            <title>Bienvenido a nuestra App!!!</title>
            <p>Gracias por registarse, para seguir 
            con el proceso clicke el siguiente enlace</p>
            </head>
            <body style="background-color:blue; color:white;">
            <p>Su nombre de usuario es:' . $this->user . '</p>
            <a href="https://cursoobj.test/php/practica5/controllers/controller.php?id=' . base64_encode($this->user) . '&reg=' . base64_encode('REG_APP_MAIL') . '">REGISTRARSE</a>
            <p>Atentamente, el equipo de MVC Aplication.</p>
            </body>
            </html>';
    }

    /**
     * Configure the email settings.
     * 
     * @return mixed 
     */
    private function ConfigurarMail()
    {
        try {
            // Configuración del servidor SMTP
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com';  
            $this->mail->SMTPAuth = true; // Configuración del servidor SMTPS
            $this->mail->Username = 'ddelapuenteenriquez@gmail.com';
            $this->mail->Password = $this->pass;
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = 587;

            // Remitente y destinatario
            $this->mail->setFrom('ddelapuenteenriquez@gmail.com', 'Direccion');
            $this->mail->addAddress($this->to);

            // Contenido del correo
            $this->mail->isHTML(true);
            $this->mail->Subject = $this->subject;
            $this->mail->Body = $this->message;
        } catch (Exception $e) {
            echo "Error al configurar el correo: {$this->mail->ErrorInfo}";
        }
    }

    /**
     * Send email
     * 
     * @return mixed
     */
    private function EnviarMail()
    {   /** Exception handling: If an exception occurs, 
         *  it is logged in the log and the function returns false, 
         *  providing a clearer control flow.
         */
        try {
            if (isset($this->to, $this->subject, $this->message, $this->headers)) {            
                $this->mail->send($this->to, $this->subject, $this->message, $this->headers);
                return true;
            } else {
                throw new Exception("Faltan paràmetros para enviar el email");
            }
        } catch (Exception $e) {
            // Handle the exception here, for example, log the error.
            error_log('Error al enviar al email: ' . $e->getMessage());
            return false; // return false if an exception occurs.
        }
    }

    /** 
     * Create the email headers.
     * 
     * @return mixed
     */
    private function CrearCabeceras()
    {
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        // Additional headers
        $headers[] = "To: {$this->to}";
        $headers[] = 'From: Direccion<"ddelapuenteenriquez@gmail.com">';

        $this->headers = implode("\n", $headers);
    }

    /**
     * Receive e-mail
     * 
     * @return mixed 
     */
    public function recibirMail()
    {
        try {
            $this->mail->send($this->to, $this->subject, $this->message, $this->headers);
            return true;
        } catch (\Exception $e) {
            error_log('Error en la recepción del E-mail: '. $e->getMessage());
        }
    }
    /**
     * Summary of ResponderMail
     * 
     * @return mixed
     */
    public function responderMail()
    {
        try {
            if ($this->EnviarMail()) {
                echo "Correo de respuesta enviado con éxito.";
                return true;
            } else {
                echo "Error al enviar el e-mail de respuesta.";
                return false;
            }
        } catch (Exception $e) {
            // Handle the exception here, for example, log the error.
            error_log("Error al responder el e-mail: " . $e->getMessage());
            return false; // return false if exception occurs
        }
    }
    /**
     * Summary of FirmarMail
     * 
     * @return mixed
     */
    private function _firmarMail()
    {
    }
}
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
