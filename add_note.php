<?php
$servername = "localhost"; // Tên server của bạn
$username = "root"; // Tên đăng nhập của bạn
$password = ""; // Mật khẩu của bạn
$dbname = "webnotes"; // Tên cơ sở dữ liệu của bạn

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<?php
session_start();

if (isset($_POST['title']) && isset($_POST['content'])) {
  // Kiểm tra người dùng đã đăng nhập chưa
  if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
  }
  
  // Lấy dữ liệu từ form và thêm vào cơ sở dữ liệu
  $title = $_POST['title'];
  $content = $_POST['content'];
  $created_at = date('Y-m-d H:i:s');
  $user = $_SESSION['user'];

  $sql = "INSERT INTO notes (title, content, created_at, id)
          VALUES ('$title', '$content', '$created_at', '$user')";
  
  if ($conn->query($sql) === TRUE) {
    header('Location: index.php');
    exit;
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>

