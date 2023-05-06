
<?php 
  session_start();
  if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Web Notes</title>
  <style>
    body{
      font-family: Arial, sans-serif;
      background-image:url('zyro-image1.png');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }
    h1 {
      color: #333;
      text-align: center;
    }
    form {
      margin: 20px auto;
      width: 50%;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 3px 6px rgba(0,0,0,.1);
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 10px;
    }
    input[type="text"],
    textarea {
      padding: 10px;
      margin-bottom: 20px;
      width: 100%;
      border-radius: 3px;
      border: 1px solid #ccc;
      font-size: 16px;
      box-sizing: border-box;
    }
    button[type="submit"] {
      display: block;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
    }
    button[type="submit"]:hover {
      background-color: #555;
    }
    #notes {
      margin: 20px auto;
      width: 50%;
      list-style-type: none;
      padding: 0;
    }
    #notes li {
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 3px 6px rgba(0,0,0,.1);
      margin-bottom: 20px;
      padding: 20px;
    }
    #notes li h2 {
      margin-top: 0;
    }
    #notes li p {
      margin-top: 10px;
    }
    #back-btn {
      position: fixed;
    	top: 10px;
  		right: 10px;
    	background-color: #4CAF50;
    	color: white;
  		font-size: 16px;
    	padding: 10px 20px;
    	border: none;
  		border-radius: 4px;
    	cursor: pointer;
    }
    #back-btn:hover {
    	background-color: #3e8e41;
	  }
  </style>
</head>
<body>
  <h1>Web Notes</h1>
  
  <form method="post" action="add_note.php">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title">
    <br>
    <label for="content">Content:</label>
    <textarea id="content" name="content"></textarea>
    <br>
    <button type="submit">Add Note</button>
  </form>
  <form method="post" action="show_note.php">
    <button type="submit">Show Note</button>
  </form>
  <form method="post" action="find_note.php">
    <button type="submit">Find Note</button>
  </form>
  <form method="post">
    <button type="submit" name="logout" id="back-btn" class="btn btn-back">Logout</button>
  </form>
</body>
</html>
