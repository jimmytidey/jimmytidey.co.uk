scroller = {};
scroller.page = 1; 
scroller.max_page = 6; 
scroller.page_names = ['', '#About', '#Freelance', '#Evrythng', '#Monterosa', '#Personal-work', '#Contact'];


$(document).ready(function() {
	
	if(window.location.hash) {
		console.log(window.location.hash);
		var target = $.inArray(window.location.hash, scroller.page_names);
		scroller.target(target);
	}
	else { 
		scroller.target(1);
	}
   
    $('#arrow_right').click(function() {
   		scroller.right();
    });
    
    $('#arrow_left').click(function() {
        scroller.left();
    });

	$('#guide p').click(function() {
        var target = $(this).attr('data-target');
		scroller.target(target);
    });

	$('#name').click(function() {
		scroller.target(1);
    });

	$('.fancybox').fancybox();
   
});


scroller.right = function() { 
    if(scroller.page != scroller.max_page && !$('#item_container').is(":animated")) {
        $('#item_container').animate({
            left: '-=900'
        });
		scroller.page+=1;
		scroller.pageupdate(); 
    }
}

scroller.left = function() {
	 if(scroller.page != 1  && !$('#item_container').is(":animated") ) { 
		$('#item_container').animate({
     		left: '+=900'
		});
		scroller.page-=1; 
		scroller.pageupdate();
	}	
}

scroller.target = function(page_no) {
	var pages_to_move =  scroller.page - page_no; 
	var distance_to_move = pages_to_move * 900;
	if (!$('#item_container').is(":animated")) { 
		$('#item_container').animate({
	 		left: '+='+distance_to_move
		});
		scroller.page=page_no; 
		scroller.pageupdate();
	}	
}

scroller.pageupdate = function() { 
	var page_name = scroller.page_names[scroller.page];
	if (scroller.page == 1) { 
		history.pushState(null, null, '/')
	}
	else { 
		history.pushState(null, null, page_name);
	}
	$('#guide p').css('text-decoration', 'none');
	$('#guide [data-target="'+scroller.page+ '"]').css('text-decoration', 'underline');
}
