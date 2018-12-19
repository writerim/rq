/*
 * 
 * Вид отвечает за вывод информации о БС в табличном виде
 * 
 */

var LORA_TABLE_INFO = Backbone.View.extend({
  
  el : "#lora_properties",
  
  template : "#lora_properties_tpl",
  
  model : new LORA_CONVERTER,
  
  collection : new ConverterTypes,
  
  /*
   * @param Backbone.Model
   */
  __set_model : function( model ){
    if( typeof model !== "undefined" ){
      this.model.set( model.toJSON() );
      this.trigger('set_model')
    }
  },
  
  /*
   * @param Backbone.Collection
   */
  __set_collection : function( collection_types ){
    if( typeof collection_types !== "undefined" ){
      this.collection = collection_types;
    }
  },

  /*
   * @param Backbone.Model
   * @param Backbone.Collection
   * 
   * @return LORA_TABLE_INFO
   */
  initialize : function( model , collection_types ){
    
    
    this.listenTo( this , "set_model" , this.render );
    
    if( typeof collection_types !== "undefined" ){
      this.collection = collection_types;
    }
    
    if( typeof model !== "undefined" ){
      this.model = model;
    }
    
    console.log( this.model.toJSON() )
    
    if( !$( this.template ).length ){
      return this;
    }
    
    this.render();
    
    return this;
  },
  
  
  render : function(){
    
    console.log( 111  )
    
    var tpl_c = _.template( $( this.template ).html() );
    $( this.$el ).empty().append( tpl_c( { lora_model : this.model , types : this.collection.toArray() } ) );
  }
  
});
