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
$pos = strpos($_SERVER[ 'QUERY_STRING' ], '=');
$picture_name = substr($_SERVER[ 'QUERY_STRING' ], $pos + 1, strlen($_SERVER[ 'QUERY_STRING' ]) - $pos);
var_dump($picture_name);

$pic_sql = 'SELECT pictures.id FROM pictures WHERE pictures.id = :picture_name';
$pic_params = array(':picture_name' => substr($picture_name, 0, 1));
$picture_id = exec_sql_query($db, $pic_sql, $pic_params)->fetchAll(PDO::FETCH_ASSOC);
$ext_sql = 'SELECT pictures.file_ext FROM pictures WHERE pictures.id = :picture_name';
$picture_ext = exec_sql_query($db, $ext_sql, $pic_params)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <script src="//code.jquery.com/jquery-3.1.0.min.js"></script>
  <script src="jquery.imgexplode.js"></script>


  <title>Individual</title>
</head>

<body id="page1">
  <center><div style="height:100px; margin-top:30px; font-size:50px; font-family:Palatino Linotype; opacity:0.7" id="demo"></div>
  <div id="image">
  <?php
  echo '<img id="my-image" src="uploads/pictures/' . reset($picture_id)["id"] . "." . reset($picture_ext)["file_ext"] . '" height="500" width="500">';
   ?>
   </center>
 </div>


<center>
 <script>
    var img = document.getElementById('my-image');
    var timerDone = 0
    startTimer(30,'demo');
    function startTimer(duration, display) {
        var timer = duration, seconds;
        setInterval(function () {
            seconds = parseInt(timer % 60, 10);
            seconds = seconds < 10 ? "0" + seconds : seconds;
            document.getElementById(display).innerHTML = seconds + 's';
            if (--timer < 0) {
                timerDone = 1;
                timer = 0;
            }
        }, 1000);
    }
    if (timerDone > 0) {
      $img.explode();
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
	.attr("r", 1)
  .transition().duration(30000)
	.attr("r", function(d) { return d.width/2; })


</script>
</center>

  </div>
</body>
</html>
