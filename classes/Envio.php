<?php
header('Content-Type: text/html; charset=UTF-8');

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

class Envio
{

    private $email;
    private $destinatario;
    private $assunto;
    private $conteudo;
 
    function __construct()
    {

        include 'PHPMailer/src/Exception.php';

        include 'PHPMailer/src/PHPMailer.php';

        include 'PHPMailer/src/SMTP.php';
        
        $mail = new PHPMailer(true);

        $this->setEmail($mail);

    }

    public function envioEmail()
    {
        try {
            


                    
      $mail = $this->getEmail();
        
$mail->SMTPDebug = 0;
               $mail->CharSet  ='UTF-8';
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.guarulhos.sp.gov.br';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'williamferreira@guarulhos.sp.gov.br';                     //SMTP username
                $mail->Password   = '175415@Bc';                               //SMTP password
                $mail->SMTPSecure = 'ssl';
                //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;     


            
            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('williamferreira@guarulhos.sp.gov.br', 'Equipe Fácil Digital');
            $mail->addAddress($this->getDestinatario(), '');     //Add a recipient

                $mail->addReplyTo('sosfacildigital@gmail.com', 'Equipe Fácil Digital');

                           

            $mail->addCC('williamferreira@guarulhos.sp.gov.br');
            $mail->addBCC('williamferreira@guarulhos.sp.gov.br');



            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->getAssunto();
            $mail->Body    = $this->getConteudo();
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if($mail->send()){
                return true;
            }else{
                return false;
            }
            
        } catch (Exception $e) {
           echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of destinatario
     */ 
    public function getDestinatario()
    {
        return $this->destinatario;
    }

    /**
     * Set the value of destinatario
     *
     * @return  self
     */ 
    public function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;

        return $this;
    }

    /**
     * Get the value of assunto
     */ 
    public function getAssunto()
    {
        return $this->assunto;
    }

    /**
     * Set the value of assunto
     *
     * @return  self
     */ 
    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;

        return $this;
    }

    /**
     * Get the value of conteudo
     */ 
    public function getConteudo()
    {
        return $this->conteudo;
    }

    /**
     * Set the value of conteudo
     *
     * @return  self
     */ 
    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;

        return $this;
    }
}
