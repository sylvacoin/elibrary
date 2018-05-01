<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_all extends CI_Model 
{

    function __construct() 
    {
        parent::__construct();
    }

    function get_tables() 
    {
        $table[] = "users";
        return $table;
    }
    
    function get_table_ids() 
    {
        $table_ids[] = "user_id";
	
        return $table_ids;
    }

    function get( $table = 0 ) 
    {
        $tables = $this->get_tables();
        $query=$this->db->get($tables[$table]);
        return $query;
    }

    function get_where($id, $table = 0 ) 
    {
	$table_ids = $this->get_table_ids();
	$tables = $this->get_tables();
	
	if ( is_numeric( $id ) )
	{
	    $this->db->where( $table_ids[$table], $id );
	}
	if (is_array($id))
	{
	    $this->db->where($id);
	}
	
        $query=$this->db->get($tables[$table]);
        return $query;
    }
    /*
     * JOIN
     * join ( $tbl_to_join, $tbl_performing_join, $cols )
     * 
     * $col
     * @array [tbl_to_join_col => tbl_performing_join_col]
     */
    
    function join( $join_tbl = 1, $table = 0, $cols = array() )
    {
	$tables = $this->get_tables();
	$joins = $this->process_joins($join_tbl, $table, $cols);
	return $this->db->join( $tables[$join_tbl], $joins);
    }

    // $cols = [ $joined_table_unique_col => $table_unique_col]
    //
    private function process_joins( $join_tbl = 1, $table = 0, $cols = array() )
    {
	$tables = $this->get_tables();
	$table_ids = $this->get_table_ids();
	$joins = NULL;
	if (is_array($cols) && count($cols) > 0 ){
	    
	    foreach ( $cols as $k => $v )
	    {
		$joins = "$tables[$join_tbl].$k = $tables[$table].$v " ;
	    }
	}else{
	    $joins = "$tables[$join_tbl].$table_ids[$join_tbl] = $tables[$table].$table_ids[$table]" ;
	    
	}
	
	return $joins;
    }

    function _insert($data, $tbl = 0) 
    {
        $table = $this->get_tables();
        return $this->db->insert($table[$tbl], $data);
    }

    function _update($id, $data, $tbl = 0) 
    {
	$table_id = $this->get_table_ids();
        $table = $this->get_tables();
        $this->db->where( $table_id[$tbl], $id);
        return $this->db->update($table[$tbl], $data);
    }

    function _delete($id, $tbl = 0) 
    {
	$table_id = $this->get_table_ids();
        $table = $this->get_tables();
	if (is_array($id) && count($where) > 0)
	{
	    $this->db->where($where);
	}else{
	    $this->db->where($table_id[$tbl], $id);
	}
        
        return $this->db->delete($table[$tbl]);
    }

    function count_where($column, $value, $tbl = 0) 
    {
        $table = $this->get_tables();
        $this->db->where($column, $value);
        $query=$this->db->get($table[$tbl]);
        $num_rows = $query->num_rows();
        return $num_rows;
    }

    function count_all( $tbl = 0 ) 
    {
        $table = $this->get_tables();
        $query=$this->db->get($table[$tbl]);
        $num_rows = $query->num_rows();
        return $num_rows;
    }

    function get_max( $tbl ) 
    {
	$table_id = $this->get_table_ids();
        $table = $this->get_tables();
        $this->db->select_max($table_id[$tbl]);
        $query = $this->db->get($table[$tbl]);
        $row=$query->row();
        $id=$row->id;
        return $id;
    }

    function _custom_query($mysql_query) 
    {
        $query = $this->db->query($mysql_query);
        return $query;
    }

}
