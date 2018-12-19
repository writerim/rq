var converter_model = new CONVERTER_MODEL({id : converter_id})
var converter_types_collection = new CONVERTER_TYPE_COLLECTION()
var devices_collection = new METER_COLLECTION()
devices_collection.converter = converter_id

$(document).ready(function(){
  converter_model.fetch()
  converter_types_collection.fetch()
  devices_collection.fetch()
  new CONVERTER_MAIN_INFO_VIEW( converter_model , converter_types_collection )
  new LIST_DEVICES_VIEW( converter_model , devices_collection )
})