<?php
   session_start();
   
   $isLoggedIn = isset($_SESSION['tenDG']);
   $username = $isLoggedIn ? htmlspecialchars($_SESSION['tenDG']) : null;
   
   if (isset($_POST['logout'])) {
       session_destroy();
       header("Location: tintuc.php");
       exit();
   }
   ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>VCS</title>
      <link rel="shortcut icon" href="../ima/vcs.jfif">
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
      <style>
         .dropdown-content {
         display: none;
         position: absolute;
         right: 0;
         top: 100%;
         background-color: white;
         box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
         border-radius: 0.25rem;
         z-index: 10;
         width: 100%;
         }
         .dropdown:hover .dropdown-content {
         display: block;
         }
         .dropdown-content a {
         display: block;
         padding: 0.5rem 1rem;
         color: #333;
         text-decoration: none;
         }
         .dropdown-content a:hover {
         background-color: #f0f0f0;
         }
         .dropdown-content .logout-button {
         color: red;
         }
         .dropdown-content .logout-button:hover {
         background-color: #fdd;
         }
         img:hover {
         transform: scale(1.05);
         transition: transform 0.3s ease;
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
         .carousel-item {
         width: 80%;
         }
      </style>
   </head>
   <body class="bg-gray-200">
      <header class="bg-gray-900 text-white py-4 px-4 lg:px-8 flex justify-between items-center">
         <div class="flex items-center">
            <img src="https://gamek.mediacdn.vn/133514250583805952/2023/2/25/2502-1-logovcs-16772883937651936617703-1677288739303-16772887394181183048957-1677298067131-16772980675301399419721.jpg" class="w-16 h-16 mr-4 rounded-full">
            <h1 class="text-2xl lg:text-3xl font-bold">VCS</h1>
         </div>
         <form class="flex items-center">
            <input type="text" name="search" placeholder="Tìm bài viết" class="rounded-full px-4 py-2 bg-gray-800 text-white mr-2 focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="rounded-full px-4 py-2 bg-blue-500 text-white hover:bg-blue-600 transition duration-300">Search</button>
         </form>
         <div class="flex items-center">
            <?php if ($isLoggedIn): ?>
            <div class="relative dropdown">
               <button class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-full"><?php echo $username; ?></button>
               <div class="dropdown-content">
                  <a href="thongtin.php" class="block">Quản lý tài khoản</a>
                  <form method="POST" action="" class="w-full">
                     <button type="submit" name="logout" class="logout-button w-full text-left px-4 py-2">Đăng xuất</button>
                  </form>
               </div>
            </div>
            <?php else: ?>
            <a href="dangnhap.php" class="text-white hover:text-blue-400 mr-2">Đăng nhập</a>
            <a href="dangky.php" class="text-white hover:text-blue-400">Đăng ký</a>
            <?php endif; ?>
         </div>
      </header>
      <nav class="bg-gray-900 text-white py-2">
         <ul class="flex flex-wrap justify-between">
            <li><a href="tintuc.php" class="px-4 py-2 hover:text-blue-400">Trang chủ</a></li>
            <li><a href="tinyoutube.php" class="px-4 py-2 hover:text-blue-400">Bản Tin Youtube</a></li>
            <li><a href="#" class="px-4 py-2 hover:text-blue-400">Trong Nước</a></li>
            <li><a href="#" class="px-4 py-2 hover:text-blue-400">Chính trị</a></li>
            <li><a href="#" class="px-4 py-2 hover:text-blue-400">Quân Sự</a></li>
            <li><a href="#" class="px-4 py-2 hover:text-blue-400">Quốc Tế</a></li>
            <li><a href="#" class="px-4 py-2 hover:text-blue-400">Kinh Tế</a></li>
            <li><a href="#" class="px-4 py-2 hover:text-blue-400">Y Tế</a></li>
            <li><a href="#" class="px-4 py-2 hover:text-blue-400">Công Văn Chính Phủ</a></li>
            <li><a href="#" class="px-4 py-2 hover:text-blue-400">Văn Học</a></li>
            <li><a href="#" class="px-4 py-2 hover:text-blue-400">Đời Sống</a></li>
            <li><a href="#" class="px-4 py-2 hover:text-blue-400">Thể Thao</a></li>
         </ul>
      </nav>
      <main class="p-4">
         <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <article class="bg-white p-4">
               <div class="flex items-center mb-2">
                  <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold mr-2">Tin thế giới</span>
                  <a href="https://haiphong.gov.vn/tin-tuc-su-kien/thuc-day-quan-he-hop-tac-song-phuong-giua-thanh-pho-hai-phong-va-thanh-pho-cheongju-han-quoc-683224" class="font-bold hover:text-blue-500">Thúc Đẩy Quan Hệ Hợp Tác Song Phương Giữa Thành Phố Hải Phòng và Cheongju (Hàn Quốc)</a>
               </div>
               <img src="https://haiphong.gov.vn/sitefolders/Root/6461/tintuc/2024/4/z5350618453067_ffc1c11eb86e2c46a8f098bcc00e8c26.jpg" class="w-full mt-4" alt="Quan Hệ Tốt Đẹp Giữa Hải Phòng Và Hàn Quốc">
               <p class="mt-4">(Haiphong.gov.vn) – Chiều 15/4, Phó Chủ tịch Thường trực UBND thành phố Lê Anh Quân tiếp và làm việc với Đoàn chính quyền thành phố Cheongju (Hàn Quốc) do Thị trưởng Lee Beom Seog dẫn đầu. Theo đó, Hải Phòng trong những năm gần đây luôn là một trong những địa phương nằm trong nhóm có tốc độ tăng trưởng cao nhất cả nước. Do vị trí địa lý, Hải Phòng là đầu mối giao thông - giao lưu quan trọng của Việt Nam và quốc tế. Thành phố có hệ thống cơ sở hạ tầng đồng bộ, giao thông thuận lợi kết nối liên tỉnh, liên vùng và đi thế giới với 5 loại hình giao thông; Hệ thống cảng biển của thành phố lớn nhất khu vực miền Bắc, được xây dựng theo hướng hiện đại. Cảng hàng không quốc tế Cát Bi đạt tiêu chuẩn 4E</p>
            </article>
            <article class="bg-white p-4">
               <div class="flex items-center mb-2">
                  <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold mr-2">Tin công nghệ đáng chú ý</span>
                  <a href="http://fit.vimaru.edu.vn/vi/su-kien/ket-qua-cuoc-thi-mos-quoc-te" class="font-bold hover:text-blue-500">Kết quả cuộc thi MOS Quốc tế tại DHHH Việt Nam</a>
               </div>
               <img src="https://teky.edu.vn/blog/wp-content/uploads/2023/05/chung-chi-tin-hoc-mos-1.jpg" class="w-full mt-4" alt="Công Nghệ Tương Lai">
               <p class="mt-4">Thật vinh dự và tự hào với sự lỗ lực, cố gắng hết mình và sự hỗ trợ, định hướng động viên từ BGH nhà Trường, BCN Khoa CNTT, đặc biệt là sự tận tâm hướng dẫn của cô TS. Hồ Thị Hương Thơm, cô Th S. Nguyễn Kim Anh và các thầy cô giáo khoa CNTT. Em Nguyễn Thị Thanh Trúc - lớp LQC61ĐH -Trường ĐH Hàng hải Việt Nam đã vinh dự đạt giải nhì cuộc thi Tin học văn phòng quốc tế tại bộ môn Microsoft Excel 2016 tại Hoa Kỳ, được tổ chức vào ngày 3 tháng 8 năm 2023.</p>
            </article>
         </section>
         <section class="py-4">
         <h3 class="text-2xl font-bold mb-4">TIN NỔI BẬT TRONG NGÀY</h3>
         <div class="relative">
            <div id="highlighted-news" class="overflow-x-auto">
               <div class="flex space-x-4">
                  <article class="p-4 bg-gray-200 flex-none w-64">
                     <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                     <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                  </article>
                  <article class="p-4 bg-gray-200 flex-none w-64">
                     <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                     <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                  </article>
                  <article class="p-4 bg-gray-200 flex-none w-64">
                     <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                     <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                  </article>
                  <article class="p-4 bg-gray-200 flex-none w-64">
                     <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                     <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                  </article>
                  <article class="p-4 bg-gray-200 flex-none w-64">
                     <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                     <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                  </article>
                  <article class="p-4 bg-gray-200 flex-none w-64">
                     <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                     <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                  </article>
                  <article class="p-4 bg-gray-200 flex-none w-64">
                     <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                     <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                  </article>
                  <article class="p-4 bg-gray-200 flex-none w-64">
                     <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                     <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                  </article>
                  <article class="p-4 bg-gray-200 flex-none w-64">
                     <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                     <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                  </article>
               </div>
            </div>
            <button id="highlighted-news-prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-700 text-white px-4 py-2 rounded-r-lg hover:bg-gray-600">
            &lt;
            </button>
            <button id="highlighted-news-next" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-700 text-white px-4 py-2 rounded-l-lg hover:bg-gray-600">
            &gt;
            </button>
         </div>
         </div>
         <button class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-700 text-white px-4 py-2 rounded-r-lg hover:bg-gray-600">
         &lt;
         </button>
         <button class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-700 text-white px-4 py-2 rounded-l-lg hover:bg-gray-600">
         &gt;
         </button>
         </div>
         <section class="py-4">
            <h3 class="text-2xl font-bold mb-4">TIN MỚI NHẤT</h3>
            <div class="relative">
               <div id="latest-news" class="overflow-x-auto">
                  <div class="flex space-x-4">
                     <article class="p-4 bg-gray-200 flex-none w-64">
                        <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                        <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                     </article>
                     <article class="p-4 bg-gray-200 flex-none w-64">
                        <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                        <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                     </article>
                     <article class="p-4 bg-gray-200 flex-none w-64">
                        <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                        <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                     </article>
                     <article class="p-4 bg-gray-200 flex-none w-64">
                        <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                        <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                     </article>
                     <article class="p-4 bg-gray-200 flex-none w-64">
                        <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                        <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                     </article>
                     <article class="p-4 bg-gray-200 flex-none w-64">
                        <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                        <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                     </article>
                     <article class="p-4 bg-gray-200 flex-none w-64">
                        <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                        <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                     </article>
                     <article class="p-4 bg-gray-200 flex-none w-64">
                        <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                        <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                     </article>
                     <article class="p-4 bg-gray-200 flex-none w-64">
                        <img src="https://ddk.1cdn.vn/2023/12/03/coverto.jpg" class="w-full" alt="image-1">
                        <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/thuc-pham-ban-la-gi-nguyen-nhan-va-tac-hai-khi-tieu-thu-thuc-an-ban-1420156" class="font-bold hover:text-blue-500 block mt-2">Mối Lo Về Hàng Hóa Mất Vệ Sinh An Toàn Thực Phẩm Len Lỏi Các Khu Chợ</a>
                     </article>
                  </div>
               </div>
               <button id="latest-news-prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-700 text-white px-4 py-2 rounded-r-lg hover:bg-gray-600">
               &lt;
               </button>
               <button id="latest-news-next" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-700 text-white px-4 py-2 rounded-l-lg hover:bg-gray-600">
               &gt;
               </button>
            </div>
         </section>
      </main>
      <footer class="footer py-4">
         <div class="container mx-auto text-center">
            <p class="text-sm">&copy; 2024 VCS. All rights reserved.</p>
            <p class="text-sm mt-2">Contact us: <a href="#">example@st.vimaru.edu.vn</a></p>
         </div>
      </footer>
      <script>
         document.addEventListener("DOMContentLoaded", function() {
            const highlightedNews = document.getElementById('highlighted-news');
            const latestNews = document.getElementById('latest-news');
            const highlightedNewsPrev = document.getElementById('highlighted-news-prev');
            const highlightedNewsNext = document.getElementById('highlighted-news-next');
            const latestNewsPrev = document.getElementById('latest-news-prev');
            const latestNewsNext = document.getElementById('latest-news-next');
         
            const scrollAmount = 200;
         
            highlightedNewsNext.addEventListener('click', () => {
               highlightedNews.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            });
         
            highlightedNewsPrev.addEventListener('click', () => {
               highlightedNews.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            });
         
            latestNewsNext.addEventListener('click', () => {
               latestNews.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            });
         
            latestNewsPrev.addEventListener('click', () => {
               latestNews.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            });
         });
      </script>
   </body>
</html>