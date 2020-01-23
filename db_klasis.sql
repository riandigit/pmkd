-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jan 2020 pada 16.37
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_klasis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agama`
--

CREATE TABLE `agama` (
  `kdagama` varchar(20) NOT NULL,
  `nmagama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `agama`
--

INSERT INTO `agama` (`kdagama`, `nmagama`) VALUES
('A002', 'Buddha'),
('A08382', 'Konghucu'),
('A0993', 'Protestan'),
('A11', 'Khatolik'),
('A3234', 'Hindu'),
('A9992', 'Islam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `kdpekerjaan` varchar(20) NOT NULL,
  `nmpekerjaan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pekerjaan`
--

INSERT INTO `pekerjaan` (`kdpekerjaan`, `nmpekerjaan`) VALUES
('P002', 'Petani'),
('P0022', 'Wiraswasta'),
('P0023', 'Pegawai Swasta'),
('P0032', 'Kepala desa'),
('P03002', 'LAinnya'),
('P0302', 'Tidak Bekerja'),
('P03023', 'Parbotot'),
('P0323', 'PNS'),
('P99', 'Aparat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftar`
--

CREATE TABLE `pendaftar` (
  `kdpendaftar` int(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenkel` varchar(14) NOT NULL,
  `kdagama` varchar(20) NOT NULL,
  `tpt_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `statusanak` varchar(17) NOT NULL,
  `nmayah` varchar(50) NOT NULL,
  `kdpendidikana` varchar(20) NOT NULL,
  `kdpekerjaana` varchar(20) NOT NULL,
  `penghasilanayah` varchar(20) NOT NULL,
  `nmibu` varchar(50) NOT NULL,
  `kdpendidikani` varchar(20) NOT NULL,
  `kdpekerjaani` varchar(20) NOT NULL,
  `nohp` varchar(12) NOT NULL,
  `kdtk` varchar(20) NOT NULL,
  `statusdaftar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendaftar`
--

INSERT INTO `pendaftar` (`kdpendaftar`, `nama`, `jenkel`, `kdagama`, `tpt_lahir`, `tgl_lahir`, `alamat`, `statusanak`, `nmayah`, `kdpendidikana`, `kdpekerjaana`, `penghasilanayah`, `nmibu`, `kdpendidikani`, `kdpekerjaani`, `nohp`, `kdtk`, `statusdaftar`) VALUES
(8, 'Nimrod napitupulu', 'Laki-laki', 'A0993', 'medan', '1994-12-12', 'Medan Petisah', 'Tiri', 'Hotner', 'PN9392', 'P0022', '3000000', 'Lesinta Marbun', 'P77823', 'P77823', '082362612222', 'T00201', 'Diterima'),
(11, '2', 'Laki-laki', 'A002', '2', '0000-00-00', '2', 'kandung', '2', 'P000', 'P002', '2', '2', 'P000', 'P000', '2', 'T000', 'Diterima'),
(12, 'Ayu', 'Perempuan', 'A0993', 'Medan', '1994-12-12', 'medan sunggal', 'Tiri', 'LOntong', 'PN0302', 'P002', '4000000', 'Lintah', 'P0201', 'P0201', '0828277122', 'T0032', 'Ditolak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendidikan`
--

CREATE TABLE `pendidikan` (
  `kdpendidikan` varchar(20) NOT NULL,
  `nmpendidikan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendidikan`
--

INSERT INTO `pendidikan` (`kdpendidikan`, `nmpendidikan`) VALUES
('P000', 'Tidak Sekolah'),
('P0201', 'S3'),
('P77823', 'S2'),
('PN0302', 'SD'),
('Pn21', 'S1'),
('PN7372', 'SMP'),
('PN9392', 'Diploma 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_action`
--

CREATE TABLE `tbl_action` (
  `id` int(64) NOT NULL,
  `action_name` varchar(256) DEFAULT NULL,
  `status` int(16) DEFAULT 1,
  `created_by` varchar(256) DEFAULT NULL,
  `created_on` timestamp(6) NULL DEFAULT NULL ON UPDATE current_timestamp(6),
  `updated_by` varchar(256) DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_action`
--

INSERT INTO `tbl_action` (`id`, `action_name`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'view', 1, 'admin', '2020-01-23 04:33:58.633083', NULL, NULL),
(2, 'add', 1, 'admin', '2020-01-23 04:33:46.245516', NULL, NULL),
(3, 'edit', 1, 'adminmarga', '2020-01-23 06:54:35.438411', NULL, NULL),
(4, 'delete', 1, 'adminmarga', '2020-01-23 06:56:32.998667', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_icon`
--

CREATE TABLE `tbl_icon` (
  `id` int(64) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_icon`
--

INSERT INTO `tbl_icon` (`id`, `name`, `status`) VALUES
(1, '500px', 1),
(2, 'amazon', 1),
(3, 'balance-scale', 1),
(4, 'battery-0', 1),
(5, 'battery-1', 1),
(6, 'battery-2', 1),
(7, 'battery-3', 1),
(8, 'battery-4', 1),
(9, 'battery-empty', 1),
(10, 'battery-full', 1),
(11, 'battery-half', 1),
(12, 'battery-quarter', 1),
(13, 'battery-three-quarters', 1),
(14, 'black-tie', 1),
(15, 'calendar-check-o', 1),
(16, 'calendar-minus-o', 1),
(17, 'calendar-plus-o', 1),
(18, 'calendar-times-o', 1),
(19, 'cc-diners-club', 1),
(20, 'cc-jcb', 1),
(21, 'chrome', 1),
(22, 'clone', 1),
(23, 'commenting', 1),
(24, 'commenting-o', 1),
(25, 'contao', 1),
(26, 'creative-commons', 1),
(27, 'expeditedssl', 1),
(28, 'firefox', 1),
(29, 'fonticons', 1),
(30, 'genderless', 1),
(31, 'get-pocket', 1),
(32, 'gg', 1),
(33, 'gg-circle', 1),
(34, 'hand-grab-o', 1),
(35, 'hand-lizard-o', 1),
(36, 'hand-paper-o', 1),
(37, 'hand-peace-o', 1),
(38, 'hand-pointer-o', 1),
(39, 'hand-rock-o', 1),
(40, 'hand-scissors-o', 1),
(41, 'hand-spock-o', 1),
(42, 'hand-stop-o', 1),
(43, 'hourglass', 1),
(44, 'hourglass-1', 1),
(45, 'hourglass-2', 1),
(46, 'hourglass-3', 1),
(47, 'hourglass-end', 1),
(48, 'hourglass-half', 1),
(49, 'hourglass-o', 1),
(50, 'hourglass-start', 1),
(51, 'houzz', 1),
(52, 'i-cursor', 1),
(53, 'industry', 1),
(54, 'internet-explorer', 1),
(55, 'map', 1),
(56, 'map-o', 1),
(57, 'map-pin', 1),
(58, 'map-signs', 1),
(59, 'mouse-pointer', 1),
(60, 'object-group', 1),
(61, 'object-ungroup', 1),
(62, 'odnoklassniki', 1),
(63, 'odnoklassniki-square', 1),
(64, 'opencart', 1),
(65, 'opera', 1),
(66, 'optin-monster', 1),
(67, 'registered', 1),
(68, 'safari', 1),
(69, 'sticky-note', 1),
(70, 'sticky-note-o', 1),
(71, 'television', 1),
(72, 'trademark', 1),
(73, 'tripadvisor', 1),
(74, 'tv', 1),
(75, 'vimeo', 1),
(76, 'wikipedia-w', 1),
(77, 'y-combinator', 1),
(78, 'yc', 1),
(79, 'adjust', 1),
(80, 'anchor', 1),
(81, 'archive', 1),
(82, 'area-chart', 1),
(83, 'arrows', 1),
(84, 'arrows-h', 1),
(85, 'arrows-v', 1),
(86, 'asterisk', 1),
(87, 'at', 1),
(88, 'automobile', 1),
(89, 'balance-scale', 1),
(90, 'ban', 1),
(91, 'bank', 1),
(92, 'bar-chart', 1),
(93, 'bar-chart-o', 1),
(94, 'barcode', 1),
(95, 'bars', 1),
(96, 'battery-0', 1),
(97, 'battery-1', 1),
(98, 'battery-2', 1),
(99, 'battery-3', 1),
(100, 'battery-4', 1),
(101, 'battery-empty', 1),
(102, 'battery-full', 1),
(103, 'battery-half', 1),
(104, 'battery-quarter', 1),
(105, 'battery-three-quarters', 1),
(106, 'bed', 1),
(107, 'beer', 1),
(108, 'bell', 1),
(109, 'bell-o', 1),
(110, 'bell-slash', 1),
(111, 'bell-slash-o', 1),
(112, 'bicycle', 1),
(113, 'binoculars', 1),
(114, 'birthday-cake', 1),
(115, 'bolt', 1),
(116, 'bomb', 1),
(117, 'book', 1),
(118, 'bookmark', 1),
(119, 'bookmark-o', 1),
(120, 'briefcase', 1),
(121, 'bug', 1),
(122, 'building', 1),
(123, 'building-o', 1),
(124, 'bullhorn', 1),
(125, 'bullseye', 1),
(126, 'bus', 1),
(127, 'cab', 1),
(128, 'calculator', 1),
(129, 'calendar', 1),
(130, 'calendar-check-o', 1),
(131, 'calendar-minus-o', 1),
(132, 'calendar-o', 1),
(133, 'calendar-plus-o', 1),
(134, 'calendar-times-o', 1),
(135, 'camera', 1),
(136, 'camera-retro', 1),
(137, 'car', 1),
(138, 'caret-square-o-down', 1),
(139, 'caret-square-o-left', 1),
(140, 'caret-square-o-right', 1),
(141, 'caret-square-o-up', 1),
(142, 'cart-arrow-down', 1),
(143, 'cart-plus', 1),
(144, 'cc', 1),
(145, 'certificate', 1),
(146, 'check', 1),
(147, 'check-circle', 1),
(148, 'check-circle-o', 1),
(149, 'check-square', 1),
(150, 'check-square-o', 1),
(151, 'child', 1),
(152, 'circle', 1),
(153, 'circle-o', 1),
(154, 'circle-o-notch', 1),
(155, 'circle-thin', 1),
(156, 'clock-o', 1),
(157, 'clone', 1),
(158, 'close', 1),
(159, 'cloud', 1),
(160, 'cloud-download', 1),
(161, 'cloud-upload', 1),
(162, 'code', 1),
(163, 'code-fork', 1),
(164, 'coffee', 1),
(165, 'cog', 1),
(166, 'cogs', 1),
(167, 'comment', 1),
(168, 'comment-o', 1),
(169, 'commenting', 1),
(170, 'commenting-o', 1),
(171, 'comments', 1),
(172, 'comments-o', 1),
(173, 'compass', 1),
(174, 'copyright', 1),
(175, 'creative-commons', 1),
(176, 'credit-card', 1),
(177, 'crop', 1),
(178, 'crosshairs', 1),
(179, 'cube', 1),
(180, 'cubes', 1),
(181, 'cutlery', 1),
(182, 'dashboard', 1),
(183, 'database', 1),
(184, 'desktop', 1),
(185, 'diamond', 1),
(186, 'dot-circle-o', 1),
(187, 'download', 1),
(188, 'edit', 1),
(189, 'ellipsis-h', 1),
(190, 'ellipsis-v', 1),
(191, 'envelope', 1),
(192, 'envelope-o', 1),
(193, 'envelope-square', 1),
(194, 'eraser', 1),
(195, 'exchange', 1),
(196, 'exclamation', 1),
(197, 'exclamation-circle', 1),
(198, 'exclamation-triangle', 1),
(199, 'external-link', 1),
(200, 'external-link-square', 1),
(201, 'eye', 1),
(202, 'eye-slash', 1),
(203, 'eyedropper', 1),
(204, 'fax', 1),
(205, 'feed', 1),
(206, 'female', 1),
(207, 'fighter-jet', 1),
(208, 'file-archive-o', 1),
(209, 'file-audio-o', 1),
(210, 'file-code-o', 1),
(211, 'file-excel-o', 1),
(212, 'file-image-o', 1),
(213, 'file-movie-o', 1),
(214, 'file-pdf-o', 1),
(215, 'file-photo-o', 1),
(216, 'file-picture-o', 1),
(217, 'file-powerpoint-o', 1),
(218, 'file-sound-o', 1),
(219, 'file-video-o', 1),
(220, 'file-word-o', 1),
(221, 'file-zip-o', 1),
(222, 'film', 1),
(223, 'filter', 1),
(224, 'fire', 1),
(225, 'fire-extinguisher', 1),
(226, 'flag', 1),
(227, 'flag-checkered', 1),
(228, 'flag-o', 1),
(229, 'flash', 1),
(230, 'flask', 1),
(231, 'folder', 1),
(232, 'folder-o', 1),
(233, 'folder-open', 1),
(234, 'folder-open-o', 1),
(235, 'frown-o', 1),
(236, 'futbol-o', 1),
(237, 'gamepad', 1),
(238, 'gavel', 1),
(239, 'gear', 1),
(240, 'gears', 1),
(241, 'gift', 1),
(242, 'glass', 1),
(243, 'globe', 1),
(244, 'graduation-cap', 1),
(245, 'group', 1),
(246, 'hand-grab-o', 1),
(247, 'hand-lizard-o', 1),
(248, 'hand-paper-o', 1),
(249, 'hand-peace-o', 1),
(250, 'hand-pointer-o', 1),
(251, 'hand-rock-o', 1),
(252, 'hand-scissors-o', 1),
(253, 'hand-spock-o', 1),
(254, 'hand-stop-o', 1),
(255, 'hdd-o', 1),
(256, 'headphones', 1),
(257, 'heart', 1),
(258, 'heart-o', 1),
(259, 'heartbeat', 1),
(260, 'history', 1),
(261, 'home', 1),
(262, 'hotel', 1),
(263, 'hourglass', 1),
(264, 'hourglass-1', 1),
(265, 'hourglass-2', 1),
(266, 'hourglass-3', 1),
(267, 'hourglass-end', 1),
(268, 'hourglass-half', 1),
(269, 'hourglass-o', 1),
(270, 'hourglass-start', 1),
(271, 'i-cursor', 1),
(272, 'image', 1),
(273, 'inbox', 1),
(274, 'industry', 1),
(275, 'info', 1),
(276, 'info-circle', 1),
(277, 'institution', 1),
(278, 'key', 1),
(279, 'keyboard-o', 1),
(280, 'language', 1),
(281, 'laptop', 1),
(282, 'leaf', 1),
(283, 'legal', 1),
(284, 'lemon-o', 1),
(285, 'level-down', 1),
(286, 'level-up', 1),
(287, 'life-bouy', 1),
(288, 'life-buoy', 1),
(289, 'life-ring', 1),
(290, 'life-saver', 1),
(291, 'lightbulb-o', 1),
(292, 'line-chart', 1),
(293, 'location-arrow', 1),
(294, 'lock', 1),
(295, 'magic', 1),
(296, 'magnet', 1),
(297, 'mail-forward', 1),
(298, 'mail-reply', 1),
(299, 'mail-reply-all', 1),
(300, 'male', 1),
(301, 'map', 1),
(302, 'map-marker', 1),
(303, 'map-o', 1),
(304, 'map-pin', 1),
(305, 'map-signs', 1),
(306, 'meh-o', 1),
(307, 'microphone', 1),
(308, 'microphone-slash', 1),
(309, 'minus', 1),
(310, 'minus-circle', 1),
(311, 'minus-square', 1),
(312, 'minus-square-o', 1),
(313, 'mobile', 1),
(314, 'mobile-phone', 1),
(315, 'money', 1),
(316, 'moon-o', 1),
(317, 'mortar-board', 1),
(318, 'motorcycle', 1),
(319, 'mouse-pointer', 1),
(320, 'music', 1),
(321, 'navicon', 1),
(322, 'newspaper-o', 1),
(323, 'object-group', 1),
(324, 'object-ungroup', 1),
(325, 'paint-brush', 1),
(326, 'paper-plane', 1),
(327, 'paper-plane-o', 1),
(328, 'paw', 1),
(329, 'pencil', 1),
(330, 'pencil-square', 1),
(331, 'pencil-square-o', 1),
(332, 'phone', 1),
(333, 'phone-square', 1),
(334, 'photo', 1),
(335, 'picture-o', 1),
(336, 'pie-chart', 1),
(337, 'plane', 1),
(338, 'plug', 1),
(339, 'plus', 1),
(340, 'plus-circle', 1),
(341, 'plus-square', 1),
(342, 'plus-square-o', 1),
(343, 'power-off', 1),
(344, 'print', 1),
(345, 'puzzle-piece', 1),
(346, 'qrcode', 1),
(347, 'question', 1),
(348, 'question-circle', 1),
(349, 'quote-left', 1),
(350, 'quote-right', 1),
(351, 'random', 1),
(352, 'recycle', 1),
(353, 'refresh', 1),
(354, 'registered', 1),
(355, 'remove', 1),
(356, 'reorder', 1),
(357, 'reply', 1),
(358, 'reply-all', 1),
(359, 'retweet', 1),
(360, 'road', 1),
(361, 'rocket', 1),
(362, 'rss', 1),
(363, 'rss-square', 1),
(364, 'search', 1),
(365, 'search-minus', 1),
(366, 'search-plus', 1),
(367, 'send', 1),
(368, 'send-o', 1),
(369, 'server', 1),
(370, 'share', 1),
(371, 'share-alt', 1),
(372, 'share-alt-square', 1),
(373, 'share-square', 1),
(374, 'share-square-o', 1),
(375, 'shield', 1),
(376, 'ship', 1),
(377, 'shopping-cart', 1),
(378, 'sign-in', 1),
(379, 'sign-out', 1),
(380, 'signal', 1),
(381, 'sitemap', 1),
(382, 'sliders', 1),
(383, 'smile-o', 1),
(384, 'soccer-ball-o', 1),
(385, 'sort', 1),
(386, 'sort-alpha-asc', 1),
(387, 'sort-alpha-desc', 1),
(388, 'sort-amount-asc', 1),
(389, 'sort-amount-desc', 1),
(390, 'sort-asc', 1),
(391, 'sort-desc', 1),
(392, 'sort-down', 1),
(393, 'sort-numeric-asc', 1),
(394, 'sort-numeric-desc', 1),
(395, 'sort-up', 1),
(396, 'space-shuttle', 1),
(397, 'spinner', 1),
(398, 'spoon', 1),
(399, 'square', 1),
(400, 'square-o', 1),
(401, 'star', 1),
(402, 'star-half', 1),
(403, 'star-half-empty', 1),
(404, 'star-half-full', 1),
(405, 'star-half-o', 1),
(406, 'star-o', 1),
(407, 'sticky-note', 1),
(408, 'sticky-note-o', 1),
(409, 'street-view', 1),
(410, 'suitcase', 1),
(411, 'sun-o', 1),
(412, 'support', 1),
(413, 'tablet', 1),
(414, 'tachometer', 1),
(415, 'tag', 1),
(416, 'tags', 1),
(417, 'tasks', 1),
(418, 'taxi', 1),
(419, 'television', 1),
(420, 'terminal', 1),
(421, 'thumb-tack', 1),
(422, 'thumbs-down', 1),
(423, 'thumbs-o-down', 1),
(424, 'thumbs-o-up', 1),
(425, 'thumbs-up', 1),
(426, 'ticket', 1),
(427, 'times', 1),
(428, 'times-circle', 1),
(429, 'times-circle-o', 1),
(430, 'tint', 1),
(431, 'toggle-down', 1),
(432, 'toggle-left', 1),
(433, 'toggle-off', 1),
(434, 'toggle-on', 1),
(435, 'toggle-right', 1),
(436, 'toggle-up', 1),
(437, 'trademark', 1),
(438, 'trash', 1),
(439, 'trash-o', 1),
(440, 'tree', 1),
(441, 'trophy', 1),
(442, 'truck', 1),
(443, 'tty', 1),
(444, 'tv', 1),
(445, 'umbrella', 1),
(446, 'university', 1),
(447, 'unlock', 1),
(448, 'unlock-alt', 1),
(449, 'unsorted', 1),
(450, 'upload', 1),
(451, 'user', 1),
(452, 'user-plus', 1),
(453, 'user-secret', 1),
(454, 'user-times', 1),
(455, 'users', 1),
(456, 'video-camera', 1),
(457, 'volume-down', 1),
(458, 'volume-off', 1),
(459, 'volume-up', 1),
(460, 'warning', 1),
(461, 'wheelchair', 1),
(462, 'wifi', 1),
(463, 'wrench', 1),
(464, 'hand-grab-o', 1),
(465, 'hand-lizard-o', 1),
(466, 'hand-o-down', 1),
(467, 'hand-o-left', 1),
(468, 'hand-o-right', 1),
(469, 'hand-o-up', 1),
(470, 'hand-paper-o', 1),
(471, 'hand-peace-o', 1),
(472, 'hand-pointer-o', 1),
(473, 'hand-rock-o', 1),
(474, 'hand-scissors-o', 1),
(475, 'hand-spock-o', 1),
(476, 'hand-stop-o', 1),
(477, 'thumbs-down', 1),
(478, 'thumbs-o-down', 1),
(479, 'thumbs-o-up', 1),
(480, 'thumbs-up', 1),
(481, 'ambulance', 1),
(482, 'automobile', 1),
(483, 'bicycle', 1),
(484, 'bus', 1),
(485, 'cab', 1),
(486, 'car', 1),
(487, 'fighter-jet', 1),
(488, 'motorcycle', 1),
(489, 'plane', 1),
(490, 'rocket', 1),
(491, 'ship', 1),
(492, 'space-shuttle', 1),
(493, 'subway', 1),
(494, 'taxi', 1),
(495, 'train', 1),
(496, 'truck', 1),
(497, 'wheelchair', 1),
(498, 'genderless', 1),
(499, 'intersex', 1),
(500, 'mars', 1),
(501, 'mars-double', 1),
(502, 'mars-stroke', 1),
(503, 'mars-stroke-h', 1),
(504, 'mars-stroke-v', 1),
(505, 'mercury', 1),
(506, 'neuter', 1),
(507, 'transgender', 1),
(508, 'transgender-alt', 1),
(509, 'venus', 1),
(510, 'venus-double', 1),
(511, 'venus-mars', 1),
(512, 'file', 1),
(513, 'file-archive-o', 1),
(514, 'file-audio-o', 1),
(515, 'file-code-o', 1),
(516, 'file-excel-o', 1),
(517, 'file-image-o', 1),
(518, 'file-movie-o', 1),
(519, 'file-o', 1),
(520, 'file-pdf-o', 1),
(521, 'file-photo-o', 1),
(522, 'file-picture-o', 1),
(523, 'file-powerpoint-o', 1),
(524, 'file-sound-o', 1),
(525, 'file-text', 1),
(526, 'file-text-o', 1),
(527, 'file-video-o', 1),
(528, 'file-word-o', 1),
(529, 'file-zip-o', 1),
(530, 'circle-o-notch', 1),
(531, 'cog', 1),
(532, 'gear', 1),
(533, 'refresh', 1),
(534, 'spinner', 1),
(535, 'check-square', 1),
(536, 'check-square-o', 1),
(537, 'circle', 1),
(538, 'circle-o', 1),
(539, 'dot-circle-o', 1),
(540, 'minus-square', 1),
(541, 'minus-square-o', 1),
(542, 'plus-square', 1),
(543, 'plus-square-o', 1),
(544, 'square', 1),
(545, 'square-o', 1),
(546, 'cc-amex', 1),
(547, 'cc-diners-club', 1),
(548, 'cc-discover', 1),
(549, 'cc-jcb', 1),
(550, 'cc-mastercard', 1),
(551, 'cc-paypal', 1),
(552, 'cc-stripe', 1),
(553, 'cc-visa', 1),
(554, 'credit-card', 1),
(555, 'google-wallet', 1),
(556, 'paypal', 1),
(557, 'area-chart', 1),
(558, 'bar-chart', 1),
(559, 'bar-chart-o', 1),
(560, 'line-chart', 1),
(561, 'pie-chart', 1),
(562, 'bitcoin', 1),
(563, 'btc', 1),
(564, 'cny', 1),
(565, 'dollar', 1),
(566, 'eur', 1),
(567, 'euro', 1),
(568, 'gbp', 1),
(569, 'gg', 1),
(570, 'gg-circle', 1),
(571, 'ils', 1),
(572, 'inr', 1),
(573, 'jpy', 1),
(574, 'krw', 1),
(575, 'money', 1),
(576, 'rmb', 1),
(577, 'rouble', 1),
(578, 'rub', 1),
(579, 'ruble', 1),
(580, 'rupee', 1),
(581, 'shekel', 1),
(582, 'sheqel', 1),
(583, 'try', 1),
(584, 'turkish-lira', 1),
(585, 'usd', 1),
(586, 'won', 1),
(587, 'yen', 1),
(588, 'align-center', 1),
(589, 'align-justify', 1),
(590, 'align-left', 1),
(591, 'align-right', 1),
(592, 'bold', 1),
(593, 'chain', 1),
(594, 'chain-broken', 1),
(595, 'clipboard', 1),
(596, 'columns', 1),
(597, 'copy', 1),
(598, 'cut', 1),
(599, 'dedent', 1),
(600, 'eraser', 1),
(601, 'file', 1),
(602, 'file-o', 1),
(603, 'file-text', 1),
(604, 'file-text-o', 1),
(605, 'files-o', 1),
(606, 'floppy-o', 1),
(607, 'font', 1),
(608, 'header', 1),
(609, 'indent', 1),
(610, 'italic', 1),
(611, 'link', 1),
(612, 'list', 1),
(613, 'list-alt', 1),
(614, 'list-ol', 1),
(615, 'list-ul', 1),
(616, 'outdent', 1),
(617, 'paperclip', 1),
(618, 'paragraph', 1),
(619, 'paste', 1),
(620, 'repeat', 1),
(621, 'rotate-left', 1),
(622, 'rotate-right', 1),
(623, 'save', 1),
(624, 'scissors', 1),
(625, 'strikethrough', 1),
(626, 'subscript', 1),
(627, 'superscript', 1),
(628, 'table', 1),
(629, 'text-height', 1),
(630, 'text-width', 1),
(631, 'th', 1),
(632, 'th-large', 1),
(633, 'th-list', 1),
(634, 'underline', 1),
(635, 'undo', 1),
(636, 'unlink', 1),
(637, 'angle-double-down', 1),
(638, 'angle-double-left', 1),
(639, 'angle-double-right', 1),
(640, 'angle-double-up', 1),
(641, 'angle-down', 1),
(642, 'angle-left', 1),
(643, 'angle-right', 1),
(644, 'angle-up', 1),
(645, 'arrow-circle-down', 1),
(646, 'arrow-circle-left', 1),
(647, 'arrow-circle-o-down', 1),
(648, 'arrow-circle-o-left', 1),
(649, 'arrow-circle-o-right', 1),
(650, 'arrow-circle-o-up', 1),
(651, 'arrow-circle-right', 1),
(652, 'arrow-circle-up', 1),
(653, 'arrow-down', 1),
(654, 'arrow-left', 1),
(655, 'arrow-right', 1),
(656, 'arrow-up', 1),
(657, 'arrows', 1),
(658, 'arrows-alt', 1),
(659, 'arrows-h', 1),
(660, 'arrows-v', 1),
(661, 'caret-down', 1),
(662, 'caret-left', 1),
(663, 'caret-right', 1),
(664, 'caret-square-o-down', 1),
(665, 'caret-square-o-left', 1),
(666, 'caret-square-o-right', 1),
(667, 'caret-square-o-up', 1),
(668, 'caret-up', 1),
(669, 'chevron-circle-down', 1),
(670, 'chevron-circle-left', 1),
(671, 'chevron-circle-right', 1),
(672, 'chevron-circle-up', 1),
(673, 'chevron-down', 1),
(674, 'chevron-left', 1),
(675, 'chevron-right', 1),
(676, 'chevron-up', 1),
(677, 'exchange', 1),
(678, 'hand-o-down', 1),
(679, 'hand-o-left', 1),
(680, 'hand-o-right', 1),
(681, 'hand-o-up', 1),
(682, 'long-arrow-down', 1),
(683, 'long-arrow-left', 1),
(684, 'long-arrow-right', 1),
(685, 'long-arrow-up', 1),
(686, 'toggle-down', 1),
(687, 'toggle-left', 1),
(688, 'toggle-right', 1),
(689, 'toggle-up', 1),
(690, 'arrows-alt', 1),
(691, 'backward', 1),
(692, 'compress', 1),
(693, 'eject', 1),
(694, 'expand', 1),
(695, 'fast-backward', 1),
(696, 'fast-forward', 1),
(697, 'forward', 1),
(698, 'pause', 1),
(699, 'play', 1),
(700, 'play-circle', 1),
(701, 'play-circle-o', 1),
(702, 'random', 1),
(703, 'step-backward', 1),
(704, 'step-forward', 1),
(705, 'stop', 1),
(706, 'youtube-play', 1),
(707, '500px', 1),
(708, 'adn', 1),
(709, 'amazon', 1),
(710, 'android', 1),
(711, 'angellist', 1),
(712, 'apple', 1),
(713, 'behance', 1),
(714, 'behance-square', 1),
(715, 'bitbucket', 1),
(716, 'bitbucket-square', 1),
(717, 'bitcoin', 1),
(718, 'black-tie', 1),
(719, 'btc', 1),
(720, 'buysellads', 1),
(721, 'cc-amex', 1),
(722, 'cc-diners-club', 1),
(723, 'cc-discover', 1),
(724, 'cc-jcb', 1),
(725, 'cc-mastercard', 1),
(726, 'cc-paypal', 1),
(727, 'cc-stripe', 1),
(728, 'cc-visa', 1),
(729, 'chrome', 1),
(730, 'codepen', 1),
(731, 'connectdevelop', 1),
(732, 'contao', 1),
(733, 'css3', 1),
(734, 'dashcube', 1),
(735, 'delicious', 1),
(736, 'deviantart', 1),
(737, 'digg', 1),
(738, 'dribbble', 1),
(739, 'dropbox', 1),
(740, 'drupal', 1),
(741, 'empire', 1),
(742, 'expeditedssl', 1),
(743, 'facebook', 1),
(744, 'facebook-f', 1),
(745, 'facebook-official', 1),
(746, 'facebook-square', 1),
(747, 'firefox', 1),
(748, 'flickr', 1),
(749, 'fonticons', 1),
(750, 'forumbee', 1),
(751, 'foursquare', 1),
(752, 'ge', 1),
(753, 'get-pocket', 1),
(754, 'gg', 1),
(755, 'gg-circle', 1),
(756, 'git', 1),
(757, 'git-square', 1),
(758, 'github', 1),
(759, 'github-alt', 1),
(760, 'github-square', 1),
(761, 'gittip', 1),
(762, 'google', 1),
(763, 'google-plus', 1),
(764, 'google-plus-square', 1),
(765, 'google-wallet', 1),
(766, 'gratipay', 1),
(767, 'hacker-news', 1),
(768, 'houzz', 1),
(769, 'html5', 1),
(770, 'instagram', 1),
(771, 'internet-explorer', 1),
(772, 'ioxhost', 1),
(773, 'joomla', 1),
(774, 'jsfiddle', 1),
(775, 'lastfm', 1),
(776, 'lastfm-square', 1),
(777, 'leanpub', 1),
(778, 'linkedin', 1),
(779, 'linkedin-square', 1),
(780, 'linux', 1),
(781, 'maxcdn', 1),
(782, 'meanpath', 1),
(783, 'medium', 1),
(784, 'odnoklassniki', 1),
(785, 'odnoklassniki-square', 1),
(786, 'opencart', 1),
(787, 'openid', 1),
(788, 'opera', 1),
(789, 'optin-monster', 1),
(790, 'pagelines', 1),
(791, 'paypal', 1),
(792, 'pied-piper', 1),
(793, 'pied-piper-alt', 1),
(794, 'pinterest', 1),
(795, 'pinterest-p', 1),
(796, 'pinterest-square', 1),
(797, 'qq', 1),
(798, 'ra', 1),
(799, 'rebel', 1),
(800, 'reddit', 1),
(801, 'reddit-square', 1),
(802, 'renren', 1),
(803, 'safari', 1),
(804, 'sellsy', 1),
(805, 'share-alt', 1),
(806, 'share-alt-square', 1),
(807, 'shirtsinbulk', 1),
(808, 'simplybuilt', 1),
(809, 'skyatlas', 1),
(810, 'skype', 1),
(811, 'slack', 1),
(812, 'slideshare', 1),
(813, 'soundcloud', 1),
(814, 'spotify', 1),
(815, 'stack-exchange', 1),
(816, 'stack-overflow', 1),
(817, 'steam', 1),
(818, 'steam-square', 1),
(819, 'stumbleupon', 1),
(820, 'stumbleupon-circle', 1),
(821, 'tencent-weibo', 1),
(822, 'trello', 1),
(823, 'tripadvisor', 1),
(824, 'tumblr', 1),
(825, 'tumblr-square', 1),
(826, 'twitch', 1),
(827, 'twitter', 1),
(828, 'twitter-square', 1),
(829, 'viacoin', 1),
(830, 'vimeo', 1),
(831, 'vimeo-square', 1),
(832, 'vine', 1),
(833, 'vk', 1),
(834, 'wechat', 1),
(835, 'weibo', 1),
(836, 'weixin', 1),
(837, 'whatsapp', 1),
(838, 'wikipedia-w', 1),
(839, 'windows', 1),
(840, 'wordpress', 1),
(841, 'xing', 1),
(842, 'xing-square', 1),
(843, 'y-combinator', 1),
(844, 'y-combinator-square', 1),
(845, 'yahoo', 1),
(846, 'yc', 1),
(847, 'yc-square', 1),
(848, 'yelp', 1),
(849, 'youtube', 1),
(850, 'youtube-play', 1),
(851, 'youtube-square', 1),
(852, 'ambulance', 1),
(853, 'h-square', 1),
(854, 'heart', 1),
(855, 'heart-o', 1),
(856, 'heartbeat', 1),
(857, 'hospital-o', 1),
(858, 'medkit', 1),
(859, 'plus-square', 1),
(860, 'stethoscope', 1),
(861, 'user-md', 1),
(862, 'wheelchair', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu_detail`
--

CREATE TABLE `tbl_menu_detail` (
  `id` int(64) NOT NULL,
  `menu_id` int(64) DEFAULT NULL,
  `action_id` int(64) DEFAULT NULL,
  `status` int(64) DEFAULT 1,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp(6) NULL DEFAULT NULL ON UPDATE current_timestamp(6),
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_on` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_menu_detail`
--

INSERT INTO `tbl_menu_detail` (`id`, `menu_id`, `action_id`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 1, 1, 'admin', NULL, NULL, NULL),
(2, 2, 1, 1, 'admin', NULL, NULL, NULL),
(3, 3, 1, 1, 'admin', NULL, NULL, NULL),
(4, 4, 1, 1, 'admin', NULL, NULL, NULL),
(5, 5, 1, 1, 'admin', NULL, NULL, NULL),
(6, 6, 1, 1, 'admin', NULL, NULL, NULL),
(7, 1, 2, 1, 'admin', NULL, NULL, NULL),
(8, 2, 2, 1, 'admin', NULL, NULL, NULL),
(9, 3, 2, 1, 'admin', NULL, NULL, NULL),
(10, 4, 2, 1, 'admin', '2020-01-23 06:50:19.717883', NULL, NULL),
(11, 5, 2, 1, 'admin', NULL, NULL, NULL),
(12, 6, 2, 1, 'admin', NULL, NULL, NULL),
(13, 1, 3, 1, 'admin', NULL, NULL, NULL),
(14, 2, 3, 1, 'admin', NULL, NULL, NULL),
(15, 3, 3, 1, 'admin', NULL, NULL, NULL),
(16, 4, 3, 1, 'admin', NULL, NULL, NULL),
(17, 5, 3, 1, 'admin', NULL, NULL, NULL),
(18, 6, 3, 1, 'admin', NULL, NULL, NULL),
(19, 1, 4, 1, 'admin', NULL, NULL, NULL),
(20, 2, 4, 1, 'admin', NULL, NULL, NULL),
(21, 3, 4, 1, 'admin', NULL, NULL, NULL),
(22, 4, 4, 1, 'admin', NULL, NULL, NULL),
(23, 5, 4, 1, 'admin', NULL, NULL, NULL),
(24, 6, 4, 1, 'admin', NULL, NULL, NULL),
(25, 7, 1, 1, '14', '2020-01-23 07:24:03.273015', NULL, NULL),
(26, 7, 2, 1, '14', '2020-01-23 07:24:04.705822', NULL, NULL),
(27, 7, 3, 1, '14', '2020-01-23 07:24:06.251223', NULL, NULL),
(28, 7, 4, 1, '14', '2020-01-23 07:24:08.061421', NULL, NULL),
(29, 8, 1, 1, '14', '2020-01-23 07:29:33.000000', NULL, NULL),
(30, 8, 2, 1, '14', '2020-01-23 07:29:33.000000', NULL, NULL),
(31, 8, 3, 1, '14', '2020-01-23 07:29:33.000000', NULL, NULL),
(32, 8, 4, 1, '14', '2020-01-23 07:29:33.000000', NULL, NULL),
(33, 9, 1, 1, '14', '2020-01-23 07:55:15.000000', NULL, NULL),
(34, 9, 2, 1, '14', '2020-01-23 07:55:15.000000', NULL, NULL),
(35, 9, 3, 1, '14', '2020-01-23 07:55:15.000000', NULL, NULL),
(36, 9, 4, 1, '14', '2020-01-23 07:55:15.000000', NULL, NULL),
(37, 10, 1, 1, '14', '2020-01-23 07:56:50.000000', NULL, NULL),
(38, 10, 2, 1, '14', '2020-01-23 07:56:50.000000', NULL, NULL),
(39, 10, 3, 1, '14', '2020-01-23 07:56:50.000000', NULL, NULL),
(40, 10, 4, 1, '14', '2020-01-23 07:56:50.000000', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu_web`
--

CREATE TABLE `tbl_menu_web` (
  `id` int(64) NOT NULL,
  `parent_id` int(64) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `order` int(64) DEFAULT NULL,
  `status` int(64) DEFAULT 1,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp(6) NULL DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL,
  `updated_on` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_menu_web`
--

INSERT INTO `tbl_menu_web` (`id`, `parent_id`, `name`, `icon`, `slug`, `order`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 0, 'Configuration', 'gear', '#', 99, 1, 'admin', NULL, NULL, NULL),
(2, 1, 'Group', 'chevron-circle-right', 'configuration/group', 4, 1, 'admin', NULL, NULL, NULL),
(3, 1, 'Menu', 'chevron-circle-right', 'configuration/menu', 1, 1, 'admin', NULL, NULL, NULL),
(4, 1, 'Privilege', 'chevron-circle-right', 'configuration/privilege', 2, 1, 'admin', NULL, NULL, NULL),
(5, 1, 'Menu Action', 'chevron-circle-right', 'configuration/action', 3, 1, 'admin', NULL, NULL, NULL),
(6, 0, 'Pengurus', 'male', 'configuration/users', 1, 1, 'admin', NULL, '14', '2020-01-23 08:11:19.000000'),
(7, 1, 'Pengurus', 'chevron-circle-right', 'configuration/pengurus', 5, 1, 'adminmarga', '2020-01-23 07:22:07.000000', '14', '2020-01-23 08:16:14.000000'),
(8, 0, 'Data Master', 'codepen', 'data_master/master', 2, 1, 'adminmarga', '2020-01-23 07:29:32.000000', '14', '2020-01-23 07:39:06.000000'),
(9, 6, 'Runggun', 'chevron-circle-right', 'Anggota/runggun', 1, 1, 'adminmarga', '2020-01-23 07:55:15.000000', NULL, NULL),
(10, 6, 'Anggota', 'chevron-circle-right', 'anggota/anggota', 2, 1, 'adminmarga', '2020-01-23 07:56:50.000000', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengurus`
--

CREATE TABLE `tbl_pengurus` (
  `id_seq` int(64) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(16) DEFAULT 1,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp(6) NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_on` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_pengurus`
--

INSERT INTO `tbl_pengurus` (`id_seq`, `name`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'KLASIS', 1, 'adminmarga', '2020-01-23 08:23:32.000000', NULL, NULL),
(2, 'RUNGGUN', 1, 'adminmarga', '2020-01-23 08:31:38.000000', NULL, NULL),
(3, 'ANGGOTA', 1, 'adminmarga', '2020-01-23 08:31:44.000000', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_privilege`
--

CREATE TABLE `tbl_privilege` (
  `id` int(64) NOT NULL,
  `user_group_id` int(64) DEFAULT NULL,
  `menu_id` int(64) DEFAULT NULL,
  `menu_detail_id` int(64) DEFAULT NULL,
  `status` int(64) DEFAULT 1,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp(6) NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_on` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_privilege`
--

INSERT INTO `tbl_privilege` (`id`, `user_group_id`, `menu_id`, `menu_detail_id`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 1, 1, 1, 1, 'admin', NULL, NULL, NULL),
(2, 1, 2, 2, 1, 'admin', NULL, NULL, NULL),
(3, 1, 3, 3, 1, 'admin', NULL, NULL, NULL),
(4, 1, 4, 4, 1, 'admin', NULL, NULL, NULL),
(5, 1, 5, 5, 1, 'admin', NULL, NULL, NULL),
(6, 1, 6, 6, 1, 'admin', NULL, NULL, NULL),
(7, 1, 1, 7, 0, '14', '2020-01-23 06:52:35.000000', '14', '2020-01-23 07:57:10.000000'),
(8, 1, 3, 9, 1, '14', '2020-01-23 06:52:35.000000', '14', '2020-01-23 06:52:49.000000'),
(9, 1, 4, 10, 1, '14', '2020-01-23 06:52:35.000000', '14', '2020-01-23 06:52:49.000000'),
(10, 1, 5, 11, 1, '14', '2020-01-23 06:52:35.000000', '14', '2020-01-23 06:52:49.000000'),
(11, 1, 2, 8, 1, '14', '2020-01-23 06:52:35.000000', '14', '2020-01-23 06:52:49.000000'),
(12, 1, 6, 12, 0, '14', '2020-01-23 06:52:35.000000', '14', '2020-01-23 07:57:10.000000'),
(13, 1, 3, 15, 1, '14', '2020-01-23 06:59:09.000000', '14', '2020-01-23 06:59:18.000000'),
(14, 1, 3, 21, 1, '14', '2020-01-23 06:59:09.000000', '14', '2020-01-23 06:59:18.000000'),
(15, 1, 4, 16, 1, '14', '2020-01-23 06:59:09.000000', '14', '2020-01-23 06:59:18.000000'),
(16, 1, 4, 22, 1, '14', '2020-01-23 06:59:09.000000', '14', '2020-01-23 06:59:18.000000'),
(17, 1, 5, 17, 1, '14', '2020-01-23 06:59:09.000000', '14', '2020-01-23 06:59:18.000000'),
(18, 1, 5, 23, 1, '14', '2020-01-23 06:59:09.000000', '14', '2020-01-23 06:59:18.000000'),
(19, 1, 2, 14, 1, '14', '2020-01-23 06:59:09.000000', '14', '2020-01-23 06:59:18.000000'),
(20, 1, 2, 20, 1, '14', '2020-01-23 06:59:09.000000', '14', '2020-01-23 06:59:18.000000'),
(21, 1, 6, 18, 0, '14', '2020-01-23 06:59:09.000000', '14', '2020-01-23 07:57:10.000000'),
(22, 1, 6, 24, 0, '14', '2020-01-23 06:59:09.000000', '14', '2020-01-23 07:57:10.000000'),
(23, 1, 7, 25, 1, '14', '2020-01-23 07:24:31.000000', '14', '2020-01-23 07:24:37.000000'),
(24, 1, 7, 26, 1, '14', '2020-01-23 07:24:31.000000', '14', '2020-01-23 07:24:37.000000'),
(25, 1, 7, 27, 1, '14', '2020-01-23 07:24:31.000000', '14', '2020-01-23 07:24:37.000000'),
(26, 1, 7, 28, 1, '14', '2020-01-23 07:24:31.000000', '14', '2020-01-23 07:24:37.000000'),
(27, 1, 8, 29, 1, '14', '2020-01-23 07:40:28.000000', NULL, NULL),
(28, 1, 8, 30, 1, '14', '2020-01-23 07:40:28.000000', NULL, NULL),
(29, 1, 8, 31, 1, '14', '2020-01-23 07:40:28.000000', NULL, NULL),
(30, 1, 8, 32, 1, '14', '2020-01-23 07:40:28.000000', NULL, NULL),
(31, 1, 9, 33, 1, '14', '2020-01-23 07:57:10.000000', NULL, NULL),
(32, 1, 9, 34, 1, '14', '2020-01-23 07:57:10.000000', NULL, NULL),
(33, 1, 9, 35, 1, '14', '2020-01-23 07:57:10.000000', NULL, NULL),
(34, 1, 9, 36, 1, '14', '2020-01-23 07:57:10.000000', NULL, NULL),
(35, 1, 10, 37, 1, '14', '2020-01-23 07:57:10.000000', NULL, NULL),
(36, 1, 10, 38, 1, '14', '2020-01-23 07:57:10.000000', NULL, NULL),
(37, 1, 10, 39, 1, '14', '2020-01-23 07:57:10.000000', NULL, NULL),
(38, 1, 10, 40, 1, '14', '2020-01-23 07:57:10.000000', NULL, NULL),
(39, 2, 6, 6, 1, '14', '2020-01-23 08:02:46.000000', NULL, NULL),
(40, 2, 10, 37, 1, '14', '2020-01-23 08:02:46.000000', NULL, NULL),
(41, 2, 10, 38, 1, '14', '2020-01-23 08:02:46.000000', NULL, NULL),
(42, 2, 10, 39, 1, '14', '2020-01-23 08:02:46.000000', NULL, NULL),
(43, 2, 10, 40, 1, '14', '2020-01-23 08:02:46.000000', NULL, NULL),
(44, 3, 6, 6, 1, '14', '2020-01-23 08:02:59.000000', NULL, NULL),
(45, 3, 10, 37, 1, '14', '2020-01-23 08:02:59.000000', NULL, NULL),
(46, 3, 10, 38, 1, '14', '2020-01-23 08:02:59.000000', NULL, NULL),
(47, 3, 10, 39, 1, '14', '2020-01-23 08:02:59.000000', NULL, NULL),
(48, 3, 10, 40, 1, '14', '2020-01-23 08:02:59.000000', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(64) NOT NULL,
  `nik` bigint(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `domisil` varchar(255) DEFAULT NULL,
  `jk` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status_anggota` varchar(255) DEFAULT NULL,
  `asal_runggun` varchar(255) DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `pekerjaan` varchar(255) DEFAULT NULL,
  `user_group_id` int(64) DEFAULT NULL,
  `operator_id` int(16) DEFAULT NULL,
  `status_user` int(16) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp(6) NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_on` timestamp(6) NULL DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nik`, `first_name`, `last_name`, `tempat_lahir`, `tanggal_lahir`, `phone`, `email`, `alamat`, `domisil`, `jk`, `foto`, `status_anggota`, `asal_runggun`, `pendidikan`, `pekerjaan`, `user_group_id`, `operator_id`, `status_user`, `created_by`, `created_on`, `updated_by`, `updated_on`, `username`, `password`) VALUES
(1, NULL, 'admin', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, 'klasis', '$2a$08$UmWrX8lpOPmgnJ3A9obDL.wGVjmMZzLbfQEdaNMQ6D7ZdB5AZPtmi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_group`
--

CREATE TABLE `tbl_user_group` (
  `id` int(64) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` int(64) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp(6) NULL DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `updated_on` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user_group`
--

INSERT INTO `tbl_user_group` (`id`, `name`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'SUPER ADMIN', 1, 'ADMIN', NULL, NULL, NULL),
(2, 'ADMIN', 1, 'adminmarga', '2020-01-23 07:20:00.000000', NULL, NULL),
(3, 'ANGGOTA', 1, 'adminmarga', '2020-01-23 08:02:24.000000', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tk`
--

CREATE TABLE `tk` (
  `kdtk` varchar(12) NOT NULL,
  `namatk` varchar(50) NOT NULL,
  `alamat_tk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tk`
--

INSERT INTO `tk` (`kdtk`, `namatk`, `alamat_tk`) VALUES
('T000', 'Lainnya', 'Lainnya'),
('T00201', 'Paud Anak Negeri', 'Panombean Panei'),
('T0032', 'Paud Ta\"am', 'Jln . medan'),
('T020q8', 'TK santa Tomas Medan', 'Jalan medan dekat medan'),
('T0301', 'Taman Kanak-kanak santa mulia', 'Jalan Patuan nagari No 12 Pematangsiantarr');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`kdagama`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`kdpekerjaan`);

--
-- Indeks untuk tabel `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`kdpendaftar`);

--
-- Indeks untuk tabel `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`kdpendidikan`);

--
-- Indeks untuk tabel `tbl_action`
--
ALTER TABLE `tbl_action`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_icon`
--
ALTER TABLE `tbl_icon`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_menu_detail`
--
ALTER TABLE `tbl_menu_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_menu_web`
--
ALTER TABLE `tbl_menu_web`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_pengurus`
--
ALTER TABLE `tbl_pengurus`
  ADD PRIMARY KEY (`id_seq`);

--
-- Indeks untuk tabel `tbl_privilege`
--
ALTER TABLE `tbl_privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user_group`
--
ALTER TABLE `tbl_user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tk`
--
ALTER TABLE `tk`
  ADD PRIMARY KEY (`kdtk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `kdpendaftar` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_action`
--
ALTER TABLE `tbl_action`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_icon`
--
ALTER TABLE `tbl_icon`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=863;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu_detail`
--
ALTER TABLE `tbl_menu_detail`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu_web`
--
ALTER TABLE `tbl_menu_web`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_pengurus`
--
ALTER TABLE `tbl_pengurus`
  MODIFY `id_seq` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_privilege`
--
ALTER TABLE `tbl_privilege`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_group`
--
ALTER TABLE `tbl_user_group`
  MODIFY `id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
