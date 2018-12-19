<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

  public function index() {

    if(!$this->user_model->IsAuth()){
      header('Location: '.base_url().'place/');
    }

    $this->smarty->display("users/index.tpl"); 

  }
}