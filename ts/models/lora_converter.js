/*
 * Модель LoRaWan базовой станции
 */
var LORA_CONVERTER = Backbone.Model.extend({
  
  // Смогли соединится или нет с БС
  is_socket_connect: false,
  
  // Смогли акторизоваться на БС?
  is_socket_auth: false,
  
  // Токен авторизации
  token: "",
  
  // Соединение
  socket: null,
  
  // Статус БД активности ( хз что это, но приходит и меняется )
  active: false,
  
  
  defaults: {
    id: 0,
    about: "",
    ip: "",
    port: 0,
    type: 0,
    login: "",
    pass: ""
  },
  
  url: function () {
    return "/api/lora/" + this.get('id') + "/";
  },
  
  // Получение всех устройств на БС
  __get_devices: function () {
    return this.socket.send(JSON.stringify({
      cmd   : "get_devices_req",
      token : this.token
    }));
  },
  
  // Получение всех БС
  __get_gataways: function () {
    return this.socket.send(JSON.stringify({
      cmd   : "get_gateways_req",
      token : this.token
    }));
  },
  
  
  /*
   * 
   * Получение всех приборов на БС
   */
  get_all_devices: function () {
    this.socket.send( this.__all_devices() );
  },
  
  
  /*
   * Удаление прибора
   * 
   * @param {Backbone.Model}
   */
  delete_device: function ( model ) {
    this.socket.send( this.__delete_device( model ) );
  },
  
  /*
   * Сохранение типа прибора
   * 
   * @param {Backbone.Model}
   */
  save_app_devices: function (model) {
    this.socket.send( this.__dave_type_device( model ) );
  },
  

  /*
   * Сохранение прибора
   * 
   * @param {Backbone.Model}
   */
  save_counter: function (model) {
    if ( model.get('id') === 0 || model.get('lora_model').get('devEui') === "") {
      this.socket.send( this.__add_device( model ) );
    } else {
      this.socket.send( this.__update_device( model ) );
    }
  },
  
  
  /*
   * Генерация команды для добавления устройства
   * 
   * @param {Backbone.Model}
   * @return {String}
   */
  __add_device : function( model ){
    return JSON.stringify({
      cmd           : "manage_devices_req",
      devices_list  : [ model.get('lora_model').toJSON() ],
      token         : this.token
    });
  },
  
  
  /*
   * Генерация команды для редактирования устройства
   * @param {Backbone.Model}
   * @return {String}
   */
  __update_device : function( model ){
    return JSON.stringify({
        cmd : "manage_devices_req",
        devices_list: [{
            devEui    : model.get('lora_model').get('devEui'),
            devName   : model.get('lora_model').get('devName'),
            class     : model.get('lora_model').get('class')
          }],
        token: this.token
      });
  },
  
  /*
   * Генерация команды для редактирования типа устройства
   * @param {Backbone.Model}
   * @return {String}
   */
  __dave_type_device : function( model ){
    return JSON.stringify({
      cmd: "manage_device_appdata_req",
      data_list: [{
          devEui      : model.get('lora_model').get('devEui'),
          device_type : String(model.get('lora_model').get('device_type'))
        }],
      token : this.token
    });
  },
  
  
  /*
   * Генерация команды для удаления устройства
   * @param {Backbone.Model}
   * @return {String}
   */
  __delete_device : function(){
    return JSON.stringify({
      cmd : "delete_device_appdata_req",
      data_list: [{
          devEui: model.get('lora_model').get('devEui')
        }],
      token: this.token
    });
  },
  
  
  /*
   * Генерация команды для получения всех устройств на БС
   * 
   * @return {String}
   */
  __all_devices : function(){
    return JSON.stringify({
      cmd   : "get_device_appdata_req",
      token : this.token
    });
  }
});