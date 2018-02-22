<?php
include("arealink.php");

import_request_variables("p",""); 

$var_conn = new conexao_mysql;
$var_conn->verif_db(banco);

$agora=date('Y-m-d');

$sql = "insert into contato (nome,
                             cep,
                             endereco,
                             numero,
                             bairro,
                             cidade,
                             estado,
 	                     tel_res,
 	                     tel_cel,
 	                     tel_com,
 	                     email,
 	                     r_email,
 	                     r_tel,
 	                     r_fax,
 	                     r_correio,
 	                     obs)
                     VALUES ('$nome',
                             '$cep',
                             '$endereco',
                             '$numero',
                             '$bairro',
                             '$cidade',
                             '$estado',
                             '$tel_res',
                             '$tel_cel',
                             '$tel_com',
                             '$email',
                             '$r_email',
                             '$r_tel',
                             '$r_fax',
                             '$r_correio',
                             '$obs')";
$resultado = $var_conn->query($sql);
$erros     = $var_conn->mostra_erros($resultado);

if($email != "")
   {
   $assunto = "Confirma��o de Cadastro";
   $mensagem = "Nome:$nome\n\n"; 
   $mensagem .= "Endere�o:$endereco, Numero:$numero  ";
   $mensagem .= "Bairro:$bairro Cidade:$cidade Estado:$estado\n";
   $mensagem .= "Tel: $tel_res Cel: $tel_cel Tel Com.:$tel_com\n";
   $mensagem .= "E-mail:$email\n";
   $mensagem .= "Obs: $obs\n";
   
   $headers = "From: Contato - Grupo Basso <refri.basso@grupobasso.com.br>\n";
   $headers = $headers."Content-Type: text/; charset=iso-8859-1\n";

   @mail($email, $assunto, $mensagem, $headers); //essa linha manda o email!   
      }
   
echo "<meta http-equiv='refresh' content='3;url=http://www.grupobasso.com.br/contato.html'>\n <font size=5><b>O cadastro foi conclu�do com &ecirc;xito!</b></font><br>\n";

?>
