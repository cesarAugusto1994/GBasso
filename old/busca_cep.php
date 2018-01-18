<?
/*
 *	Desenvolvido e criado por 
 *	Felipe Olivaes (felipe.olivaes AT terra.com.br)
 *	--------------------------------------------------
 *	2005-07-22 03:26
 */

include("php4/class/conn.php");
include("php4/class/cep.php");
header("Cache-Control: no-store, no-cache, must-revalidate");

$cep = $_GET['cep'];
echo "<script>\n";

	$busca_por_cep = new busca_cep;
	$busca_por_cep -> busca_com_cep($cep);

if(!$busca_por_cep->cep_busca){
	echo "alert('**** CEP NÃO ENCONTRADO - CEP: $cep ****');\n";	
}
?>
	parent.from_cep(
'<? echo addslashes(ucwords(strtolower($busca_por_cep->abrev_tp_log))); ?>',
'<? echo addslashes(ucwords(strtolower($busca_por_cep->logradouro))); ?>',
'<? echo addslashes(ucwords(strtolower($busca_por_cep->bairro))); ?>',
'<? echo addslashes(ucwords(strtolower($busca_por_cep->cidade))); ?>',
'<? echo addslashes(ucwords(strtolower($busca_por_cep->uf))); ?>',
'<? if($busca_por_cep->cep_busca){echo 1;} else if($busca_por_cep->cep_unico){ echo 2; } else { echo 3;} ?>'
);
</script>