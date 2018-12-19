var RULE_LIST_VIEW = Backbone.View.extend({

  template : "#rule_list_tpl",

  el : "#rule_list",

  collection  :new RULE_COLLECTION,

  initialize : function( collection_ ){
    this.collection = collection_
    this.render()
    this.listenTo( this.collection , "sync" , this.render )
  },

  render : function(){
    var tpl_c = _.template( $(this.template).html() )
    $(this.$el).empty().append( tpl_c({ rules : this.collection }) )
  },

  events : {

    "click #add_rule" : function(){
      new RULE_MODAL_EDIT_VIEW( new RULE_MODEL , this.collection )
    },

    "click .rule_edit_item" : function( e ){
      var cid = $(e.target).closest('tr').attr('id')
      var model = this.collection.get(cid)
      if( typeof model != "undefined" ){
        new RULE_MODAL_EDIT_VIEW( model , this.collection )
      }
    },

    "click .rule_delete_item" : function( e ){
      var cid = $(e.target).closest('tr').attr('id')
      var model = this.collection.get(cid)
      if( typeof model != "undefined" ){
        new RULE_MODAL_DELETE_VIEW( model , this.collection )
      }
    }

  }

})