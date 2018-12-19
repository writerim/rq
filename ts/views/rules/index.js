var rule_collection = new RULE_COLLECTION

$(document).ready(function(){
  rule_collection.fetch()
  new RULE_LIST_VIEW(rule_collection)
})