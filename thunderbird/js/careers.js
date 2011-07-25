function InitializeCareersContent()
{
	YAHOO.util.Dom.addClass('content-box', 'box-setup');
}

/**
 * Page scroller
 */
function PageScroller(id, pages, height)
{
	this.id = id;
	this.height = height;
	this.pages = [];
	this.current_page = 0;
	this.animation = null;

	// set up container
	this.container = document.getElementById(this.id);
	this.container.style.overflow = 'hidden';
	this.container.style.height = this.height + 'px';

	// set up prev link
	this.prev = document.createElement('a');
	this.prev.href = '#';
	YAHOO.util.Dom.addClass(this.prev, 'previous');
	this.prev.appendChild(document.createTextNode('Previous'));

	this.prev_insensitive = document.createElement('span');
	YAHOO.util.Dom.addClass(this.prev_insensitive, 'previous');
	this.prev_insensitive.appendChild(document.createTextNode('Previous'));

	YAHOO.util.Event.addListener(this.prev, 'click',
		function (e)
		{
			YAHOO.util.Event.preventDefault(e);
			this.prevPage();
		},
		this, true);


	// set up next link
	this.next = document.createElement('a');
	this.next.href = '#';
	YAHOO.util.Dom.addClass(this.next, 'next');
	this.next.appendChild(document.createTextNode('Next'));

	this.next_insensitive = document.createElement('span');
	YAHOO.util.Dom.addClass(this.next_insensitive, 'next');
	this.next_insensitive.appendChild(document.createTextNode('Next'));

	YAHOO.util.Event.addListener(this.next, 'click',
		function (e)
		{
			YAHOO.util.Event.preventDefault(e);
			this.nextPage();
		},
		this, true);

	// add pagination to page
	var divider = document.createElement('span');
	divider.appendChild(document.createTextNode('|'));
	YAHOO.util.Dom.addClass(divider, 'divider');
	var pagination = document.getElementById('pagination');
	pagination.appendChild(this.prev);
	pagination.appendChild(divider);
	pagination.appendChild(this.next);

	// add pages
	for (var i = 0; i < pages.length; i++)
		this.addPage(new Page(pages[i]));

	// initialize current page
	var anchor = location.hash;
	if (anchor) {
		// remove hash symbol
		anchor = anchor.substring(1);
		var page_number = this.findPage(anchor);
		if (page_number === null) {
			// initialize to first page
			this.setPage(0, true);
		} else {
			this.setPage(page_number, true);
		}
	} else {
		// initialize to first page
		this.setPage(0, true);
	}

	// check if window location changes from back/forward button use
	// this doesn't matter in IE but is nice for Firefox users.
	function setupInterval(page_scroller)
	{
		var interval_function = function()
		{
			page_scroller.checkLocation();
		}
		setInterval(interval_function, 200, page_scroller);
	}
	setupInterval(this);
}

PageScroller.prototype.checkLocation = function()
{
	var hash = location.hash;
	hash = (hash.indexOf('#') == -1) ? hash : hash.substring(1);
	var current_hash = this.pages[this.current_page].id;

	if (hash && hash !== current_hash) {
		var page_number = this.findPage(hash);
		if (page_number !== null) {
			this.setPage(page_number, false);
		}
	}
}

PageScroller.prototype.addPage = function(page)
{
	var page_number = this.pages.length;
	page.setPageHeight(this.height);
	this.pages.push(page);

	if (page.nav) {
		YAHOO.util.Event.addListener(page.nav, 'click',
			function (e)
			{
				YAHOO.util.Event.preventDefault(e);
				this.setPage(page_number, false);
			},
			this, true);
	}
}

PageScroller.prototype.findPage = function(page_id)
{
	var page_number = null;

	for (var i = 0; i < this.pages.length; i++) {
		if (this.pages[i].id == page_id) {
			page_number = i;
			break;
		}
	}

	return page_number;
}

PageScroller.prototype.prevPage = function()
{
	this.setPage(this.current_page - 1, false);
}

PageScroller.prototype.nextPage = function()
{
	this.setPage(this.current_page + 1, false);
}

PageScroller.prototype.setPage = function(page_number, initialize)
{
	// deselect current (old) page
	this.pages[this.current_page].setNavHighlight(false);

	// wrap page number
	if (page_number >= this.pages.length)
		this.current_page = 0;
	else if (page_number < 0)
		this.current_page = this.pages.length - 1;
	else
		this.current_page = page_number;
	
	// select current (new) page
	this.pages[this.current_page].setNavHighlight(true);

	// set prev link sensitivity
	this.setPrevLinkSensitivity(this.current_page != 0);

	// set next link sensitivity
	this.setNextLinkSensitivity(this.current_page != this.pages.length - 1);

	// scroll to the page
	this.scrollToCurrentPage(initialize);
}

PageScroller.prototype.setPrevLinkSensitivity = function(sensitive)
{
	if (sensitive) {
		if (this.prev_insensitive.parentNode) {
			this.prev_insensitive.parentNode.replaceChild(
				this.prev, this.prev_insensitive);
		}
	} else {
		if (this.prev.parentNode) {
			this.prev.parentNode.replaceChild(
				this.prev_insensitive, this.prev);
		}
	}
}

PageScroller.prototype.setNextLinkSensitivity = function(sensitive)
{
	if (sensitive) {
		if (this.next_insensitive.parentNode) {
			this.next_insensitive.parentNode.replaceChild(
				this.next, this.next_insensitive);
		}
	} else {
		if (this.next.parentNode) {
			this.next.parentNode.replaceChild(
				this.next_insensitive, this.next);
		}
	}
}

PageScroller.prototype.scrollToCurrentPage = function(initialize)
{
	// works because all pages are the same height
	var new_scroll_pos = this.height * this.current_page;

	if (initialize) {
		// don't animate to the position or set the window location when
		// initializing the page
		this.container.scrollTop = new_scroll_pos;
	} else {
		var base_location = location.href.split('#')[0];
		location.href = base_location + '#' + this.pages[this.current_page].id;

		var old_scroll_pos = this.container.scrollTop;

		if (this.animation && this.animation.isAnimated())
			this.animation.stop();

		this.animation = new YAHOO.util.Scroll(this.container,
			{ scroll: { from: [0, old_scroll_pos], to: [0, new_scroll_pos] } },
			0.5, YAHOO.util.Easing.easeOut);

		this.animation.animate();

		// for Safari 1.5.x bug setting window.location.
		return false;
	}
}

/**
 * Page
 */
function Page(id)
{
	this.id = id;

	this.nav = null;
	var nav_element = document.getElementById('nav-' + this.id);
	for (var i = 0; i < nav_element.childNodes.length; i++) {
		if (nav_element.childNodes[i].nodeName == 'A') {
			this.nav = nav_element.childNodes[i];
			break;
		}
	}

	this.page = document.getElementById(this.id + '-page');
	if (!this.page)
		this.page = document.getElementById(this.id);

	// reset id so updating the window location doesn't navigate to page
	this.page.id = 'page-' + this.id;
	this.page.style.overflow = 'hidden';
}

Page.prototype.setPageHeight = function(height)
{
	this.page.style.height = height + 'px';
}

Page.prototype.setNavHighlight = function(highlight)
{
	if (this.nav) {
		if (highlight)
			YAHOO.util.Dom.addClass(this.nav, 'current');
		else
			YAHOO.util.Dom.removeClass(this.nav, 'current');
	}
}
