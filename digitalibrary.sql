-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2024 at 07:16 AM
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
-- Database: `digitalibrary`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `jmlAlamatUser` (IN `AlamatUser` VARCHAR(255), OUT `Alamat_User` VARCHAR(255), OUT `Ijumlah` INT)   SELECT Alamat, COUNT(*) INTO Alamat_User, Ijumlah FROM user WHERE Alamat=AlamatUser$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `jmlbuku` (IN `NM_Penerbit` VARCHAR(25), OUT `Ijumlah` INT)   SELECT COUNT(*) INTO Ijumlah FROM buku WHERE Penerbit=NM_Penerbit$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Usr` (OUT `x` VARCHAR(25), OUT `y` VARCHAR(25), IN `z` CHAR(3))   BEGIN
SELECT NamaLengkap, Alamat INTO x, y FROM user WHERE UserID=z;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `BukuID` int(11) NOT NULL,
  `Judul` varchar(255) NOT NULL,
  `Penulis` varchar(255) NOT NULL,
  `Penerbit` varchar(255) NOT NULL,
  `TahunTerbit` int(11) NOT NULL,
  `StokBuku` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`BukuID`, `Judul`, `Penulis`, `Penerbit`, `TahunTerbit`, `StokBuku`) VALUES
(1, 'Keajaiban Toko Kelontong Namiya', 'Keigo Higashino', 'Gramedia Pustaka Utama', 2021, 1),
(2, 'Kartun Biologi', 'Larry Gonick', 'Kepustakaan Populer Gramedia', 2021, 4),
(3, 'Filosofi Teras', 'Henry Manampiring', 'Kompas Penerbit Buku', 2018, 5),
(4, 'Menua dengan Gembira', 'Andina Dwifatma', 'shira media', 2023, 3),
(5, 'Detik-Detik Asesmen Nasional SMA/MA : AKM Numerasi', 'Eko Sujatmiko, Suparno, Miyanto', 'PT Penerbit Intan Pariwara', 2020, 7),
(7, 'Untuk Negeriku: Sebuah Otobiografi Muhammad Hatta Edisi Baru', 'Muhammad Hatta', 'Penerbit Buku Kompas', 2001, 12),
(8, 'Funiculi Funicula', 'Toshikazu Kawaguchi', 'Gramedia Pustaka Utama', 2021, 7);

--
-- Triggers `buku`
--
DELIMITER $$
CREATE TRIGGER `del_buku` AFTER DELETE ON `buku` FOR EACH ROW insert into log_buku values('Hapus Data Peminjaman',now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ins_buku` AFTER INSERT ON `buku` FOR EACH ROW insert into log_buku values('Tambah Data Buku',now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_buku` AFTER UPDATE ON `buku` FOR EACH ROW insert into log_buku values('Ubah Data Buku',now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku`
--

CREATE TABLE `kategoribuku` (
  `KategoriID` int(11) NOT NULL,
  `NamaKategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoribuku`
--

INSERT INTO `kategoribuku` (`KategoriID`, `NamaKategori`) VALUES
(1, 'Fiksi'),
(2, 'Pendidikan'),
(3, 'Sains'),
(4, 'Seni'),
(5, 'Resep & Masakan'),
(6, 'Agama'),
(10, 'Filsafat'),
(11, 'Biografi & Autobiografi');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku_relasi`
--

CREATE TABLE `kategoribuku_relasi` (
  `KategoriBukuID` int(11) NOT NULL,
  `BukuID` int(11) NOT NULL,
  `KategoriID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoribuku_relasi`
--

INSERT INTO `kategoribuku_relasi` (`KategoriBukuID`, `BukuID`, `KategoriID`) VALUES
(1, 5, 2),
(2, 3, 10),
(3, 2, 3),
(4, 1, 1),
(5, 4, 4),
(6, 8, 1),
(7, 7, 11);

-- --------------------------------------------------------

--
-- Table structure for table `koleksipribadi`
--

CREATE TABLE `koleksipribadi` (
  `KoleksiID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BukuID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `koleksipribadi`
--

INSERT INTO `koleksipribadi` (`KoleksiID`, `UserID`, `BukuID`) VALUES
(2, 3, 3),
(31, 14, 1),
(32, 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `log_buku`
--

CREATE TABLE `log_buku` (
  `Kejadian` varchar(25) DEFAULT NULL,
  `Waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_buku`
--

INSERT INTO `log_buku` (`Kejadian`, `Waktu`) VALUES
('Tambah Data Buku', '2024-01-29 20:25:41'),
('Ubah Data Buku', '2024-01-29 20:25:57'),
('Hapus Data Peminjaman', '2024-01-29 20:26:33'),
('Tambah Data Buku', '2024-02-16 19:07:29'),
('Ubah Data Buku', '2024-02-16 19:07:42'),
('Hapus Data Peminjaman', '2024-02-16 19:07:50'),
('Ubah Data Buku', '2024-02-17 17:10:14'),
('Ubah Data Buku', '2024-02-17 17:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `log_peminjaman`
--

CREATE TABLE `log_peminjaman` (
  `Kejadian` varchar(25) DEFAULT NULL,
  `Waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_peminjaman`
--

INSERT INTO `log_peminjaman` (`Kejadian`, `Waktu`) VALUES
('Tambah Data Peminjaman', '2024-01-29 09:18:32'),
('Ubah Data Peminjaman', '2024-01-29 09:18:51'),
('Hapus Data Peminjaman', '2024-01-29 09:18:56'),
('Tambah Data Peminjaman', '2024-01-29 09:25:57'),
('Tambah Data Peminjaman', '2024-01-29 09:46:42'),
('Tambah Data Peminjaman', '2024-01-29 09:47:12'),
('Hapus Data Peminjaman', '2024-01-29 09:50:19'),
('Hapus Data Peminjaman', '2024-01-29 09:50:22'),
('Tambah Data Peminjaman', '2024-01-29 10:01:56'),
('Ubah Data Peminjaman', '2024-01-29 10:11:38'),
('Ubah Data Peminjaman', '2024-01-29 10:11:38'),
('Tambah Data Peminjaman', '2024-01-29 10:13:43'),
('Ubah Data Peminjaman', '2024-01-29 10:14:19'),
('Ubah Data Peminjaman', '2024-01-29 10:14:19'),
('Ubah Data Peminjaman', '2024-01-29 10:38:40'),
('Ubah Data Peminjaman', '2024-01-29 10:38:40'),
('Ubah Data Peminjaman', '2024-01-29 10:38:40'),
('Ubah Data Peminjaman', '2024-01-29 10:38:40'),
('Ubah Data Peminjaman', '2024-01-29 10:38:40'),
('Ubah Data Peminjaman', '2024-01-29 10:38:40'),
('Ubah Data Peminjaman', '2024-01-29 10:38:40'),
('Ubah Data Peminjaman', '2024-01-29 10:38:40'),
('Ubah Data Peminjaman', '2024-01-29 10:38:40'),
('Ubah Data Peminjaman', '2024-01-29 10:38:40'),
('Ubah Data Peminjaman', '2024-01-29 10:38:40'),
('Tambah Data Peminjaman', '2024-02-17 17:10:14'),
('Ubah Data Peminjaman', '2024-02-17 17:10:31'),
('Ubah Data Peminjaman', '2024-02-17 17:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `log_user`
--

CREATE TABLE `log_user` (
  `Kejadian` varchar(25) DEFAULT NULL,
  `Waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_user`
--

INSERT INTO `log_user` (`Kejadian`, `Waktu`) VALUES
('Tambah Data User', '2024-01-29 09:14:50'),
('Ubah Data User', '2024-01-29 09:15:04'),
('Hapus Data User', '2024-01-29 09:15:09'),
('Ubah Data User', '2024-01-30 09:01:39'),
('Hapus Data User', '2024-01-30 13:48:49'),
('Ubah Data User', '2024-02-04 19:27:40'),
('Hapus Data User', '2024-02-12 09:29:44'),
('Tambah Data User', '2024-02-14 20:44:01'),
('Hapus Data User', '2024-02-16 19:10:24'),
('Tambah Data User', '2024-02-16 19:18:05'),
('Ubah Data User', '2024-02-16 19:18:48'),
('Ubah Data User', '2024-02-16 19:18:48'),
('Hapus Data User', '2024-02-16 19:19:20'),
('Hapus Data User', '2024-02-16 19:20:13'),
('Hapus Data User', '2024-02-16 19:21:20'),
('Tambah Data User', '2024-02-16 19:24:20'),
('Ubah Data User', '2024-02-16 19:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `PeminjamanID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BukuID` int(11) NOT NULL,
  `TanggalPeminjaman` date NOT NULL,
  `TanggalPengembalian` date NOT NULL,
  `StatusPeminjaman` enum('Dipinjam','Dikembalikan') NOT NULL,
  `Keterangan` varchar(255) DEFAULT NULL,
  `JumlahPinjam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`PeminjamanID`, `UserID`, `BukuID`, `TanggalPeminjaman`, `TanggalPengembalian`, `StatusPeminjaman`, `Keterangan`, `JumlahPinjam`) VALUES
(2, 3, 3, '2023-12-03', '2023-12-15', 'Dikembalikan', 'Terlambat', 2),
(16, 3, 8, '2024-01-28', '2024-02-04', 'Dikembalikan', 'Tepat Waktu', 1),
(23, 3, 2, '2024-01-29', '2024-02-05', 'Dikembalikan', 'Tepat Waktu', 3),
(24, 14, 8, '2024-02-17', '2024-03-02', 'Dikembalikan', 'Tepat Waktu', 2);

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `del_peminjaman` AFTER DELETE ON `peminjaman` FOR EACH ROW insert into log_peminjaman values('Hapus Data Peminjaman',now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ins_peminjaman` AFTER INSERT ON `peminjaman` FOR EACH ROW insert into log_peminjaman values('Tambah Data Peminjaman',now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurangi_stok` AFTER INSERT ON `peminjaman` FOR EACH ROW update buku set StokBuku=StokBuku-new.JumlahPinjam 
where BukuID=new.BukuID
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_peminjaman` AFTER UPDATE ON `peminjaman` FOR EACH ROW insert into log_peminjaman values('Ubah Data Peminjaman',now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `PetugasID` int(11) NOT NULL,
  `Nama` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Level` enum('Administrator','Petugas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`PetugasID`, `Nama`, `Username`, `Password`, `Level`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator'),
(4, 'Petugas', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Petugas');

-- --------------------------------------------------------

--
-- Table structure for table `ulasanbuku`
--

CREATE TABLE `ulasanbuku` (
  `UlasanID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BukuID` int(11) NOT NULL,
  `Ulasan` text NOT NULL,
  `Rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasanbuku`
--

INSERT INTO `ulasanbuku` (`UlasanID`, `UserID`, `BukuID`, `Ulasan`, `Rating`) VALUES
(2, 3, 3, 'Bagus', 5),
(7, 14, 1, 'Seru sekali', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NamaLengkap` varchar(255) NOT NULL,
  `Alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `NamaLengkap`, `Alamat`) VALUES
(3, 'jake', '1200cf8ad328a60559cf5e7c5f46ee6d', 'jake@gmail.com', 'Jake', 'Jakarta'),
(14, 'peminjam', '55f3894bc5fc71fead8412d321c2952c', 'peminjam@gmail.com', 'Peminjam', 'Metro');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `del_user` AFTER DELETE ON `user` FOR EACH ROW insert into log_user values('Hapus Data User',now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ins_user` AFTER INSERT ON `user` FOR EACH ROW insert into log_user values('Tambah Data User',now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_user` AFTER UPDATE ON `user` FOR EACH ROW insert into log_user values('Ubah Data User',now())
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`BukuID`);

--
-- Indexes for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  ADD PRIMARY KEY (`KategoriID`);

--
-- Indexes for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD PRIMARY KEY (`KategoriBukuID`),
  ADD KEY `kategoribuku_relasi_ibfk_1` (`BukuID`),
  ADD KEY `kategoribuku_relasi_ibfk_2` (`KategoriID`);

--
-- Indexes for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD PRIMARY KEY (`KoleksiID`),
  ADD KEY `koleksipribadi_ibfk_1` (`UserID`),
  ADD KEY `koleksipribadi_ibfk_2` (`BukuID`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`PeminjamanID`),
  ADD KEY `peminjaman_ibfk_1` (`UserID`),
  ADD KEY `peminjaman_ibfk_2` (`BukuID`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`PetugasID`);

--
-- Indexes for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD PRIMARY KEY (`UlasanID`),
  ADD KEY `ulasanbuku_ibfk_1` (`UserID`),
  ADD KEY `ulasanbuku_ibfk_2` (`BukuID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `BukuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  MODIFY `KategoriID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  MODIFY `KategoriBukuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  MODIFY `KoleksiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `PeminjamanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `PetugasID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  MODIFY `UlasanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_1` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_2` FOREIGN KEY (`KategoriID`) REFERENCES `kategoribuku` (`KategoriID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD CONSTRAINT `koleksipribadi_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `koleksipribadi_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD CONSTRAINT `ulasanbuku_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulasanbuku_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
