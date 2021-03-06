/**
 * Animated pagination widget
 *
 * Initializes all elements of a specific class as a pages section. Does so
 * in accessible way with options for next/prev arrows or tabbed navigation.
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
 * @copyright 2007-2010 Mozilla Foundation, 2007-2010 silverorange Inc.
 * @license   http://www.mozilla.org/MPL/MPL-1.1.html Mozilla Public License 1.1
 * @author    Michael Gauthier <mike@silverorange.com>
 */

$(document).ready(function() {

    // add easing functions
    $.extend($.easing, {
        'pagerFadeIn':  function (x, t, b, c, d) {
            return c * (t /= d) * t + b;
        },
        'pagerFadeOut': function (x, t, b, c, d) {
            return -c * (t /= d) * (t - 2) + b;
        }
    });

    // initialize pagers on this page after the document has been loaded
    $('.pager').each(function(index, el) {
        new Mozilla.Pager(this);
    });

});

// create namespace
if (typeof Mozilla == 'undefined') {
    var Mozilla = {};
}

// {{{ Mozilla.Pager

/**
 * Pager widget
 *
 * @param DOMElement container
 */
Mozilla.Pager = function(container)
{
    this.$container = $(container);

    if (!container.id) {
        container.id = 'mozilla-pager-' + Mozilla.Pager.currentId;
        Mozilla.Pager.currentId++;
    }

    var pagerContentNodes = this.$container.find('div.pager-content');
    if (!pagerContentNodes.length) {
        return;
    }

    this.$pageContainer = $(pagerContentNodes[0]);

    this.id           = container.id;
    this.pagesById    = {};
    this.pages        = [];
    this.previousPage = null;
    this.currentPage  = null;
    this.animatingOut = false;

    this.randomStartPage = (this.$container.hasClass('pager-random'));

    if (this.$container.hasClass('pager-with-tabs')) {
        var $tabs = this.$container.find('ul.pager-tabs');
        if ($tabs.length) {
            this.$tabs = $($tabs[0]);
        } else {
            this.$tabs = null;
        }
    } else {
        this.$tabs = null;
    }

    if (this.$container.hasClass('pager-with-nav')) {
        this.drawNav();
    } else {
        this.$nav = null;
    }

    this.history = (!this.$container.hasClass('pager-no-history'));

    // add pages
    var pageNodes = this.$pageContainer.children('div');

    if (this.$tabs) {
        // initialize pages with tabs
        var tabNodes = this.$tabs.children().not('.pager-not-tab');

        var index = 0;
        for (var i = 0; i < pageNodes.length; i++) {
            if (i < tabNodes.length) {
                var tabAnchorNodes = $(tabNodes[i]).children('a:first');
                if (tabAnchorNodes.length) {
                    this.addPage(new Mozilla.Page(pageNodes[i], index,
                        tabAnchorNodes[0]));

                    index++;
                }
            }
        }
    } else {
        // initialize pages without tabs
        for (var i = 0; i < pageNodes.length; i++) {
            this.addPage(new Mozilla.Page(pageNodes[i], i));
        }
    }

    if (this.$container.hasClass('pager-with-shim')) {
        this.$shim = $('<div class="pager-shim"></div>')
            .css('display', 'none')
            .css('position', 'absolute')
            .css('top', '0')
            .css('left', '0')
            .css('width', '100%')
            .css('height', '100%')
            .css('opacity', '0')
            .css('background', '#fff')
            .appendTo(this.$pageContainer);
    } else {
        this.$shim = null;
    }

    // initialize current page
    var currentPage = null;
    if (this.history) {
        var hash = location.hash;
        hash = (hash.substring(0, 1) == '#') ? hash.substring(1) : hash;
        if (hash.length) {
            currentPage = this.pagesById[hash];
            if (currentPage) {
                this.setPage(currentPage);
            }
        }

        // check if window location changes from back/forward button use
        // this doesn't matter in IE but is nice for Firefox and recent
        // recent Safari and Opera users.
        function setupInterval(pager)
        {
            var intervalFunction = function()
            {
                pager.checkLocation();
            }
            setInterval(intervalFunction,
                Mozilla.Pager.LOCATION_INTERVAL, pager);
        }
        setupInterval(this);
    }

    if (!currentPage && this.pages.length > 0) {
        if (this.randomStartPage) {
            this.setPage(this.getPseudoRandomPage());
        } else {
            var defPage = this.$pageContainer.children('.default-page:first');
            if (defPage.length) {
                var defId;
                if (defPage[0].id.substring(0, 5) == 'page-') {
                    defId = defPage[0].id.substring(5);
                } else {
                    defId = defPage[0].id;
                }
                this.setPage(this.pagesById[defId]);
            } else {
                this.setPage(this.pages[0]);
            }
        }
    }

    // initialize auto-rotation of pages
    if (this.$container.hasClass('pager-auto-rotate')) {
        var that = this;
        this.autoRotate = true;
        this.startAutoRotate();

        // prevent auto-rotate when hovering over container
        this.$container.hover(
            function(e) { that.stopAutoRotate(); },
            function(e) { if (that.autoRotate) { that.startAutoRotate(); } }
        );

        // prevent auto-rotate when focused on container
        this.$container.find('a,input,textarea').each(function (i) {
            $(this)
                .focus(function(e) {
                    that.stopAutoRotate();
                })
                .blur(function(e) {
                    if (that.autoRotate) { that.startAutoRotate(); }
                });
        });
    } else {
        this.autoRotate = false;
    }

    // add a way to access the object from outside
    Mozilla.Pager.pagers[this.id] = this;
}

// }}}

Mozilla.Pager.currentId = 1;
Mozilla.Pager.pagers    = {};

// {{{ getPseudoRandomPage()

Mozilla.Pager.prototype.getPseudoRandomPage = function()
{
    var page = null;

    if (this.pages.length > 0) {
        var now = new Date();
        page = this.pages[now.getSeconds() % this.pages.length];
    }

    return page;
}

// }}}

Mozilla.Pager.PAGE_DURATION        = 150;    // milliseconds
Mozilla.Pager.PAGE_AUTO_DURATION   = 350;    // milliseconds
Mozilla.Pager.LOCATION_INTERVAL    = 200;    // milliseconds
Mozilla.Pager.NEXT_TEXT            = 'Next';
Mozilla.Pager.PREV_TEXT            = 'Previous';
Mozilla.Pager.PAGE_NUMBER_TEXT     = '%s / %s';
Mozilla.Pager.AUTO_ROTATE_INTERVAL = 8000;  // milliseconds

// {{{ prevPageWithAnimation()

Mozilla.Pager.prototype.prevPageWithAnimation = function(duration)
{
    var index = this.currentPage.index - 1;
    if (index < 0) {
        index = this.pages.length - 1;
    }

    this.setPageWithAnimation(this.pages[index], duration);
}

// }}}
// {{{ nextPageWithAnimation()

Mozilla.Pager.prototype.nextPageWithAnimation = function(duration)
{
    var index = this.currentPage.index + 1;
    if (index >= this.pages.length) {
        index = 0;
    }

    this.setPageWithAnimation(this.pages[index], duration);
}

// }}}
// {{{ drawNav()

Mozilla.Pager.prototype.drawNav = function()
{
    var that = this;

    this.$nav = $('<div class="pager-nav">');

    // page numbers
    this.$pageNumber = $('<span class="pager-nav-page-number">');
    this.$pageNumber.appendTo(this.$nav)

    // previous insensitive
    this.$prevInsensitive = $('<span class="pager-prev-insensitive">');
    this.$prevInsensitive
        .css('display', 'none')
        .appendTo(this.$nav);

    // create previous link
    this.$prev = $(
        '<a href="#" class="pager-prev" title="' +
        Mozilla.Pager.PREV_TEXT + '"></a>'
    );

    this.$prev
        .click(function(e) {
            e.preventDefault();
            that.prevPageWithAnimation(Mozilla.Pager.PAGE_DURATION);
            that.autoRotate = false;
            that.stopAutoRotate();
        })
        .dblclick(function(e) {
            e.preventDefault();
        })
        .appendTo(this.$nav);

    // divider
    var $divider = $('<span class="pager-nav-divider">|</span>');
    $divider.appendTo(this.$nav);

    // create next link
    this.$next = $(
        '<a href="#" class="pager-next" title="' +
        Mozilla.Pager.NEXT_TEXT + '"></a>'
    );

    this.$next
        .click(function(e) {
            e.preventDefault();
            that.nextPageWithAnimation(Mozilla.Pager.PAGE_DURATION);
            that.autoRotate = false;
            that.stopAutoRotate();
        })
        .dblclick(function(e) {
            e.preventDefault();
        })
        .appendTo(this.$nav);

    // next insensitive
    this.$nextInsensitive = $('<span class="pager-next-insensitive">');
    this.$nextInsensitive
        .css('display', 'none')
        .appendTo(this.$nav);

    // add nav to the DOM
    this.$nav.insertBefore(this.$pageContainer);
}

// }}}
// {{{ checkLocation()

Mozilla.Pager.prototype.checkLocation = function()
{
    var hash = location.hash;
    hash = (hash.substring(0, 1) == '#') ? hash.substring(1) : hash;
    var currentHash = this.currentPage.id;

    if (hash && hash !== currentHash) {
        var page = this.pagesById[hash];
        if (page) {
            this.setPageWithAnimation(page, Mozilla.Pager.PAGE_DURATION);
            this.currentPage.focusTab(); // for accessibility
        }
    }
}

// }}}
// {{{ addPage()

Mozilla.Pager.prototype.addPage = function(page)
{
    this.pagesById[page.id] = page;
    this.pages.push(page);
    if (page.tab) {
        var that = this;
        page.$tab.click(function(e) {
            e.preventDefault();
            that.setPageWithAnimation(page, Mozilla.Pager.PAGE_DURATION);
            that.autoRotate = false;
            that.stopAutoRotate();
        });
    }
}

// }}}
// {{{ update()

Mozilla.Pager.prototype.update = function()
{
    if (this.$tabs) {
        this.updateTabs();
    }

    if (this.$nav) {
        this.updateNav();
    }
}

// }}}
// {{{ updateTabs()

Mozilla.Pager.prototype.updateTabs = function()
{
    var el = this.$tabs.get(0);

    var className = el.className;
    className     = className.replace(/pager-selected-[\w-]+/g, '');
    className     = className.replace(/^\s+|\s+$/g,'');
    el.className  = className;

    this.currentPage.selectTab();
    this.$container.trigger('changePage', [this.currentPage.tab]);
    this.$tabs.addClass('pager-selected-' + this.currentPage.id);
}

// }}}
// {{{ updateNav()

Mozilla.Pager.prototype.updateNav = function()
{
    // update page number
    var pageNumber = this.currentPage.index + 1;
    var pageCount  = this.pages.length;

    var text = Mozilla.Pager.PAGE_NUMBER_TEXT.replace(/%s/, pageNumber);
    text     = text.replace(/%s/, pageCount);

    this.$pageNumber.text(text);

    // update previous link
    this.setPrevSensitivity(this.currentPage.index != 0);

    // update next link
    this.setNextSensitivity(this.currentPage.index != this.pages.length - 1);
}

// }}}
// {{{ setPrevSensitivity()

Mozilla.Pager.prototype.setPrevSensitivity = function(sensitive)
{
    if (sensitive) {
        this.$prevInsensitive.css('display', 'none');
        this.$prev.css('display', 'inline');
    } else {
        this.$prevInsensitive.css('display', 'inline');
        this.$prev.css('display', 'none');
    }
}

// }}}
// {{{ setNextSensitivity()

Mozilla.Pager.prototype.setNextSensitivity = function(sensitive)
{
    if (sensitive) {
        this.$nextInsensitive.css('display', 'none');
        this.$next.css('display', 'inline');

    } else {
        this.$nextInsensitive.css('display', 'inline');
        this.$next.css('display', 'none');
    }
}

// }}}
// {{{ setPage()

Mozilla.Pager.prototype.setPage = function(page)
{
    if (this.currentPage !== page) {
        if (this.currentPage) {
            this.currentPage.deselectTab();
            this.currentPage.hide();
        }

        if (this.previousPage) {
            this.previousPage.hide();
        }

        this.previousPage = this.currentPage;

        this.currentPage = page;
        this.currentPage.show();
        this.update();
    }
}

// }}}
// {{{ setPageWithAnimation()

Mozilla.Pager.prototype.setPageWithAnimation = function(page, duration)
{
    if (this.currentPage !== page) {

        if (this.history) {
            // set address bar to current page
            var baseLocation = location.href.split('#')[0];
            location.href = baseLocation + '#' + page.id;
        }

        // deselect last selected page (not necessarily previous page)
        if (this.currentPage) {
            this.currentPage.deselectTab();
        }

        // fade out if we are not already fading out
        if (!this.animatingOut) {

            // if we were fading in, don't take as long to fade out
            if (this.$shim) {
                var startOpacity = parseFloat(this.$shim.css('opacity'));
                if (this.$shim.is(':animated')) {
                    duration = (1.0 - startOpacity) *
                        Mozilla.Pager.PAGE_DURATION;

                    this.$shim.stop(true, false);
                }
            } else if (this.$pageContainer.is(':animated')) {
                var startOpacity = parseFloat(
                    this.$pageContainer.css('opacity'));

                duration = startOpacity * Mozilla.Pager.PAGE_DURATION;
                this.$pageContainer.stop(true, false);
            }

            // only set previous page if we are not already fading out
            this.previousPage = this.currentPage;
            this.animatingOut = true;

            // Set the current page before the animation starts to prevent
            // race conditions if the duration is super low or 0. With low
            // durations, the complete handler function will run before this
            // function finishes.
            this.currentPage = page;

            var that = this;

            if (this.$shim) {

                this.$shim
                    .css('display', 'block')
                    .animate(
                        { opacity: 1 },
                        duration,
                        'pagerFadeOut',
                        function() {
                            that.fadeInPage(duration);
                        }
                    );
            } else {
                this.$pageContainer.animate(
                    { opacity: 0 },
                    duration,
                    'pagerFadeOut',
                    function() {
                        that.fadeInPage(duration);
                    }
                );
            }

        } else {
            // always set current page so the correct page fades in
            this.currentPage = page;
        }

        this.update();
    }

    // for Safari 1.5.x bug setting window.location.
    return false;
}

// }}}
// {{{ fadeInPage()

Mozilla.Pager.prototype.fadeInPage = function(duration)
{
    if (this.previousPage) {
        this.previousPage.hide();
    }

    this.currentPage.show();

    this.animatingOut = false;

    if (this.$shim) {

        var that   = this;
        this.$shim
            .animate({ opacity: 0 }, duration, 'pagerFadeOut',
                function() { that.$shim.css('display', 'none'); }
            );

    } else {
        this.$pageContainer.animate({ opacity: 1 }, duration,
            'pagerFadeOut');
    }
}

// }}}
// {{{ stopAutoRotate()

Mozilla.Pager.prototype.stopAutoRotate = function()
{
    if (this.autoRotateInterval) {
        clearInterval(this.autoRotateInterval);
        this.autoRotateInterval = null;
    }
};

// }}}
// {{{ startAutoRotate()

Mozilla.Pager.prototype.startAutoRotate = function()
{
    var setupInterval = function(pager)
    {
        var intervalFunction = function()
        {
            pager.nextPageWithAnimation(Mozilla.Pager.PAGE_AUTO_DURATION);
        }

        pager.autoRotateInterval = setInterval(intervalFunction,
            Mozilla.Pager.AUTO_ROTATE_INTERVAL, pager)
    }

    setupInterval(this);
};

// }}}
// {{{ Mozilla.Page

/**
 * Page in a pager
 *
 * @param DOMElement el
 * @param DOMElement tab
 */
Mozilla.Page = function(el, index, tab)
{
    this.el = el;

    if (!this.el.id) {
        this.el.id = 'mozilla-pager-page-' + Mozilla.Page.currentId;
        Mozilla.Page.currentId++;
    }

    // Change element id so updating the window.location does not navigate to
    // the page. This is mostly for IE.
    if (this.el.id.substring(0, 5) == 'page-') {
        this.id = this.el.id.substring(5);
    } else {
        this.id = this.el.id;
    }

    this.el.id = 'page-' + this.id;
    this.index = index;

    if (tab) {
        this.tab = tab;
        this.tab.href = '#' + this.id;
        this.$tab = $(this.tab);
    } else {
        this.tab = null;
    }

    this.$el = $(this.el);

    this.hide();
}

// }}}

Mozilla.Page.currentId = 1;

// {{{ selectTab()

Mozilla.Page.prototype.selectTab = function()
{
    if (this.tab) {
        this.$tab.addClass('selected');
    }
}

// }}}
// {{{ deselectTab()

Mozilla.Page.prototype.deselectTab = function()
{
    if (this.tab) {
        this.$tab.removeClass('selected');
    }
}

// }}}
// {{{ focusTab()

Mozilla.Page.prototype.focusTab = function()
{
    if (this.tab) {
        this.tab.focus();
    }
}

// }}}
// {{{ hide()

Mozilla.Page.prototype.hide = function()
{
    this.el.style.display = 'none';
}

// }}}
// {{{ show()

Mozilla.Page.prototype.show = function()
{
    this.el.style.display = 'block';
}

// }}}
