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


if (isset($_FILES["user_picture"])) {
  $upload_info = $_FILES["user_picture"];
  $upload_desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

  if ($upload_info['error'] == UPLOAD_ERR_OK) {
    $upload_name = basename($upload_info["name"]);
    $upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION) );

    $sql = "INSERT INTO pictures (file_name, file_ext, description) VALUES (:filename, :extension, :description)";
    $params = array(
      ':extension' => $upload_ext,
      ':filename' => $upload_name,
      ':description' => $upload_desc
    );
    $result = exec_sql_query($db, $sql, $params);

    if ($result) {
      $file_id = $db->lastInsertId("id");
      if (move_uploaded_file($upload_info["tmp_name"], BOX_UPLOADS_PATH . "$file_id" . "." . "$upload_ext")) {
        array_push($messages, "Your file has been uploaded.");
      }
    }
  }
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Home</title>
</head>

<body id="page1">

  <div class="form">

      <h1>Upload a picture</h1>
      <form action="." method="post" enctype="multipart/form-data">
      <ul>
        <li>
          <label>Upload a picture:</label>
          <input type="hidden" name="20000000" />
          <input type="file" name="user_picture" required>
        </li>
        <li>
          <label>Description:</label>
        </li>
          <input type="text" name="description" placeholder="Add your description!" maxlength="30"></input><br>
          <input name="submit_upload" type="submit"></input>
      </ul>
      </form>
    </div>

  <div>
    <?php
    $records = exec_sql_query($db, "SELECT * FROM pictures")->fetchAll(PDO::FETCH_ASSOC);
      $i = 0;
      echo "<tr>";
      foreach($records as $record){
        echo '<br><br><center><td><a href="individual.php?picture=' . $record["id"] .  "." . $record["file_ext"] . '"><img src="uploads/pictures/' . $record["id"] .  "." . $record["file_ext"] . "\" height=\"486\" width=\"648\" hspace=\"5\"></a></td></tr><tr><br><br><br></center>";
      }
    ?>
  </div>
</body>
</html>
