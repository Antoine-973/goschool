<?php
namespace App\Controller;
use Core\Controller;
use Core\Util\DotEnv;
use Core\Http\Redirect;
use Core\Http\Request;

class InstallationController extends Controller
{
    public function index()
    {
        $this->view("install.phtml");
    }

    public function install()
    {
        $request = new Request();


        if($request->isPost()){
            $body = $request->getBody();

            if($body){
                $db_params = [
                    'DB_DRIVER' => $body['db_driver'],
                    'DB_NAME' => $body['db_name'],
                    'DB_HOST' => $body['db_host'],
                    'DB_USER' => $body['db_user'],
                    'DB_PASSWORD' => $body['db_password'],
                ];
            
                $email_params = [
                    'HOST' => 'stmp.gmail.com',
                    'USERNAME' => '',
                    'PASSWORD' => '',
                    'STMP_SECURE' => 'ssl',
                    'PORT' => 465
                ];
            }

            $envFile = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . '.env';

            if(!file_exists($envFile)){

                file_get_contents($envFile);

                file_put_contents($envFile, "#Database Config" .PHP_EOL, FILE_APPEND);
        
                foreach($db_params as $key => $value ){
                    file_put_contents($envFile, $key . "=" . $value .PHP_EOL, FILE_APPEND);
                }
    
                file_put_contents($envFile, PHP_EOL, FILE_APPEND);
                file_put_contents($envFile, "#Email Config" .PHP_EOL, FILE_APPEND);
    
                foreach($email_params as $key => $value ){
                    file_put_contents($envFile, $key . "=" . $value .PHP_EOL, FILE_APPEND);
                }
            }

        }
        
        Redirect::to('/admin/register');
    }
}