<?php
require_once(dirname(__FILE__).'/MySmarty.class.php');

require_once(dirname(__FILE__).'/Auth.php');


$smarty = new MySmarty();

$auth = new Auth();
$name = $auth->get_name();
if(!is_null($name)){
	$smarty->assign('name',$name);
}

$smarty->assign('content_path','about.tpl');

$smarty->display('main.tpl');

?>