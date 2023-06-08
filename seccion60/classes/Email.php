<?php
namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email{
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '34632f45fe1840';
        $phpmailer->Password = 'dca63e7a70b3df';

        $phpmailer->setFrom("cuentas@uptask.com");
        $phpmailer->addAddress("cuentas@uptask.com", "a18000621@alumnos.uady.mx");
        $phpmailer->Subject = "Confirmar cuenta";

        $phpmailer->isHTML(true);                                  //Set email format to HTML
        $phpmailer->CharSet = "UFT-8";      
        
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre .  ".</strong> Has creato tu cuenta en 
        UpTask, solo debes confirma tu cuenta presionando en el siguiente enlace.</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .= "<p>Si no solicitaste esta cuenta, ignora el mensaje.</p>";
        $contenido .= "</html>";
        $phpmailer->Body = $contenido;
        $phpmailer->send(); 


    }
}