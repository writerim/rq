var CONVERTER_INFO_PANEL_VIEW = Backbone.View.extend({

  el: "#info_panel",
  template: "#info_panel_tpl",
  model: new CONVERTER_MODEL,

  render: function () {
    var tpl_c = _.template($(this.template).html())
    $(this.$el).empty().append(tpl_c({
      model: this.model
    }))
  },

  initialize: function (_model) {  
    this.model = _model
    this.listenTo(this.model, "sync", this.render)
    this.render()
  },

  events: {
    "click #converter_edit_modal": function () {
      new modal_window({model: this.model})
      return false
    }
  }
})