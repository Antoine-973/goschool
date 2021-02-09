<?php
namespace Controller;
use Core\Controller;
use Core\Email\SendEmail;
use Core\Database\QueryBuilder;

class DefaultController extends Controller {

	public function index(){

		$sender = new SendEmail('cmohindo@myges.fr', 'cmohindo@myges.fr', 'Hello christian');
		$message = $sender->send();
		$fruits = ['Pomme', 'Fraise', 'Cerise', 'Poire'];


		$query = new QueryBuilder();
		$id = 1;

		$sql = $query->select('firstname, lastname, email')
				->from('users')
				->where("id = $id")
				->getQuery();
		
		$this->render('home.php', ['message' => $message, 'fruits' => $fruits, 'query' => $sql]);
	}

}