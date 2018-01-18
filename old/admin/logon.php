<?php

include("../arealink.php");

$var_conn = new conexao_mysql;
$var_conn->conexao('grupobasso');

$usuario = $_POST['usuario'];
$senha   = $_POST['senha'];

$ws_user = "fulvia";
$ws_senh = "basso";
if($usuario == $ws_user and $senha == $ws_senh)
    {
    cria_sessao($usuario, $senha);
    echo html_redirect('listacont.php',0);
    }
else
    {
    echo "Usuário ou Senha Inválida!";
    echo html_redirect('index.html',3);
    }

?>