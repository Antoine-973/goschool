<?php
namespace App\Email;

use Core\Util\Email;

class UserResetPasswordEmail{

    public function sendEmail($emailTo, $url){

        $body = file_get_contents(__DIR__ .'/../Views/Email/resetPassword/userRegeneratePassword.phtml');
        $body = str_replace('%url%', $url, $body);

        $email = new Email();

        if($email->send('contact.goschool@gmail.com', $emailTo, 'Réinitialisation de votre mot de passe goSchool', $body)){
            return true;
        }
        else{
            return false;
        }

    }
}