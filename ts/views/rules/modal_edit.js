var RULE_MODAL_EDIT_VIEW = Backbone.View.extend({

  template : "#rule_modal_edit_tpl",

  model : new RULE_MODEL,

  collection : new RULE_COLLECTION,

  rule_description : rule_description_collection,

  initialize : function( model_ , collection_ ){
    this.model = model_.clone()
    this.origin = model_
    this.collection = collection_

    this.listenTo( this.model , "change" , this.replace_btn_save )

    this.render()
  },

  replace_btn_save : function(){
    var action  = this.model.isValid() ? "btn btn-success" : "btn btn-disabled"
    $('#save').attr('class' , action)
  },

  render : function(){

    var self = this
    if( !this.model.get('id') ){
      this.model.set('description' , this.rule_description )
    }

    var tpl_c = _.template( $(this.template).html() )

    this.$el = $( tpl_c({ rule : this.model , rule_description : this.rule_description }) ).modal('show')

    $(this.$el).on('hidden.bs.modal' , function(){
      $(this).remove()
    }).on('shown.bs.modal' , function(){
      self.replace_btn_save()
    })

  },

  events : {

    "click .ckbx-style-8" : function( e ){
      if( typeof $(e.target).attr('id') == "undefined" ){
        return
      }

      var m = new RegExp(/([a-z]*)_([a-z]*)/)

      var res = $(e.target).attr('id').match( m )

      if( res ){
        this.model.get('description').findWhere({ object : res[1]  }).set( res[2] , Number( $(e.target).prop('checked') ) )
      }
    },

    "keyup #title" : function( e ){
      this.model.set('title' , $(e.target).val() )
    },

    "click #save" : function(){
      if( !this.model.isValid() ){
        return false;
      }
      var self = this
      console.log( this.model.get('description') )
      this.model.set('description' , JSON.stringify(this.model.get('description').toJSON())  )
      this.model.save( null, { success : function(){
        self.collection.fetch()
        $(self.$el).modal('hide')
      }})
    }

  }

})