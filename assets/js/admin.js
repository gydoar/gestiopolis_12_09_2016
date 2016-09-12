//Help boxes
jQuery(document).ready(function($){
	
	
	$("a.gesti-open").click(function(){

		$($(this).attr('href')).fadeIn('normal');
        return false;
		
	});

	
	$('a.gesti-close').click(function() {
	
        $($(this).attr('href')).fadeOut();
        return false;
        
    });

    var ques=0;
	  $("#agrexl").click(function() {
		  $("#exlinks-"+ques).show();
		  ques++;
	  });
	  $(".borrarjq").click(function() {
		  var jqpost = $(this).attr("rel");
		  $("#"+jqpost).remove();
	  });
	
});