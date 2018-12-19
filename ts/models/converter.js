// МОДЕЛЬ

var CONVERTER_MODEL = Backbone.Model.extend({
  defaults: {
    title: '',
    id: 0,
    ip: '',
    type: 0,
    port: '',
    login: '',
    password: '',
    portcontrol: 0,
    is_excluded: 0,
    meter_ok: 1,

  },
  about_was_edited: true,

  parse: function (a) {
    if (a instanceof Object) {
      return a
    } else {
      return
    }
  },

  url: function () {
    return base_url+'api/converter/' + this.get('id')
  },
  
  validate: function() {   
    
    if( !this.validate_ip() ){      
      return  'invalid ip'      
    } 
    
    if( !this.validate_port() ){
      return 'invalid port'
    }

    if( !this.validate_about() ){
      return 'invalid about'
    }

    if( !this.validate_type() ){
      return 'invalid type'
    }

  },
  
  validate_ip : function(){
    var RegE = /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/
    return RegE.test(this.get('ip'))
  },
  
  validate_port : function(){
    var port = this.get('port')
    return (parseInt(port) > 0  && parseInt(port) < 65535 && !isNaN(port) && port != '')
  },

  validate_about : function(){
    return this.get('title') != this.defaults.title
  },

  validate_type : function(){
    return this.get('type') > 0
  },


  get_status_class : function(){
    if( this.get('is_excluded') ){
      return "text-muted"
    }
    switch( this.get('meter_ok') ){
      case 1 : return "text-success";
      case 2 : return "text-warning";
      case 0 : return "text-danger";
    }
  }

})

