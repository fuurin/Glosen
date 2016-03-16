<?php
require_once(dirname(__FILE__).'/MySmarty.class.php');
require_once(dirname(__FILE__).'/Auth.php');


$auth = new Auth();
if($auth->is_logged_in()){
	header('Location: ./');
	return;
}

if(!empty($_POST["username"]) || !empty($_POST["password"])){

	$username = $_POST["username"];
	$password = $_POST["password"];
	$error = "";

	// Execute login
	$result = $auth->login($username, $password);

	if($result == False) {
		$error .= "そのユーザー名とパスワードの組み合わせは存在しません。";
	}

	// Success
	if(empty($error)){
		header('Location: ./index.php');
		return;
	}
}

$smarty = new MySmarty();

$name = $auth->get_name();

if(!is_null($name)){
	$smarty->assign('name',$name);
}

if(isset($error)){
	$smarty->assign('error',$error);
}

$smarty->assign('content_path','login.tpl');

$smarty->display('main.tpl');

?>