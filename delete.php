<?php
require_once(dirname(__FILE__).'/MySmarty.class.php');

require_once(dirname(__FILE__).'/Auth.php');


$smarty = new MySmarty();

$auth = new Auth();
$name = $auth->get_name();
if(!is_null($name)){
	$smarty->assign('name',$name);
}

$a_id = $_POST['a_id'];
$title = $_POST['title'];

if (!isset($a_id)) {
	$smarty->assign("message", "記事を削除できません");
	$smarty->assign("title", "不明な記事");
} else {
	$smarty->assign("message", "この記事を削除してもよろしいですか？");
	$smarty->assign("title", "「" . $title . "」");
	$smarty->assign("a_id", $a_id);
}

$smarty->assign('content_path','delete.tpl');

$smarty->display('main.tpl');

?>