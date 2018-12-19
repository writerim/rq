var PLACE_MODEL = Backbone.Model.extend({
  defaults: {
    id: 0,
    title: '',
    type: 6,
    place_id : 0,
    meters_all: 0,
    places_all: 0,
    meters_error : 0,
    meters_excluded : 0
  },
  url: function () {
    return base_url+'api/place/' + this.id
  },


  validate : function(){
    if( this.get('title') == this.defaults.title ){
      return "empty title"
    }
  },


  get_icon : function(){
    if( this.get('type') == 5 ){
      return "fa-building-o fa"
    }else if( this.get('type') == 2 ){
      return "glyphicon glyphicon-home" 
    }else if( this.get('type') == 1 ){
      return "fa-road fa" 
    }else{
      return "fa-cube fa" 
    }
  }

})