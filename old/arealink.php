<?php
class conexao_mysql{
var $server;
var $usuario;
var $senha;
function conexao(){
$this->server = "localhost";
$this->usuario = "grupobasso";
$this->senha = "103010";
$conn = mysql_connect($this->server,$this->usuario,$this->senha);
$conexao = mysql_select_db("grupobasso",$conn);
if (!$conexao)
{
$html_aviso=<<<EOT
<style type="text/css">
<!--
@import url("styles/style_pacientes.css");
.style2 {
color: #FFFF00;
font-weight: bold;
}
a:link {
color: #FFFFFF;
}
a:visited {
color: #FFFFFF;
}
-->
</style>
<table width="440" border="0" cellpadding="0" class="subtitles">
<tr>
<td width="72" height="18" bgcolor="#FF0000"><div align="center"><span class="style2">Aten&ccedil;&atilde;o !! </span></td>
<td width="362"><div align="center"><b>Cdigo de acesso no informado ou incorreto !!</b></div></td>
</tr>
</table>
EOT;
echo $html_aviso;
exit;
}
}
//funcao SELECT, DELETE, INSERT
function query($sql){
return mysql_query("$sql");
}
//funcao verifica DB
function verif_db($codigo){
$prefix = 'dbcli';
$nomedb = "$prefix"."$codigo";
$var_conn = new conexao_mysql;
$var_conn->conexao($nomedb);
}
//funcao nmero de resultados
function total_registros($result){
return mysql_num_rows($result);
}
//funcao mostrar resultados
function mostra_registros($result){
return mysql_fetch_array($result);
}
//funcao listar registros
function lista_registros($result, $ws_numrregi){
return mysql_result($result,$ws_numrregi);
}
//funcao listar erros
function mostra_erros($erros){
if (!$erros){
echo mysql_error();
die;
}
}
//funcao que estou usando para exibir os dados
function associa_registros($result){
return mysql_fetch_assoc($result);
}
function exit_conn(){
mysql_close();
}
}
//funcao para coloir os relatorios
function Color_list($ws_qtderegi,$ws_numrregi){
global $color_list;
if($ws_qtderegi&1){
$numr="impar";
if($ws_numrregi&1){
return $color_list="\"#EEEEEE\"";
}
else{
return $color_list="\"#D6D6D6\"";
}
}
else{
$numr="par";
if($ws_numrregi&1){
return $color_list="\"#D6D6D6\"";
}
else{
return $color_list="\"#EEEEEE\"";
}
}
}
//funccao cria sessao
function cria_sessao($usx_nomeclie, $usx_password)
{
session_start();
$_SESSION['usx_nomeclie']=$usx_nomeclie;
$_SESSION['usx_password']=$usx_password;
}
//funcao verificar sessao
function verifica_sessao($usx_nomeclie, $usx_password)
{
session_start();
if(!isset($_SESSION['usx_nomeclie']) AND
!isset($_SESSION['usx_password']))
{
$html_aviso=<<<EOT
<style type="text/css">
<!--
@import url("../styles/style_pacientes.css");
.style2 {
color: #FFFF00;
font-weight: bold;
}
a:link {
color: #FFFFFF;
}
a:visited {
color: #FFFFFF;
}
-->
</style>
<table width="440" border="0" cellpadding="0" class="subtitles">
<tr>
<td width="72" height="18" bgcolor="#FF0000"><div align="center"><span class="style2">Aten&ccedil;&atilde;o !! </span></td>
<td width="362"><div align="center"><b>Esta  uma area Restrita, Voc precisa de permisso para Acessar !! </b></div></td>
</tr>
</table>
EOT;
echo $html_aviso;
exit;
}
//funcao formata data
function data($format)
{
return date($format);
}
//funcao formata hora
function hora(){
return date('H:i:s');
}
function escreveData()
{
$diaSemana = array("Domingo", "Segunda-feira", "Tera-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sbado");
$mes = array(1=>"janeiro", "fevereiro", "maro", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro");
return $diaSemana[gmdate("w")] . ", " . gmdate("d") . " de " . $mes[gmdate("n")] . " de " . gmdate("Y");
}
}
function rtn_formata_data($data)
{
$ws_dtformat =  substr($data,8,2)."-".substr($data,5,2)."-".substr($data,0,4);
return $ws_dtformat;
}
//Select Estados
function echo_Estados($HTML,$nome_campo){
$HTML .= <<< EOT
<select name="$nome_campo" id="$nome_campo">
<option value="" selected></option>
<option value="AC">AC</option>
<option value="AM">AM</option>
<option value="AP">AP</option>
<option value="AL">AL</option>
<option value="BA">BA</option>
<option value="CE">CE</option>
<option value="DF">DF</option>
<option value="ES">ES</option>
<option value="GO">GO</option>
<option value="MA">MA</option>
<option value="MG">MG</option>
<option value="MS">MS</option>
<option value="MT">MT</option>
<option value="PA">PA</option>
<option value="PB">PB</option>
<option value="PE">PE</option>
<option value="PI">PI</option>
<option value="PR">PR</option>
<option value="RJ">RJ</option>
<option value="RN">RN</option>
<option value="RO">RO</option>
<option value="RR">RR</option>
<option value="RS">RS</option>
<option value="SC">SC</option>
<option value="SE">SE</option>
<option value="SP">SP</option>
<option value="TO">TO</option>
</select>
EOT;
return $HTML;
}
//-------------------------------------------------------
//Redirect
function html_redirect($path, $tempo)
{
$html_redirect=<<<EOT
<meta http-equiv="refresh" content="$tempo; url=$path">
EOT;
return $html_redirect;
}
//-------------------------------------------------------
?>
