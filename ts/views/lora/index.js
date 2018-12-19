var lora_collect = new LORA_CONVERTERS();

var lora_converter_types = new ConverterTypes();

/*
 * 
 * Вид отвечает за отображение списка моделей БС
 * 
 */

var LORA_LIST_VIEW = Backbone.View.extend({
  el : "#lora_list",
  
  template : "#lora_list_tpl",
  
  initialize : function(){
    this.render();
    this.listenTo( this.collection , 'sync' , this.render );
    this.listenTo( this.collection_types , 'sync' , this.render );
  },
  
  collection : lora_collect,
  
  collection_types : lora_converter_types,
  
  render : function(){
    var tpl_c = _.template( $( this.template ).html() );
    $( this.$el ).empty().append( tpl_c({ 
      lora_collection : this.collection.toArray() ,
      loratype_collection : this.collection_types
    }) );
  }
});

$(document).ready(function(){
  new LORA_LIST_VIEW();
  lora_collect.fetch();
  lora_converter_types.fetch();
});