function createIFrame(fname, src,whot,width,height,display) {
	$('<iframe />', {
         "name":fname,
         "id":fname,
         "width":width,
         "height":height,
         "border":"0px",
         "margin":"0px",
         "padding":"0px",
         "display":display,
         "src":src
	}).appendTo('#'+whot);
	$("#"+fname).css('display',display);	
}