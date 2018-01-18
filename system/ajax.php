<?php
require("system.php");

$status = array();

if(isset($_GET['show_cidades'])){
	$x = $_GET['oferta'];
	
	$sql = "SELECT cidade.id,cidade.cidade FROM imovel INNER JOIN cidade ON imovel.cidade = cidade.id WHERE imovel.oferta = $x AND imovel.portfolio = 0 GROUP BY imovel.cidade ";
	$query = $dbconn->execute($sql);
	if($dbconn->num_rows()>0){
		$status['status'] = 1;
		while($item = mysql_fetch_assoc($query)){
			$status['result'][] = $item;	
		}
	}else{
		$status['status'] = 1;
		$status['result'] = false;
	}
}elseif(isset($_GET['zona'])){ // retorna os bairros da determinada região
	$zona = $_GET['zona'];
	$cidade = $_GET['cidade'];
	$x = $_GET['oferta'];
	$sql = "SELECT bairro FROM imovel";
	if($zona==6 || $zona==""){
		$sql .= " WHERE cidade = $cidade AND oferta = $x ";		
	}else{
		$sql .= " WHERE zona = '$zona' AND cidade = $cidade AND oferta = $x ";
	}
	$sql.= " GROUP BY bairro ORDER BY bairro";
	
	$query = $dbconn->execute($sql);
	
	if($dbconn->num_rows()>0){
		$status['status'] = 1;
		while($item = mysql_fetch_row($query)){
			$status['result'][] = $item[0];	
		}
	}else{
		$status['status'] = 1;
		$status['result'] = false;
	}
}elseif(isset($_GET['add-selection'])){ //Adiciona o imovel a sessão atual
	$imovel_id = $_POST['id'];
	
	if(is_array($imovel_id)){
		foreach($imovel_id as $id){
			$_SESSION[COOKIE_PREFIX]['userselection'][$id] = $id; 
		}
	}
	$status['result'] = $imovel_id;
}elseif(isset($_GET['rem-selection'])){ //Adiciona o imovel a sessão atual
	$imovel_id = $_POST['id'];
	
	if(is_array($imovel_id)){
		foreach($imovel_id as $id){
			unset($_SESSION[COOKIE_PREFIX]['userselection'][$id]); 
		}
	}
	$status['result'] = $imovel_id;
	
}else{
	//unset($_SESSION[COOKIE_PREFIX]['userselection']);
	$status['status'] = 0;
}

echo json_encode($status);

?>