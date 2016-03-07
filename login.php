<?php
require_once(dirname(__FILE__).'/MySmarty.class.php');
require_once(dirname(__FILE__).'/Auth.php');


$auth = new Auth();
if($auth->is_logged_in()){
	header('Location: ./');
	return;
}

if(!empty($_POST["username"]) && !empty($_POST["password"])){
	$result = $auth->login($_POST["username"],$_POST["password"]);
	if($result){
		header('Location: ./');
		return;
	}else{
		//Failed to login
		$error = "IDとパスワードが一致しません";
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