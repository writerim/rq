var USER_COLLECTION = Backbone.Collection.extend({
  model  : USER_MODEL,
  
  url : base_url + "api/users/",

  parse: function (a) {
    this.total = a.total
    this.page = a.page
    this.view_by = a.view_by
    return a.items
  },
}) 