// JS

var CONVERTER_LIST_VIEW = Backbone.View.extend({
  el: '#converter_list',
  template: '#converter_list_tpl',
  collection: new CONVERTER_COLLECTION,
  count_items: [10, 25, 50, 100],
  pages: 0,

  initialize: function (collection_ , converter_types_) {
    this.collection = collection_
    this.converter_types = converter_types_
    this.listenTo(this.collection , "sync" , this.render)
    this.listenTo(this.converter_types , "sync" , this.render)
    this.render()
  },

  render: function () {
    var tpl_c = _.template($(this.template).html())
    $(this.$el).empty().append(tpl_c({
      collection: this.collection.toArray(),
      converter_types: this.converter_types,
      count_items: this.count_items,
      active_page: this.collection.page,
      view_by: this.collection.view_by,
      total: this.collection.total,
      pages: this.pages,
    }))

    var self = this;

    var all_pages = Math.ceil( this.collection.total / this.collection.view_by )

    if( all_pages > 1 ){
      $('.children_pagination').bootpag({
        total: all_pages,
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

  events: {
    "click .converter_delete_item": function (e) {
      self = this
      var model_cid = $(e.target).closest('tr').attr('id')
      var model = this.collection.get(model_cid)
      if (typeof model != 'undifined') {
        new CONVERTER_MODAL_DELETE(model , this.collection)
      }
    },
    
    "click .converter_edit_item": function (e) {
      var model_cid = $(e.target).closest('tr').attr('id')
      var model = this.collection.get(model_cid)
      if (typeof model != 'undifined') {
        new CONVERTER_MODAL_EDIT_VIEW( model , this.collection, this.converter_types  )
      }
      return false
    },

    "click #converter_add_item": function () {
      new CONVERTER_MODAL_EDIT_VIEW( new CONVERTER_MODEL , this.collection , this.converter_types )
      return false
    },



    //View by
    "click .count_items": function (e) {
      var count_items = $(e.target).attr('id').replace("count_items_", "")
      if (count_items != 'all') {
        this.collection.view_by = count_items
      } else {
        this.collection.view_by = this.collection.total
      }
      this.collection.fetch()
      return false
    },

  }
})  