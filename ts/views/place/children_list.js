var PLACE_CHILDREN_LIST_VIEW = Backbone.View.extend({

  el : "#children_list",

  template : "#children_list_tpl",

  collection  : new PLACE_COLLECTION,
  model       : new PLACE_MODEL,

  initialize : function( model_ , collection_ ){
    var self = this
    this.model = model_
    this.collection = collection_
    this.listenTo( this.collection , "sync" , this.render )
    this.listenTo( this.collection , "sync" , function(){
      self.model.fetch()
    } )
    this.render()
  },

  render : function(){
    var tpl_c = _.template( $(this.template).html() )

    var self = this

    $( this.$el ).empty().append( tpl_c({

      place           : this.model,
      children_places : this.collection,
      pages           : Math.ceil( this.collection.total / this.collection.view_by ),
      active_page     : this.collection.page,
      count_items     : this.collection.length,
      view_by         : this.collection.view_by,
      total           : this.collection.total

    }) )

    var pages = Math.ceil( this.collection.total / this.collection.view_by )

    if( pages > 1 ){
      $(".children_pagination").bootpag({
        total: pages,
        page : this.collection.page,
        maxVisible : 5,
        leaps: false,
        firstLastUse: true,
        first: '←',
        last: '→',
        wrapClass: 'pagination',
        activeClass: 'active',
        disabledClass: 'disabled',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first'
      }).one('page' , function(event, num){
        self.collection.page = num
        self.collection.fetch()
        return false
      })
      
    }

  },

  events : {

    "click .children_edit" : function(e){
      var cid = $(e.target).closest('tr').attr('id')
      var place = this.collection.get(cid)
      if( typeof place == "undefined" ){
        return false
      }
      new PLACE_EDIT_MODAL( place , this.model , this.collection  )
    },

    "click .children_delete" : function( e ){
      var cid = $(e.target).closest('tr').attr('id')
      var place = this.collection.get(cid)
      if( typeof place == "undefined" ){
        return false
      }
      new PLACE_DELETE_MODAL( place , this.collection  )
      return false
    },

    "click #add_child" : function(){
      new PLACE_EDIT_MODAL( new PLACE_MODEL , this.model , this.collection  )
    }
  }

})