var PLACE_H1_VIEW = Backbone.View.extend({
  
  el : "#h1" , 

  initialize : function( model_ ){

    this.model = model_
    this.listenTo( this.model , "sync" , this.render )
    this.render()

  },

  render : function(){
    $(this.$el).text( this.model.get('title') )
  }

})