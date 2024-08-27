<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "toasoan";
   
   $conn = new mysqli($servername, $username, $password, $dbname);
   
   if ($conn->connect_error) {
       die("Kết nối thất bại: " . $conn->connect_error);
   }
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $ten = $_POST['ten'];
       $email = $_POST['email'];
       $ngaysinh = $_POST['ngaysinh'];
       $sdt = $_POST['sdt'];
       $diachi = $_POST['diachi'];
       $gioitinh = $_POST['gioitinh'];
       $tendangnhap = $_POST['tendangnhap'];
       $matkhau = $_POST['matkhau'];
   
       $sql_taikhoan = "INSERT INTO taikhoan (TenDangNhap, MatKhau, Quyen) VALUES (?, ?, 6)";
       $stmt_taikhoan = $conn->prepare($sql_taikhoan);
       $stmt_taikhoan->bind_param("ss", $tendangnhap, $matkhau);
   
       if ($stmt_taikhoan->execute()) {
           $maTK = $stmt_taikhoan->insert_id;
   
           $sql_docgia = "INSERT INTO docgia (TenDG, Email, NgaySinh, SDT, DiaChi, GioiTinh, MaTK_DG) VALUES (?, ?, ?, ?, ?, ?, ?)";
           $stmt_docgia = $conn->prepare($sql_docgia);
           $stmt_docgia->bind_param("ssssssi", $ten, $email, $ngaysinh, $sdt, $diachi, $gioitinh, $maTK);
   
           if ($stmt_docgia->execute()) {
               header("Location: dangnhap.php");
               exit();
           } else {
               $message = "Lỗi: " . $stmt_docgia->error;
           }
   
           $stmt_docgia->close();
       } else {
           $message = "Lỗi: " . $stmt_taikhoan->error;
       }
   
       $stmt_taikhoan->close();
       $conn->close();
   }
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Đăng ký</title>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   </head>
   <body class="bg-gray-100 flex justify-center items-center min-h-screen">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
         <h2 class="text-2xl font-bold mb-6 text-center">Đăng ký</h2>
         <?php if (isset($message)): ?>
         <div class="mb-4 p-2 text-center <?php echo strpos($message, 'Lỗi') === false ? 'text-green-600' : 'text-red-600'; ?>">
            <?php echo $message; ?>
         </div>
         <?php endif; ?>
         <form method="POST" action="">
            <div class="mb-4">
               <label for="ten" class="block text-gray-700">Tên:</label>
               <input type="text" id="ten" name="ten" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-4">
               <label for="email" class="block text-gray-700">Email:</label>
               <input type="email" id="email" name="email" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-4">
               <label for="ngaysinh" class="block text-gray-700">Ngày sinh:</label>
               <input type="date" id="ngaysinh" name="ngaysinh" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-4">
               <label for="sdt" class="block text-gray-700">Số điện thoại:</label>
               <input type="text" id="sdt" name="sdt" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-4">
               <label for="diachi" class="block text-gray-700">Địa chỉ:</label>
               <input type="text" id="diachi" name="diachi" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-4">
               <label for="gioitinh" class="block text-gray-700">Giới tính:</label>
               <select id="gioitinh" name="gioitinh" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
                  <option value="Nam">Nam</option>
                  <option value="Nữ">Nữ</option>
               </select>
            </div>
            <div class="mb-4">
               <label for="tendangnhap" class="block text-gray-700">Tên đăng nhập:</label>
               <input type="text" id="tendangnhap" name="tendangnhap" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <div class="mb-6">
               <label for="matkhau" class="block text-gray-700">Mật khẩu:</label>
               <input type="password" id="matkhau" name="matkhau" class="w-full border-gray-300 rounded-lg p-2 mt-1" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Đăng ký</button>
         </form>
         <a href="dangnhap.php" class="block mt-4 text-center text-blue-500 hover:underline">Đã có tài khoản? Đăng nhập</a>
         <a href="tintuc.php" class="block mt-2 text-center text-blue-500 hover:underline">Quay lại trang chủ</a>
      </div>
   </body>
</html>