-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 11:28 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwl_uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(3) NOT NULL,
  `nama_pengguna` varchar(32) NOT NULL,
  `kata_sandi` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_pengguna`, `kata_sandi`) VALUES
(100, 'admin', '$2y$12$NanFW5L4LJTe4YcG4asEJ.2Ut6QGD7XLeiHySyORzBZFdVpkOI/AS');

-- --------------------------------------------------------

--
-- Table structure for table `tb_brand`
--

CREATE TABLE `tb_brand` (
  `id_brand` int(3) NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_brand`
--

INSERT INTO `tb_brand` (`id_brand`, `nama`) VALUES
(10, 'Apple'),
(13, 'Realme'),
(14, 'Vivo'),
(11, 'Xiaomi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_pesanan`
--

CREATE TABLE `tb_detail_pesanan` (
  `id_detail_pesanan` int(3) NOT NULL,
  `id_pesanan` int(3) NOT NULL,
  `id_produk` int(3) NOT NULL,
  `kuantitas` int(3) NOT NULL,
  `harga` int(8) NOT NULL,
  `total` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_detail_pesanan`
--

INSERT INTO `tb_detail_pesanan` (`id_detail_pesanan`, `id_pesanan`, `id_produk`, `kuantitas`, `harga`, `total`) VALUES
(8, 8, 19, 1, 1999000, 1999000),
(9, 8, 18, 1, 1599000, 1599000),
(10, 9, 16, 1, 3399000, 3399000),
(11, 10, 13, 1, 1299000, 1299000),
(12, 11, 11, 1, 10999000, 10999000),
(13, 12, 10, 1, 13999000, 13999000),
(14, 12, 16, 3, 3399000, 10197000),
(15, 13, 25, 1, 4999999, 4999999),
(16, 13, 20, 1, 4999000, 4999000),
(17, 13, 14, 1, 4499000, 4499000),
(18, 14, 18, 1, 1599000, 1599000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(3) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `surel` varchar(256) NOT NULL,
  `no_ponsel` varchar(15) NOT NULL,
  `kata_sandi` char(60) NOT NULL,
  `alamat` text NOT NULL,
  `foto` char(36) NOT NULL,
  `status` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama`, `surel`, `no_ponsel`, `kata_sandi`, `alamat`, `foto`, `status`) VALUES
(10, 'Aksal Syah Falah', 'aksal.sf@gmail.com', '6289691783679', '$2y$12$iH9P1Db1Hx3fFYNvhpndL.poixkDkB/WdUk4RMDVeMt8y6bOknSE.', 'Mojosongo, Jebres, Surakarta, Jawa Tengah', '', 'ACTIVE'),
(13, 'Admin', 'admin@forta.id', '6282144440404', '$2y$12$VBvKt5Yu2aOVRNfF12pSXufq8ClrkV/B9ottCUBzuDz3103S84JQW', '-', '', 'ACTIVE'),
(14, 'Almiraluthfi Pratiwi', 'almira@student.uns.ac.id', '6285647216632', '$2y$10$7bGAn7yjffU6ZKcYF81rJePdfCp2UB3auIzV0.QYKoMrSAf7xkFyC', 'Sumatera', '84843d4f77cc3134619d58e09a21a7b4.jpg', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(3) NOT NULL,
  `id_pelanggan` int(3) NOT NULL,
  `kode_pesanan` char(12) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `status` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id_pesanan`, `id_pelanggan`, `kode_pesanan`, `tgl_pesan`, `status`) VALUES
(8, 14, 'ORDB84C73DB3', '2021-06-21 22:14:56', 'DIKIRIM'),
(9, 14, 'ORD9914E0B8B', '2021-06-21 22:20:27', 'DIKIRIM'),
(10, 14, 'ORD0AC43B31F', '2021-06-21 23:06:53', 'CHECKOUT'),
(11, 14, 'ORD639623072', '2021-06-21 23:24:53', 'CHECKOUT'),
(12, 14, 'ORDDC17D9D27', '2021-06-21 23:30:25', 'CHECKOUT'),
(13, 13, 'ORD835040451', '2021-06-22 23:10:11', 'CHECKOUT'),
(14, 14, 'ORDEF87CA921', '2021-06-23 16:24:59', 'CHECKOUT');

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(3) NOT NULL,
  `id_brand` int(3) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `harga` int(8) NOT NULL,
  `stok` int(3) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_brand`, `nama`, `harga`, `stok`, `deskripsi`, `gambar`) VALUES
(10, 10, 'Apple iPhone 12 mini 256GB, RED', 13999000, 5, 'Isi Kotak :\r\n• iPhone dengan iOS 14.\r\n• Kabel USB-C ke Lightning.\r\n• Buku Manual dan dokumentasi lain.\r\n\r\nUkuran layar: 5.4 inci, 1080 x 2340 pixels, Super Retina XDR OLED, HDR10, 625 nits (typ), 1200 nits (peak)\r\nMemori: RAM 4 GB, ROM 256 GB\r\nSistem operasi: iOS 14\r\nCPU: Apple A14 Bionic (5 nm), Hexa-core (2x3.1 GHz Firestorm + 4x1.8 GHz Icestorm)\r\nGPU: Apple GPU (4-core graphics)\r\nKamera: 12 MP, f/1.6, 26mm (wide), 1.4µm, dual pixel PDAF, OIS. 12 MP, f/2.4, 120˚, 13mm (ultrawide), 1/3.6\". Depan 12 MP, f/2.2, 23mm (wide), 1/3.6\"\r\nSIM: Nano-SIM/eSIM\r\nBaterai: Li-Ion 2227 mAh\r\nDimensi: 131.5 x 64.2 x 7.4 mm\r\nBerat: 135 gr\r\nGaransi Resmi', '10.jpg'),
(11, 10, 'Apple iPhone 12 mini 64GB, Black', 10999000, 19, 'Isi Kotak :\r\n• iPhone dengan iOS 14.\r\n• Kabel USB-C ke Lightning.\r\n• Buku Manual dan dokumentasi lain.\r\n\r\nUkuran layar: 5.4 inci, 1080 x 2340 pixels, Super Retina XDR OLED, HDR10, 625 nits (typ), 1200 nits (peak)\r\nMemori: RAM 4 GB, ROM 64 GB\r\nSistem operasi: iOS 14\r\nCPU: Apple A14 Bionic (5 nm), Hexa-core (2x3.1 GHz Firestorm + 4x1.8 GHz Icestorm)\r\nGPU: Apple GPU (4-core graphics)\r\nKamera: 12 MP, f/1.6, 26mm (wide), 1.4µm, dual pixel PDAF, OIS. 12 MP, f/2.4, 120˚, 13mm (ultrawide), 1/3.6\". Depan 12 MP, f/2.2, 23mm (wide), 1/3.6\"\r\nSIM: Nano-SIM/eSIM\r\nBaterai: Li-Ion 2227 mAh\r\nDimensi: 131.5 x 64.2 x 7.4 mm\r\nBerat: 135 gr\r\nGaransi Resmi', '11.jpg'),
(12, 13, 'realme Narzo 30A 4GB 64GB - Black', 1999000, 20, 'Ukuran layar: 6.5 inci, 720 x 1600 pixels, IPS LCD\r\nMemori: RAM 4 GB, ROM 64 GB, MicroSD slot\r\nSistem operasi: Android 10, Realme UI\r\nCPU: MediaTek Helio G85 (12nm) Octa-core up to 2.0 GHz\r\nGPU: Mali-G52 MC2\r\nKamera: Dual 13 MP, f/2.2, 26mm (wide) &amp; 2 MP B/W, f/2.4, depan 8 MP, f/2.0, 26mm (wide)\r\nSIM: Dual SIM (Nano-SIM)\r\nBaterai: Non-removable Li-Po 6000 mAh\r\nBerat: 207 gram\r\nGaransi Resmi', '12.jpg'),
(13, 13, 'realme C20 2GB 32GB - Blue', 1299000, 20, 'Ukuran layar: 6.5 inches, 720 x 1600 pixels (~270 ppi density) IPS LCD\r\nMemori: RAM 2GB, ROM 32GB, microSDXC Slot\r\nSistem operasi: Android 11; Realme UI\r\nCPU: MediaTek Helio G35 (12 nm), Octa-core (4x2.3 GHz Cortex-A53 &amp; 4x1.8 GHz Cortex-A53)\r\nGPU: PowerVR GE8320\r\nKamera Belakang: 8 MP f/2.0 AF (wide)\r\nKamera Depan: 5 MP f/2.2 (wide)\r\nSIM: Dual SIM (Nano-SIM, dual stand-by)\r\nBaterai: Li-Po 5000 mAh, non-removable\r\nBerat: 190 gr\r\nGaransi Resmi', '13.jpg'),
(14, 13, 'realme 8 Pro 8GB 128GB - Blue', 4499000, 19, 'Ukuran layar: 6.4 inci, 1080 x 2400 pixels, Super AMOLED\r\nMemori: RAM 8 GB, ROM 128 GB, MicroSD slot\r\nSistem operasi: Android 11, Realme UI 2.0\r\nCPU: Qualcomm SM7125 Snapdragon 720G (8 nm) Octa-core up to 2.3 GHz\r\nGPU: Adreno 618\r\nKamera: Quad 108 MP, f/1.88, 26mm (wide); 8 MP, f/2.25, 119˚, 16mm (ultrawide); 2 MP, f/2.4, (macro); 2 MP, f/2.4, (depth), depan 16 MP, f/2.45, (wide)\r\nSIM: Dual SIM (Nano-SIM)\r\nBaterai: Li-Po 4500 mAh, non-removable\r\nBerat: 176 gram\r\nGaransi Resmi', '14.jpg'),
(15, 14, 'vivo Y12 3GB 32GB - Thunder Black', 1999000, 20, 'Ukuran layar: 6.35 inci, 720 x 1544 pixels, IPS LCD capacitive touchscreen, 16M colors\r\nMemori: RAM 3 GB, ROM 32 GB, MicroSD up to 256 GB\r\nSistem operasi: Android 9.0 (Pie); Funtouch 9\r\nCPU: Mediatek MT6762 Helio P22 (12 nm) Octa-core 2.0 GHz Cortex-A53\r\nGPU: PowerVR GE8320\r\nKamera: Triple 13 MP, f/2.2, PDAF; 8 MP, f/2.2, 16mm (ultrawide); 2 MP, f/2.4, depth sensor, depan 8 MP, f/1.8\r\nSIM: Dual SIM (Nano-SIM)\r\nBaterai: Non-removable Li-Po 5000 mAh\r\nBerat: 190.5 gram\r\nGaransi Resmi', '15.jpg'),
(16, 14, 'vivo Y51A 8/128GB - Titanium Sapphire', 3399000, 17, 'Ukuran layar: 6.58 inci, 1080 x 2408 pixels, 21:9 ratio, IPS LCD\r\nMemori: RAM 8 GB, ROM 128 GB, microSDXC slot\r\nSistem operasi: Android 11; Funtouch 11\r\nCPU: Qualcomm SDM6115 Snapdragon 662 11 nm (Octa-core 4x2.0 GHz Kryo 260 Gold & 4x1.8 GHz Kryo 260 Silver)\r\nGPU: Adreno 610\r\nKamera: Triple 48 MP f/1.8, (wide) PDAF, 8 MP f/2.2 120˚(ultrawide), 2 MP f/2.4 (macro). Depan 16 MP f/2.0 (wide)\r\nSIM: Dual SIM (Nano-SIM, dual stand-by)\r\nBaterai: Li-Po 5000 mAh, non-removable\r\nBerat: 188 gr\r\nGaransi Resmi', '16.jpg'),
(17, 14, 'vivo Y51A 8GB 128GB - Crystal Symphony', 3399000, 20, 'Ukuran layar: 6.58 inci, 1080 x 2408 pixels, 21:9 ratio, IPS LCD\r\nMemori: RAM 8 GB, ROM 128 GB, microSDXC slot\r\nSistem operasi: Android 11; Funtouch 11\r\nCPU: Qualcomm SDM6115 Snapdragon 662 11 nm (Octa-core 4x2.0 GHz Kryo 260 Gold &amp; 4x1.8 GHz Kryo 260 Silver)\r\nGPU: Adreno 610\r\nKamera: Triple 48 MP f/1.8, (wide) PDAF, 8 MP f/2.2 120˚(ultrawide), 2 MP f/2.4 (macro). Depan 16 MP f/2.0 (wide)\r\nSIM: Dual SIM (Nano-SIM, dual stand-by)\r\nBaterai: Li-Po 5000 mAh, non-removable\r\nBerat: 188 gr\r\nGaransi Resmi', '17.jpg'),
(18, 11, 'Xiaomi Redmi 9 3/32GB - Sunset Purple', 1599000, -1, 'Ukuran layar: 6.53 inci, 1080 x 2340 pixels, 19.5:9 ratio, IPS LCD capacitive touchscreen, 16M colors\r\nMemori: RAM 3 GB, ROM 32 GB, microSD Slot\r\nSistem operasi: Android 10; MIUI 12\r\nCPU: Mediatek Helio G80 12 nm (Octa-core 2x2.0 GHz Cortex-A75 & 6x1.8 GHz Cortex-A55)\r\nGPU: Mali-G52 MC2\r\nKamera: Belakang Quad 13 MP f/2.2 28mm (wide) PDAF, 8 MP f/2.2 118˚(ultrawide), 5 MP f/2.4 (macro), 2 MP f/2.4 (depth); Depan Single 8 MP f/2.0 27mm (wide)\r\nSIM: Dual SIM (Nano-SIM, dual stand-by)\r\nBaterai: Non-removable Li-Po 5020 mAh\r\nBerat: 198 gr\r\nGaransi Resmi', '18.jpg'),
(19, 11, 'Xiaomi Redmi 9T 4/64GB - Ocean Green', 1999000, 20, 'Ukuran layar: 6.53 inci, 1080 x 2340 pixels, IPS LCD, 400 nits\r\nMemori: RAM 4 GB, ROM 64 GB, MicroSD up to 512GB\r\nSistem operasi: Android 10, MIUI 12\r\nCPU: Qualcomm SM6115 Snapdragon 662 (11 nm) Octa-core up to 2.0 GHz\r\nGPU: Adreno 610\r\nKamera: Quad 48 MP, f/1.79, 26mm (wide), PDAF; 8 MP, f/2.2, 120˚ (ultrawide), 1/4.0\", 1.12µm; 2 MP, f/2.4, (macro); 2 MP, f/2.4, (depth), depan 8 MP, f/2.05, 27mm (wide)\r\nSIM: Dual SIM (Nano-SIM)\r\nBaterai: Non-removable Li-Po 6000 mAh\r\nBerat: 198 gram\r\nGaransi Resmi', '19.jpg'),
(20, 11, 'Xiaomi Poco F3 6/128GB - Deep Ocean Blue', 4999000, 19, 'Ukuran layar: 6.67 inches, 1080 x 2400 pixels (~395 ppi density) AMOLED, 120Hz, HDR10+\r\nMemori: RAM 6GB, ROM 128GB\r\nSistem operasi: Android 11; MIUI 12\r\nCPU: Qualcomm SM8250-AC Snapdragon 870 5G (7 nm), Octa-core (1x3.2 GHz Kryo 585 & 3x2.42 GHz Kryo 585 & 4x1.80 GHz Kryo 585)\r\nGPU: Adreno 650\r\nKamera Belakang: 48 MP f/1.8 26mm PDAF (wide), 8 MP f/2.2 119˚(ultrawide), & 5 MP f/2.4 50mm (macro)\r\nKamera Depan: 20 MP f/2.5 (wide)\r\nSIM: Dual SIM (Nano-SIM, dual stand-by)\r\nBaterai: Li-Po 4520 mAh, non-removable\r\nBerat: 196 gr\r\nGaransi Resmi', '20.jpg'),
(21, 11, 'Xiaomi Redmi 9 3/32GB - Lunar Gold Free Mi In-Ear Headphones Basic', 1649000, 20, 'Ukuran layar: 6.53 inci, 1080 x 2340 pixels, 19.5:9 ratio, IPS LCD capacitive touchscreen, 16M colors\r\nMemori: RAM 3 GB, ROM 32 GB, microSD Slot\r\nSistem operasi: Android 10; MIUI 12\r\nCPU: Mediatek Helio G80 12 nm (Octa-core 2x2.0 GHz Cortex-A75 & 6x1.8 GHz Cortex-A55)\r\nGPU: Mali-G52 MC2\r\nKamera: Belakang Quad 13 MP f/2.2 28mm (wide) PDAF, 8 MP f/2.2 118˚(ultrawide), 5 MP f/2.4 (macro), 2 MP f/2.4 (depth); Depan Single 8 MP f/2.0 27mm (wide)\r\nSIM: Dual SIM (Nano-SIM, dual stand-by)\r\nBaterai: Non-removable Li-Po 5020 mAh\r\nBerat: 198 gr\r\nGaransi Resmi', '21.jpg'),
(25, 14, 'vivo V21 8GB 256GB - Roman Black Free Giftbox', 4999999, 25, 'Ukuran layar: 6.44 inci, 1080 x 2400 pixels, AMOLED, HDR10\r\nMemori: RAM 8 GB, ROM 256 GB, MicroSDXC Slot\r\nSistem operasi: Android 11, Funtouch 11.1\r\nCPU: Qualcomm SM7125 Snapdragon 720G (8 nm), Octa-core (2x2.3 GHz Kryo 465 Gold & 6x1.8 GHz Kryo 465 Silver)\r\nGPU: Adreno 618\r\nKamera: Triple 64 MP f/1.9 26mm PDAF (wide), 8 MP f/2.2 120˚16mm (ultrawide); 2 MP f/2.4 (macro); Depan 44 MP f/2.0 AF (wide)\r\nSIM: Dual SIM (Nano-SIM, dual stand-by)\r\nBaterai: Non-removable Li-Po 4000 mAh\r\nBerat: 171 gr\r\nGaransi Resmi', 'a4ae604b4b7933d9c973bde7569d38e9.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `surel` (`nama_pengguna`);

--
-- Indexes for table `tb_brand`
--
ALTER TABLE `tb_brand`
  ADD PRIMARY KEY (`id_brand`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `surel` (`surel`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_brand` (`id_brand`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tb_brand`
--
ALTER TABLE `tb_brand`
  MODIFY `id_brand` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  MODIFY `id_detail_pesanan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  ADD CONSTRAINT `tb_detail_pesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_detail_pesanan_ibfk_3` FOREIGN KEY (`id_pesanan`) REFERENCES `tb_pesanan` (`id_pesanan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD CONSTRAINT `tb_pesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`id_brand`) REFERENCES `tb_brand` (`id_brand`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
