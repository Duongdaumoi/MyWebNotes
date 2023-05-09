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

	// Xử lý khi submit form
	if (isset($_POST['submit'])) {
		$note_id = $_POST['note_id'];
		$note_title = $_POST['note_title'];
		$note_content = $_POST['note_content'];

		$sql = "UPDATE notes SET title='$note_title', content='$note_content' WHERE id=$note_id";
		if (mysqli_query($conn, $sql)) {
			header('Location: show_note.php');
			exit();
		} else {
			echo 'Lỗi khi sửa ghi chú: ' . mysqli_error($conn);
		}
	}

	// Kiểm tra ID của note cần edit
	if (isset($_POST['note_id'])) {
		$note_id = $_POST['note_id'];
		$sql = "SELECT * FROM notes WHERE id=$note_id";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			$note_title = $row['title'];
			$note_content = $row['content'];
		} else {
			echo 'Không tìm thấy ghi chú.';
			exit();
		}

		mysqli_free_result($result);
	}

	// Đóng kết nối
	mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit note</title>
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
		form {
			background-color: #fff;
			border: 1px solid #ccc;
			border-radius: 5px;
			padding: 10px;
			margin-bottom: 20px;
		}
		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
		}
		input, textarea {
			display: block;
			width: 100%;
			padding: 5px;
			margin-bottom: 10px;
			border: 1px solid #ccc;
			border-radius: 3px;
			box-sizing: border-box;
			font-size: 14px;
			font-family: Arial, sans-serif;
		}
		.btn-group {
			margin-top: 10px;
		}
		.btn {
			padding: 5px 10px;
			background-color: #007bff;
			color: #fff;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			font-size: 14px;
			font-family: Arial, sans-serif;
		}
		.btn-cancel {
			background-color: #ccc;
			margin-right: 10px;
		}
		.btn:hover {
			background-color: #0069d9;
		}
	</style>
</head>
<body>
	<h1>Edit note</h1>
	<form method="POST">
		<input type="hidden" name="note_id" value="<?php echo $note_id; ?>">
		<label for="note_title">Title</label>
		<input type="text" id="note_title" name="note_title" value="<?php echo $note_title; ?>">
		<label for="note_content">Content</label>
		<textarea id="note_content" name="note_content" rows="5"><?php echo $note_content; ?></textarea>
		<div class="btn-group">
			<button type="submit" name="submit" class="btn">Save</button>
			<a href="show_note.php" class="btn btn-cancel">Cancel</a>
		</div>
	</form>
</body>
</html>
