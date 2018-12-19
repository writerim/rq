var LIST_DEVICES_VIEW = Backbone.View.extend({

  el : "#converter_list_devices",

  template : "#converter_list_devices_tpl",

  model : new CONVERTER_MODEL,

  collection : new METER_COLLECTION,

  collection_types : new METER_TYPES_COLLECTION,

  initialize : function( model_ , collection_meters_ , device_types_ ){
    this.model = model_
    this.collection = collection_meters_
    this.collection_types = device_types_
    this.listenTo( this.collection , "sync" , this.render )
    this.render()
  },

  render : function(){

    var tpl_c = _.template( $(this.template).html() )
    $(this.$el).empty().append( tpl_c({

      devices : this.collection

    }) )

  },

  events : {
    "click #add_device" : function( e ){
      new METER_EDIT_VIEW( this.model , new METER_MODEL , this.collection , this.collection_types )
    }
  }

})