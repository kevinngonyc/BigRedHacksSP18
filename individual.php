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
  <div id="image">
  <?php
  echo '<img src="uploads/pictures/' . reset($picture_id)["id"] . "." . reset($picture_ext)["file_ext"] . '" height="648" width="864">';
   ?>
 </div>
  </div>
</body>
</html>
