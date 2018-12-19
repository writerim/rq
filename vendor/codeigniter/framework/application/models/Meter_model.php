<?php

class Meter_model extends CI_Model {
  
  public $id = 0;
  public $about = '';
  public $converter_id = 0;
  public $type = 0;
  public $num_485 = 0;
  public $num_serial = "";
  public $password = "";
  public $coef = 0;
  public $timezone_id = 0;
  public $is_excluded = 0;
  public $is_ok = 0;  
  public $model_id = 0;

  // По какому интерфейсу подключается
  // lorawan
  // rs485
  // smtp
  public $interface = 0;

  // К какой группе относится
  // электро
  // водо
  // тепло
  // какой то другой
  public $group_id = 0;

  protected $enterprise_id = 0;
  

  /*
   * 
   * Создание модели для api из базы данных
   * 
   * @param str row
   * 
   * @return object
   * 
   */
  public function SetByRowForPublic($row = NULL){
    $meter = new $this;
    if (!$row) {
      return $meter;
    }
    if (!is_object($row)) {
      if (!count($row) || !is_array($row)) {
        return $meter;
      }
      $row = $row[0];
    }
    foreach (array('id', 'about', 'converter_id', 'type_id') as $property) {
      if (property_exists($row, $property)){
        switch ($property){
          case 'id':
            $meter->id = (int) $row->id;
            break;
          case 'about':
            $meter->about = $row->about;
            break;
          case 'converter_id':
            $meter->converter_id = (int) $row->converter_id;
            break;
          case 'type':
            $meter->type = (int) $row->type_id;
            break;
        }
      }
    }
    return $meter;
  }
    

  public function GetMeterById($meterId = 0){
    $this->db->where('id', $meterId ? (int) $meterId : 0);
    $query = $this->db->get('meter', 1);
    $row = $query->result();
    return $this->SetByRowForPublic($row);
  }
  

  public function GetAll() {
    $query = $this->db->get('meter');
    $res = array();
    foreach ($query->result() as $row) {
      $res[] = $this->SetByRowForPublic($row);
    }
    return $res;
  }
  
  /*
   * 
   * Метод добавляет данные в таблицу meter.
   * Данные берутся из массива передаваемого в качестве аргумента
   * Возвращает модель добавленого прибора
   * 
   * @param array meterData
   * 
   * @return object
   * 
   */
  public function AddByArray($meterData = array()){
    if(!$this->db->insert('meter', $meterData)){
      return new $this;
    }
    return $this->meter_model->GetMeterById($this->db->insert($meterData));
  }
  
  /*
   * 
   * Метод редактирует данные в таблице meter.
   * Обновляемые данные берутся из массива, 
   * передаваемого в качестве аргумента.
   * Возвращает модель прибора с учетом изменений.
   * 
   * @param array meterData
   * 
   * @return object
   * 
   */
  public function UpdateByArray($meterData = array()){
    $this->db->where('id', $meterData['id'] ? (int) $meterData['id'] : 0);
    $this->db->update('converter', $converterData);
    return $this->meter_model->GetMeterById($meterData['id']);
  }
  
  /*
   * 
   * Метод обнуляет поле converter_id
   * и устанавливает в 1 is_excluded
   * 
   * @param int id
   * 
   * @return bool
   * 
   */
  public function Delete($id = 0){
    $meter = array(
         'converter_id' => 0,
         'is_excluded' => 1         
    );
    $this->db->where('id', $id ? (int) $id : 0);
    $this->db->update('meter', $meter);
  }

}