<?php

class Converter_model extends CI_Model {

  public $id = 0;
  public $type = 0;
  public $title = "";
  public $ip = "";
  public $port = 0;
  public $login = "";
  public $password = "";  
  public $is_excluded = 0;
  public $meter_ok = 0;
  public $converter_title = '';
  public $portcontrol = 0;
  protected $enterprise_id = 0;
  
  
/*
 *
 * Создание модели для api по значениям из базы данных
 * 
 * @return Converter_model
 * 
 */
  public function SetByRowForPublic($row = NULL) {
    $this->load->model('converter_model');
    $converter = new $this;
    if (!$row) {
      return $converter;
    }
    if (!is_object($row)) {
      if (!count($row) || !is_array($row)) {
        return $converter;
      }
      $row = $row[0];
    }

    $this->load->model('fields_device_model' , "fd");

    $converter->id = (int) $row->id;
    $converter->type = (int) $row->type_id;
    $converter->title = $row->title;
    $converter->is_excluded = (int) $row->is_excluded;
    $converter->meter_ok = (int) $row->status;

    $id = $row->id;


    $converter->ip = $this->fd->get('ip' ,  $id )->value;
    $converter->port = $this->fd->get('port' , $id )->value;
    $converter->login = $this->fd->get('login' ,  $id )->value;
    $converter->password = $this->fd->get('password' ,  $id )->value;
    $converter->timeout_connect = $this->fd->get('timeout_connect' , $id )->value;
    $converter->timeout_receive = $this->fd->get('timeout_receive' , $id )->value;
    $converter->portcontrol = $this->fd->get('portcontrol' , $id )->value;

    $converter->count_child_meters = $this->GetCountChildMeters($converter->id);
    $converter->count_excluded_meters = $this->GetCountExcludedMeters($converter->id);
    $converter->count_not_ok_meters = $this->GetCountNotOkMeters($converter->id);
    return $converter;
  }

  
  /*
   * 
   * Метод для получения списка всех конвертеров
   * 
   * @return array
   * 
   */
  public function GetAll($offset = NULL, $limit = NULL) {
    $query = $this->get_converters_resource($offset, $limit);
    $res = array();
    foreach ($query->result() as $row) {
      $res[] = $this->SetByRowForPublic($row);
    }
    return $res;
  }



  function get_converters_resource($offset = NULL, $limit = NULL){
    $this->db->select('devices.*');
    $this->db->from('devices');
    $this->db->join('device_type' , 'device_type.id = devices.type_id' , "LEFT" );
    $this->db->join('interfaces' , 'interfaces.id = device_type.interface' , "LEFT" );
    $this->db->where('devices.enterprise_id' , $this->user_model->GetMy()->enterprise_id );
    $this->db->where('interfaces.ident' , 'converter' );
    $this->db->limit($limit, $offset);
    return $this->db->get();
  }




  
  public function GetTotal() {
    return $this->get_converters_resource()->num_rows();
  }
  
  
  public function GetConverterById($id = 0) {
    $this->db->where('enterprise_id', $this->user_model->GetMy()->enterprise_id );
    $this->db->where('id', (int) $id);
    $query = $this->db->get('devices', 1);
    if( $query->num_rows() == 0 ){
      return new $this;
    }
    return $this->SetByRowForPublic($query->row());
  }
  

  public function GetCountChildMeters($id = 0){    
    $this->db->where('converter_id', $id);
    $query = $this->db->get('meter');
    return $query->num_rows();
  }
  
  public function GetCountExcludedMeters($id = 0){
    $this->db->where('converter_id', $id);
    $this->db->where('is_excluded', 1 );
    $query = $this->db->get('meter');
    return $query->num_rows();
  }
  
  public function GetCountNotOkMeters($id = 0){
    $this->db->where('converter_id', $id);
    $this->db->where('is_ok', 0 );
    $query = $this->db->get('meter');
    return $query->num_rows();
  }
  
/*
 * 
 * Метод добавляет данные в таблицу converter.
 * Данные берутся из массива, который передается в качестве аргумента
 * Возвращает модель добавленного конвертера
 * 
 * @param array converterData
 * 
 * @return object
 * 
 */
  public function AddByArray($data = array()) {

    $this->load->model('fields_device_model' , "fd");

    if (!$this->db->insert('devices', array(
      'type_id'       => isset($data['type'])         ? (int) $data['type']         : 0,
      'title'         => isset($data['title'])        ? (string) $data['title']     : "",
      'is_excluded'   => isset($data['is_excluded'])  ? (int) $data['is_excluded']  : 0,
      'status'        => 1,
      'enterprise_id' => $this->user_model->GetMy()->enterprise_id 
    ))) {
      return new $this;
    }

    $converter = $this->converter_model->GetConverterById($this->db->insert_id());

    $id = $converter->id;

    $this->fd->add('port' , $data['port'] , $id );
    $this->fd->add('ip' , $data['ip'] , $id );
    $this->fd->add('login' , $data['login'] , $id );
    $this->fd->add('password' , $data['password'] , $id );
    $this->fd->add('portcontrol' , $data['portcontrol'] , $id );

    return $this->converter_model->GetConverterById($id);
  }

  
  public function UpdateByArray($data = array()){

    $this->load->model('fields_device_model' , "fd");

    $id = $data['id'] ? (int) $data['id'] : 0;

    $this->db->where('id', $id);
    $this->db->set("type_id"      , isset($data['type'])        ? (int) $data['type']       : 0   );
    $this->db->set("title"        , isset($data['title'])       ? (string) $data['title']   : ""  );
    $this->db->set("is_excluded"  , isset($data['is_excluded']) ? (int) $data['is_excluded']: 0   );
    $this->db->update('devices');

    $this->fd->update('port' , $data['port'] , $id );
    $this->fd->update('ip' , $data['ip'] , $id );
    $this->fd->update('login' , $data['login'] , $id );
    $this->fd->update('password' , $data['password'] , $id );
    $this->fd->update('portcontrol' , $data['portcontrol'] , $id );

    return $this->converter_model->GetConverterById($id);;            
  }
  

  public function Delete($id = 0) {
    //Если есть привязанные прибор учета - вернет false
    $this->db->where('converter_id', $id ? (int) $id : 0);
    if ($this->db->count_all_results('meter')) {
      return false;
    }
    $this->db->where('id', $id ? (int) $id : 0);
    $this->db->delete('converter');
    return $this->GetConverterById($id);
  }
  
  

}
