/**
 * Initializes main menu on this page after the document has been loaded
 */
YAHOO.util.Event.onDOMReady(function ()
{
	var mozilla_menu_bar = new Mozilla.widget.Menu('nav-main', {
		autosubmenudisplay:   true,
		hidedelay:            750,
		iframe:               false,
		lazyload:             true,
		monitorresize:        false,
		appendtodocumentbody: true,
		constraintoviewport:  false
	});

	mozilla_menu_bar.render();
});

// create namespaces
if (typeof Mozilla == 'undefined') {
	var Mozilla = {};
}

if (typeof Mozilla.widget == 'undefined') {
	Mozilla.widget = {};
}

(function() {

	var Dom    = YAHOO.util.Dom;
	var Event  = YAHOO.util.Event;
	var Config = YAHOO.util.Config;

	Mozilla.widget.Menu = function(element, config)
	{
		this.ITEM_TYPE = Mozilla.widget.MenuItem;
		Mozilla.widget.Menu.superclass.constructor.call(this, element, config);
	};

	YAHOO.lang.extend(Mozilla.widget.Menu, YAHOO.widget.MenuBar);

	Mozilla.widget.MenuItem = function(obj, config)
	{
		this.SUBMENU_TYPE = Mozilla.widget.SubMenu;
		Mozilla.widget.MenuItem.superclass.constructor.call(this, obj, config);
	};

	YAHOO.lang.extend(Mozilla.widget.MenuItem, YAHOO.widget.MenuBarItem);

	Mozilla.widget.SubMenu = function(element, config)
	{
		this.MENU_OFFSET = 0;

		Mozilla.widget.SubMenu.superclass.constructor.call(
			this,
			element,
			config
		);

		this.header = document.getElementById('header');
		this.showEvent.subscribe(this.enforceMenuConstraints, this, true);
	};

	YAHOO.lang.extend(Mozilla.widget.SubMenu, YAHOO.widget.Menu);

	var proto = Mozilla.widget.SubMenu.prototype;

	proto.enforceMenuConstraints = function(type, args, obj)
	{
		var x = this.getMenuConstrainedX();
	};

	proto.getMenuConstrainedX = function()
	{
		var headerRegion = Dom.getRegion(this.header);

		var region = Dom.getRegion(this.element);
		var xy     = Dom.getXY(this.element);

		var rightConstraint = headerRegion.x
			+ headerRegion.width
			- this.MENU_OFFSET;

		if (xy[0] + region.width > rightConstraint) {
			Dom.setX(this.element, rightConstraint - region.width);
		}
	};

})();
