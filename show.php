<?php
require_once(dirname(__FILE__).'/MySmarty.class.php');
require_once(dirname(__FILE__).'/Auth.php');
require_once(dirname(__FILE__).'/MyPDO.php');

$params = (include dirname(__FILE__).'/config.php');
$map_key = $params['map_key'];

$auth = new Auth();

if (isset($_SESSION['user_id'])) {
	$smarty->assign('id', $_SESSION['user_id']);
}

if(isset($_GET['a_id'])){
	$a_id = $_GET['a_id'];
}else{
	exit();
}

// Get Article
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

// Get name
$sql = "SELECT name FROM kgp_user WHERE id =?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($article["id"]));

while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	$name = $result['name'];
}

$smarty = new MySmarty();

$smarty->assign('article', $article);
$smarty->assign('name', $name);

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