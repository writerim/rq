<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Converter extends CI_Controller {

   public function __construct(){
    parent::__construct();
    $this->load->model('converter_model');
  }
  
  public function index() {
    if(!$this->user_model->IsAuth()){
      header('Location: '.base_url().'auth/');
    }
    $this->smarty->display("converter/index.tpl");
  }




  
  public function id($id = NULL){   

    if(!$this->user_model->IsAuth()){
      header('Location: '.base_url().'auth/');
    }

    $converter = $this->converter_model->GetConverterById( $id );

    if( !$converter->id ){
      show_404();
    }

    $this->smarty->assign('converter', $converter);
    if(isset($id)){
      $this->smarty->display("converter/converter.tpl");
    }
  }
  
  public function ping($id = NULL){
    if(!$this->user_model->IsAuth()){
      header('Location: '.base_url().'auth/');
    }
    $ip =  $_POST['ip'];    
    $port =  $_POST['port'];
    if ( PHP_OS == 'WINNT' ){      
       echo "error";
    } else {
      echo exec("nc -w 1 $ip $port || echo 'error'");
    }    
  }
}