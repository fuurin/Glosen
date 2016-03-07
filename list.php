<?php
require_once(dirname(__FILE__).'/MySmarty.class.php');
require_once(dirname(__FILE__).'/Auth.php');
require_once(dirname(__FILE__).'/MyPDO.php');

define('LIMIT', 5);

$page = isset($_GET['page'])? intval($_GET['page'])-1:0;
$query = !empty($_GET['query'])? $_GET['query']: null;


$auth = new Auth();

$pdo = new MyPDO();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$params = array();
if(!is_null($query)){
	$query_pattern = '%'.$query.'%';
	$sql = "SELECT count(*) FROM kgp_article WHERE article LIKE ? OR title LIKE ? OR country LIKE ? OR university LIKE ?";
	array_push($params, $query_pattern, $query_pattern, $query_pattern, $query_pattern);
}else{
	$sql = "SELECT count(*) FROM kgp_article";
}
$stmt = $pdo->prepare($sql);
$result = $stmt->execute($params);
$num = $stmt->fetchColumn();


$params = array();

if(!is_null($query)){
	$sql = "SELECT kgp_article.id AS id, a_id, name, title, country, university, article, picture FROM kgp_article LEFT JOIN kgp_user ON kgp_article.id=kgp_user.id WHERE article LIKE ? OR title LIKE ? OR country LIKE ? OR university LIKE ? ORDER BY a_id DESC LIMIT ".($page*LIMIT).",".LIMIT;
	array_push($params, $query_pattern, $query_pattern, $query_pattern, $query_pattern);
}else{
	$sql = "SELECT kgp_article.id AS id, a_id, name, title, country, university, article, picture FROM kgp_article LEFT JOIN kgp_user ON kgp_article.id=kgp_user.id ORDER BY a_id DESC LIMIT ".($page*LIMIT).",".LIMIT;
}
$stmt = $pdo->prepare($sql);
$result = $stmt->execute($params);
$articles = array();

while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	array_push($articles,$result);
}

$smarty = new MySmarty();

$smarty->assign('articles', $articles);

$name = $auth->get_name();

if(!is_null($name)){
	$smarty->assign('name',$name);
}

if(isset($error)){
	$smarty->assign('error',$error);
}
$smarty->assign('max_page',($num+LIMIT-1-($num+LIMIT-1)%LIMIT)/LIMIT);
$smarty->assign('page',$page+1);
$smarty->assign('query', $query);


$smarty->assign('load_map_js', true);

$smarty->assign('content_path','list.tpl');

$smarty->display('main.tpl');

?>