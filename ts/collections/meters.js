var METER_COLLECTION = Backbone.Collection.extend({

  model : METER_MODEL,

  converter : 0,

  parse : function(a){
        this.total = a.total
        this.page = a.page
        this.view_by = a.view_by          
        return a.items
    },

  url : function(){
    return base_url + "api/devices/?device_id=" + this.converter
  }

})