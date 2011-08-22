/**
 * Temporary fallback notice for Firefox for Bug 678442
 *
 * This code is licensed under the Mozilla Public License 1.1.
 *
 * Portions adapted from the jQuery Easing plugin written by Robert Penner and
 * used under the following license:
 *
 *   Copyright 2001 Robert Penner
 *   All rights reserved.
 *
 *   Redistribution and use in source and binary forms, with or without
 *   modification, are permitted provided that the following conditions are
 *   met:
 *
 *   - Redistributions of source code must retain the above copyright notice,
 *     this list of conditions and the following disclaimer.
 *   - Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in the
 *     documentation and/or other materials provided with the distribution.
 *   - Neither the name of the author nor the names of contributors may be
 *     used to endorse or promote products derived from this software without
 *    specific prior written permission.
 *
 *   THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 *   "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED
 *   TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 *   PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 *   CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *   EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 *   PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 *   PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
 *   LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *   NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 *   SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @copyright 2011 Mozilla Foundation, 2011 silverorange Inc.
 * @license   http://www.mozilla.org/MPL/MPL-1.1.html Mozilla Public License 1.1
 * @author    Michael Gauthier <mike@silverorange.com>
 */

(function() {

    var sprintf = function(str)
    {
        for (var i = 1; i < arguments.length; i++) {
            str = str.replace(/%s/, arguments[i]);
        }
        return str;
    };

    var getString = function(variable, defaultValue)
    {
        if (typeof window[variable] === 'undefined') {
            return defaultValue;
        }

        return window[variable];
    };

    var isJquery = (typeof jQuery !== 'undefined');

    // preload background
    var img = new Image();
    img.src = '/img/covehead/firefox/fallback-creature.png';

    if (isJquery) {
        jQuery.extend(jQuery.easing, {
            'slideOut':  function (x, t, b, c, d) {
                return c * (t /= d) * t + b;
            },
            'slideIn': function (x, t, b, c, d) {
                return -c * (t /= d) * (t - 2) + b;
            }
        });
    }

    var setCookie = function(name, value, path, expire)
    {
        if (expire) {
            var expdate = new Date();
            expdate.setDate(expdate.getDate() + expire);
            expire = ';expires=' + expdate.toUTCString();
        } else {
            expire = '';
        }

        if (path) {
            path = ';path=' + path;
        } else {
            path = '';
        }

        document.cookie = name + '=' + escape(value) + expire + path;
    };

    var getCookie = function(name)
    {
        if (document.cookie.length === 0) {
            return null;
        }

        var start = document.cookie.indexOf(name + '=');

        if (start === -1) {
            return null;
        }

        start += name.length + 1;
        end    = document.cookie.indexOf(';', start);
        if (end === -1) {
            end = document.cookie.length;
        }

        return unescape(document.cookie.substring(start, end));
    };

    var fallbackWrapper;
    var fallbackContainer;

    var initNotice = function()
    {
        fallbackWrapper = document.createElement('div');
        fallbackWrapper.id = 'fallback-notice';

        var fallbackHeading       = document.createElement('h2');
        fallbackHeading.innerHTML = sprintf(
            getString(
                'v3FallbackP2',
                'Looking for Firefox? <a href="%s" class="btn">Download it here.</a> ' +
                'It’s fast and free!'
            ), 
            getString('v3FallbackLink', '/firefox/')
        );

        var fallbackMessage = document.createElement('div');
        fallbackMessage.className = 'message';
        fallbackMessage.appendChild(fallbackHeading);

        fallbackContainer = document.createElement('div');
        fallbackContainer.className = 'container';
        fallbackContainer.appendChild(fallbackMessage);

        fallbackWrapper.appendChild(fallbackContainer);

        var fallbackParent = document.getElementById('header');
            document.body.insertBefore(fallbackWrapper, fallbackParent);

        // add tracking codes
        var links = fallbackWrapper.getElementsByTagName('a');
        for (var i = 0; i < links.length; i++) {
            links[i].href += ''; }

        showNotice();
    };

    var showNotice = function()
    {
        if (isJquery) {
            var speed = 500;
            var easing = 'slideIn';

            var $container = $(fallbackContainer);
            $container.css('visibility', 'hidden');

            var $wrapper = $(fallbackWrapper);
            $wrapper
                .css('height', '0')
                .css('overflow', 'visible')
                .css('display', 'block');

            var height = $container.height() + 30;
            $wrapper.css('overflow', 'hidden');
            $container
                .css('top', -height + 'px')
                .css('visibility', 'visible');

            $wrapper.animate(
                { 'height' : height }, speed, easing,
                function() {
                    $wrapper.css('height', 'auto');
                }
            );
            $container.animate({ 'top' : 0 }, speed, easing);
        } else {
            fallbackWrapper.style.display = 'block';
        }
    };


    setTimeout(function() {
        if (document.getElementById('header')) {
            initNotice();
        }
    }, 1500);

})();
