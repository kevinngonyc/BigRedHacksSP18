<?php
const BOX_UPLOADS_PATH = "uploads/pictures/";

$messages = array();

// Record a message to display to the user.
function record_message($message) {
  global $messages;
  array_push($messages, $message);
}

// Write out any messages to the user.
function print_messages() {
  global $messages;
  foreach ($messages as $message) {
    echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
  }
}

// show database errors during development.
function handle_db_error($exception) {
  echo '<p><strong>' . htmlspecialchars('Exception : ' . $exception->getMessage()) . '</strong></p>';
}

// execute an SQL query and return the results.
function exec_sql_query($db, $sql, $params = array()) {
  try {
    $query = $db->prepare($sql);
    if ($query and $query->execute($params)) {
      return $query;
    }
  } catch (PDOException $exception) {
    handle_db_error($exception);
  }
  return NULL;
}

// open connection to database
function open_or_init_sqlite_db($db_filename, $init_sql_filename) {
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db_init_sql = file_get_contents($init_sql_filename);
    if ($db_init_sql) {
      try {
        $result = $db->exec($db_init_sql);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        handle_db_error($exception);
      }
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return NULL;
}

$db = open_or_init_sqlite_db('gallery.sqlite', "init/init.sql");

$picture_name = $_GET['picture'];

$pic_sql = 'SELECT pictures.id FROM pictures WHERE pictures.file_name = :picture_name';
$pic_params = array(':picture_name' => $picture_name);
$picture_id = exec_sql_query($db, $pic_sql, $pic_params)->fetchAll(PDO::FETCH_ASSOC);

$ext_sql = 'SELECT pictures.file_ext FROM pictures WHERE pictures.file_name = :picture_name';
$picture_ext = exec_sql_query($db, $ext_sql, $pic_params)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Individual</title>
</head>

<body id="page1">
<<<<<<< HEAD
  <div id="image">
=======
  <center><div style='height:100px; margin-top:30px; font-size:50px; font-family:Palatino Linotype; opacity:0.7' id="demo"></div>
  <div id="image" hidden>
>>>>>>> b0ac39da6e858cb30bab03d3c44c7ca399e268e9
  <?php
  echo '<img src="uploads/pictures/' . reset($picture_id)["id"] . "." . reset($picture_ext)["file_ext"] . '" height="648" width="864">';
   ?>
 </div>

<<<<<<< HEAD
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

   })();
 </script>


=======

<center>
 <script>
    startTimer(59,'demo');
    function startTimer(duration, display) {

        var timer = duration, seconds;
        setInterval(function () {
            seconds = parseInt(timer % 60, 10);

            seconds = seconds < 10 ? "0" + seconds : seconds;

            document.getElementById(display).innerHTML = seconds + 's';

            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }
</script>

<div id="grid"></div>
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3.v4.min.js"></script>

<script>
var img = document.getElementById('my-image');
console.log(img)
var canvas = document.createElement('canvas');
canvas.width = img.width;
canvas.height = img.height;
canvas.getContext('2d').drawImage(img, 0, 0, img.width, img.height);

function gridData() {
	var data = new Array();
	var xpos = 1; //starting xpos and ypos at 1 so the stroke will show when we make the grid below
	var ypos = 1;
	var width = 10;
	var height = 10;
	var click = 0;

	// iterate for rows
	for (var row = 0; row < 50; row++) {
		data.push( new Array() );

		// iterate for cells/columns inside rows
		for (var column = 0; column < 50; column++) {
			data[row].push({
				x: xpos,
				y: ypos,
				width: width,
				height: height,
				click: click
			})
			// increment the x position. I.e. move it over by 50 (width variable)
			xpos += width;
		}
		// reset the x position after a row is complete
		xpos = 1;
		// increment the y position for the next row. Move it down 50 (height variable)
		ypos += height;
	}
	return data;
}

var gridData = gridData();
// I like to log the data to the console for quick debugging
console.log(gridData);

var grid = d3.select("#grid")
	.append("svg")
	.attr("width","500px")
	.attr("height","500px");

var row = grid.selectAll(".row")
	.data(gridData)
	.enter().append("g")
	.attr("class", "row");

var column = row.selectAll(".square")
	.data(function(d) { return d; })
	.enter().append("circle")
	.attr("class","dot")
	.attr("cx", function(d) { return d.x + d.width/2; })
	.attr("cy", function(d) { return d.y + d.width/2; })
	.attr("r", function(d) { return d.width/3; })
	.style("fill", function(d) {
     var color = canvas.getContext('2d').getImageData(d.x + d.width/2, d.y + d.width/2, 1, 1).data;

     function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
    }

    function rgbToHex(r, g, b) {
        return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
    }

     return rgbToHex(color[0],color[1],color[2]);
   })
	.on('click', function(d) {
       d.click ++;
       if ((d.click)%4 == 0 ) { d3.select(this).style("fill","#fff"); }
	   if ((d.click)%4 == 1 ) { d3.select(this).style("fill","#2C93E8"); }
	   if ((d.click)%4 == 2 ) { d3.select(this).style("fill","#F56C4E"); }
	   if ((d.click)%4 == 3 ) { d3.select(this).style("fill","#838690"); }
    });

</script>
</center>
>>>>>>> b0ac39da6e858cb30bab03d3c44c7ca399e268e9

  </div>
</body>
</html>
