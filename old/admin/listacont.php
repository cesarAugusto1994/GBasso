<?php

include("../arealink.php");

verifica_sessao($usuario, $senha);

include("tela_listacont.php");

$var_conn = new conexao_mysql;
$var_conn->conexao('grupobasso');

$consconta = "select * from contato";
$execquery = mysql_query($consconta);
$qtderegis = mysql_num_rows($execquery);

echo htm_tela_listacont($qtderegis);

for($numrregi=0; $numrregi < $qtderegis; $numrregi++)
    {
    $wscontato = mysql_fetch_array($execquery);
    echo htm_tela_listacont1($wscontato);
    }   

?>
