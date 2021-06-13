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
use Core\Http\Request;

$request = new Request();

$envFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . ".env";

if(!file_exists($envFile)){
    $request->redirect('/install');
}

//runInstall($envFile);


$app = new Application($routes);
$app->run();
