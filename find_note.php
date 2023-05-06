<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Note</title>
  <style>
    body {
      font-family: Arial, sans-serif;
		  background-image:url('zyro-image1.png');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }

    h1 {
      text-align: center;
      margin-top: 50px;
    }

    form {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      margin-top: 30px;
      margin-bottom: 30px;
    }

    label {
      font-size: 18px;
      margin-right: 10px;
    }

    input[type="text"] {
      font-size: 18px;
      padding: 10px;
      border-radius: 5px;
      border: none;
      margin-right: 10px;
    }

    button[type="submit"] {
      background-color: #007bff;
      color: #fff;
      font-size: 18px;
      padding: 10px 20px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }

    h3 {
      font-size: 24px;
      margin-top: 50px;
    }

    p {
      font-size: 16px;
      line-height: 1.5;
      margin-bottom: 50px;
    }

    .no-results {
      text-align: center;
      font-size: 18px;
      margin-top: 30px;
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
    li {
  		position: relative;
    	margin-bottom: 10px;
    	padding: 10px;
  		background-color: #fff;
  		border: 1px solid #ccc;
  		border-radius: 5px;
    }
    li p {
  		margin: 0;
  	}
    li span {
  		color: #666;
  		font-size: 12px;
  	}
  </style>
</head>
<body>
  <h1>Search Note</h1>

  <!-- Form tìm kiếm -->
  <form method="post" action="">
    <label for="search_title">Search by title:</label>
    <input type="text" id="search_title" name="search_title">
    <button type="submit" name="search">Search</button>
    <a id="back-btn" href="index.php" class="btn btn-back">Back</a>
  </form>

  <!-- Kết quả tìm kiếm -->
  <?php
  // Đã submit form, xử lý tìm kiếm và hiển thị kết quả
  if (isset($_POST['search'])) {
    $search_title = $_POST['search_title'];

    // Kết nối đến cơ sở dữ liệu
    $host = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_name = 'webnotes';

    $conn = mysqli_connect($host, $db_username, $db_password, $db_name);

    // Query tìm kiếm note
    $query = "SELECT * FROM notes WHERE title LIKE '%$search_title%'";
    $result = mysqli_query($conn, $query);

    // Hiển thị kết quả
    if (mysqli_num_rows($result) > 0) {
      while ($note = mysqli_fetch_assoc($result)) {
        echo '<li>';
        echo '<h2>' . $note['title'] . '</h2>';
        echo '<p>' . $note['content'] . '</p>';
        echo '</li>';
      }
    } else {
      echo "<p class='no-results'>No matching notes found.</p>";
    }
    // Đóng kết nối
    mysqli_close($conn);
  }
  ?>
</body>
</html>
