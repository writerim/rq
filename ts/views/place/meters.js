var PLACE_METERS_VIEW = Backbone.View.extend({
  
  el : "#meters",

  template : "#meters_tpl",

  initialize : function(){

    this.render()

  },

  render : function(){
    var tpl_c = _.template( $(this.template).html() )
    $(this.$el).empty().append( tpl_c({}) )
  }

})