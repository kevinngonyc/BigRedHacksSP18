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

</body>
</html>
