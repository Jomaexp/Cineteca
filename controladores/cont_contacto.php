<?php
    /* Hacemos uso de PHPMailer y Exception, esenciales para que 
    podamos usar sus ficheros correctamente. */
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    /**
     * Esta función va a controlar el contacto de usuarios el cual
     * se realiza usando phpmailer para enviar un correo electrónico.
     * Va a contemplar que los datos que se introduzcan se ajusten
     * a los tipos que permitidos y que no se dejan vacíos.
     * Si hay algún error o fallo en el patrón por parte del usuario
     * el sistema informará con un mensaje.
     * Finalmente mostrará los datos resultantes en la vista "vista_contacto"
     */
    function cont_contacto(){
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mensajeNombre = "";
    $mensajeMail = "";
    $mensajeAsunto="";
    $mensajeCuerpo="";
    // Comprobamos si se ha enviado el formulario
    if (isset($_POST['nombre']) && isset($_POST['email'])
        && isset($_POST['asunto']) && isset($_POST['cuerpocontacto'])){
        /* Si nombre, email, asunto y cuerpocontacto no están vacíos se introducen cada uno en una variable */
        if(!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['asunto']) && !empty($_POST['cuerpocontacto'])){            
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $asunto = $_POST['asunto'];
            $cuerpocontacto = $_POST['cuerpocontacto'];
            // Comprobamos si la variable email tiene formato de email realmente. Si lo tiene enviamos el correo.
            if((preg_match('/^[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}/', $email))){

                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'cinetecajmer@gmail.com';
                $mail->Password = 'sglpikdedmvhknwi';
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->isHTML(true);
                $mail->CharSet = 'UTF8';
                $mail->setFrom($email, $nombre);
                $mail->AddAddress('cinetecajmer@gmail.com');
                $mail->Subject = ("$email ($asunto)");
                $mail->Body = $cuerpocontacto;
                $mail->send();
                
                $mensajeCuerpo = "Su mensaje se ha enviado. Responderemos lo antes posible";
                ?>
                <script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Su mensaje se ha enviado!',
                    text: 'Responderemos al mismo lo antes posible.',
                    }).then(() => {
                        location.replace('../index.php/contacto');
                    });</script>
               <?php
            }else {
                $mensajeMail = "El formato de email no es correcto";             
            }
        // Si algún campo no se ha rellenado se avisa al usuario.
        }else $mensajeCuerpo = "Debe completar todos los campos";
    }   
    // Finalmente requerimos la vista_contacto para mostrar todo lo que se ha procesado. 
    require_once "vistas/vista_contacto.php";
}?>