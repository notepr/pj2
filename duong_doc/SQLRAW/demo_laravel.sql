-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 19, 2020 lúc 01:16 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `demo_laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ca`
--

CREATE TABLE `ca` (
  `ma_ca` int(10) UNSIGNED NOT NULL,
  `gio_bat_dau` time NOT NULL,
  `gio_ket_thuc` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ca`
--

INSERT INTO `ca` (`ma_ca`, `gio_bat_dau`, `gio_ket_thuc`) VALUES
(1, '08:00:00', '17:30:00'),
(2, '08:00:00', '10:00:00'),
(3, '10:00:00', '12:00:00'),
(4, '08:00:00', '12:00:00'),
(5, '13:30:00', '15:30:00'),
(6, '15:30:00', '17:30:00'),
(7, '13:30:00', '17:30:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cap_do`
--

CREATE TABLE `cap_do` (
  `ma_cap_do` int(11) NOT NULL,
  `ten_cap_do` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cap_do`
--

INSERT INTO `cap_do` (`ma_cap_do`, `ten_cap_do`) VALUES
(1, 'Giáo Vụ'),
(2, 'Kĩ Thuật'),
(3, 'Giáo Viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cau_hinh`
--

CREATE TABLE `cau_hinh` (
  `ma_cau_hinh` int(10) UNSIGNED NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_loai` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cau_hinh`
--

INSERT INTO `cau_hinh` (`ma_cau_hinh`, `mo_ta`, `ma_loai`) VALUES
(1, '`CPU:I9-9900XE`Main:Z350`Ram:8Gb`', 1),
(2, '`CPU:XEON E5-2670`Main:Z10PA-D8C`Ram:16Gb`', 1),
(3, 'DELL U2417H', 2),
(4, 'DURGOD', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cau_hinh_mon`
--

CREATE TABLE `cau_hinh_mon` (
  `ma_cau_hinh` int(10) UNSIGNED NOT NULL,
  `ma_mon_hoc` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cau_hinh_mon`
--

INSERT INTO `cau_hinh_mon` (`ma_cau_hinh`, `ma_mon_hoc`) VALUES
(1, 'BIT_ACC'),
(1, 'BIT_CMS'),
(1, 'BIT_DB1'),
(1, 'BIT_DMAR1'),
(1, 'BKA_ESE'),
(2, 'BIT_AP'),
(2, 'BIT_DB2'),
(2, 'BIT_PHP1'),
(2, 'BKA_ESE');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuong_trinh_dao_tao`
--

CREATE TABLE `chuong_trinh_dao_tao` (
  `ma_chuong_trinh_dao_tao` int(10) UNSIGNED NOT NULL,
  `ma_mon_hoc` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ghi_chu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hoc_ki` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_day_bo_sung`
--

CREATE TABLE `lich_day_bo_sung` (
  `ma_lich_day_bo_sung` int(10) UNSIGNED NOT NULL,
  `ngay` date NOT NULL,
  `ma_lop` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_nguoi_dung` int(10) UNSIGNED NOT NULL,
  `ma_mon_hoc` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_ca` int(10) UNSIGNED NOT NULL,
  `ma_phong` int(10) UNSIGNED NOT NULL,
  `ghi_chu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinh_trang` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lich_day_bo_sung`
--

INSERT INTO `lich_day_bo_sung` (`ma_lich_day_bo_sung`, `ngay`, `ma_lop`, `ma_nguoi_dung`, `ma_mon_hoc`, `ma_ca`, `ma_phong`, `ghi_chu`, `tinh_trang`) VALUES
(1, '2020-08-11', 'BKD01K10', 22, 'BKA_ESE', 3, 2, 'sdvasdvs', 1),
(2, '2020-08-15', 'BIT01K10', 6, 'BIT_ECOM1', 2, 5, '', 1),
(4, '2020-08-15', 'BIT01K10', 38, 'BIT_ACC', 3, 3, '', 1),
(5, '2020-08-15', 'BIT01K10', 15, 'BIT_ACC', 6, 5, '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su`
--

CREATE TABLE `lich_su` (
  `ma_lich_su` int(10) UNSIGNED NOT NULL,
  `ma_nguoi_dung` int(10) UNSIGNED NOT NULL,
  `thoi_gian` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lich_su`
--

INSERT INTO `lich_su` (`ma_lich_su`, `ma_nguoi_dung`, `thoi_gian`) VALUES
(1, 1, '2020-08-15 10:59:37'),
(2, 2, '2020-08-15 10:59:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_chi_tiet`
--

CREATE TABLE `lich_su_chi_tiet` (
  `ma_lich_su` int(10) UNSIGNED NOT NULL,
  `ma_thiet_bi` int(10) UNSIGNED NOT NULL,
  `gia` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `ma_tinh_trang_thiet_bi` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `lich_su_chi_tiet`
--

INSERT INTO `lich_su_chi_tiet` (`ma_lich_su`, `ma_thiet_bi`, `gia`, `ma_tinh_trang_thiet_bi`) VALUES
(1, 1, '200000', 2),
(1, 4, '1500000', 1),
(2, 1, '200000', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai`
--

CREATE TABLE `loai` (
  `ma_loai` int(10) UNSIGNED NOT NULL,
  `ten_loai` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loai`
--

INSERT INTO `loai` (`ma_loai`, `ten_loai`, `mo_ta`) VALUES
(1, 'case', 'case'),
(2, 'ma_hinh', 'Màn Hình'),
(3, 'chuot', 'Chuột'),
(4, 'ban_phim', 'Bàn Phím');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_05_06_190000_loai', 1),
(2, '2020_05_06_190005_tinh_trang_thiet_bi', 1),
(3, '2020_05_06_190129_tinh_trang', 1),
(4, '2020_05_06_190130_cap_do', 1),
(5, '2020_05_06_190135_nguoi_dung', 1),
(6, '2020_05_06_190137_mon_hoc', 1),
(7, '2020_05_06_190138_cau_hinh', 1),
(8, '2020_05_06_190139_toa', 1),
(9, '2020_05_06_190147_tang', 1),
(10, '2020_05_06_190156_phong', 1),
(11, '2020_05_06_190158_ca', 1),
(12, '2020_05_06_190208_phan_cong', 1),
(13, '2020_05_06_190209_nguoi_dung_bo_mon', 1),
(14, '2020_05_06_190212_chuong_trinh_dao_tao', 1),
(15, '2020_05_06_190215_lich_day_bo_sung', 1),
(16, '2020_05_06_190220_phan_cong_chi_tiet', 1),
(17, '2020_05_06_190233_ngay_nghi', 1),
(18, '2020_05_06_190438_phan_hoi_su_co', 1),
(19, '2020_06_05_094330_thiet_bi_phong', 1),
(20, '2020_06_05_094344_lich_su', 1),
(21, '2020_06_05_094429_lich_su_chi_tiet', 1),
(22, '2020_06_05_094459_cau_hinh_mon', 1),
(23, '2020_06_05_094462_insert_clone_auto', 1),
(24, '2020_06_08_034946_insert_data_lich_su_chi_tiet', 1),
(25, '2020_06_22_161702_insert_ca', 1),
(26, '2020_06_22_171547_insert_ngay_nghi', 1),
(27, '2020_07_01_182528_insert_cau_hinh_mon', 1),
(28, '2020_07_08_013950_insert_value', 1),
(29, '2020_08_10_074717_insert_lich_day_bo_sung', 1),
(30, '2021_07_04_225427_insert_value_phan_cong_chi_tiet', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mon_hoc`
--

CREATE TABLE `mon_hoc` (
  `ma_mon_hoc` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ten_mon_tieng_anh` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ten_mon_tieng_viet` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `so_gio` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ma_kieu_thi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `mon_hoc`
--

INSERT INTO `mon_hoc` (`ma_mon_hoc`, `ten_mon_tieng_anh`, `ten_mon_tieng_viet`, `so_gio`, `ma_kieu_thi`) VALUES
('BIT_ACC', 'Business Accounting', 'Kế toán doanh nghiệp', '45', 1),
('BIT_AP', 'Advanced Programming', 'Lập trình nâng cao', '60', 3),
('BIT_CMS', 'Content Management System', 'Hệ quản trị nội dung', '30', 2),
('BIT_DB1', 'Database Principle', 'Nguyên lý cơ sở dữ liệu', '60', 3),
('BIT_DB2', 'Advanced Database Principle', 'Nguyên lý cơ sở dữ liệu nâng cao', '60', 3),
('BIT_DMAR1', 'Digital Marketing - SEO/SEM', 'Digital Marketing - SEO/SEM', '45', 3),
('BIT_DMAR2', 'Digital Marketing - Strategies, Implementations and Practices', 'Digital Marketing - chiến lược, thực hiện', '45', 3),
('BIT_DSA', 'Data Structure and Algorithm', 'Cấu trúc dữ liệu và giải thuật', '60', 3),
('BIT_EB', 'English for Business', 'Tiếng anh chuyên ngành quản trị kinh doanh BIT', '55', 1),
('BIT_ECOM1', 'E-Commerce - Principles and Technologies', 'Thương mại điện tử cơ bản', '45', 1),
('BIT_ECOM2', 'Digital Businesss and E-Commerce Management', 'Quản trị thương mại điện tử', '45', 3),
('BIT_ESE', 'English for Software Engineer', 'Tiếng anh chuyên ngành lập trình BIT', '60', 1),
('BIT_FINANCE', 'Ecomonics', 'Kinh tế học', '45', 1),
('BIT_GE', 'General English', 'Tiếng anh tổng quát', '30', 1),
('BIT_GRADUATION', 'Graduation Dissertation', 'Luận văn tốt nghiệp', '100', 3),
('BIT_HRM', 'Human Resources Management', 'Quản trị nguồn nhân lực', '45', 3),
('BIT_INTERNSHIP', 'Internship', 'Thực tập', '100', 2),
('BIT_ITF', 'IT Fundamental', 'Tin học cơ bản', '45', 2),
('BIT_JSP', 'Web Programming with JSP Servlet', 'Xây dựng ứng dụng Web bằng Java', '60', 2),
('BIT_LAW', 'Business Law', 'Luật kinh tế', '45', 1),
('BIT_MAR', 'Sales and Marketing', 'Marketing căn bản', '45', 1),
('BIT_MATH', 'Mathematics for Business Analytics', 'Toán kinh tế', '60', 1),
('BIT_NET', 'Building .Net Application', 'Xây dựng ứng dụng .Net', '60', 3),
('BIT_OOP', 'Object Oriented Programming', 'Lập trình hướng đối tượng', '60', 3),
('BIT_PHP1', 'Web Programming - PHP Track', 'Lập trình Website PHP', '60', 2),
('BIT_PHP2', 'Advanced Web Development - PHP Track', 'Lập trình Website PHP nâng cao', '60', 2),
('BIT_PLD', 'Programming Logic and Design', 'Nguyên lý lập trình', '60', 2),
('BIT_PRJ1', 'Project 1', 'Đồ án 1', '75', 2),
('BIT_PRJ2', 'Project 2', 'Đồ án 2', '75', 2),
('BIT_PRJ3', 'Project 3', 'Đồ án 3', '45', 3),
('BIT_WEB', 'Building Dynamic Site', 'Xây dựng website động', '60', 3),
('BIT_XML', 'Extensible Markup language', 'Ngôn ngữ XML', '30', 1),
('BKA_.Net1', 'A Guide to C# Language', 'Ngôn ngữ lập trình C#', '56', 3),
('BKA_.Net2', 'Building ASP.Net Web Application', 'Lập trình Website ASP.Net', NULL, 3),
('BKA_AJP', 'Advanced Java Programming', 'Lập trình Java nâng cao', '60', 3),
('BKA_AND', 'Mobile Development with Android', 'Lập trình Mobile Android', '60', 2),
('BKA_ASA', 'ASA', 'Hệ thống bảo mật ISA', '28', 3),
('BKA_C', 'Programming Theory and C Programming', 'Nguyên lý lập trình C', '60', 3),
('BKA_CCNA4OnThi', 'Ôn Thi CCNA4', 'Ôn Thi CCNA4', NULL, 1),
('BKA_CCNASE', 'CCNA-SEC', 'An toàn mạng Cisco (CCNA-SEC)', '70', 3),
('BKA_CCNP', NULL, 'CCNP', NULL, 3),
('BKA_CEH', NULL, 'Hacker mũ trắng (CEHv9)', '50', 3),
('BKA_CMS', 'Content Management System', 'Hệ quản trị nội dung', '30', 2),
('BKA_CyberOp', 'CCNA Cyber Operation', 'Quản trị vận hành bảo mật mạng', '60', 3),
('BKA_DB1', 'Database Principle', 'Nguyên lý cơ sở dữ liệu', '60', 3),
('BKA_DB2', 'Advanced Database Principle', 'Nguyên lý cơ sở dữ liệu nâng cao', '60', 3),
('BKA_DSA', 'Data Structure and Algorithm', 'Cấu trúc dữ liệu và giải thuật', '60', 2),
('BKA_ESE', 'English for Software Engineer', 'Tiếng anh chuyên ngành lập trình', '60', 1),
('BKA_Exchange2016', 'Exchange 2016', 'Quản trị Exchange Server', '40', 3),
('BKA_Graduation', 'Graduation Project', 'Đồ án tốt nghiệp', '120', 3),
('BKA_HAT_AV1', 'English1', 'Anh Văn 1', '24', 1),
('BKA_HAT_AV2', 'English 2', 'Anh Văn 2', '30', 1),
('BKA_HAT_BTMT', 'Bảo trì máy tính', 'Bảo trì máy tính', '37.5', 3),
('BKA_HAT_CSDL', 'Cơ sở dữ liệu', 'Cơ sở dữ liệu', '56.25', 3),
('BKA_HAT_CT', NULL, 'Chính trị', '60', 1),
('BKA_HAT_CTMT', 'Cấu trúc máy tính', 'Cấu trúc máy tính', '41.25', 3),
('BKA_HAT_KTDT', 'Kỹ thuật điện tử', 'Kỹ thuật điện tử', '41.25', 3),
('BKA_HAT_LTCB', NULL, 'Lập trình căn bản', '56.25', 3),
('BKA_HAT_MKD', 'Công nghệ mạng không dây', 'Công nghệ mạng không dây', '37.5', 3),
('BKA_HAT_MMT', 'Nhập môn mạng máy tính', 'Nhập môn mạng máy tính', '37.5', 3),
('BKA_HAT_PL', NULL, 'Pháp luật', '23', 1),
('BKA_HAT_THCB', NULL, 'Tin học căn bản', '42.5', 3),
('BKA_HAT_THVP', 'Tin học văn phòng', 'Tin học văn phòng', '37.5', 3),
('BKA_HAT_TOANCC', NULL, 'Toán cao cấp', '45', 1),
('BKA_HAT_XLA', NULL, 'Xử lý ảnh', '41.25', 3),
('BKA_ICT', 'Tiếng anh chuyên ngành quản trị mạng', 'Tiếng anh chuyên ngành quản trị mạng', '60', 1),
('BKA_INTERN', 'Internship', 'Thực tập', '120', 3),
('BKA_Intership', NULL, NULL, NULL, NULL),
('BKA_IOT', 'Internet of Things', 'Internet Vạn Vật', '30', 3),
('BKA_ITE', 'Information Technology Essentials', 'Chuyên viên CNTT Quốc Tế', NULL, 3),
('BKA_ITF', 'IT Fundamental', 'Tin học cơ bản', '30', 2),
('BKA_JSP', 'Web Programming with JSP Servlet', 'Xây dựng ứng dụng Web bằng Java', '60', 2),
('BKA_LPI101', 'LPI 101', 'Chuyên viên quản trị hệ thống Linux - phần 1', '30', 3),
('BKA_LPI102', 'LPI 102', 'Chuyên viên quản trị hệ thống Linux - phần 2', '30', 3),
('BKA_MCSA1', 'MCSA2016 (70-740)', 'Cài đặt và cấu hình trên hệ thống máy chủ Window Server', '50', 3),
('BKA_MCSA2', 'MCSA2016 (70-741)', 'Quản  trị hệ thống máy chủ Window Server', '50', 3),
('BKA_MCSA3', 'MCSA2016 (70-742)', 'Cấu hình các dịch vụ nâng cao trên Window Server', '50', 3),
('BKA_MCSAOnThi', 'Ôn Thi MCSA', 'Ôn Thi MCSA', NULL, 1),
('BKA_MOBILE', 'Mobile Development', 'Lập trình thiết bị di động', '60', 2),
('BKA_NA1', 'CCNA 1', 'Nguyên tắc cơ bản của mạng máy tính (CCNA1)', '40', 3),
('BKA_NA2', 'CCNA 2', 'Các giao thức  và khía niệm định tuyến (CCNA2)', '70', 3),
('BKA_NA3', 'CCNA 3', 'Chuyển mạch Lan và mạng không dây (CCNA3)', '60', 3),
('BKA_NA4', 'CCNA 4', 'Truy cập mạng WAN (CCNA4)', '50', 3),
('BKA_NET', 'Building .Net Application', 'Xây dựng ứng dụng .Net', '60', 2),
('BKA_NP', NULL, 'Lập trình mạng', NULL, 3),
('BKA_OOP', 'Object Oriented Programming', 'Lập trình hướng đối tượng', '60', 3),
('BKA_PHP1', 'Web Programming with PHP&MySQL', 'Lập trình website PHP - MySQL', '72', 2),
('BKA_PHP2', 'Advanced Web Building with PHP&MySQL', 'Lập trình website PHP - MySQL nâng cao', '60', 2),
('BKA_PRJ1', 'Project 1', 'Đồ án 1', '75', 2),
('BKA_PRJ2', 'Project 2', 'Đồ án 2', '75', 2),
('BKA_PRJ3', 'Project 3', 'Đồ án 3', '60', 2),
('BKA_PRJNetwork', 'Network and System Engineer Project', 'Dự án cho kỹ sư mạng và hệ thống', '90', 2),
('BKA_PROG', 'Programming for Network and System engineer', 'Kiến thức lập trình dành cho kỹ sư mạng và hệ thống', '70', 2),
('BKA_SA', NULL, 'Phân tích thiết kế hệ thống', NULL, 3),
('BKA_SE', 'CCNA- SEC', 'An ninh mạng Cisco (CCNA- SEC)', '70', 3),
('BKA_SQL2016', 'Quản trị CSDL với SQL Server 2016 (70-764)', 'Quản trị CSDL với SQL Server', '30', 3),
('BKA_VMWare', NULL, 'Triển khai và quản trị hệ thống ảo hóa Vmware', '40', 3),
('BKA_WCC', 'Webservices and Cloud Computing Simple', 'Webservices và điện toán đám mây', NULL, 3),
('BKA_WEB', 'Buiding Dynamic Site using HTML5, CSS3 and Javascript', 'Xây dựng website động bằng HTML5', '72', 3),
('BKA_XML', 'Extensible Markup Language', 'Ngôn ngữXML', '30', 1),
('HAT_MH05', NULL, 'Anh văn 1', '35', 1),
('HAT_MH06', NULL, 'Giáo dục Quốc phòng', NULL, 3),
('HAT_MH07', NULL, 'Giáo dục  thể chất', NULL, 3),
('HAT_MH12', NULL, 'Cài đặt và bảo trì máy tính', '35', 3),
('HAT_MH15', NULL, 'Cấu trúc dữ liệu và giải thuật', '85', 3),
('HAT_MH16', NULL, 'Lập trình hướng đối tượng', NULL, 3),
('HAT_MH17', NULL, 'Lập trình Window 1 (VB, C#)', NULL, 3),
('HAT_MH18', NULL, 'Anh văn chuyên ngành', NULL, 1),
('HAT_MH19', NULL, 'Nguyên lý hệ điều hành', NULL, 3),
('HAT_MH20', NULL, 'Cơ sở dữ liệu', NULL, 3),
('HAT_MH21', NULL, 'Hệ quản trị CSDL', NULL, 3),
('HAT_MH22', NULL, 'Thực tập nhận thức', NULL, 2),
('HAT_MH23', NULL, 'Hệ quản trị CSDL SQL Server', NULL, 3),
('HAT_MH24', NULL, 'Lập trình Window2 (ADO.NET)', NULL, 3),
('HAT_MH25', NULL, 'Lập trình Web 1(ASP.NET)', NULL, 3),
('HAT_MH26', NULL, 'Phân tích thiết kế hệ thống', NULL, 3),
('HAT_MH27', NULL, 'Thiết kế web bằng phần mềm mã nguồn mở', NULL, 3),
('HAT_MH28', NULL, 'Hệ điều hành mã nguồn mở', NULL, 3),
('HAT_MH29', NULL, 'Anh văn 1', NULL, 3),
('HAT_MH30', NULL, 'Thực tập nghề nghiệp', NULL, 2),
('HAT_MH31', NULL, 'Lập trình Window 3 (Service)', NULL, 3),
('HAT_MH32', NULL, 'Lập trình Web 2 (XML…)', NULL, 3),
('HAT_MH33', NULL, 'Nhập môn công nghệ phần mềm', NULL, 3),
('HAT_MH34', NULL, 'Xây dựng phần mềm quản lý', NULL, 3),
('HAT_MH35', NULL, 'Lập trình Linux', NULL, 3),
('HAT_MH36', NULL, 'Thực tập tốt nghiệp', NULL, 3),
('HAT_MH37', NULL, 'Đồ án tốt nghiệp', NULL, 3),
('HAT_MH38', NULL, 'Nhập môn mạng máy tính', NULL, 3),
('HAT_MH39', NULL, 'Quản trị mạng 1 (CĐ&QTM)', NULL, 3),
('HAT_MH40', NULL, 'Kỹ thuật truyền số liệu', NULL, 3),
('HAT_MH41', NULL, 'Công nghệ mạng không dây', NULL, 3),
('HAT_MH42', NULL, 'Thiết lập, XD & QT hệ thống WebServer &MailServer', NULL, 3),
('HAT_MH43', NULL, 'Hệ điều hành Linux', NULL, 3),
('HAT_MH44', NULL, 'Quản trị mạng 2', NULL, 3),
('HAT_MH45', NULL, 'Lập trình Java', NULL, 3),
('HAT_MH46', NULL, 'Thiết kế xây dựng mạng LAN', NULL, 3),
('HAT_MH47', NULL, 'Bảo trì hệ thống máy chủ', NULL, 3),
('HAT_MH48', NULL, 'Hệ thống bảo mật TMG', NULL, 3),
('HAT_MH49', NULL, 'Thiết kế Web bằng phần mềm mã nguồn mở', NULL, 3),
('HAT_MH50', NULL, 'Quản trị CSDL khách chủ', NULL, 3),
('HAT_MH51', NULL, 'An toàn mạng', NULL, 3),
('HAT_MH52', NULL, 'Lập trình mạng', NULL, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ngay_nghi`
--

CREATE TABLE `ngay_nghi` (
  `ngay` date NOT NULL,
  `ma_giao_vien` int(10) UNSIGNED NOT NULL,
  `ma_ca` int(10) UNSIGNED NOT NULL,
  `ghi_chu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tinh_trang` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ngay_nghi`
--

INSERT INTO `ngay_nghi` (`ngay`, `ma_giao_vien`, `ma_ca`, `ghi_chu`, `tinh_trang`) VALUES
('0000-00-00', 10, 6, NULL, 1),
('2020-06-23', 1, 1, NULL, 1),
('2020-06-29', 7, 5, NULL, 1),
('2020-07-01', 10, 3, NULL, 2),
('2020-07-09', 1, 3, NULL, 1),
('2020-07-10', 10, 1, 'Đi chơi', 1),
('2020-07-10', 15, 1, 'Đi chơi', 1),
('2020-07-10', 25, 1, 'Đi chơi', 1),
('2020-07-29', 5, 3, NULL, 1),
('2020-08-15', 0, 2, NULL, 1),
('2020-08-15', 6, 2, NULL, 1),
('2020-08-15', 32, 1, 'Đi chơi', 1),
('2020-08-15', 38, 4, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoi_dung`
--

CREATE TABLE `nguoi_dung` (
  `ma_nguoi_dung` int(10) UNSIGNED NOT NULL,
  `ho_ten` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tai_khoan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_khau` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sdt` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_cap_do` int(11) NOT NULL,
  `key` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`ma_nguoi_dung`, `ho_ten`, `tai_khoan`, `mat_khau`, `email`, `sdt`, `ma_cap_do`, `key`) VALUES
(1, NULL, 'superadmin', '$2y$10$QsFvP1ypn13Y0QIv3wgp8OcjMF3tOUWvlOo33SPs.DOTlvZ3K79uC', 'a@gmail.com', '0', 1, '0'),
(2, NULL, 'user', '$2y$10$52uRC43ipAkXVi8/6ncXTeAYJgOil7pUDjxnsRqa2fMRBfPSG65Ru', 'b@gmail.com', '1', 2, '8'),
(3, NULL, 'duong', '$2y$10$9mclPl5.EzYC1soqAzy4L.F7GZLaP8iJpRQ0isbQRyteBq3oeKRMG', 'c@gmail.com', '2', 1, '1'),
(4, NULL, 'cuong', '$2y$10$QXmygRVidcgtVtQ9kP023OAcaFopPPmOJI3hvxRXFQBHpXS8CBnTG', 'd@gmail.com', '4', 1, '4'),
(5, NULL, 'kithuat', '$2y$10$YT2ebq4DUOJWSGD4jYGYOumkxK1IvJV4UppVj3.1N5fus6eLi6jsu', 'kithuat@gmail.com', '6', 2, '3'),
(6, 'Lê Thị Hương Liên', 'yuki.lien85', '$2y$10$ZXWYLah0f0rV9XsE4yxiFecEd78SNxVS1m/aZJ.rGhCOexBL0DupK', 'yuki.lien85@gmail.com', '0989186985', 3, 'u60AOmb2Tlj98ThKmA11Vj9S15vkRyGaYi3LVpML6a4UJvqEI0Imesm5x0sD8sruIVQjzl0YDI1OepXmKvtVTvRnDgfLtt8KqLlZTR5n0ezxRKBosVpjsoZDpFVpoksPPdAx7eP1ENtk1CyOyECDY8oFV5QGWgfdxm5ivXcfj1RJHmAtkcY6Ce0O27j9mGmP4cfa9yFFBp9vTSzZ2hvrFk5nAcNOnOQyK7tCaziT4PxlqieC5dpqzijBbRZfEIqJ'),
(7, 'Lê Kim Dung', 'lekimdungm', '$2y$10$3FM6J1jh3GwNRpb.F5ULl.gQ2bw0iLruLRktH9e9IEjjGM6mJqloG', 'lekimdungm@gmail.com', '0912645179', 3, 'ImK3s2Q20toWv8ugkYS0SkWc0Jt4DMalJOPk9dfgb4wxPGs90OT5jnMxn7QUOan7Qg7etbFJyFNEB9ZfTOt5ftI4a0ukFIgiCXLg6VYE5K5EzQrOd4fq2oCH2mUuwklIUU1SFhHfS7Cgrp9Yzx3lX4mqlDVZgldv6CXOTk9yQZRQ6mKBwsh1tXF0DXuyCopHraAfblpaiHsBTBBzkNaPDIpHHJWYyJdc1QDkTr1E4mQ4CEYG5GqWYGX73mQ6Aug5'),
(8, 'Bùi Thu Thủy', 'thuybt_81', '$2y$10$j4rinQLcEL6wDKgX0o4aDOpNtp7AKI3vjwyD5UDDgQYF/t2iJ04a6', 'thuybt_81@yahoo.com.vn', '0983965985', 3, 'j4oFh0ODzzJFdlwLRQJkCfkLe0y4LLWWP7B7O6TyfxnZyEfogUPQs0LBDfPI6fDzFgwtOfVLhvUqP6vNloCTeSPIFMXyUnCxFfTHbBKFBR24gXzIDTEz4nYRS9MjbvlknebmgHm2AiORrjsuXDv19aQTFwQga8aEGhe4z50H3AeFu1QpWU4ARXkoHiWZqMW8o50uGO3jS6mTBdpromr9fnVCKXrM7Tz8fH08NI5pSnQxGgvOIBk2X52uH50hKhUa'),
(9, 'Vũ Thị Hòa', 'vuthihoa15556', '$2y$10$dYaZ7XpEX8sDM0DBZdW5f.oSNwqLd1xE/ujZZic7ewAXZ3kUavQn.', 'vuthihoa15556@gmail.com', '0982029684', 3, 'a0pcIKWoVRpFtYMa7ayEZoduzQgCBJCewKdpAaHMUGzaSeqVSDL51cy5Xjjq8Fmq97McOyvbNRDelKp0XgARaSjHeMC9KU6ERotYmzJ3wxFSPOfNr83vW6M6CXu7ZpKUU8hDQpWziApe38y45WlmpKqG6aZ97B4fxsdcPMQi5E0lU14qA2tMqiIf36cxIR0PdOb79sT4TD6Pl3NQJBtV8rj8jSrgMtbWe6ZiE5e6apMTBQ4keEKwLdNuIXV9iOWv'),
(10, 'Trần Thị Dung', 'dungtt', '$2y$10$fBl6VM14SPABzJjM4agCy.RDfwHcZqDUGmyffw37EBE7tWu8YFb8W', 'dungtt@soict.hust.edu.vn', '0989161528', 3, 'wNh8RKsVloSvwKqp4vYJOa43S3Z0Vj5c5Su5n3DezBRZSxcpGyUT7ShCZ91Vh7ZMcpIoGqZi4rUGUkLF6M8axa1vA23gHjx4fSyhyhKAHt25YmjrOb4gavchvx4GuTTUS0MF7HnSlVaNGWGgwwAtVXFrJnMYMCVCnzXgLJN71Ng5pdaKH74PDb1jhu87EcMUsCRq8Dfaz3JlFrGFLpFN5my2Cn4KUizRqXZiYjxsmfji1UyGlyI5IN8GdtIyskEz'),
(11, 'Nguyễn Thị Quỳnh Như', 'ntqnhu', '$2y$10$QGzD9raf8kUseOBHq23umODa/M0.zRnU/dJYCQTGmxwxALtRBjmwO', 'ntqnhu@gmail.com', '0908081979', 3, '1tl1TwYT2vgNolLm6wPbN01xbjodhTR2sEtPTmWoIZuJk5EnHh8fIrtzVuka4x7ekSJA6jnCXginfzUZaFgHmVHSV1jPIxhv69CV3G3dya8b3WDJEBCOYka0hsEMcZdzmBNMV1EuilFEqlD2gLmXfKjr1rX3mQvdSYTfIuabHsGmcfAIgaxV3hhVB1kO6JnkhGY4TSHV2Rrfm9PynfcffnSghfSv6qMVgaoHxrkQQQKQe0ju1eEX2i0QoHKM2ILw'),
(12, 'Nguyễn Hùng Cường', 'hungcuong1306', '$2y$10$F86RfyfZZ1yAcp2uImGWa.ivAQsZz6P4Dnu/a9qRZs2PdFUduk57W', 'hungcuong1306@gmail.com', '0983235486', 3, 'U6YYhwd5ohjdU3r6Kv2OoojsazGsjccvLTCNLopH1aJtuljyBs8O7V4k4aqawobLlkcrrXbKgfktG7AfiwEgEU1a5QW28MyMhARITKabdbfRGnERCgXSVpUnG5Hu4oqrmIiSc6TQR43G8sOm0DZUde5NIyIt0yTEDufvrFX32uZHuxLKZnAjyhldhdJ1E7SPv5sr06dxlbDS9g5XAf42Uw9NrL1Xi75AHpNogJxU24vEHfYAFmNITwBQ88IeE8UR'),
(13, 'Nguyễn Hữu Nhạn', 'nhanhn4t', '$2y$10$1/v.xRpEtVXrlSwubqjCfejUSvvS1WT8cS3IdqN.hNwjHOLOAtaoq', 'nhanhn4t@gmail.com', '0967152248', 3, 'pJafIivbzXwInN5ueNgRSRP5CxyGxHEoVVtiQhSp0K3MGWwwxMLidjd6QKalzlRZ0850EowjSuEoHUXflENgXd7jgVMWeAuTLFHy22al1KPPMySbkVl6JzLi0xJP09vbFyQN6F9Nze4ZWpDRlu2LNfvYe0d8HZEY4YfaqWBJP9fjsdOaXsPVGfrHCppbu410vdc8wpA3zRJX0lzV3RMStxcGaTPphR6uzEVupVPJpN7YHNKs5N0ZaNzCD1IJYH4y'),
(14, 'Hoàng Mạnh Đức', 'duchm72', '$2y$10$W9eZFChjgDNPGrrd6VJqWe2ZQo9.VRJ8LhVcdpsJbi69t33DsNfii', 'duchm72@gmail.com', '0989746790', 3, '9RmlXd8Wm3j4oMGNxM7C0XHdgPP2Ia8LtbdlrWrNBDE4vFzZRCmn7sAf2sN6nXT31t0r77uIncoXvrWyCnJjMICe37q2V6apa0JScCfURKh138FUmeiYrp12xbfVbHxV48wPGk13CXfGT3PMn2ZLNfVzQfLP6vM8TGwidEmM9UV1GhgvCOvEo0PfTfje0rFaNHL4ZfinCnwAgjuYsBYex1SyfAvoUX3DHqLbc2rqFm0MC8JkgD5cPknR66ezrgWQ'),
(15, 'Mai Lan Phương', 'mailanphuong.nd', '$2y$10$ZeB2kwcAObKmiYNTeOehn.FuyETrJqMaZcSJpP/ihIWjdzNyScuCi', 'mailanphuong.nd@gmail.com', '0331304503', 3, 'NHX0rdIfRBrgtGe4TsD8bEKqFPIBnDcrohjLCEFUlte8sFGRTLBGbQpsk9nfNtOFMILikzVc4KKqTawDLtH4HgRb2crZZiTNmfY0yYywKE6eXy1eaED2kW5SDXCqjEFgRPW6tDJeYLWq2EZNhPvoiD9PA2EWilBwk072BzCDBGDkoNaqnh2rZ5cDYx0scVlHXyaBaaD1z9RCMSEUSko9ogiDYZwh53hM8OmFEfWbORN0voPunU7yF3ZP35KZIKV6'),
(16, 'Trịnh Ngọc Hưng', 'hungtn', '$2y$10$7FB/z9bQHnFValVG29IAmesiYGHrVbEKJUKQCNVI1VoRiUPSZsu.S', 'hungtn@bkacad.edu.vn', '0912686990', 3, '1bX3mUSoSRBNWxhwMTni0rRuI0eirDPaJMT7ecs4K2dmhcgHBc42f6fG77KAfkcTkCcWuNMYGkZwTjUFQhweY2ZiO0Rw5pHlFrwfQl81RpRGcYve2ZgMXgcAhrIxgD9OoZxHdsSe5FfepDGj2qGn8bl5pwXVTBHhAMFmHHG9kLiBmeugt6sAki3hs57Pbcs0i0anyC02LbHesmXcR7xtYr6OlP8BdUEE0gMwdTvSnRRP94lDyUAmJrMNSnHbbPl8'),
(17, 'Nguyễn Thế Đức', 'ducnt', '$2y$10$ntXgV8vLObv/6kMWi6AK0ON/wex.WYG5VyDTPmGkeY6zDCeDNz3S2', 'ducnt@bkacad.edu.vn', '0988551232', 3, 'dUCUKf4zRjpcaBj3Zi9EBD7jxbpFJG3KgcyThMPRans5vInA1qXA0WJWfR9bF4PwfSmF5UX7NeQN9M9HYlEWArtMNnEp8QJwAn9QeP3Tf9zeTTBhsqjY3ccULy0TZRnMvWJjanxQIbgNRcNGPWDdukgDNL8iBgPlzj13JzMAFepiNhj9tqakcBpuZp4PqMewhF1vPKqn4mLh3pObaXWvCItUfdzucJMl72P2up4GepBmH8ylpdhbPIBcqj65SLb4'),
(18, 'Bùi Trọng Hiệp', 'hiepbt', '$2y$10$tbd9vle.tA/O8.ReNllVrOLNmIVz5wZ1VXown7zgG57sL9lMs5ycy', 'hiepbt@bkacad.edu.vn', '0974123705', 3, '9fwNaaLQFLzPlm7VEg44JYHdutmMSQQR09Rff6KIYnsaXYirm5JyBPYtdQ2oXo753BrjC1oOPJKV3jOQFxaydRuc294UvGlbp18gIx7Mld1wRxPSAb2u1x7inTPTyWyVEkWD5R9eHC67r8tMvoS80lubicOLOJ81GCLciG45EOnmqSj5M2fxHb98Oz8L3Vy4IZ1HiMQbsm4rYUT4LdJwtwIzbprGDRQbD7GRwhmo2LSiSM8OT4HZcPeJHMc5PaKH'),
(19, 'Kiều Đức Hạnh', 'hanhkd', '$2y$10$1OIeBYjgVaRTHuBDzaG21eGWMRxywOM.SxS4fi2hfUyhetgkTDMEy', 'hanhkd@bkacad.edu.vn', '0934401406', 3, 'PCUpR1JGgQdVtNRDHUdnBEZshQ83pEogizLGfYOb3cn5HQziyWQpWeIvJ3QcMPqljNVKc38MHWsUJwtUab9xi317aKLC5D0tNGkGCM4zMN6M6bC9m0QAElp2ObmKPpO25ALE0G7E3J1TubMNjDGMK7dukQlyEEPrK43aelg7M4TnCIr1NmwHWYtKJWriXcF1tIndYNDbZq485X9an1z1VVHLdoBPD8qw2tgXhy2HXDVxyaWed5D9tyDKo6aQEyhT'),
(20, 'Vũ Đức Tuấn', 'tuanvd1204', '$2y$10$RX8jEpzQjkuQYVvtKcx3bOGlaMy7DH6A2Rroj2fo6MeKVRe8TdzF.', 'tuanvd1204@gmail.com', '0904675448', 3, 'uNGCRDwAIxtsVmmiac8W9hjj2i3wQArTgKcy6PRyykZnfI1hsslTpufGYkk9BTNGplKREDQtE3YhlYxDAe77575PFmJPgaghhxPB7GQdjvcBAWj9iQU4arxHnuS9puGMFuTIkBAK4e4PObqfvf80IkQeT9zpyn7OSkQWthrvJRlbM3sbyyZlbHZEhfa1GA689qdGMzsauxB4oDAmRGQFN5tUjxmZw1WlHd2KxaeIO9ZauWimaV43fVdM07OFrcld'),
(21, 'Phạm Thanh Sơn', 'phamthanhson.annd89', '$2y$10$UGsnX.bKX0/vYR.SYmyPoepN7ljUiELHWTKYs6V.AbyLR61nlEqiG', 'phamthanhson.annd89@gmail.com', '0978350489', 3, 'NT0F09PaQ85Q1KxJ4Txft0wVcFTEGefAK1jekvvHvqpgQLIbus8OU9ZtRMTF2PkoKrqDd2i1bwMb7zyFSgFQI0p75h4mLpS9qwtvUFMgt3hu5hfib6zEzllPvY35SqKeX5iJJuNJQ8GIxcfxwO8o89ABphAdZXlbHhqWtxbmIqEpeVi7KIBjgOxkXJtqYoHfzu33TU9BQNQAprVGBv7pU8T6ZB80iBpYymXGSO1v5gJasKbcCKKU1wwdanAJyCUb'),
(22, 'Nguyễn Thị Hạnh', 'nguyenhanh0808', '$2y$10$itCQBqahgsfdM0x1cG0/QOKuY81rAdHXjEO9LMF.ZUUS9EiBDN4kS', 'nguyenhanh0808@gmail.com', '0914321539', 3, '0Sd8O1qgN5bhoc6XClheC1NU6WVFQji9l8iDWD7Ga4ZOE3MfMXB6iKZd9shrSFyKzHqPV3RpbTrhg1z4Mtl88AUjeNZl8PrjpDTogfsUJJM252JKSJaj5Sparfm5lyRCNUajxdPpdfl9LSfeRrjVhZQktGaceImxLfGx4znTwjxLteXylKKUCabCfYcpcbKLFKc18fBZxMR4KoecDywCbIsGOVS0CqFVblHvvKgAOOOHTpHASer7XMB6088ejtAb'),
(23, 'Lê Thị Thiên Hương', 'huong.lethithien', '$2y$10$dZqC1.WUvpFoGYu.CTg4c.Qa9ADttIY8JAF8c56v9SPwQVVKze1YK', 'huong.lethithien@hust.edu.vn', '0983362420', 3, 'kQ7SnXk54wuG3hBhBcDqiANE3e2TdspJvU4SZBabF9BULlNJwGNuseOGQ0sfPMuaIGBsagocfhBr6ZP9V7cOZpK3OMHGHDbatSfSCx8Q3bLCyi0jfuSbeiFmNyiJqxSu5G9Pi1fPdj44JOCTYzTVnCWwYMBJRIWOP7xkdtofFxR9sbyj0OuEPz5jCClhzBkETElm1ocETYQtlHUaBGXTPHyMA5Zl8nTQJZpzzHWdKbPhacdjcbT5d7KsiFNc1eRg'),
(24, 'Bùi Thị Mai', 'maiqt16e', '$2y$10$VopDz063BuUwqsWKNEujSeJbSZv9G8MWqrW62.Ctt0vCMUswo0Evi', 'maiqt16e@gmail.com', '0973402736', 3, 'TQGRLKZxZZgFI4iTa5ejI5lM2OpcfWCgO5mdKcdcNrllbradwc0M1Eh5YZjsjx6XbkyArJAoW8y8Pw9jDtZSh6Z4yqDAbtwQg2bXL1uKMxrgDJFOaOwYBwFvnTvEoFQt4CST3IGMndFSi3NOIiectS9HlUodk6vb0g4wonQpCJ4XPdtXHYXU7TXVJARUFaVtOxQXLldhVOjOPifklPGe0BjzBQitunnHu0QH5IlgiOIDxfhrenos7hSGpaFeJcaV'),
(25, 'Lê Quang Thắng', 'thang.lequang', '$2y$10$5O1fGGWHg7KCcJQ361b8YeOFYL/8hfBsi4azu93y8NFkasPxbfMpG', 'thang.lequang@hust.edu.vn', '0916633320', 3, 'dOGIDEL3VycGEuQY3g2E84FiVtMzs40h2YdlrWinpranWYiw7OSqM7wI0I3eZioc7D7xPiLx6lWQiXVOVzSoVnZqW8ezS0VR12tocbfRKrPQCW0LYcowLFvFpOAgiAFxbEU2kDQWxNLlWtGXRhCICLhcRYw6qpnttGFE2ybvhnc2ff86DtLh4xQiSUutYqv5WWSHU6OqUhUVCMnvdL1cqIludajKp6dmBeQoGVLDKYi1l8Gc3npukpSmj4GIjbXb'),
(26, 'Phạm Minh Đức', 'ducpm77', '$2y$10$fjVpbXY4wGlwsMnf5mUoEeGbbFldSB20NVmz.ENxt00XIlKQUx0gK', 'ducpm77@gmail.com', '0978776268', 3, '5OfqdxDRCEw9YbcVuxVWu9T2ijEjpKFTaj92OU5E6bpyKYZhCV0xTFBREdR7stSC1FFEdOp6Y8ci17UT8kL6fP9CW1yT1equhljsnxjrmhyaZ5ejkeAdncgG0T4kpRcB6jo0xxU3Mms3eGTNqq6bOYuoFILwvK80x7mxOxIF7JqYeAdEf0dbzzB9wX7POi20Yorggb6UkZFSQKaY9NtETKM9VmbvgWzTJL5aIP84U3C5cPPW5irv4vR72JEUwfRR'),
(27, 'Nguyễn Ngọc Tuấn', 'tuannn', '$2y$10$CGTxZV9ESWH4vFlB/spaGOCzyWQ3q/hiiaFw4I8INHV6uKTpzUBsm', 'tuannn@bkacad.edu.vn', '0385869295', 3, 'QNlx71H1ApL3ABwIW20v2y8wiyYUpGEnBHrL1gmIcZkI1oFug7VxQnl12Grrazyyh2R4HYydQesaZ9AA4DjiFFzWUCU8fqVvi1SwxW2GIduZrreYMhEsvPhWXKaQxaW7PuOlHE0lE7s495L1HJz2esCqHCnrmYKiBKp2XFbxju7TlZ3ewNYsTXB0V0wlSZIIpFJbPR4CDvWq3gcG7CTYva7n6hH557jrfWYsLxCHoGmTytJCjUluLvzIc4JbbWji'),
(28, 'Admin', 'kdhanh', '$2y$10$dq/sEHbUrVjh11Sp7sv8AuOJkj/1fz7XwlJGTuE4ELPymS4/aHjXy', 'kdhanh@yahoo.com', '0325627893', 1, '1I8SKODCaDZyhYCb9zsihGVPKqVDxzS6PpGOfQnOeNSD4XvgyOOsY5pQCIVG58QadPxhuwQd94HoJCjgEqjORmDTJvj8YTt56Yo61MDRg9Euw1osNt5sq1ecGofTZawShbk54X5Pxu7cPI2YgI6Udyy36TCM5grwtut7tflg1bEjIrquzxtXtHkvlb8y8VnLfkzSQME4zEqSE0MSxXOYEWjEWe6piYL0QIDmbHfT4m2QrJw4j3IbNfzJaVZvpxYF'),
(29, 'Phạm Thị Thanh Nga', 'ngaptt', '$2y$10$dVMmHAjfW0XZ9h6C6xObyu/PUyLuF.xsVszDksifyQsxWBFYnw9Om', 'ngaptt@bkacad.edu.vn', '0902006681', 1, 'W6CgywRvAlirUHT3jG8SWYFo5mxWcHksaa2P0Bveu2vpD0VHQBKo5JcaNh3GOybKJZBbRhTi2CSK3Ti4AhbM0BdvUDFFRFJZXQr4cnNahMz8g8rGltVLgWvELagZHv2V4607TDIu561PoJQ17JMhntBEP0SSoTBVhd5KDalLv51LF8ODhcB86LRbgl3xOm1s7lCvvvLKyCtSsr00nOiQ00umyOH3mvhlLXqN8Ljavq6vKmhoMg0Qm7Ty6QwDaUn2'),
(30, 'Thương Thương Trần', 'thuongtt', '$2y$10$muWLAKQsY6AW/uh8uhn.0.VHsndMV8yIQr5X5yEaYo0bDtHRmVtfi', 'thuongtt@bkacad.edu.vn', '0975761488', 1, 'UeCivQGJFzGQktJkCEYCItCj6AYYoBjkHYpVTve0BzUdHrTjTQiryWzcGRX6b1YRShZ7JwLFsZX7ugGgvU1K2dj0iNlyUFjzNOoUfhS6Prz2Wc5DZHJgKISUByGBzIrQkouPSiQRtNsR2VH8qChoOm3rlxvYfrFToNuto6k9DRKlDMLsanbQOsRnSVCgrB6RJFenB3hjZJT6MIuZGRZ0MYaZUghMAKP1IDi8P8dSSNaB12E6nxnHaMax2V3WvnpV'),
(31, 'Nguyễn Thị Huyền Trang', 'trang.nth', '$2y$10$b3BdLCQiM7qw6x3NqORzF.LRGszn2zcw7FiIcL9jbmwUENlElSHoO', 'trang.nth@genetic.edu.vn', '0334791135', 2, 'C69E74Pcw831laQPuBdWTFPdgoqjeEahM3Jvv74B7I7o9y9PN3CeyD5rHEuCR32fjZ152gRwC1fxx1EF3RmkJVeg6OGTW3Gw64YhgDWB3XBXgDhIz715sIkE490zSULu6rMuvKumgkfsE4MQLsQWTnvHNXDEOShVODKCaBzZTvhe1nqKQCVx7I7sBKwnS9VkR6nwd0TooOU7cozrnecByNvzBHAJ3cNxW1NY9oSzibikfAXffpZepEFxJ7r8CgHX'),
(32, 'Nguyễn Nam Long', 'long.nn', '$2y$10$4t.x0k9FkuD/t8CNbSarWuVr0ScOWlWiBaE8o7kevzLej8vN4KJK6', 'long.nn@bkacad.edu.vn', '0378050602', 3, 'O1Pehif1RRyKyqCpCn31966AtmAR59Jn6vyDAJCWzxlRvRDfS9LHUo4NdHZBvVKJKEAmbIm89w5esW0hT1zndcd9vvWWAlQBqjuy7ClL313MeJJW3EO9ZKHRIiCP9LMewPmW1IcqKXwuyKzCWRrRfYUHvcCZAftbWePqp3B81tnKIarSrDak7iRRWNPniQGCYNGmSIAexNiDx7sz8RbkrYvU71x9optwwTvqei4xpCDOp46q80r9QVXhYi9c46O5'),
(33, 'Vũ Khánh Hà', 'vukhanhha2992', '$2y$10$hs/mT.iKzLmL1SbHYvAsZeTYroctm/TOR2cbnR9eQjeIHucTOad/m', 'vukhanhha2992@gmail.com', '0316959374', 3, 'bZl8piFaksjAFgXDYhx9nZOqwqQNJpByBa2iZVQLRolveOUzjoakqEfBf1iZwP4poxyt3iLyXNnK6EdHt5ZHfMc5b9tnoOOmPlmeNXSmNKwjOqGcUpsvGPJ2VopsrPG3u0pB36KEG2GbmGEpPUPMuDYLV5pXLATbUd0omIrHsfrAbe5NSf98E85ITODKt49cI1JcpR9DZ2G4S0gdssfhsdGVN35xc7gCOWiAMhNBRD2I0gWYfvSrAHULfEb7ExpO'),
(34, 'Nguyễn Hoàn Vũ', 'nghoanvu060753', '$2y$10$fR.vUGwjiFOwTSn6s.9ZDOe2xqBW9gv68JHMP8RjxWH1hrtz5VlGG', 'nghoanvu060753@gmail.com', '0382312931', 3, 'wnCC1SkfGniIoHdGgtyV4j244U45HiFdso0osFgXhiR3j6RFGeqyb7tCx95rBKlTLmp04Fu9c2dDvnxeCvgGGv6xFPkERGWF1Y9Cvqx8mp5G4aiTPFz9URJwZYQUk3hhbaOsSm9FI1SwrkR4sHq61CQ3Xosm92ADEgDj0g0Gf6cCQPvaYMCbTCcbtCKOCG1193qAOaZkJiBLLXPybeSDDbZnOdG7drgVj4Bz1KEtGG2jwdgQyNMaCQ3horZXwbNK'),
(35, 'Lưu Đức Trung', 'luuductrung', '$2y$10$MJoS0W8dgCTb1AX22if74OBeoyiAEO50geAgP04cq/PdY4QP1zWXS', 'luuductrung@gmail.com', '0906006359', 3, 'E7S18rOvIuT42aiJAWx6BIARR54DSbXB4cBQBMt16OYUH0SuWruIDvLraX1lXaF16oxitatOjco4b60BHXNuuJ4562VKSkIXZaeC0WkhS0I1wCGsfS9iuHbljYyfh3CKBjy9j335LUMjsEg4Nu8WEFEh1Va69fLSsrHX96O9z98xRefJILpYQkCElpsHoPZ5LQtUaWGcTpgk0ADiYkL8bS0AGl5BsZ82Dc9GsoT5YL9ZUC7pqcbbsn83iFnA0Op5'),
(36, 'An Thị Hiên', 'hienat', '$2y$10$hFwA4q9KSsfWdIOFjCw7Ye1MzaJ3JQSIhWncy/BiTu4sd3.CCvtdK', 'hienat@bkacad.edu.vn', '0984942339', 2, 'Z0oAKeiDNvCcmc5tERGCZWRtGIS6ba2OSbtQY6fCy3YgncGfm8oht60icGC20kHQp6w7NfUqjvVDqPq2cB9PZ4iaUFKDcXzLUd29ajeDXNrfl9ukKMb1qAS2mNjWBs0FM0nXlygAMwEnid6zmuWuUgmZd5z8I1E7tH36kRs1dZvKZA5RvStVn3GR5inVkJkCOeBhS1p1SxSfZQVRFcVPBMXbYw46Gq9DCMsXXor4FAkHk7ZVqipqA8yykwF8FJgp'),
(37, 'Trịnh Văn Chung', 'hna.tvchung', '$2y$10$nMzhXNVjWLInyEpjUxbogOIqD7Vme4c57XDs7ankpA2deoKA.lQcm', 'hna.tvchung@gmail.com', '0978611889', 3, 'oAqZlkvMlWhsiVaQwPL5cmpuNUJqSOiILcbnJPGFoxe0gyjLR9nI2hZfRkBTKJPUrrw17Ee0vPsI2I0aVwA9OeuMNGTEkTJkzbgX9TmzM4KecDCq5HUgjy6VvPY5v4KmmsyS5YWmZnetV2k3OhmMG6QUPcChPrBdGTiNmcLOXeaBvn9IneM1av2GY9b1z0fjZ6CLqChqxqzqeBv4awkHBsxSG403z6FjneQcnbAnjysvkBimxjkpvachME5Zj3Z6'),
(38, 'Bùi Thị Mai Anh', 'maianht2', '$2y$10$strDhG4jvUgXVJNIGhDIt.nHxoIF7KCScjRzGKCgKZiziiqHFb1Ey', 'maianht2@gmail.com', '0976707772', 3, 'bf16BGwg1VQi1hnxYYHdROec7pkBvUvSTng6DQDtNNWrR4bwQdCTtpkfMrMQnGYXdqRpcLMbBrWQ8psDyjNSTGH2qMMZFXAlXDVNRDJ6u9nNSq7o1vUE1rpZG77JquGVJmhwd48XhqVWovfAXBDP3s17nrli9I5BkZ8WZfMllx4vT6MfK0MHERuv8eElp7SaLZrV6shFn1BfShNGE01xnBCYEnetOy1VcS0jWJYQYnjAZsw7bRFDH49oUetK4WAs'),
(39, 'Lê  Minh Cường', 'cuonglm1489', '$2y$10$iSCX4ZKCDUSuWoTJdGiZAeGlBYWBDbpqx9n3gZ6QjqAxkbYnSRXq.', 'cuonglm1489@gmail.com', '0979138219', 3, 'HNM92hqOa2ZIhx8cNvgXUEiKkJVLts5q6UVWwsJ6pGcwUNusYx2ngC94plGMaU0BLsWIha36cu9bqhXezjQdUCvkIxRoVeQTRQaOstkTCt8EcAybb1f9NETrB2o5o09uBCLsQS5iHOBBZlGPR1rTxfivTlCGJRALqJlPKPSqK3WoCKPb3liv5K745b8VyONdWeN8ExsR0B5XcDa4ONJFv1bROLA6ShQNZYAaSKUBC6wcujsLdnrHlKv24kCBr4pP'),
(40, 'Mai Thị Thúy Hà', 'hamaibk', '$2y$10$fd8x1eXXmUSpgDbhgjgK3O0GUmmqJ051DnbQnuLaGASwoVGYy.kxa', 'hamaibk@gmail.com', '0984312288', 3, 'feyRGIBRqhtCzrpbWa4q1JHVD9JI9XMWkaep2sNBjzBNmiGVW9d7kbHgUT43cmwldRuPxZiCVOOs0WyBXXZYUGPAz45pdkAWpURp466jkxEfKTfffrRWBIEr2vsHsNG7SAFNg2JoadgG3jgOIpW1ncdb6zHHUoUM0QDvG4x3G94uz48az2AUDEX7quYksgdKv8FpUkR9SNeVc7Sn6PjEFKKnWtj2kH4CtzdofsbjmcgNd6wZ4aoJ0f5e3KpAupBU'),
(41, 'Trần Hoàng Bách', 'tranhoangbach109', '$2y$10$pEkETpqUjloIxRzA8Q8KLul.TpA9p6VSZgYyl6yhmZguM97Cq4zJ.', 'tranhoangbach109@gmail.com', '0975775376', 3, 'OHZVTiiDkp3tiMNJDbZ6jqcV12Olc5qwTC8KhlkgMPhuCdfu0nZLXqiJtgcjJzr5XNFEVuCFJgzdk4BfVaK86q90Jko7sR4hHrdC5YAkQ2s0R5ZJnNnNSf6DZdsUMSCH9n47D4B9q6niAjm4K6u9vBz7prXtBo6DtifXgmvjhWkCxaOt73Zy2wZOjjHyYS9APAjMgR4VeRkdPzFXooZ8ZUF1WaljIgoKSlXbi4v8A6qry0pG14y9YqXsjBzKsFkK'),
(42, 'Nguyễn Ngọc Tân', 'tan.nn', '$2y$10$/TnkGJuWHcRi2KLMHL0tvOu.u.rJFLh.c47oX5lyry8IIUjCna/.C', 'tan.nn@bkacad.edu.vn', '0918206178', 3, '0f0Tu1cwmp9AcW5OXUkx4rujVkxDOafeZ44B2ewfXnIyVdFnfELDmXeBPT8qqlkJgwuYlyGpkKLH8z28qtsLqIy17UTwDYls6jXays5GsOAJ3peYNoRes3Btb9XLcOJPmblCSp5OjKdwTZZ8j9s0UdwAzfTbRzGfx0e3cI2CDl37uUKEUejcrTIMFCTj00yIV68jlUP6yNa3v9fKLgbaBdKGXgwiEGLF4veoWL0T8sHUlWLo0y4wBGhS6CE7IOpA'),
(43, 'Nguyễn Văn Thọ', 'thonv', '$2y$10$66CrlMlJtHMTSPN/91zxSesWm75j75GqAHKJo9cqydmaW2Ww/pkFq', 'thonv@bkacad.edu.vn', '0988276298', 3, 'umUu898yRqpqGzChTV1cCi0VEhYghxxSg9E8NprLWlxYRPnJs2VPxVYAoL8VxuoBvUoghdgxvv3HInNdlfmJmoyPtRBWMbTVk270w5jU6Ti5lCRsEuGK2etMGghkG26617eX9LuvFu7WcSR0uRRrMOlz78dWC03QEssOEWN9EgwS06TdtfwGlmlslL4BLJxadE833eI3MP6DevjtrR9MIGwDOeGGGLr1GbFPoboFrz4UQKkyotBWDk0HvERXvu8n'),
(44, 'Nguyễn Thùy Linh', 'linhnt1601', '$2y$10$h3Fl8giFUZU7CnAxtw0G1eBvOVoAZDoaZtUngwy87ruslFErS.vPa', 'linhnt1601@gmail.com', '0983191601', 3, 'c8taIQuNKDFR4JAt5BBeTdvmeDMdkQem3ZzhC1TMpXGo4YSDUeWKMAfOmRD1DYrtcstS7nIJQ6ls50ks3EOGx0Xy6sxOXI0rmmndqRVGlzWdeNbOLPvXz2Aml4l23mFiyBtoyq2SDw8GVGKBY2kGEpNMYM4M8p9fk8NanI1jYBRLcoFL6LgDmLoEWRu9n6pAMCMnXQ9ivb4NLiaBLipaAqXa8zSY1ls3jc5uLnDIMsx1xY1K2O2UzRunj3Je63Zq'),
(45, 'Nguyễn Quốc Tuấn', 'tuannq', '$2y$10$ytHwic.SdJn6jlgpU5xQ4OUdoDpZLuW1ftZSF7Ua2HxV4omMvO6mC', 'tuannq@hactech.edu.vn', '0989186603', 3, 'V7WlZD5WmMDxhl8woL6AWW1Vk87MvctxtwshnKuWPZ1Ec6CC5m1XVJlQPzO7IKrgcP5mtzXeNtnOkgpKMB4gyxNjWSCaU0DTQnxSFnjQcOswHbs0Q2HuHrvI6fRdnm3rHOpCEdTyBeJftUEgxvFYv7v9sVmDAtGZmbjJSr9YGPDVfUia95fJpBVKE5WWnsKCeeQSGTxPH00FIsNB9DCI0XHT68Nc0KBA5Y0t1vYmsbJ8g0w1JHRZiRV6dn9X1r2F'),
(46, 'Phạm Sơn Tùng', 'tungps', '$2y$10$QErAqa4u.BLKUcqz8InsVOmgLb9VnlHOLDOoKinnfkqqAFagdofY6', 'tungps@bkacad.edu.vn', '0394385948', 3, 'KY470Sp8wvznGaxaglZR6axcQY7v8FqvGhgAVha4HHnBCToqAhbcW09JonWhMS6m2YSUY8hMy19oD1BTqGW0DoWR83EwgO9sXrU8BE4PqGvwcL1nKAjxSYRMGkSyOarsduUMyvoxQnAJpInlhXQgYrYhnB1PePSVT2y3fUFzcKx7s0DegWXPmw06cFVVURmvGwUskXvzGPzQAhRnFWRMkauwR2nsWaa6sXHJmbzzmS2uH5mP4axBfrsIFF50qCeR'),
(47, 'Lưu Khánh Linh', 'linhlk', '$2y$10$k15EG/X2JLc3utywSdDfUuiSD.QW7oAGJKItg065vChUv7sWa7aBG', 'linhlk@bkacad.edu.vn', '0912161767', 3, 'Nu9bANRnAxl0F75bE9kWAKS5vTHIRAoEC3oMTyNHTrLZbBWrSc80As4j1cCFnAGy6bEZ3XsDlrvGhk14EP7LSdBmTImrPO4QYaUcpSUkNumfY2ffjTw8uSRRjZjimrSzmint8qq6tYUKxdNTGYc7SXySCyRt1wN131ZiBeCu0Nj5y7ETxcSO2is4ZDiKfkG44BiLPJWUUxdRFJ7dCgkJFbS8prTl24B0QgleaEWEWnqkXILwt93aHJ5adAy7zjYf'),
(48, 'Nguyễn Thị Thu Hà', 'hantt', '$2y$10$4V1n3Zh0/awUB0v9uHJPOOLAEYVAc0FaA9c6b4cRJHoNifNvdb2kW', 'hantt@bkacad.edu.vn', '0978461604', 3, 'wrNgcDYwMmG9f5ACiDDUu3O4TIoEios96HdlryAUonHEWHS1DHsbaUQd8jQJj490DnZ1FO5jXZCiqLOJnErjE94tOKPsuvCs2nQs1tQWTH4W6rcWAWzgyXINzzlGp7c17JAF1NXd8vLTGQioCTQr523zG9CxcKqe2kv8dG5HCHBelxMerGMsestzO6Ec7eXoF7AKGqaS5AaVdwAPs2W1M1KPuZ2iLpK4W0rmpNjSQChNjvMiRVfJl9q8FLk2rB0s'),
(49, 'Tô Xuân Lược', 'xuanluoc', '$2y$10$SKsWbPb74MIlSgIgn5sEkOP.8.278PIqZYmrkkX0Xcaodo4A8YBe2', 'xuanluoc@gmail.com', '0914273444', 3, 'FHUCowVwID4c2r8vxkLAbFz9tJFukUiMfMIsLSOcMcLQWl2pxXuy3OC6Su232j9Dcf15zdCtCtXTeIPkTTspfysSejFu3rqMlNSUGGdPBCLs3JNvQWBxiNDUxJZeIrCpDPsD0NJERNNBRbBGYlINFv4d3j1UDjFjzlgjDWKeMQTcdQlTznFxX9nteQaC5FsYTb6M6PaSWKxyQoiZL5n11Kg99WS60e1vQLCEvqEahjgETyxl946oeJ9y4aKGlfI4');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoi_dung_bo_mon`
--

CREATE TABLE `nguoi_dung_bo_mon` (
  `ma_nguoi_dung` int(10) UNSIGNED NOT NULL,
  `ma_mon_hoc` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoi_dung_bo_mon`
--

INSERT INTO `nguoi_dung_bo_mon` (`ma_nguoi_dung`, `ma_mon_hoc`) VALUES
(6, 'BIT_EB'),
(6, 'BIT_ESE'),
(6, 'BKA_ESE'),
(6, 'BKA_HAT_AV1'),
(6, 'BKA_HAT_AV2'),
(7, 'BKA_ESE'),
(7, 'BKA_HAT_AV1'),
(7, 'BKA_HAT_AV2'),
(7, 'BKA_ICT'),
(8, 'BIT_GE'),
(8, 'BKA_HAT_AV1'),
(8, 'BKA_HAT_AV2'),
(8, 'BKA_ICT'),
(9, 'BKA_HAT_TOANCC'),
(10, 'BKA_HAT_CTMT'),
(10, 'BKA_HAT_THCB'),
(10, 'BKA_HAT_THVP'),
(11, 'BKA_HAT_MMT'),
(11, 'BKA_HAT_XLA'),
(12, 'BKA_HAT_CSDL'),
(13, 'BKA_HAT_XLA'),
(14, 'BKA_CCNA4OnThi'),
(14, 'BKA_CCNASE'),
(14, 'BKA_IOT'),
(14, 'BKA_NA3'),
(14, 'BKA_NA4'),
(15, 'BKA_HAT_AV1'),
(15, 'BKA_HAT_AV2'),
(16, 'BIT_ITF'),
(16, 'BKA_CEH'),
(16, 'BKA_Exchange2016'),
(16, 'BKA_HAT_THCB'),
(16, 'BKA_HAT_THVP'),
(16, 'BKA_LPI101'),
(16, 'BKA_LPI102'),
(16, 'BKA_MCSA1'),
(16, 'BKA_MCSA2'),
(16, 'BKA_MCSA3'),
(16, 'BKA_MCSAOnThi'),
(16, 'BKA_SQL2016'),
(16, 'BKA_VMWare'),
(17, 'BIT_CMS'),
(17, 'BIT_ITF'),
(17, 'BKA_CMS'),
(17, 'BKA_Exchange2016'),
(17, 'BKA_HAT_BTMT'),
(17, 'BKA_HAT_CTMT'),
(17, 'BKA_HAT_LTCB'),
(17, 'BKA_HAT_THCB'),
(17, 'BKA_LPI101'),
(17, 'BKA_LPI102'),
(17, 'BKA_MCSA1'),
(17, 'BKA_MCSA2'),
(17, 'BKA_MCSA3'),
(17, 'BKA_VMWare'),
(18, 'BKA_HAT_MKD'),
(18, 'BKA_HAT_MMT'),
(18, 'BKA_NA2'),
(18, 'BKA_NA3'),
(18, 'BKA_NA4'),
(19, 'BIT_CMS'),
(19, 'BIT_DB1'),
(19, 'BIT_ITF'),
(19, 'BIT_PHP1'),
(19, 'BIT_PLD'),
(19, 'BIT_PRJ1'),
(19, 'BIT_PRJ2'),
(19, 'BIT_PRJ3'),
(19, 'BIT_WEB'),
(19, 'BKA_AJP'),
(19, 'BKA_C'),
(19, 'BKA_CMS'),
(19, 'BKA_DB1'),
(19, 'BKA_DB2'),
(19, 'BKA_DSA'),
(19, 'BKA_Graduation'),
(19, 'BKA_HAT_CSDL'),
(19, 'BKA_HAT_LTCB'),
(19, 'BKA_Intership'),
(19, 'BKA_JSP'),
(19, 'BKA_MOBILE'),
(19, 'BKA_NET'),
(19, 'BKA_OOP'),
(19, 'BKA_PHP1'),
(19, 'BKA_PHP2'),
(19, 'BKA_PRJ1'),
(19, 'BKA_PRJ2'),
(19, 'BKA_PRJ3'),
(19, 'BKA_SQL2016'),
(19, 'BKA_WEB'),
(19, 'BKA_XML'),
(21, 'BKA_HAT_PL'),
(22, 'BKA_HAT_CT'),
(24, 'BIT_EB'),
(24, 'BIT_ESE'),
(24, 'BIT_GE'),
(24, 'BKA_ESE'),
(24, 'BKA_HAT_AV1'),
(24, 'BKA_HAT_AV2'),
(25, 'BKA_HAT_CTMT'),
(25, 'BKA_HAT_KTDT'),
(32, 'BIT_DB1'),
(32, 'BIT_PHP1'),
(32, 'BIT_PRJ1'),
(32, 'BKA_DB2'),
(32, 'BKA_PHP1'),
(32, 'BKA_PHP2'),
(32, 'BKA_PRJ1'),
(32, 'BKA_PRJ2'),
(32, 'BKA_WEB'),
(33, 'BIT_GE'),
(33, 'BKA_HAT_AV1'),
(34, 'BKA_HAT_TOANCC'),
(35, 'BKA_HAT_THCB'),
(37, 'BKA_OOP'),
(37, 'BKA_WEB'),
(38, 'BKA_OOP'),
(39, 'BKA_AJP'),
(39, 'BKA_JSP'),
(39, 'BKA_OOP'),
(39, 'BKA_WEB'),
(41, 'BKA_HAT_CTMT'),
(41, 'BKA_HAT_MMT'),
(41, 'BKA_HAT_THCB'),
(42, 'BKA_HAT_CTMT'),
(42, 'BKA_HAT_MMT'),
(42, 'BKA_HAT_THCB'),
(43, 'BKA_HAT_MMT'),
(44, 'BKA_HAT_CSDL'),
(45, 'BKA_LPI101'),
(46, 'BKA_PROG'),
(46, 'BKA_WEB'),
(47, 'BKA_PROG'),
(48, 'BKA_HAT_AV1'),
(48, 'BKA_ICT'),
(49, 'BKA_HAT_TOANCC');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan_cong`
--

CREATE TABLE `phan_cong` (
  `ma_phan_cong` int(10) UNSIGNED NOT NULL,
  `ma_lop` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_mon_hoc` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_nguoi_dung` int(11) DEFAULT NULL,
  `tinh_trang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phan_cong`
--

INSERT INTO `phan_cong` (`ma_phan_cong`, `ma_lop`, `ma_mon_hoc`, `ma_nguoi_dung`, `tinh_trang`) VALUES
(1, 'BIT01K10', 'BIT_CMS', 19, 0),
(2, 'BIT01K10', 'BIT_DB1', 19, 1),
(3, 'BIT01K10', 'BIT_EB', 24, 2),
(4, 'BIT01K10', 'BIT_ECOM1', NULL, 2),
(5, 'BIT01K10', 'BIT_ESE', 24, 2),
(6, 'BIT01K10', 'BIT_GE', NULL, 2),
(7, 'BIT01K10', 'BIT_ITF', 19, 2),
(8, 'BIT01K10', 'BIT_PHP1', 19, 0),
(9, 'BIT01K10', 'BIT_PLD', 19, 2),
(10, 'BIT01K10', 'BIT_PRJ1', 19, 0),
(11, 'BIT01K10', 'BIT_PRJ2', 19, 0),
(12, 'BIT01K10', 'BIT_PRJ3', 19, 0),
(13, 'BIT01K10', 'BIT_WEB', 19, 2),
(14, 'BIT01K11', 'BIT_ITF', 16, 0),
(15, 'BIT02K10', 'BIT_CMS', NULL, 0),
(16, 'BIT02K10', 'BIT_DB1', 32, 1),
(17, 'BIT02K10', 'BIT_EB', 6, 2),
(18, 'BIT02K10', 'BIT_ECOM1', NULL, 2),
(19, 'BIT02K10', 'BIT_ESE', 6, 2),
(20, 'BIT02K10', 'BIT_GE', 33, 2),
(21, 'BIT02K10', 'BIT_ITF', 19, 2),
(22, 'BIT02K10', 'BIT_PHP1', 32, 1),
(23, 'BIT02K10', 'BIT_PLD', 19, 2),
(24, 'BIT02K10', 'BIT_PRJ1', 32, 0),
(25, 'BIT02K10', 'BIT_WEB', 19, 2),
(26, 'BIT02K11', 'BIT_ITF', 16, 0),
(27, 'BIT03K10', 'BIT_CMS', NULL, 0),
(28, 'BIT03K10', 'BIT_DB1', NULL, 0),
(29, 'BIT03K10', 'BIT_EB', 24, 0),
(30, 'BIT03K10', 'BIT_ECOM1', NULL, 2),
(31, 'BIT03K10', 'BIT_ESE', 24, 2),
(32, 'BIT03K10', 'BIT_GE', 24, 2),
(33, 'BIT03K10', 'BIT_ITF', 17, 2),
(34, 'BIT03K10', 'BIT_MAR', NULL, 0),
(35, 'BIT03K10', 'BIT_PHP1', 32, 0),
(36, 'BIT03K10', 'BIT_PLD', 19, 2),
(37, 'BIT03K10', 'BIT_WEB', 19, 2),
(38, 'BIT03K11', 'BIT_ITF', 16, 0),
(39, 'BIT04K10', 'BIT_CMS', 17, 0),
(40, 'BIT04K10', 'BIT_DB1', 19, 1),
(41, 'BIT04K10', 'BIT_ECOM1', NULL, 2),
(42, 'BIT04K10', 'BIT_ESE', 6, 2),
(43, 'BIT04K10', 'BIT_GE', 8, 0),
(44, 'BIT04K10', 'BIT_ITF', 17, 0),
(45, 'BIT04K10', 'BIT_PHP1', 19, 1),
(46, 'BIT04K10', 'BIT_PLD', 19, 1),
(47, 'BIT04K10', 'BIT_WEB', 19, 1),
(48, 'BIT04K11', 'BIT_ITF', 16, 0),
(49, 'BKA08K9', 'BKA_OOP', 19, 1),
(50, 'BKC01K8', 'BKA_CCNA4OnThi', 14, 0),
(51, 'BKC01K8', 'BKA_CCNASE', 14, 0),
(52, 'BKC01K8', 'BKA_CEH', 16, 0),
(53, 'BKC01K8', 'BKA_Exchange2016', 16, 0),
(54, 'BKC01K8', 'BKA_IOT', 14, 0),
(55, 'BKC01K8', 'BKA_LPI101', 17, 0),
(56, 'BKC01K8', 'BKA_LPI102', 17, 0),
(57, 'BKC01K8', 'BKA_MCSAOnThi', 16, 0),
(58, 'BKC01K8', 'BKA_PROG', NULL, 0),
(59, 'BKC01K9', 'BKA_CCNASE', 14, 2),
(60, 'BKC01K9', 'BKA_CEH', 16, 0),
(61, 'BKC01K9', 'BKA_Exchange2016', 17, 0),
(62, 'BKC01K9', 'BKA_HAT_AV2', 15, 2),
(63, 'BKC01K9', 'BKA_HAT_BTMT', 17, 2),
(64, 'BKC01K9', 'BKA_HAT_CSDL', NULL, 0),
(65, 'BKC01K9', 'BKA_HAT_CT', NULL, 2),
(66, 'BKC01K9', 'BKA_HAT_CTMT', 17, 2),
(67, 'BKC01K9', 'BKA_HAT_LTCB', NULL, 2),
(68, 'BKC01K9', 'BKA_HAT_MKD', 18, 2),
(69, 'BKC01K9', 'BKA_HAT_MMT', 18, 2),
(70, 'BKC01K9', 'BKA_HAT_PL', NULL, 2),
(71, 'BKC01K9', 'BKA_HAT_THVP', 16, 2),
(72, 'BKC01K9', 'BKA_ICT', 7, 2),
(73, 'BKC01K9', 'BKA_LPI101', 16, 0),
(74, 'BKC01K9', 'BKA_LPI102', 16, 0),
(75, 'BKC01K9', 'BKA_MCSA1', 16, 2),
(76, 'BKC01K9', 'BKA_MCSA2', 17, 2),
(77, 'BKC01K9', 'BKA_MCSA3', 17, 2),
(78, 'BKC01K9', 'BKA_NA2', 18, 2),
(79, 'BKC01K9', 'BKA_NA3', 14, 2),
(80, 'BKC01K9', 'BKA_NA4', 14, 2),
(81, 'BKC01K9', 'BKA_VMWare', 17, 2),
(82, 'BKC01NK8', 'BKA_AJP', 19, 1),
(83, 'BKC01NK8', 'BKA_DSA', 19, 2),
(84, 'BKC01NK8', 'BKA_JSP', 19, 1),
(85, 'BKC01NK8', 'BKA_MOBILE', 19, 1),
(86, 'BKC01NK8', 'BKA_NET', 19, 1),
(87, 'BKC01NK8', 'BKA_PRJ3', 19, 2),
(88, 'BKC01TK8', 'BKA_AJP', 19, 2),
(89, 'BKC01TK8', 'BKA_DSA', 19, 2),
(90, 'BKC01TK8', 'BKA_JSP', 19, 2),
(91, 'BKC01TK8', 'BKA_MOBILE', 19, 2),
(92, 'BKC01TK8', 'BKA_NET', 19, 1),
(93, 'BKC01TK8', 'BKA_PRJ3', 19, 2),
(94, 'BKC02K8', 'BKA_CCNA4OnThi', 14, 0),
(95, 'BKC02K8', 'BKA_CCNASE', 14, 0),
(96, 'BKC02K8', 'BKA_CEH', 16, 0),
(97, 'BKC02K8', 'BKA_Exchange2016', 16, 0),
(98, 'BKC02K8', 'BKA_LPI101', 17, 0),
(99, 'BKC02K8', 'BKA_LPI102', 17, 0),
(100, 'BKC02K8', 'BKA_MCSAOnThi', 16, 0),
(101, 'BKC02K8', 'BKA_PROG', NULL, 0),
(102, 'BKC02K8', 'BKA_SQL2016', 16, 0),
(103, 'BKC02K9', 'BKA_CCNASE', 14, 2),
(104, 'BKC02K9', 'BKA_CEH', 16, 0),
(105, 'BKC02K9', 'BKA_Exchange2016', 17, 0),
(106, 'BKC02K9', 'BKA_HAT_AV2', 8, 2),
(107, 'BKC02K9', 'BKA_HAT_BTMT', 17, 2),
(108, 'BKC02K9', 'BKA_HAT_CSDL', NULL, 0),
(109, 'BKC02K9', 'BKA_HAT_CTMT', 17, 2),
(110, 'BKC02K9', 'BKA_HAT_LTCB', NULL, 2),
(111, 'BKC02K9', 'BKA_HAT_MKD', 18, 2),
(112, 'BKC02K9', 'BKA_HAT_MMT', 18, 2),
(113, 'BKC02K9', 'BKA_HAT_THVP', 16, 2),
(114, 'BKC02K9', 'BKA_ICT', 8, 2),
(115, 'BKC02K9', 'BKA_LPI101', 16, 0),
(116, 'BKC02K9', 'BKA_LPI102', 16, 0),
(117, 'BKC02K9', 'BKA_MCSA1', 16, 2),
(118, 'BKC02K9', 'BKA_MCSA2', 17, 2),
(119, 'BKC02K9', 'BKA_MCSA3', 17, 2),
(120, 'BKC02K9', 'BKA_NA2', 18, 2),
(121, 'BKC02K9', 'BKA_NA3', 18, 2),
(122, 'BKC02K9', 'BKA_NA4', 18, 2),
(123, 'BKC02K9', 'BKA_VMWare', 17, 0),
(124, 'BKC03K8', 'BKA_CCNA4OnThi', 14, 0),
(125, 'BKC03K8', 'BKA_CCNASE', 14, 0),
(126, 'BKC03K8', 'BKA_CEH', 16, 0),
(127, 'BKC03K8', 'BKA_Exchange2016', 16, 0),
(128, 'BKC03K8', 'BKA_LPI101', 17, 0),
(129, 'BKC03K8', 'BKA_LPI102', 17, 0),
(130, 'BKC03K8', 'BKA_MCSAOnThi', 16, 0),
(131, 'BKC03K8', 'BKA_PROG', NULL, 0),
(132, 'BKC03K8', 'BKA_SQL2016', 16, 0),
(133, 'BKC03K9', 'BKA_HAT_AV2', 8, 0),
(134, 'BKC03K9', 'BKA_HAT_BTMT', 17, 0),
(135, 'BKC03K9', 'BKA_HAT_CSDL', 12, 0),
(136, 'BKC03K9', 'BKA_HAT_CTMT', 25, 0),
(137, 'BKC03K9', 'BKA_HAT_LTCB', 17, 0),
(138, 'BKC03K9', 'BKA_HAT_MKD', 18, 1),
(139, 'BKC03K9', 'BKA_HAT_MMT', 18, 1),
(140, 'BKC03K9', 'BKA_ICT', 7, 0),
(141, 'BKC03K9', 'BKA_NA2', 18, 1),
(142, 'BKC0405TK8', 'BKA_AJP', 19, 1),
(143, 'BKC0405TK8', 'BKA_DSA', 19, 1),
(144, 'BKC0405TK8', 'BKA_JSP', 19, 1),
(145, 'BKC0405TK8', 'BKA_MOBILE', 19, 1),
(146, 'BKC0405TK8', 'BKA_NET', 19, 1),
(147, 'BKC0405TK8', 'BKA_PRJ3', 19, 1),
(148, 'BKC040607NK8', 'BKA_AJP', 19, 1),
(149, 'BKC040607NK8', 'BKA_DSA', 19, 1),
(150, 'BKC040607NK8', 'BKA_JSP', 19, 1),
(151, 'BKC040607NK8', 'BKA_MOBILE', 19, 1),
(152, 'BKC040607NK8', 'BKA_NET', 19, 1),
(153, 'BKC040607NK8', 'BKA_PRJ3', 19, 1),
(154, 'BKC04K8', 'BKA_AJP', NULL, 0),
(155, 'BKC04K8', 'BKA_C', 19, 1),
(156, 'BKC04K8', 'BKA_CMS', 19, 1),
(157, 'BKC04K8', 'BKA_DB1', 19, 1),
(158, 'BKC04K8', 'BKA_DB2', 19, 1),
(159, 'BKC04K8', 'BKA_DSA', 19, 1),
(160, 'BKC04K8', 'BKA_Graduation', 19, 1),
(161, 'BKC04K8', 'BKA_HAT_CSDL', 19, 1),
(162, 'BKC04K8', 'BKA_Intership', 19, 1),
(163, 'BKC04K8', 'BKA_JSP', 19, 1),
(164, 'BKC04K8', 'BKA_MOBILE', 19, 1),
(165, 'BKC04K8', 'BKA_NET', 19, 1),
(166, 'BKC04K8', 'BKA_OOP', 19, 1),
(167, 'BKC04K8', 'BKA_PHP1', 19, 1),
(168, 'BKC04K8', 'BKA_PHP2', NULL, 0),
(169, 'BKC04K8', 'BKA_PRJ1', 19, 1),
(170, 'BKC04K8', 'BKA_PRJ2', 19, 1),
(171, 'BKC04K8', 'BKA_PRJ3', 19, 1),
(172, 'BKC04K8', 'BKA_SQL2016', 19, 1),
(173, 'BKC04K8', 'BKA_WEB', 19, 1),
(174, 'BKC04K8', 'BKA_XML', 19, 1),
(175, 'BKC04K9', 'BKA_CCNASE', 14, 0),
(176, 'BKC04K9', 'BKA_CEH', 16, 0),
(177, 'BKC04K9', 'BKA_Exchange2016', 16, 2),
(178, 'BKC04K9', 'BKA_HAT_AV1', NULL, 2),
(179, 'BKC04K9', 'BKA_HAT_AV2', 15, 2),
(180, 'BKC04K9', 'BKA_HAT_BTMT', 17, 2),
(181, 'BKC04K9', 'BKA_HAT_CSDL', NULL, 0),
(182, 'BKC04K9', 'BKA_HAT_CT', NULL, 2),
(183, 'BKC04K9', 'BKA_HAT_CTMT', 17, 2),
(184, 'BKC04K9', 'BKA_HAT_LTCB', NULL, 2),
(185, 'BKC04K9', 'BKA_HAT_MKD', 18, 2),
(186, 'BKC04K9', 'BKA_HAT_MMT', 18, 2),
(187, 'BKC04K9', 'BKA_HAT_PL', NULL, 2),
(188, 'BKC04K9', 'BKA_HAT_THCB', NULL, 2),
(189, 'BKC04K9', 'BKA_HAT_THVP', 16, 2),
(190, 'BKC04K9', 'BKA_HAT_TOANCC', NULL, 2),
(191, 'BKC04K9', 'BKA_ICT', 8, 2),
(192, 'BKC04K9', 'BKA_LPI101', 45, 0),
(193, 'BKC04K9', 'BKA_LPI102', 16, 0),
(194, 'BKC04K9', 'BKA_MCSA1', 16, 2),
(195, 'BKC04K9', 'BKA_MCSA2', 16, 2),
(196, 'BKC04K9', 'BKA_MCSA3', 16, 2),
(197, 'BKC04K9', 'BKA_NA2', 18, 2),
(198, 'BKC04K9', 'BKA_NA3', 18, 2),
(199, 'BKC04K9', 'BKA_NA4', 18, 2),
(200, 'BKC04K9', 'BKA_SQL2016', 16, 2),
(201, 'BKC04K9', 'BKA_VMWare', 16, 2),
(202, 'BKC0508NK8', 'BKA_AJP', 19, 1),
(203, 'BKC0508NK8', 'BKA_DSA', 19, 1),
(204, 'BKC0508NK8', 'BKA_JSP', 19, 1),
(205, 'BKC0508NK8', 'BKA_MOBILE', 19, 1),
(206, 'BKC0508NK8', 'BKA_NET', 19, 1),
(207, 'BKC0508NK8', 'BKA_PRJ3', 19, 1),
(208, 'BKC05K8', 'BKA_AJP', NULL, 0),
(209, 'BKC05K8', 'BKA_C', 19, 1),
(210, 'BKC05K8', 'BKA_CMS', 19, 1),
(211, 'BKC05K8', 'BKA_DB1', 19, 1),
(212, 'BKC05K8', 'BKA_DB2', 19, 1),
(213, 'BKC05K8', 'BKA_DSA', 19, 1),
(214, 'BKC05K8', 'BKA_Graduation', 19, 1),
(215, 'BKC05K8', 'BKA_HAT_CSDL', 19, 1),
(216, 'BKC05K8', 'BKA_Intership', 19, 1),
(217, 'BKC05K8', 'BKA_JSP', 19, 1),
(218, 'BKC05K8', 'BKA_MOBILE', 19, 1),
(219, 'BKC05K8', 'BKA_NET', 19, 1),
(220, 'BKC05K8', 'BKA_OOP', 19, 1),
(221, 'BKC05K8', 'BKA_PHP1', 19, 1),
(222, 'BKC05K8', 'BKA_PHP2', NULL, 0),
(223, 'BKC05K8', 'BKA_PRJ1', 19, 1),
(224, 'BKC05K8', 'BKA_PRJ2', 19, 1),
(225, 'BKC05K8', 'BKA_PRJ3', 19, 1),
(226, 'BKC05K8', 'BKA_SQL2016', 19, 1),
(227, 'BKC05K8', 'BKA_WEB', 19, 1),
(228, 'BKC05K8', 'BKA_XML', 19, 1),
(229, 'BKC05K9', 'BKA_AJP', 39, 1),
(230, 'BKC05K9', 'BKA_CMS', NULL, 2),
(231, 'BKC05K9', 'BKA_DB1', NULL, 2),
(232, 'BKC05K9', 'BKA_ESE', 6, 2),
(233, 'BKC05K9', 'BKA_HAT_AV1', NULL, 2),
(234, 'BKC05K9', 'BKA_HAT_AV2', 24, 2),
(235, 'BKC05K9', 'BKA_HAT_BTMT', 17, 1),
(236, 'BKC05K9', 'BKA_HAT_CSDL', NULL, 1),
(237, 'BKC05K9', 'BKA_HAT_CTMT', 17, 1),
(238, 'BKC05K9', 'BKA_HAT_LTCB', NULL, 2),
(239, 'BKC05K9', 'BKA_HAT_MKD', 18, 2),
(240, 'BKC05K9', 'BKA_HAT_MMT', 18, 0),
(241, 'BKC05K9', 'BKA_HAT_THVP', 16, 2),
(242, 'BKC05K9', 'BKA_ITF', NULL, 2),
(243, 'BKC05K9', 'BKA_OOP', 38, 2),
(244, 'BKC05K9', 'BKA_PHP1', NULL, 2),
(245, 'BKC05K9', 'BKA_PRJ1', 32, 1),
(246, 'BKC05K9', 'BKA_SQL2016', NULL, 0),
(247, 'BKC05K9', 'BKA_WEB', NULL, 2),
(248, 'BKC060708TK8', 'BKA_AJP', 19, 1),
(249, 'BKC060708TK8', 'BKA_DSA', 19, 1),
(250, 'BKC060708TK8', 'BKA_JSP', 19, 1),
(251, 'BKC060708TK8', 'BKA_MOBILE', 19, 1),
(252, 'BKC060708TK8', 'BKA_NET', 19, 1),
(253, 'BKC060708TK8', 'BKA_PRJ3', 19, 1),
(254, 'BKC06K9', 'BKA_AJP', 39, 2),
(255, 'BKC06K9', 'BKA_CMS', NULL, 2),
(256, 'BKC06K9', 'BKA_DB2', 32, 2),
(257, 'BKC06K9', 'BKA_ESE', 6, 2),
(258, 'BKC06K9', 'BKA_HAT_AV1', NULL, 2),
(259, 'BKC06K9', 'BKA_HAT_AV2', 24, 2),
(260, 'BKC06K9', 'BKA_HAT_BTMT', 17, 2),
(261, 'BKC06K9', 'BKA_HAT_CSDL', NULL, 2),
(262, 'BKC06K9', 'BKA_HAT_CT', NULL, 2),
(263, 'BKC06K9', 'BKA_HAT_CTMT', 17, 2),
(264, 'BKC06K9', 'BKA_HAT_LTCB', NULL, 2),
(265, 'BKC06K9', 'BKA_HAT_MKD', 18, 2),
(266, 'BKC06K9', 'BKA_HAT_MMT', 18, 2),
(267, 'BKC06K9', 'BKA_HAT_PL', NULL, 2),
(268, 'BKC06K9', 'BKA_HAT_THCB', NULL, 2),
(269, 'BKC06K9', 'BKA_HAT_THVP', 16, 2),
(270, 'BKC06K9', 'BKA_HAT_TOANCC', NULL, 2),
(271, 'BKC06K9', 'BKA_HAT_XLA', NULL, 2),
(272, 'BKC06K9', 'BKA_JSP', 39, 1),
(273, 'BKC06K9', 'BKA_OOP', 37, 2),
(274, 'BKC06K9', 'BKA_PHP1', NULL, 2),
(275, 'BKC06K9', 'BKA_PHP2', 32, 1),
(276, 'BKC06K9', 'BKA_PRJ1', 32, 2),
(277, 'BKC06K9', 'BKA_PRJ2', 32, 1),
(278, 'BKC06K9', 'BKA_SQL2016', NULL, 0),
(279, 'BKC06K9', 'BKA_WEB', NULL, 2),
(280, 'BKC06va07K8', 'BKA_AJP', NULL, 0),
(281, 'BKC06va07K8', 'BKA_CMS', NULL, 1),
(282, 'BKC06va07K8', 'BKA_DB1', NULL, 1),
(283, 'BKC06va07K8', 'BKA_DB2', 19, 1),
(284, 'BKC06va07K8', 'BKA_DSA', 19, 1),
(285, 'BKC06va07K8', 'BKA_Graduation', NULL, 1),
(286, 'BKC06va07K8', 'BKA_HAT_CSDL', NULL, 1),
(287, 'BKC06va07K8', 'BKA_JSP', NULL, 1),
(288, 'BKC06va07K8', 'BKA_MOBILE', NULL, 1),
(289, 'BKC06va07K8', 'BKA_NET', NULL, 1),
(290, 'BKC06va07K8', 'BKA_OOP', NULL, 1),
(291, 'BKC06va07K8', 'BKA_PHP1', NULL, 1),
(292, 'BKC06va07K8', 'BKA_PHP2', NULL, 0),
(293, 'BKC06va07K8', 'BKA_PRJ1', NULL, 1),
(294, 'BKC06va07K8', 'BKA_PRJ2', 19, 1),
(295, 'BKC06va07K8', 'BKA_PRJ3', NULL, 1),
(296, 'BKC06va07K8', 'BKA_SQL2016', NULL, 1),
(297, 'BKC06va07K8', 'BKA_XML', 19, 1),
(298, 'BKC07K9', 'BKA_CMS', NULL, 2),
(299, 'BKC07K9', 'BKA_ESE', 6, 2),
(300, 'BKC07K9', 'BKA_HAT_AV2', 6, 1),
(301, 'BKC07K9', 'BKA_HAT_BTMT', 17, 1),
(302, 'BKC07K9', 'BKA_HAT_CSDL', NULL, 1),
(303, 'BKC07K9', 'BKA_HAT_CTMT', 17, 1),
(304, 'BKC07K9', 'BKA_HAT_LTCB', NULL, 1),
(305, 'BKC07K9', 'BKA_HAT_MKD', 18, 0),
(306, 'BKC07K9', 'BKA_HAT_MMT', 18, 0),
(307, 'BKC07K9', 'BKA_HAT_THVP', 16, 1),
(308, 'BKC07K9', 'BKA_OOP', 19, 1),
(309, 'BKC07K9', 'BKA_PHP1', NULL, 1),
(310, 'BKC07K9', 'BKA_PRJ1', 32, 1),
(311, 'BKC07K9', 'BKA_SQL2016', NULL, 0),
(312, 'BKC07K9', 'BKA_WEB', NULL, 1),
(313, 'BKC08K8', 'BKA_AJP', NULL, 0),
(314, 'BKC08K8', 'BKA_CMS', NULL, 1),
(315, 'BKC08K8', 'BKA_DB1', NULL, 0),
(316, 'BKC08K8', 'BKA_DB2', 19, 1),
(317, 'BKC08K8', 'BKA_DSA', NULL, 0),
(318, 'BKC08K8', 'BKA_Graduation', NULL, 0),
(319, 'BKC08K8', 'BKA_HAT_CSDL', NULL, 0),
(320, 'BKC08K8', 'BKA_JSP', NULL, 0),
(321, 'BKC08K8', 'BKA_MOBILE', NULL, 0),
(322, 'BKC08K8', 'BKA_NET', NULL, 1),
(323, 'BKC08K8', 'BKA_OOP', NULL, 0),
(324, 'BKC08K8', 'BKA_PHP1', NULL, 0),
(325, 'BKC08K8', 'BKA_PHP2', NULL, 0),
(326, 'BKC08K8', 'BKA_PRJ1', NULL, 0),
(327, 'BKC08K8', 'BKA_PRJ2', 19, 1),
(328, 'BKC08K8', 'BKA_PRJ3', NULL, 0),
(329, 'BKC08K8', 'BKA_SQL2016', NULL, 0),
(330, 'BKC08K8', 'BKA_WEB', NULL, 0),
(331, 'BKC08K8', 'BKA_XML', 19, 1),
(332, 'BKC08K9', 'BKA_AJP', 39, 1),
(333, 'BKC08K9', 'BKA_C', NULL, 2),
(334, 'BKC08K9', 'BKA_CMS', NULL, 2),
(335, 'BKC08K9', 'BKA_DB1', NULL, 2),
(336, 'BKC08K9', 'BKA_DB2', NULL, 2),
(337, 'BKC08K9', 'BKA_ESE', 24, 2),
(338, 'BKC08K9', 'BKA_HAT_AV2', 6, 2),
(339, 'BKC08K9', 'BKA_HAT_BTMT', 17, 2),
(340, 'BKC08K9', 'BKA_HAT_CSDL', NULL, 2),
(341, 'BKC08K9', 'BKA_HAT_CTMT', 17, 2),
(342, 'BKC08K9', 'BKA_HAT_LTCB', NULL, 2),
(343, 'BKC08K9', 'BKA_HAT_MKD', 18, 2),
(344, 'BKC08K9', 'BKA_HAT_MMT', 18, 2),
(345, 'BKC08K9', 'BKA_HAT_THVP', 16, 2),
(346, 'BKC08K9', 'BKA_OOP', 39, 2),
(347, 'BKC08K9', 'BKA_PHP1', NULL, 2),
(348, 'BKC08K9', 'BKA_PHP2', NULL, 0),
(349, 'BKC08K9', 'BKA_PRJ1', NULL, 2),
(350, 'BKC08K9', 'BKA_SQL2016', NULL, 0),
(351, 'BKC08K9', 'BKA_WEB', NULL, 2),
(352, 'BKC08K9', 'BKA_XML', NULL, 2),
(353, 'BKC09K9', 'BKA_AJP', 19, 1),
(354, 'BKC09K9', 'BKA_CMS', NULL, 2),
(355, 'BKC09K9', 'BKA_DB2', 32, 2),
(356, 'BKC09K9', 'BKA_ESE', 7, 2),
(357, 'BKC09K9', 'BKA_HAT_AV2', 7, 2),
(358, 'BKC09K9', 'BKA_HAT_BTMT', 17, 2),
(359, 'BKC09K9', 'BKA_HAT_CSDL', NULL, 2),
(360, 'BKC09K9', 'BKA_HAT_CT', NULL, 2),
(361, 'BKC09K9', 'BKA_HAT_CTMT', 17, 2),
(362, 'BKC09K9', 'BKA_HAT_LTCB', NULL, 2),
(363, 'BKC09K9', 'BKA_HAT_MKD', 18, 2),
(364, 'BKC09K9', 'BKA_HAT_MMT', 18, 2),
(365, 'BKC09K9', 'BKA_HAT_THVP', 16, 0),
(366, 'BKC09K9', 'BKA_OOP', 38, 2),
(367, 'BKC09K9', 'BKA_PHP1', 32, 2),
(368, 'BKC09K9', 'BKA_PHP2', 19, 2),
(369, 'BKC09K9', 'BKA_PRJ1', 32, 2),
(370, 'BKC09K9', 'BKA_PRJ2', NULL, 0),
(371, 'BKC09K9', 'BKA_SQL2016', 19, 1),
(372, 'BKC09K9', 'BKA_WEB', 32, 2),
(373, 'BKC09K9', 'BKA_XML', 19, 1),
(374, 'BKC10K9', 'BKA_AJP', 19, 2),
(375, 'BKC10K9', 'BKA_CMS', 17, 2),
(376, 'BKC10K9', 'BKA_DB2', 19, 1),
(377, 'BKC10K9', 'BKA_ESE', 6, 2),
(378, 'BKC10K9', 'BKA_HAT_AV2', 7, 2),
(379, 'BKC10K9', 'BKA_HAT_BTMT', 17, 2),
(380, 'BKC10K9', 'BKA_HAT_CSDL', NULL, 2),
(381, 'BKC10K9', 'BKA_HAT_CTMT', 17, 2),
(382, 'BKC10K9', 'BKA_HAT_LTCB', NULL, 2),
(383, 'BKC10K9', 'BKA_HAT_MKD', 18, 2),
(384, 'BKC10K9', 'BKA_HAT_MMT', 18, 2),
(385, 'BKC10K9', 'BKA_HAT_THVP', 16, 2),
(386, 'BKC10K9', 'BKA_JSP', 19, 1),
(387, 'BKC10K9', 'BKA_OOP', 19, 2),
(388, 'BKC10K9', 'BKA_PHP1', 19, 2),
(389, 'BKC10K9', 'BKA_PHP2', 32, 2),
(390, 'BKC10K9', 'BKA_PRJ1', 32, 2),
(391, 'BKC10K9', 'BKA_PRJ2', 32, 1),
(392, 'BKC10K9', 'BKA_SQL2016', 19, 1),
(393, 'BKC10K9', 'BKA_WEB', 19, 2),
(394, 'BKC10K9', 'BKA_XML', 19, 1),
(395, 'BKC11K9', 'BKA_AJP', NULL, 0),
(396, 'BKC11K9', 'BKA_CMS', NULL, 2),
(397, 'BKC11K9', 'BKA_DB2', 32, 2),
(398, 'BKC11K9', 'BKA_ESE', 24, 2),
(399, 'BKC11K9', 'BKA_HAT_AV2', 8, 2),
(400, 'BKC11K9', 'BKA_HAT_BTMT', 17, 2),
(401, 'BKC11K9', 'BKA_HAT_CSDL', NULL, 2),
(402, 'BKC11K9', 'BKA_HAT_CTMT', 17, 2),
(403, 'BKC11K9', 'BKA_HAT_LTCB', NULL, 2),
(404, 'BKC11K9', 'BKA_HAT_MKD', 18, 2),
(405, 'BKC11K9', 'BKA_HAT_MMT', 18, 2),
(406, 'BKC11K9', 'BKA_HAT_THVP', 16, 2),
(407, 'BKC11K9', 'BKA_OOP', 37, 2),
(408, 'BKC11K9', 'BKA_PHP1', 32, 2),
(409, 'BKC11K9', 'BKA_PHP2', 32, 2),
(410, 'BKC11K9', 'BKA_PRJ1', 32, 2),
(411, 'BKC11K9', 'BKA_PRJ2', 32, 1),
(412, 'BKC11K9', 'BKA_SQL2016', 19, 1),
(413, 'BKC11K9', 'BKA_WEB', 32, 2),
(414, 'BKC11K9', 'BKA_XML', 19, 1),
(415, 'BKC12K9', 'BKA_CMS', 19, 1),
(416, 'BKC12K9', 'BKA_ESE', 6, 0),
(417, 'BKC12K9', 'BKA_HAT_AV2', 7, 1),
(418, 'BKC12K9', 'BKA_HAT_BTMT', 17, 0),
(419, 'BKC12K9', 'BKA_HAT_CSDL', 19, 1),
(420, 'BKC12K9', 'BKA_HAT_CTMT', 10, 0),
(421, 'BKC12K9', 'BKA_HAT_LTCB', 17, 0),
(422, 'BKC12K9', 'BKA_HAT_MMT', 11, 1),
(423, 'BKC12K9', 'BKA_SQL2016', 19, 1),
(424, 'BKC12K9', 'BKA_WEB', 19, 1),
(425, 'BKD01K10', 'BKA_ESE', 6, 0),
(426, 'BKD01K10', 'BKA_WEB', 32, 0),
(427, 'BKD01K11', 'BKA_HAT_AV1', 15, 0),
(428, 'BKD01K11', 'BKA_HAT_CT', 22, 0),
(429, 'BKD01K11', 'BKA_HAT_THCB', 42, 0),
(430, 'BKD01K11', 'BKA_HAT_TOANCC', 34, 0),
(431, 'BKD01K9', 'BKA_DB2', 19, 0),
(432, 'BKD01K9', 'BKA_JSP', 19, 0),
(433, 'BKD01K9', 'BKA_PRJ2', 19, 0),
(434, 'BKD02K10', 'BKA_ESE', 24, 0),
(435, 'BKD02K10', 'BKA_WEB', 46, 0),
(436, 'BKD02K11', 'BKA_HAT_AV1', 48, 0),
(437, 'BKD02K11', 'BKA_HAT_CT', 22, 0),
(438, 'BKD02K11', 'BKA_HAT_THCB', 42, 0),
(439, 'BKD02K11', 'BKA_HAT_TOANCC', 34, 0),
(440, 'BKD02K9', 'BKA_DB2', 19, 0),
(441, 'BKD02K9', 'BKA_JSP', 19, 0),
(442, 'BKD02K9', 'BKA_PRJ2', 19, 0),
(443, 'BKD03K10', 'BKA_ESE', 6, 0),
(444, 'BKD03K10', 'BKA_WEB', 37, 0),
(445, 'BKD03K11', 'BKA_HAT_AV1', 48, 0),
(446, 'BKD03K11', 'BKA_HAT_CT', 22, 0),
(447, 'BKD03K11', 'BKA_HAT_THCB', 42, 0),
(448, 'BKD03K11', 'BKA_HAT_TOANCC', 34, 0),
(449, 'BKD03K9', 'BKA_DB2', 19, 0),
(450, 'BKD03K9', 'BKA_JSP', 19, 0),
(451, 'BKD03K9', 'BKA_PRJ2', 19, 0),
(452, 'BKD04K10', 'BKA_ESE', 6, 0),
(453, 'BKD04K10', 'BKA_WEB', 39, 0),
(454, 'BKD04K11', 'BKA_HAT_AV1', 48, 0),
(455, 'BKD04K11', 'BKA_HAT_CT', 22, 0),
(456, 'BKD04K11', 'BKA_HAT_TOANCC', 34, 0),
(457, 'BKD04K9', 'BKA_DB2', 19, 0),
(458, 'BKD04K9', 'BKA_JSP', 19, 0),
(459, 'BKD04K9', 'BKA_PRJ2', 19, 0),
(460, 'BKD05K10', 'BKA_ESE', 6, 0),
(461, 'BKD05K10', 'BKA_WEB', 46, 0),
(462, 'BKD05K11', 'BKA_HAT_AV1', 7, 0),
(463, 'BKD05K11', 'BKA_HAT_PL', 21, 0),
(464, 'BKD05K11', 'BKA_HAT_THCB', 42, 0),
(465, 'BKD05K11', 'BKA_HAT_TOANCC', 49, 0),
(466, 'BKD06K11', 'BKA_HAT_AV1', 7, 0),
(467, 'BKD06K11', 'BKA_HAT_PL', 21, 0),
(468, 'BKD06K11', 'BKA_HAT_THCB', 41, 0),
(469, 'BKD06K11', 'BKA_HAT_TOANCC', 49, 0),
(470, 'BKD07K11', 'BKA_HAT_AV1', 6, 0),
(471, 'BKD07K11', 'BKA_HAT_CT', 22, 0),
(472, 'BKD07K11', 'BKA_HAT_THCB', 17, 0),
(473, 'BKD07K11', 'BKA_HAT_TOANCC', 9, 0),
(474, 'BKD08K11', 'BKA_HAT_AV1', 6, 0),
(475, 'BKD08K11', 'BKA_HAT_CT', 22, 0),
(476, 'BKD08K11', 'BKA_HAT_THCB', 17, 0),
(477, 'BKD08K11', 'BKA_HAT_TOANCC', 9, 0),
(478, 'BKG01K10N1', 'BKA_HAT_AV1', 8, 2),
(479, 'BKG01K10N1', 'BKA_HAT_AV2', NULL, 2),
(480, 'BKG01K10N1', 'BKA_HAT_BTMT', 17, 2),
(481, 'BKG01K10N1', 'BKA_HAT_CSDL', NULL, 0),
(482, 'BKG01K10N1', 'BKA_HAT_CT', 22, 2),
(483, 'BKG01K10N1', 'BKA_HAT_CTMT', 17, 2),
(484, 'BKG01K10N1', 'BKA_HAT_KTDT', 25, 2),
(485, 'BKG01K10N1', 'BKA_HAT_LTCB', 19, 2),
(486, 'BKG01K10N1', 'BKA_HAT_MKD', 18, 2),
(487, 'BKG01K10N1', 'BKA_HAT_MMT', 43, 2),
(488, 'BKG01K10N1', 'BKA_HAT_PL', 21, 2),
(489, 'BKG01K10N1', 'BKA_HAT_THCB', 16, 2),
(490, 'BKG01K10N1', 'BKA_HAT_THVP', 16, 2),
(491, 'BKG01K10N1', 'BKA_HAT_TOANCC', 9, 2),
(492, 'BKG01K10N2', 'BKA_HAT_AV1', 8, 2),
(493, 'BKG01K10N2', 'BKA_HAT_AV2', NULL, 2),
(494, 'BKG01K10N2', 'BKA_HAT_BTMT', 17, 2),
(495, 'BKG01K10N2', 'BKA_HAT_CSDL', NULL, 0),
(496, 'BKG01K10N2', 'BKA_HAT_CT', 22, 2),
(497, 'BKG01K10N2', 'BKA_HAT_CTMT', 17, 2),
(498, 'BKG01K10N2', 'BKA_HAT_KTDT', 25, 2),
(499, 'BKG01K10N2', 'BKA_HAT_LTCB', 19, 2),
(500, 'BKG01K10N2', 'BKA_HAT_MKD', 18, 2),
(501, 'BKG01K10N2', 'BKA_HAT_MMT', 43, 2),
(502, 'BKG01K10N2', 'BKA_HAT_PL', 21, 2),
(503, 'BKG01K10N2', 'BKA_HAT_THCB', 16, 2),
(504, 'BKG01K10N2', 'BKA_HAT_THVP', 16, 2),
(505, 'BKG01K10N2', 'BKA_HAT_TOANCC', 9, 2),
(506, 'BKG01K10N3', 'BKA_HAT_AV1', 15, 2),
(507, 'BKG01K10N3', 'BKA_HAT_AV2', 7, 2),
(508, 'BKG01K10N3', 'BKA_HAT_BTMT', 17, 2),
(509, 'BKG01K10N3', 'BKA_HAT_CSDL', NULL, 0),
(510, 'BKG01K10N3', 'BKA_HAT_CT', 22, 2),
(511, 'BKG01K10N3', 'BKA_HAT_CTMT', 17, 2),
(512, 'BKG01K10N3', 'BKA_HAT_KTDT', 25, 2),
(513, 'BKG01K10N3', 'BKA_HAT_LTCB', 19, 2),
(514, 'BKG01K10N3', 'BKA_HAT_MKD', 18, 2),
(515, 'BKG01K10N3', 'BKA_HAT_MMT', 42, 2),
(516, 'BKG01K10N3', 'BKA_HAT_PL', 21, 2),
(517, 'BKG01K10N3', 'BKA_HAT_THCB', 16, 2),
(518, 'BKG01K10N3', 'BKA_HAT_THVP', 10, 2),
(519, 'BKG01K10N3', 'BKA_HAT_TOANCC', 9, 2),
(520, 'BKG01K10N4', 'BKA_HAT_AV1', 24, 2),
(521, 'BKG01K10N4', 'BKA_HAT_AV2', 7, 2),
(522, 'BKG01K10N4', 'BKA_HAT_BTMT', 17, 2),
(523, 'BKG01K10N4', 'BKA_HAT_CSDL', NULL, 0),
(524, 'BKG01K10N4', 'BKA_HAT_CT', 22, 2),
(525, 'BKG01K10N4', 'BKA_HAT_CTMT', 17, 2),
(526, 'BKG01K10N4', 'BKA_HAT_KTDT', 25, 2),
(527, 'BKG01K10N4', 'BKA_HAT_LTCB', 19, 2),
(528, 'BKG01K10N4', 'BKA_HAT_MKD', 18, 2),
(529, 'BKG01K10N4', 'BKA_HAT_MMT', 42, 2),
(530, 'BKG01K10N4', 'BKA_HAT_PL', 21, 2),
(531, 'BKG01K10N4', 'BKA_HAT_THCB', 16, 2),
(532, 'BKG01K10N4', 'BKA_HAT_THVP', 10, 2),
(533, 'BKG01K10N4', 'BKA_HAT_TOANCC', 9, 2),
(534, 'BKG02K10N1', 'BKA_HAT_AV1', 7, 2),
(535, 'BKG02K10N1', 'BKA_HAT_AV2', 7, 2),
(536, 'BKG02K10N1', 'BKA_HAT_BTMT', 17, 2),
(537, 'BKG02K10N1', 'BKA_HAT_CSDL', 44, 2),
(538, 'BKG02K10N1', 'BKA_HAT_CT', 22, 2),
(539, 'BKG02K10N1', 'BKA_HAT_CTMT', 17, 2),
(540, 'BKG02K10N1', 'BKA_HAT_LTCB', NULL, 2),
(541, 'BKG02K10N1', 'BKA_HAT_MKD', 18, 2),
(542, 'BKG02K10N1', 'BKA_HAT_MMT', 18, 2),
(543, 'BKG02K10N1', 'BKA_HAT_PL', 21, 2),
(544, 'BKG02K10N1', 'BKA_HAT_THCB', 35, 2),
(545, 'BKG02K10N1', 'BKA_HAT_THVP', 16, 2),
(546, 'BKG02K10N1', 'BKA_HAT_TOANCC', 34, 2),
(547, 'BKG02K10N1', 'BKA_HAT_XLA', 13, 2),
(548, 'BKG02K10N2', 'BKA_HAT_AV1', 7, 2),
(549, 'BKG02K10N2', 'BKA_HAT_AV2', 7, 2),
(550, 'BKG02K10N2', 'BKA_HAT_BTMT', 17, 2),
(551, 'BKG02K10N2', 'BKA_HAT_CSDL', 44, 2),
(552, 'BKG02K10N2', 'BKA_HAT_CT', 22, 2),
(553, 'BKG02K10N2', 'BKA_HAT_CTMT', 17, 2),
(554, 'BKG02K10N2', 'BKA_HAT_LTCB', NULL, 2),
(555, 'BKG02K10N2', 'BKA_HAT_MKD', 18, 2),
(556, 'BKG02K10N2', 'BKA_HAT_MMT', 18, 2),
(557, 'BKG02K10N2', 'BKA_HAT_PL', 21, 2),
(558, 'BKG02K10N2', 'BKA_HAT_THCB', 35, 2),
(559, 'BKG02K10N2', 'BKA_HAT_THVP', 16, 2),
(560, 'BKG02K10N2', 'BKA_HAT_TOANCC', 34, 2),
(561, 'BKG02K10N2', 'BKA_HAT_XLA', 13, 2),
(562, 'BKG02K10N3', 'BKA_HAT_AV1', 6, 2),
(563, 'BKG02K10N3', 'BKA_HAT_AV2', 15, 2),
(564, 'BKG02K10N3', 'BKA_HAT_BTMT', 17, 2),
(565, 'BKG02K10N3', 'BKA_HAT_CSDL', NULL, 2),
(566, 'BKG02K10N3', 'BKA_HAT_CT', 22, 2),
(567, 'BKG02K10N3', 'BKA_HAT_CTMT', 17, 2),
(568, 'BKG02K10N3', 'BKA_HAT_LTCB', NULL, 2),
(569, 'BKG02K10N3', 'BKA_HAT_MKD', 18, 2),
(570, 'BKG02K10N3', 'BKA_HAT_MMT', 18, 2),
(571, 'BKG02K10N3', 'BKA_HAT_PL', 21, 2),
(572, 'BKG02K10N3', 'BKA_HAT_THCB', 10, 2),
(573, 'BKG02K10N3', 'BKA_HAT_THVP', 10, 2),
(574, 'BKG02K10N3', 'BKA_HAT_TOANCC', 34, 2),
(575, 'BKG02K10N3', 'BKA_HAT_XLA', 11, 2),
(576, 'BKG02K10N4', 'BKA_HAT_AV1', 6, 2),
(577, 'BKG02K10N4', 'BKA_HAT_AV2', 15, 0),
(578, 'BKG02K10N4', 'BKA_HAT_BTMT', 17, 0),
(579, 'BKG02K10N4', 'BKA_HAT_CSDL', NULL, 0),
(580, 'BKG02K10N4', 'BKA_HAT_CT', 22, 2),
(581, 'BKG02K10N4', 'BKA_HAT_CTMT', 17, 0),
(582, 'BKG02K10N4', 'BKA_HAT_LTCB', NULL, 0),
(583, 'BKG02K10N4', 'BKA_HAT_MKD', 18, 1),
(584, 'BKG02K10N4', 'BKA_HAT_MMT', 18, 1),
(585, 'BKG02K10N4', 'BKA_HAT_PL', 21, 2),
(586, 'BKG02K10N4', 'BKA_HAT_THCB', 10, 0),
(587, 'BKG02K10N4', 'BKA_HAT_THVP', 10, 0),
(588, 'BKG02K10N4', 'BKA_HAT_TOANCC', 34, 2),
(589, 'BKG02K10N4', 'BKA_HAT_XLA', 11, 1),
(590, 'BKG03K10N1', 'BKA_HAT_AV1', 6, 2),
(591, 'BKG03K10N1', 'BKA_HAT_AV2', 7, 2),
(592, 'BKG03K10N1', 'BKA_HAT_BTMT', 17, 2),
(593, 'BKG03K10N1', 'BKA_HAT_CSDL', NULL, 2),
(594, 'BKG03K10N1', 'BKA_HAT_CT', 22, 2),
(595, 'BKG03K10N1', 'BKA_HAT_CTMT', 42, 2),
(596, 'BKG03K10N1', 'BKA_HAT_LTCB', NULL, 2),
(597, 'BKG03K10N1', 'BKA_HAT_MKD', 18, 2),
(598, 'BKG03K10N1', 'BKA_HAT_MMT', 18, 2),
(599, 'BKG03K10N1', 'BKA_HAT_PL', 21, 2),
(600, 'BKG03K10N1', 'BKA_HAT_THCB', 10, 2),
(601, 'BKG03K10N1', 'BKA_HAT_THVP', 16, 2),
(602, 'BKG03K10N1', 'BKA_HAT_TOANCC', 9, 2),
(603, 'BKG03K10N1', 'BKA_HAT_XLA', 13, 2),
(604, 'BKG03K10N2', 'BKA_HAT_AV1', 6, 2),
(605, 'BKG03K10N2', 'BKA_HAT_AV2', 6, 2),
(606, 'BKG03K10N2', 'BKA_HAT_BTMT', 17, 2),
(607, 'BKG03K10N2', 'BKA_HAT_CSDL', NULL, 2),
(608, 'BKG03K10N2', 'BKA_HAT_CT', 22, 2),
(609, 'BKG03K10N2', 'BKA_HAT_CTMT', 42, 2),
(610, 'BKG03K10N2', 'BKA_HAT_LTCB', NULL, 2),
(611, 'BKG03K10N2', 'BKA_HAT_MKD', 18, 2),
(612, 'BKG03K10N2', 'BKA_HAT_MMT', 18, 2),
(613, 'BKG03K10N2', 'BKA_HAT_PL', 21, 2),
(614, 'BKG03K10N2', 'BKA_HAT_THCB', 10, 2),
(615, 'BKG03K10N2', 'BKA_HAT_THVP', 16, 2),
(616, 'BKG03K10N2', 'BKA_HAT_TOANCC', 9, 2),
(617, 'BKG03K10N2', 'BKA_HAT_XLA', 13, 2),
(618, 'BKG03K10N3', 'BKA_HAT_AV1', 7, 2),
(619, 'BKG03K10N3', 'BKA_HAT_AV2', 6, 2),
(620, 'BKG03K10N3', 'BKA_HAT_BTMT', 17, 2),
(621, 'BKG03K10N3', 'BKA_HAT_CSDL', NULL, 2),
(622, 'BKG03K10N3', 'BKA_HAT_CT', 22, 2),
(623, 'BKG03K10N3', 'BKA_HAT_CTMT', 41, 2),
(624, 'BKG03K10N3', 'BKA_HAT_LTCB', NULL, 2),
(625, 'BKG03K10N3', 'BKA_HAT_MKD', 18, 2),
(626, 'BKG03K10N3', 'BKA_HAT_MMT', 18, 2),
(627, 'BKG03K10N3', 'BKA_HAT_PL', 21, 2),
(628, 'BKG03K10N3', 'BKA_HAT_THCB', 35, 2),
(629, 'BKG03K10N3', 'BKA_HAT_THVP', 10, 2),
(630, 'BKG03K10N3', 'BKA_HAT_TOANCC', 9, 2),
(631, 'BKG03K10N3', 'BKA_HAT_XLA', 13, 2),
(632, 'BKG03K10N4', 'BKA_HAT_AV1', 7, 2),
(633, 'BKG03K10N4', 'BKA_HAT_AV2', 6, 2),
(634, 'BKG03K10N4', 'BKA_HAT_BTMT', 17, 2),
(635, 'BKG03K10N4', 'BKA_HAT_CSDL', NULL, 2),
(636, 'BKG03K10N4', 'BKA_HAT_CT', 22, 2),
(637, 'BKG03K10N4', 'BKA_HAT_CTMT', 41, 2),
(638, 'BKG03K10N4', 'BKA_HAT_LTCB', NULL, 2),
(639, 'BKG03K10N4', 'BKA_HAT_MKD', 18, 2),
(640, 'BKG03K10N4', 'BKA_HAT_MMT', 18, 2),
(641, 'BKG03K10N4', 'BKA_HAT_PL', 21, 2),
(642, 'BKG03K10N4', 'BKA_HAT_THCB', 35, 2),
(643, 'BKG03K10N4', 'BKA_HAT_THVP', 10, 2),
(644, 'BKG03K10N4', 'BKA_HAT_TOANCC', 9, 2),
(645, 'BKG03K10N4', 'BKA_HAT_XLA', 13, 2),
(646, 'BKG04K10N1', 'BKA_HAT_AV1', 33, 2),
(647, 'BKG04K10N1', 'BKA_HAT_AV2', 6, 2),
(648, 'BKG04K10N1', 'BKA_HAT_BTMT', 17, 2),
(649, 'BKG04K10N1', 'BKA_HAT_CSDL', NULL, 0),
(650, 'BKG04K10N1', 'BKA_HAT_CT', 22, 2),
(651, 'BKG04K10N1', 'BKA_HAT_CTMT', 17, 2),
(652, 'BKG04K10N1', 'BKA_HAT_KTDT', 25, 2),
(653, 'BKG04K10N1', 'BKA_HAT_LTCB', 19, 2),
(654, 'BKG04K10N1', 'BKA_HAT_MKD', 18, 2),
(655, 'BKG04K10N1', 'BKA_HAT_MMT', 41, 2),
(656, 'BKG04K10N1', 'BKA_HAT_PL', 21, 2),
(657, 'BKG04K10N1', 'BKA_HAT_THCB', 35, 2),
(658, 'BKG04K10N1', 'BKA_HAT_THVP', 16, 2),
(659, 'BKG04K10N1', 'BKA_HAT_TOANCC', 34, 2),
(660, 'BKG04K10N2', 'BKA_HAT_AV1', 15, 2),
(661, 'BKG04K10N2', 'BKA_HAT_AV2', 6, 2),
(662, 'BKG04K10N2', 'BKA_HAT_BTMT', 17, 2),
(663, 'BKG04K10N2', 'BKA_HAT_CSDL', 19, 2),
(664, 'BKG04K10N2', 'BKA_HAT_CT', 22, 2),
(665, 'BKG04K10N2', 'BKA_HAT_CTMT', 17, 2),
(666, 'BKG04K10N2', 'BKA_HAT_LTCB', 19, 2),
(667, 'BKG04K10N2', 'BKA_HAT_MKD', 18, 2),
(668, 'BKG04K10N2', 'BKA_HAT_MMT', 42, 2),
(669, 'BKG04K10N2', 'BKA_HAT_PL', 21, 2),
(670, 'BKG04K10N2', 'BKA_HAT_THCB', 35, 2),
(671, 'BKG04K10N2', 'BKA_HAT_THVP', 16, 2),
(672, 'BKG04K10N2', 'BKA_HAT_TOANCC', 34, 2),
(673, 'BKG04K10N2', 'BKA_HAT_XLA', 11, 2),
(674, 'BKG04K10N3', 'BKA_HAT_AV1', 8, 2),
(675, 'BKG04K10N3', 'BKA_HAT_AV2', 6, 2),
(676, 'BKG04K10N3', 'BKA_HAT_BTMT', 17, 2),
(677, 'BKG04K10N3', 'BKA_HAT_CSDL', 19, 2),
(678, 'BKG04K10N3', 'BKA_HAT_CT', 22, 2),
(679, 'BKG04K10N3', 'BKA_HAT_CTMT', 17, 2),
(680, 'BKG04K10N3', 'BKA_HAT_LTCB', 19, 2),
(681, 'BKG04K10N3', 'BKA_HAT_MKD', 18, 2),
(682, 'BKG04K10N3', 'BKA_HAT_MMT', 42, 2),
(683, 'BKG04K10N3', 'BKA_HAT_PL', 21, 2),
(684, 'BKG04K10N3', 'BKA_HAT_THCB', 35, 2),
(685, 'BKG04K10N3', 'BKA_HAT_THVP', 16, 2),
(686, 'BKG04K10N3', 'BKA_HAT_TOANCC', 34, 2),
(687, 'BKG04K10N3', 'BKA_HAT_XLA', 11, 2),
(688, 'BKN01K10', 'BKA_ICT', 7, 0),
(689, 'BKN01K10', 'BKA_NA2', 18, 0),
(690, 'BKN01K11', 'BKA_HAT_AV1', 7, 0),
(691, 'BKN01K11', 'BKA_HAT_THCB', 41, 0),
(692, 'BKN01K11', 'BKA_HAT_TOANCC', 9, 0),
(693, 'BKN01K9', 'BKA_LPI101', 17, 0),
(694, 'BKN01K9', 'BKA_LPI102', 17, 0),
(695, 'BKN01K9', 'BKA_PROG', 46, 0),
(696, 'BKN02K10', 'BKA_ICT', 7, 0),
(697, 'BKN02K10', 'BKA_MCSA1', 17, 0),
(698, 'BKN02K10', 'BKA_MCSA2', 17, 0),
(699, 'BKN02K11', 'BKA_HAT_AV1', 7, 0),
(700, 'BKN02K11', 'BKA_HAT_THCB', 41, 0),
(701, 'BKN02K11', 'BKA_HAT_TOANCC', 9, 0),
(702, 'BKN02K9', 'BKA_CEH', 16, 0),
(703, 'BKN02K9', 'BKA_LPI101', 16, 0),
(704, 'BKN02K9', 'BKA_PROG', 47, 0),
(705, 'BKN03K10', 'BKA_ICT', 48, 0),
(706, 'BKN03K10', 'BKA_MCSA1', 17, 0),
(707, 'BKN03K10', 'BKA_MCSA2', 17, 0),
(708, 'BKN03K11', 'BKA_HAT_AV1', 15, 0),
(709, 'BKN03K11', 'BKA_HAT_CT', 22, 0),
(710, 'BKN03K11', 'BKA_HAT_PL', 21, 0),
(711, 'BKN03K11', 'BKA_HAT_THCB', 41, 0),
(712, 'BKN03K11', 'BKA_HAT_TOANCC', 9, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan_cong_chi_tiet`
--

CREATE TABLE `phan_cong_chi_tiet` (
  `ma_phan_cong` int(10) UNSIGNED NOT NULL,
  `thu` int(11) NOT NULL,
  `ma_ca` int(10) UNSIGNED NOT NULL,
  `ma_phong` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phan_cong_chi_tiet`
--

INSERT INTO `phan_cong_chi_tiet` (`ma_phan_cong`, `thu`, `ma_ca`, `ma_phong`) VALUES
(1, 2, 3, 3),
(1, 2, 3, 4),
(11, 7, 2, 2),
(26, 4, 3, 3),
(425, 7, 2, 2),
(425, 3, 6, 2),
(425, 4, 6, 2),
(426, 6, 2, 2),
(426, 0, 5, 2),
(470, 3, 2, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan_hoi_su_co`
--

CREATE TABLE `phan_hoi_su_co` (
  `ma_phan_hoi` int(10) UNSIGNED NOT NULL,
  `ma_nguoi_gui` int(10) UNSIGNED NOT NULL,
  `noi_dung` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tinh_trang` int(11) NOT NULL,
  `ket_qua` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong`
--

CREATE TABLE `phong` (
  `ma_phong` int(10) UNSIGNED NOT NULL,
  `ten_phong` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_cho_ngoi` int(10) UNSIGNED NOT NULL,
  `ma_tang` int(10) UNSIGNED NOT NULL,
  `ma_tinh_trang` int(10) UNSIGNED NOT NULL,
  `ghi_chu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phong`
--

INSERT INTO `phong` (`ma_phong`, `ten_phong`, `so_cho_ngoi`, `ma_tang`, `ma_tinh_trang`, `ghi_chu`) VALUES
(1, 'Kho', 0, 4, 1, ''),
(2, 'Lab 201', 20, 4, 1, ''),
(3, 'Lab 202', 40, 4, 1, ''),
(4, 'Lab 203', 50, 1, 1, ''),
(5, 'Lab 5', 35, 4, 1, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tang`
--

CREATE TABLE `tang` (
  `ma_tang` int(10) UNSIGNED NOT NULL,
  `ten_tang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ma_toa` int(10) UNSIGNED NOT NULL,
  `ma_tinh_trang` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tang`
--

INSERT INTO `tang` (`ma_tang`, `ten_tang`, `ma_toa`, `ma_tinh_trang`) VALUES
(1, 'Tầng 1', 1, 1),
(2, 'Tầng 2', 1, 1),
(3, 'Tầng 3', 1, 1),
(4, 'Tầng 4', 1, 1),
(5, 'Tầng 1', 2, 1),
(6, 'Tầng 2', 2, 1),
(7, 'Tầng 3', 2, 1),
(8, 'Tầng 4', 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thiet_bi_phong`
--

CREATE TABLE `thiet_bi_phong` (
  `ma_thiet_bi` int(10) UNSIGNED NOT NULL,
  `ma_phong` int(10) UNSIGNED NOT NULL,
  `ma_cau_hinh` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thiet_bi_phong`
--

INSERT INTO `thiet_bi_phong` (`ma_thiet_bi`, `ma_phong`, `ma_cau_hinh`) VALUES
(1, 2, 1),
(2, 2, 1),
(3, 2, 4),
(4, 2, 3),
(5, 3, 1),
(6, 4, 2),
(7, 5, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinh_trang`
--

CREATE TABLE `tinh_trang` (
  `ma_tinh_trang` int(10) UNSIGNED NOT NULL,
  `ten_tinh_trang` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tinh_trang`
--

INSERT INTO `tinh_trang` (`ma_tinh_trang`, `ten_tinh_trang`) VALUES
(1, 'Hoạt Động'),
(2, 'Đã Đóng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinh_trang_thiet_bi`
--

CREATE TABLE `tinh_trang_thiet_bi` (
  `ma_tinh_trang_thiet_bi` int(10) UNSIGNED NOT NULL,
  `ten_tinh_trang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tinh_trang_thiet_bi`
--

INSERT INTO `tinh_trang_thiet_bi` (`ma_tinh_trang_thiet_bi`, `ten_tinh_trang`) VALUES
(1, 'Thêm'),
(2, 'Cho Mượn'),
(3, 'Sửa'),
(4, 'Trả Về');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `toa`
--

CREATE TABLE `toa` (
  `ma_toa` int(10) UNSIGNED NOT NULL,
  `ten_toa` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia_chi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ma_tinh_trang` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `toa`
--

INSERT INTO `toa` (`ma_toa`, `ten_toa`, `dia_chi`, `ma_tinh_trang`) VALUES
(1, 'Tòa 1', 'A17 Tạ Quang Bửu', 1),
(2, 'Tòa 2', 'D5 Trần Đại Nghĩa', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ca`
--
ALTER TABLE `ca`
  ADD PRIMARY KEY (`ma_ca`),
  ADD UNIQUE KEY `ca_ma_ca_unique` (`ma_ca`);

--
-- Chỉ mục cho bảng `cap_do`
--
ALTER TABLE `cap_do`
  ADD PRIMARY KEY (`ma_cap_do`),
  ADD UNIQUE KEY `cap_do_ma_cap_do_unique` (`ma_cap_do`);

--
-- Chỉ mục cho bảng `cau_hinh`
--
ALTER TABLE `cau_hinh`
  ADD PRIMARY KEY (`ma_cau_hinh`),
  ADD KEY `cau_hinh_ma_loai_foreign` (`ma_loai`);

--
-- Chỉ mục cho bảng `cau_hinh_mon`
--
ALTER TABLE `cau_hinh_mon`
  ADD PRIMARY KEY (`ma_cau_hinh`,`ma_mon_hoc`),
  ADD KEY `cau_hinh_mon_ma_mon_hoc_foreign` (`ma_mon_hoc`);

--
-- Chỉ mục cho bảng `chuong_trinh_dao_tao`
--
ALTER TABLE `chuong_trinh_dao_tao`
  ADD PRIMARY KEY (`ma_chuong_trinh_dao_tao`),
  ADD KEY `chuong_trinh_dao_tao_ma_mon_hoc_foreign` (`ma_mon_hoc`);

--
-- Chỉ mục cho bảng `lich_day_bo_sung`
--
ALTER TABLE `lich_day_bo_sung`
  ADD PRIMARY KEY (`ma_lich_day_bo_sung`),
  ADD KEY `lich_day_bo_sung_ma_nguoi_dung_foreign` (`ma_nguoi_dung`),
  ADD KEY `lich_day_bo_sung_ma_mon_hoc_foreign` (`ma_mon_hoc`),
  ADD KEY `lich_day_bo_sung_ma_ca_foreign` (`ma_ca`),
  ADD KEY `lich_day_bo_sung_ma_phong_foreign` (`ma_phong`);

--
-- Chỉ mục cho bảng `lich_su`
--
ALTER TABLE `lich_su`
  ADD PRIMARY KEY (`ma_lich_su`),
  ADD KEY `lich_su_ma_nguoi_dung_foreign` (`ma_nguoi_dung`);

--
-- Chỉ mục cho bảng `lich_su_chi_tiet`
--
ALTER TABLE `lich_su_chi_tiet`
  ADD PRIMARY KEY (`ma_lich_su`,`ma_thiet_bi`),
  ADD KEY `lich_su_chi_tiet_ma_thiet_bi_foreign` (`ma_thiet_bi`),
  ADD KEY `lich_su_chi_tiet_ma_tinh_trang_thiet_bi_foreign` (`ma_tinh_trang_thiet_bi`);

--
-- Chỉ mục cho bảng `loai`
--
ALTER TABLE `loai`
  ADD PRIMARY KEY (`ma_loai`),
  ADD UNIQUE KEY `loai_ten_loai_unique` (`ten_loai`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `mon_hoc`
--
ALTER TABLE `mon_hoc`
  ADD PRIMARY KEY (`ma_mon_hoc`);

--
-- Chỉ mục cho bảng `ngay_nghi`
--
ALTER TABLE `ngay_nghi`
  ADD PRIMARY KEY (`ngay`,`ma_giao_vien`,`ma_ca`),
  ADD KEY `ngay_nghi_ma_ca_foreign` (`ma_ca`);

--
-- Chỉ mục cho bảng `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD PRIMARY KEY (`ma_nguoi_dung`),
  ADD UNIQUE KEY `nguoi_dung_tai_khoan_unique` (`tai_khoan`),
  ADD UNIQUE KEY `nguoi_dung_email_unique` (`email`),
  ADD UNIQUE KEY `nguoi_dung_sdt_unique` (`sdt`),
  ADD UNIQUE KEY `nguoi_dung_key_unique` (`key`),
  ADD KEY `nguoi_dung_ma_cap_do_foreign` (`ma_cap_do`);

--
-- Chỉ mục cho bảng `nguoi_dung_bo_mon`
--
ALTER TABLE `nguoi_dung_bo_mon`
  ADD PRIMARY KEY (`ma_nguoi_dung`,`ma_mon_hoc`),
  ADD KEY `nguoi_dung_bo_mon_ma_mon_hoc_foreign` (`ma_mon_hoc`);

--
-- Chỉ mục cho bảng `phan_cong`
--
ALTER TABLE `phan_cong`
  ADD PRIMARY KEY (`ma_phan_cong`),
  ADD KEY `phan_cong_ma_mon_hoc_foreign` (`ma_mon_hoc`);

--
-- Chỉ mục cho bảng `phan_cong_chi_tiet`
--
ALTER TABLE `phan_cong_chi_tiet`
  ADD PRIMARY KEY (`ma_phan_cong`,`ma_ca`,`ma_phong`,`thu`),
  ADD KEY `phan_cong_chi_tiet_ma_ca_foreign` (`ma_ca`),
  ADD KEY `phan_cong_chi_tiet_ma_phong_foreign` (`ma_phong`);

--
-- Chỉ mục cho bảng `phan_hoi_su_co`
--
ALTER TABLE `phan_hoi_su_co`
  ADD PRIMARY KEY (`ma_phan_hoi`);

--
-- Chỉ mục cho bảng `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`ma_phong`),
  ADD KEY `phong_ma_tang_foreign` (`ma_tang`),
  ADD KEY `phong_ma_tinh_trang_foreign` (`ma_tinh_trang`);

--
-- Chỉ mục cho bảng `tang`
--
ALTER TABLE `tang`
  ADD PRIMARY KEY (`ma_tang`),
  ADD KEY `tang_ma_toa_foreign` (`ma_toa`),
  ADD KEY `tang_ma_tinh_trang_foreign` (`ma_tinh_trang`);

--
-- Chỉ mục cho bảng `thiet_bi_phong`
--
ALTER TABLE `thiet_bi_phong`
  ADD PRIMARY KEY (`ma_thiet_bi`),
  ADD KEY `thiet_bi_phong_ma_phong_foreign` (`ma_phong`),
  ADD KEY `thiet_bi_phong_ma_cau_hinh_foreign` (`ma_cau_hinh`);

--
-- Chỉ mục cho bảng `tinh_trang`
--
ALTER TABLE `tinh_trang`
  ADD PRIMARY KEY (`ma_tinh_trang`);

--
-- Chỉ mục cho bảng `tinh_trang_thiet_bi`
--
ALTER TABLE `tinh_trang_thiet_bi`
  ADD PRIMARY KEY (`ma_tinh_trang_thiet_bi`);

--
-- Chỉ mục cho bảng `toa`
--
ALTER TABLE `toa`
  ADD PRIMARY KEY (`ma_toa`),
  ADD KEY `toa_ma_tinh_trang_foreign` (`ma_tinh_trang`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cau_hinh`
--
ALTER TABLE `cau_hinh`
  MODIFY `ma_cau_hinh` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `chuong_trinh_dao_tao`
--
ALTER TABLE `chuong_trinh_dao_tao`
  MODIFY `ma_chuong_trinh_dao_tao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lich_day_bo_sung`
--
ALTER TABLE `lich_day_bo_sung`
  MODIFY `ma_lich_day_bo_sung` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `lich_su`
--
ALTER TABLE `lich_su`
  MODIFY `ma_lich_su` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `loai`
--
ALTER TABLE `loai`
  MODIFY `ma_loai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  MODIFY `ma_nguoi_dung` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `phan_cong`
--
ALTER TABLE `phan_cong`
  MODIFY `ma_phan_cong` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=713;

--
-- AUTO_INCREMENT cho bảng `phan_hoi_su_co`
--
ALTER TABLE `phan_hoi_su_co`
  MODIFY `ma_phan_hoi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phong`
--
ALTER TABLE `phong`
  MODIFY `ma_phong` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tang`
--
ALTER TABLE `tang`
  MODIFY `ma_tang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `thiet_bi_phong`
--
ALTER TABLE `thiet_bi_phong`
  MODIFY `ma_thiet_bi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tinh_trang`
--
ALTER TABLE `tinh_trang`
  MODIFY `ma_tinh_trang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tinh_trang_thiet_bi`
--
ALTER TABLE `tinh_trang_thiet_bi`
  MODIFY `ma_tinh_trang_thiet_bi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `toa`
--
ALTER TABLE `toa`
  MODIFY `ma_toa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cau_hinh`
--
ALTER TABLE `cau_hinh`
  ADD CONSTRAINT `cau_hinh_ma_loai_foreign` FOREIGN KEY (`ma_loai`) REFERENCES `loai` (`ma_loai`);

--
-- Các ràng buộc cho bảng `cau_hinh_mon`
--
ALTER TABLE `cau_hinh_mon`
  ADD CONSTRAINT `cau_hinh_mon_ma_cau_hinh_foreign` FOREIGN KEY (`ma_cau_hinh`) REFERENCES `cau_hinh` (`ma_cau_hinh`),
  ADD CONSTRAINT `cau_hinh_mon_ma_mon_hoc_foreign` FOREIGN KEY (`ma_mon_hoc`) REFERENCES `mon_hoc` (`ma_mon_hoc`);

--
-- Các ràng buộc cho bảng `chuong_trinh_dao_tao`
--
ALTER TABLE `chuong_trinh_dao_tao`
  ADD CONSTRAINT `chuong_trinh_dao_tao_ma_mon_hoc_foreign` FOREIGN KEY (`ma_mon_hoc`) REFERENCES `mon_hoc` (`ma_mon_hoc`);

--
-- Các ràng buộc cho bảng `lich_day_bo_sung`
--
ALTER TABLE `lich_day_bo_sung`
  ADD CONSTRAINT `lich_day_bo_sung_ma_ca_foreign` FOREIGN KEY (`ma_ca`) REFERENCES `ca` (`ma_ca`),
  ADD CONSTRAINT `lich_day_bo_sung_ma_mon_hoc_foreign` FOREIGN KEY (`ma_mon_hoc`) REFERENCES `mon_hoc` (`ma_mon_hoc`),
  ADD CONSTRAINT `lich_day_bo_sung_ma_nguoi_dung_foreign` FOREIGN KEY (`ma_nguoi_dung`) REFERENCES `nguoi_dung` (`ma_nguoi_dung`),
  ADD CONSTRAINT `lich_day_bo_sung_ma_phong_foreign` FOREIGN KEY (`ma_phong`) REFERENCES `phong` (`ma_phong`);

--
-- Các ràng buộc cho bảng `lich_su`
--
ALTER TABLE `lich_su`
  ADD CONSTRAINT `lich_su_ma_nguoi_dung_foreign` FOREIGN KEY (`ma_nguoi_dung`) REFERENCES `nguoi_dung` (`ma_nguoi_dung`);

--
-- Các ràng buộc cho bảng `lich_su_chi_tiet`
--
ALTER TABLE `lich_su_chi_tiet`
  ADD CONSTRAINT `lich_su_chi_tiet_ma_lich_su_foreign` FOREIGN KEY (`ma_lich_su`) REFERENCES `lich_su` (`ma_lich_su`),
  ADD CONSTRAINT `lich_su_chi_tiet_ma_thiet_bi_foreign` FOREIGN KEY (`ma_thiet_bi`) REFERENCES `thiet_bi_phong` (`ma_thiet_bi`),
  ADD CONSTRAINT `lich_su_chi_tiet_ma_tinh_trang_thiet_bi_foreign` FOREIGN KEY (`ma_tinh_trang_thiet_bi`) REFERENCES `tinh_trang_thiet_bi` (`ma_tinh_trang_thiet_bi`);

--
-- Các ràng buộc cho bảng `ngay_nghi`
--
ALTER TABLE `ngay_nghi`
  ADD CONSTRAINT `ngay_nghi_ma_ca_foreign` FOREIGN KEY (`ma_ca`) REFERENCES `ca` (`ma_ca`);

--
-- Các ràng buộc cho bảng `nguoi_dung`
--
ALTER TABLE `nguoi_dung`
  ADD CONSTRAINT `nguoi_dung_ma_cap_do_foreign` FOREIGN KEY (`ma_cap_do`) REFERENCES `cap_do` (`ma_cap_do`);

--
-- Các ràng buộc cho bảng `nguoi_dung_bo_mon`
--
ALTER TABLE `nguoi_dung_bo_mon`
  ADD CONSTRAINT `nguoi_dung_bo_mon_ma_mon_hoc_foreign` FOREIGN KEY (`ma_mon_hoc`) REFERENCES `mon_hoc` (`ma_mon_hoc`),
  ADD CONSTRAINT `nguoi_dung_bo_mon_ma_nguoi_dung_foreign` FOREIGN KEY (`ma_nguoi_dung`) REFERENCES `nguoi_dung` (`ma_nguoi_dung`);

--
-- Các ràng buộc cho bảng `phan_cong`
--
ALTER TABLE `phan_cong`
  ADD CONSTRAINT `phan_cong_ma_mon_hoc_foreign` FOREIGN KEY (`ma_mon_hoc`) REFERENCES `mon_hoc` (`ma_mon_hoc`);

--
-- Các ràng buộc cho bảng `phan_cong_chi_tiet`
--
ALTER TABLE `phan_cong_chi_tiet`
  ADD CONSTRAINT `phan_cong_chi_tiet_ma_ca_foreign` FOREIGN KEY (`ma_ca`) REFERENCES `ca` (`ma_ca`),
  ADD CONSTRAINT `phan_cong_chi_tiet_ma_phan_cong_foreign` FOREIGN KEY (`ma_phan_cong`) REFERENCES `phan_cong` (`ma_phan_cong`),
  ADD CONSTRAINT `phan_cong_chi_tiet_ma_phong_foreign` FOREIGN KEY (`ma_phong`) REFERENCES `phong` (`ma_phong`);

--
-- Các ràng buộc cho bảng `phong`
--
ALTER TABLE `phong`
  ADD CONSTRAINT `phong_ma_tang_foreign` FOREIGN KEY (`ma_tang`) REFERENCES `tang` (`ma_tang`),
  ADD CONSTRAINT `phong_ma_tinh_trang_foreign` FOREIGN KEY (`ma_tinh_trang`) REFERENCES `tinh_trang` (`ma_tinh_trang`);

--
-- Các ràng buộc cho bảng `tang`
--
ALTER TABLE `tang`
  ADD CONSTRAINT `tang_ma_tinh_trang_foreign` FOREIGN KEY (`ma_tinh_trang`) REFERENCES `tinh_trang` (`ma_tinh_trang`),
  ADD CONSTRAINT `tang_ma_toa_foreign` FOREIGN KEY (`ma_toa`) REFERENCES `toa` (`ma_toa`);

--
-- Các ràng buộc cho bảng `thiet_bi_phong`
--
ALTER TABLE `thiet_bi_phong`
  ADD CONSTRAINT `thiet_bi_phong_ma_cau_hinh_foreign` FOREIGN KEY (`ma_cau_hinh`) REFERENCES `cau_hinh` (`ma_cau_hinh`),
  ADD CONSTRAINT `thiet_bi_phong_ma_phong_foreign` FOREIGN KEY (`ma_phong`) REFERENCES `phong` (`ma_phong`);

--
-- Các ràng buộc cho bảng `toa`
--
ALTER TABLE `toa`
  ADD CONSTRAINT `toa_ma_tinh_trang_foreign` FOREIGN KEY (`ma_tinh_trang`) REFERENCES `tinh_trang` (`ma_tinh_trang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
