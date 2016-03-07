<?php
require_once(dirname(__FILE__).'/MySmarty.class.php');
require_once(dirname(__FILE__).'/Auth.php');
require_once(dirname(__FILE__).'/MyPDO.php');

$smarty = new MySmarty();

$auth = new Auth();
$name = $auth->get_name();
if(!is_null($name)){
	$smarty->assign('name',$name);
}

$pdo = new MyPDO();

$sql = "SELECT * FROM kgp_article ORDER BY a_id DESC LIMIT 12";
$stmt = $pdo->prepare($sql);
$result = $stmt->execute();

$slides = array();
$articles = array();
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	array_push($articles,$result);
	if (count($articles)==4) {
		array_push($slides, $articles);
		$articles = array();
	}
}

$smarty->assign('slides', $slides);

$smarty->assign('load_map_js', true);

$smarty->assign('content_path','top.tpl');

$smarty->display('main.tpl');

?>