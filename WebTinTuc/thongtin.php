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
   
   $sql = "SELECT Email, NgaySinh, SDT, DiaChi, GioiTinh FROM docgia WHERE TenDG = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("s", $tenDG);
   $stmt->execute();
   $result = $stmt->get_result();
   
   if ($result->num_rows > 0) {
       $row = $result->fetch_assoc();
       $email = $row['Email'];
       $ngaySinh = $row['NgaySinh'];
       $sdt = $row['SDT'];
       $diaChi = $row['DiaChi'];
       $gioiTinh = $row['GioiTinh'];
   } else {
       echo "Không tìm thấy thông tin.";
       exit();
   }
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $email = $_POST['email'];
       $ngaySinh = $_POST['ngaySinh'];
       $sdt = $_POST['sdt'];
       $diaChi = $_POST['diaChi'];
       $gioiTinh = $_POST['gioiTinh'];
   
       $updateSql = "UPDATE docgia SET Email = ?, NgaySinh = ?, SDT = ?, DiaChi = ?, GioiTinh = ? WHERE TenDG = ?";
       $stmt = $conn->prepare($updateSql);
       $stmt->bind_param("ssssss", $email, $ngaySinh, $sdt, $diaChi, $gioiTinh, $tenDG);
   
       if ($stmt->execute()) {
           $message = "Thông tin đã được cập nhật thành công.";
           $messageType = "success";
           header("Refresh:3; url=tintuc.php");
       } else {
           $message = "Lỗi cập nhật thông tin.";
           $messageType = "error";
       }
       $stmt->close();
   }
   
   $conn->close();
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cập nhật thông tin</title>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   </head>
   <body class="bg-gray-100 flex justify-center items-center min-h-screen">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
         <h2 class="text-2xl font-bold mb-6 text-center">Cập nhật thông tin</h2>
         <?php if (isset($message)): ?>
         <div class="mb-4 p-2 text-center <?php echo $messageType === 'success' ? 'text-green-600' : 'text-red-600'; ?>">
            <?php echo $message; ?>
         </div>
         <?php endif; ?>
         <form method="POST" action="">
            <div class="mb-4">
               <label for="email" class="block text-gray-700">Email:</label>
               <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-4">
               <label for="ngaySinh" class="block text-gray-700">Ngày sinh:</label>
               <input type="date" id="ngaySinh" name="ngaySinh" value="<?php echo htmlspecialchars($ngaySinh); ?>" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-4">
               <label for="sdt" class="block text-gray-700">Số điện thoại:</label>
               <input type="text" id="sdt" name="sdt" value="<?php echo htmlspecialchars($sdt); ?>" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-4">
               <label for="diaChi" class="block text-gray-700">Địa chỉ:</label>
               <input type="text" id="diaChi" name="diaChi" value="<?php echo htmlspecialchars($diaChi); ?>" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-4">
               <label for="gioiTinh" class="block text-gray-700">Giới tính:</label>
               <select id="gioiTinh" name="gioiTinh" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
                  <option value="Nam" <?php if ($gioiTinh == 'Nam') echo 'selected'; ?>>Nam</option>
                  <option value="Nữ" <?php if ($gioiTinh == 'Nữ') echo 'selected'; ?>>Nữ</option>
               </select>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Cập nhật</button>
         </form>
         <a href="doimk.php" class="block mt-4 text-center text-blue-500 hover:underline">Đổi mật khẩu</a>
         <a href="tintuc.php" class="block mt-4 text-center text-blue-500 hover:underline">Quay lại trang chủ</a>
      </div>
   </body>
</html>