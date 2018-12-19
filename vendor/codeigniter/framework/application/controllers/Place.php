<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place extends CI_Controller {
  
  public function index($id = NULL){

    $this->load->model("place_model");

    if(!$this->user_model->IsAuth()){
      header('Location: '.base_url().'auth/');
    }
    if( is_null($id) ){
      $id = $this->place_model->get_id_main_place();
    }

    $place = $this->place_model->GetPlaceById( $id );

    if( !$place->id && $id ){
      show_404();
    }

    $this->smarty->assign("place" , $place );  
    $this->smarty->display("place/index.tpl");  
  }
  
}