$(document).ready(onLoad);

function onLoad(){
  $('#slideshow').html('<div id="image" width="' + slide_width + '"><img src="' + slide_list[0] + '" width="100%" height="100%"></div>');
  $('#slideshow').width(slide_width);
  
  var i;
  for(i = 0; i < slide_list.length; i++){
    $("#slideshow_buffer").append('<img src="' + slide_list[i] + '">')
  }

  setInterval("changeImg(slide_list[n])", 5000);
}

function changeImg(img_path){
  var old_image_height = $("#image").height();
  $("#slideshow").append('<div id="new_image" width="' + slide_width + '" style="display: none; margin-top: -' + old_image_height + 'px;"><img src="' + img_path + '" width="100%"></div>');
  
  $("#new_image").fadeIn(1000);
  $("#image").fadeOut(1000, function(){ 
      $('#slideshow').html('<div id="image" width="' + slide_width + '"><img src="' + img_path + '" width="100%"></div>'); 
    });
  
  n++;
  if(n >= slide_list.length){
    n = 0;
  }
}