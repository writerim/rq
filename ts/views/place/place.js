var place_list = new PLACE_COLLECTION;
place_list.parent_id = place_id;
var place     = new PLACE_MODEL({id : place_id});

$(document).ready(function () {
  place.fetch()
  place_list.fetch()
  new PLACE_MAIN_INFO_VIEW( place )
  new PLACE_CHILDREN_LIST_VIEW( place , place_list )
  new PLACE_BREADCRUMB_VIEW( place )
  new PLACE_USERS_VIEW( )
  new PLACE_METERS_VIEW( )
  new PLACE_H1_VIEW( place )
})
