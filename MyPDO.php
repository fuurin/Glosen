<?php 
	class MyPDO extends PDO {

		private $salt = null;

		public function __construct(){
			$params = include dirname(__FILE__).'/config.php';
			$this->salt = $params['salt'];
			parent::__construct(
				"mysql:host=".$params['host'].";port=".$params['port'].";dbname=".$params['dbname'].";charset=utf8",
				$params['user'], $params['password']);
		}

		public function get_salt(){
			return $this->salt;
		}
	} 
?>
