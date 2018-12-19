<?php

class Device_type_model extends CI_Model {

  public $id = 0;
  public $interface = 0;
  public $ident = "";
  public $title = "";


  function get_by_id( $id = 0 ){

    $this->db->where('id' , $id);
    $this->db->limit(1);
    $res = $this->db->get('device_type');

    if( $res->num_rows() == 0 ){
      return new $this;
    }

    $row = $res->row();
    $device_type = clone($this);
    $device_type->id = $row->id;
    $device_type->interface = $row->interface;
    $device_type->ident = $row->ident;
    $device_type->title = $row->title;

    return $device_type;

  }


  function get_interface(){
    $this->load->model('interface_model');
    return $this->interface_model->get_by_id( $this->interface );
  }


}