var METER_TYPES_COLLECTION = Backbone.Collection.extend({
    model: METER_TYPE_MODEL,
    url: base_url+"api/meter_type/"
});
