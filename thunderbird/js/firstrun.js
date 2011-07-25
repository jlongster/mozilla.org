function InitializeContent()
{
	YAHOO.util.Dom.addClass('content-box', 'box-setup');

	if (navigator.platform.indexOf('Mac') != -1) {
		// update images
		var images = ['page-1-screen',  'page-2-screen',  'page-3-screen',  'page-4-screen'];
		var srcs =   ['mac-page-1.jpg', 'mac-page-2.jpg', 'mac-page-3.jpg', 'mac-page-4.jpg'];
		for (var i = 0; i < images.length; i++) {
			var img_element = document.getElementById(images[i]);
			if (img_element)
				img_element.src = srcs[i];
		}

		// update text
		if (document.getElementById('new-tab-info') != null) {
			var tab_element = document.getElementById('new-tab-info');
			tab_element.replaceChild(
				document.createTextNode('Hold down the Command key (⌘) and click on a link'),
				tab_element.firstChild);
		}

		if (document.getElementById('tab-info') != null) {
			var tab_element = document.getElementById('tab-info');
			tab_element.replaceChild(
				document.createTextNode('Or, open a fresh tab yourself by pressing command-T (⌘T).'),
				tab_element.firstChild);
		}
	}
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

	// initialize to first page
	this.setPage(0);
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
				this.setPage(page_number);
			},
			this, true);
	}
}

PageScroller.prototype.prevPage = function()
{
	this.setPage(this.current_page - 1);
}

PageScroller.prototype.nextPage = function()
{
	this.setPage(this.current_page + 1);
}

PageScroller.prototype.setPage = function(page_number)
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
	this.scrollToCurrentPage();
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

PageScroller.prototype.scrollToCurrentPage = function()
{
	var old_scroll_pos = this.container.scrollTop;

	// works because all pages are the same height
	var new_scroll_pos = this.height * this.current_page;

	if (this.animation && this.animation.isAnimated())
		this.animation.stop();

	this.animation = new YAHOO.util.Scroll(this.container,
		{ scroll: { from: [0, old_scroll_pos], to: [0, new_scroll_pos] } },
		0.5, YAHOO.util.Easing.easeOut);

	this.animation.animate();
}

/**
 * Page
 */
function Page(id)
{
	this.id = id;

	this.nav = null;
	var nav_element = document.getElementById('nav-page-' + this.id);
	for (var i = 0; i < nav_element.childNodes.length; i++) {
		if (nav_element.childNodes[i].nodeName == 'A') {
			this.nav = nav_element.childNodes[i];
			break;
		}
	}

	this.page = document.getElementById('pc-page-' + this.id);
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
