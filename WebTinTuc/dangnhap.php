<?php
   session_start();
   
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "toasoan";
   
   $conn = new mysqli($servername, $username, $password, $dbname);
   
   if ($conn->connect_error) {
       die("Kết nối thất bại: " . $conn->connect_error);
   }
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $tendangnhap = $_POST['tendangnhap'];
       $matkhau = $_POST['matkhau'];
   
       $sql = "SELECT TenDG FROM docgia d JOIN taikhoan t ON d.MaTK_DG = t.MaTK WHERE t.TenDangNhap = ? AND t.MatKhau = ?";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param("ss", $tendangnhap, $matkhau);
       $stmt->execute();
       $stmt->store_result();
   
       if ($stmt->num_rows > 0) {
           $stmt->bind_result($tenDG);
           $stmt->fetch();
           $_SESSION['tenDG'] = $tenDG;
           header("Location: tintuc.php");
           exit();
       } else {
           $message = "Tên đăng nhập hoặc mật khẩu không đúng.";
       }
   
       $stmt->close();
       $conn->close();
   }
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Đăng nhập</title>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   </head>
   <body class="bg-gray-100 flex justify-center items-center min-h-screen">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
         <h2 class="text-2xl font-bold mb-6 text-center">Đăng nhập</h2>
         <?php if (isset($message)): ?>
         <div class="mb-4 p-2 text-center text-red-600">
            <?php echo $message; ?>
         </div>
         <?php endif; ?>
         <form method="POST" action="">
            <div class="mb-4">
               <label for="tendangnhap" class="block text-gray-700">Tên đăng nhập:</label>
               <input type="text" id="tendangnhap" name="tendangnhap" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-6">
               <label for="matkhau" class="block text-gray-700">Mật khẩu:</label>
               <input type="password" id="matkhau" name="matkhau" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Đăng nhập</button>
         </form>
         <p class="mt-4 text-center text-gray-600">Chưa có tài khoản? <a href="dangky.php" class="text-blue-500 hover:underline">Đăng ký ngay</a></p>
         <a href="tintuc.php" class="block mt-4 text-center text-gray-600 hover:underline">Quay lại trang chủ</a>
      </div>
   </body>
</html>