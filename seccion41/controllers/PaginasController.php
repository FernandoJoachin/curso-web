<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        $propiedades =  Propiedad::get(3);
        $router->render("paginas/index",[
            "propiedades" => $propiedades,
            "inicio" => true
        ]);
    }

    public static function nosotros(Router $router){
        $router->render("paginas/nosotros");
    }

    public static function anuncios(Router $router){
        $propiedades = Propiedad::all();
        $router->render("paginas/anuncios",[
            "propiedades" => $propiedades
        ]);
    }

    public static function propiedad(Router $router){
        $id = validar_o_Redireccionar("/anuncios");
        $propiedad = Propiedad::find($id);
        $router->render("paginas/propiedad",[
            "propiedad" => $propiedad
        ]);
    }

    public static function blog(Router $router){
        #$propiedad = Propiedad::find($id);
        $router->render("paginas/blog",);
    }

    public static function entrada(Router $router){
        $router->render("paginas/entrada");
    }

    public static function contacto(Router $router){
        $mensajeResultado = false;
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $respuestas = $_POST["contacto"]; 
   
            /**Copiado de Composer*/
            #Configurar el SMTP
            $mail = new PHPMailer();
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = "sandbox.smtp.mailtrap.io";             //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = "18ca7fbf2ad25c";                       //SMTP username
            $mail->Password   = "272bae68e1a1a2";                       //SMTP password
            $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
            $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            #Configura el contenido del mensaje
            $mail->setFrom("from@example.com");
            $mail->addAddress("from@example.com", "a18000621@alumnos.uady.mx");     //Add a recipient

            #Habilitar HTML
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->CharSet = "UFT-8";      
           
            $contenido = "<html>";
            $contenido .= "<p>Tienes un nuevo mensaje </p>";
            $contenido .= "<p>Nombre: ". $respuestas["nombre"] . " </p>";
            $contenido .= "<p>Mensaje: ". $respuestas["mensaje"] . " </p>";

            $contenido .= "<p>Compra o Vende: ". $respuestas["tipo"] . " </p>";
            $contenido .= "<p>Presupuesto o Precio: $". $respuestas["precio"] . " </p>";

            if($respuestas["contacto"] === "teléfono"){
                $contenido .= "<p>Eligio ser contactado por teléfono:</p>";
                $contenido .= "<p>Telefono: ". $respuestas["telefono"] . " </p>";
                $contenido .= "<p>Fecha de contacto: ". $respuestas["fecha"] . " </p>";
                $contenido .= "<p>Hora: ". $respuestas["hora"] . " </p>";
            }else{
                $contenido .= "<p>Eligio ser contactado por email:</p>";
                $contenido .= "<p>Email: ". $respuestas["email"] . " </p>";
            }
            $contenido .= "</html>";
            $mail->Body = $contenido;
            $mail->AltBody = "Texto alternativo sin HTML"; 
            if( $mail->send()){
                $mensajeResultado = "El mensaje se envio correctamente";
            }else{
                $mensajeResultado = "Sucedio un error, el mensaje no se pudo enviar";
            }
        }
        $router->render("paginas/contacto", [
            "mensajeResultado" => $mensajeResultado
        ]);
    }

}

