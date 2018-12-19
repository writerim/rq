<?php

class Metertype_model extends CI_Model {
  public $id;
  public $title;
  public $dll_id;
  protected $meters_count;
  protected $parameters_count;
  protected $interprise_id;
  protected $configuration;
  public $meter_extra_type_id;
  
  
  /*
   * 
   * Метод для получения типов приборов
   * @return array
   * 
   */
  public function get_all(){
    
    $this->db->select('id, title, dll_id, meter_extra_type_id');
    $query = $this->db->get('meter_type');
    $res = array();      
    foreach ($query->result() as $row){
      
      $metertype = new $this;
      
      $metertype->id = (int)$row->id;
      $metertype->title = $row->title;
      $metertype->dll_id = $row->dll_id;
      $metertype->meter_extra_type_id = (int)$row->meter_extra_type_id;
      $res[] = $metertype;
    }
    return $res;  
  } 
  
}