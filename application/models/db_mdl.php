<?php
/**
*  Versão 1.0.00
*  data:  15-05-2015
*  Add :  insertValues($fields = array(), $table)
*         1: Método calcula diferença entre datas e retorna o mesmo em dias ou no padrão escolhido
*-----------------------------------------------------------------------------------------------------------
*
**/


/**
* Esta classe realiza todas as operações com banco de dados do sistema
* 
* @since     1.0.00  15-05-2015
* @version   1.0.00
*
**/
class Db_mdl extends CI_Model {

	
	public function __construct() {

    	parent::__construct();

	}


    /**
    * Esse método insere registros em banco de dados
    *
    * @param   ARRAY  STRING $fields  -   Todos os valores que serão gravados na tabela passada.
    *                                     O índice do array é o nome do campo da tabela e seu valor é o valor que será gravado para o campo da tabela
    * @param   STRING        $table   -   Tabela onde será gravado os valores
    * @return  BOOLEAN
    * @access  public
    *
    **/
    public function insertValues( $fields = array(), $table ){        		

        /** 
        *   Grava os dados utilizando o método insert da classe DB do codeigniter
        *   @see  http://www.codeigniter.com/userguide2/database/active_record.html#insert
        *
        **/         	
		return $this->db->insert( $table, $fields );

	}




    /**
    * Esse método realiza uma consulta em bando de dados
    *
    * @param   STRING $query  -   Query SQL
    * @return  ARRAY STD CLASS
    * @access  public
    *
    **/
    public function query( $query ){              

        /** 
        *   Grava os dados utilizando o método query da classe DB do codeigniter
        *   @see  http://www.codeigniter.com/userguide2/database/active_record.html
        *
        **/             
        //Retorna os dados obtidos na consulta
        return $this->db->query( $query )->result();

    }


    /**
    * Esse método realiza uma consulta em bando de dados
    *
    * @param   STRING $query  -   Query SQL
    * @return  ARRAY STD CLASS
    * @access  public
    *
    **/
    public function exec( $query ){              

        /** 
        *   Grava os dados utilizando o método query da classe DB do codeigniter
        *   @see  http://www.codeigniter.com/userguide2/database/active_record.html
        *
        **/             
        //Retorna os dados obtidos na consulta
        return $this->db->query( $query );

    }


    /**
    * Esse método retorna a ultima ocorrência de um registro em banco de dados
    * Os resultados no banco de dados são ordenados decrecentemente e retorna o primeiro apenas
    *
    * @param   STRING $field    -   Campo que deseja retornar
    * @param   STRING $table    -   Tabela para consulta sql
    * @return  MIX
    * @access  public
    *
    **/
    public function lastRecord( $field, $where = null, $table )
    {

        $field  =  trim( $field );
            
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


    /**
    * Esse método atualiza a registros em um tabela
    *
    * @param   ARRAY STRING $field    -   Campo que deseja alterar
    * @param   STRING $compare        -   Condição de alteração
    * @param   STRING $table          -   Tabela que deseja realizar a alteração
    * @return  VOID
    * @access  public
    *
    **/
    public function update( $field = array(), $compare, $table) {
        
        $this->db->where( $compare, null);
        
        $this->db->update( $table, $field );      

    }


    /**
    * Esse método verifica se existe um ou mais registro numa tabela, baseando-se numa condição especifica
    *
    * @param   STRING $field          -   Um campo qualquer da query
    * @param   STRING $compare        -   Condição de busca
    * @param   STRING $table          -   Tabela que deseja realizar a consulta
    * @return  BOOL
    * @access  public
    *
    **/
    public function searchRecord( $field, $compare, $join, $table )
    {

        $query      =   "   SELECT 
                                $field 
                            FROM 
                                $table
                            $join
                            WHERE 
                            $compare
                        ";
                        
        $consulta  =    $this->db->query($query)->result();

        return count( $consulta ) > 0 ? TRUE : FALSE;
 
    }

    /**
    * Esse método retorna a soma dos valores encontrados pela query
    *
    * @param   STRING $field          -   Um campo qualquer da query
    * @param   STRING $compare        -   Condição de busca
    * @param   STRING $table          -   Tabela que deseja realizar a consulta
    * @return  BOOL
    * @access  public
    *
    **/
    public function sumField( $query, $field )
    {
                        
        $consulta  =   (array) $this->db->query($query)->result();


        $data      =   0;

        if( count( $consulta ) == 1 ) {

            foreach ($consulta as $key ) {

                $data   =   $key->$field;

            }

        }

        $data  =  is_numeric( $data ) ? $data : 0;

        return  $data;

    }


    public function countField( $query, $field )
    {
                        
        $consulta  =   (array) $this->db->query($query)->result();

        $data      =   0;

        if( count( $consulta ) == 1 ) {

            foreach ($consulta as $key ) {

                $data   =   $key->$field;

            }

        }

        $data  =  is_numeric( $data ) ? $data : 0;

        return  $data;

    }

    /**
    * Esse método retorna a soma dos valores encontrados pela query
    *
    * @param   STRING $field          -   Um campo qualquer da query
    * @param   STRING $compare        -   Condição de busca
    * @param   STRING $table          -   Tabela que deseja realizar a consulta
    * @return  BOOL
    * @access  public
    *
    **/
    public function maxMinField( $query )
    {

        $consulta  =   (array) $this->db->query($query)->result();

        $data      =   '';

        if( count( $consulta ) == 1 ) {

            foreach ($consulta as $key ) {

                $data   =   $key->field;

            }

        }

        return  $data;

    }


    /**
    * Esse método busca um determinado registro numa tabela, baseando-se numa condição especifica
    * OBS: Retorna apenas 1 valor
    *
    * @param   STRING $field          -   Campo que deseja retorna na query
    * @param   STRING $compare        -   Condição de busca
    * @param   STRING $table          -   Tabela que deseja realizar a consulta
    * @return  BOOL
    * @access  public
    *
    **/
    public function getRecord( $field, $compare, $join, $table )
    {   

        $field  =  trim( $field );
        
        $query      =   "   SELECT 
                                $field 
                            FROM 
                                $table 
                            $join
                            WHERE
                            $compare
                        ";
                        
        $consulta  =    $this->db->query($query)->result();

        $data  = '';

        if( count( $consulta ) > 0 ) {

            foreach ($consulta as $key ) {

                $data   =   $key->$field;

            }

        }else {

            $data = false;

        }               

        return $data;

    }


    public function searchRecordDuplicated( $field, $compare, $table )
    {
        
        $query      =   "   SELECT 
                                $field 
                            FROM 
                                $table
                            WHERE 
                                $compare
                        ";
                        
        $consulta  =    $this->db->query($query)->result();

        return count( $consulta ) > 0 ? TRUE : FALSE;

    }

    public function modifyField($compare, $field = array(), $table) {
        $this->db->where($compare, null);
        $this->db->update($table, $field);      
    }



    public function delete($compare, $table){
        
        $this->db->where($compare, null);
    
            $this->db->delete($table); 

    }


	/*
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
    


    	


    public function prompitQuery($querySql)
    {
        
        //Retorna os dados obtidos na consulta
        return $this->db->query($querySql)->result();
        
    } 		


    public function lastRecord( $field, $table )
    {
        
        $query     =   "SELECT $field FROM $table ORDER BY $field DESC LIMIT 1";
    			        
        $consulta  =   (array) $this->db->query($query)->result();

        $data      =   '';

        foreach ($consulta as $key ) {

        	$data   =   $key->$field;

        }

        return  $data;
        
    } 


    public function searchRecord( $field, $compare, $table )
    {
        
        $query     	=   "	SELECT 
        						$field 
        					FROM 
        						$table 
        					WHERE
        					$compare
        				";
    			        
        $consulta  =    $this->db->query($query)->result();

        $data  = '';

        foreach ($consulta as $key ) {

        	$data   =   $key->$field;

        }		        

        return count( $consulta ) > 0 ? $data : FALSE;

    }		
    */		        
	            
}