<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Home</title>
</head>

<body id="page1">

  <div id="content-wrap">

    <h1>Upload a picture</h1>
    <form id="uploadFile" action="myAccount.php" method="post" enctype="multipart/form-data">
    <ul>
      <li>
        <label>Upload a picture:</label>
        <input type="hidden" name="20000000" />
        <input type="file" name="user_picture" required>
      </li>
      <li>
        <label>Description:</label>
      </li>
        <textarea name="description" placeholder="Add your description!" maxlength="30" cols="40" rows="5"></textarea><br>
        <button name="submit_upload" type="submit">Upload</button>
    </ul>
    </form>
  </div>


  <div id="center">
      <div id="cont">
        <noscript>
          Your browser does not support JavaScript or it is disabled.<br>
          JavaScript is needed to view this site.
        </noscript>
        <div id="dots"></div>
        <div id="next" style="display: none">
          <div class="msg">
            Awesome stuff! Now make your own and share the link.<br>
            Paste an image URL bellow and press enter.
          </div>
          <input placeholder="http://imgur.com/your_favourite_image.jpg"/>
        </div>
      </div>
    </div>

    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-17409200-2']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>

    <script type="text/javascript">

    var _fastrack_account = 'FT-1000001';

    (function(w,h) {
      if (typeof _fastrack_account !== 'string') return;
      var acc = _fastrack_account;
      try {
        var session = 'S' + Math.random().toFixed(8).substring(2);
        var num = 0;
        var now = new Date();
        var initTime = +now;
        var tzm = String(now).match(/\((\w+)\)/);
        var sx = (window.pageXOffset !== undefined) ? window.pageXOffset : (document.documentElement || document.body.parentNode || document.body).scrollLeft;
        var sy = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
        w.fastrack = function(opt) {
          var a = {
            A: acc,
            S: session,
            N: num++,
            P: document.location.href,
            L: +new Date() - initTime,
            F: w.document.referrer || 'Direct',
            C: screen.width + 'x' + screen.height,
            R: sx + 'x' + sy,
            O: now.getTimezoneOffset(),
            Z: (tzm && tzm.length === 2) ? tzm[1] : 'N/A'
          }

          if (opt) {
            var s;
            for (var j = 1; j <= 6; j++) {
              s = 'D0' + j;
              if (opt[s]) { a['D0' + j] = opt['D0' + j]; }
              s = 'M0' + j;
              if (opt[s]) { a['M0' + j] = opt['M0' + j]; }
            }
          }

          if ('innerWidth' in window) {
            a.W = w.innerWidth + 'x' + w.innerHeight;
          } else {
            var e = w.document.documentElement || w.document.body;
            a.W = w.clientWidth + 'x' + w.clientHeight;
          }
          var params = [];
          for (var k in a) params.push(encodeURIComponent(k) + "=" + encodeURIComponent(String(a[k])));
          var i = new Image();
          i.src = h + '?' + params.join('&');
          return true;
        };
      }catch(e){}
    })(window,"https://cc-int.imply.io/g/imply/ft.gif");

    </script>

    <script type="text/javascript">
      window.shownFile = 'none';

      (function() {
        var now = +new Date();
        window.gaTrack = function(type, subtype) {
          var time = Math.round((+new Date() - now) / 1000);
          function doTrack() {
            if (!window._gaq) return;
            _gaq.push(['_trackEvent', String(type), String(subtype), window.location.href, time]);
          }
          if (window._gaq) {
            doTrack()
          } else {
            setTimeout(doTrack, 1);
          }
        }
      })();

      function track(type, subtype) {
        fastrack({
          D01: version,
          D02: type,
          D03: subtype,
          D04: shownFile,
          D05: kttmAdTypes.length ? kttmAdTypes.join(',') : 'NoAdblock',
          M01: 1337 // tmp
        });
        gaTrack(type + '-' + version, subtype);
      }
    </script>

    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>

    <style>
      .chromeFrameInstallDefaultStyle {
        width: 800px;
        height: 600px;
        border: 1px solid #cccccc;
      }
    </style>

    <div id="prompt">
    </div>

    <script>
      window.inOldIE = true;
      track('OldIE', '1');

      // The conditional ensures that this code will only execute in IE,
      // Therefore we can use the IE-specific attachEvent without worry
      window.attachEvent("onload", function() {
        CFInstall.check({
          mode: "inline", // the default
          node: "prompt",
          oninstall: function() {
            track('InstalledGCF', 'OneLessRawIE');
          }
        });
      });
    </script>
    <![endif]-->

    <!--[if gte IE 9]><!-->
    <script type="text/javascript">
      // Code left intentionally unminimized for your reading pleasure.

      (function() {
        window.shownFile = 'none';

        // If an error happens I want to know about it!
        window.onerror = function(msg, url, ln) {
          msg = msg.toString();
          // In Chrome and Firefox an error on a script form a foreign domain will cause this, see link bellow:
          // http://stackoverflow.com/questions/5913978/cryptic-script-error-reported-in-javascript-in-chrome-and-firefox
          if (msg === 'Script error.' && url === '' && ln === 0) return;
          track('OnError', "'" + msg + "' in '" + url + "' @ " + ln + " /u:'" + window.navigator.userAgent + "'");
          // Track only one error per page load
          window.onerror = function() {};
        };

        // First, make sure we can run.
        if (!koala.supportsCanvas()) {
          track('NoCanvas', window.navigator.userAgent);
          alert("Sorry, KoalsToTheMax needs HTML5 Canvas support which your browser does not have. Supported browsers include Chrome, Safari, Firefox, Opera, and Internet Explorer 9, 10");
          return;
        }

        if (!koala.supportsSVG()) {
          track('NoSVG', window.navigator.userAgent);
          alert("Sorry, KoalsToTheMax needs SVG support which your browser does not have. Supported browsers include Chrome, Safari, Firefox, Opera, and Internet Explorer 9, 10");
          return;
        }

        // This is strange, track it if it happens.
        if (!window.d3) {
          track('NoD3', window.navigator.userAgent);
          alert("Some how D3 was not loaded so the site can not start. This is bad... We are investigating. Try refreshing the page and see if that helps.");
          return;
        }

        // Try you must. If there is an error report it to me.
        try {
          // btoa and atob do not handle utf-8 as I have discovered the hard way so they need to babied
          // See: https://developer.mozilla.org/en-US/docs/DOM/window.btoa#Unicode_Strings
          function utf8_to_b64(str) {
            return window.btoa(unescape(encodeURIComponent(str)));
          }

          function b64_to_utf8(str) {
            return decodeURIComponent(escape(window.atob(str)));
          }

          // Handle the custom images 'API'
          // Supported URLs are:
          // 1. DOMAIN
          //   The just the page domain / loads one of the default files
          //
          // 2. DOMAIN?BASE64==
          //   Where BASE64== is a UTF-8 base64 encoded string of one of the following things:
          //   a. An image URL
          //      Example: http://i.imgur.com/cz1Jb.jpg
          //      Use that URL image instead of the default one.
          //
          //   b. A JSON string representing an array of URLs
          //      Example: ["http://i.imgur.com/cz1Jb.jpg","http://i.imgur.com/Q5IqH.jpg"]
          //      Pick one of the images at random and use that instead of the default one.
          //
          //   c. A JSON string representing an object with the keys 'images', 'background' and 'hideNote'
          //      Example: {"background":"#000","images":["http://i.imgur.com/cz1Jb.jpg","http://i.imgur.com/Q5IqH.jpg"]}
          //      images (required): Pick one of the images at random and use that instead of the default one.
          //      background (optional): Use the value of background as the page background.
          //      hideNote (optional): Hide the mention on the bottom.
          //
          // 3. DOMAIN?image_url
          //   Where image URL is an actual image URL that will get re-encoded into base64 (2)
          //   Example: http://i.imgur.com/cz1Jb.jpg
          //
          // Note: where DOMAIN is usually http://koalastothemax.com
          function goToHidden(location, string) {
            location.href = '//' + location.host + location.pathname + '?' + utf8_to_b64(string);
          }

          function basicLoad(location) {
            var possible = ['koalas', 'koalas1', 'koalas2', 'koalas3'];
            var file = 'img/' + possible[Math.floor(Math.random() * possible.length)] + '.jpg'
            return {
              file: file,
              shownFile: location.protocol + '//' + location.host + location.pathname + file
            };
          }

          function parseUrl(location) {
            var href = location.href;
            var idx, param, file;

            idx = href.indexOf('?');
            if (idx === -1 || idx === href.length - 1) {
              return basicLoad(location); // Case 1
            }

            param = href.substr(idx + 1);
            if (!/^[a-z0-9+\/]+=*$/i.test(param)) {
              // Does not look base64
              goToHidden(location, param);
              return null;
            }

            // Case 2
            try {
              param = b64_to_utf8(param);
            } catch (e) {
              return basicLoad(location); // Invalid base64, do a basic load
            }

            try {
              param = JSON.parse(param);
            } catch (e) {
              // Case 2a
              return {
                file: param,
                shownFile: param
              };
            }

            // At this point param is a JS object
            if (Array.isArray(param) && param.length) {
              // Case 2b
              file = param[Math.floor(Math.random() * param.length)];
              return {
                file: file,
                shownFile: file
              };
            }

            if (Array.isArray(param.images) && param.images.length) {
              // Case 2c
              file = param.images[Math.floor(Math.random() * param.images.length)];
              return {
                file: file,
                shownFile: file,
                background: param.background,
                hideNote: param.hideNote
              };
            }

            // Fall though
            return basicLoad(location);
          }

          var parse = parseUrl(location);
          if (!parse) return;
          var file = parse.file;
          window.shownFile = parse.shownFile;

          if (parse.background) {
            d3.select(document.body)
              .style('background', parse.background);
          }
          if (parse.hideNote) {
            d3.select('#footer')
              .style('display', 'none');
          }

          if (/^https?:/.test(file)) {
            file = "image-server.php?url=" + file;
          }

          function onEvent(what, value) {
            track(what, value);

            if (what === 'LayerClear' && value == 0) {
              d3.select('#next')
                .style('display', null)
                .select('input')
                  .on('keydown', function() {
                    d3.select('div.err').remove();
                    if (d3.event.keyCode !== 13) return;
                    var input = d3.select(this).property('value');

                    if (input.match(/^http:\/\/.+\..+/i)) {
                      track('Submit', input);
                      d3.select('#next div.msg').text('Thinking...');
                      d3.select(this).style('display', 'none');
                      setTimeout(function() {
                        goToHidden(location, input);
                      }, 750);
                    } else {
                      d3.select('#next').selectAll('div.err').data([0])
                        .enter().append('div')
                        .attr('class', "err")
                        .text("That doesn't appear to be a valid image URL. [Hint: it should start with 'http://']")
                    }
                  });
            }
          }

          var img = new Image();
          img.onload = function() {
            var colorData;
            try {
              colorData = koala.loadImage(this);
            } catch (e) {
              colorData = null;
              track('BadLoad', "Msg: '" + e.message + "' file: '" + file + "'");
              alert("Sorry, KoalsToTheMax could not load the image '" + file + "'");
              setTimeout(function() {
                window.location.href = domian;
              }, 750);
            }
            if (colorData) {
              koala.makeCircles("#dots", colorData, onEvent);
              track('GoodLoad', 'Yay');
            }
          };
          img.src = file;
        } catch (e) {
          track('Problemo', String(e.message));
        }

        // Local download functionality
        var saveNumber = 0;

      })();
    </script>
    <!--<![endif]-->

</body>



<script>
"use strict"

/*
* Made with love by Vadim Ogievetsky for Annie Albagli (Valentine's Day 2011)
* Powered by Mike Bostock's D3
*
* For me on GitHub:  https://github.com/vogievetsky/KoalasToTheMax
* License: MIT  [ http://koalastothemax.com/LICENSE ]
*
* If you are reading this then I have an easter egg for you:
* You can use your own custom image as the source, simply type in:
* http://koalastothemax.com?<your image url>
* e.g.
* http://koalastothemax.com?http://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/Flag_of_the_United_Kingdom.svg/200px-Flag_of_the_United_Kingdom.svg.png
*
* also if you want to use a custom image and want people to guess what it is
* (without seeing the url) then you can type the url in base64 encoding like so:
* http://koalastothemax.com?<your image url in base64>
* e.g.
* http://koalastothemax.com?YXN0bGV5LmpwZw==
* (try to guess the image above)
*/

var koala = {
  version: '1.8.2'
};

(function() {
  function array2d(w, h) {
    var a = [];
    return function(x, y, v) {
      if (x < 0 || y < 0) return void 0;
      if (arguments.length === 3) {
        // set
        return a[w * x + y] = v;
      } else if (arguments.length === 2) {
        // get
        return a[w * x + y];
      } else {
        throw new TypeError("Bad number of arguments");
      }
    }
  }

  // Find the color average of 4 colors in the RGB colorspace
  function avgColor(x, y, z, w) {
    return [
      (x[0] + y[0] + z[0] + w[0]) / 4,
      (x[1] + y[1] + z[1] + w[1]) / 4,
      (x[2] + y[2] + z[2] + w[2]) / 4
    ];
  }

  koala.supportsCanvas = function() {
    var elem = document.createElement('canvas');
    return !!(elem.getContext && elem.getContext('2d'));
  };

  koala.supportsSVG = function() {
    return !!document.createElementNS && !!document.createElementNS('http://www.w3.org/2000/svg', "svg").createSVGRect;
  };

  function Circle(vis, xi, yi, size, color, children, layer, onSplit) {
    this.vis = vis;
    this.x = size * (xi + 0.5);
    this.y = size * (yi + 0.5);
    this.size = size;
    this.color = color;
    this.rgb = d3.rgb(color[0], color[1], color[2]);
    this.children = children;
    this.layer = layer;
    this.onSplit = onSplit;
  }

  Circle.prototype.isSplitable = function() {
    return this.node && this.children
  }

  Circle.prototype.split = function() {
    if (!this.isSplitable()) return;
    d3.select(this.node).remove();
    delete this.node;
    Circle.addToVis(this.vis, this.children);
    this.onSplit(this);
  }

  Circle.prototype.checkIntersection = function(startPoint, endPoint) {
    var edx = this.x - endPoint[0],
        edy = this.y - endPoint[1],
        sdx = this.x - startPoint[0],
        sdy = this.y - startPoint[1],
        r2  = this.size / 2;

    r2 = r2 * r2; // Radius squared

    // End point is inside the circle and start point is outside
    return edx * edx + edy * edy <= r2 && sdx * sdx + sdy * sdy > r2;
  }

  Circle.addToVis = function(vis, circles, init) {
    var circle = vis.selectAll('.nope').data(circles)
      .enter().append('circle');

    if (init) {
      // Setup the initial state of the initial circle
      circle = circle
        .attr('cx',   function(d) { return d.x; })
        .attr('cy',   function(d) { return d.y; })
        .attr('r', 4)
        .attr('fill', '#ffffff')
          .transition()
          .duration(1000);
    } else {
      // Setup the initial state of the opened circles
      circle = circle
        .attr('cx',   function(d) { return d.parent.x; })
        .attr('cy',   function(d) { return d.parent.y; })
        .attr('r',    function(d) { return d.parent.size / 2; })
        .attr('fill', function(d) { return String(d.parent.rgb); })
        .attr('fill-opacity', 0.68)
          .transition()
          .duration(300);
    }

    // Transition the to the respective final state
    circle
      .attr('cx',   function(d) { return d.x; })
      .attr('cy',   function(d) { return d.y; })
      .attr('r',    function(d) { return d.size / 2; })
      .attr('fill', function(d) { return String(d.rgb); })
      .attr('fill-opacity', 1)
      .each('end',  function(d) { d.node = this; });
  }

  // Main code
  var vis,
      maxSize = 512,
      minSize = 4,
      dim = maxSize / minSize;

  koala.loadImage = function(imageData) {
    // Create a canvas for image data resizing and extraction
    var canvas = document.createElement('canvas').getContext('2d');
    // Draw the image into the corner, resizing it to dim x dim
    canvas.drawImage(imageData, 0, 0, dim, dim);
    // Extract the pixel data from the same area of canvas
    // Note: This call will throw a security exception if imageData
    // was loaded from a different domain than the script.
    return canvas.getImageData(0, 0, dim, dim).data;
  };

  koala.makeCircles = function(selector, colorData, onEvent) {
    onEvent = onEvent || function() {};

    var splitableByLayer = [],
        splitableTotal = 0,
        nextPercent = 0;

    function onSplit(circle) {
      // manage events
      var layer = circle.layer;
      splitableByLayer[layer]--;
      if (splitableByLayer[layer] === 0) {
        onEvent('LayerClear', layer);
      }

      var percent = 1 - d3.sum(splitableByLayer) / splitableTotal;
      if (percent >= nextPercent) {
        onEvent('PercentClear', Math.round(nextPercent * 100));
        nextPercent += 0.05;
      }
    }

    // Make sure that the SVG exists and is empty
    if (!vis) {
      // Create the SVG ellement
      vis = d3.select(selector)
        .append("svg")
          .attr("width", maxSize)
          .attr("height", maxSize);
    } else {
      vis.selectAll('circle')
        .remove();
    }

    // Got the data now build the tree
    var finestLayer = array2d(dim, dim);
    var size = minSize;

    // Start off by populating the base (leaf) layer
    var xi, yi, t = 0, color;
    for (yi = 0; yi < dim; yi++) {
      for (xi = 0; xi < dim; xi++) {
        color = [colorData[t], colorData[t+1], colorData[t+2]];
        finestLayer(xi, yi, new Circle(vis, xi, yi, size, color));
        t += 4;
      }
    }

    // Build up successive nodes by grouping
    var layer, prevLayer = finestLayer;
    var c1, c2, c3, c4, currentLayer = 0;
    while (size < maxSize) {
      dim /= 2;
      size = size * 2;
      layer = array2d(dim, dim);
      for (yi = 0; yi < dim; yi++) {
        for (xi = 0; xi < dim; xi++) {
          c1 = prevLayer(2 * xi    , 2 * yi    );
          c2 = prevLayer(2 * xi + 1, 2 * yi    );
          c3 = prevLayer(2 * xi    , 2 * yi + 1);
          c4 = prevLayer(2 * xi + 1, 2 * yi + 1);
          color = avgColor(c1.color, c2.color, c3.color, c4.color);
          c1.parent = c2.parent = c3.parent = c4.parent = layer(xi, yi,
            new Circle(vis, xi, yi, size, color, [c1, c2, c3, c4], currentLayer, onSplit)
          );
        }
      }
      splitableByLayer.push(dim * dim);
      splitableTotal += dim * dim;
      currentLayer++;
      prevLayer = layer;
    }

    // Create the initial circle
    Circle.addToVis(vis, [layer(0, 0)], true);

    // Interaction helper functions
    function splitableCircleAt(pos) {
      var xi = Math.floor(pos[0] / minSize),
          yi = Math.floor(pos[1] / minSize),
          circle = finestLayer(xi, yi);
      if (!circle) return null;
      while (circle && !circle.isSplitable()) circle = circle.parent;
      return circle || null;
    }

    function intervalLength(startPoint, endPoint) {
      var dx = endPoint[0] - startPoint[0],
          dy = endPoint[1] - startPoint[1];

      return Math.sqrt(dx * dx + dy * dy);
    }

    function breakInterval(startPoint, endPoint, maxLength) {
      var breaks = [],
          length = intervalLength(startPoint, endPoint),
          numSplits = Math.max(Math.ceil(length / maxLength), 1),
          dx = (endPoint[0] - startPoint[0]) / numSplits,
          dy = (endPoint[1] - startPoint[1]) / numSplits,
          startX = startPoint[0],
          startY = startPoint[1];

      for (var i = 0; i <= numSplits; i++) {
        breaks.push([startX + dx * i, startY + dy * i]);
      }
      return breaks;
    }

    function findAndSplit(startPoint, endPoint) {
      var breaks = breakInterval(startPoint, endPoint, 4);
      var circleToSplit = []

      for (var i = 0; i < breaks.length - 1; i++) {
        var sp = breaks[i],
            ep = breaks[i+1];

        var circle = splitableCircleAt(ep);
        if (circle && circle.isSplitable() && circle.checkIntersection(sp, ep)) {
          circle.split();
        }
      }
    }

    // Handle mouse events
    var prevMousePosition = null;
    function onMouseMove() {
      var mousePosition = d3.mouse(vis.node());

      // Do nothing if the mouse point is not valid
      if (isNaN(mousePosition[0])) {
        prevMousePosition = null;
        return;
      }

      if (prevMousePosition) {
        findAndSplit(prevMousePosition, mousePosition);
      }
      prevMousePosition = mousePosition;
      d3.event.preventDefault();
    }

    // Handle touch events
    var prevTouchPositions = {};
    function onTouchMove() {
      var touchPositions = d3.touches(vis.node());
      for (var touchIndex = 0; touchIndex < touchPositions.length; touchIndex++) {
        var touchPosition = touchPositions[touchIndex];
        var prevTouchPosition = prevTouchPositions[touchPosition.identifier]
        if (prevTouchPosition) {
          findAndSplit(prevTouchPosition, touchPosition);
        }
        prevTouchPositions[touchPosition.identifier] = touchPosition;
      }
      d3.event.preventDefault();
    }

    function onTouchEnd() {
      var touches = d3.event.changedTouches;
      for (var touchIndex = 0; touchIndex < touches.length; touchIndex++) {
        var touch = touches.item(touchIndex);
        prevTouchPositions[touch.identifier] = null;
      }
      d3.event.preventDefault();
    }

    // Initialize interaction
    d3.select(document.body)
      .on('mousemove.koala', onMouseMove)
      .on('touchmove.koala', onTouchMove)
      .on('touchend.koala', onTouchEnd)
      .on('touchcancel.koala', onTouchEnd);
  };
})();

</script>
</html>
