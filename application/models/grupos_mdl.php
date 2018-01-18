<?php

class Grupos_mdl extends CI_Model {
   
    public function __construct() {
        parent::__construct();
    }
    
    
    /**
     * 
     *  Método grava valores numa determinada tabela
     *  $table   =   nome da tabela qual os dados serão gravados ...
     *  $dados   =   array contendo como nome do indice o nome do campo da tabela e seus valores a serem gravados
     *  
     */  
    public function gravar($table, $dados){
    	
    	if($this->db->insert($table, $dados))
    		return true;
    	else 	
    		return false;    	
    }
    
    
    /**
     *  Método retorna um valor especifico de uma tabela
     *  $fieldReturn   =   nome do campo qual deseja retorna algum valor exemplo: os_id ou os_id, os_codigo ...
     *  $compare       =   campo a ser comparado com o campo da tabela para obter o valor especifico
     *  $table         =   nome da tabela a ser consultada
     */
    public function getEspecificValue($fieldReturn, $compare = null, $table){
    	
    	//Select no campo ou campos qual deseja retornar o valor
        $this->db->select($fieldReturn);
        
        //numa tabela qualquer
        $this->db->from($table);
        
        if($compare != null){
       	 	//comparação entre campo da tabela e valor deste campo
			$this->db->where($compare, null);
        }
        
        //Retorna os dados obtidos na consulta
        return $this->db->get()->result();
    }  
    
    
    /**
     *  Método atualiza valores numa tabela
     *  $compare       =   campo a ser comparado com o valor do mesmo na tabela
     *  $field         =   Array com nome dos campos em seu indices e os valores como valores dos indices
     *  $table         =   nome da tabela
     */    
    public function modifyField($compare, $field = array(), $table) {

    	$this->db->where($compare, null);
  		if($this->db->update($table, $field))
  			return true;
  		else  
  			return false;	
    }    


    public function prompitQuery($querySql)
    {
        
        //Retorna os dados obtidos na consulta
        return $this->db->query($querySql)->result();
        
    }     
    
    /**
     *  Método deleta valores de uma tabela
     *  $compare       =   campo a ser comparado com o valor do mesmo na tabela
     *  $table         =   nome da tabela
     */    
    public function deleteValue($compare, $table){
		
        $this->db->where($compare, null);
  		if($this->db->delete($table)) 
  			return true;
  		else  
  			return false;  		
    }    


    public function lastIdInsert($table, $fieldOrder){
        
        $query = "SELECT * FROM $table ORDER BY $fieldOrder DESC LIMIT 1";

        $result = $this->db->query($query);

        if($result->num_rows() > 0) {

            $field   =   $result->result("array");

            return $field[0][$fieldOrder];

        }else {

            return 1;
            
        }
    }  

}

