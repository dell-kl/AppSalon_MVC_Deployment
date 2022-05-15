<?php namespace Classes;

    use PHPMailer\PHPMailer\PHPMailer;

    class Mail{

        public $Nombre;
        public $Apellido;
        public $Email;
        public $Token;

        public function __construct($nombre, $apellido, $email, $token)
        {   
            $this->Nombre = $nombre;
            $this->Apellido = $apellido;
            $this->Email = $email;
            $this->Token = $token;
        }

        public function EnviarConfirmacion(){
            $phpmailer = new PHPMailer(true);
            try {
                $phpmailer->isSMTP();
                $phpmailer->Host = 'smtp.mailtrap.io';
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = 2525;
                $phpmailer->Username = '2b0ba10624de67';
                $phpmailer->Password = 'd28b09069e40f5';

                $phpmailer->setFrom('appSalon@correo.com', 'AppSalon');
                $phpmailer->addAddress('appSalon@correo.com', 'usuario_AppSalon');


                $phpmailer->isHTML(true);
                $phpmailer->CharSet = "UTF-8";
                $phpmailer->Subject = "Mensaje de confirmación";
                $html = "<html>";
                $html .= "  <p>Hola {$this->Nombre}, hemos recibido una indicación del esta dirección electrónica {$this->Email}.</p>";
                $html .= "  <p>Si fuiste tú date click a continuación en el siguiente enlace: <a href=\"http://localhost:3000/confirmar-cuenta?token={$this->Token}\">Confirmar cuenta</a></p>";
                $html .= "  <br/>";
                $html .= "  <p>Si no fuiste tú puedes ignorar este mensaje sin ningún problema.</p>";
                $html .= "</html>";
                $phpmailer->Body = $html;
                $phpmailer->AltBody = "Este es un mensaje alternativo en caso de no enviarse el mensaje";

                $phpmailer->send();

            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        public function InstruccionesParaNuevoPassword(){
            //code.
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = '2b0ba10624de67';
                $mail->Password = 'd28b09069e40f5';
                
                $mail->setFrom('appSalon@correo.com', 'AppSalon');
                $mail->addAddress('appSalon@correo.com', 'usuario_AppSalon');


                $mail->isHTML(true);
                $mail->CharSet = "UTF-8";
                $mail->Subject = "Mensaje de Reestablecimiento de password.";
                $html = "<html>";
                $html .= "  <p><strong>Hola {$this->Nombre}</strong>, hemos recibido un mensaje de reestablecimiento de passwordde tu dirección electrónica <strong> {$this->Email}. </strong></p>";
                $html .= "  <p>Si fuiste tú dale click a continuación en el siguiente enlace para volver a reestablacer tu password: <a href=\"http://localhost:3000/recuperar?token={$this->Token}\">Reestablecer password</a></p>";
                $html .= "  <br/>";
                $html .= "  <p>Si no fuiste tú puedes ignorar este mensaje sin ningún problema.</p>";
                $html .= "</html>";
                $mail->Body = $html;
                $mail->AltBody = "Este es un mensaje alternativo en caso de no enviarse el mensaje";

                $mail->send();
                
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
?>