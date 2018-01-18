<?php
	class Home_mdl extends CI_Model {
    
	    	public function __construct() {
	        	parent::__construct();
	    	}



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



		    public function getJoinTables($fieldReturn, $compare, $tableJoin, $valueJoinCond, $tableJoin1 = null, $valueJoinCond1 = null, $tableJoin2 = null, $valueJoinCond2 = null, $table){
		    	
		    	//Select nos campos qual deseja retornar
		        $this->db->select($fieldReturn);
		        
		        //na tabela? -Nome da tabela a ser consultada
		        $this->db->from($table);
		        
		        //Inner join na segunda tabela e sua condi��o para obter os dados
		        $this->db->join($tableJoin, $valueJoinCond, 'INNER');

		        if($tableJoin1 != null)
		        	$this->db->join($tableJoin1, $valueJoinCond1, 'INNER');

		        if($tableJoin2 != null)
		        	$this->db->join($tableJoin2, $valueJoinCond2, 'INNER');	        
		        
		        //Condi��o qual ser� aplicada aos dados na tabela consultada
		        $this->db->where($compare, null);
		        
		        //retorna os dados
		        return $this->db->get()->result();       	
		    }	    


		    public function returnQtdLines($compare, $table){
		    	
		    	$this->db->where($compare, null);
		    	$query = $this->db->get($table);
				$count = $query->num_rows();
				return $count;
		    }		    



		    public function deleteValues($compare, $table){
				
		        $this->db->where($compare, null);
		  		$this->db->delete($table); 

		    }
		    


		    public function modifyField($compare, $field = array(), $table) {
		        $this->db->where($compare, null);
		  		$this->db->update($table, $field);  	
		    }	


		    public function prompitQuery($querySql)
		    {
		        
		        //Retorna os dados obtidos na consulta
		        return $this->db->query($querySql)->result();
		        
		    } 		

		    public function insertNewValue($fields = array(), $table){        		
        		
        		return $this->db->insert($table, $fields) ?  true  :  false;
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
		            
	}