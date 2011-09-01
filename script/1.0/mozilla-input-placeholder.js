/**
 * Backwards-compatible input placeholder support
 *
 * Initializes all input elements on the page that have placeholder attributes
 * and provides backwards-compatible placeholder support to non-HTML-5
 * browsers.
 *
 * @copyright 2010 Mozilla Foundation, 2010 silverorange Inc.
 * @license   http://www.mozilla.org/MPL/MPL-1.1.html Mozilla Public License 1.1
 * @author    Michael Gauthier <mike@silverorange.com>
 */
$(document).ready(function() {

	function isPlaceholderSupported()
	{
		var i = document.createElement('input');
		return 'placeholder' in i;
	}

	function isTextareaPlaceholderSupported()
	{
		var i = document.createElement('textarea');
		return 'placeholder' in i;
	}

	function Placeholder(el)
	{
		this.el          = el;
		this.elName      = el.getAttribute('name');
		this.elValue     = el.value;
		this.placeholder = el.getAttribute('placeholder');

		$(el).focus(this.handleFocus);
		$(el).blur(this.handleBlur);

		// init
		if (this.elValue == '' && !$(el).data('focused')) {
			this.showPlaceholder();
		} else {
			this.hidePlaceholder();
		}
	}

	Placeholder.prototype.handleKeypress = function(e)
	{
		// prevent esc from undoing the clearing of placeholder text in Firefox
		if (e.which == 27) {
			this.value = '';
		}

		$(this).unbind('keypress');
	};

	Placeholder.prototype.handleFocus= function(e)
	{
		var placeholder = $(this).data('placeholder');
		placeholder.hidePlaceholder();

		placeholder.el.focus(); // IE hack to keep focus

		$(placeholder.el).data('focused', true);
	};

	Placeholder.prototype.handleBlur = function(e)
	{
		var placeholder = $(this).data('placeholder');

		if (this.value == '') {
			placeholder.showPlaceholder();
		}

		$(placeholder.el).unbind('keypress');
		$(placeholder.el).data('focused', false);
	};

	Placeholder.prototype.showPlaceholder = function(e)
	{
		if (this.isPlaceholderShown()) {
			return;
		}

		$(this.el).addClass('input-placeholder-active');

		if (this.el.hasAttribute) {
			this.el.removeAttribute('name');
		} else {
			// IE can't set the name attribute at runtime and does not have
			// the hasAttribute() method. What follows is a massive hack.
			if (this.el.name) {
				// remove name attribute
				var outerHtml = this.el.outerHTML.replace(
					'name=' + this.elName, '');

				var oldEl = this.el;
				this.el = document.createElement(outerHtml);

				// swap old el with new one
				oldEl.parentNode.insertBefore(this.el, oldEl);

				// prevent IE memory leaks
				$(oldEl).unbind();
				oldEl.parentNode.removeChild(oldEl);

				// add data properties back
				$(this.el).data('placeholder', this);

				// add event handlers back
				$(this.el).focus(this.handleFocus);
				$(this.el).blur(this.handleBlur);
			}
		}

		this.elValue = this.el.value;
		this.el.value = this.placeholder;
	};

	Placeholder.prototype.hidePlaceholder = function(e)
	{
		if (!this.isPlaceholderShown()) {
			return;
		}

		var hidden = false;

		if (this.el.hasAttribute) {
			if (!this.el.hasAttribute('name')) {
				this.el.setAttribute('name', this.elName);
				hidden = true;
			}
		} else {
			// IE can't set the name attribute at runtime and does not have
			// the hasAttribute() method. What follows is a massive hack.
			if (!this.el.getAttribute('name')) {

				// we want the same el with an name attribute added
				var outerHtml = '';
				if (this.el.nodeName == 'INPUT') {
					outerHtml = this.el.outerHTML.replace(
						/^<input /i,
						'<input name=' + this.elName + ' ');
				} else if (this.el.nodeName == 'TEXTAREA') {
					outerHtml = this.el.outerHTML.replace(
						/^<textarea /i,
						'<textarea name=' + this.elName + ' ');
				}

				var oldEl = this.el;
				this.el = document.createElement(outerHtml);

				// replace old el with new one
				oldEl.parentNode.insertBefore(this.el, oldEl);

				// prevent IE memory leaks
				$(oldEl).unbind();
				oldEl.parentNode.removeChild(oldEl);

				// add data properties back
				$(this.el).data('placeholder', this);

				// add event handlers back
				$(this.el).focus(this.handleFocus);
				$(this.el).blur(this.handleBlur);

				hidden = true;
			}
		}

		if (hidden) {
			this.el.value = this.elValue;
			$(this.el).removeClass('input-placeholder-active');
			$(this.el).keypress(this.handleKeypress);
		}
	};

	Placeholder.prototype.isPlaceholderShown = function(e)
	{
		var shown;

		if (this.el.hasAttribute) {
			shown = (!this.el.hasAttribute('name'));
		} else {
			// IE doesn't have hasAttribute, fallback to getAttribute
			// which should be correct in most cases.
			shown = (!this.el.getAttribute('name'));
		}

		return shown;
	};

	// initialize placeholders on the page
	if (!isPlaceholderSupported()) {
		$('input[placeholder]').each(function() {
			$(this).data('placeholder', new Placeholder(this))
		});
	}

	if (!isTextareaPlaceholderSupported()) {
		$('textarea[placeholder]').each(function() {
			$(this).data('placeholder', new Placeholder(this))
		});
	}
});
