var CONVERTER_MODAL_EDIT_VIEW = Backbone.View.extend({

  template : "#converter_modal_edit_tpl",

  model : new CONVERTER_MODEL,

  collection : new CONVERTER_COLLECTION,

  converter_types : new CONVERTER_TYPE_COLLECTION,

  is_more : false,

  initialize : function( model_  , collection_ , converter_types_ ){

    this.model = model_.clone()
    this.origin = model_
    if( collection_ != null ){
      this.collection = collection_
    }
    this.converter_types = converter_types_

    this.render()

  },


  render : function(){

    var self = this

    var tpl_c = _.template( $(this.template).html() )

    this.$el = $( tpl_c({ converter : this.model , converter_types : this.converter_types }) ).modal('show')

    $(this.$el).on('hidden.bs.modal' , function(){
      $(this).remove()
      self.collection.fetch()
    }).on('shown.bs.modal' , function(){
      if( !self.model.get('type') ){
        self.model.set('type' , self.converter_types.at(0).get('id'))
      }
    })

    this.listenTo( this , "change_more" , function(){
      this.is_more = !this.is_more
      var action = !this.is_more ? "slideUp" : "slideDown"
      var btn_f_action = !this.is_more ? "addClass" : "removeClass"
      var btn_l_action = !this.is_more ? "removeClass" : "addClass"
      $('#more_info')[action](500)
      $('#converter_show_more').find("i")[btn_f_action]('fa-chevron-down')[btn_l_action]('fa-chevron-up')
    })

    this.listenTo( this.model , "change" , function(){
      var action = this.model.isValid() ? "btn btn-success" : "btn btn-disabled"
      $("#save").attr('class' , action)
    }) 

    this.listenTo( this.model , "change:ip" , function(){
      var action = this.model.validate_ip() ? "removeClass" : "addClass"
      $(".ip_group")[action]('has-error')
    })

    this.listenTo( this.model , "change:port" , function(){
      var action = this.model.validate_port() ? "removeClass" : "addClass"
      $(".port_group")[action]('has-error')
    })

    this.listenTo( this.model , "change:type" , function(){
      var action = this.model.validate_type() ? "removeClass" : "addClass"
      $(".type_group")[action]('has-error')
    })

    this.listenTo( this.model , "change:about" , function(){
      var action = this.model.validate_about() ? "removeClass" : "addClass"
      $(".about_group")[action]('has-error')
    })
    

  },

  events : {

    "click #converter_show_more" : function(){
      this.trigger('change_more')
    },

    "change #type" : function( e ){
      this.model.set('type' , Number( $(e.target).val() ) )
    },

    "keyup #ip" : function( e ){
      this.model.set('ip' , $(e.target).val() )
    },

    "keyup #port" : function( e ){
      this.model.set('port' , $(e.target).val() )
    },

    "keyup #about" : function( e ){
      this.model.set('title' , $(e.target).val() )
    },

    "keyup #login" : function( e ){
      this.model.set('login' , $(e.target).val() )
    },

    "keyup #password" : function( e ){
      this.model.set('password' , $(e.target).val() )
    },

    "keyup #portcontrol" : function( e ){
      this.model.set('portcontrol' , $(e.target).val() )
    },

    "change #is_excluded" : function( e ){
      this.model.set('is_excluded' , !$(e.target).prop('checked') )
    },

    "click #save" : function( e ){
      var self = this
      this.origin.set(this.model.toJSON())
      this.origin.save(null , {
        success : function(){
          $(self.$el).modal('hide')
        }
      })
    }

  }

})