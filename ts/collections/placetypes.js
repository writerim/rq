var PLACETYPE_COLLECTION = Backbone.Collection.extend({
  model : PLACE_TYPE
})

var place_types = new PLACETYPE_COLLECTION([
{ id : 6 , title : "Объект"},
{ id : 1 , title : "Улица"},
{ id : 2 , title : "Дом"},
{ id : 3 , title : "Квартира"},
{ id : 4 , title : "Офис"},
{ id : 5 , title : "Арендатор"},
]);