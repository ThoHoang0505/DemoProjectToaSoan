-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 26, 2024 lúc 03:44 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `toasoan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bantinhientruong`
--

CREATE TABLE `bantinhientruong` (
  `MaBanTinHienTruong` int(11) NOT NULL,
  `LoaiTin` varchar(30) NOT NULL,
  `TieuDe` varchar(200) NOT NULL,
  `NoiDung` varchar(2000) NOT NULL,
  `HinhAnh` varchar(200) NOT NULL,
  `Video` varchar(200) NOT NULL,
  `NgayTao` varchar(15) NOT NULL,
  `NguonThongTin` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bantinhientruong`
--

INSERT INTO `bantinhientruong` (`MaBanTinHienTruong`, `LoaiTin`, `TieuDe`, `NoiDung`, `HinhAnh`, `Video`, `NgayTao`, `NguonThongTin`) VALUES
(42, 'LT01', 'TEST THÊM NGÀY VÀ NGUỒN', '<b>ABCD</b>\r\n<span style=\'color:blue\'><u><i><b>ABCDE</b></i></u></span>', 'uploads/images/CoopTeam_3.png', 'uploads/videos/3195394-uhd_3840_2160_25fps.mp4', '15/04/2024', 'TEST THÊM NGÀY VÀ NGUỒN'),
(43, 'LT01', 'TEST TRONG NUOC 2', '<b>ABCD</b>\r\n<span style=\'color:pink\'><u><i><b>ABCD</b></i></u></span>', 'uploads/images/CoopTeam_3.png', 'uploads/videos/3195394-uhd_3840_2160_25fps.mp4', '15/04/2024', 'TEST TRONG NUOC 2'),
(44, 'LT01', 'TEST 234', '<i><b>ABCD</b></i>', 'uploads/images/CoopTeam_3.png', 'uploads/videos/3195394-uhd_3840_2160_25fps.mp4', '15/04/2024', 'TEST 234'),
(45, 'LT08', 'TEST FINNAL', '<b>ABCD</b>\r\n<span style=\'color:blue\'><u><i><b>ABCD</b></i></u></span>', 'uploads/images/CoopTeam_3.png', 'uploads/videos/3195394-uhd_3840_2160_25fps.mp4', '2024-04-15', 'FINNAL ABC'),
(46, 'LT01', 'TEST FINNAL 2', '123\r\n<u><i><b>ABCDE</b></i></u>', 'uploads/images/Moon.jpg', 'uploads/videos/3195394-uhd_3840_2160_25fps.mp4', '2024-04-15', 'FINNAL 2'),
(47, 'LT06', 'VĂN HỌC NGA 1965', '<i><b>Tiêu Đề In Đậm Và In Nghiêng</b></i>\r\n<i>Nội Dung 1</i>\r\n<u>Nội Dung 2</u>\r\n<span style=\'color:blue\'>Nội Dung 3</span>', 'uploads/images/CoopTeam_3.png', 'uploads/videos/3195394-uhd_3840_2160_25fps.mp4', '2024-04-15', 'BÁO NGA 2024'),
(48, 'LT04', 'DỊCH COVIT CÓ KHẢ NĂNG BÙNG PHADT TRỞ LẠI TẠI TRUNG QUỐC NĂM 2024', '<b>ABCD</b>\r\n<i>ABCDE</i>', 'uploads/images/CoopTeam_1.png', 'uploads/videos/3195394-uhd_3840_2160_25fps.mp4', '2024-04-15', 'TRUNG QUỐC'),
(49, 'LT11', 'CÔNG VĂN CHÍNH PHỦ 1', '<b>ABCD</b>\r\n1234', 'uploads/images/CoopTeam_3.png', 'uploads/videos/3195394-uhd_3840_2160_25fps.mp4', '2024-04-15', 'VIỆT NAM'),
(50, 'LT01', 'TEST 2 ẢNH', 'abcd', 'uploads/images/Moon.jpg', 'uploads/videos/3195394-uhd_3840_2160_25fps.mp4', '2024-04-15', 'abc'),
(51, 'LTX9', 'Thoi Tiet Ha Noi 2024', '<b>Thoi Tiet Ha Noi 2024</b>\r\n<i>Ha Noi mua nhieu noi</i>', 'uploads/images/Moon.jpg', 'uploads/videos/3195394-uhd_3840_2160_25fps.mp4', '2024-08-26', 'Ha Noi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `docgia`
--

CREATE TABLE `docgia` (
  `MaDG` int(11) NOT NULL,
  `TenDG` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `NgaySinh` date NOT NULL,
  `SDT` varchar(12) NOT NULL,
  `DiaChi` varchar(50) NOT NULL,
  `GioiTinh` varchar(10) NOT NULL,
  `MaTK_DG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `docgia`
--

INSERT INTO `docgia` (`MaDG`, `TenDG`, `Email`, `NgaySinh`, `SDT`, `DiaChi`, `GioiTinh`, `MaTK_DG`) VALUES
(1, 'Doc Gia TEST 3', 'example@st.vimaru.edu.vn', '2005-05-05', '0123456789', 'Ha Noi', 'male', 1),
(2, 'Doc Gia TEST 2', 'tho88816@st.vimaru.edu.vn', '2003-05-05', '01245567', 'Ha Noi', 'male', 2),
(3, 'Doc Gia 3', 'thomusedash@gmail.com', '2002-05-05', '0123344556', 'Hai Phong', 'male', 3),
(4, 'Tho Hoang', 'tho88816@st.vimaru.edu.vn', '2002-05-05', '123456', 'Hai Phong', 'Nam', 4),
(5, 'Tran Hoang Tho', 'tho@st.vimaru.edu.vn', '2002-05-05', '12345678', 'Hai Phong', 'Nữ', 5),
(6, 'Tran Hoang Tho', 'tho88816@st.vimaru.edu.vn', '2002-05-05', '1233123123', 'Hai Phong', 'Nam', 6),
(7, 'Hello World', 'tho123@edu.vn', '2003-01-01', '124568998', 'Hai Phong', 'Nam', 7),
(8, 'THT', 'tho@st.vimaru.edu.vn', '2002-05-05', '123123123', 'Ha Noi', 'Nữ', 8),
(9, 'thttest2', 'thomagic1@gmail.com', '2002-01-01', '123123123', 'Ha Noi', 'Nữ', 9),
(10, 'THT2', 'trinhthinhnormie@gmail.com', '2002-05-05', '123123123123', 'Ha Noi', 'Nam', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaitin`
--

CREATE TABLE `loaitin` (
  `MaLT` varchar(10) NOT NULL,
  `TenLT` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaitin`
--

INSERT INTO `loaitin` (`MaLT`, `TenLT`) VALUES
('LT02', 'Chính Trị'),
('LT03', 'Quân Sự'),
('LT04', 'Quốc Tế'),
('LT05', 'Y Tế'),
('LT06', 'Văn Học'),
('LT07', 'Test 1'),
('LT08', 'Test 2'),
('LT11', 'Công Văn Chính Phủ'),
('LTX9', 'Tin Cảnh Báo Thời Tiết');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaTK` int(11) NOT NULL,
  `TenDangNhap` varchar(30) NOT NULL,
  `MatKhau` varchar(30) NOT NULL,
  `Quyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`MaTK`, `TenDangNhap`, `MatKhau`, `Quyen`) VALUES
(1, 'Mmmmm0709', '123', 6),
(2, '88816', '123', 6),
(3, 'Mmmmm0505', '123', 6),
(4, 'thotest', '123', 6),
(5, 'thotest2', '1234', 6),
(6, 'thotest3', '1234', 6),
(7, 'helloworld', '1234', 6),
(8, 'thttest', '123', 6),
(9, 'thttest2', '123', 6),
(10, 'thttest3', '123', 6);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bantinhientruong`
--
ALTER TABLE `bantinhientruong`
  ADD KEY `TuTang` (`MaBanTinHienTruong`);

--
-- Chỉ mục cho bảng `docgia`
--
ALTER TABLE `docgia`
  ADD KEY `TuTang` (`MaDG`),
  ADD KEY `MaTK_DG` (`MaTK_DG`);

--
-- Chỉ mục cho bảng `loaitin`
--
ALTER TABLE `loaitin`
  ADD PRIMARY KEY (`MaLT`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD KEY `TuTang` (`MaTK`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bantinhientruong`
--
ALTER TABLE `bantinhientruong`
  MODIFY `MaBanTinHienTruong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `docgia`
--
ALTER TABLE `docgia`
  MODIFY `MaDG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `MaTK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `docgia`
--
ALTER TABLE `docgia`
  ADD CONSTRAINT `docgia_ibfk_1` FOREIGN KEY (`MaTK_DG`) REFERENCES `taikhoan` (`MaTK`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
