var users_collection = new USER_COLLECTION();
$(document).ready(function(){
  users_collection.fetch()
  new USER_LIST_VIEW(users_collection)
})