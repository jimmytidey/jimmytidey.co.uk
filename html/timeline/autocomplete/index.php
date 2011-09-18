


<script type="text/javascript">
	

$(function() {
$("#example1")
  .suggest({
  "type": ["/people/person", "/time/event"],
  "type_strict": "any"
})	
  .bind("fb-select", function(e, data) {
  
			$.getJSON('http://jimmytidey.co.uk/timeline/autocomplete/get_dates.php?id='+data.id, function(result) {
	    			
			begin = parseInt($('#hidden_begin').attr('value'));
			scale = parseInt($('#hidden_scale').attr('value'));
			start 	= parseInt(result.start);
			end 	= parseInt(result.end);
			
			
			start_date 	= (start-begin)*scale;
			end_date		= (end-begin)*scale;
			width = end_date - start_date;
			
			html = '<div id="auto_duration" style="left:'+start_date+'px; width:'+width+'px; top:72px;" ><span class="blue_duration_left">&nbsp;</span><p class="event_title">'+result.title+'</p> <p class="info"></p> <p class="content">'+result.description+'</p><span class="blue_duration_right">&nbsp;</span></div>';
			
			$('#timeline').append(html);
			addDuration('auto_duration', result.title, '');
		});

  });
});



</script> 
 

<input type="text" id="example1"/>
      







