YUI().use('gallery-carousel', 'gallery-carousel-anim', 'substitute', 'node', 'cookie', "event-resize", "transition", "event", function(Y) {

// removes no-js class and adds yes-js if js
core.setupHtmlClass = function() {
	Y.all('html').removeClass('no-js').addClass('yes-js');
}

core.resizeListener = function() {
	Y.on('windowresize', function(e) {
		core.redrawGlobal();
	});
	core.globalInit();
};

core.globalInit = function() {
	if (document.documentElement.clientWidth < 768) {
		core.globalPrepend = 'footer.global';
		core.setupGlobalNav();
		Y.one('.nav-global-wrapper').insert('<h2>Ubuntu websites</h2>','before');
			Y.one('#nav-global h2').setStyle('cursor', 'pointer').append('<span></span>').on('click',function(e) {
				this.toggleClass('active');
				this.next('div').toggleClass('active');
			});
	} else if (document.documentElement.clientWidth >= 768) {
		core.globalPrepend = 'body';
		core.setupGlobalNav();
	}
};

core.redrawGlobal = function() {
	var globalNav = Y.one("#nav-global");
	if (document.documentElement.clientWidth < 768 && core.globalPrepend != 'footer.global') {
		core.globalPrepend = 'footer.global';
		if (globalNav) {
			globalNav.remove();
			core.setupGlobalNav();
			Y.one('.nav-global-wrapper').insert('<h2>Ubuntu websites</h2>','before');
			Y.one('#nav-global h2').setStyle('cursor', 'pointer').append('<span></span>').on('click',function(e) {
				this.toggleClass('active');
				this.next('div').toggleClass('active');
			});
		}
	} else if (document.documentElement.clientWidth >= 768 && core.globalPrepend != 'body') {
		core.globalPrepend = 'body';
		if (globalNav) {
			globalNav.remove();
			core.setupGlobalNav();
		}
	}
};

// Clone the search box then plop it top & bottom
core.cloneSearch = function() {
	Y.one('#box-search').appendTo('.header-inner');
}

// create share trigger
core.moveShare = function() {
	Y.one('#share').appendTo('.header-inner');
}

core.welcomeMessage = function() {
	Y.one("#welcome-message").append("<a class='hide-message' href='#'>close</a>");	

	Y.all('#welcome-message .hide-message').on('click', function(e) {
		e.preventDefault();
		Y.all('#welcome-message').addClass('off-left');
		Y.Cookie.set("_welcome_message", "true", { 
			path: "/",
			expires: new Date("January 12, 2025") 
		});
	});
	
	if(Y.Cookie.get("_welcome_message") != 'true'){
		Y.one("#welcome-message").removeClass("off-left");
	}
}

core.cookiePolicy = function() {
	function open() {
		YUI().use('node', function(Y) {
			Y.one('body').prepend('<div class="cookie-policy"><div class="wrapper"><a href="?cp=close" class="link-cta">Close</a><p>We use cookies to improve your experience. By your continued use of this site you accept such use. To change your settings please <a href="/privacy-policy#cookies">see our policy</a>.</p></div></div>');
			Y.one('footer.global .legal').addClass('has-cookie');
			Y.one('.cookie-policy .link-cta').on('click',function(e){
				e.preventDefault();
				close();
			});
		});
	}
	function close() {
		YUI().use('node', function(Y) {
			Y.one('.cookie-policy').setStyle('display','none');
			Y.one('footer.global .legal').removeClass('has-cookie');
			setCookie();
		});
	}
	function setCookie() {
		YUI().use('cookie', function (Y) {
			Y.Cookie.set("_cookies_accepted", "true", { 
				path: "/",
				expires: new Date("January 12, 2025") 
			});
		});
	}
	if(Y.Cookie.get("_cookies_accepted") != 'true'){
		open();
	}
};

core.setUpNav = function() {
	
	Y.one( "#main-nav" ).appendTo( ".header-inner" ).append('<p id="nav-global-wrapper-link"><a href="#nav-global" class="nav-trigger">Ubuntu websites</a></p>');
};

core.mobileNav = function() {
	Y.all('.nav-toggle').on('click', function(e) {
		if(Y.all('#box-search div, #share div').hasClass('active')) {
			Y.all('#box-search div, #share div, .search-toggle, .share-toggle').removeClass('active');
		}
		Y.all('#main-nav, .nav-toggle').toggleClass('active');
		e.preventDefault();
	});
};

core.mobileSearch = function() {
	Y.all('.search-toggle').on('click', function(e) {
		if(Y.all('#main-nav, #share div').hasClass('active')) {
			Y.all('#main-nav, #share div, .nav-toggle, .share-toggle').removeClass('active');
		}
		Y.all('#box-search div, .search-toggle').toggleClass('active');
		e.preventDefault();
	});
};

core.mobileShare = function() {
	Y.all('.share-toggle').on('click', function(e) {
		if(Y.all('#main-nav, #box-search div').hasClass('active')) {
			Y.all('#main-nav, #box-search div, .nav-toggle, .search-toggle').removeClass('active');
		}
		Y.all('#share div, .share-toggle').toggleClass('active');
		e.preventDefault();
	});
};

core.svgFallback = function() {
	if (!Modernizr.svg || !Modernizr.backgroundsize) {
	 	Y.all("img[src$='.svg']").each(function(node) {
	 		node.setAttribute("src", node.getAttribute('src').toString().match(/.*\/(.+?)\./)[0]+'png');
	 	});
	}
};

core.downloadAlert = function() { 
	if (Y.one(".alert")) {
		Y.one(".alert").append("<a href='#' id='close-alert'>close</a>");	
		Y.one('#close-alert').on('click', function(e) {
		  Y.one('.alert').hide(true);
			e.preventDefault();
		});
	}
};

core.externalLinks = function() { 
	Y.all('a').filter(function() {
	   return this.hostname && this.hostname !== location.hostname;
	}).addClass( "external" );
	
	Y.all("a:has(img)").filter(function() {
	   return !Y.Lang.trim(Y.one(this).text()).length; 
	}).addClass("external-img");
};

core.businessCard = function() {
	if(Y.one('body').hasClass('page-template-page-topics-php')){
		Y.one(".glossary-box").append("<a class='open-message toggle-message' href='#'>show</a><a class='close-message toggle-message' href='#'>close</a>");
		
		var menu_state = Y.Cookie.get('_business_card');
	
	  if( menu_state == "visible" ) {
	    Y.one(".glossary-box div").addClass('active');
			Y.one(".open-message").removeClass('active');
			Y.one(".close-message").addClass('active');
			
	  } else if( menu_state == "hidden" ) {
	  
			Y.all(".glossary-box div").removeClass('active');		
			Y.one(".close-message").removeClass('active');
			Y.one(".open-message").addClass('active');
	  
	  } else {
	  
		  Y.one('.glossary-box div').addClass('active');
		  Y.one(".close-message").addClass('active');
	  }
	
		Y.one('.close-message').on('click', function(e) {
			Y.one(".glossary-box div").removeClass('active');
			this.removeClass('active');
			Y.one(".open-message").addClass('active');
	    Y.Cookie.set('_business_card', 'hidden', { path: "/", expires: new Date("January 12, 2025") }); // update (or set) the cookie
			e.preventDefault();
		});
		
		Y.one('.open-message').on('click', function(e) {
			Y.one(".glossary-box div").addClass('active');
			this.removeClass('active');
			Y.one(".close-message").addClass('active');
			e.preventDefault();
		});
	}
}

/*core.imageSquircle = function() {
	Y.all('#main-content img.avatar').each(function() {
		var imgClass = this.getAttribute('class');
		this.wrap('<span class="image-wrap ' + imgClass + '" style="width: auto; height: auto;"/>');
		this.setAttribute('class', '');
	});
};*/

/*core.startCarousel = function() {
	var carousel = new Y.Carousel({ 
		boundingBox: "#carousel-container",
		contentBox: "#carousel-container > ul", 
		isCircular: true, 
		numVisible: 1,
		width: 300,
		height: 120,
		srcNode: "#carousel",
		continuous: true,
		revealAmount: 80,
		autoPlay: true
	});
	carousel.plug(Y.CarouselAnimPlugin,{
		animation:{
			speed: 0.7
		}
	});
	carousel.render();
}*/

core.resizeListener();
core.cookiePolicy();
core.setupHtmlClass();
core.cloneSearch();
core.moveShare();
core.welcomeMessage();
core.setUpNav();
core.mobileNav();
core.mobileSearch();
core.mobileShare();
core.svgFallback();
core.downloadAlert();
core.externalLinks();
//core.imageSquircle();
//core.startCarousel();
core.businessCard();

});