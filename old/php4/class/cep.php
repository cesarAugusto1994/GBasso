<?
/*
 *	Desenvolvido e criado por 
 *	Felipe Olivaes (felipe.olivaes AT terra.com.br)
 *	--------------------------------------------------
 *	2005-07-22 03:26
 */

/*************************
 *	$busca = new busca_cep;
 *	$busca->busca_com_cep($cep);
 *	$busca->cep_unico;
 *************************/


class busca_cep {
	/*************************
	 *	Busca Endereço / Busca CEP
	 ************************/

	var $db;

	//bool Que identifica se o CEP pesquisa é uma cidade de CEP único (Retorna somente )
	var $cep_unico;
	var $cep_busca;
	
	var $cep;
	
	var $tp_log;
	var $abrev_tp_log;
	var $logradouro;
	var $bairro;
	var $abrev_bairro;
	var $cidade;
	var $uf;

	var $id_logradouro;
	var $id_bairro;
	var $id_cidade;
	
	function busca_cep(){
		$this->db = new conn;
	}
	
	function busca_com_cep($cep){
		$this->cep = $cep;
		
		$this->busca_com_cep_logradouro();
		if(!$this->cep_busca){
			$this->busca_com_cep_unico();
		}
	}	
	
	function busca_com_cep_logradouro(){
		$query_cep_log = "
						SELECT 
							tipo.NOME_TIPO 	as tp_log		,	tipo.ABREV_TIPO	 as abrev_tp_log,
							log.NOME_LOG 	as logradouro	, 	log.CHAVE_LOG 	 as id_logradouro,  
							loc.NOME_LOCAL 	as cidade		, 	log.CHVLOCAL_LOG as id_cidade,
							bai.EXTENSO_BAI	as bairro		, 	bai.ABREV_BAI 	 as abrev_bairro, log.CHVBAI1_LOG  as id_bairro,
							log.UF_LOG as uf
						FROM cep_log log, cep_loc loc, cep_bai bai, cep_tit tipo
						WHERE log.CEP8_LOG = '".$this->cep."' 
						AND loc.CHAVE_LOCAL = log.CHVLOCAL_LOG
						AND bai.CHAVE_BAI = log.CHVBAI1_LOG  
						AND bai.CHVLOC_BAI = log.CHVLOCAL_LOG
						AND tipo.CHAVE_TIPO = log.CHVTIPO_LOG 
						AND tipo.LOG_TIPO = 1";
						
		$result_cep_log = $this->db->select_sql($query_cep_log);
			if($this->db->num_rows){	
				$colunas_cep_log = $this->db->fetch();

				$this->tp_log 		= $colunas_cep_log['tp_log'];
				$this->abrev_tp_log = $colunas_cep_log['abrev_tp_log'];
				$this->logradouro 	= $colunas_cep_log['logradouro'];
				$this->bairro 		= $colunas_cep_log['bairro'];
				$this->abrev_bairro = $colunas_cep_log['abrev_bairro'];
				$this->cidade 		= $colunas_cep_log['cidade'];
				$this->uf 			= $colunas_cep_log['uf'];
				
				$this->id_logradouro = $colunas_cep_log['id_logradouro'];
				$this->id_bairro 	 = $colunas_cep_log['id_bairro'];
				$this->id_cidade 	 = $colunas_cep_log['id_cidade'];
	
				$this->cep_busca = true;
			} else {
				$this->cep_busca = false;
			}
	}
	
	function busca_com_cep_unico(){
		$query_unico = "
						SELECT 
							NOME_LOCAL 	as cidade, 
							CHAVE_LOCAL as id_cidade,
							UF_LOCAL  	as uf
						FROM cep_loc
						WHERE CEP8_LOCAL = '".$this->cep."' 
						";
		$result_unico = $this->db->select_sql($query_unico);
			$total_linhas_unico = $this->db->num_rows;
			if($this->db->num_rows){
				$colunas_unico = $this->db->fetch();
				$this->cidade 		= $colunas_unico['cidade'];
				$this->uf 			= $colunas_unico['uf'];
				$this->id_cidade 	= $colunas_unico['id_cidade'];

				$this->cep_busca = true;
				$this->cep_unico = true;
			} else {
				$this->cep_busca = false;
			}
	}
	
}
?>