<?php

class Placetype_model extends CI_Model {
  public $id;
  public $ident;
  public $name;
  
  
  /*
   * 
   * Метод для получения типов мест 
   * 
   * @return array
   * 
   */
  public function get_all(){
    
    $this->load->database();
    $this->db->select('id, ident, name');
    $query = $this->db->get('placetype');
    $res = array();
    foreach ($query->result() as $row){
      
      $placetype = new $this;
      
      $placetype->id = (int)$row->id;
      $placetype->ident = $row->ident;      
      $placetype->name = $row->name;      
      $res[] = $placetype;      
    }
    return $res;  
  } 
  
}