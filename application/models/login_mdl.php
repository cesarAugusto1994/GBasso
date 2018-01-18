<?php
	class Login_mdl extends CI_Model {
    
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


		    	public function insertNewValue($fields = array(), $table){        		
        		
        			return $this->db->insert($table, $fields);

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
	}