<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {


  public function place($placeId = NULL, $subMethod = NULL) {

    header('Content-Type: application/json');

    $this->load->model('place_model');

    if (is_null($placeId)) {

      echo json_encode($this->place_model, JSON_UNESCAPED_UNICODE);

    } else {

      if ($subMethod) {
        $error = array();
        switch ($subMethod) {
          case "child":


          if( $placeId == 0 ){
            $place = $this->place_model->get_first_interprise();
          }else{
            $place = $this->place_model->GetPlaceById($placeId);
          }

          $total = $place->get_children_count();

          $page     = !$this->input->get('page') ? 1 : $this->input->get('page');
          $view_by  = !$this->input->get('view_by') ? 15 : $this->input->get('view_by');

          if ($page > ceil($total / $view_by)) {
            $page = ceil($total / $view_by);
          }

          if( !$total ){
            $page = 1;
          }

          $offset = ($page - 1) * $view_by;
          $dbQuery = $place->get_children($offset, $view_by);


          foreach( $dbQuery as $iplace ){
            $iplace->meters_all       = (int) $iplace->GetCountChildMetersAll();
            $iplace->meters_excluded  = (int) $iplace->GetExcludedCountAll();
            $iplace->meters_error     = (int) $iplace->GetNotOkCountAll();
            $iplace->places_all       = (int) $iplace->GetCountChildAll();
          }

          if(!$this->user_model->IsAuth()){
            $error[] = "invalid auth";
          }
          break;
          case "parents":
          $page = 1;
          $place = $this->place_model->GetPlaceById( $placeId );
          $total = $place->get_parent_count();
          $view_by = $total;
          $dbQuery = $place->get_parents();
          foreach( $dbQuery as $iplace ){
            $iplace->meters_all       = (int) $iplace->GetCountChildMetersAll();
            $iplace->meters_excluded  = (int) $iplace->GetExcludedCountAll();
            $iplace->meters_error     = (int) $iplace->GetNotOkCountAll();
            $iplace->places_all       = (int) $iplace->GetCountChildAll();
          }
          break;
        }

        echo json_encode(array(
          "errors"  => $error,
          "total"   => (int) $total,
          "page"    => (int) $page,
          "view_by" => (int) $view_by,
          "items"   => $dbQuery
        ), JSON_UNESCAPED_UNICODE);
      } else {
        if( $placeId == 0 ){
          $place = $this->place_model->get_first_interprise();
        }else{
          $place = $this->place_model->GetPlaceById($placeId);
        }

        if( $this->input->post("_method") ){
          switch ( $this->input->post("_method") ) {
            case "PUT":
            $data = (array) json_decode($this->input->post("model"));
            if( $data['id'] ) {
              $place = $place->UpdateByArray($data);
            } else {
              $place = $this->place_model->AddByArray($data);
            }
            break;
            case "DELETE":
            $this->place_model->Delete($placeId);
            $place = $this->place_model->GetPlaceById( $placeId );
            break;
          }

        }
        $place->meters_all       = (int) $place->GetCountChildMetersAll();
        $place->meters_excluded  = (int) $place->GetExcludedCountAll();
        $place->meters_error     = (int) $place->GetNotOkCountAll();
        $place->places_all       = (int) $place->GetCountChildAll();
        echo json_encode($place, JSON_UNESCAPED_UNICODE);
      }
    }
  }

  /*
   * 
   * Метод выводит модель типов мест
   * 
   */

  public function placetype() {
    header('Content-Type: application/json');
    $this->load->model('placetype_model');
    $dbQuery = $this->placetype_model->get_all();
    echo json_encode(array(
      "errors: " => array(),
      "total" => count(),
      "page" => 0,
      "view_by" => 0,
      "items" => $dbQuery
    ), JSON_UNESCAPED_UNICODE);
  }

  /*
   * 
   * Метод выводит модель типов конвертеров
   * 
   */

  public function convertertypes() {
    header('Content-Type: application/json');

    $this->load->model('convertertypes_model');

    $dbQuery = $this->convertertypes_model->get_all();
    echo json_encode(array(
      "errors: " => array(),
      "total" => count($dbQuery),
      "page" => 0,
      "view_by" => 0,
      "items" => $dbQuery
    ), JSON_UNESCAPED_UNICODE);
  }

  /*
   * 
   * Метод выводит модель типов счетчиков
   * 
   */

  public function metertype() {
    header('Content-Type: application/json');
    $this->load->model('metertype_model');
    $dbQuery = $this->metertype_model->get_all();
    echo json_encode(array(
      "errors: " => array(),
      "total" => count($dbQuery),
      "page" => 0,
      "view_by" => 0,
      "items" => $dbQuery
    ), JSON_UNESCAPED_UNICODE);
  }

  /*
   * 
   * Метод выводит модель часовых поясов
   * 
   */

  public function timezone() {
    header('Content-Type: application/json');
    $this->load->model('timezone_model');
    $dbQuery = $this->timezone_model->get_all();
    echo json_encode(array(
      "errors: " => array(),
      "total" => count(),
      "page" => 0,
      "view_by" => 0,
      "items" => $dbQuery
    ), JSON_UNESCAPED_UNICODE);
  }

  /*
   * 
   * Метод выводит:
   * модель пользователя, если передан 1 аргумент,
   * модель мест которые находятся в том же предприятии, что и пользователь,
   * если вторым аргументом передано place
   * 
   * @param int userId
   * @param string $object
   * 
   * 
   */

  public function user($userId = 0, $object = NULL) {
    if (isset($userId)) {
      switch ($object) {
        case 'place':
        header('Content-Type: application/json');
        $this->load->model('user_model');
        $user = $this->user_model->GetUserById($userId);
        $dbQuery = $user->GetMyPlaces();
        $res = array();
        foreach ($dbQuery as $placeModel) {
          $res[] = array(
            "id" => $placeModel->id,
            "meters_all" => $placeModel->GetCountAllChildPlacesMeters()
          );
        }
        var_dump($res);
        echo json_encode(array(
          "errors: " => array(),
          "total" => count($dbQuery),
          "page" => 0,
          "view_by" => 0,
          "items" => $dbQuery
        ), JSON_UNESCAPED_UNICODE);
        break;
      }
    }
  }

  /*
   * 
   * Метод выводит модель конвертеров,
   * или модель 1 конвертера, если первым параметром передать его id
   * 
   */

  public function converter($converterId = NULL) {
    header('Content-Type: application/json');

    $this->load->model('converter_model');

    if (!is_null($converterId)) {

      $converter = $this->converter_model->GetConverterById($converterId);

      if (isset($_POST['_method'])) {
        switch ($_POST['_method']) {
          case "PUT":
          $data = (array) json_decode($_POST['model']);
          if ($data['id'] > 0) {
            $converter = $converter->UpdateByArray($data);
          } else {
            $converter = $this->converter_model->AddByArray($data);
          }
          break;
          case "DELETE":
          $converter = $this->converter_model->Delete($converterId);
          break;
        }
      }
      echo json_encode($converter, JSON_UNESCAPED_UNICODE);
    } else {

      $dbTotal = $this->converter_model->get_converters_resource()->num_rows();
      $page = !$this->input->get('page') ? 1 : $this->input->get('page');
      $view_by = !$this->input->get('view_by') ? 10 : $this->input->get('view_by');
      if ($page > ceil($dbTotal / $view_by)) {
        $page = ceil($dbTotal / $view_by);
      }
      if( $page == 0 ){
        $page = 1;
      }
      $offset = ($page - 1) * $view_by;
      $dbQuery = $this->converter_model->GetAll($offset, $view_by);      
      echo json_encode(array(
        "errors" => array(),
        "total" => (int) $dbTotal,
        "page" => (int) $page,
        "view_by" => (int) $view_by,
        "items" => $dbQuery
      ), JSON_UNESCAPED_UNICODE);

    }
  }




  public function users($id = NULL) {
    header('Content-Type: application/json');

    if (!is_null($id)) {


    } else {

      $dbTotal = $this->user_model->GetMy()->get_users_resource()->num_rows();
      $dbQuery = $this->user_model->GetMy()->get_users();

      echo json_encode(array(
        "errors" => array(),
        "total" => 0,
        "page" => 0,
        "view_by" => 0,
        "items" => $dbQuery
      ), JSON_UNESCAPED_UNICODE);

    }
  }


  /*
   * 
   * Метод возвращает модель приборов учета
   * или модель 1 конвертера, если первым параметрам передать его id
   *  
   */

  public function meter($meterId = NULL) {
    header('Content-Type: application/json');
    $this->load->model('meter_model');
    if (!is_null($meterId)) {
      $dbQuery = $this->meter_model->GetMeterById($meterId);
      echo json_encode($dbQuery, JSON_UNESCAPED_UNICODE);
    } else {
      $dbQuery = $this->meter_model->GetAll();
      echo json_encode(array(
        "errors" => array(),
        "total" => count($dbQuery),
        "page" => 0,
        "view_by" => 0,
        "items" => $dbQuery
      ), JSON_UNESCAPED_UNICODE);
    }
  }




  public function rules( $id = NULL ) {

      header('Content-Type: application/json');
      $this->load->model("rule_model");

    if (!is_null($id)) {

      switch( $this->input->post('_method') ){
        case "PUT" :
          if( $id ){
            $rule = $this->rule_model->UpdateByArray( (array) json_decode( $this->input->post('model') ) );
          }else{
            $rule = $this->rule_model->AddByArray( (array) json_decode( $this->input->post('model') ) );
          }
        break;
        case "DELETE" :
          $rule = $this->rule_model->delete_by_id( $id );
        break;
        default :
          $rule = $this->rule_model->get_by_id( $id );
        break;
      }
      echo json_encode((array) $rule , JSON_UNESCAPED_UNICODE);
    }else{

      $dbQuery = $this->rule_model->get_all();
      echo json_encode(array(
        "errors: " => array(),
        "total" => count($dbQuery),
        "page" => 0,
        "view_by" => 0,
        "items" => $dbQuery
      ), JSON_UNESCAPED_UNICODE);
    }
  }





  function devices(){
    $this->load->model('devices_model');
    $dbQuery = $this->devices_model->get_by_device_id( $this->input->get('device_id') );
      echo json_encode(array(
        "errors: " => array(),
        "total" => count($dbQuery),
        "page" => 0,
        "view_by" => 0,
        "items" => $dbQuery
      ), JSON_UNESCAPED_UNICODE);
  }

}
