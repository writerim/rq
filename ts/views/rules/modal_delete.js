var RULE_MODAL_DELETE_VIEW = Backbone.View.extend({
  
  model : new RULE_MODEL,

  template : "#rule_modal_delete_tpl",

  collection : new RULE_COLLECTION,

  initialize : function( model_ , collection_ ){

    this.model = model_
    this.collection = collection_

    this.render()

  },

  render : function(){
    
    var tpl_c = _.template( $(this.template).html() )

    this.$el = $( tpl_c({ place : this.model }) ).modal('show')

    $(this.$el).on('hidden.bs.modal' , function(){
      $(this).remove()
    })

    
  },

  events : {
    "click #delete" : function(){
      var self = this
      this.model.destroy({ success: function(){
        self.collection.remove(self.model)
        $(self.$el).modal('hide')
        self.collection.fetch()
      } })
    }
  }

})