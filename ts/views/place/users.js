var PLACE_USERS_VIEW = Backbone.View.extend({
  
  el : "#users",

  template : "#users_tpl",

  initialize : function(){

    this.render()

  },

  render : function(){
    var tpl_c = _.template( $(this.template).html() )
    $(this.$el).empty().append( tpl_c({}) )
  }

})