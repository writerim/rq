var USER_MODEL = Backbone.Model.extend({
  defaults : {
    user_name : '',
    user_password : ''
  }
})

var main_auth_view = Backbone.View.extend({
  el: "#auth_window",
  template: "#auth_window_tpl",
  model: new USER_MODEL,
  //error_login: false,

  initialize: function () {    
    this.render()
  },
  render: function () {
    var tpl_c = _.template($(this.template).html())
    $(this.$el).empty().append(tpl_c({}))
  },

  events: {    
    "click #login": function (e) {
      this.model.set('user_name', $(e.target).closest('.panel-body').find('#user_name').val())
      this.model.set('user_password', $(e.target).closest('.panel-body').find('#user_pass').val())
      this.model.fetch({
        data: {
          user_name: this.model.get('user_name'),
          user_password: this.model.get('user_password')
        },
        success : function(_, res){          
          if(res == 'error'){            
            $("#error_login").show()            
          }else{
            $("#error_login").hide()
            console.log()
            document.location.href = '/place'
          }
        },
        dataType: 'text',
        type: 'POST',
        url: '/auth/error_login'
      })
      return false
    }
  }

})

$(document).ready(function () {
  new main_auth_view
})
