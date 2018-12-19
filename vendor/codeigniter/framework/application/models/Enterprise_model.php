<?php

class Enterprise_model extends CI_Model {

  public $id = 0;

  public $licence = 0;

  public $timezone_id = 0;

  public function add_empty(){
    $this->db->insert("enterprise" , array('licence' => 0));
    return $this->get_by_id( $this->db->insert_id() );
  }

  function get_by_id( $id = 0 ){
    $this->db->where( 'id' , $id );
    $res = $this->db->get('enterprise');
    if( !$res->num_rows() ){
      return new $this;
    }
    $enterprise = new $this;
    $row = $res->row();
    $enterprise->id = $row->id;
    $enterprise->licence = $row->licence;
    $enterprise->timezone_id = $row->timezone_id;
    return $enterprise;
  }

  function AddByArray( $data = array() ){
    $this->db->insert('enterprise' , $data);
    return $this->get_by_id( $this->db->insert_id() );
  }


  function Delete(){
    $this->db->where('id', $this->id);
    $this->db->delete('enterprise');
  }

}