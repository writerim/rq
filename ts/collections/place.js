var PLACE_COLLECTION = Backbone.Collection.extend({
  total: 0,
  page: 0,
  view_by: 0,
  total: 0,
  model: PLACE_MODEL,
  offset: 0,
  parent_id : 0,
  comparator: 'title',
  parse: function (a) {
    this.total = a.total
    this.page = a.page
    this.view_by = a.view_by
    return a.items
  },
  url: function () {
    return base_url+'api/place/'+ this.parent_id + '/child?page=' + this.page + '&view_by=' + this.view_by
  }
})