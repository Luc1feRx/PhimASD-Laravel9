-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th8 31, 2022 lúc 07:35 AM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phimasd`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(5, 'Phim Mới', 'phim-moi', '2022-08-11 03:04:43', '2022-08-11 03:04:43'),
(6, 'Phim Hot', 'phim-hot', '2022-08-11 03:07:25', '2022-08-11 03:07:25'),
(87, 'Phim Chiếu Rạp', 'phim-chieu-rap', '2022-08-16 07:41:39', '2022-08-16 07:41:39'),
(89, 'Phim Lẻ', 'phim-le', '2022-08-28 03:28:42', '2022-08-28 03:28:42'),
(90, 'Phim Netflix', 'phim-netflix', '2022-08-28 03:28:52', '2022-08-28 03:28:52'),
(91, 'Phim Bộ', 'phim-bo', '2022-08-28 03:28:58', '2022-08-28 03:28:58'),
(92, 'Phim Hoạt Hình', 'phim-hoat-hinh', '2022-08-28 03:29:27', '2022-08-28 03:29:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `countries`
--

INSERT INTO `countries` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(36, 'Mỹ', 'my', '2022-08-16 07:58:08', '2022-08-16 08:06:26'),
(37, 'Việt Nam', 'viet-nam', '2022-08-16 08:06:35', '2022-08-16 08:06:35'),
(38, 'Pháp', 'phap', '2022-08-16 08:06:41', '2022-08-16 08:06:41'),
(39, 'Hàn Quốc', 'han-quoc', '2022-08-16 08:06:50', '2022-08-16 08:06:50'),
(40, 'Thái Lan', 'thai-lan', '2022-08-16 08:06:57', '2022-08-16 08:06:57'),
(41, 'Anh', 'anh', '2022-08-16 08:07:15', '2022-08-16 08:07:15'),
(42, 'Nhật Bản', 'nhat-ban', '2022-08-16 08:07:27', '2022-08-16 08:07:27'),
(43, 'Tây Ban Nha', 'tay-ban-nha', '2022-08-16 08:07:44', '2022-08-16 08:07:44'),
(44, 'Trung Quốc', 'trung-quoc', '2022-08-16 08:08:11', '2022-08-16 08:08:11'),
(45, 'Đức', 'duc', '2022-08-16 08:08:32', '2022-08-16 08:08:32'),
(52, 'dfgdfg', 'dfgdfg', '2022-08-18 20:45:42', '2022-08-18 20:45:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `episodes`
--

CREATE TABLE `episodes` (
  `id` bigint UNSIGNED NOT NULL,
  `nameofep` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `movie_id` bigint UNSIGNED NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_movie` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `episodes` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `episodes`
--

INSERT INTO `episodes` (`id`, `nameofep`, `movie_id`, `slug`, `link_movie`, `episodes`, `created_at`, `updated_at`) VALUES
(1, 'fsfdf', 40, 'qweqwe', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/PGaJcpMUnb\" width=\"660px\"></iframe></p>', 1, '2022-08-31 06:00:34', '2022-08-31 06:00:34'),
(4, 'Chủ nhà không hoàn hảo', 40, 'chu-nha-khong-hoan-hao', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/xa26LXxYv\" width=\"660px\"></iframe></p>', 2, '2022-08-31 06:00:34', '2022-08-31 06:00:34'),
(5, 'Mơ về tôi một chút', 40, 'mo-ve-toi-mot-chut', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/cfFpr7tDq\" width=\"660px\"></iframe></p>', 3, '2022-08-31 06:00:34', '2022-08-31 06:00:34'),
(6, 'Tia hy vọng ở địa ngục', 40, 'tia-hy-vong-o-dia-nguc', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/__cGDcn1P\" width=\"660px\"></iframe></p>', 4, '2022-08-31 06:00:34', '2022-08-31 06:00:34'),
(7, '24/7', 40, '247', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/HOtxfps2A\" width=\"660px\"></iframe></p>', 5, '2022-08-31 06:00:34', '2022-08-31 06:00:34'),
(8, 'Âm thanh của cánh', 40, 'am-thanh-cua-canh', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/VHdadH4Ts\" width=\"660px\"></iframe></p>', 6, '2022-08-31 06:00:34', '2022-08-31 06:00:34'),
(9, 'Nhà búp bê', 40, 'nha-bup-be', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/__dWRf1Xq\" width=\"660px\"></iframe></p>', 7, '2022-08-31 06:00:34', '2022-08-31 06:00:34'),
(10, 'Nhà vui chơi', 40, 'nha-vui-choi', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/7ZxEEHJT0\" width=\"660px\"></iframe></p>', 8, '2022-08-31 06:06:20', '2022-08-30 23:06:20'),
(11, 'Kẻ sưu tầm', 40, 'ke-suu-tam', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/CuWXMtJMrw\" width=\"660px\"></iframe></p>', 9, '2022-08-31 06:08:08', '2022-08-30 23:08:08'),
(12, 'Những trái tim đã mất', 40, 'nhung-trai-tim-da-mat', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/DVinm6PrY\" width=\"660px\"></iframe></p>', 10, '2022-08-31 06:23:59', '2022-08-30 23:23:59'),
(13, 'Mơ thấy một ngàn con mèo/Calliope', 40, 'mo-tháy-mot-ngan-con-meocalliope', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/IaoNkzJqo\" width=\"660px\"></iframe></p>', 11, '2022-08-31 06:25:20', '2022-08-30 23:25:20'),
(14, 'Top Gun: Maverick', 41, 'top-gun-maverick', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/tPPTvkuV_\" width=\"660px\"></iframe></p>', 1, '2022-08-31 06:35:37', '2022-08-30 23:35:37'),
(15, 'Keep Calm and Carry On', 42, 'keep-calm-and-carry-on', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/FsE8AhB96\" width=\"660px\"></iframe></p>', 1, '2022-08-31 06:42:17', '2022-08-30 23:42:17'),
(16, 'CONSTANTINE: THE HOUSE OF MYSTERY', 43, 'constantine-the-house-of-mystery', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/oNl50d4Mm\" width=\"660px\"></iframe></p>', 1, '2022-08-31 07:01:46', '2022-08-31 00:01:46'),
(17, 'Doraemon the Movie: Nobita\'s Little Star Wars 2021', 44, 'doraemon-the-movie-nobitas-little-star-wars-2021', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/Bf95eoTfM\" width=\"660px\"></iframe></p>', 1, '2022-08-31 07:16:52', '2022-08-31 00:16:52'),
(18, 'Spider-Man: No Way Home', 45, 'spider-man-no-way-home', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/1cX0REvDv\" width=\"660px\"></iframe></p>', 1, '2022-08-31 07:23:12', '2022-08-31 00:23:12'),
(19, 'Incantation', 46, 'incantation', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/AEgdB1WS4\" width=\"660px\"></iframe></p>', 1, '2022-08-31 07:27:39', '2022-08-31 00:27:39'),
(20, 'The Batman', 47, 'the-batman', '<p><iframe allowfullscreen frameborder=\"0\" height=\"360px\" src=\"https://short.ink/TPZUmvyAi\" width=\"660px\"></iframe></p>', 1, '2022-08-31 07:34:11', '2022-08-31 00:34:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `genres`
--

CREATE TABLE `genres` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `genres`
--

INSERT INTO `genres` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(5, 'Tâm Lý', 'tam-ly', '2022-08-15 21:24:52', '2022-08-16 07:09:13'),
(6, 'Hành Động', 'hanh-dong', '2022-08-15 21:24:52', '2022-08-16 02:44:15'),
(7, 'Tình Cảm', 'tinh-cam', '2022-08-15 21:24:52', '2022-08-16 02:44:27'),
(8, 'Chính Kịch', 'chinh-kich', '2022-08-15 21:24:52', '2022-08-16 02:44:52'),
(9, 'Bí Ẩn', 'bi-an', '2022-08-15 21:24:52', '2022-08-16 02:45:15'),
(10, 'Giật Gân', 'giat-gan', '2022-08-15 21:24:52', '2022-08-16 02:45:41'),
(13, 'Phiêu Lưu', 'phieu-luu', '2022-08-16 02:45:51', '2022-08-16 02:45:51'),
(14, 'Viễn Tưởng', 'vien-tuong', '2022-08-16 02:46:32', '2022-08-16 02:46:32'),
(17, 'Hồi hộp - Gay cấn', 'hoi-hop-gay-can', '2022-08-28 03:24:41', '2022-08-28 03:24:41'),
(18, 'Cổ trang', 'co-trang', '2022-08-28 03:25:03', '2022-08-28 03:25:03'),
(19, 'Hoạt hình', 'hoat-hinh', '2022-08-28 03:25:23', '2022-08-28 03:25:23'),
(20, 'Chiến tranh', 'chien-tranh', '2022-08-28 03:25:43', '2022-08-28 03:25:43'),
(21, 'Hài ước', 'hai-uoc', '2022-08-28 03:26:21', '2022-08-28 03:26:21'),
(22, 'Kinh dị', 'kinh-di', '2022-08-30 23:39:14', '2022-08-30 23:39:14'),
(23, 'Hình sự', 'hinh-su', '2022-08-31 00:30:07', '2022-08-31 00:30:07'),
(24, 'Trinh thám', 'trinh-tham', '2022-08-31 00:30:18', '2022-08-31 00:30:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_05_092824_create_categories_table', 2),
(6, '2022_08_14_091652_create_genre_table', 3),
(8, '2022_08_16_110416_create_country_table', 4),
(9, '2022_08_17_032044_create_movies_table', 5),
(10, '2022_08_29_032314_create_episodes_table', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movies`
--

CREATE TABLE `movies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resolution` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_eng` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_release` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `season` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `trailer` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `episodes` int NOT NULL DEFAULT '1',
  `id_category` int NOT NULL,
  `id_genre` int NOT NULL,
  `id_country` int NOT NULL,
  `image` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `movies`
--

INSERT INTO `movies` (`id`, `name`, `slug`, `description`, `resolution`, `name_eng`, `subtitle`, `year_release`, `duration`, `season`, `trailer`, `episodes`, `id_category`, `id_genre`, `id_country`, `image`, `status`, `created_at`, `updated_at`) VALUES
(40, 'Người Cát (Phần 1) – The Sandman (Season 1)', 'nguoi-cat-phan-1-–-the-sandman-season-1', '<p>Sau nhiều năm bị giam cầm, Morpheus – Chúa tể Cõi Mộng – bắt đầu cuộc hành trình xuyên qua các thế giới để tìm lại những thứ đã bị cướp đoạt và khôi phục sức mạnh.</p>', '1', 'The Sandman (Season 1)', '1', '2022', '45 phút/1 tập', '1', '83ClbRPRDXU', 11, 6, 1, 36, 'the_sandman7376.jpg', 1, '2022-08-28 10:55:01', '2022-08-28 03:56:04'),
(41, 'Phi Công Siêu Đẳng Maverick – Top Gun: Maverick', 'phi-cong-sieu-dang-maverick-–-top-gun-maverick', '<p>Sau hơn ba mươi năm phục vụ với tư cách là một trong những phi công hàng đầu của Hải quân, Pete Mitchell là nơi anh thuộc về, thúc đẩy phong cách như một phi công thử nghiệm can đảm và né tránh sự thăng tiến trong cấp bậc sẽ thúc đẩy anh ta.</p>', '1', 'Top Gun: Maverick', '1', '2022', '131 phút', '0', 'giXco2jaZ_4', 1, 6, 6, 36, '629445e04a3ab5284.jpg', 1, '2022-08-31 06:33:58', '2022-08-30 23:33:59'),
(42, 'Siêu Nhiên (Phần 12)', 'sieu-nhien-phan-12', '<p><strong>Supernatural Season 12</strong> kể về câu chuyện của hai anh em nhà Winchester rong rủi trên khắp nước Mỹ để tiêu diệt quỷ và những hình thái siêu nhiên khác.</p>', '3', 'Supernatural (Season 12)', '1', '2016', '44 phút/1 tập', '0', 'hGnddlsjA9c', 23, 5, 6, 36, 'sieu-nhien-phan-12-supernatural-season-12-15778-250x3502321.jpg', 1, '2022-08-31 06:40:54', '2022-08-30 23:40:54'),
(43, 'Constantine: Ngôi Nhà Bí Ẩn', 'constantine-ngoi-nha-bi-an', '<p>Constantine: Ngôi Nhà Bí Ẩn (Constantine: The House of Mystery) là một bộ phim hoạt hình ngắn trong Vũ trụ phim hoạt hình DC. Theo chân John Constantine sau các sự kiện của Justice League Dark: Apokolips War.</p>', '3', 'Constantine: The House of Mystery', '1', '2022', '27 phút', '0', '7W_6J9esLYY', 1, 8, 6, 36, '626d40aeb6fd37323.jpg', 1, '2022-08-31 07:00:14', '2022-08-31 00:00:14'),
(44, 'Doraemon: Nobita Và Cuộc Chiến Vũ Trụ Tí Hon 2021', 'doraemon-nobita-va-cuoc-chien-vu-tru-ti-hon-2021', '<p>Nobita tình cờ gặp được người ngoài hành tinh tí hon Papi, vốn là Tổng thống của hành tinh Pirika, chạy trốn tới Trái Đất để thoát khỏi những kẻ nổi loạn nơi quê nhà. Doraemon, Nobita và hội bạn thân dùng bảo bối đèn pin thu nhỏ biến đổi theo kích cỡ giống Papi để chơi cùng cậu bé. Thế nhưng, một tàu chiến không gian tấn công cả nhóm. Cảm thấy có trách nhiệm vì liên lụy mọi người, Papi quyết định một mình đương đầu với quân phiến loạn tàn ác. Doraemon và các bạn lên đường đến hành tinh Pirika, sát cánh bên người bạn của mình.</p>', '3', 'Doraemon the Movie: Nobita’s Little Star Wars 2021', '1', '2022', '108 phút', '0', 'twtjj-tuwaY', 1, 6, 1, 42, '62f7291ea0b202125.jpg', 1, '2022-08-31 07:04:36', '2022-08-31 00:04:36'),
(45, 'Người Nhện: Không Còn Nhà', 'nguoi-nhen-khong-con-nha', '<p>Lần đầu tiên trong lịch sử điện ảnh của Người Nhện, thân phận người hàng xóm thân thiện bị lật mở, khiến trách nhiệm làm một Siêu Anh Hùng xung đột với cuộc sống bình thường và đặt người anh quan tâm nhất vào tình thế nguy hiểm. Khi anh nhờ đến giúp đỡ của Doctor Strange để khôi phục lại bí mật, phép thuật đã gây ra lỗ hổng thời không, giải phóng những ác nhân mạnh mẽ nhất từng đối đầu với Người Nhện từ mọi vũ trụ. Bây giờ, Peter sẽ phải vượt qua thử thách lớn nhất của mình, nó sẽ thay đổi không chỉ tương lai của chính anh mà còn là tương lai của cả Đa Vũ Trụ.</p>', '1', 'Spider-Man: No Way Home', '1', '2021', '148 phút', '0', 'OB3g37GTALc', 1, 6, 6, 36, '61bab2aa370d9186.jpg', 1, '2022-08-31 07:22:22', '2022-08-31 00:22:22'),
(46, 'Chú Nguyền', 'chu-nguyen', '<p>Sáu năm trước, Lý Nhược Nam bị nguyền rủa vì phạm phải điều cấm kị trong tôn giáo. Giờ đây, cô phải bảo vệ con gái trước hậu quả của những hành động mình gây ra.</p>', '3', 'Incantation', '1', '2022', '110 phút', '0', 'HnyNZdcL_GY', 1, 5, 9, 44, '62c9797ef2d6e9808.jpg', 1, '2022-08-31 07:26:42', '2022-08-31 00:26:42'),
(47, 'Batman: Vạch Trần Sự Thật', 'batman-vach-tran-su-that', '<p>Bộ phim đưa khán giả dõi theo hành trình phá án và diệt trừ tội phạm của chàng Hiệp sĩ Bóng đêm Batman, với một câu chuyện hoàn toàn khác biệt với những phần phim đã ra mắt trước đây. Thế giới ngầm ở thành phố Gotham xuất hiện một tên tội phạm kỳ lạ tên Riddler chuyên nhắm vào nhân vật tai to mặt lớn. Và sau mỗi lần phạm tội, hắn đều để lại một câu đố bí ẩn cho Batman. Khi bắt tay vào phá giải các câu đố này, Batman dần lật mở những bí ẩn động trời giữa gia đình anh và tên trùm tội phạm Carmine Falconút</p>', '1', 'The Batman', '1', '2022', '183 phút', '0', 'mqqft2x_Aa4', 1, 5, 6, 36, '6256317b7409b8530.jpg', 1, '2022-08-31 07:32:34', '2022-08-31 00:32:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movie_category`
--

CREATE TABLE `movie_category` (
  `id` bigint UNSIGNED NOT NULL,
  `movie_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `movie_category`
--

INSERT INTO `movie_category` (`id`, `movie_id`, `category_id`) VALUES
(1, 40, 91),
(2, 40, 90),
(3, 40, 6),
(4, 41, 89),
(5, 41, 87),
(6, 41, 6),
(7, 42, 91),
(8, 42, 6),
(9, 42, 5),
(10, 43, 92),
(11, 43, 89),
(12, 44, 92),
(13, 44, 89),
(14, 44, 87),
(15, 44, 6),
(16, 45, 89),
(17, 45, 87),
(18, 45, 6),
(19, 46, 90),
(20, 46, 89),
(21, 46, 5),
(22, 47, 89),
(23, 47, 87),
(24, 47, 6),
(25, 47, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movie_genre`
--

CREATE TABLE `movie_genre` (
  `id` bigint NOT NULL,
  `movie_id` bigint UNSIGNED NOT NULL,
  `genre_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `movie_genre`
--

INSERT INTO `movie_genre` (`id`, `movie_id`, `genre_id`) VALUES
(17, 40, 17),
(18, 40, 14),
(19, 40, 13),
(20, 40, 10),
(21, 41, 17),
(22, 41, 6),
(23, 42, 22),
(24, 42, 17),
(25, 42, 14),
(26, 42, 6),
(27, 43, 19),
(28, 43, 14),
(29, 43, 6),
(30, 44, 21),
(31, 44, 19),
(32, 44, 14),
(33, 44, 13),
(34, 45, 17),
(35, 45, 14),
(36, 45, 6),
(37, 46, 22),
(38, 46, 17),
(39, 46, 10),
(40, 46, 9),
(41, 47, 24),
(42, 47, 23),
(43, 47, 17),
(44, 47, 14),
(45, 47, 13),
(46, 47, 10),
(47, 47, 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Admin', 'admin@argon.com', '2022-08-03 20:29:42', '$2y$10$ecwhO0FypxCMzMQNABlOYuYCQZTzbmnye6IwNmkscA8oQPlH2kM6i', NULL, '2022-08-03 20:29:42', '2022-08-03 20:29:42'),
(2, 'tu', 'clgtqwe1@gmail.com', NULL, '$2y$10$4TF0Au/9XtjPysBiPzmQmuoMIw50VOJpADD3rBW/DF43lBDKgww0a', 'IWpwHMIqbFtfoAgUiZyk6zC1roM8yJAtI4lxiQHJtnO7XAzvM3PlCvEzWUXo', '2022-08-03 20:46:20', '2022-08-05 19:33:31');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `movie_category`
--
ALTER TABLE `movie_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`);

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
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT cho bảng `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `movies`
--
ALTER TABLE `movies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `movie_category`
--
ALTER TABLE `movie_category`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `movie_genre`
--
ALTER TABLE `movie_genre`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD CONSTRAINT `movie_genre_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
