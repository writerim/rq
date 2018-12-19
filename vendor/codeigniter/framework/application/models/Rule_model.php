<?php

class Rule_model extends CI_Model {

  public $id = 0;

  public $title = "";

  public $enterprise_id = 0;

  public $description = 0;
  
  public function get_all(){
    $this->db->where('enterprise_id' , $this->user_model->GetMy()->enterprise_id);
    $query = $this->db->get('rule');
    $res = array();
    
    foreach ($query->result() as $row){
      $rule = new $this;
      $rule->id = (int)$row->id;
      $rule->title = $row->title;
      $rule->enterprise_id = (int)$row->enterprise_id;
      $rule->description = $row->description;
      $res[] = $rule;      
    }
    return $res;
  }

  function get_by_id( $id = 0 ){
    $this->db->where( 'id' , $id );
    $query = $this->db->get('rule');
    $rule = new $this;
    $row = $query->row();
    if( !$row ){
      return new $this;
    }
    $rule->id = $row->id;
    $rule->title = $row->title;
    $rule->id = $row->id;
    $rule->enterprise_id = $row->enterprise_id;
    $rule->description = $row->description;
    return $rule;
  }


  function UpdateByArray( $data = array() ){
    $id = isset( $data['id']) ? (int) $data['id'] : 0;
    if( !$id ){
      return new $this;
    }
    $this->db->set('title' , isset( $data['title'] ) ? $data['title'] : "");
    $this->db->set('description' , isset( $data['description'] ) ? $data['description'] : "");
    $this->db->where('id' , $id);
    $this->db->update('rule');
    return $this->get_by_id( $id );
  }

  function AddByArray( $data = array() ){
    $data['enterprise_id'] = $this->user_model->GetMy()->enterprise_id;
    $this->db->insert('rule' , $data);
    return $this->get_by_id( $this->db->insert_id() );
  }


  function delete_by_id( $id = 0 ){
    $this->db->where(array( 
      'enterprise_id' => $this->user_model->GetMy()->enterprise_id ,
      'id' => $id ? (int) $id : 0
    ));
    $this->db->delete('rule');
    return $this->get_by_id( $id ? (int) $id : 0 );
  }

}