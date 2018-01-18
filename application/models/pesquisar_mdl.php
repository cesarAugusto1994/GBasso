<?php
class Pesquisar_mdl extends CI_Model {

    protected $dbObject = null;

    public $where  = null;

    public $fields = null;

    public $table  = null;

    public $clause = null;

    /**
     * Construtor
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    public function reset() {
        $this->where  = '';
        $this->fields = '';
        $this->clause = '';
    }

    public function insert($data = array()){
        return $this->db->insert($this->table, $data );
    }

    public function update($field = array()) {

        if (strlen( trim( $this->where ) ) > 4) {
            $this->db->where($this->where, null);
            $this->db->update($this->table, $field);
            return true;
        }else {
            return false;
        }
    }

    public function delete() {
        $this->db->where( $this->where );
        $this->db->delete( $this->table );	    	
    }    

    public function setDistinct() {
        $this->db->distinct();
    }

    /**
     * Método seta os campos para a busca
     *
     * @return void
     */
    public function setFields( $fields ) {
        $this->fields .=  "$fields";
    }

    /**
     * Método seta um clausula Where
     *
     * @return void
     */
    public function setWhere( $where ) {
        if( trim( $this->where ) != '' )
            $this->where  .=   " AND $where ";
        else 
            $this->where  .=   "$where";
    }

    /**
     * Método seta um clausula Inner Join
     *
     * @return void
     */
    public function setJoin( $table, $condition ) {
        $this->db->join($table, $condition);			
    }

    /**
     * Método seta clausula Group By
     *
     * @return void
     */
    public function setGroup( $field ) {
        $this->db->group_by( $field );
    }

    /**
     * Método seta clausula Order By
     *
     * @return void
     */
    public function setOrder( $field, $value ) {
        $this->db->order_by($field, $value);
    }

    /**
     * Método retorna a quantidade de linhas da query
     *
     * @return int
     */
    public function count() {
        return $this->db->query('SELECT FOUND_ROWS() AS `Count`')->row()->Count;
    }

    /**
     * Método seta o limite na consulta
     *
     * @return void
     */
    public function setLimite( $value, $offset ) {
        return $this->db->limit( $value, $offset );
    }

    /**
     * Método seta a clausula LIKE
     *
     * @param $field  - Campo para o like
     * @param $query  - Valor para o campo like
     * @param $escape - Options: Before, after or null
     * @return void
     */
    public function setLike( $field, $query, $escape = '') {
        $this->db->like( $field, $query, $escape);
    }

    public function setHaving( $field, $value, $operator = ">") {

        switch ( $operator ) {
            case '>':
                $this->db->having("$field > $value");
            break;
            case '=':
                $this->db->having("$field = $value");
            break;
            case '<':
                $this->db->having("$field < $value");
            break;	
        }

    }

    /**
     * Método realiza a consulta
     *
     * @return array
     */
    public function get() {
        $this->db->select( $this->fields, false );
        $this->db->from( $this->table );
        if( trim( $this->where ) != '' ) 
            $this->db->where( $this->where );
        $this->dbObject = $this->db->get();
        return $this->dbObject->result();
    }

    public function onlyUniqueValueExist() {
        $data  =  $this->get();
        return count($data) == 1 ? true : false;
    }

    /**
     * Método retorna a ultima query executada
     *
     * @return void
     */
    public function showLastQuery() {
        //preg_replace(pattern, replacement, subject)
        echo preg_replace('/`/', '', $this->db->last_query() ); exit;
    }    
}