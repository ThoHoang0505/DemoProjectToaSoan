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
   
   if (!isset($_SESSION['tenDG'])) {
       header("Location: dangnhap.php");
       exit();
   }
   
   $tenDG = $_SESSION['tenDG'];
   $message = "";
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $matkhauCu = $_POST['matkhauCu'];
       $matkhauMoi = $_POST['matkhauMoi'];
       $matkhauMoiXacNhan = $_POST['matkhauMoiXacNhan'];
   
       $sql = "SELECT MatKhau FROM taikhoan t JOIN docgia d ON t.MaTK = d.MaTK_DG WHERE d.TenDG = ?";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param("s", $tenDG);
       $stmt->execute();
       $stmt->store_result();
   
       if ($stmt->num_rows > 0) {
           $stmt->bind_result($matKhauCuDB);
           $stmt->fetch();
   
           if ($matkhauCu === $matKhauCuDB) {
               if ($matkhauMoi === $matkhauMoiXacNhan) {
                   $updateSql = "UPDATE taikhoan SET MatKhau = ? WHERE MaTK = (SELECT MaTK_DG FROM docgia WHERE TenDG = ?)";
                   $stmt = $conn->prepare($updateSql);
                   $stmt->bind_param("ss", $matkhauMoi, $tenDG);
   
                   if ($stmt->execute()) {
                       $message = "Mật khẩu đã được thay đổi thành công.";
                       $messageType = "success";
                       header("Refresh:3; url=tintuc.php");
                   } else {
                       $message = "Lỗi cập nhật mật khẩu.";
                       $messageType = "error";
                   }
               } else {
                   $message = "Mật khẩu mới không khớp với xác nhận mật khẩu mới.";
                   $messageType = "error";
               }
           } else {
               $message = "Mật khẩu hiện tại không đúng.";
               $messageType = "error";
           }
       } else {
           $message = "Không tìm thấy tài khoản.";
           $messageType = "error";
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
      <title>Đổi mật khẩu</title>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   </head>
   <body class="bg-gray-100 flex justify-center items-center min-h-screen">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
         <h2 class="text-2xl font-bold mb-6 text-center">Đổi mật khẩu</h2>
         <?php if (!empty($message)): ?>
         <div class="mb-4 p-2 text-center <?php echo $messageType === 'success' ? 'text-green-600' : 'text-red-600'; ?>">
            <?php echo $message; ?>
         </div>
         <?php endif; ?>
         <form method="POST" action="">
            <div class="mb-4">
               <label for="matkhauCu" class="block text-gray-700">Mật khẩu hiện tại:</label>
               <input type="password" id="matkhauCu" name="matkhauCu" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-4">
               <label for="matkhauMoi" class="block text-gray-700">Mật khẩu mới:</label>
               <input type="password" id="matkhauMoi" name="matkhauMoi" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-6">
               <label for="matkhauMoiXacNhan" class="block text-gray-700">Xác nhận mật khẩu mới:</label>
               <input type="password" id="matkhauMoiXacNhan" name="matkhauMoiXacNhan" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Đổi mật khẩu</button>
         </form>
         <a href="tintuc.php" class="block mt-4 text-center text-blue-500 hover:underline">Quay lại trang chủ</a>
      </div>
   </body>
</html>