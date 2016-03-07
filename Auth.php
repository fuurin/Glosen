<?php 
ini_set('display_errors',1);
require_once(dirname(__FILE__).'/MyPDO.php');

class Auth {
	private $pdo = null;

	function __construct(){
		try {
			$this->pdo = new MyPDO();
			session_start();
		} catch (PDOException $e){
			var_dump($e->getMessage());
		}
	}

	function register($name, $password){
		$password = $this->hash_password($password);
		$sql = 'INSERT INTO kgp_user (name, password) VALUES (?, ?)';
		$stmt = $this->pdo->prepare($sql);		return $stmt->execute(array($name, $password));

	}

	function login($name, $password){
		if ($this->is_logged_in()) {
			return 1;
		}
		$password = $this->hash_password($password);
		$sql = 'SELECT id FROM kgp_user WHERE name = ? AND password = ?';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute(array($name, $password));
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$id = $result['id'];
			$_SESSION['user_id'] = $id;
			$_SESSION['name'] = $name;
			return 1;
    	}
		return 0;
	}

	function logout(){
		$_SESSION = array();
		session_destroy();
	}

	function is_logged_in(){
		return isset($_SESSION['user_id']);
	}

	function get_id(){
		if ($this->is_logged_in()) {
			return $_SESSION['user_id'];
		}
		return null;
	}

	function get_name(){
		if ($this->is_logged_in()) {
			return $_SESSION['name'];
		}
		return null;
	}

	private function hash_password($password){
		return md5($password.$this->pdo->get_salt());
	}
}
?>
