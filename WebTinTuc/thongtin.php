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
   
   $message = "";
   $messageType = "";
   
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateInfo'])) {
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
   
   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changePassword'])) {
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
      <style>
         .modal {
         display: none;
         position: fixed;
         z-index: 50;
         left: 0;
         top: 0;
         width: 100%;
         height: 100%;
         overflow: auto;
         background-color: rgba(0, 0, 0, 0.5);
         }
         .modal-content {
         background-color: #fefefe;
         margin: 15% auto;
         padding: 20px;
         border: 1px solid #888;
         width: 80%;
         max-width: 500px;
         border-radius: 10px;
         }
         .close {
         color: #aaa;
         float: right;
         font-size: 28px;
         font-weight: bold;
         }
         .close:hover,
         .close:focus {
         color: black;
         text-decoration: none;
         cursor: pointer;
         }
      </style>
   </head>
   <body class="bg-gray-100 flex justify-center items-center min-h-screen">
      <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
         <h2 class="text-2xl font-bold mb-6 text-center">Cập nhật thông tin</h2>
         <?php if ($message): ?>
         <div class="mb-4 p-2 text-center <?php echo $messageType === 'success' ? 'text-green-600' : 'text-red-600'; ?>">
            <?php echo $message; ?>
         </div>
         <?php endif; ?>
         <form method="POST" action="">
            <input type="hidden" name="updateInfo" value="1">
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
         <a id="changePasswordLink" href="#" class="block mt-4 text-center text-blue-500 hover:underline">Đổi mật khẩu</a>
         <a href="tintuc.php" class="block mt-4 text-center text-blue-500 hover:underline">Quay lại trang chủ</a>
      </div>
      <div id="changePasswordModal" class="modal">
         <div class="modal-content rounded-lg">
            <span class="close">&times;</span>
            <h2 class="text-2xl font-bold mb-6 text-center">Đổi mật khẩu</h2>
            <form method="POST" action="">
               <input type="hidden" name="changePassword" value="1">
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
         </div>
      </div>
      <script>
         var modal = document.getElementById("changePasswordModal");
         var btn = document.getElementById("changePasswordLink");
         var span = document.getElementsByClassName("close")[0];
         
         btn.onclick = function() {
            modal.style.display = "block";
         }
         
         span.onclick = function() {
            modal.style.display = "none";
         }
         
         window.onclick = function(event) {
            if (event.target == modal) {
               modal.style.display = "none";
            }
         }
      </script>
   </body>
</html>