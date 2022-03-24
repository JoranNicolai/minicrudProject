
: <?php

require 'includes/Exception.php';
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail {

    private PHPMailer $mail;

    function __construct() {
        $this->mail = new PHPMailer();

        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = '';
        $this->mail->Password = '';
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;

        $this->mail->isHTML(true);
    }

    public function send_mail($email, $title ,$message, $onderwerp, $name) {
        $this->mail->setFrom($email, $name);

        $this->mail->addAddress($email);

        $this->mail->Subject = $onderwerp;

        $bodyContent = '<h2>'.$title.'</h2>';
        $bodyContent .= '<p>'.$message.'</p>';

        $this->mail->Body = $bodyContent;

        if(!$this->mail->send()) {
            echo 'Message could not be sent. Mailer Error: '.$this->mail->ErrorInfo;
        } else {

        }
    }
}