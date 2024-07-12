<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
            <a href="https://practica5.test/controllers/controller.php?id=' . base64_encode($this->user) . '&reg=' . base64_encode('REG_APP_MAIL') . '">REGISTRARSE</a>
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
            $this->mail->Password = $this->pass;  // App Password.
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
    {
        /** Exception handling: If an exception occurs, 
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
            error_log('Error en la recepción del E-mail: ' . $e->getMessage());
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
