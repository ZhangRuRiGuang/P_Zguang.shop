-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 30, 2024 lúc 05:40 PM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tmdt`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` bigint(20) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `shop_id`, `remember_token`, `created_at`, `updated_at`, `role`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', '2023-07-23 04:19:07', '$2y$10$QfxVbOxG328e0lo2CjH3A.jd2J4rBMm6tcpOjQpNP3QNnquO6Vcga', NULL, '8fjHUpUvCa0gKDHfOhBi303wsodgDNGZd41FOJ5FtJpjwYqURr2JkOnJ1y9M', '2023-07-23 04:19:08', '2023-07-23 04:19:08', 0, 1),
(2, 'Nguyễn Văn A', 'hanuri@gmail.com', NULL, '$2y$10$O.Vz8kjAaMb0BXjFKgjo8OMsXxmfRlO/TP8o.oQF4ZZ6Ozatv1lFG', NULL, 'RXIDZsM79CCWz6o9LQxbgLOEFACfdfvXKyPv8vCNp0eK5tZLFQQJPXKOFSkW', '2023-07-25 16:15:14', '2023-07-30 07:17:07', 1, 1),
(3, 'Nhân viên 1', 'nv1@gmail.com', NULL, '$2y$10$pQo.2xtUiDxNIS9gB/uiOezDnW8Xlb4fUl6t78J7QjibD.2MWR186', 1, 'Rg2d5WQobpQluyCwdBAxLzuP5RESEaG1GVeCa6hIRFb2SYX0VJBOj1l9javL', '2023-07-30 12:09:27', '2023-07-30 12:09:27', 2, 1),
(4, 'Nhân viên 2', 'nv2@gmail.com', NULL, '$2y$10$8ZsQEpi1pkHhQF4HxU3XuupdOSrVpocqVtExq2CXiCkB1F7x72lLq', 1, 'Pv9QZS84sJ6CxORRYbUPaShHlYxg5oHa62PeqWRDPizfEIVGKAXDaCQbtel6', '2023-07-30 12:09:49', '2023-07-30 12:09:49', 2, 1),
(5, 'Nhân viên 3', 'nv3@gmail.com', NULL, '$2y$10$rQCcrzVeRaAmKTHVddWEP.xkFalmwEsaHL0Z0erda9GfnO0PAL0BK', 1, NULL, '2023-07-30 12:10:31', '2023-07-30 12:10:31', 2, 1),
(8, 'SNACKSEEKER', 'SNACKSEEKER@gmail.com', NULL, '$2y$10$cFGDMUByD1gTpdHnvyL3vO2Bqu0ooYF5OEQWPjjbHN5a9u4WBRRDW', NULL, 'zNIyiHOjtlKtnIYO4UB9wmGBi6WUCJwjePRbgy66omRWiRyicr0EsSbar2yK', '2024-06-25 03:04:56', '2024-06-25 03:04:56', 1, 1),
(9, 'Loki - Lương khô, bánh kẹo', 'Loki@gmail.com', NULL, '$2y$10$28fG5NKbs3UbLMJ98Njvn.y4Rk8sW7C75jz2JeOMMfDOSN2lWEnO6', NULL, 'Tn9FrZngUct5RjPXonHA72SLt63VHUTQEuUA2WFBKa8JAP2e96pQ8WqcoknO', '2024-06-27 17:17:07', '2024-06-27 17:17:07', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `image`, `name`, `shop_id`, `created_at`, `updated_at`, `status`) VALUES
(14, '/storage/images/brands/vn-11134207-7qukw-lhy6m1eb4zwhf5.jfif', 'Snackseeker', 4, '2024-06-25 03:17:59', '2024-06-25 03:17:59', 1),
(15, '/storage/images/brands/Screenshot 2024-06-28 001638.png', 'Loki', 5, '2024-06-27 17:19:16', '2024-06-27 17:19:16', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `image_path`, `created_at`, `updated_at`, `status`) VALUES
(7, 'Thịt sấy khô', '/storage/images/categories/thuong-hieu-do-an-vat-noi-tieng-ban-chay-1.jpg', '2024-06-27 16:58:56', '2024-06-27 17:10:09', 1),
(8, 'Foody Taiwan', '/storage/images/categories/thuong-hieu-do-an-vat-noi-tieng-ban-chay-2.jpg', '2024-06-27 17:03:59', '2024-06-27 17:03:59', 1),
(9, 'achhoatonghop_92', '/storage/images/categories/thuong-hieu-do-an-vat-noi-tieng-ban-chay-3.jpg', '2024-06-27 17:04:53', '2024-06-27 17:04:53', 1),
(10, 'Bích Ngân', '/storage/images/categories/thuong-hieu-do-an-vat-noi-tieng-ban-chay-4.jpg', '2024-06-27 17:05:21', '2024-06-27 17:05:21', 1),
(11, 'Diễm Mai', '/storage/images/categories/thuong-hieu-do-an-vat-noi-tieng-ban-chay-5.jpg', '2024-06-27 17:05:58', '2024-06-27 17:05:58', 1),
(12, 'Lương khô', '/storage/images/categories/thuong-hieu-do-an-vat-noi-tieng-ban-chay-6.jpg', '2024-06-27 17:06:34', '2024-06-27 17:11:46', 1),
(13, 'Hong Kong Shop', '/storage/images/categories/thuong-hieu-do-an-vat-noi-tieng-ban-chay-7.jpg', '2024-06-27 17:07:40', '2024-06-27 17:07:40', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_18_171524_create_admins_table', 1),
(6, '2021_11_18_172425_create_shops_table', 1),
(7, '2021_11_18_172426_create_categories_table', 1),
(8, '2021_11_18_172427_create_brands_table', 1),
(9, '2021_11_18_172646_create_products_table', 1),
(10, '2021_11_19_063905_create_vouchers_table', 1),
(11, '2021_11_22_175504_add_qty_buy_column_to_products_table', 1),
(14, '2021_11_24_162504_create_orders_table', 1),
(15, '2021_11_24_163413_create_orders_detail_table', 1),
(16, '2021_12_01_071939_create_wishlist_table', 1),
(17, '2021_12_22_015701_add_view_column_to_products_table', 1),
(18, '2022_02_28_175237_create_suppliers_table', 1),
(19, '2022_02_28_175610_add_supplier_id_column_to_products_table', 1),
(20, '2022_03_01_174624_add_role_column_to_admins_table', 1),
(21, '2022_03_02_081914_create_setting_table', 1),
(22, '2022_03_12_131055_add_status_column_to_categories_table', 1),
(23, '2022_03_12_131719_add_status_column_to_products_table', 1),
(24, '2022_03_12_131735_add_status_column_to_brands_table', 1),
(25, '2022_05_04_064934_add_status_column_to_admins_table', 1),
(26, '2022_05_04_101851_add_title_column_to_setting_table', 1),
(27, '2022_05_23_023726_add_status_column_to_shops_table', 1),
(28, '2022_05_25_112602_add_shop_id_column_to_orders_table', 1),
(29, '2023_07_25_221447_drop_logo_column_to_setting_table', 2),
(30, '2024_06_11_180504_add_social_columns_to_users_table', 3),
(31, '2024_06_11_180601_create_ratings_table', 3),
(32, '2024_06_11_234419_add_type_column_to_orders_table', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `voucher_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` int(11) NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('dev.quangtnn@gmail.com', 'KhpYkPJmrkyNp8gLy9tA24hLQUgF98', NULL),
('gunbow5519939@gmail.com', 'eMHllqeOx0fzCbh7Ar3oFEDCNEDtFF', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 0,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `qty_buy` int(11) NOT NULL DEFAULT 0,
  `view` int(11) NOT NULL DEFAULT 0,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category_id`, `brand_id`, `image_path`, `description`, `qty`, `shop_id`, `created_at`, `updated_at`, `qty_buy`, `view`, `supplier_id`, `status`) VALUES
(11, 'LƯƠNG KHÔ BỘ BINH BB702', 8500, 7, 15, '/storage/images/products/368f8f1e8f1893253d37574072fd76a6.jfif', '<p><span style=\"color:rgba(0, 0, 0, 0.8); font-family:helvetica neue,helvetica,arial,文泉驛正黑,wenquanyi zen hei,hiragino sans gb,儷黑 pro,lihei pro,heiti tc,微軟正黑體,microsoft jhenghei ui,microsoft jhenghei,sans-serif; font-size:14px\">LƯƠNG KHÔ BỘ BINH BB702 ---------------------------------- Lương khô sản xuất đặc biệt dành cho lục quân của QD Việt Nam, có thể sử dụng thường xuyên dài ngày khi hành quân. Lương khô BB702 thơm ngon, bổ dưỡng, gồm: Hạt vừng trắng, Hạt điều, Bột đậu xanh, Sữa bột, Sữa đặc có đường, Trứng gà, Dầu thực vật... Kho hàng: Đang có hàng Hạn sử dụng: 12 tháng (xem trên bao bì) Quy cách đóng gói: - 1 hộp Lương Khô Bộ Binh BB702 = 10 phong lương khô = 700g - 1 thùng Lương Khô Bộ Binh BB702 = 6 hộp lương khô = 4,2kg - 1 phong Lương Khô Bộ Binh BB702 = 2 thanh lương khô = 70g --------------------------- Lương khô Loki - Chất lượng đảm bảo</span></p>', 231, 5, '2024-06-27 17:21:35', '2024-06-29 20:00:37', 0, 4, 15, 1),
(12, 'Mực rim me', 50000, 7, 15, '/storage/images/products/thuong-hieu-do-an-vat-noi-tieng-ban-chay-1.jpg', NULL, 1203, 5, '2024-06-29 19:29:32', '2024-06-29 19:29:32', 0, 0, 15, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `star` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `product_id`, `star`, `comment`, `image`, `created_at`, `updated_at`) VALUES
(3, 6, 11, 1, 'oke', NULL, '2024-06-29 19:03:42', '2024-06-29 19:03:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting`
--

INSERT INTO `setting` (`id`, `email`, `tel`, `address`, `created_at`, `updated_at`, `title`) VALUES
(1, 'zquang.shop@gmail.com', '+08 68.806.674', 'Hà Nội', '2023-07-23 04:19:08', '2023-07-25 15:38:20', 'Zquang.shop');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `shops`
--

INSERT INTO `shops` (`id`, `image`, `phone`, `address`, `name`, `description`, `admin_id`, `created_at`, `updated_at`, `status`) VALUES
(4, '/storage/images/shops/Screenshot 2024-06-25 100355.png', '0394166529', 'Thạch Bàn , Long Biên', 'SNACKSEEKER', NULL, 8, '2024-06-25 03:04:56', '2024-06-25 03:04:56', 1),
(5, '/storage/images/shops/Screenshot 2024-06-28 001638.png', '0392376529', 'Hoàn Kiếm , Hà Nội', 'Loki - Lương khô, bánh kẹo', NULL, 9, '2024-06-27 17:17:07', '2024-06-27 17:17:07', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone`, `shop_id`, `created_at`, `updated_at`) VALUES
(14, 'Taobao', 'taobao@gmail.com', '0345278333', 4, '2024-06-25 03:24:41', '2024-06-25 03:24:41'),
(15, 'Loki - Lương khô, bánh kẹo', 'Loki@gmail.com', '0394166529', 5, '2024-06-27 17:19:43', '2024-06-27 17:19:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `sex`, `remember_token`, `created_at`, `updated_at`, `provider`, `provider_id`, `access_token`) VALUES
(3, 'Quang Trương', 'dev.quangtnn@gmail.com', NULL, '$2y$10$0kW8hdBIzlUKcwogueTxj.r01DU8lg0vCr5hv5sJ3aWsnOL5aUjBO', '0123456789', 0, 'uDlwiMZ565abRvaPoBG4G398rq1vNGROMcM74IyuVE2B5Sk4D3wTEagGyiYR', '2024-06-14 16:26:44', '2024-06-25 02:43:13', 'google', '111576396747104260952', 'ya29.a0AXooCgvLc73XzUn13oxNGxhqs-nAiEN49VYRZaH4vi28r_HxTcZQ5WOV0x5vAAJjAw7bwpwcMIrNp2g_xmOaoeVfwUpdC4YQgg5POwGO9z2eOq-kuKrlDnoSDApU6UgqlVOjlLG47dkFhga-2wXgW0MGdjPC9e0cb9oaCgYKAWkSARMSFQHGX2MiQI3qCw9_FY-RaqGGjtkINQ0170'),
(5, 'toi', 'toi', NULL, '$2y$10$rrtuArpBfKeXAnFY9Fv/M.uL3OWxxfX.ZMh8hy2J4A1nTLQ73s6T6', '0283277112', 0, NULL, '2024-06-29 19:02:14', '2024-06-29 19:02:14', NULL, NULL, NULL),
(6, 'toi', 'toi@gmail.com', NULL, '$2y$10$PnF2vEtAihRFaDK2K8d.jOt.P0LcYk50YVCEdUI7Ba2YiejHlxwmu', '0239377372', 0, 'YbJxl2PrtX7yvHsZzqTCLQniyZmMwF3akwi8IKhfGFQq8c0bEbQ075Wh7WeV', '2024-06-29 19:03:05', '2024-06-29 19:03:05', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vouchers`
--

CREATE TABLE `vouchers` (
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `shop_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `wishlist`
--

INSERT INTO `wishlist` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 11, 6, '2024-06-29 19:03:57', '2024-06-29 19:03:57');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_shop_id_index` (`shop_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_index` (`user_id`),
  ADD KEY `orders_voucher_code_index` (`voucher_code`),
  ADD KEY `orders_shop_id_index` (`shop_id`);

--
-- Chỉ mục cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_detail_order_id_index` (`order_id`),
  ADD KEY `orders_detail_product_id_index` (`product_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_index` (`category_id`),
  ADD KEY `products_brand_id_index` (`brand_id`),
  ADD KEY `products_shop_id_index` (`shop_id`),
  ADD KEY `products_supplier_id_index` (`supplier_id`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_user_id_index` (`user_id`),
  ADD KEY `ratings_product_id_index` (`product_id`);

--
-- Chỉ mục cho bảng `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shops_admin_id_index` (`admin_id`);

--
-- Chỉ mục cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_shop_id_index` (`shop_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`code`),
  ADD KEY `vouchers_shop_id_index` (`shop_id`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_product_id_index` (`product_id`),
  ADD KEY `wishlist_user_id_index` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `setting`
--
ALTER TABLE `setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_voucher_code_foreign` FOREIGN KEY (`voucher_code`) REFERENCES `vouchers` (`code`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `shops_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `vouchers_shop_id_foreign` FOREIGN KEY (`shop_id`) REFERENCES `shops` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
