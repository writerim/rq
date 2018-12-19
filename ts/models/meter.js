/* global Backbone */

var METER_MODEL = Backbone.Model.extend({
  
  defaults : {
    id : 0,
    coef : 0,
    converter : 0,
    interval_verification : 0,
    is_excluded : 0,
    is_ok : 0,
    model : 0,
    num_485 : 0,
    num_serial : "0",
    number_plomb : "",
    password : "",
    timezone_id : 0,
    type : 0
  },
  
  url : function(){
    return  base_url+"api/meter/" + this.get('id') + "/";
  }
  
});