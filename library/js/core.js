jQuery(document).ready(function($){
//document.domain = 'ubuntu.com';

// removes no-js class and adds yes-js if js
$("html").removeClass("no-js").addClass("yes-js");

if ( $(window).width() <= 9999) {
	$("html").addClass("mobile");
}
	
if (!$("body").hasClass("single")) {

	$('.prev-post').each(function() {
	    var text = $(this).text();
	    $(this).text(text.replace('Older Entries', 'Load more')); 
	    $(this).addClass("load-more");
	});

	$(function() {
	  var $resultcontainer = $('.article-list');
	      
	  $resultcontainer.infinitescroll({
	    navSelector  	: '.navigation',    // selector for the paged navigation 
	    nextSelector 	: '.navigation .nav-previous a',  // selector for the NEXT link (to page 2)
	    itemSelector 	: '.article',     // selector for all items you'll retrieve
	    animate     	: true,
	    behavior 	 		: 'twitter',
	    loading: {
				msgText				: 'Loading more posts...',
				finishedMsg		: '<p class="loaded">All posts are loaded</p>'
				}
	   });
	});
}

// Create share trigger
$( "#share" ).prependTo( ".header-inner" );
$("#share").append('<a href="" id="share-trigger" class="nav-trigger">Share</a>');

// Create search trigger
$(".header-inner").append('<a href="" id="search-trigger" class="nav-trigger">Search</a>');
// Move the search box to the top
$( "#box-search" ).prependTo( ".header-inner, #nav-global-wrapper p:last-of-type" );

// Create menu trigger
$(".header-inner").addClass("js").append('<a href="#main-nav" id="menu" class="nav-trigger">&#9776;</a>');
$( "#main-nav" ).appendTo( ".header-inner" ).append('<p id="nav-global-wrapper-link"><a href="#nav-global-wrapper" class="nav-trigger">Ubuntu websites</a></p>');
 
 
$("#share-trigger").on('click touchstart', function(event){
  $("#share div").toggleClass("active");
  $("#share-trigger").toggleClass("active");
  $("#box-search div").removeClass("active").addClass("inactive");
  $("#search-trigger").removeClass("active").addClass("inactive");
  $("#main-nav").removeClass("active").addClass("inactive");
  $("#menu").removeClass("active").addClass("inactive");
  event.preventDefault();
}); 

$("#search-trigger").on('click touchstart', function(event){
  $("#box-search div").toggleClass("active");
  $("#search-trigger").toggleClass("active");
  $( ".header-inner #box-search #s" ).focus();
  $("#share div").removeClass("active").addClass("inactive");
  $("#share-trigger").removeClass("active").addClass("inactive");
  $("#main-nav").removeClass("active").addClass("inactive");
  $("#menu").removeClass("active").addClass("inactive");
  event.preventDefault();
}); 

$("#menu").on('click touchstart', function(event){
  $("#main-nav").toggleClass("active");
  $("#menu").toggleClass("active");
  $("#box-search div").removeClass("active").addClass("inactive");
  $("#search-trigger").removeClass("active").addClass("inactive");
  $("#share div").removeClass("active").addClass("inactive");
  $("#share-trigger").removeClass("active").addClass("inactive");
  event.preventDefault();
}); 

// Bind click event listener on the body
// Hide main menu if user clicks anywhere off of the menu itself.
$('body').on('click.hideMenu', function(e) {
  // Check to see if the list is currently displayed.
  if ($('#main-nav').hasClass('active')) {
    // If element clicked on is NOT one of the menu list items,
    // hide the menu list.
    if (!$(e.target).parent().hasClass('item-list')) {
      $('.item-list').removeClass('show-list');
    }
  }
});

/*$(".main-navigation").mmenu({
	 position: "right",
   configuration: {
      menuNodetype: "div",
   }
});*/

$(function() {
	$('.mobile #tags ul, .mobile #list-archives').each(function(){
	var list=$(this),
	    select=$(document.createElement('select')).insertBefore($(this).hide()).change(function(){
	  window.location.href=$(this).val();
	});
	$('>li a', this).each(function(){
	  var option=$(document.createElement('option'))
	   .appendTo(select)
	   .val(this.href)
	   .html($(this).html());
	  if($(this).attr('class') === 'selected'){
	    option.attr('selected','selected');
	  }
	});
	list.remove();
	});
});

$('li.cat-item:has(ul.children)').addClass('sub-nav-menu');

//var navigation = responsiveNav("#nav");

// close alert 
$(".alert p").append("<a href='#' id='close-alert'>close</a>");	
	
$('#close-alert').click(function() {
  $('.alert').fadeOut('slow', function() {
  });
});
		
// blockClick plugin.
(function($) {
  $.fn.blockClick = function(options) {

    var opts = $.extend({}, $.fn.blockClick.defaults, options);

    return this.each(function() {
      $(this)
        .css("cursor", "pointer")
			  .hover((function(){
				  $(this).addClass("block-click-hover");
			  }),
			  function(){
			    $(this).removeClass("block-click-hover");
		    })
			  .click(function(){
				  window.location = $(this).find("a").attr("href");		
			  });
    });
  };
  $.fn.blockClick.defaults = {};
	$(function(){ $('.block-click').blockClick(); });
})(jQuery);

(function($) {
  $.fn.equalHeights = function(options) {
    var opts = $.extend({}, $.fn.equalHeights.defaults, options);
        
    /* Work out the highest .height(). */
    var heightArr = new Array();
    var $items = this;
    function max(array){
        return Math.max.apply( Math, array );
    };
    
    if ($items.length == 0) return;
    $items.each(function(i){ 
      
      var $item = $(this);
      $(this).css({
        minHeight : 0,
        height : "auto"
      });
      heightArr[i] = $item.height();
      
      if (i == $items.length - 1) {
        var maxHeight = max(heightArr);
        $items.each(function(){ $(this).height(maxHeight); });
        return $items;
      }
    });
  }
  $.fn.equalHeights.defaults = {};
})(jQuery);

  $(window).load(function(){
    //setEqualHeights($('#mags-latest .twelve-col'), 2);
    $('.category .article-list .four-col.box').equalHeights();
		$('.post-type-archive .four-col.box').equalHeights();
		$('.tax-audience .four-col.box').equalHeights();
  });
  
  function setEqualHeights($items, groupCount) {
    var maxCount = $items.length,
        count;
    $.each($items, function(i){
      count++;
      if (((i+1) % groupCount == 0)) {
        $items.slice((i - count) + 1, i + 1).equalHeights();
        count = 0;
      } 
      if (i == maxCount - 1  && ((i+1) % groupCount != 0)) {
        // Deal with the end of the list.
      }
    });
  }

});  

core = {};