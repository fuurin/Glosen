<?php
require_once('../MyPDO.php');

$limit = isset( $_GET['limit'] ) && ctype_digit($_GET['limit']) ? intval($_GET['limit']) : 5;
$page = isset( $_GET['page'] ) && ctype_digit($_GET['limit']) ? intval($_GET["page"])-1 : 0;

$pdo = new MyPDO();
$sql = "SELECT a_id, article FROM kgp_article ORDER BY a_id DESC LIMIT ".($page*$limit).",".$limit;
$stmt = $pdo->prepare($sql);
$res = $stmt->execute();
$articles = array();

while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	array_push($articles,$result);
}

header('Content-Type: application/json');

echo json_encode($articles);


?>