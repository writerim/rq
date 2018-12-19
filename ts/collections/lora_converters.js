/*
 * 
 * Коллекция содержит все Базовые станции
 * 
 * 
 */
var LORA_CONVERTERS = Backbone.Collection.extend({
  
  model : LORA_CONVERTER,
  
  socket : null,
  
  url : "/api/lora/"
  
//  
//  
//  fetch : function(){
//    if( this.socket !== null ){
//      this.socket.send(JSON.stringify({
//        cmd   : "get_gateways_req",
//        token : this.token
//      }));
//    }
//  }
  
})