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
  <center><div style='height:100px; margin-top:30px; font-size:50px; font-family:Palatino Linotype; opacity:0.7' id="demo"></div>
  <div id="image">
  <?php
  echo '<img id="my-image" src="uploads/pictures/' . reset($picture_id)["id"] . "." . reset($picture_ext)["file_ext"] . '" height="500" width="500">';
   ?>
   </center>
 </div>



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
src="grid.js"

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

     return rgb(color[0],color[1],color[2]); 
   })
	.on('click', function(d) {
       d.click ++;
       if ((d.click)%4 == 0 ) { d3.select(this).style("fill","#fff"); }
	   if ((d.click)%4 == 1 ) { d3.select(this).style("fill","#2C93E8"); }
	   if ((d.click)%4 == 2 ) { d3.select(this).style("fill","#F56C4E"); }
	   if ((d.click)%4 == 3 ) { d3.select(this).style("fill","#838690"); }
    });

</script>


  </div>
</body>
</html>
