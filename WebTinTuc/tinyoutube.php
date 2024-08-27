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
   
   $loggedIn = isset($_SESSION['tenDG']);
   
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
       session_destroy();
       header("Location: tinyoutube.php");
       exit();
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>VCS</title>
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
      <style>
         body {
         font-family: 'Inter', sans-serif;
         }
         .navbar {
         background-color: #1a202c;
         }
         .navbar h2 {
         color: #f7fafc;
         }
         .navbar a {
         color: #f7fafc;
         }
         .navbar form input,
         .navbar form button {
         padding: 10px 15px;
         border-radius: 5px;
         }
         .navbar form input {
         border: 1px solid #cbd5e0;
         }
         .navbar form button {
         background-color: #2d3748;
         }
         .navbar form button:hover {
         background-color: #4a5568;
         }
         .navbar .logout-btn {
         background-color: #e53e3e;
         }
         .navbar .logout-btn:hover {
         background-color: #c53030;
         }
         #wrap {
         max-width: 1200px;
         margin: 20px auto;
         padding: 20px;
         }
         .video-group h3 {
         background-color: #2d3748;
         color: #f7fafc;
         padding: 10px;
         border-radius: 5px;
         margin-bottom: 20px;
         }
         .video-thumbnail iframe {
         border-radius: 5px;
         box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
         }
         .video-thumbnail a {
         margin-top: 10px;
         display: block;
         text-align: center;
         font-weight: 600;
         color: #2d3748;
         transition: color 0.3s;
         }
         .video-thumbnail a:hover {
         color: #1a202c;
         }
         .footer {
         background-color: #1a202c;
         }
         .footer p {
         color: #a0aec0;
         font-size: 0.875rem;
         }
         .footer a {
         color: #a0aec0;
         transition: color 0.3s;
         }
         .footer a:hover {
         color: #f7fafc;
         }
      </style>
   </head>
   <body class="bg-gray-50">
      <nav class="navbar py-4">
         <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
               <img src="https://gamek.mediacdn.vn/133514250583805952/2023/2/25/2502-1-logovcs-16772883937651936617703-1677288739303-16772887394181183048957-1677298067131-16772980675301399419721.jpg" class="w-16 h-16 mr-4 rounded-full">
               <h2 class="text-3xl font-bold">VCS</h2>
            </div>
            <div class="flex items-center">
               <form class="mr-4">
                  <input type="text" name="search" placeholder="Tìm bài viết" class="px-4 py-2 rounded-lg border">
                  <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg ml-2">Tìm kiếm</button>
               </form>
               <?php if ($loggedIn): ?>
               <form method="POST" action="" class="mr-4">
                  <button type="submit" name="logout" class="px-4 py-2 bg-red-600 text-white rounded-lg logout-btn">Đăng xuất</button>
               </form>
               <span class="px-4 py-2 bg-gray-800 text-white rounded-lg"><?php echo htmlspecialchars($_SESSION['tenDG']); ?></span>
               <?php else: ?>
               <a href="dangnhap.php" class="px-4 py-2 bg-gray-800 text-white rounded-lg mr-4">Đăng nhập</a>
               <a href="dangky.php" class="px-4 py-2 bg-gray-800 text-white rounded-lg">Đăng ký</a>
               <?php endif; ?>
            </div>
         </div>
      </nav>
      <div id="wrap">
         <nav class="navbar py-4">
            <ul class="container mx-auto flex justify-center items-center">
               <li class="mr-6"><a href="tintuc.php" class="hover:text-gray-300">Trang chủ</a></li>
               <li class="mr-6"><a href="#" class="hover:text-gray-300">Tin Video</a></li>
               <li class="mr-6"><a href="#" class="hover:text-gray-300">Thế giới</a></li>
               <li class="mr-6"><a href="#" class="hover:text-gray-300">Trính trị</a></li>
               <li class="mr-6"><a href="#" class="hover:text-gray-300">Kinh tế</a></li>
               <li class="mr-6"><a href="#" class="hover:text-gray-300">Xã hội</a></li>
               <li class="mr-6"><a href="#" class="hover:text-gray-300">Văn hóa</a></li>
               <li class="mr-6"><a href="#" class="hover:text-gray-300">Giáo dục</a></li>
               <li class="mr-6"><a href="#" class="hover:text-gray-300">Thể thao</a></li>
               <li><a href="#" class="hover:text-gray-300">Pháp luật</a></li>
            </ul>
         </nav>
         <div class="video-group">
            <h3 class="text-lg font-bold">Video Tin Thể Thao</h3>
            <div class="cent grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
               <div class="video-thumbnail">
                  <iframe width="290" height="220" src="https://www.youtube.com/embed/JqR7JOWTF50?si=iYdOneyUuSbrksFC" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  <a href="https://www.youtube.com/watch?v=JqR7JOWTF50" target="_blank">MAN UTD HÒA THẤT VỌNG, BAYERN CHƯA CHO ĐỐI THỦ LÊN NGÔI, BARCA, REAL THẮNG NHẸ</a>
               </div>
               <div class="video-thumbnail">
                  <iframe width="290" height="220" src="https://www.youtube.com/embed/WyuwGLMhmIU?si=sAxII5QhnAFTLgle" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  <a href="https://www.youtube.com/watch?v=WyuwGLMhmIU" target="_blank">MBAPPE BỊ NÓI ĐÁ NHƯ NHỔ VÀO MẶT PSG, AL NASSR CHI TIỀN KHỦNG MUA BRUYNE</a>
               </div>
               <div class="video-thumbnail">
                  <iframe width="290" height="220" src="https://www.youtube.com/embed/HerCrpSGQi0?si=VXA2A0FroEwW5cOV" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  <a href="https://www.youtube.com/watch?v=HerCrpSGQi0" target="_blank">Bản tin Thể Thao</a>
               </div>
            </div>
         </div>
         <div class="video-group mt-8">
            <h3 class="text-lg font-bold">Video Tin Chính Trị</h3>
            <div class="cent grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
               <div class="video-thumbnail">
                  <iframe width="290" height="220" src="https://www.youtube.com/embed/6uH9axA2EXY?si=1YyWSWwlXGHnR7IV" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  <a href="https://www.youtube.com/watch?v=6uH9axA2EXY" target="_blank">Sửa đổi luật dân sự Việt Nam</a>
               </div>
               <div class="video-thumbnail">
                  <iframe width="290" height="220" src="https://www.youtube.com/embed/HerCrpSGQi0?si=VXA2A0FroEwW5cOV" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  <a href="https://www.youtube.com/watch?v=HerCrpSGQi0" target="_blank">Truyền thông quốc tế đưa tin về hội nghị G20 tại Việt Nam</a>
               </div>
               <div class="video-thumbnail">
                  <iframe width="290" height="220" src="https://www.youtube.com/embed/HerCrpSGQi0?si=VXA2A0FroEwW5cOV" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  <a href="https://www.youtube.com/watch?v=HerCrpSGQi0" target="_blank">Quan hệ quốc tế và chiến lược ngoại giao</a>
               </div>
            </div>
         </div>
      </div>
      <footer class="footer py-4">
         <div class="container mx-auto text-center">
            <p class="text-sm">&copy; 2024 VCS. All rights reserved.</p>
            <p class="text-sm mt-2">Contact us: <a href="#">example@st.vimaru.edu.vn</a></p>
         </div>
      </footer>
   </body>
</html>