<?php
namespace Core\Util;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Core\Util\DotEnv;

class Email
{
    private $host;
    private $username;
    private $password;
    private $port;

    public function __construct()
    {
        (new DotEnv(dirname(dirname(__DIR__)) . '/.env'))->load();
        $this->host = getenv('HOST');
        $this->username = getenv('USERNAME');
        $this->password = getenv('PASSWORD');
        $this->port = getenv('PORT');
    }

	public function send($from, $to, $subject, $body)
	{
	
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $this->host;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $this->username;                     //SMTP username
            $mail->Password   = $this->password;                               //SMTP password
            $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            //$mail->Port       = $this->port;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
            //Recipients
            $mail->setFrom($from, 'GoSchool');
            $mail->addAddress($to);     //Add a recipient
            //$mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo($from, 'GoSchool');
        
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->CharSet = "UTF-8";
            $mail->Subject = $subject;
            //$mail->addCustomHeader();
            $mail->Body = $body;
        
            $mail->send();
            echo 'Réussi';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}