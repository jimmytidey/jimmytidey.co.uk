
/* For the menu affix */ 
$(window).resize(function () {
	$('.affix').width($('#affix-nav').parent().width());
});


$(document).ready(function(){
    $('#affix-nav').width($('#affix-nav').parent().width());
});
