<?php
namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email,$nombre,$token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarEmailConfirmacion(){
            /**Copiado de Composer*/
            #Configurar el SMTP
            $mail = new PHPMailer();
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = "sandbox.smtp.mailtrap.io";             //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = "34632f45fe1840";                       //SMTP username
            $mail->Password   = "dca63e7a70b3df";                       //SMTP password
            $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
            $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            #Configura el contenido del mensaje
            $mail->setFrom("from@example.com"); //Quien envia el mensaje
            $mail->addAddress("from@example.com", "a18000621@alumnos.uady.mx");     //Add a recipient
            $mail->Subject = "Confirma tu cuenta";

            #Habilitar HTML
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->CharSet = "UFT-8";      
           
            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre .  ".</strong> Has creato tu cuenta en 
            AppSalon, solo debes confirma tu cuenta presionando en el siguiente enlace.</p>";
            $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
            $contenido .= "<p>Si no solicitaste esta cuenta, ignora el mensaje.</p>";
            $contenido .= "</html>";
            $mail->Body = $contenido;
            $mail->send(); 
            // if( $mail->send()){
            //     $mensajeResultado = "El mensaje se envio correctamente";
            // }else{
            //     $mensajeResultado = "Sucedio un error, el mensaje no se pudo enviar";
            // }
    }
}