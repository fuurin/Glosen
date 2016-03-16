<?php
require_once(dirname(__FILE__).'/MySmarty.class.php');
require_once(dirname(__FILE__).'/Auth.php');

$auth = new Auth();

// $username = $_POST["username"];
// $password = $_POST["password"];
// $confirm = $_POST["password_confirm"];
// $error = "";

// 	if(!isset($username) || !isset($password) || !isset($confirm)){
// 		$error .= "全ての項目が入力必須です。<br/>";
// 	}

// 	$name_len = mb_strlen($username);
// 	$pass_len = mb_strlen($password);

// 	if($name_len < 3 || $name_len > 30) {
// 		$error .= "ユーザー名は3文字以上30文字以内で入力してください。<br/>";
// 	}

// 	if($pass_len < 3 || $pass_len > 30) {
// 		$error .= "パスワードは3文字以上30文字以内で入力してください。<br/>";
// 	}

// 	if($password != $confirm){
// 		$error .= "パスワードと確認用パスワードは、同じものを入力してください。<br/>"
// 	}

	// Execute register
	//$result = $auth->register($username, $password);

	// if($result == False) {
	// 	$error .= "そのユーザー名はすでに使われています<br/>"
	// }

	// Success
	// if($error == ""){
	// 	$auth->login($name, $password)
	// 	header('Location: ./index.php');
	// 	return;
	// }



$smarty = new MySmarty();

$name = $auth->get_name();

if(!is_null($name)){
	$smarty->assign('name',$name);
}

if($error != ""){
	$smarty->assign('error',$error);
}

$smarty->assign('content_path','register.tpl');

$smarty->display('main.tpl');

?>