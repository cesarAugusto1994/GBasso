<?php

include("../arealink.php");
include("tela_listacont.php");

$var_conn = new conexao_mysql;
$var_conn->conexao('grupobasso');

import_request_variables("p",""); 

$ws_querysql = 'delete from contato where seqc =' . $seqc;

$resultado = $var_conn->query($ws_querysql);
$erros     = $var_conn->mostra_erros($resultado);

echo "<meta http-equiv='refresh' content='3;url=http://www.grupobasso.com.br/admin/listacont.php'>\n <font size=5><b>O cadastro foi excluído com &ecirc;xito!</b></font><br>\n";
    
?>