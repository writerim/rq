<?php

class Interface_model extends CI_Model {

  public $id = 0;
  public $ident = "";
  public $title = "";


  function get_by_id( $id = 0 ){
    $this->db->where('id' , $id);
    $this->db->limit(1);
    $res = $this->db->get('interfaces');
    if( $res->num_rows() == 0 ){
      return clone($this);
    }
    $row = $res->row();
    $interface = clone($this);
    $interface->id = $row->id;
    $interface->ident = $row->ident;
    $interface->title = $row->title;
    return $interface;
  }


}