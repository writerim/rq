var PLACE_EDIT_MODAL = Backbone.View.extend({

  template : "#modal_edit_tpl",

  model : new PLACE_MODEL,

  parent : new PLACE_MODEL,

  collection : new PLACE_COLLECTION,

  is_generate : false,

  count_generate : 0,

  point_generate : 0,


   render : function(){

    var tpl_c = _.template( $(this.template).html() )

    this.$el = $( tpl_c({ place : this.model }) ).modal('show')

    var self = this;

    $( this.$el ).on("shown.bs.modal" , function(){
      $("#place_type_helper").attr("class" , self.model.get_icon() )
      self.__btn_save_status()
      self.__input_count_status()
    }).on("hidden.bs.modal" , function(){
      $(this).remove()

      // Если есть коллекция
      if( self.collection !== null && this.parent !== null ){
        self.collection.fetch()
      }
      // if( !self.model.get('id') && this.parent == null ){
      //   window.location.pathname = window.location.pathname
      // }
    })
  },

  initialize : function( model_ , parent_ , collection_ ){


    this.origin_model = model_
    this.model = model_.get('id') ? model_.clone() : model_
    this.parent = parent_

    if( typeof collection_ != "undefined" && collection_ != null ){
      this.collection = collection_
    }
    if( typeof parent_ != "undefined" && parent_ != null ){
      this.model.set("place_id" , parent_.get('id'))
    }


    this.listenTo( this , "change_gen" , function(){
      this.is_generate = !this.is_generate
      var action = !this.is_generate ? "slideUp" : "slideDown"
      var btn_f_action = !this.is_generate ? "addClass" : "removeClass"
      var btn_l_action = !this.is_generate ? "removeClass" : "addClass"
      $('#generator')[action](500)
      $('#place_show_more').find("i")[btn_f_action]('fa-chevron-down')[btn_l_action]('fa-chevron-up')
    })

    this.listenTo( this.model , "change:type" , function(){
      $("#place_type_helper").attr("class" , this.model.get_icon() )
    })

    this.listenTo( this.model , "change:title" , function(){
      var action = this.model.isValid() ? "removeClass" : "addClass"
      $("#place_form_title")[action]("has-error")
      this.__example_status()
    }) 

    this.listenTo( this.model , "change" , this.__btn_save_status )
    this.listenTo( this.model , "change" , this.__input_count_status )
    this.listenTo( this , "count_places" , this.__example_status )

    this.render()
  },

  __example_status : function(){
    var action_slide = this.count_generate > 0 ? "slideDown" : "slideUp"
    $("#result_prev")[action_slide](300)

    $("#result").empty()
    for( var i = 1 ; i <= 3 ; i++ ){
      $("#result").append("<p class='text-muted'>" + this.model.escape("title") + " " + i + "</p>")
    }
  },

  __btn_save_status : function(){
    var action = this.model.isValid() ? "removeClass" : "addClass"
    var action_r = this.model.isValid() ? "addClass" : "removeClass"

    var succefy_class = this.model.get('id') ? "btn-info" : "btn-success"

    $("#save")[action]("btn-disabled")[action_r](succefy_class)
  },


  __input_count_status : function(){
    $("#count_places").attr("disabled" , this.model.isValid() ? null : "disabled" )
  },


  __save_generated : function(){
    var self = this
    var model_tmp = this.model.clone()
    model_tmp.set("title" , model_tmp.escape("title") + " " + (this.point_generate+1) )
    model_tmp.save( null , { success : function(){
      self.point_generate++
      self.count_generate--
      if( self.count_generate > 0 ){
        var all = self.point_generate + self.count_generate
        var proc = Math.ceil( 100 / all * self.point_generate )
        $('.progress-bar').css("width" , proc + "%" )
        self.__save_generated()
      }else{
        $(self.$el).modal('hide')
      }
    }})
  },



  events : {
    "click #place_show_more" : function(){
      this.trigger('change_gen')
    },

    "change #place_type" : function( e ){
      this.model.set("type" , $(e.target).val() )
    },

    "keyup #place_change_title" : function( e ){
      this.model.set("title" , $(e.target).val() )
    },

    "keyup #count_places" : function( e ){
      this.count_generate = Number( $(e.target).val() )
      this.trigger("count_places" )
    },

    "click #save" : function(){
      var self = this
      if( this.count_generate > 0 && this.is_generate ){
        $(".progress").removeClass("hide")
        this.__save_generated()
      }else{
        this.origin_model.set(this.model.toJSON())
        this.origin_model.save( null , {success : function(){
          $(self.$el).modal('hide')
        }})
      }
    }
  },


})