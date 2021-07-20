<?php
require_once "../Core/bootstrap.php";
require_once "../Core/Vendor/PHPMailer-master/src/PHPMailer.php";
require_once "../Core/Vendor/PHPMailer-master/src/Exception.php";
require_once "../Core/Vendor/PHPMailer-master/src/SMTP.php";
require_once "./install.php";

$routes = require_once "../App/Routes/web.php";

use Core\Application;
use Core\Database\DB;
use Core\Util\Email;
use Core\Http\Redirect;

$app = new Application();
$app->run();

//runInstall($envFile);



