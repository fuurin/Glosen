<?php
require_once('../MyPDO.php');

$a_id = $_POST['a_id'];

$pdo = new MyPDO();

$sql = "DELETE FROM kgp_article WHERE a_id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($a_id));
?>