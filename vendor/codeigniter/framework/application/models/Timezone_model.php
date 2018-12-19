<?php

class Timezone_model extends CI_Model {
  public $id;
  public $ident;
  public $title;
  public $diff;
  
  
  /*
   * 
   * Метод для получения списка часовых поясов
   * 
   * @return array
   * 
   */
  public function get_all(){
    
    
    $this->db->select('id, ident, title, diff');
    $query = $this->db->get('timezone');
    $res = array();
    
    foreach ($query->result() as $row){
      
      $timezone = new $this;
      
      $timezone->id = (int)$row->id;
      $timezone->ident = $row->ident;
      $timezone->title = $row->title;
      $timezone->diff = (int)$row->diff;
      $res[] = $timezone;      
    }
    return $res;
  }
}