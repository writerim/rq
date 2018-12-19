<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function index() {

    if($this->user_model->IsAuth()){
      header('Location: '.base_url().'place/');
    }

    $login = $this->input->post('login');
    $password = $this->input->post('password');

    $this->smarty->assign("valid" , true);

    if( !$login && !$password ){
      $this->smarty->display("auth.tpl");
    }elseif( $this->user_model->Auth( $login , $password ) ){
      header('Location: ' . base_url() . 'place/');
    }else{
      $this->smarty->assign("valid" , false);
      $this->smarty->display("auth.tpl");
    }

  }
}