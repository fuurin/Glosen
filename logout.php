<?php
require_once(dirname(__FILE__).'/Auth.php');

$auth = new Auth();

$auth->logout();

header("Location: ./");

?>