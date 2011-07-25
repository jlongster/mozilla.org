/**
 * This file contains Flash-detection routines adapted from SWFObject and
 * originally licensed under the MIT license.
 *
 * See http://blog.deconcept.com/flashobject/
*/

// create namespace
if (typeof Mozilla == 'undefined') {
	function Mozilla() {}
}

Mozilla.VideoPlayer = function(id, video_url, alt_url)
{
	this.id        = id;
	this.video_url = video_url;
	this.alt_url   = alt_url;
	this.opened    = false;

	YAHOO.util.Event.onDOMReady(this.init, this, true);
}

Mozilla.VideoPlayer.height = '385';
Mozilla.VideoPlayer.width = '640';

Mozilla.VideoPlayer.close_text  = 'Close';

Mozilla.VideoPlayer.no_flash_text = 'This video requires ' +
	'<a href="http://www.adobe.com/go/getflashplayer">Adobe Flash Player</a>.';

Mozilla.VideoPlayer.alt_text = 'View video in Ogg Theora format';

Mozilla.VideoPlayer.prototype.init = function()
{
	this.overlay = document.createElement('div');
	this.overlay.className = 'mozilla-video-player-overlay';
	this.overlay.style.display = 'none';

	this.video_container = document.createElement('div');
	this.video_container.className = 'mozilla-video-player-window';
	this.video_container.style.display = 'none';

	// add overlay and preview image to document
	var body = document.getElementsByTagName('body')[0];
	body.appendChild(this.overlay);
	body.appendChild(this.video_container);

	// set up event handlers
	var video_link = document.getElementById(this.id);
	YAHOO.util.Event.on(video_link, 'click',
		function(e)
		{
			YAHOO.util.Event.preventDefault(e);
			this.open();
		}, this, true);

	var preview_link = document.getElementById(this.id + '-preview');
	if (preview_link) {
		YAHOO.util.Event.on(preview_link, 'click',
			function (e)
			{
				YAHOO.util.Event.preventDefault(e);
				this.open();
			}, this, true);
	}
}

Mozilla.VideoPlayer.prototype.clearVideoPlayer = function()
{
	YAHOO.util.Event.purgeElement(this.video_container, true, 'click');
	while (this.video_container.childNodes.length > 0) {
		this.video_container.removeChild(this.video_container.firstChild);
	}
}

Mozilla.VideoPlayer.prototype.drawVideoPlayer = function()
{
	this.clearVideoPlayer();

	var close_div = document.createElement('div');
	close_div.className = 'mozilla-video-player-close';

	var close_link = document.createElement('a');
	close_link.href = '#';
	YAHOO.util.Event.on(close_link, 'click',
		function (e)
		{
			YAHOO.util.Event.preventDefault(e);
			this.close();
		}, this, true);

	close_link.appendChild(document.createTextNode(
		Mozilla.VideoPlayer.close_text));

	close_div.appendChild(close_link);
	this.video_container.appendChild(close_div);


	var video_div = document.createElement('div');
	video_div.className = 'mozilla-video-player-content';

	if (Mozilla.VideoPlayer.flash_verison.isValid([7, 0, 0])) {
		var content = '<object type="application/x-shockwave-flash" style="' +
			'width: ' + Mozilla.VideoPlayer.width + 'px; ' +
			'height: ' + Mozilla.VideoPlayer.height + 'px;" ' +
			'wmode="transparent" data="' + this.video_url + '">' +
			'<param name="movie" value="' + this.video_url + '" />' +
			'<param name="wmode" value="transparent" />' +
			'</object>';
	} else {
		var content =
			'<div class="mozilla-video-player-no-flash">' +
			Mozilla.VideoPlayer.no_flash_text +
			'</div>';
	}

	content +=
		'<div><a href="' + this.alt_url + '">' +
		Mozilla.VideoPlayer.alt_text +
		'</a></div>';


	this.video_container.appendChild(video_div);
	video_div.innerHTML = content;
}

Mozilla.VideoPlayer.prototype.open = function()
{
	// hide the language form because its flydown won't render right in IE
	var hide_form = document.getElementById('lang_form');
	if (hide_form)
		hide_form.style.display = 'none';

	this.overlay.style.height = YAHOO.util.Dom.getDocumentHeight() + 'px';
	this.overlay.style.display = 'block';

	this.video_container.style.display = 'block';

	this.drawVideoPlayer();

	this.video_container.style.top =
		(YAHOO.util.Dom.getDocumentScrollTop() +
		((YAHOO.util.Dom.getViewportHeight() - 570) / 2)) + 'px';

	this.opened = true;
}

Mozilla.VideoPlayer.prototype.close = function()
{
	this.overlay.style.display = 'none';
	this.video_container.style.display = 'none';

	// clear the video content so IE will stop playing the audio
	this.clearVideoPlayer();

	var hide_form = document.getElementById('lang_form');
	if (hide_form)
		hide_form.style.display = 'block';

	this.opened = false;
}

Mozilla.VideoPlayer.prototype.toggle = function()
{
	if (this.opened)
		this.close();
	else
		this.open();
}

Mozilla.VideoPlayer.getFlashVersion = function()
{
	var version = new Mozilla.FlashVersion([0, 0, 0]);
	if (navigator.plugins && navigator.mimeTypes.length) {
		var x = navigator.plugins['Shockwave Flash'];
		if (x && x.description) {
			// strip text to get version number only
			version = x.description.replace(/([a-zA-Z]|\s)+/, '');

			// convert revisions and beta to dots
			version = version.replace(/(\s+r|\s+b[0-9]+)/, '.');

			// get version
			version = new Mozilla.FlashVersion(version.split('.'));
		}
	} else {
		if (navigator.userAgent && navigator.userAgent.indexOf('Windows CE') >= 0) {
			var axo = true;
			var flash_version = 3;
			while (axo) {
				// look for greatest installed version starting at 4
				try {
					major_version++;
					axo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash.' + major_version);
					version = new Mozilla.FlashVersion([major_version, 0, 0]);
				} catch (e) {
					axo = null;
				}
			}
		} else {
			try {
				var axo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash.7');
			} catch (e) {
				try {
					var axo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash.6');
					version = new Mozilla.FlashVersion([6, 0, 21]);
					axo.AllowScriptAccess = 'always';
				} catch (e) {
					if (version.major == 6) {
						return version;
					}
				}
				try {
					axo = new ActiveXObject('ShockwaveFlash.ShockwaveFlash');
				} catch (e) {}
			}
			if (axo != null) {
				version = new Mozilla.FlashVersion(axo.GetVariable('$version').split(' ')[1].split(','));
			}
		}
	}
	return version;
};

Mozilla.FlashVersion = function(version)
{
	this.major = version[0] != null ? parseInt(version[0]) : 0;
	this.minor = version[1] != null ? parseInt(version[1]) : 0;
	this.rev   = version[2] != null ? parseInt(version[2]) : 0;
};

Mozilla.FlashVersion.prototype.isValid = function(version)
{
	if (version instanceof Array) {
		version = new Mozilla.FlashVersion(version);
	}

	if (this.major < version.major) {
		return false;
	}
	if (this.major > version.major) {
		return true;
	}
	if (this.minor < version.minor) {
		return false;
	}
	if (this.minor > version.minor) {
		return true;
	}
	if (this.rev < version.rev) {
		return false;
	}
	return true;
};

// init flash version
Mozilla.VideoPlayer.flash_verison = Mozilla.VideoPlayer.getFlashVersion();
