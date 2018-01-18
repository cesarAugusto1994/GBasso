<?php
//Arquivo de Configuração do sistema



//Configurações de Banco de Dados
$db_user = "crm_db";
$db_pass = "LbmWbFFtQKd9K8vt";
$db_name = "crm_db";
$db_host = "localhost";
$db__dsn = "mysql";

define("DSN",$db__dsn.":host=".$db_host.";dbname=".$db_name);
define("DB_USER",$db_user);
define("DB_PASS",$db_pass);

//
define("DEBUG_MODE",true);

//Pastas e URLs

define("ABSPATH",dirname(__FILE__));  //Caminho absoluto do sistema

define("FORCE_SSL",false);             //Força a utilização de SSL
define("COOKIE_NAME","crm");

$path = substr(ABSPATH,strlen($_SERVER['DOCUMENT_ROOT']),strlen(ABSPATH));
$protocol = (FORCE_SSL)?"https://":"http://";
define("ABSURL",$protocol.$_SERVER['HTTP_HOST'].$path); //Url do sistema



if(DEBUG_MODE){
	ini_set("display_errors","On");
	error_reporting(E_ALL & ~E_NOTICE);
}
?>