<?php 

namespace db;

use db\Querys;

if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );


/**
* Esta classe é a responsável por executar qualquer tipo de query em banco de dados
*
* @since     1.0.00 16-06-2015
* @version   1.0.00
*
**/


class Querys  {

    //Nome da tabela em consulta
    public $table     =   null;

    //Instancia do Codeigniter
    public $CI        =   null;

    public $field     =   null;

    public $where     =   null;

    public $join      =   null;

    public $clausula  =   null;

    public $cep       =   null;

    public $query     =   null;


    public function __construct() {

        //Set default timestamp
        date_default_timezone_set("America/Sao_Paulo");
            
        $this->CI  =&  get_instance();

        //Inicializa o model que vai realizar as consultas em banco de dados
        $this->CI->load->model( 'db_mdl', 'bd' );
        
        //Inicaliza a conexão com o banco de dados
        $this->CI->load->database();

    }



    /**
    * Esse método insere registros em uma determinada tabela
    *
    * @param   ARRAY STRING $fields   -   Campos que serão inseridos
    * @return  BOOL
    * @access  PUBLIC
    *
    **/
    public function insert( $fields = array() ) {

        $this->CI->bd->insertValues( $fields, $this->table  );

    }



    /**
    * Esse método deleta registros em uma determinada tabela
    *
    * @param   NULL
    * @return  NULL
    * @access  PUBLIC
    *
    **/
    public function delete() {

        $this->CI->bd->delete( $this->where, $this->table  );

    }




    /**
    * Esse método atualiza registros em uma determinada tabela
    *
    * @param   ARRAY STRING $array   -   Campos que precisam ser retornados
    * @return  VOID
    * @access  PUBLIC
    *
    **/
    public function update( $array = array() ) {

        $this->CI->bd->update( $array, $this->where, $this->table  );

    }



    /**
    * Esse método consulta o ultimo registro inserido com base em uma condição especifica
    * OBS: Só retorna 1 campo por chamada
    *
    * @param   NULL
    * @return  BOOL - INT - STRING
    * @access  PUBLIC
    *
    **/
    public function last() {

        return $this->CI->bd->lastRecord( $this->field, $this->where, $this->table  );

    }



    /**
    * Esse método consulta se existe algum registro na tabela,baseando-se numa condição
    *
    * @param   NULL
    * @return  BOOL
    * @access  PUBLIC
    *
    **/
    public function searchRecord() {

        //Seta a tabela para a query
        $this->query   =  "SELECT $this->field FROM $this->table";

        //Incrementa a condição JOIN na query
        $this->query  .=  $this->join;

        //Seta a condição de WHERE na query
        $this->query  .=  strlen( $this->where ) > 0 ? ' WHERE ' . $this->where : NULL;

        $this->query  .=  $this->clausula;

        //Retorna o resultado da query
        return count( $this->CI->bd->query( $this->query ) ) > 0 ? true : false;

    }


    /**
    * Esse método busca um determinado registro numa tabela, baseando-se numa condição especifica
    * OBS: Retorna apenas 1 valor
    *
    * @param   NULL
    * @return  STRING
    * @access  PUBLIC
    *
    **/
    public function getRecord() {

        $this->where  .=   $this->clausula;

        return $this->CI->bd->getRecord( $this->field, $this->where, $this->join, $this->table  );

    }




    /**
    * Esse método retorna registros atráves de uma série de parametros inicialmente especificados
    *
    * @param   NULL
    * @return  ARRAY STD CLASS
    * @access  PUBLIC
    *
    **/
    public function get() {

        //Seta a tabela para a query
        $this->query   =  "SELECT $this->field FROM $this->table";

        //Incrementa a condição JOIN na query
        $this->query  .=  $this->join;

        //Seta a condição de WHERE na query
        $this->query  .=  strlen( $this->where ) > 0 ? ' WHERE ' . $this->where : NULL;

        $this->query  .=  $this->clausula;

        //Retorna o resultado da query
        return $this->CI->bd->query( $this->query );

    }



    public function exec( $query ){

        return $this->CI->bd->exec( $query );

    }
    

    /**
    * Esse método retorna a soma de registros com o parametro semelhante
    *
    * @param   NULL
    * @return  FLOAT
    * @access  PUBLIC
    *
    **/
    public function sum() {

        //Seta a tabela para a query
        $this->query   =  "SELECT SUM($this->field) AS calc FROM $this->table";

        //Incrementa a condição JOIN na query
        $this->query  .=  $this->join;

        //Seta a condição de WHERE na query
        $this->query  .=  strlen( $this->where ) > 0 ? ' WHERE ' . $this->where : NULL;

        //Retorna o resultado da query
        return $this->CI->bd->sumField( $this->query, 'calc' );

    }


    public function count() {

        //Seta a tabela para a query
        $this->query   =  "SELECT COUNT($this->field) AS count FROM $this->table";

        //Incrementa a condição JOIN na query
        $this->query  .=  $this->join;

        //Seta a condição de WHERE na query
        $this->query  .=  strlen( $this->where ) > 0 ? ' WHERE ' . $this->where : NULL;

        //Retorna o resultado da query
        return $this->CI->bd->countField( $this->query, 'count' );

    }


    /**
    * Esse método retorna a soma de registros com o parametro semelhante
    *
    * @param   NULL
    * @return  FLOAT
    * @access  PUBLIC
    *
    **/
    public function maxMinField( $action ) {

        //Seta a tabela para a query
        $this->query   =  $action == 'max' ? "SELECT MAX($this->field) AS field FROM $this->table" : "SELECT MIN($this->field) AS field FROM $this->table";

        //Seta a condição de WHERE na query
        $this->query  .=  strlen( $this->where ) > 0 ? ' WHERE ' . $this->where : NULL;

        //Retorna o resultado da query
        return $this->CI->bd->maxMinField( $this->query );

    }


    /**
    * Esse método consulta um CEP na base de CEP e o retorna caso encontre
    *
    * @param   $num   -    Número do Cep que deseja consultar
    * @return  ARRAY STD CLASS
    * @access  PUBLIC
    *
    **/
    public function getEndereco( $num ) {

        $consulta   =   "   SELECT 
                                log.log_nome, 
                                bai.bai_no, 
                                log.cep, 
                                log.ufe_sg, 
                                loc.loc_no
                            FROM 
                                log_logradouro AS log
                            INNER JOIN log_bairro     AS bai ON log.bai_nu_sequencial_ini = bai.bai_nu_sequencial
                            INNER JOIN log_localidade AS loc ON loc.loc_nu_sequencial     = bai.loc_nu_sequencial
                            WHERE 
                                log.cep = '$num'
                            GROUP BY 
                                log.cep
                    ";

        $this->cep  =   $this->connectBDCep();

        return  $this->cep->query( $consulta )->result();

    }




    /**
    * Esse método seta os campos que serão retornados pela query
    *
    * @param   STRING $fields    -   Campos que serão retornados na query
    * @return  VOID
    * @access  PUBLIC
    *
    **/
    public function setField( $fields = '*' ) {

        //Seta os campos na query
        $this->field   .=   " $fields ";

    }




    /**
    * Esse método seta uma condição WHERE para a query
    *
    * @param   STRING $where    -   Condição Where para a query
    * @return  VOID
    * @access  PUBLIC
    *
    **/
    public function setWhere( $where = '' ) {

        //Seta a condição where

        if( trim( $this->where ) != '' )

            $this->where  .=   " AND $where ";

        else 

            $this->where  .=   "$where";

    }


    public function setClausula( $clausula = '' ) {

        $this->clausula  .=   ' ' . $clausula;

    }



    /**
    * Esse método seta uma condição de JOIN para a query
    *
    * @param   STRING $join    -   Condição de INNER, LEFT ou right para join de tabelas na query presente
    * @return  VOID
    * @access  PUBLIC
    *
    **/
    public function setJoin( $join = '' ) {

        //Seta a condição de Join
        $this->join  .=   " $join ";

    }    


    /**
    * Esse método reseta o valor do atributo $field da classe
    *
    * @param   NULL
    * @return  VOID
    * @access  PUBLIC
    *
    **/
    public function resetField() {

        $this->field   =   '';

    }



    /**
    * Esse método reseta o valor do atributo $where da classe
    *
    * @param   NULL
    * @return  VOID
    * @access  PUBLIC
    *
    **/
    public function resetWhere() {

        $this->where   =   '';

    }


    public function resetClausula() {

        $this->clausula   =   '';

    }


    /**
    * Esse método reseta o valor de todos os atributos da classe
    *
    * @param   NULL
    * @return  VOID
    * @access  PUBLIC
    *
    **/
    public function reset() {

        $this->query     =   '';

        $this->where     =   '';

        $this->field     =   '';

        $this->join      =   '';

        $this->clausula  =   '';

    }


    /**
    * Esse método se conecta na base de CEP RDS
    * Substitui a conexão padrão do banco de dados da aplicação e assumi a base de CEP´s
    *
    * @param  NULL
    * @access PUBLIC
    * @return OBJECT
    *
    **/
    public function connectBDCep() {

        $config['hostname']   =   "mysql.webmkt.com.br";

        $config['username']   =   "webmkt19";

        $config['password']   =   "Net102030";

        $config['database']   =   "webmkt19";

        $config['dbdriver']   =   "mysqli";

        $config['dbprefix']   =   "";

        $config['pconnect']   =   FALSE;

        $config['db_debug']   =   TRUE;

        $config['cache_on']   =   FALSE;

        $config['cachedir']   =   "";

        $config['char_set']   =   "utf8";

        $config['dbcollat']   =   "utf8_general_ci";

        return $this->CI->load->database($config, TRUE);

    }


    /**
    * Esse método grava os dados do cliente no banco de dados
    *
    * @param   ARRAY STRING  $fields  -  Array com os valores para serem gravados na tabela de clientes, 
    *                                    o array tem como indice o nome do campo da tabela e o valor desse indice será o valor gravado no campo da tabela
    * @return  VOID
    * @access  public
    *
    **/
    public function cadastrar( $fields = array() ) {

        try {

            $this->insert( $fields );

        }catch( Exception $e ) {

            return $e->getMessage();

        }

    }


}