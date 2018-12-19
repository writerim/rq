<?php

class Convertertypes_model extends CI_Model {
  
  public $id = 0;
  public $title = "";
  public $ident = "";
  
 /*
  * Метод для полкчение всех типов коневертеров
  * 
  * @return array Список
  */
  public function get_all(){

    $this->db->select('device_type.*');
    $this->db->from('device_type');
    $this->db->join('interfaces' , "interfaces.id = device_type.interface" , "LEFT");
    $this->db->where('interfaces.ident' , "converter");
    $query = $this->db->get();    
    $res = array();
    foreach ($query->result() as $row){
      $convertertypes = new $this;    
      $convertertypes->id = (int)$row->id;
      $convertertypes->title = $row->title;
      $convertertypes->dll_id = $row->ident;
      $res[] = $convertertypes;    
    }
  
    return $res;    
  }         
    
}