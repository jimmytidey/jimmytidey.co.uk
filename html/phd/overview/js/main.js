/*
$(function(){
  var
    $win = $(window),
    $filter = $('.nav'),
    $filterSpacer = $('<div />', {
      "class": "filter-drop-spacer",
      "height": $filter.outerHeight()
    });
  $win.scroll(function(){     
    if(!$filter.hasClass('fix') && $win.scrollTop() > $filter.offset().top){
      $filter.before($filterSpacer);
      $filter.addClass("fix");
    } else if ($filter.hasClass('fix')  && $win.scrollTop() < $filterSpacer.offset().top){
      $filter.removeClass("fix");
      $filterSpacer.remove();
    }
  });
});

*/