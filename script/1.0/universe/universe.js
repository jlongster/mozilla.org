$(document).ready(function() {

    // namespaces
    if (typeof org == 'undefined') {
        var org = {};
    }
    if (typeof org.mozilla == 'undefined') {
        org.mozilla = {};
    }

    /**
     * Required global function for the JIT library
     */
    function addEvent(obj, type, fn)
    {
        if (obj.addEventListener) {
            obj.addEventListener(type, fn, false);
        } else {
            obj.attachEvent('on' + type, fn);
        }
    }

    /**
     * Mozilla.org site-map namespace.
     */
    org.mozilla.SiteMap = {

        $graph: $('#universe-graph'), // cached reference to the graph DOM node
        $panel: $('#universe-panel'), // cached reference to the panel DOM node

        data:         {},
        selectedNode: null,
        rootNode:     null,
        tip:          {
            blocked:    false,
            nodeId:     null,
            hoverTimer: null,
            fadeTimer:  null
        },

        TIP_SHOW_PERIOD:  200,
        TIP_HIDE_PERIOD:  500,
        TIP_HOVER_PERIOD: 200,
        TIP_FADE_PERIOD:  400,

        LOCATION_INTERVAL: 0.20,

        MOVE_PERIOD: 750,

        /**
         * Gets the width of the graph area for dynamic sizing of the site-map
         */
        getWidth: function()
        {
            // extra 200 px is to give space for hover labels
            return Math.max(550, org.mozilla.SiteMap.$graph.width() - 200);
        },

        /**
         * Gets the height of the viewport for dynamic sizing of the site-map
         */
        getHeight: function()
        {
            if (document.all) {
                return Math.max(550, document.body.offsetHeight - 200);
            } else {
                return Math.max(550, window.innerHeight - 200);
            }
        },

        /**
         * This is the default configuration sent to the graphing object
         *
         * These options are used to override the default options as set in the
         * JIT library.
         */
        defaultConfig:
        {
            hideLabels:    false,
            levelDistance: 250,

            Node: {
                overridable: true,
                type:        'circle',
                color:       '#ddd',
                dim:         5
            },

            Edge: {
                overridable: true,
                lineWidth:   2,
                color:       '#666'
            },

            onBeforeCompute: function(node)
            {
                org.mozilla.SiteMap.hideTip();
            },

            onAfterCompute: function()
            {
            },

            onBeforePlotNode: function(node)
            {
                // visible-level node styles
                if (node._depth < 2) {
                    node.data.$color = '#999';
                } else {
                    node.data.$color = '#ddd';
                }
            },

            onAfterPlotNode: function(node)
            {
                org.mozilla.SiteMap.$graph.trigger('cm:graph:ready');
            },

            /**
             * Makes line styles vary based on visible level of nodes
             */
            onBeforePlotLine: function(adj)
            {
                var a = adj.nodeFrom, b = adj.nodeTo;

                if (typeof a.data.$type == 'undefined') {
                    adj.nodeFrom.data.$type = 'circle';
                }
                if (typeof b.data.$type == 'undefined') {
                    adj.nodeTo.data.$type = 'circle';
                }
                if (typeof a.data.$tt == 'undefined') {
                    adj.nodeFrom.data.$tt = a.data.$type;
                }
                if (typeof b.data.$tt == 'undefined') {
                    adj.nodeTo.data.$tt = b.data.$type;
                }

                // visible-level line styles
                if (   Math.abs(a._depth - b._depth) == 1
                    && (a._depth == 0 || b._depth == 0)
                ) {
                    adj.data.$color = '#999';
                    adj.data.$lineWidth = 2;
                } else {
                    adj.data.$color = '#ddd';
                    adj.data.$lineWidth = 1;
                }
            },

            /**
             * Add the name of the node in the correponding label and a click
             * handler to move the graph.
             *
             * This method is called once, on label creation.
             */
            onCreateLabel: function(domElement, node)
            {
                domElement.innerHTML = '<h5>' + node.name + '</h5>';

                // rename ids so back/forward buttons don't shift the page
                // position
                domElement.id = 'node-' + domElement.id;

                $(domElement)
                    .mouseover(function(e)
                    {
                        // a high-priority tip is already being displayed,
                        // don't show this node's tip
                        if (org.mozilla.SiteMap.tip.blocked) {
                            return;
                        }

                        //org.mozilla.SiteMap.$panel.mouseover();

                        if (org.mozilla.SiteMap.tip.fadeTimer) {
                            clearTimeout(org.mozilla.SiteMap.tip.fadeTimer);
                            org.mozilla.SiteMap.fadeTimer = null;
                        }

                        clearTimeout(org.mozilla.SiteMap.tip.hoverTimer);
                        org.mozilla.SiteMap.tip.hoverTimer = null;

                        org.mozilla.SiteMap.tip.hoverTimer = setTimeout(
                            function()
                            {
                                clearTimeout(org.mozilla.SiteMap.tip.hoverTimer);
                                org.mozilla.SiteMap.tip.hoverTimer = null;
                                org.mozilla.SiteMap.showTip(node);
                            }, org.mozilla.SiteMap.TIP_HOVER_PERIOD);
                    })
                    .mouseout(function(e)
                    {
                        // a high-priority tip is already being displayed,
                        // don't hide the tip
                        if (org.mozilla.SiteMap.tip.blocked) {
                            return;
                        }

                        //org.mozilla.SiteMap.$panel.mouseout();

                        if (org.mozilla.SiteMap.tip.hoverTimer) {
                            clearTimeout(org.mozilla.SiteMap.tip.hoverTimer);
                            org.mozilla.SiteMap.tip.hoverTimer = null;
                        }

                        clearTimeout(org.mozilla.SiteMap.tip.fadeTimer);
                        org.mozilla.SiteMap.tip.fadeTimer = null;

                        org.mozilla.SiteMap.tip.fadeTimer = setTimeout(
                            function()
                            {
                                clearTimeout(org.mozilla.SiteMap.tip.fadeTimer);
                                org.mozilla.SiteMap.tip.fadeTimer = null;
                                org.mozilla.SiteMap.hideTip();
                            }, org.mozilla.SiteMap.TIP_FADE_PERIOD);
                    })
                    .click(function(e)
                    {
                        org.mozilla.SiteMap.selectNode(node);
                    });
            },

            /**
             * Change some label DOM properties.
             *
             * This method is called each time a label is plotted.
             */
            onPlaceLabel: function(domElement, node)
            {
                var $domElement = $(domElement);
                var style       = domElement.style;

                if (   typeof node.data.icon !== 'undefined'
                    && domElement.getElementsByTagName('img').length === 0
                ) {
                    $domElement
                        .addClass('imaged')
                        .prepend(
                            '<span class="logo"><img src="' + node.data.icon +
                            '" alt="' + node.name + '" /></span>');

                    node.data.$dim = 0;
                }

                // add informational-level-specific CSS hook
                domElement.className = domElement.className.replace(
                    /([^-])level-[0-9]+/,
                    '$1'
                );
                $domElement.addClass('level-' + node.data.treeDepth);

                // add visible-level-specific CSS hook
                domElement.className = domElement.className.replace(
                    /visible-level-[0-9]+/,
                    ''
                );

                // bump level of important nodes
                var depth = (node.data.important) ?
                    Math.max(0, node._depth - 1) : node._depth;

                $domElement.addClass('visible-level-' + depth);

                // Horizontally center the label. Note: this needs to be done
                // after visible-level CSS hook so nodes are visible in the DOM
                // when positioned.
                var left   = parseInt(style.left);
                var w      = domElement.offsetWidth;
                style.left = (left - w / 2) + 'px';

            }

        }, // end defaultConfig

        selectNode: function(node)
        {
            if (org.mozilla.SiteMap.selectedNode !== node) {

                // set address bar to current node
                var baseLocation = location.href.split('#')[0];
                location.href = baseLocation + '#' + node.id;

                org.mozilla.SiteMap.selectedNode = node;

                var $centerNode, centerId, parentId;
                var $node = $('#node-' + node.id);

                // count adjacencies to detect leaf nodes
                var adjCount = 0;
                $.each(node.adjacencies, function(i, v) {
                    adjCount++;
                    parentId = i;
                    if (adjCount > 1) {
                        return false;
                    }
                });

                // add selected CSS hook
                $('.selected').removeClass('selected');
                $node.addClass('selected');

                // if leaf node, center on parent node
                centerId = (adjCount === 1) ? parentId : node.id;
                $centerNode = $('#node-' + centerId);
                // only center if node is not already centered
                if (!$centerNode.hasClass('centered')) {
                    $('.centered').removeClass('centered');
                    $centerNode.addClass('centered');
                    org.mozilla.SiteMap.hypertree.onClick(centerId);
                }

                org.mozilla.SiteMap.showTip(node);
            }
        },

        /**
         * Displays available information about a node in the panel
         */
        showTip: function(node, block)
        {
            if (org.mozilla.SiteMap.hypertree.busy) {
                return;
            }

            // check if this tip is already shown
            if (org.mozilla.SiteMap.tip.nodeId == node.id) {
                return;
            }

            if (block) {
                org.mozilla.SiteMap.tip.blocked = true;
            }

            org.mozilla.SiteMap.tip.nodeId = node.id;

            var nodeElement = document.getElementById('node-' + node.id);
            var left        = parseInt(nodeElement.style.left);
            var top         = parseInt(nodeElement.style.top);

            org.mozilla.SiteMap.$panel.stop();
            org.mozilla.SiteMap.$panel.css('display', 'block');

            var tipContent = '';

            if (typeof node.data.image !== 'undefined') {
                tipContent += '<img src="' + node.data.image + '" ' +
                    'alt="' + node.name + '" />';
            }

            tipContent += '<h3>' + node.name + '</h3>';

            if (typeof node.data.url !== 'undefined') {
                tipContent += '<a href="' + node.data.url + '" ' +
                    'class="panel-link" target="_blank">' +
                    node.data.url.replace('http://', '') + '</a>';
            }

            if (typeof node.data.desc !== 'undefined') {
                tipContent += '<p>' + node.data.desc.join('</p><p>') + '</p>';
            }

            org.mozilla.SiteMap.$panel.html(tipContent);

            var h = org.mozilla.SiteMap.$panel.height();

            org.mozilla.SiteMap.$panel.animate({
                'opacity': 1,
                'left': (left - 3),
                'top': (top - h - 26)
            }, org.mozilla.SiteMap.TIP_SHOW_PERIOD, function() {
                org.mozilla.SiteMap.tip.blocked = false;
            });

        },

        /**
         * Hides the tip panel
         */
        hideTip: function(node)
        {
            org.mozilla.SiteMap.tip.nodeId = null;
            org.mozilla.SiteMap.$panel.stop();
            org.mozilla.SiteMap.$panel.animate({
                'opacity': 0
            }, org.mozilla.SiteMap.TIP_HIDE_PERIOD, function() {
                org.mozilla.SiteMap.$panel.css('display', 'none');
            });

        },

        /**
         * Simple function to load and handle the JSON data for the site-map
         */
        loadData: function()
        {
            $.ajax({
                url: org.mozilla.SiteMap.dataUrl,
                dataType: 'json',
                success: function(data) {
                    org.mozilla.SiteMap.data =
                        org.mozilla.SiteMap.cleanData(data);

                    org.mozilla.SiteMap.$graph.trigger('cm:data:ready');
                }
            });
        },

        /**
         * Sets tree depth data for each node, JIT doesn't seem to provide this
         * information.
         */
        cleanData: function(data)
        {
            var traverse = function(node, depth)
            {
                node.data.treeDepth = depth;
                if (node.children && node.children instanceof Array) {
                    for (var i = 0; i < node.children.length; i++) {
                        traverse(node.children[i], depth + 1);
                    }
                }
            }

            traverse(data, 0);

            return data;
        },

        /**
         * Loads, sizes, and positions the site-map in a dynamically created
         * Canvas object
         */
        loadGraph: function()
        {
            var w = org.mozilla.SiteMap.getWidth();
            var h = org.mozilla.SiteMap.getHeight();

            // choose smallest side and make graph a perfect circle
            var dim = Math.min(w, h);

            org.mozilla.SiteMap.$graph.css('height', dim);
            org.mozilla.SiteMap.$graph.css('width', dim);

            org.mozilla.SiteMap.canvas = new Canvas(
                'universe-canvas',
                {
                    // Where to append the canvas widget
                    injectInto: 'universe-graph',
                    width: dim,
                    height: dim
                }
            );

            org.mozilla.SiteMap.hypertree = new Hypertree(
                org.mozilla.SiteMap.canvas,
                org.mozilla.SiteMap.config
            );

            org.mozilla.SiteMap.hypertree.fx.config.duration =
                org.mozilla.SiteMap.MOVE_PERIOD;

            // load data
            org.mozilla.SiteMap.hypertree.loadJSON(org.mozilla.SiteMap.data);

            // compute positions and plot.
            org.mozilla.SiteMap.hypertree.refresh();

            org.mozilla.SiteMap.hypertree.controller.onAfterCompute();
            org.mozilla.SiteMap.$graph.trigger('cm:graph:ready');

            // select root node
            var id, node;
            for (id in org.mozilla.SiteMap.hypertree.graph.nodes) {
                node = org.mozilla.SiteMap.hypertree.graph.nodes[id];
                if (node && node.data.treeDepth == 0) {
                    org.mozilla.SiteMap.rootNode = node;
                    break;
                }
            }
            if (org.mozilla.SiteMap.rootNode) {
                $('#node-' + org.mozilla.SiteMap.rootNode.id)
                    .addClass('selected');

                org.mozilla.SiteMap.selectedNode = org.mozilla.SiteMap.rootNode;
            }
        },

        /**
         * Reset the site-map
         */
        reset: function()
        {
            if (typeof org.mozilla.SiteMap.hypertree !== 'undefined') {
                org.mozilla.SiteMap.hypertree.fx.clearLabels();
            }
            org.mozilla.SiteMap.config = org.mozilla.SiteMap.defaultConfig;
            org.mozilla.SiteMap.config.levelDistance = Math.max(
                150,
                org.mozilla.SiteMap.getHeight() / 6
            );
        },

        /**
         * Initializes tip panel mouseover and mouseout effects
         */
        initPanel: function()
        {
            org.mozilla.SiteMap.$panel
                .mouseover(function(e)
                {
                    if (org.mozilla.SiteMap.tip.fadeTimer) {
                        clearTimeout(org.mozilla.SiteMap.tip.fadeTimer);
                        org.mozilla.SiteMap.fadeTimer = null;
                    }

                    if (org.mozilla.SiteMap.tip.hoverTimer) {
                        clearTimeout(org.mozilla.SiteMap.tip.hoverTimer);
                        org.mozilla.SiteMap.tip.hoverTimer = null;
                    }
                })
                .mouseout(function(e)
                {
                    // high-priority tip is being displayed, don't fade
                    // out the tip
                    if (org.mozilla.SiteMap.tip.blocked) {
                        return;
                    }

                    if (org.mozilla.SiteMap.tip.hoverTimer) {
                        clearTimeout(org.mozilla.SiteMap.tip.hoverTimer);
                        org.mozilla.SiteMap.tip.hoverTimer = null;
                    }

                    if (org.mozilla.SiteMap.tip.fadeTimer) {
                        clearTimeout(org.mozilla.SiteMap.tip.fadeTimer);
                        org.mozilla.SiteMap.tip.fadeTimer = null;
                    }

                    org.mozilla.SiteMap.tip.fadeTimer = setTimeout(
                        function()
                        {
                            clearTimeout(org.mozilla.SiteMap.tip.fadeTimer);
                            org.mozilla.SiteMap.tip.fadeTimer = null;
                            org.mozilla.SiteMap.hideTip();
                        }, org.mozilla.SiteMap.TIP_FADE_PERIOD);
                });
        },

        initLocation: function()
        {
            var hash   = location.hash;
            var nodeId = (hash.substring(0, 1) == '#') ?
                hash.substring(1) : hash;

            if (nodeId) {
                var node = org.mozilla.SiteMap.hypertree.graph.getNode(nodeId);
                if (node) {
                    // set animation period to 0 to jump right to the node
                    org.mozilla.SiteMap.hypertree.fx.config.duration = 0;

                    org.mozilla.SiteMap.selectNode(node);

                    org.mozilla.SiteMap.hypertree.fx.config.duration =
                        org.mozilla.SiteMap.MOVE_PERIOD;
                }
            }

            // check if window location changes from back/forward button use
            // this doesn't matter in IE and Opera but is nice for Firefox and
            // recent Safari users.
            setInterval(function() {
                org.mozilla.SiteMap.updateLocation();
            }, org.mozilla.SiteMap.LOCATION_INTERVAL * 1000);
        },

        updateLocation: function()
        {
            var currentNodeId = org.mozilla.SiteMap.selectedNode.id;
            var hash          = location.hash;
            var nodeId        = (hash.substring(0, 1) == '#') ?
                hash.substring(1) : hash;

            if (!nodeId) {
                nodeId = org.mozilla.SiteMap.rootNode.id;
            }

            if (nodeId !== currentNodeId) {
                var node = org.mozilla.SiteMap.hypertree.graph.getNode(nodeId);
                if (node) {
                    // animate faster on back/forward button action
                    org.mozilla.SiteMap.hypertree.fx.config.duration =
                        Math.floor(org.mozilla.SiteMap.MOVE_PERIOD / 2);

                    org.mozilla.SiteMap.selectNode(node);

                    org.mozilla.SiteMap.hypertree.fx.config.duration =
                        org.mozilla.SiteMap.MOVE_PERIOD;
                }
            }
        },

        /**
         * Initializes the site-map
         *
         * @param String dataUrl the URL of the data JSON for the site-map.
         */
        _init: function(dataUrl)
        {
            org.mozilla.SiteMap.dataUrl = dataUrl;
            org.mozilla.SiteMap.defaultTip = org.mozilla.SiteMap.$panel.html();

            org.mozilla.SiteMap.$graph.bind(
                'cm:data:ready',
                function() {
                    org.mozilla.SiteMap.loadGraph();
                    org.mozilla.SiteMap.initLocation();
                }
            );

            org.mozilla.SiteMap.$graph.bind(
                'cm:reset',
                org.mozilla.SiteMap.reset
            );

            org.mozilla.SiteMap.initPanel();
            org.mozilla.SiteMap.reset();
            org.mozilla.SiteMap.loadData();
        }

    };

    org.mozilla.SiteMap._init('/script/1.0/universe/data.json');

});
