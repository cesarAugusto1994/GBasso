<?php
session_start();
/* Arquivo de Configurações do Site */


/* Dados para acesso ao Banco de Dados */

/*
$db_host = "mysql02-farm31.uni5.net";
$db_user = "seabra";
$db_pass = "net102030";
$db_name = "seabra";
if($_SERVER['HTTP_HOST']=='192.168.1.6'){
$db_host = "localhost";
$db_user = "root";
$db_pass = "102030";
$db_name = "seabra";
}
*/


$db_host = "mysql07-farm19.uni5.net";
$db_user = "saldocerto01";
$db_pass = "Net102030";
$db_name = "saldocerto01";


/***************************************/
/* Caminhos e pastas */

define("URL",$_SERVER['HTTP_HOST']);
define("PATH",$_SERVER['DOCUMENT_ROOT']);
$dir_install = "";

/****************************************/
/*Parametros de Sistema */

define("DEBUG_MODE",false);
define("COOKIE_PREFIX","seabra");
define("ADMIN_EMAIL","vendas@seabra.com.br");
if($_SERVER['HTTP_HOST']=='192.168.1.6')
	$dir_install = "/seabra";

/*****************************************/

define("ABSPATH",PATH . $dir_install . 'loja');
define("ABSURL","http://".URL.$dir_install);

define("DATA_PATH",ABSPATH."/data");


?>
