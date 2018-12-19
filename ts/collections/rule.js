var RULE_COLLECTION = Backbone.Collection.extend({
    
  model : RULE_MODEL,

  url : base_url + "api/rules",

   parse: function (a) {
    this.total = a.total
    this.page = a.page
    this.view_by = a.view_by
    return a.items
  },

})