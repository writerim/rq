<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class First_running extends CI_Controller {

  function index(){


    // Быстрое создание новых таблиц

    $this->load->dbforge();


    //////////////////////////////////////
    //          DEVICE
    //////////////////////////////////////
    

    $this->dbforge->add_field(
      array(
        'id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => true,
          'auto_increment' => true
        )
      )
    );
    $this->dbforge->add_key('id' , TRUE);
    $attrs = array('ENGINE' => 'InnoDB');
    $this->dbforge->create_table('devices' , true);


    if( !$this->db->field_exists('device_id' , 'devices') ){
      $this->dbforge->add_column('devices' , array(
        'device_id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => true,
          'default' => 0
        )));
    }
    if( !$this->db->field_exists('enterprise_id' , 'devices') ){
      $this->dbforge->add_column('devices' , array(
        'enterprise_id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => true,
          'default' => 0
        )));
    }    
    if( !$this->db->field_exists('type_id' , 'devices') ){
      $this->dbforge->add_column('devices' , array(
        'type_id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => true,
          'default' => 0
        )));
    }    
    if( !$this->db->field_exists('title' , 'devices') ){
      $this->dbforge->add_column('devices' , array(
          'title' => array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'default' => ''
          )
        )
      );
    }
    if( !$this->db->field_exists('is_excluded' , 'devices') ){
      $this->dbforge->add_column('devices' , array(
          'is_excluded' => array(
            'type' => 'TINYINT',
            'constraint' => 1,
            'unsigned' => true,
            'default' => 0
          )
        )
      );
    }
    if( !$this->db->field_exists('status' , 'devices') ){
      $this->dbforge->add_column('devices' , array(
          'status' => array(
            'type' => 'TINYINT',
            'constraint' => 1,
            'unsigned' => true,
            'default' => 1
          )
        )
      );
    }
    if( !$this->db->field_exists('timezone' , 'devices') ){
      $this->dbforge->add_column('devices' , array(
          'timezone' => array(
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'default' => 0
          )
        )
      );
    }








    //////////////////////////////////////
    //          DEVICE_TYPE
    //////////////////////////////////////
    

    $this->dbforge->add_field(
      array(
        'id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => true,
          'auto_increment' => true
        )
      )
    );
    $this->dbforge->add_key('id' , TRUE);
    $attrs = array('ENGINE' => 'InnoDB');
    $this->dbforge->create_table('device_type' , true);

    if( !$this->db->field_exists('interface' , 'device_type') ){
      $this->dbforge->add_column('device_type' , array(
          'interface' => array(
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'default' => 0
          )
        )
      );
    }
    if( !$this->db->field_exists('ident' , 'device_type') ){
      $this->dbforge->add_column('device_type' , array(
          'ident' => array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'default' => ""
          )
        )
      );
    }
    if( !$this->db->field_exists('title' , 'device_type') ){
      $this->dbforge->add_column('device_type' , array(
          'title' => array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'default' => ""
          )
        )
      );
    }

    $this->db->replace('device_type' ,
      array(
        'id' => 1,
        'interface' => 3,
        'ident' => 'SNR_ERD_PROJECT_2',
        'title' => 'SNR ERD-PROject 2',
    ) , false);

    $this->db->replace('device_type' ,
      array(
        'id' => 2,
        'interface' => 3,
        'ident' => 'SNR_ERD_4S_GSM',
        'title' => 'SNR ERD-4s GSM',
    ) , false);

    $this->db->replace('device_type' ,
      array(
        'id' => 3,
        'interface' => 3,
        'ident' => 'SNR_ERD_4S',
        'title' => 'SNR ERD-4s',
    ) , false);

    $this->db->replace('device_type' ,
      array(
        'id' => 4,
        'interface' => 3,
        'ident' => 'SNR_ERD_4c',
        'title' => 'SNR ERD-4c',
    ) , false);


    $this->db->replace('device_type' ,
      array(
        'id' => 5,
        'interface' => 3,
        'ident' => 'SNR_ERD_3c',
        'title' => 'SNR ERD-3c',
    ) , false);

    $this->db->replace('device_type' ,
      array(
        'id' => 6,
        'interface' => 3,
        'ident' => 'SNR_ERD_3s',
        'title' => 'SNR ERD-3s',
    ) , false);

    $this->db->replace('device_type' ,
      array(
        'id' => 7,
        'interface' => 3,
        'ident' => 'USR',
        'title' => 'USR',
    ) , false);    

    $this->db->replace('device_type' ,
      array(
        'id' => 8,
        'interface' => 2,
        'ident' => 'CE102M',
        'title' => 'CE102M',
    ) , false);

    $this->db->replace('device_type' ,
      array(
        'id' => 9,
        'interface' => 2,
        'ident' => 'CE102',
        'title' => 'CE102',
    ) , false);

    $this->db->replace('device_type' ,
      array(
        'id' => 10,
        'interface' => 2,
        'ident' => 'CE301',
        'title' => 'CE301',
    ) , false);

    $this->db->replace('device_type' ,
      array(
        'id' => 11,
        'interface' => 2,
        'ident' => 'CE301M',
        'title' => 'CE301M',
    ) , false);









    //////////////////////////////////////
    //          INTERFACES
    //////////////////////////////////////
    $this->dbforge->add_field(
      array(
        'id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => true,
          'auto_increment' => true
        )
      )
    );
    $this->dbforge->add_key('id' , TRUE);
    $attrs = array('ENGINE' => 'InnoDB');
    $this->dbforge->create_table('interfaces' , true);

    if( !$this->db->field_exists('ident' , 'interfaces') ){
      $this->dbforge->add_column('interfaces' , array(
          'ident' => array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'default' => ""
          )
        )
      );
    }
    if( !$this->db->field_exists('title' , 'interfaces') ){
      $this->dbforge->add_column('interfaces' , array(
          'title' => array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'default' => ""
          )
        )
      );
    }

    $this->db->replace('interfaces' ,
      array(
        'id' => 1,
        'title' => 'Водосчетчик',
        'ident' => 'Aqua',
    ) , false);

    $this->db->replace('interfaces' ,
      array(
        'id' => 2,
        'title' => 'Электросчетчик',
        'ident' => 'electro',
    ) , false);

    $this->db->replace('interfaces' ,
      array(
        'id' => 3,
        'title' => 'Конвертер интерфейсов',
        'ident' => 'converter',
    ) , false);

    $this->db->replace('interfaces' ,
      array(
        'id' => 4,
        'title' => 'Базовая станция LoRaWan',
        'ident' => 'base_station_lorawan',
    ) , false);

    $this->db->replace('interfaces' ,
      array(
        'id' => 5,
        'title' => 'Счетчик импульсов',
        'ident' => 'impuls_counter',
    ) , false);

    $this->db->replace('interfaces' ,
      array(
        'id' => 6,
        'title' => 'Счетчик импульсов + конвертер интерфесов',
        'ident' => 'impuls_counter_plus_conevrter',
    ) , false);


















    //////////////////////////////////////
    //          DEVICE_EXTRA_TYPE
    //////////////////////////////////////
    $this->dbforge->add_field(
      array(
        'id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => true,
          'auto_increment' => true
        )
      )
    );
    $this->dbforge->add_key('id' , TRUE);
    $attrs = array('ENGINE' => 'InnoDB');
    $this->dbforge->create_table('device_extra_type' , true);

    if( !$this->db->field_exists('device' , 'device_extra_type') ){
      $this->dbforge->add_column('device_extra_type' , array(
          'device' => array(
            'type' => 'INT',
            'constraint' => 11,
            'default' => 0,
            'unsigned' => true
          )
        )
      );
    }
    if( !$this->db->field_exists('extra_type' , 'device_extra_type') ){
      $this->dbforge->add_column('device_extra_type' , array(
          'extra_type' => array(
            'type' => 'INT',
            'constraint' => 11,
            'default' => 0,
            'unsigned' => true
          )
        )
      );
    }






















    //////////////////////////////////////
    //          ETRA_TYPES
    //////////////////////////////////////
    $this->dbforge->add_field(
      array(
        'id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => true,
          'auto_increment' => true
        )
      )
    );
    $this->dbforge->add_key('id' , TRUE);
    $attrs = array('ENGINE' => 'InnoDB');
    $this->dbforge->create_table('extra_types' , true);

    if( !$this->db->field_exists('ident' , 'extra_types') ){
      $this->dbforge->add_column('extra_types' , array(
          'ident' => array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'default' => 0,
            'unsigned' => true
          )
        )
      );
    }
    if( !$this->db->field_exists('title' , 'extra_types') ){
      $this->dbforge->add_column('extra_types' , array(
          'title' => array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'default' => 0,
            'unsigned' => true
          )
        )
      );
    }

    $this->db->replace('extra_types' , array(
      'id' => 1,
      'title' => "ХВС",
      'ident' => "hvs",
     ) , false);

    $this->db->replace('extra_types' , array(
      'id' => 2,
      'title' => "ГВС",
      'ident' => "gvs",
     ) , false);















    //////////////////////////////////////
    //          FIELDS_FOR_DEVICES
    //////////////////////////////////////

    $this->dbforge->add_field(
      array(
        'id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => true,
          'auto_increment' => true
        )
      )
    );
    $this->dbforge->add_key('id' , TRUE);
    $attrs = array('ENGINE' => 'InnoDB');
    $this->dbforge->create_table('fields_for_devices' , true);

    if( !$this->db->field_exists('ident' , 'fields_for_devices') ){
      $this->dbforge->add_column('fields_for_devices' , array(
          'ident' => array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'default' => 0,
            'unsigned' => true
          )
        )
      );
    }
    if( !$this->db->field_exists('interface' , 'fields_for_devices') ){
      $this->dbforge->add_column('fields_for_devices' , array(
          'interface' => array(
            'type' => 'INT',
            'constraint' => 11,
            'default' => 0,
            'unsigned' => true
          )
        )
      );
    }    
    if( !$this->db->field_exists('is_int' , 'fields_for_devices') ){
      $this->dbforge->add_column('fields_for_devices' , array(
          'is_int' => array(
            'type' => 'TINYINT',
            'constraint' => 1,
            'default' => 0,
            'unsigned' => true
          )
        )
      );
    }

    $this->db->replace('fields_for_devices' , array(
      'id' => 1,
      'ident' => "ip",
      'interface' => 3,
      'is_int' => 0,
     ) , false);

    $this->db->replace('fields_for_devices' , array(
      'id' => 2,
      'ident' => "port",
      'interface' => 3,
      'is_int' => 0,
     ) , false);

    $this->db->replace('fields_for_devices' , array(
      'id' => 3,
      'ident' => "login",
      'interface' => 3,
      'is_int' => 0,
     ) , false);

    $this->db->replace('fields_for_devices' , array(
      'id' => 4,
      'ident' => "password",
      'interface' => 3,
      'is_int' => 0,
     ) , false);


    $this->db->replace('fields_for_devices' , array(
      'id' => 5,
      'ident' => "num_serial",
      'interface' => 2,
      'is_int' => 0,
     ) , false);

    $this->db->replace('fields_for_devices' , array(
      'id' => 6,
      'ident' => "num_485",
      'interface' => 2,
      'is_int' => 1,
     ) , false);

    $this->db->replace('fields_for_devices' , array(
      'id' => 7,
      'ident' => "password",
      'interface' => 2,
      'is_int' => 0,
     ) , false);

    $this->db->replace('fields_for_devices' , array(
      'id' => 8,
      'ident' => "timeout_connect",
      'interface' => 3,
      'is_int' => 0,
     ) , false);

    $this->db->replace('fields_for_devices' , array(
      'id' => 9,
      'ident' => "timeout_receive",
      'interface' => 3,
      'is_int' => 0,
     ) , false);













    //////////////////////////////////////
    //          FIELDS_DEVICES
    //////////////////////////////////////
    $this->dbforge->add_field(
      array(
        'id' => array(
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => true,
          'auto_increment' => true
        )
      )
    );
    $this->dbforge->add_key('id' , TRUE);
    $attrs = array('ENGINE' => 'InnoDB');
    $this->dbforge->create_table('fields_device' , true);



    if( !$this->db->field_exists('device' , 'fields_device') ){
      $this->dbforge->add_column('fields_device' , array(
          'device' => array(
            'type' => 'INT',
            'constraint' => 11,
            'default' => 0,
            'unsigned' => true
          )
        )
      );
    }
    if( !$this->db->field_exists('value' , 'fields_device') ){
      $this->dbforge->add_column('fields_device' , array(
          'value' => array(
            'type' => 'VARCHAR',
            'constraint' => 255,
            'default' => "",
            'unsigned' => true
          )
        )
      );
    }    
    if( !$this->db->field_exists('field' , 'fields_device') ){
      $this->dbforge->add_column('fields_device' , array(
          'field' => array(
            'type' => 'INT',
            'constraint' => 11,
            'default' => 0,
            'unsigned' => true
          )
        )
      );
    }



  }

}