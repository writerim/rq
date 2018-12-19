var RULE_DESCRIPTION_MODEL = Backbone.Model.extend({
  defaults : {
    object : "",
    view : 0,
    all : 0,
  }
})

var RULE_DESCRIPTION_COLLECTION = Backbone.Collection.extend({
  model : RULE_DESCRIPTION_MODEL
})

var rule_description_collection = new RULE_DESCRIPTION_COLLECTION([
  { object : "places" , view : 0 , all : 0},
  { object : "converters" , view : 0 , all : 0},
  { object : "meters" , view : 0 , all : 0},
  { object : "rules" , view : 0 , all : 0},
  { object : "users" , view : 0 , all : 0}
])

var RULE_MODEL = Backbone.Model.extend({

  defaults : {

    id : 0,

    title : "",

    description : new RULE_DESCRIPTION_COLLECTION

  },

  url : function(){
    return base_url + "api/rules/" + this.get('id')
  },

  parse : function(data){
    data.description = new RULE_DESCRIPTION_COLLECTION( JSON.parse( data.description ) )
    return data
  },

  validate : function(){
    if( !this.get('title') ){
      return "empty title"
    }
  }

})