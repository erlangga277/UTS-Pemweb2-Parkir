-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 06:39 PM
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
-- Database: `parkir_kampus`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_parkir`
--

CREATE TABLE `area_parkir` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `kampus_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area_parkir`
--

INSERT INTO `area_parkir` (`id`, `nama`, `kapasitas`, `keterangan`, `kampus_id`) VALUES
(1, 'Lapangan Kampus A', 250, 'Depan gerbang utama', 1),
(2, 'Lapangan Gedung B1', 100, 'Dekat gerbang ke-2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `nama`) VALUES
(1, 'Motor '),
(2, 'Mobil');

-- --------------------------------------------------------

--
-- Table structure for table `kampus`
--

CREATE TABLE `kampus` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `alamat` varchar(45) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kampus`
--

INSERT INTO `kampus` (`id`, `nama`, `alamat`, `latitude`, `longitude`) VALUES
(1, 'Kampus A Nurul Fikri', 'Jl. Situ Indah 116, Tugu, Cimanggis, Depok, J', -6.362656603383911, 106.84335835598849),
(2, 'Kampus B Nurul Fikri', 'Jl. Raya Lenteng Agung No.20-21, RT.4/RW.1, S', -6.352721897505505, 106.8330742084003);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` int(11) NOT NULL,
  `merk` varchar(30) DEFAULT NULL,
  `pemilik` varchar(40) DEFAULT NULL,
  `nopol` varchar(20) DEFAULT NULL,
  `thn_beli` int(11) DEFAULT NULL,
  `deskripsi` varchar(200) DEFAULT NULL,
  `jenis_kendaraan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `merk`, `pemilik`, `nopol`, `thn_beli`, `deskripsi`, `jenis_kendaraan_id`) VALUES
(1, 'Yamaha', 'Toni Kurniawan', 'B 3131 UX', 2020, 'Yamaha Mio M3', 1),
(2, 'Vespa', 'Kim Kevin', 'B 4455 OP', 2020, 'Vespa Primavera 150', 1),
(4, 'Kawasaki', 'Muhamad Rifki', 'B 5566 EF', 2023, 'Kawasaki Ninja 250	', 2),
(5, 'Toyota', 'Revaldo Andhika', 'B 5678 XYZ', 2020, 'Toyota Avanza G 1.3', 2),
(6, 'Suzuki ', 'Nina Kartini', 'B 1122 CD', 2021, 'Suzuki Ertiga GX', 1),
(7, 'Yamaha', 'Adila Simatupang ', 'B 6677 TT', 2022, 'Yamaha Aerox 155', 2),
(8, 'Mitsubishi', 'Rafa Razak', 'D 1122 UV', 2022, 'Mitsubishi Xpander Cross', 1),
(9, 'Honda', 'Rudi Hartono', 'B 2233 YK', 2020, 'Honda Scoopy Stylish', 2),
(10, 'Wuling', 'Hana Ningrum', 'D 7878 WK', 2023, 'Wuling Almaz RS', 1),
(11, 'Honda', 'Rizky Saputra', 'B 2222 KY', 2021, 'Honda Scoopy Stylish	', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `mulai` time DEFAULT NULL,
  `akhir` time DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `biaya` double DEFAULT NULL,
  `kendaraan_id` int(11) DEFAULT NULL,
  `area_parkir_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tanggal`, `mulai`, `akhir`, `keterangan`, `biaya`, `kendaraan_id`, `area_parkir_id`) VALUES
(2, '2025-05-05', '08:00:00', '11:30:00', 'Mahasiswa akhir melakukan konsultasi', 6000, 7, 1),
(3, '2025-01-06', '09:15:00', '12:30:00', 'Mahasiswa kelas pagi', 5000, 4, 2),
(9, '2025-05-08', '08:20:00', '11:45:00', 'Hadir presentasi kelompok	', 5000, 7, 1),
(10, '2025-05-08', '08:20:00', '11:45:00', 'Hadir presentasi kelompok	', 5000, 4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area_parkir`
--
ALTER TABLE `area_parkir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kampus_id` (`kampus_id`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kampus`
--
ALTER TABLE `kampus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_kendaraan_id` (`jenis_kendaraan_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kendaraan_id` (`kendaraan_id`),
  ADD KEY `area_parkir_id` (`area_parkir_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area_parkir`
--
ALTER TABLE `area_parkir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kampus`
--
ALTER TABLE `kampus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area_parkir`
--
ALTER TABLE `area_parkir`
  ADD CONSTRAINT `area_parkir_ibfk_1` FOREIGN KEY (`kampus_id`) REFERENCES `kampus` (`id`);

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_ibfk_1` FOREIGN KEY (`jenis_kendaraan_id`) REFERENCES `jenis` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`area_parkir_id`) REFERENCES `area_parkir` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
