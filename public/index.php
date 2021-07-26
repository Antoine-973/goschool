<?php
require_once "../Core/bootstrap.php";
require_once "../Core/Vendor/PHPMailer-master/src/PHPMailer.php";
require_once "../Core/Vendor/PHPMailer-master/src/Exception.php";
require_once "../Core/Vendor/PHPMailer-master/src/SMTP.php";

use Core\Application;
use Core\Util\Email;


$app = new Application();
$app->run();




