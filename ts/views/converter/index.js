var converter_list = new CONVERTER_COLLECTION()
var convertertype_list = new CONVERTER_TYPE_COLLECTION()
$(document).ready(function () {
  converter_list.fetch()
  convertertype_list.fetch()
  new CONVERTER_LIST_VIEW(converter_list , convertertype_list)
})