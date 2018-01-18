<?php
require_once(dirname(__FILE__)."/config.php");


require(ABSPATH . "/includes/mysql.class.php");
require(ABSPATH . "/includes/functions.php");
require(ABSPATH . "/includes/recaptchalib.php");

/*Instancias*/
$dbconn = new MySQLConnect($db_host,$db_user,$db_pass,$db_name);

/* Normaliza a array de imoveis selecionados */
if(!is_array($_SESSION[COOKIE_PREFIX]['userselection'])){
	$_SESSION[COOKIE_PREFIX]['userselection'] = array();
}

?>