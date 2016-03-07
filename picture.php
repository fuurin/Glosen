<?php
require_once(dirname(__FILE__).'/MyPDO.php');

if (isset($_GET['a_id'])) {
	$a_id = $_GET['a_id'];
	$pdo = new MyPDO();
	$sql = "SELECT picture FROM kgp_article WHERE a_id = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(array($a_id));
	$img = $stmt->fetchObject();
	if($img && !is_null($img->picture)){
		header('Content-type: image/jpeg');
		echo $img->picture;
		exit();
	}
}

$img = file_get_contents("./img/noimage.png");
header('Content-type: image/png');
echo $img;




?>