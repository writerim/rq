$(document).ready(function(){
  $('#meters_nav').click(function(e){
    $(e.target).closest('li').toggleClass('active').find('ul').toggleClass('in')
    return false;
  })
  $('.navbar-minimalize').click(function(){
    $('body').toggleClass('mini-navbar')
  })
})