var USER_LIST_VIEW = Backbone.View.extend({

  el : "#user_list",

  template  :"#user_list_tpl" , 

  collection : new USER_COLLECTION,

  initialize : function( collection_ ){
    this.collection = collection_
    this.listenTo( this.collection , "sync" , this.render )
    this.render()
  },


  render : function(){

    var tpl_c = _.template( $(this.template).html() )

    $(this.$el).empty().append( tpl_c({ users : this.collection }) )

  }

})