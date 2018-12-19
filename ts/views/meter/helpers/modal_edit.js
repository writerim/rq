var METER_EDIT_VIEW = Backbone.View.extend({

  template : "#meter_modeal_edit_tpl",

  model : new METER_MODEL,

  initialize : function( parent_model_ , meter_model , collection_devices_ , meter_types_ ){
    this.model = meter_model
    this.parent = parent_model_
    this.collection  = meter_types_
    this.collection_devices  = collection_devices_

    this.render()
  },

  render : function(){

    var tpl_c = _.template( $(this.template).html() )
    this.$el = $( tpl_c({

      model : this.model,
      parent : this.parent,
      types : this.collection

    }) ).modal('show')

  }

})