<?php

class Devices_model extends CI_Model {

  public $id = 0;
  public $device_id = 0;
  public $enterprise_id = 0;
  public $type_id = 0;
  public $title = "";
  public $is_excluded = 0;
  public $status = 0;
  public $timezone = 0;


  public function set_by_from_public($row = NULL) {

    $device = clone($this);

    $device->id = (int) $row->id;
    $device->type = (int) $row->type_id;
    $device->title = $row->title;
    $device->is_excluded = (int) $row->is_excluded;
    $device->status = (int) $row->status;

    $id = $row->id;

    // Теперь узнаем что за интерфейс и исходя из него добавляем поля

    $interface = $device->get_device_type()->get_interface();

    switch( $interface->ident ){

      case "electro" :
        $converter->num_serial = $this->fd->get('num_serial' ,  $id )->value;
      break;
      case "converter" :
        $device->ip = $this->fd->get('ip' ,  $id )->value;
        $device->port = $this->fd->get('port' , $id )->value;
        $device->login = $this->fd->get('login' ,  $id )->value;
        $device->password = $this->fd->get('password' ,  $id )->value;
        $device->timeout_connect = $this->fd->get('timeout_connect' , $id )->value;
        $device->timeout_receive = $this->fd->get('timeout_receive' , $id )->value;
        $device->portcontrol = $this->fd->get('portcontrol' , $id )->value;

        $device->count_child_meters = $this->GetCountChildMeters($converter->id);
        $device->count_excluded_meters = $this->GetCountExcludedMeters($converter->id);
        $device->count_not_ok_meters = $this->GetCountNotOkMeters($converter->id);
      break;
    }


    return $device;
  }

  function get_device_type(){
    $this->load->model('device_type_model');
    return $this->device_type_model->get_by_id( $this->type_id );
  }


  function get_by_device_id( $device_id = 0 ){

    $this->db->where('device_id' , $device_id);
    $this->db->where('enterprise_id' , $this->user_model->GetMy()->enterprise_id);
    $res = $this->db->get('devices');
    if( $res->num_rows() == 0 ){
      return array();
    }
    $result = array();
    foreach( $res->result() as $row ){
      $result[] = $this->set_by_from_public( $row );
    }
    return $result;


  }


}