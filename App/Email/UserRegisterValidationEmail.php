<?php
namespace App\Email;

use Core\Util\Email;

class UserRegisterValidationEmail{

    public function sendEmail($emailTo, $url){

        $body = file_get_contents(__DIR__ .'/../Views/Email/userRegisterValidation.phtml');
        $body = str_replace('%url%', $url, $body);

        $email = new Email();
        $email->send('contact.goschool@gmail.com', $emailTo, 'Vérification de votre compte goSchool', $body);

    }
}