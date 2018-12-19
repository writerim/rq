var PLACE_BREADCRUMB_VIEW = Backbone.View.extend({

  el : ".breadcrumb" , 

  template : "#breadcrumb_tpl",

  collection : new PLACE_COLLECTION,


  initialize : function( model_ ){
    this.model = model_

    var self = this

    this.listenTo( this.collection , "sync" , this.render )
    this.listenTo( this.model , "sync" , this.render )

    this.collection.fetch({ url : this.model.url() + "/parents" })

    this.render()

  },

  render : function(){

    var breadcrumb_ = _.clone( breadcrumb )

    _.each( this.collection.toArray() , function( place_ ){
      breadcrumb_.push( {
        "name" : place_.get('title'),
        "link" : base_url +"place/" + place_.get('id') ,
        "icon" : place_.get_icon() ,
      } )
    })
    breadcrumb_.push( {
        "name" : this.model.get('title'),
        "link" : "" ,
        "icon" : this.model.get_icon() ,
      } )

    var tpl_c = _.template( $(this.template).html() )
    $(this.$el).empty().append( tpl_c({ breadcrumb_ : breadcrumb_ }) )

  }

})