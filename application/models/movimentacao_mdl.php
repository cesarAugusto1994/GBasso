<?php

class Movimentacao_mdl extends CI_Model {
   
    public function __construct() {
        parent::__construct();
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
    
    public function insertNewValue($fields = array(), $table)
    {              

        return $this->db->insert($table, $fields)  ?   true   :   false;
        
    }

    /**
     *  Método grava valores numa determinada tabela
     *  $table   =   nome da tabela qual os dados serão gravados ...
     *  $dados   =   array contendo como nome do indice o nome do campo da tabela e seus valores a serem gravados
     */    
    public function gravaMovimentacao($table, $dados = array()){
        
        if($this->db->insert($table, $dados))
            return true;
        else    
            return false;
    }


   /**
    * 
    * Método junta dados de duas tabelas dinamicamente usando INNER JOIN
    * $fieldReturn    =   nome do campo qual deseja retorna algum valor exemplo: os_id ou os_id, os_codigo ...
    * $compare        =   campo a ser comparado com o campo da tabela para obter o valor especifico
    * $tableJoin      =   nome da tabela a ser aplicada o INNER JOIN
    * $valueJoinCond  =   condição para se obter o INNER JOIN
    * $table          =   nome da tabela para consulta
    * 
    */      
    public function getJoinTables($fieldReturn, $compare, $tableJoin, $valueJoinCond, $tableJoin1, $valueJoinCond1, $tableJoin2, $valueJoinCond2, $tableJoin3, $valueJoinCond3, $tableJoin4, $valueJoinCond4, $table){
        
        //Select nos campos qual deseja retornar
        $this->db->select($fieldReturn);
        
        //na tabela? -Nome da tabela a ser consultada
        $this->db->from($table);
        
        //Inner join na segunda tabela e sua condição para obter os dados
        $this->db->join($tableJoin, $valueJoinCond, 'INNER');   

        $this->db->join($tableJoin1, $valueJoinCond1, 'INNER'); 

        $this->db->join($tableJoin2, $valueJoinCond2, 'INNER'); 

        $this->db->join($tableJoin3, $valueJoinCond3, 'INNER'); 

        $this->db->join($tableJoin4, $valueJoinCond4, 'INNER');         
        
        //Condição qual ser� aplicada aos dados na tabela consultada
        $this->db->where($compare, null);
        
        //retorna os dados
        return $this->db->get()->result();          
    }    



    public function sumValuesInFields($field, $compare, $table){
        $this->db->select_sum($field);
        $this->db->where($compare, null);
        $query  =  $this->db->get($table);
        $row    =  $query->row();
        return $row;
    }


    public function prompitQuery($querySql)
    {
        
        //Retorna os dados obtidos na consulta
        return $this->db->query($querySql)->result();
        
    } 



    public function lastIdInsert($table, $fieldOrder){
        
        $query = "SELECT * FROM $table ORDER BY $fieldOrder DESC LIMIT 1";

        $result = $this->db->query($query);

        if($result->num_rows() > 0) {

            return $result->result("array");

        }else {

            return 1;
            
        }
    }   


    public function modifyField($compare, $field = array(), $table) {
        
        $this->db->where($compare, null);
        
        if($this->db->update($table, $field))

            return true;

        else

            return false;      
        
    }    



    public function deleteValues($compare, $table){
        
        $this->db->where($compare, null);
        return $this->db->delete($table) ? true : false; 

    }         

}    