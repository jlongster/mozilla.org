var PLAYER_HEIGHT = '385';
var PLAYER_WIDTH = '640';
var PLAYER_CLOSE_TEXT = 'Close';
var PLAYER_NOFLASH_TEXT = 'This video requires <a ';
	PLAYER_NOFLASH_TEXT += 'href="http://www.adobe.com/go/getflashplayer">Adobe ';
	PLAYER_NOFLASH_TEXT += 'Flash Player</a>.';
var PLAYER_ALT_TEXT = '<a href="http://videos.mozilla.org/firefox3/screencast1/en.ogg" class="alt-video-link">';
	PLAYER_ALT_TEXT += 'Download video in Ogg Theora format</a></div>';

function FirefoxVideoLaunch(id, video_url)
{
	this.video_url = video_url;

	this.overlay = document.createElement('div');
	this.overlay.className = 'firefox-video-overlay';
	this.overlay.style.display = 'none';

	this.video_container = document.createElement('div');
	this.video_container.className = 'firefox-video-window';
	this.video_container.style.display = 'none';

	this.opened = false;

	// add overlay and preview image to document
	var video_link = document.getElementById(id);
	video_link.parentNode.appendChild(this.overlay);
	video_link.parentNode.appendChild(this.video_container);

	var links = YAHOO.util.Dom.getElementsByClassName('launch-video');

	for(var i = 0; i < links.length; i++)
		YAHOO.util.Event.addListener(links[i], 'click',
			this.handleClick, this, true);

	YAHOO.util.Event.addListener(this.overlay, 'click',
		this.handleClick, this, true);
}

FirefoxVideoLaunch.prototype.buildVideoPlayer = function()
{

	var player = '<div class="firefox-video-player-close">';
	player += '<a id="firefox-video-player-close" href="#">';
	player += PLAYER_CLOSE_TEXT;
	player += '</a></div>';
	player += '<div class="firefox-video-player">';
	player += '<object type="application/x-shockwave-flash" ';
	player += 'style="width: ' + PLAYER_WIDTH + 'px; height: ' + PLAYER_HEIGHT + 'px;" ';
	player += 'wmode="transparent" data="' + this.video_url + '">';
	player += '<param name="movie" value="' + this.video_url + '"></param>';
	player += '<param name="wmode" value="transparent"></param>';
	player += '<p id="no-flash-text">' + PLAYER_NOFLASH_TEXT + '</p>';
	player += '</object>';
	player += '<div>' + PLAYER_ALT_TEXT + '</div>';

	return player;
}

FirefoxVideoLaunch.prototype.open = function()
{
	this.video_container.style.display = 'block';
	this.overlay.style.display = 'block';

	// hide the language form because its flydown won't render right in IE
	var hide_form = document.getElementById('lang_form');
	if (hide_form)
		hide_form.style.display = 'none';

	this.video_container.style.top =
		(YAHOO.util.Dom.getDocumentScrollTop() +
		((YAHOO.util.Dom.getViewportHeight() - 570) / 2)) + 'px';

	this.video_container.innerHTML = this.buildVideoPlayer();
	this.overlay.style.height = YAHOO.util.Dom.getDocumentHeight() + 'px';

	YAHOO.util.Event.addListener(
		document.getElementById('firefox-video-player-close'), 'click',
		this.handleClick, this, true);

	this.opened = true;
}

FirefoxVideoLaunch.prototype.close = function()
{
	this.overlay.style.display = 'none';
	this.video_container.style.display = 'none';

	// clear the video content so IE will stop playing the audio
	this.video_container.innerHTML = '';

	var hide_form = document.getElementById('lang_form');
	if (hide_form)
		hide_form.style.display = 'block';

	this.opened = false;
}

FirefoxVideoLaunch.prototype.handleClick = function(e)
{
	YAHOO.util.Event.preventDefault(e);

	if (this.opened)
		this.close();
	else
		this.open();
}
