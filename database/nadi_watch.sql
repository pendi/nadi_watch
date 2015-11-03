-- phpMyAdmin SQL Dump
-- version 4.4.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 03 Nov 2015 pada 14.07
-- Versi Server: 5.5.44-0+deb8u1
-- PHP Version: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nadi_watch`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL,
  `email_admin` varchar(100) DEFAULT NULL,
  `first_name_admin` varchar(100) NOT NULL,
  `last_name_admin` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `email_admin`, `first_name_admin`, `last_name_admin`, `password`, `level`) VALUES
(1, 'sacktiawan@gmail.com', 'pendi', 'setiawan', '5f4dcc3b5aa765d61d8327deb882cf99', 'super admin'),
(2, 'admin@email.com', 'admin', 'test', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `confirm`
--

CREATE TABLE IF NOT EXISTS `confirm` (
  `id_confirm` int(11) NOT NULL,
  `rek_receiver` varchar(50) NOT NULL,
  `name_receiver` varchar(100) NOT NULL,
  `rek_sender` varchar(50) NOT NULL,
  `name_sender` varchar(150) NOT NULL,
  `date_payment` date NOT NULL,
  `payment` varchar(100) NOT NULL,
  `image_confirm` text,
  `id_order` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `confirm`
--

INSERT INTO `confirm` (`id_confirm`, `rek_receiver`, `name_receiver`, `rek_sender`, `name_sender`, `date_payment`, `payment`, `image_confirm`, `id_order`) VALUES
(1, '5210932064', 'Pendi Setiawan', '123466', 'Member', '2015-10-11', '450000', NULL, '006/NHW/INV/X/2015'),
(2, '5210932064', 'Pendi Setiawan', '123466', 'Member', '0000-00-00', '215100', NULL, '004/NHW/INV/X/2015'),
(3, '5210932064', 'Pendi Setiawan', '123466', 'Member', '0000-00-00', '467100', NULL, '008/NHW/INV/X/2015'),
(4, '5210932064', 'Pendi Setiawan', '123466', 'Member', '0000-00-00', '200000', NULL, '003/NHW/INV/X/2015'),
(5, '5210932064', 'Pendi Setiawan', '123466', 'Member', '0000-00-00', '512100', NULL, '010/NHW/INV/X/2015'),
(6, '5210932064', 'Pendi Setiawan', '123466', 'Member', '0000-00-00', '2439000', NULL, '011/NHW/INV/X/2015'),
(9, '5210932064', 'Pendi Setiawan', '123466', 'Member', '0000-00-00', '230000', '../image/confirm/ktp.jpg', 'TRSNW20151010001'),
(10, '5210932064', 'Pendi Setiawan', '123466', 'Member', '0000-00-00', '216900', '', 'TRSNW20151102001'),
(11, '5210932064', 'Pendi Setiawan', '123466', 'Member', '0000-00-00', '1082000', '', 'TRSNW20151103002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(11) NOT NULL,
  `email_contact` varchar(50) DEFAULT NULL,
  `name_contact` varchar(50) NOT NULL,
  `message_contact` text NOT NULL,
  `image_contact` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `contact`
--

INSERT INTO `contact` (`id_contact`, `email_contact`, `name_contact`, `message_contact`, `image_contact`) VALUES
(1, NULL, 'Member Test', 'Test', ''),
(2, 'nadiwatch.member@gmail.com', 'Member Test', 'sasasasas', '../image/contact/ktp.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id_cus` varchar(20) NOT NULL,
  `email_cus` varchar(100) NOT NULL,
  `first_name_cus` varchar(100) NOT NULL,
  `last_name_cus` varchar(100) DEFAULT NULL,
  `address_cus` text NOT NULL,
  `telp_cus` varchar(25) NOT NULL,
  `created_time_cus` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_cus`, `email_cus`, `first_name_cus`, `last_name_cus`, `address_cus`, `telp_cus`, `created_time_cus`) VALUES
('AACDC001', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-10-10'),
('AACDC002', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-10-10'),
('AACDC003', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-10-10'),
('AACDC004', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-10-10'),
('AACDC005', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-10-11'),
('AACDC006', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-10-11'),
('AACDC007', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-10-19'),
('AACDC008', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-10-19'),
('AACDC009', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-10-27'),
('AACDC010', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-10-27'),
('AACDC011', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.009', '0123456789', '2015-11-02'),
('AACDC012', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-11-02'),
('AACDC013', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-11-02'),
('AACDC014', 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '2015-11-02'),
('ADCAD001', 'sacktiawangmail.com', 'Pendi', 'Setiawan', 'ekasi', 'Pendi Setiawan', '2015-10-27'),
('ADCAD002', 'sacktiawan@gmail.com', 'Pendi', 'Setiawan', 'sasa', 'Pendi Setiawan', '2015-10-27'),
('ADEBE001', 'bhills_7955@mailinator.com', 'Beverly', 'Hills', 'Fzjial lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Cixld', '2015-10-19'),
('ADEBE002', 'bhills_5792@mailinator.com', 'Beverly', 'Hills', 'Ojfbix lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Yfjtl', '2015-10-27'),
('ADEBE003', 'bhills_5596@mailinator.com', 'Beverly', 'Hills', 'Ybmmde lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Rwbza', '2015-11-02'),
('ADEBE004', 'bhills_1496@mailinator.com', 'Beverly', 'Hills', 'Ennyhj lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Eircr', '2015-11-03'),
('ADEBE005', 'bhills_0830@mailinator.com', 'Beverly', 'Hills', 'Zbdsgh lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Sprmh', '2015-11-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kotamadya`
--

CREATE TABLE IF NOT EXISTS `kotamadya` (
  `id_city` int(11) NOT NULL,
  `name_city` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kotamadya`
--

INSERT INTO `kotamadya` (`id_city`, `name_city`) VALUES
(1, 'Kota Bandung'),
(2, 'Kab. Bandung'),
(3, 'Kota Bekasi'),
(4, 'Kab. Bekasi'),
(5, 'Kota Bogor'),
(6, 'Kab. Bogor'),
(7, 'DKI Jakarta'),
(8, 'Kota Surabaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id_member` int(11) NOT NULL,
  `email_member` varchar(100) NOT NULL,
  `first_name_member` varchar(100) NOT NULL,
  `last_name_member` varchar(100) DEFAULT NULL,
  `address_member` text NOT NULL,
  `telp_member` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `email_member`, `first_name_member`, `last_name_member`, `address_member`, `telp_member`, `password`) VALUES
(1, 'nadiwatch.member@gmail.com', 'member', 'test', 'Pondok Ungu Permai Blok B.24 No.6 Rt.008 Rw.008', '0123456789', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id_order` varchar(20) NOT NULL,
  `id_cus` varchar(20) NOT NULL,
  `id_member` varchar(10) DEFAULT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `status_order` varchar(20) DEFAULT NULL,
  `total` varchar(50) DEFAULT NULL,
  `weight_order` varchar(5) DEFAULT NULL,
  `id_tarif` int(11) DEFAULT NULL,
  `created_time_order` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id_order`, `id_cus`, `id_member`, `invoice`, `status_order`, `total`, `weight_order`, `id_tarif`, `created_time_order`) VALUES
('TRSNW20151102001', 'AACDC012', '1', '002/NHW/INV/XI/2015', '3', '216900', '0.3', 8, '2015-11-02'),
('TRSNW20151102002', 'AACDC013', '1', '003/NHW/INV/XI/2015', '1', '207000', '', 47, '2015-11-02'),
('TRSNW20151102003', 'AACDC014', '1', '021/NHW/INV/XI/2015', '1', '207000', '', 83, '2015-11-02'),
('TRSNW20151103001', 'ADEBE004', '', '', '', '', '0.9', 0, '2015-11-03'),
('TRSNW20151103002', 'ADEBE005', '', '022/NHW/INV/XI/2015', '3', '1082000', '1.1', 8, '2015-11-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_temp`
--

CREATE TABLE IF NOT EXISTS `orders_temp` (
  `id_order_temp` varchar(50) NOT NULL,
  `id_product` varchar(20) NOT NULL,
  `id_session` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_time_temp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id_product` varchar(20) NOT NULL,
  `name_product` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `stock` int(3) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `image_product` text NOT NULL,
  `category` varchar(20) DEFAULT NULL,
  `id_vendor` int(1) NOT NULL,
  `status_product` int(1) NOT NULL,
  `sale_product` int(11) DEFAULT NULL,
  `weight_product` varchar(5) DEFAULT NULL,
  `created_time_product` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `name_product`, `type`, `color`, `price`, `description`, `stock`, `gender`, `image_product`, `category`, `id_vendor`, `status_product`, `sale_product`, `weight_product`, `created_time_product`) VALUES
('CABBA001', 'CASIO', '[LTP-V001D-1BUDF]', 'Silver', 220000, 'Analog, Round Case Shape, Black Dial, Stainless steel Case, Stainless Steel Band, Triple-fold Clasp, Mineral Glass, 31 Ã— 25 Ã— 7.6 mm, 30m Water Resistant, Quartz Movement', 15, 'wanita', '../image/product/casio/CASIO-[LTP-V001D-1BUDF].png', 'casual', 1, 1, 0, '0.2', '2015-10-09 17:06:48'),
('CABBA002', 'CASIO', '[Ltp-1177A-2A]', 'Silver', 220000, 'Water Resist 5atm, Stainles, Elegant Mewah, Kuat dan tahan lama, Desain Trendi', 6, 'wanita', '../image/product/casio/CASIO--Ltp-1177A-2A-Silver.png', 'casual', 1, 2, 18, '0.3', '2015-10-09 17:10:14'),
('SWEEC001', 'SWISS ARMY', 'dhc+ [HC-7702M]', 'Cream', 150000, 'Analog, Black Canvas Strap, All Stainless Steel, Water Resistant, Diameter 4.5 cm, Come with Box', 6, 'pria', '../image/product/swiss army/SWISS-ARMY-dhc-HC-7702M-Black-Cream-V.png', 'casual', 2, 2, 2, '0.2', '2015-10-09 14:37:32'),
('SWEEC002', 'SWISS ARMY', 'dhc+ Mono Date [1881G]', 'Putih', 135000, 'Analog, Black Canvas Strap, All Stainless Steel, 10 ATM Water Resistant, Diameter: 4.5 cm, Come with Box', 5, 'pria', '../image/product/swiss army/SWISS-ARMY-dhc-Mono-Date-1881G-White.png', 'casual', 2, 1, 0, '0.2', '2015-10-09 14:48:26'),
('SWEEC003', 'SWISS ARMY ', 'dhc+ [HC-3777/2015]', 'Hijau', 180000, 'Analog, Green Canvas Strap, All Stainless Steel, 10 ATM Water Resistant, Come with Box', 10, 'pria', '../image/product/swiss army/SWISS-ARMY-dhc-[HC-3777-2015]-Green.png', 'casual', 2, 1, 0, '0.2', '2015-10-09 16:19:24'),
('SWEEC004', 'SWISS ARMY', 'dhc+ [HC-7701]', 'Hitam', 135000, 'Analog, Black Canvas Strap, All Stainless Steel, Water Resistant, Diameter 4.5 cm, Come with Box', 15, 'pria', '../image/product/swiss army/SWISS-ARMY-dhc-HC-7701-Silver-Black.png', 'casual', 2, 1, 0, '0.2', '2015-10-09 16:23:42'),
('SWEEC005', 'SWISS ARMY ', 'dhc+ [SA-5842L]', 'Silver', 220000, 'Analog, Diameter: 3cm, All Stainless Steel, Water Resistant 10 ATM Quartz, Come with Box', 20, 'wanita', '../image/product/swiss army/SWISS-ARMY-Ladies-Watch-dhc-SA-5842L-Silver.png', 'casual', 2, 1, 0, '0.2', '2015-10-09 16:30:32'),
('SWEEC006', 'SWISS ARMY', '[SA 2237LK]', 'Gold', 280000, 'Analog, Water Resist 5atm, Stainles, Elegant Mewah, Kuat dan tahan lama, Desain Trendi, Fitur tanggal & cronograph', 9, 'wanita', '../image/product/swiss army/SWISS-ARMY--SA-2237LK-Gold.png', 'casual', 2, 2, 10, '0.2', '2015-10-09 16:40:38'),
('SWEEC007', 'SWISS ARMY', '[SA2199]', 'Hitam', 230000, 'Bahan Leather, Diameter +-4.7cm, Include Box', 4, 'pria', '../image/product/swiss army/SWISS-ARMY-Jam-Tangan-Pria-SA2199-Black.png', 'fashion', 2, 2, 9, '0.2', '2015-10-09 16:47:17'),
('SWEEC008', 'SWISS ARMY', '[SA2199]', 'Hijau Hitam', 230000, 'Bahan Leather, Diameter +-4.7cm, Include Box', -11, 'pria', '../image/product/swiss army/SWISS-ARMY-Jam-Tangan-Pria-SA2199-Green-Black.png', 'fashion', 2, 2, 22, '0.2', '2015-10-09 16:56:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif`
--

CREATE TABLE IF NOT EXISTS `tarif` (
  `id_tarif` int(11) NOT NULL,
  `id_city` int(11) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `tarif` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `id_city`, `kecamatan`, `tarif`) VALUES
(1, 1, 'Bandung', 11000),
(2, 1, 'Cibiru', 11000),
(3, 1, 'Ujungberung', 11000),
(4, 1, 'Sukasari', 11000),
(5, 1, 'Cicadas', 11000),
(6, 1, 'Cidadap', 11000),
(7, 1, 'Lengkong ', 11000),
(8, 2, 'Baleendah', 11000),
(9, 2, 'Banjaran ', 11000),
(10, 2, 'Bojong Soang', 11000),
(11, 2, 'Cicalengka', 11000),
(12, 2, 'Cikancung', 11000),
(13, 2, 'Cilengkrang', 11000),
(14, 2, 'Cileunyi', 11000),
(15, 2, 'Cimaung', 11000),
(16, 2, 'Cimenyan', 11000),
(17, 2, 'Ciparay', 11000),
(18, 3, 'Bekasi', 9000),
(19, 3, 'Bantar Gebang', 9000),
(20, 3, 'Bekasi Barat ', 9000),
(21, 3, 'Bekasi Selatan ', 9000),
(22, 3, 'Bekasi Timur', 9000),
(23, 3, 'Bekasi Utara', 9000),
(24, 3, 'Jatiasih', 9000),
(25, 3, 'Medan Satria', 9000),
(26, 4, 'Cikarang', 9000),
(27, 4, 'Cikarang Barat', 9000),
(28, 4, 'Cikarang Pusat ', 9000),
(29, 4, 'Cikarang Selatan ', 9000),
(30, 4, 'Cikarang Timur', 9000),
(31, 4, 'Cikarang Utara', 9000),
(32, 4, 'Cibitung ', 9000),
(33, 5, 'Bogor', 9000),
(34, 5, 'Bogor Barat ', 9000),
(35, 5, 'Bogor Selatan ', 9000),
(36, 5, 'Bogor Tengah', 9000),
(37, 5, 'Bogor Timur ', 9000),
(38, 5, 'Bogor Utara', 9000),
(39, 5, 'Tanah Sereal', 9000),
(40, 6, 'Cibinong', 9000),
(41, 6, 'Ciawi ', 9000),
(42, 6, 'Cijeruk', 9000),
(43, 6, 'Cileungsi', 9000),
(44, 7, 'Jakarta', 9000),
(45, 7, 'Jakarta Barat', 9000),
(46, 7, 'Grogol ', 9000),
(47, 7, 'Kalideres ', 9000),
(48, 7, 'Kebon Jeruk ', 9000),
(49, 7, 'Palmerah ', 9000),
(50, 7, 'Taman Sari ', 9000),
(51, 7, 'Cengkareng ', 9000),
(52, 7, 'Jakarta Selatan', 9000),
(53, 7, 'Jagakarsa ', 9000),
(54, 7, 'Kebayoran Baru', 9000),
(55, 7, 'Kebayoran Lama', 9000),
(56, 7, 'Mampang Prapatan', 9000),
(57, 7, 'Pancoran ', 9000),
(58, 7, 'Pasar Minggu ', 9000),
(59, 7, 'Pesanggrahan ', 9000),
(60, 7, 'Setiabudi ', 9000),
(61, 7, 'Tebet', 9000),
(62, 7, 'Cilandak', 9000),
(63, 7, 'Jakarta Pusat', 9000),
(64, 7, 'Cempaka Putih ', 9000),
(65, 7, 'Gambir ', 9000),
(66, 7, 'Kemayoran ', 9000),
(67, 7, 'Menteng ', 9000),
(68, 7, 'Sawah Besar ', 9000),
(69, 7, 'Senen ', 9000),
(70, 7, 'Tanah Abang', 9000),
(71, 7, 'Jakarta Utara', 9000),
(72, 7, 'Kelapa Gading ', 9000),
(73, 7, 'Koja ', 9000),
(74, 7, 'Pademangan ', 9000),
(75, 7, 'Penjaringan ', 9000),
(76, 7, 'Tanjung Priok', 9000),
(77, 7, 'Cilincing ', 9000),
(78, 7, 'Jakarta Timur', 9000),
(79, 7, 'Cakung ', 9000),
(80, 7, 'Cipayung ', 9000),
(81, 7, 'Ciracas', 9000),
(82, 7, 'Duren Sawit ', 9000),
(83, 7, 'Jatinegara ', 9000),
(84, 7, 'Kramat Jati ', 9000),
(85, 7, 'Makassar ', 9000),
(86, 7, 'Matraman ', 9000),
(87, 7, 'Pasar Rebo ', 9000),
(88, 7, 'Pulo Gadung', 9000),
(89, 8, 'Surabaya', 19000),
(90, 8, 'Asemrowo', 19000),
(91, 8, 'Benowo', 19000),
(92, 8, 'Bubutan', 19000),
(93, 8, 'Bulak', 19000),
(94, 8, 'Dukuh Pakis', 19000),
(95, 8, 'Gayungan', 19000),
(96, 8, 'Genteng ', 19000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_order` varchar(20) NOT NULL,
  `id_product` varchar(100) NOT NULL,
  `quantity_trans` varchar(20) NOT NULL,
  `created_time_trans` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_order`, `id_product`, `quantity_trans`, `created_time_trans`) VALUES
('TRSNW20151102001', 'SWEEC007', '1', '2015-11-02'),
('TRSNW20151102002', 'SWEEC008', '1', '2015-11-02'),
('TRSNW20151102003', 'SWEEC008', '1', '2015-11-02'),
('TRSNW20151103001', 'CABBA002', '1', '2015-11-03'),
('TRSNW20151103001', 'SWEEC001', '1', '2015-11-03'),
('TRSNW20151103001', 'SWEEC007', '2', '2015-11-03'),
('TRSNW20151103002', 'CABBA002', '1', '2015-11-03'),
('TRSNW20151103002', 'SWEEC001', '1', '2015-11-03'),
('TRSNW20151103002', 'SWEEC007', '3', '2015-11-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `id_vendor` int(11) NOT NULL,
  `name_vendor` varchar(30) NOT NULL,
  `sale_vendor` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `name_vendor`, `sale_vendor`) VALUES
(1, 'casio', 29),
(2, 'swiss army', 43);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `confirm`
--
ALTER TABLE `confirm`
  ADD PRIMARY KEY (`id_confirm`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_cus`);

--
-- Indexes for table `kotamadya`
--
ALTER TABLE `kotamadya`
  ADD PRIMARY KEY (`id_city`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `orders_temp`
--
ALTER TABLE `orders_temp`
  ADD PRIMARY KEY (`id_order_temp`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `confirm`
--
ALTER TABLE `confirm`
  MODIFY `id_confirm` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kotamadya`
--
ALTER TABLE `kotamadya`
  MODIFY `id_city` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id_vendor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
