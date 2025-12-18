-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 16, 2025 at 08:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventify_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `additional_info` text DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `starting_price` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `slug`, `description`, `additional_info`, `location`, `city`, `event_date`, `event_time`, `image`, `starting_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Java Jazz Festival 2025', 'java-jazz-festival-2025', 'Festival musik jazz terbesar di Indonesia dengan berbagai musisi internasional.', '• Open gate: 16.00 WIB\r\n• Seating: Festival & VIP Area\r\n• Tidak diperbolehkan membawa makanan & minuman dari luar\r\n• Dilarang membawa senjata tajam, flare, atau barang berbahaya\r\n• Penonton wajib menunjukkan e-ticket saat masuk', 'JIExpo Kemayoran', 'Jakarta', '2025-12-15', '18:00:00', 'https://images.unsplash.com/photo-1511192336575-5a79af67a629?auto=format&fit=crop&q=80&w=1000', 750000, 'open', '2025-11-25 23:14:19', '2025-11-25 23:14:19'),
(7, 'Yogyakarta Cultural Night', 'yogyakarta-cultural-night', 'Pertunjukan budaya dan kesenian tradisional khas Yogyakarta.', '• Pertunjukan dimulai tepat pukul 19.30\r\n• Area duduk berdasarkan kategori tiket\r\n• Dilarang membawa kamera profesional tanpa izin\r\n• Booth makanan tradisional tersedia di area luar', 'Alun-Alun Kidul', 'Yogyakarta', '2025-09-25', '19:30:00', 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&q=80&w=1000', 120000, 'open', '2025-11-25 23:14:19', '2025-11-25 23:14:19'),
(8, 'Jakarta EDM Party', 'jakarta-edm-party', 'Pesta musik EDM dengan DJ lokal dan internasional.', '• Open gate: 19.00\r\n• Dilarang membawa minuman beralkohol dari luar\r\n• VIP mendapatkan akses front stage\r\n• Earplug tersedia gratis di pintu masuk', 'Pantai Indah Kapuk', 'Jakarta', '2025-11-01', '21:00:00', 'https://picsum.photos/id/158/800/600', 900000, 'open', '2025-11-25 23:14:19', '2025-11-25 23:14:19'),
(9, 'RAWR', 'rawr-1764169382', 'adadadad', 'ahhjdahkdasda', 'rawr', 'Jakarta', '2025-11-29', '22:04:00', 'default.jpg', 10, 'closed', '2025-11-26 15:03:02', '2025-11-26 15:03:38'),
(10, 'fgaegag', 'fgaegag-1764169628', 'afafd', 'fdafads', 'afasf', 'Jakarta', '2025-11-13', '22:12:00', 'default.jpg', 1342, 'closed', '2025-11-26 15:07:08', '2025-11-26 15:07:11'),
(11, '13123131', '13123131-1764169746', '1312313', '13112', '1313', 'Semarang', '2025-11-15', '04:13:00', 'default.jpg', 131, 'closed', '2025-11-26 15:09:06', '2025-11-26 15:09:10'),
(12, 'Jawa Timur Festival', 'jawa-timur-festival-1765854358', 'EVENT KONSER TEBESAR SE JAWA TIMUR!!', 'DILARANG MEMBAWA MAKANAN DAN MINUMAN DARI LUAR', 'Lapangan Rampal', 'Malang', '2026-01-10', '16:00:00', 'https://unsplash.com/photos/a-crowd-of-people-watching-a-concert-on-a-large-screen-MIRF158Q_cc', 150000, 'closed', '2025-12-16 03:05:58', '2025-12-16 03:16:40'),
(13, 'Sound of Jakarta: Urban Festival 2025', 'sound-of-jakarta-2025', 'Konser musik pop dan indie terbesar di Jakarta menghadirkan musisi papan atas nasional dan internasional.', 'Open gate jam 16:00 WIB. Dilarang membawa makanan dari luar.', 'Gelora Bung Karno (GBK)', 'Jakarta', '2025-06-15', '19:00:00', 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?auto=format&fit=crop&w=800&q=80', 350000, 'open', '2025-12-16 03:15:52', '2025-12-16 03:15:52'),
(14, 'Bandung Jazz Night: Intimate Session', 'bandung-jazz-night-2025', 'Nikmati malam yang syahdu dengan alunan musik Jazz di tengah hutan pinus kota kembang.', 'Disarankan membawa jaket karena udara cukup dingin.', 'Orchid Forest Cikole', 'Bandung', '2025-07-20', '18:30:00', 'https://images.unsplash.com/photo-1511192336575-5a79af67a629?q=80&w=1000&auto=format&fit=crop', 150000, 'open', '2025-12-16 03:15:52', '2025-12-16 03:15:52'),
(15, 'Bali Summer Rave Party', 'bali-summer-rave-2025', 'Pesta musik elektronik di pinggir pantai Kuta dengan DJ Internasional top dunia.', '18+ Only. ID Card wajib dibawa.', 'Atlas Beach Club', 'Bali', '2025-08-05', '16:00:00', 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=800&q=80', 500000, 'open', '2025-12-16 03:15:52', '2025-12-16 03:15:52'),
(16, 'Prambanan Folk Festival', 'prambanan-folk-2025', 'Gabungan musik folk modern dengan latar belakang kemegahan candi Prambanan yang magis.', 'Tersedia shuttle bus dari pusat kota Yogyakarta.', 'Candi Prambanan', 'Yogyakarta', '2025-09-12', '15:00:00', 'https://picsum.photos/id/1018/800/600', 250000, 'open', '2025-12-16 03:15:52', '2025-12-16 03:15:52'),
(17, 'Surabaya Rock Anthem', 'surabaya-rock-anthem-2025', 'Festival musik rock cadas untuk para metalhead Jawa Timur. Headbang sampai pagi!', 'Body checking ketat di pintu masuk.', 'Jatim International Expo', 'Surabaya', '2025-05-30', '19:00:00', 'https://images.unsplash.com/photo-1493225255756-d9584f8606e9?auto=format&fit=crop&w=800&q=80', 200000, 'open', '2025-12-16 03:15:52', '2025-12-16 03:15:52'),
(18, 'Deli Land Music Fest 2025', 'deli-land-fest-2025', 'Festival musik outdoor terbesar di Sumatera Utara, menggabungkan kuliner lokal dan musisi hits ibukota.', 'Tersedia area parkir luas. Food court buka dari jam 15:00.', 'Istana Maimun Area', 'Medan', '2025-10-10', '16:00:00', 'https://picsum.photos/id/453/800/600', 220000, 'open', '2025-12-16 03:24:30', '2025-12-16 03:24:30'),
(19, 'Lawang Sewu Orchestra Night', 'lawang-sewu-orchestra-2025', 'Perpaduan magis musik orkestra klasik dengan latar bangunan bersejarah Lawang Sewu.', 'Dresscode: Batik Formal. Dilarang menggunakan flash saat memotret.', 'Lawang Sewu', 'Semarang', '2025-11-05', '19:30:00', 'https://picsum.photos/id/1082/800/600', 300000, 'open', '2025-12-16 03:24:30', '2025-12-16 03:24:30'),
(20, 'Makassar Waterfront Jazz', 'makassar-waterfront-jazz-2025', 'Nikmati alunan Jazz santai ditemani angin sepoi-sepoi Pantai Losari saat matahari terbenam.', 'Acara ini bebas sampah plastik. Bawa tumbler sendiri.', 'Anjungan Pantai Losari', 'Makassar', '2025-09-25', '17:00:00', 'https://picsum.photos/id/348/800/600', 175000, 'open', '2025-12-16 03:24:30', '2025-12-16 03:24:30');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_25_131722_create_otps_table', 1),
(5, '2025_11_25_133232_add_profile_picture_to_users_table', 1),
(6, '2025_11_25_134007_create_sessions_table', 1),
(7, '2025_11_25_230248_create_password_resets_table', 1),
(8, '2025_11_26_060929_create_categories_table', 1),
(9, '2025_11_26_060939_create_events_table', 1),
(10, '2025_11_26_062051_create_tickets_table', 2),
(11, '2025_11_26_062656_add_benefits_to_tickets_table', 3),
(12, '2025_11_26_082508_create_orders_table', 4),
(13, '2025_11_26_174359_create_transactions_table', 5),
(14, '2025_11_26_192731_create_orders_table', 6),
(15, '2025_11_26_195428_add_additional_info_to_events_table', 7),
(16, '2025_11_26_202814_add_role_to_users_table', 8),
(17, '2025_11_26_210902_add_status_to_events_table', 9),
(18, '2025_12_16_093429_remove_category_from_database', 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment_status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `event_id`, `ticket_id`, `quantity`, `total_price`, `payment_status`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 2, 1, 1200000, 'pending', '2025-11-26 13:17:43', '2025-11-26 13:17:43'),
(6, 1, 7, 21, 1, 80000, 'paid', '2025-11-26 13:22:15', '2025-11-26 13:22:16'),
(10, 5, 1, 1, 1, 500000, 'paid', '2025-12-16 02:51:30', '2025-12-16 02:51:36'),
(11, 5, 7, 22, 1, 150000, 'paid', '2025-12-16 02:52:32', '2025-12-16 02:52:35'),
(12, 5, 16, 35, 12, 4200000, 'paid', '2025-12-16 03:20:22', '2025-12-16 03:20:25'),
(13, 5, 17, 37, 123, 33825000, 'paid', '2025-12-16 04:18:05', '2025-12-16 04:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(6) NOT NULL,
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('eyb0IQevWMKrXVyC3kNQt80A4p3Uys1Az3Ln7nLC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUXBBV0xQTTN6QWZNazRYZ0pHTnFvcDJocWZmcTJMcUdDUzdTVDN0NCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo5OiJkYXNoYm9hcmQiO319', 1765864419);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `benefits` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `event_id`, `type`, `price`, `stock`, `benefits`, `created_at`, `updated_at`) VALUES
(1, 1, 'Regular', 500000, 199, 'Akses festival|Free mineral water', '2025-11-25 23:28:18', '2025-12-16 02:51:30'),
(2, 1, 'VIP', 1200000, 76, 'VIP Seating|Fast Entry Lane|Free Merchandise|Meet & Greet Artist', '2025-11-25 23:28:18', '2025-11-26 13:18:20'),
(3, 1, 'VVIP', 2500000, 30, 'Front Row Seat|Full Access Backstage|Meet & Greet Artist|Exclusive Gift Box', '2025-11-25 23:28:18', '2025-11-25 23:28:18'),
(4, 8, 'Early Bird', 350000, 100, 'General Admission|Free Glowstick', '2025-11-25 23:28:18', '2025-11-25 23:28:18'),
(5, 8, 'Regular', 500000, 150, 'General Admission|Free Glowstick|Free Soft Drink', '2025-11-25 23:28:18', '2025-11-25 23:28:18'),
(6, 8, 'VIP', 900000, 50, 'VIP Area|Fast Entry|Free 2 Drinks|Meet the DJ', '2025-11-25 23:28:18', '2025-11-25 23:28:18'),
(21, 7, 'Regular', 80000, 299, 'Open Area Seating|Souvenir', '2025-11-26 12:50:13', '2025-11-26 13:22:15'),
(22, 7, 'Cultural Pass', 150000, 149, 'Front Row Seating|Traditional Snack', '2025-11-26 12:50:13', '2025-12-16 02:52:32'),
(23, 9, 'vip', 10, 11, 'adada|dada|dadad', '2025-11-26 15:03:02', '2025-11-26 15:03:02'),
(24, 10, 'asfaf', 1342, 43, 'adada|dada|dadad', '2025-11-26 15:07:08', '2025-11-26 15:07:08'),
(25, 11, '13', 131, 131, 'adada|dada|dadad', '2025-11-26 15:09:06', '2025-11-26 15:09:06'),
(26, 12, 'REGULER', 150000, 500, 'Festival Samping', '2025-12-16 03:05:59', '2025-12-16 03:05:59'),
(27, 12, 'VIP', 250000, 100, 'Festival Tengah', '2025-12-16 03:05:59', '2025-12-16 03:05:59'),
(28, 13, 'Festival A', 350000, 500, 'Akses area berdiri depan panggung', '2025-12-16 03:16:09', '2025-12-16 03:16:09'),
(29, 13, 'VIP Seating', 850000, 100, 'Nomor kursi, Snack box, Jalur antrian khusus', '2025-12-16 03:16:09', '2025-12-16 03:16:09'),
(30, 14, 'Regular Entry', 150000, 300, 'Free Welcome Drink (Wedang Jahe)', '2025-12-16 03:16:09', '2025-12-16 03:16:09'),
(31, 14, 'Camping Package', 450000, 50, 'Termasuk Tenda untuk 2 orang & Breakfast', '2025-12-16 03:16:09', '2025-12-16 03:16:09'),
(32, 15, 'General Admission', 500000, 1000, '1 Free Beer', '2025-12-16 03:16:09', '2025-12-16 03:16:09'),
(33, 15, 'VVIP Sofa', 2500000, 20, 'Sofa untuk 4 orang, 1 Bottle Service, Personal Server', '2025-12-16 03:16:09', '2025-12-16 03:16:09'),
(34, 16, 'Presale 1', 250000, 200, 'Akses seluruh area festival', '2025-12-16 03:16:09', '2025-12-16 03:16:09'),
(35, 16, 'Normal', 350000, 488, 'Akses seluruh area festival', '2025-12-16 03:16:09', '2025-12-16 03:20:22'),
(36, 17, 'Moshpit Area', 200000, 400, 'Area depan panggung persis', '2025-12-16 03:16:09', '2025-12-16 03:16:09'),
(37, 17, 'Tribune', 275000, 177, 'Duduk nyaman di tribun atas', '2025-12-16 03:16:09', '2025-12-16 04:18:05'),
(38, 18, 'Early Bird', 220000, 300, 'Entry Only', '2025-12-16 03:24:43', '2025-12-16 03:24:43'),
(39, 18, 'Sultan Package', 600000, 50, 'Voucher Kuliner 200rb, T-Shirt, Fast Track', '2025-12-16 03:24:43', '2025-12-16 03:24:43'),
(40, 19, 'Silver', 300000, 200, 'Seat di barisan tengah', '2025-12-16 03:24:43', '2025-12-16 03:24:43'),
(41, 19, 'Gold', 550000, 100, 'Seat barisan depan, Meet & Greet Conductor', '2025-12-16 03:24:43', '2025-12-16 03:24:43'),
(42, 20, 'Festival', 175000, 500, 'Duduk lesehan (mat provided)', '2025-12-16 03:24:43', '2025-12-16 03:24:43'),
(43, 20, 'VIP Table', 1200000, 20, 'Meja untuk 4 orang, Snack Platter, Drink Refill', '2025-12-16 03:24:43', '2025-12-16 03:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nomor_telepon` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `kota` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `nomor_telepon`, `profile_picture`, `gender`, `kota`, `email`, `is_verified`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Dafa Luthfan Otter', '081345992239', 'profile/zR4LmXhk17IjQZACvRjBbnmBXmAy3Eb0BJjjfVey.jpg', 'Laki-laki', 'Jakarta', 'dafaotter23@gmail.com', 1, 'user', '$2y$12$NL3ync5NR7cAeJaTJc8L4OQBo/seN.qPEDaRPFLZixgJFJ9oYQFxG', NULL, '2025-11-25 23:16:42', '2025-11-26 00:37:17'),
(2, 'RAWR', '1234567890', NULL, 'Perempuan', 'Jakarta', 'dafaluthfan@student.ub.ac.id', 1, 'user', '$2y$12$cYzJn0YRIATpomu38DcLS.ygD5biXPD7NExnb9sCOOv6Tf2I1aeD.', NULL, '2025-11-26 01:22:58', '2025-11-26 01:24:34'),
(5, 'Admin Eventify', '00000000', NULL, 'Laki-laki', 'Jakarta', 'eventifyrsi@gmail.com', 1, 'admin', '$2y$12$bYES7FzstZxBItYyJozGg.YOyivYG76JzGCsDWGy4EmvQYLfI0/4.', NULL, '2025-11-26 13:54:54', '2025-11-26 13:55:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `events_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_event_id_foreign` (`event_id`),
  ADD KEY `orders_ticket_id_foreign` (`ticket_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otps_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_event_id_foreign` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `otps`
--
ALTER TABLE `otps`
  ADD CONSTRAINT `otps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
