var CONVERTER_TYPE_COLLECTION = Backbone.Collection.extend({
    model: CONVERTER_TYPE_MODEL,
    url: base_url+"api/convertertypes/",

    
    parse: function (a) {
      this.total = a.total
      this.page = a.page
      this.view_by = a.view_by
      return a.items
    },
});