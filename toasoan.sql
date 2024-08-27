-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 15, 2024 lúc 10:42 AM
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
(48, 'LT04', 'DỊCH COVIT CÓ KHẢ NĂNG BÙNG PHADT TRỞ LẠI TẠI TRUNG QUỐC NĂM 2024', '<b>ABCD</b>\r\n<i>ABCDE</i>', 'uploads/images/CoopTeam_1.png', 'uploads/videos/3195394-uhd_3840_2160_25fps.mp4', '2024-04-15', 'TRUNG QUỐC');

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
('LT01', 'Trong Nước'),
('LT02', 'Chính Trị'),
('LT03', 'Quân Sự'),
('LT04', 'Quốc Tế'),
('LT05', 'Y Tế'),
('LT06', 'Văn Học'),
('LT07', 'Test 1'),
('LT08', 'Test 2');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bantinhientruong`
--
ALTER TABLE `bantinhientruong`
  ADD KEY `TuTang` (`MaBanTinHienTruong`);

--
-- Chỉ mục cho bảng `loaitin`
--
ALTER TABLE `loaitin`
  ADD PRIMARY KEY (`MaLT`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bantinhientruong`
--
ALTER TABLE `bantinhientruong`
  MODIFY `MaBanTinHienTruong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
