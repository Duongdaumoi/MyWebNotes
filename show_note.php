<!DOCTYPE html>
<html>
<head>
	<title>Show list of notes</title>
	<style>
		body {
    		font-family: Arial, sans-serif;
			background-image:url('zyro-image1.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
    	}
    	h1 {
    		color: #333;
    		font-size: 24px;
    		font-weight: bold;
    		margin-bottom: 20px;
    	}
    	ul {
    		list-style: none;
    		padding-left: 0;
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
    	.delete-btn {
    		position: absolute;
    		top: 5px;
    		right: 5px;
    		padding: 5px 10px;
    		background-color: #ff0000;
    		color: #fff;
    		border: none;
    		border-radius: 5px;
    		cursor: pointer;
    	}
        .edit-btn {
            position: absolute;
    		top: 5px;
    		right: 80px;
    		padding: 5px 10px;
    		color: #fff;
    		border: none;
    		border-radius: 5px;
    		cursor: pointer;
		    background-color: #007bff; /* sửa */
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
	<?php
	    $host = 'localhost';
	    $username = 'root';
	    $password = '';
	    $dbname = 'webnotes';
	    
	    // kết nối tới CSDL
	    $conn = mysqli_connect($host, $username, $password, $dbname);
	    
	    // Kiểm tra kết nối
	    if (!$conn) {
	        die('Kết nối thất bại: ' . mysqli_connect_error());
	    }
	    
	    // Xử lý xóa note
	    if (isset($_POST['note_id'])) {
	    	$note_id = $_POST['note_id'];
	    	$sql = "DELETE FROM notes WHERE id = $note_id";
	    	mysqli_query($conn, $sql);
	    }
	    
	    // Tạo truy vấn SQL
	    $sql = "SELECT * FROM notes";
	
	    // Thực thi truy vấn và lấy kết quả
	    $result = mysqli_query($conn, $sql);
	
	    // Kiểm tra số lượng bản ghi trả về
	    if (mysqli_num_rows($result) > 0) {
	    	echo '<h1>List of notes:</h1>';
	        echo '<ul>';
	        while ($row = mysqli_fetch_assoc($result)) {
	            echo '<li>';
	            echo '<h2>' . $row["title"] . '</h2>';
	            echo '<p>' . $row["content"] . '</p>';
	            echo '<form method="POST">';
	            echo '<input type="hidden" name="note_id" value="' . $row["id"] . '">';
	            echo '<button type="submit" class="delete-btn">Delete</button>';
	            echo '</form>';
                echo '<form style="display: inline-block;" method="POST" action="edit_note.php">';
			    echo '<input type="hidden" name="note_id" value="' . $row["id"] . '">';
			    echo '<button type="submit" class="edit-btn">Change</button>';
			    echo '</form>';
	            echo '</li>';
	        }
	    	echo '</ul>';
	    } else {
	        echo "No notes found!";
	    }
	
	    // Giải phóng bộ nhớ
	    mysqli_free_result($result);
	    // Đóng kết nối
	    mysqli_close($conn);
    ?>
    
    <script>
    	const deleteBtns = document.querySelectorAll('.delete-btn');
    	deleteBtns.forEach(btn => {
    		btn.addEventListener('click', (e) => {
    			if (!confirm('Are you sure you want to delete this note?')) {
    				e.preventDefault();
    			}
    		});
    	});
    </script>
	<a id="back-btn" href="index.php" class="btn btn-back">Back</a>
</body>
</html>