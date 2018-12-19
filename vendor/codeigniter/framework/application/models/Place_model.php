<?php

class Place_model extends CI_Model {

  public $id = 0;
  public $place_id = 0;
  public $title = "";
  public $type = 0;
  protected $lft = 0;
  protected $rgt = 0;
  protected $enterprise_id = 0;
  public $meters_all = 0;
  public $meters_error = 0;
  public $meters_excluded = 0;
  public $places_all = 0;


  function get_rgt(){
    return $this->rgt;
  }


  function get_count(){
    $query = $this->db->get('place');
    return $query->num_rows();
  }

  function get_id_main_place( $enterprise_id = 0 ){
    $this->db->where('enterprise_id' , $enterprise_id);
    $this->db->order_by('lft');
    $this->db->limit(1);
    $query = $this->db->get('place');
    $row = $query->result();
    $place = new $this;
    if (!empty($row)) {
      $place = $this->set_by_row_for_public($row);
    }
    return $place->id;
  }

  
  /*
   * 
   * Метод для получения списка всех мест 
   * 
   * @return array 
   * 
   */
  public function get_all($offset = NULL, $limit = NULL) {

    $this->db->select('id, place_id, title, placetype_id');
    $this->db->order_by('title');
    $query = $this->db->get('place', $limit, $offset);
    $res = array();

    foreach ($query->result() as $row) {
      $res[] = $this->set_by_row_for_public($row);
    }
    return $res;
  }


  function get_children($offset = NULL, $limit = NULL){
    $this->db->order_by('title');
    $this->db->where('place_id' , $this->id);
    $query = $this->db->get('place', $limit, $offset);
    $res = array();

    foreach ($query->result() as $row) {
      $res[] = $this->set_by_row_for_public($row);
    }
    return $res;
  }


  function get_parents($offset = NULL, $limit = NULL){
    $this->db->order_by('title');
    $this->db->where('lft <' , $this->lft);
    $this->db->where('rgt >' , $this->rgt);
    $query = $this->db->get('place', $limit, $offset);
    $res = array();

    foreach ($query->result() as $row) {
      $res[] = $this->set_by_row_for_public($row);
    }
    return $res;
  }



  function get_parent_count($offset = NULL, $limit = NULL){
    $this->db->order_by('title');
    $this->db->where('lft <' , $this->lft);
    $this->db->where('rgt >' , $this->rgt);
    $query = $this->db->get('place', $limit, $offset);
    return $query->num_rows();
  }


  function get_children_count(){
    $this->db->where('place_id' , $this->id);
    $query = $this->db->get('place');
    return $query->num_rows();
  }
  
  
  public function get_total() {
    $query = $this->db->get('place');
    $res = array();
    foreach ($query->result() as $row) {
      $res[] = $this->set_by_row_for_public($row);
    }
    return $res;
  }


  function get_first_interprise(){
    $this->db->where('enterprise_id', $this->user_model->GetMy()->enterprise_id );
    $this->db->where('place_id', 0 );
    $query = $this->db->get('place');
    if( !$query->num_rows() ){
      return $this->AddByArray(array(
        'title' => "Home",
        "enterprise_id" => $this->user_model->GetMy()->enterprise_id
      ));
    }
    $place = new $this;
    return $this->set_by_row_for_public($query->row());
  }
  

  /*
   * 
   * Метод для получения модели места по id
   * 
   * @param placeId int 
   * @return res array
   * 
   * 
   */
  public function GetPlaceById($placeId = 0) {
    $this->db->where('id', $placeId ? (int) $placeId : 0);
    $query = $this->db->get('place');
    $row = $query->result();
    $place = new $this;
    if (!empty($row)) {
      $place = $this->set_by_row_for_public($row);
    }
    return $place;
  }
  

  /*
   * 
   * Получение списка моделей по номеру предприятия
   * 
   * @param interprise int 
   * @return array
   * 
   */
  public function GetByInterprise($enterprise_id = 0) {
    $res = array();
    if (!$enterprise_id) {
      return $res;
    }
    $this->db->where('enterprise_id', $enterprise_id ? (int) $enterprise_id : 0);
    $query = $this->db->get('place');

    foreach ($query->result() as $row) {
      $res[] = $this->set_by_row_for_public($row);
    }

    return $res;
  }
  

  /*
   * 
   * Создание модели для api по значению из базы данных
   * 
   * Пример:
   * foreach($query->result() as $row){
   *    $this->set_by_row_for_public( $row );
   * }
   * 
   * @return Place_model
   * 
   */
  public function set_by_row_for_public($row = NULL) {
    $place = new $this;
    
    if (!$row) {
      return $place;
    }
    if (!is_object($row)) {
      if (!count($row) || !is_array($row)) {
        return $place;
      }
      $row = $row[0];
    }    
    foreach (array('id', 'place_id', 'title', 'placetype_id',"lft" , "rgt") as $property) {            
      if (property_exists($row, $property)) {        
        switch ($property) {
          case 'id':
          $place->id = (int) $row->id;
          break;
          case 'place_id':
          $place->place_id = (int) $row->place_id;
          break;
          case 'title':
          $place->title = $row->title;
          break;
          case 'placetype_id':
          $place->type = (int) $row->placetype_id;
          break;
          case 'lft':
          $place->lft = (int) $row->lft;
          break;
          case 'rgt':
          $place->rgt = (int) $row->rgt;
          break;
        }        
      }        
    }
    return $place;
  }
  

  /*
   * 
   * Метод получает модель мест, с фильтром по полю interprise
   * 
   * @param int userId
   * 
   * @return array
   * 
   */
  public function GetPlacesByInterprise($enterprise_id = 0) {
    
    $this->db->where('enterprise_id', $enterprise_id ? (int) $enterprise_id : 0);
    $query = $this->db->get('place');
    $res = array();
    foreach ($query->result() as $row) {
      $res[] = $this->set_by_row_for_public($row);
    }
    return $res;
  }
  

  /*
   * 
   * Метод получает моедль дочерних мест привязанных к объекту,
   * id которого передается как аргумент
   * 
   * @param int parentId
   * 
   * @return array
   * 
   */
  public function GetPlaceChild($parentId = 0) {
    
    $this->db->select('id, place_id, title, placetype_id');
    $this->db->where('place_id', $parentId ? (int) $parentId : 0);
    $query = $this->db->get('place');
    $res = array();
    foreach ($query->result() as $row) {
      $res[] = $this->set_by_row_for_public($row);
    }
    return $res;
  }
  

  public function AddByArray($data = array()) {


    // Сначала создаем предприятие

    $this->load->model("enterprise_model");
    if( !isset( $data['enterprise_id'] ) ){
      $enterprise = $this->enterprise_model->add_empty();
    }else{
      $enterprise = $this->enterprise_model->get_by_id($data['enterprise_id'] );
    }

    $lft = 0;
    $rgt = 0;

    $res = $this->db->get("place");
    if( !$res->num_rows() ){
      $lft = 1;
      $rgt = 2;
    }
    if (!$this->db->insert('place', array(
      'title' => isset( $data['title'] ) ? $data['title'] : "",
      'placetype_id' => isset( $data['type'] ) ? $data['type'] : "",
      'place_id' => isset( $data['place_id'] ) ? $data['place_id'] : 0,
      'enterprise_id' => $enterprise->id,
      'lft' => $lft,
      'rgt' => $rgt,
    ))) {
      return new $this;
    }

    $place = $this->place_model->GetPlaceById($this->db->insert_id());
    
    $this->db->select("rgt,lft");
    $this->db->where("id" , $place->place_id);
    $this->db->limit(1);
    $res = $this->db->get("place");

    if( !( $place_parent = $res->row()) ){
      return $place;
    }

    $rgt = $place_parent->rgt;
    $lft = $place_parent->rgt;

    if( $place->place_id ){

      $this->db->set('rgt', 'rgt+2', FALSE);
      $this->db->where('rgt >=', $rgt);
      $this->db->where('lft <', $rgt);
      $this->db->update('place');

      $this->db->set('lft', 'lft+2', FALSE);
      $this->db->set('rgt', 'rgt+2', FALSE);
      $this->db->where('lft >', $rgt);
      $this->db->update('place');

      // У самоего элемента вставляем lft как rgt а rgt как rgt + 1
      $this->db->where('id', $place->id);
      $this->db->update('place', array(
        'rgt' => $rgt+1,
        'lft' => $rgt
      ));
    }

    return $place;
  }
  
  
  /*
   * 
   * Метод редактирует данные в таблице place.
   * Обновляемые данные берутся из массива,
   * который передается в качестве аргумента.
   * Возвращает модель с учетом изменений.
   * 
   * @param array placeData
   * 
   * @return Place_model
   * 
   */
  public function UpdateByArray($data = array()) {
    $this->db->where('id', $this->id);
    $this->db->update('place', array(
      'title' => isset( $data['title'] ) ? $data['title'] : "",
      'placetype_id' => isset( $data['type'] ) ? $data['type'] : "",
      'place_id' => isset( $data['place_id'] ) ? $data['place_id'] : 0,
    ));

    $place = $this->place_model->GetPlaceById($this->id);

    return $place;
  }


  
  public function Delete($id = 0) {
    

    $this->db->where('place_id', $id ? (int) $id : 0);
    if ($this->db->count_all_results('place')) {
      return false;
    }

    $this->db->where('place_id', $id);
    if ($this->db->count_all_results('meterplace')) {
      return false;
    }


    $this->db->select('lft, rgt');
    $this->db->where('id', $id);
    $query = $this->db->get('place');
    if( !$query->num_rows() ){
      return false;
    }
    $query = $this->db->get('place');
    $res = $query->row();
    
    $this->load->model('enterprise_model');
    $enterprise = $this->enterprise_model->get_by_id( $res->enterprise_id );
    $enterprise->Delete();

    $lft = $res->lft;
    $rgt = $res->rgt;
    
    $range = $rgt - $lft + 1;
    
    //удаление узла
    $this->db->where('id', $id);
    $res_delete = $this->db->delete('place');
    
    
    //обновление родит.ветки
    $this->db->where('lft <', $lft);
    $this->db->where('rgt >', $rgt);
    $this->db->set('rgt', "rgt-{$range}", FALSE);
    $this->db->update('place');
    
    
    //обновление след. эл-тов
    $this->db->where('lft >', $rgt);
    $this->db->set('lft', "lft-{$range}", FALSE);
    $this->db->set('rgt', "rgt-{$range}", FALSE);
    $this->db->update('place');
    return $res_delete;
  }
  

  function GetCountChildMetersAll(){
    $this->db->select('count(*) as count');
    $this->db->from('place');
    $this->db->join('meterplace', 'place.id = meterplace.place_id');
    $this->db->join('meter', 'meterplace.meter_id = meter.id');
    $this->db->where('place.id', $this->id);
    $this->db->where('meter.enterprise_id', $this->user_model->GetMy()->enterprise_id);
    $this->db->where('place.enterprise_id', $this->user_model->GetMy()->enterprise_id);
    $query = $this->db->get();
    return (int) $query->result()[0]->count;
  }


  function GetExcludedCountAll(){
    $this->db->select('count(*) as count');
    $this->db->from('place');
    $this->db->join('meterplace', 'place.id = meterplace.place_id');
    $this->db->join('meter', 'meterplace.meter_id = meter.id');
    $this->db->where('place.id', $this->id);
    $this->db->where('meter.enterprise_id', $this->user_model->GetMy()->enterprise_id);
    $this->db->where('place.enterprise_id', $this->user_model->GetMy()->enterprise_id);
    $this->db->where('meter.is_excluded', 1);
    $query = $this->db->get();
    return (int) $query->result()[0]->count;
  }
  

  function GetNotOkCountAll(){
    $this->db->select('count(*) as count');
    $this->db->from('place');
    $this->db->join('meterplace', 'place.id = meterplace.place_id');
    $this->db->join('meter', 'meterplace.meter_id = meter.id');
    $this->db->where('place.id', $this->id);
    $this->db->where('meter.enterprise_id', $this->user_model->GetMy()->enterprise_id);
    $this->db->where('place.enterprise_id', $this->user_model->GetMy()->enterprise_id);
    $this->db->where('meter.is_ok', 0);
    $query = $this->db->get();
    return (int) $query->result()[0]->count;
  }



  function GetCountChildAll(){
    $this->db->where('lft >', $this->lft);
    $this->db->where('rgt <', $this->rgt);
    $query = $this->db->get("place");
    return $query->num_rows();
  }
  
}
