<?php
require_once(dirname(__FILE__).'/MySmarty.class.php');
require_once(dirname(__FILE__).'/Auth.php');
require_once(dirname(__FILE__).'/MyPDO.php');

$params = (include dirname(__FILE__).'/config.php');
$map_key = $params['map_key'];

$auth = new Auth();


if(isset($_GET['a_id'])){
	$a_id = $_GET['a_id'];
}else{
	exit();
}

$pdo = new MyPDO();
$sql = "SELECT * FROM kgp_article WHERE a_id =? LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($a_id));

while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	$article = $result;
}

if(!isset($article)){
	exit();
}

$smarty = new MySmarty();

$smarty->assign('article', $article);

$name = $auth->get_name();

if(!is_null($name)){
	$smarty->assign('name',$name);
	$smarty->assign('id',$auth->get_id());
}

if(isset($error)){
	$smarty->assign('error',$error);
}

if(!is_null($article['lat']) && !is_null($article['lng']) 
&& !is_null($article['zoom'])){
	$smarty->assign('load_map_js', true);
}

$smarty->assign('content_path','show.tpl');

$smarty->display('main.tpl');

?>