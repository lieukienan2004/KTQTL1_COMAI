-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2024 at 07:03 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gianhanghandmade`
--


-- --------------------------------------------------------


--
-- Table structure for table `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `idChiTietDon` int(11) NOT NULL,
  `soLuongMua` int(11) NOT NULL,
  `idSanPham` int(11) NOT NULL,
  `idDonHang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`idChiTietDon`, `soLuongMua`, `idSanPham`, `idDonHang`) VALUES
(6, 1, 34, 5),
(7, 1, 35, 5),
(8, 2, 33, 7),
(9, 1, 23, 6);

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `idDonHang` int(11) NOT NULL,
  `ngayDat` datetime NOT NULL DEFAULT current_timestamp(),
  `diaChiGiaoHang` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ghiChuGiaoHang` text COLLATE utf8_unicode_ci NOT NULL,
  `tenDangNhap` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idTrangThai` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`idDonHang`, `ngayDat`, `diaChiGiaoHang`, `ghiChuGiaoHang`, `tenDangNhap`, `idTrangThai`) VALUES
(5, '2024-12-27 12:37:43', 'Châu Thành, Tiền Giang', '', 'user1', 1),
(6, '2024-12-23 11:45:43', 'Ninh Kiều, Cần Thơ', '', 'user1', 1),
(7, '2024-12-27 12:37:00', 'Long Đức, Trà Vinh', '', 'user2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gianhang`
--

CREATE TABLE `gianhang` (
  `idGianHang` int(11) NOT NULL,
  `tenGianHang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `chuSoHuuGianHang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `isBlock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gianhang`
--

INSERT INTO `gianhang` (`idGianHang`, `tenGianHang`, `chuSoHuuGianHang`, `isBlock`) VALUES
(1, 'Gian hàng hoa handmade Sinh viên TVU', 'owner1', 0),
(2, 'Gian hàng hoa giả Tri Tôn', 'owner2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kichthuoc`
--

CREATE TABLE `kichthuoc` (
  `idSize` int(11) NOT NULL,
  `size` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kichthuoc`
--

INSERT INTO `kichthuoc` (`idSize`, `size`) VALUES
(1, 'Nhỏ - (1 đến 2 bông)'),
(2, 'Trung bình - (3 đến 5 bông)'),
(3, 'Lớn - (6 đến 10 bông)'),
(4, 'Cực lớn - (Trên 10 bông)');

-- --------------------------------------------------------

--
-- Table structure for table `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `maLoai` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `tenLoai` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `isDelete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`maLoai`, `tenLoai`, `isDelete`) VALUES
('HGI', 'Hoa giấy', 0),
('HKE', 'Hoa kẽm', 0),
('HLE', 'Hoa đan len', 0),
('HSA', 'Hoa sáp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `tenDangNhap` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `matKhau` text COLLATE utf8_unicode_ci NOT NULL,
  `hoTen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gioiTinh` int(11) NOT NULL DEFAULT 0,
  `diaChi` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `soDienThoai` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `hinhDaiDien` text COLLATE utf8_unicode_ci NOT NULL,
  `maPhanQuyen` int(11) NOT NULL,
  `isBlock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`tenDangNhap`, `matKhau`, `hoTen`, `gioiTinh`, `diaChi`, `soDienThoai`, `hinhDaiDien`, `maPhanQuyen`, `isBlock`) VALUES
('admin1', '827ccb0eea8a706c4c34a16891f84e7b', 'Trần Văn C', 0, 'Tp. HCM', '0367112233', 'images/usericon/administrator.jpg', 1, 0),
('owner1', '81dc9bdb52d04dc20036dbd8313ed055', 'Chủ shop 1', 0, 'TVU - shopstore, 126 Nguyễn Thiện Thành, K4, P5, Trà Vinh', '0988123456', 'images/usericon/owner2.jpg', 3, 0),
('owner2', '81dc9bdb52d04dc20036dbd8313ed055', 'Chủ shop 2', 1, '123, Nguyễn Trãi, Tri Tôn, An Giang', '0936567234', 'images/usericon/owner1.jpg', 3, 0),
('user1', '202cb962ac59075b964b07152d234b70', 'Nguyễn Văn A', 0, 'Châu Thành, Trà Vinh', '0936010203', 'images/usericon/boy.png', 2, 0),
('user2', '202cb962ac59075b964b07152d234b70', 'Nguyễn Thị B', 1, 'Long Đức, Trà Vinh', '0938010203', 'images/usericon/girl.png', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `phanquyen`
--

CREATE TABLE `phanquyen` (
  `maPhanQuyen` int(11) NOT NULL,
  `tenPhanQuyen` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `phanquyen`
--

INSERT INTO `phanquyen` (`maPhanQuyen`, `tenPhanQuyen`) VALUES
(1, 'Quản trị viên'),
(2, 'Khách hàng'),
(3, 'Chủ gian hàng');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `idSanPham` int(11) NOT NULL,
  `tenSanPham` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `moTa` text COLLATE utf8_unicode_ci NOT NULL,
  `idSize` int(11) NOT NULL,
  `gia` int(11) NOT NULL,
  `soLuong` int(11) NOT NULL,
  `hinhSanPham` text COLLATE utf8_unicode_ci NOT NULL,
  `maLoai` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `idGianHang` int(11) NOT NULL,
  `isDelete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`idSanPham`, `tenSanPham`, `moTa`, `idSize`, `gia`, `soLuong`, `hinhSanPham`, `maLoai`, `idGianHang`, `isDelete`) VALUES
(22, 'Hoa hồng', 'Màu hồng, size to', 4, 300000, 10, 'images/hoadanlen/bo-hoa-heo-bang-len-hong-tho.jpg', 'HLE', 2, 0),
(23, 'Hoa len cừu', 'Bó hoa đan len, hình cừu', 1, 20000, 30, 'images/hoadanlen/hoa len cuu tot nghieo.jpg', 'HLE', 1, 0),
(24, 'Hoa len hình thỏ', 'Đan len hình thỏ', 2, 40000, 20, 'images/hoadanlen/hoa len hinh gau.jpg', 'HLE', 1, 0),
(25, 'Hoa len hồng', 'Nhiều loại hoa', 2, 150000, 40, 'images/hoadanlen/hoa len hong.jpg', 'HLE', 2, 0),
(26, 'Hoa len hướng dương cười', 'Hoa len mặt cười, màu cam', 1, 50000, 50, 'images/hoadanlen/hoa len mat cuoi.jpg', 'HLE', 1, 0),
(27, 'Hoa len mix', 'Mix nhiều loại', 3, 200000, 30, 'images/hoadanlen/hoa len nhieu loai.jpg', 'HLE', 1, 0),
(28, 'Hoa giáng sinh tuần lộc', 'Bó hoa tuần lộc mini', 1, 30000, 40, 'images/hoadanlen/hoa len noel 1.jpg', 'HLE', 1, 0),
(29, 'Hoa ông già noel', 'Đan len hình ông noel', 1, 50000, 20, 'images/hoadanlen/hoa len noel.jpg', 'HLE', 2, 0),
(30, 'Hoa len trắng hồng', 'Hoa to, tông trắng hồng', 3, 300000, 5, 'images/hoadanlen/hoa len tim 1.jpg', 'HLE', 1, 0),
(31, 'Hoa len tím', 'Hoa tím lãng mạn', 3, 350000, 35, 'images/hoadanlen/hoa len tim.jpeg', 'HLE', 2, 0),
(32, 'Hoa len tốt nghiệp', 'Hoa tốt nghiệp', 2, 150000, 50, 'images/hoadanlen/hoa len tot nghiep.jpg', 'HLE', 1, 0),
(33, 'Hoa tulip', 'Hoa tulip hồng', 1, 50000, 60, 'images/hoadanlen/hoa len tulip.jpg', 'HLE', 2, 0),
(34, 'Hoa giấy nhúng xanh nhạt', 'Hoa giấy nhúng màu xanh dương nhạt', 4, 450000, 30, 'images/hoagiay/hoa giau nhung xanh nhat.jpg', 'HGI', 2, 0),
(35, 'Hoa tình bạn', 'Hoa giấy nhúng vàng tượng trưng cho tình bạn', 1, 16000, 100, 'images/hoagiay/hoa giay nhung - 1 hoa vang.jpg', 'HGI', 1, 0),
(36, 'Hoa giấy hình sen', 'Hoa sen làm bằng giấy nhúng', 2, 50000, 100, 'images/hoagiay/hoa giay nhung - hoa sen.jpg', 'HGI', 2, 0),
(37, 'Hoa thủy chung', 'Hoa giấy nhúng màu xanh dương đậm', 3, 200000, 12, 'images/hoagiay/hoa giay nhung xanh duong.jpg', 'HGI', 1, 0),
(38, 'Hoa khát vọng', 'Hoa giấy nhúng màu xanh lá', 2, 100000, 40, 'images/hoagiay/hoa giay nhung xanh la.jpg', 'HGI', 1, 0),
(39, 'Hoa tặng mẹ', 'Hoa giấy nhúng màu vàng', 2, 200000, 50, 'images/hoagiay/hoagiaynhung - vang.jpg', 'HGI', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trangthai`
--

CREATE TABLE `trangthai` (
  `idTrangThai` int(11) NOT NULL,
  `tenTrangThai` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trangthai`
--

INSERT INTO `trangthai` (`idTrangThai`, `tenTrangThai`) VALUES
(1, 'Đặt hàng'),
(2, 'Đã tiếp nhận'),
(3, 'Đang giao hàng'),
(4, 'Đã hoàn thành'),
(5, 'Đã hủy đơn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`idChiTietDon`),
  ADD KEY `idBanh` (`idSanPham`),
  ADD KEY `idDonHang` (`idDonHang`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`idDonHang`),
  ADD KEY `tenDangNhap` (`tenDangNhap`),
  ADD KEY `idTrangThai` (`idTrangThai`);

--
-- Indexes for table `gianhang`
--
ALTER TABLE `gianhang`
  ADD PRIMARY KEY (`idGianHang`),
  ADD KEY `chuSoHuuGianHang` (`chuSoHuuGianHang`);

--
-- Indexes for table `kichthuoc`
--
ALTER TABLE `kichthuoc`
  ADD PRIMARY KEY (`idSize`);

--
-- Indexes for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`maLoai`);

--
-- Indexes for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`tenDangNhap`),
  ADD KEY `maPhanQuyen` (`maPhanQuyen`);

--
-- Indexes for table `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD PRIMARY KEY (`maPhanQuyen`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`idSanPham`),
  ADD KEY `maLoai` (`maLoai`),
  ADD KEY `idGianHang` (`idGianHang`),
  ADD KEY `idSize` (`idSize`);

--
-- Indexes for table `trangthai`
--
ALTER TABLE `trangthai`
  ADD PRIMARY KEY (`idTrangThai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `idChiTietDon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `idDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gianhang`
--
ALTER TABLE `gianhang`
  MODIFY `idGianHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kichthuoc`
--
ALTER TABLE `kichthuoc`
  MODIFY `idSize` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `phanquyen`
--
ALTER TABLE `phanquyen`
  MODIFY `maPhanQuyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `idSanPham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `trangthai`
--
ALTER TABLE `trangthai`
  MODIFY `idTrangThai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`idSanPham`) REFERENCES `sanpham` (`idSanPham`),
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`idDonHang`) REFERENCES `donhang` (`idDonHang`);

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`tenDangNhap`) REFERENCES `nguoidung` (`tenDangNhap`),
  ADD CONSTRAINT `donhang_ibfk_2` FOREIGN KEY (`idTrangThai`) REFERENCES `trangthai` (`idTrangThai`);

--
-- Constraints for table `gianhang`
--
ALTER TABLE `gianhang`
  ADD CONSTRAINT `gianhang_ibfk_1` FOREIGN KEY (`chuSoHuuGianHang`) REFERENCES `nguoidung` (`tenDangNhap`);

--
-- Constraints for table `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD CONSTRAINT `nguoidung_ibfk_1` FOREIGN KEY (`maPhanQuyen`) REFERENCES `phanquyen` (`maPhanQuyen`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`maLoai`) REFERENCES `loaisanpham` (`maLoai`),
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`idGianHang`) REFERENCES `gianhang` (`idGianHang`),
  ADD CONSTRAINT `sanpham_ibfk_3` FOREIGN KEY (`idSize`) REFERENCES `kichthuoc` (`idsize`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
