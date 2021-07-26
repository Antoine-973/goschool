<?php
namespace App\Controller;
use App\Model\UserModel;
use App\Query\UserQuery;
use Core\Component\Validator;
use Core\Controller;
use Core\Database\DB;
use Core\Util\DotEnv;
use Core\Http\Redirect;
use Core\Http\Request;
use App\Form\UserRegisterForm;
use function Composer\Autoload\includeFile;

class InstallationController extends Controller
{

    public function index()
    {
        $userForm = new UserRegisterForm();

        $this->view("install.phtml", ['userForm' => $userForm]);
    }

    public function store(){

        $request = new Request();

        if ($request->isPost()){
            $data = $request->getBody();

            if ($data){
                $db_params = [
                    'DB_DRIVER' => 'mysql',
                    'DB_HOST' => $data['db_host'],
                    'DB_NAME' => $data['db_name'],
                    'DB_USER' => $data['db_user'],
                    'DB_PASSWORD' => $data['db_password'],
                ];

                $email_params = [
                    'HOST' => 'tls://smtp.gmail.com:587',
                    'USERNAME' => '',
                    'PASSWORD' => '',
                    'STMP_SECURE' => 'ssl',
                    'PORT' => '587'
                ];

                $user_params = [
                    'firstname' => $data['firstname'],
                    'lastname' => $data['lastname'],
                    'email' => $data['email'],
                    'password' => $data['password'],
                    'passwordConfirm' => $data['passwordConfirm']
                ];

                $envFile = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . '.env';

                $this->writeFile($envFile, $db_params, $email_params);

                if($conn = new DB()){
                    if($conn->applyMigrations()){
                        if ($this->createAdmin($user_params)){
                            $request->redirect('/admin/auth/login');
                        }
                        else{
                            exit;
                        }
                    }
                    else{
                        exit;
                    }
                }else{
                    $this->deleteFile($envFile);
                }
            }
        }
    }

    public function createAdmin($data){

        $userModel = new UserModel();
        $validator = new Validator();
        $errors = $validator->validate($userModel, $data);

        if(empty($errors)){

            $userQuery = new UserQuery();

            if (empty($userQuery->getByEmail($data['email'])))
            {
                $createQuery = new UserQuery();
                if($createQuery->createFirstAdmin($data))
                {
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        else{
            $userForm = new UserRegisterForm();

            $this->view("install.phtml", ['userForm' => $userForm, 'errors'=>$errors]);
        }
    }

    public function writeFile($file, $db_config, $email_config)
    {

        if(!file_exists($file)){

            file_put_contents($file, "#Database Config" .PHP_EOL, FILE_APPEND);

            foreach($db_config as $key => $value ){
                file_put_contents($file, $key . "=" . $value .PHP_EOL, FILE_APPEND);
            }

            file_put_contents($file, PHP_EOL, FILE_APPEND);
            file_put_contents($file, "#Email Config" .PHP_EOL, FILE_APPEND);

            foreach($email_config as $key => $value ){
                file_put_contents($file, $key . "=" . $value .PHP_EOL, FILE_APPEND);
            }

            return true;
        }

        return false;
    }

    public function deleteFile($file)
    {
        if(file_exists($file)){
            unlink($file);
            return true;
        }
    }
}
