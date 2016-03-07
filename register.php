<?php
require_once(dirname(__FILE__).'/MySmarty.class.php');
require_once(dirname(__FILE__).'/Auth.php');

$auth = new Auth();

if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password_confirm"])){
	if($_POST["password"]==$_POST["password_confirm"]){
		$result = $auth->register($_POST["username"], $_POST["password"]);
		if($result){
			//Success
			header('Location: ./login.php');
			return;
		}else{
			//Failed to register
			$error = "ユーザー名がすでに使われています";
		}
	}else{
		//misssing password
		$error = "パスワードが一致していません。";
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

$smarty->assign('content_path','register.tpl');

$smarty->display('main.tpl');

?>