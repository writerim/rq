<?php

class Fields_device_model extends CI_Model {
  
  public $id = 0;
  public $device = 0;
  public $field = 0;
  public $value = "";

  
  function add( $ident = "" , $value = "" , $device = 0 ){

    $this->db->where('ident' , $ident);
    $res_ffd = $this->db->get('fields_for_devices');

    if( $res_ffd->num_rows() == 0 ){
      return new $this;
    }

    $this->db->insert('fields_device' , array(
      'device' => $device,
      'value' => $value,
      'field' => $res_ffd->row()->id,
    ));

    return $this->get_by_id( $this->db->insert_id() );

  }  


  function get($ident = "" , $id = 0){
    $this->db->where('ident' , $ident);
    $this->db->limit(1);
    $res_ffd = $this->db->get('fields_for_devices');

    if( $res_ffd->num_rows() == 0 ){
      return new $this;
    }

    $this->db->where('field' , $res_ffd->row()->id );
    $this->db->where('device' , $id );
    $res = $this->db->get('fields_device');

    if( $res->num_rows() == 0 ){
      return new $this;
    }

    return $this->get_by_id( $res->row()->id );
  }



  function update( $ident = "" , $value = "" , $device = 0 ){

    $this->db->where('ident' , $ident);
    $res_ffd = $this->db->get('fields_for_devices');

    if( $res_ffd->num_rows() == 0 ){
      return new $this;
    }

    $this->db->where('field' , $res_ffd->row()->id);
    $this->db->where('device' , $device);
    $this->db->limit(1);
    $res = $this->db->get('fields_device');
    if( $res->num_rows() == 0 ){
      return $this->add( $ident , $value , $device );
    }

    $this->db->where('id' , $res->row()->id);
    $this->db->set('value' , $value);
    $this->db->update('fields_device');

    return $this->get_by_id( $res_ffd->row()->id );

  }

  function get_by_id( $id = 0 ){
    $this->db->where('id' , $id);
    $this->db->limit(1);
    $res = $this->db->get('fields_device');
    if( $res->num_rows() == 0 ){
      return new $this;
    }

    $this->db->where('id' , $res->row()->field);
    $this->db->limit(1);
    $res_ffd = $this->db->get('fields_for_devices');

    if( $res_ffd->num_rows() == 0 ){
      return new $this;
    }

    $res_1 = $res->row();
    $row = new $this;
    $row->id      = $res_1->id;
    $row->device  = $res_1->device;
    $row->field   = $res_1->field;
    $row->value   = $res_1->value;
    if( $res_ffd->row()->is_int == 1 ){
      $row->value = (int) $row->value;
    }
    return $row;
  }
  

}