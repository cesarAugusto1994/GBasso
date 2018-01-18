<title>Php</title><?php
function htm_tela_listacont($qtderegis)
{
$htm_tela_listacont = <<< EOT
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style3 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.style4 {font-size: 10px; font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body>
<div align="left"><span class="style3">Registros = $qtderegis</span>
</div>
<table width="90%" border="0" align="left" cellpadding="1" cellspacing="1">
  <tr>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">Nome</div></td>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">Endereço</div></td>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">Bairro</div></td>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">Cidade</div></td>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">Estado</div></td>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">Telefones</div></td>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">E-mails</div></td>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">Obs</div></td>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">R_Email</div></td>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">R_Tel</div></td>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">R_Fax</div></td>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">R_Correio</div></td>
    <td bgcolor="#FFF3C6"><div align="center" class="style4">Excluir</div></td>
  </tr>

EOT;
return $htm_tela_listacont;
}

function htm_tela_listacont1($wscontato)
{
$htm_tela_listacont1 = <<< EOT
  <tr>
    <td bgcolor="#F7F7F7"><span class="style4">$wscontato[nome]</span></td>
    <td bgcolor="#F7F7F7"><span class="style4">$wscontato[endereco], $wscontato[numero]</span></td>
    <td bgcolor="#F7F7F7"><span class="style4">$wscontato[bairro]</span></td>
    <td bgcolor="#F7F7F7"><span class="style4">$wscontato[cidade]</span></td>
    <td bgcolor="#F7F7F7"><span class="style4">$wscontato[estado]</span></td>
    <td bgcolor="#F7F7F7"><span class="style4">$wscontato[tel_res] $wscontato[tel_cel] $wscontato[tel_com]</span></td>
    <td bgcolor="#F7F7F7"><span class="style4">$wscontato[email]</span></td>
    <td bgcolor="#F7F7F7"><span class="style4">$wscontato[obs]</span></td>
    <td bgcolor="#F7F7F7"><span class="style4">$wscontato[r_email]</span></td>
    <td bgcolor="#F7F7F7"><span class="style4">$wscontato[r_tel]</span></td>
    <td bgcolor="#F7F7F7"><span class="style4">$wscontato[r_fax]</span></td>
    <td bgcolor="#F7F7F7"><span class="style4">$wscontato[r_correio]</span></td>       
    <td bgcolor="#F7F7F7"><span class="style4">
      <form action='excluir.php' metho='post'>
      <input type=hidden name=seqc value=$wscontato[seqc]>
      <input type=submit name=ws_excluirx value=Excluir>
      </form>
    </td>       
  </tr>

EOT;
return $htm_tela_listacont1;
}
?>

