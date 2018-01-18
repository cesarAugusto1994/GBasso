<?
class conn {
	var $conn;
	var $result;
	var $cursor;
	var $cursor2;
	var $execute_status;
	var $num_rows;
	var $num_fields;
	var $affected_rows;
	var $last_id;
	
	function conn() { //Construtor
		$c = mysql_connect('mysql.webmkt.com.br', 'webmkt04', '1020304050');// || die ("Não foi possível conectar ao mysql");
		mysql_select_db('webmkt04', $c);// || die ("Não foi possível selectionar o database mysql");
		$this->conn = $c;
	}
	
	function select_sql($sql)	{ 
		$this->cursor = mysql_query($sql, $this->conn) or die($this->get_error($sql));
		$this->num_rows = mysql_num_rows($this->cursor);
		$this->num_fields = mysql_num_fields($this->cursor);
	}	
	
	function alter_sql($sql){
		$this->cursor = mysql_query($sql, $this->conn) or die($this->get_error($sql));
		
		$this->affected_rows = mysql_affected_rows();
		$this->last_id = mysql_insert_id();
	}
	
	function fetch() {
		$this->result = mysql_fetch_array($this->cursor);
		return ($this->result);
	}	
	
	function simple_query($sql){
		$this->cursor2 = mysql_query($sql) or die($this->get_error($sql));
		$coluna = mysql_fetch_array($this->cursor2);
		return $coluna;
	}

	function get_result() {
		return $this -> result;
	} 

	function exec_stat() {
		return $this -> execute_status;
	} 
	
	function c_next() {
		return (mysql_fetch_row($this -> cursor));
	}
	
	function get_error($sql) {
		echo "Erro no MySQL: (".mysql_errno().") - ".mysql_error()."\r\n<br>Query: ".$sql;
	}
	
	function num_rows() {
		return (mysql_num_rows($this -> $cursor));
	}

}

	$db = new conn();
?>
