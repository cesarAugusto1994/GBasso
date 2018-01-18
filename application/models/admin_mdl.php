<?php
	class Admin_mdl extends CI_Model {
    
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
        		
        		return $this->db->insert($table, $fields);
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

		    public function lastRecord( $field, $where = null, $table )
		    {
		            
		        if( trim( $where ) != '' )

		            $where   =   " WHERE " . $where;

		        $query     =   "SELECT $field FROM $table $where ORDER BY $field DESC LIMIT 1";
		                        
		        $consulta  =   (array) $this->db->query( $query )->result();

		        $data      =   '';

		        if( count( $consulta ) == 1 ) {

		            foreach ($consulta as $key ) {

		                $data   =   $key->$field;

		            }

		        }

		        return  $data;
		        
		    }        	


		    public function unicResult( $field, $table )
		    {
		        
		        $query     =   "SELECT $field FROM $table ORDER BY $field DESC LIMIT 1";
		    			        
		        $consulta  =   (array) $this->db->query($query)->result();

		        $data      =   '';

		        foreach ($consulta as $key ) {

		        	$data   =   $key->$field;

		        }

		        return  $data;
		        
		    } 



		    public function searchRecord( $param, $field, $table )
		    {
		        
		        $query     =   "SELECT $field FROM $table ORDER BY $field DESC LIMIT 1";
		    			        
		        $consulta  =  (array) $this->db->query($query)->result();

		        foreach ($consulta as $key ) {

		        	$consulta   =   $key->$field;

		        }

		        return  $param != $consulta ? true : false;
		        
		    } 



		    public function searchRecordDuplicated( $field, $compare, $table )
		    {
		        
		        $query     	=   "	SELECT 
		        						$field 
		        					FROM 
		        						$table 
		        					$compare
		        				";
		    			        
		        $consulta  =    $this->db->query($query)->result();

		        return count( $consulta ) > 0 ? false : true;
		    }		    
		            
	}