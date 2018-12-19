var CONVERTER_MAIN_INFO_VIEW = Backbone.View.extend({

  el : "#converter_main_info",

  template : "#converter_main_info_tpl",

  model : new CONVERTER_MODEL,

  initialize : function( model_ , collection_types_){
    this.model = model_
    this.collection = collection_types_
    this.listenTo( this.model , "sync" , this.render )
    this.render()
  },

  render : function(){
    var tpl_c = _.template( $(this.template).html() )
    $(this.$el).empty().append( tpl_c({ converter : this.model }) )
  },


  events : {
    "click #edit_main_info" : function(){
      new CONVERTER_MODAL_EDIT_VIEW( this.model , null , this.collection );
    }
  }

})