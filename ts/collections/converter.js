// КОЛЛЕКЦИЯ

var CONVERTER_COLLECTION = Backbone.Collection.extend({
    total : 0,
    page : 1,
    view_by : 0,
    model : CONVERTER_MODEL,
    offset : 0,
    parse : function(a){
        this.total = a.total
        this.page = a.page
        this.view_by = a.view_by          
        return a.items
    },
    url : function() {
        return base_url+'api/converter/?page=' + this.page + '&view_by=' + this.view_by
    }
})


