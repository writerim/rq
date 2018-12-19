<?php 

class User_model extends CI_Model {

  public $id = 0;
  
  public $login = "";
  
  public $pass = "";
  
  public $enterprise_id = 0;


  private $_my = null;
  private $language = "russian";

  function __construct(){
    parent::__construct();
    $this->_my = $this->GetMyModel();
    $this->lang->load('main_lang', $this->_my->language);
    $this->smarty->assign('lang', $this->lang);
    $this->smarty->assign('self', $this->GetMy());
  }


  function GetMy(){
    return $this->_my;
  }

  
/*
 * 
 * Если пара логин-пароль пустые, проверка на авторизацию,
 * Если не пустые, то авторизация пользователя
 * и возвращение результатов авторизации
 *  
 * @param string login 
 * @param string pass
 * 
 * @return bool
 * 
 */
public function Auth($login = NULL, $pass = NULL){

  if(empty($login) || empty($pass)){


    $user_id = $this->session->user_id;
    $this->db->where('id', $user_id);
    $query = $this->db->get('user');
    // должен иметь как минимум 
    // логин
    // пароль
    // существующее предприятие
    if( $query->num_rows() == 0 ){
      return false;
    }
    $row = $query->result()[0];
    $this->db->where('id' , $row->enterprise_id);
    $query_enterprise = $this->db->get('enterprise');
    if( $query_enterprise->num_rows() == 0 ){
      return false;
    }
    return true;
  }
  
  $this->db->where('login', $login);
  $this->db->where('pass', md5(md5($pass)));
  $query = $this->db->get('user');    
  $row = $query->result();  
  if(empty($row)){      
    return false;
  }    
  $user = new $this;
  $user->id = $row[0]->id;
  $user->login = $row[0]->login;
  $user->pass = $row[0]->pass;    
  $this->session->set_userdata('user_id', $user->id);
  return true;      
}


  /*
   * 
   * Проверка авторизации пользователя
   * 
   * @return bool
   * 
   */
  public function IsAuth(){
    return $this->Auth(NULL, NULL);
  }
  
  
  /*
   * 
   * Получение списка пользователей привязанных к предприятию
   * 
   * @param int userenterprise_id
   * 
   * @return array
   * 
   */
  public function GetUserenterprise_id($userenterprise_id = 0){
    $res = array();
    if(!$userenterprise_id){
      return $res;
    }
    
    $this->db->select('id, login, enterprise_id');
    $this->db->where('enterprise_id', $userenterprise_id ? (int) $userenterprise_id : 0);
    $query = $this->db->get('user');
    foreach ($query->result() as $row){       
      $user = new $this;
      $user->id = $row->id;
      $user->login = $row->login;
      $user->enterprise_id = $row->enterprise_id;
      $res[] = $user;      
    }
    return $res;     
  }
  
  
  /*
   * 
   * Метод возвращает список всех мест в предприятии пользователя
   * 
   * @return arary
   * 
   */
  public function GetAllPlaces(){  
    $this->load->model('place_model');
    return $this->place_model->GetByenterprise_id($this->enterprise_id);   
  } 
  
  
  /*
   * 
   * метод возвращает пользователя по id
   * 
   * @param int id
   * 
   */
  public function GetUserById($id = 0){
    
    $this->db->select('id, login, pass, enterprise_id');
    $this->db->where('id', $id ? (int) $id : 0);
    $query = $this->db->get('user');
    $row = $query->result();
    $user = clone($this);
    if(!empty($row)){
     $row = $row[0];       
     $user->id = $row->id;
     $user->login = $row->login;
     $user->pass = $row->pass;
     $user->enterprise_id = $row->enterprise_id;
   }
   return $user;
 }


  /*
   * 
   * Метод возвращает модель авторизованного пользователя
   * 
   * @return 
   * 
   */
  public function GetMyModel(){    
    return $this->GetUserById($this->session->user_id);
    
  }
  
  
  /*
   * 
   * Метод для получения предприятия пользователя по его идентификатору
   * 
   * @param int userId
   * 
   * @return int
   * 
   */
  public function GetUserenterprise_idById($userId = 0){
    
    $this->db->select('enterprise_id');
    $this->db->where('id', $userId ? (int) $userId : 0);
    $query = $this->db->get('user');
    $row = $query->result();
    $user = new $this;
    if(!empty($row)){
     $row = $row[0];       
     $user->enterprise_id = $row->enterprise_id;
   } 
   return $user->enterprise_id;
 }


  /*
   * 
   * Меотд получает все места пользователя
   * 
   * @return array
   * 
   */
  public function GetMyPlaces(){
    $this->load->model('place_model');
    return $this->place_model->GetPlacesByenterprise_id($this->enterprise_id);
  }



  function get_users_resource(){
    $this->db->where('enterprise_id' , $this->enterprise_id);
    return $this->db->get("user");
  }


  function get_users(){
    $res = array();
    $query = $this->get_users_resource();
    foreach ($query->result() as $row){       
      $user = new $this;
      $user->id = $row->id;
      $user->login = $row->login;
      $user->enterprise_id = $row->enterprise_id;
      $res[] = $user;      
    }
    return $res;  
  }

}