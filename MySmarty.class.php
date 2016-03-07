<?php
define('SMARTY_DIR', './smarty/libs/');
require SMARTY_DIR.'Smarty.class.php';
class MySmarty extends Smarty {

	public function __construct() {
		parent::__construct();
		$this->template_dir = './smarty/templates/';
		$this->compile_dir  = './smarty/templates_c/';
		$this->config_dir   = './smarty/configs/';
		$this->cache_dir    = './smarty/cache/';
		$params = include 'config.php';
		$this->assign('map_key',$params['map_key']);
	}
}
?>