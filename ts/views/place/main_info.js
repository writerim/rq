var PLACE_MAIN_INFO_VIEW = Backbone.View.extend({
  
  el: "#main_info",
  
  template: "#main_info_tpl",

  model : new PLACE_MODEL,
  
  render: function () {
    var tpl_c = _.template($(this.template).html())
    $(this.$el).empty().append(tpl_c({
      place: this.model
    }))
    this.listenTo( this.model , "change" , this.render )
  },

  initialize: function ( model_ ) {
    this.model = model_
    this.render()
  },

  events : {
    "click #edit_main_info" : function(){
      new PLACE_EDIT_MODAL( this.model , null , null )
    }
  }

});