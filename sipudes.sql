-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2018 at 08:17 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipudes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text,
  `status` int(1) DEFAULT NULL,
  `id_penduduk` varchar(50) DEFAULT NULL,
  `akses` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `status`, `id_penduduk`, `akses`) VALUES
(1, 'mzackyir', '0c22828099b789d62a96fc1f87928f43', 1, '9879878978', 1),
(5, '15094', 'b55d83ccddafa95f0dddb6e63d593cc9', 1, '15094', 2),
(6, '15077', '0a15350bdbbdd4b3bede03a525997ca4', 1, '15077', 2),
(7, '15078', 'd76d3d7839b4b0bd049054eea0f45938', 1, '15078', 2),
(9, '12451341436', '04267d79287d7d71f1d2e56b8aaa3b68', 1, '12451341436', 1),
(10, 'barlev', 'e92c55556c761c33779859d1d62b24d3', 1, '1111', 1);

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id_agama` varchar(10) NOT NULL,
  `agama` varchar(30) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id_agama`, `agama`, `status`) VALUES
('000000001', 'Islam', 1),
('000000002', 'Kristen', 1),
('000000003', 'Katholik', 1),
('000000004', 'Hindu', 1),
('000000005', 'Budha', 1),
('000000006', 'Khonghucu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `desa`
--

CREATE TABLE `desa` (
  `desa` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kabupaten` varchar(50) NOT NULL,
  `kepala_desa` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desa`
--

INSERT INTO `desa` (`desa`, `kecamatan`, `kabupaten`, `kepala_desa`) VALUES
('GEMPOL', 'BANYUSARI', 'KARAWANG', 'AGUS SUBHAN, S.E');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id_kategori` varchar(30) DEFAULT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `file` text,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id_kategori`, `nik`, `file`, `status`) VALUES
('000000001', '9879878978', 'update201608280143400000000019879878978.pdf', 1),
('000000004', '15078', 'update2017122707272000000000415078.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(30) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`, `status`) VALUES
('000000001', 'KTP', 1),
('000000002', 'Akte', 1),
('000000003', 'Surat Nikah', 1),
('000000004', 'Dokumen Penting Lainnya', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_klasifikasi`
--

CREATE TABLE `kategori_klasifikasi` (
  `id_kategori` varchar(20) DEFAULT NULL,
  `id_klasifikasi` varchar(10) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_klasifikasi`
--

INSERT INTO `kategori_klasifikasi` (`id_kategori`, `id_klasifikasi`, `status`) VALUES
('000000001', '000000002', 1),
('000000004', '000000002', 1),
('000000002', '000000003', 1),
('000000003', '000000002', 1),
('000000002', '000000002', 1),
('000000003', '000000003', 1),
('000000004', '000000003', 1),
('000000001', '000000003', 1),
('000000002', '000000001', 1),
('000000002', '000000004', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kk`
--

CREATE TABLE `kk` (
  `id_kk` varchar(20) NOT NULL,
  `no_kk` varchar(50) DEFAULT NULL,
  `rt` varchar(5) DEFAULT NULL,
  `rw` varchar(5) DEFAULT NULL,
  `kk` varchar(30) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kk`
--

INSERT INTO `kk` (`id_kk`, `no_kk`, `rt`, `rw`, `kk`, `status`) VALUES
('000000001', '487921479', '02', '02', '', '1'),
('000000002', '154315', '1', '1', '', '1'),
('000000003', '1818181818', '18', '18', '', '1'),
('000000004', '111111111', '01', '01', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi`
--

CREATE TABLE `klasifikasi` (
  `id_klasifikasi` varchar(10) DEFAULT NULL,
  `klasifikasi` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klasifikasi`
--

INSERT INTO `klasifikasi` (`id_klasifikasi`, `klasifikasi`, `status`) VALUES
('000000001', 'Anak-anak', 1),
('000000002', 'Dewasa', 1),
('000000003', 'Orang Tua', 1),
('000000004', 'Remaja', 1);

-- --------------------------------------------------------

--
-- Table structure for table `klasifikasi_penduduk`
--

CREATE TABLE `klasifikasi_penduduk` (
  `nik` varchar(50) DEFAULT NULL,
  `id_klasifikasi` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klasifikasi_penduduk`
--

INSERT INTO `klasifikasi_penduduk` (`nik`, `id_klasifikasi`) VALUES
('879678676', '000000002'),
('76798697786767', '000000002'),
('769878767', '000000002'),
('897980798', '000000003'),
('67575577667', '000000003'),
('9879878978', '000000002'),
('15094', '000000004'),
('15078', '000000003'),
('15077', '000000002'),
('15082', '000000002'),
('12451341436', '000000002'),
('1111', '000000002');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `nik` varchar(100) NOT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` varchar(10) DEFAULT NULL,
  `jk` varchar(10) DEFAULT NULL,
  `golongan_darah` varchar(5) DEFAULT NULL,
  `alamat` text,
  `pekerjaan` text,
  `kewarganegaraan` varchar(50) DEFAULT NULL,
  `id_agama` varchar(30) DEFAULT NULL,
  `id_kk` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`nik`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jk`, `golongan_darah`, `alamat`, `pekerjaan`, `kewarganegaraan`, `id_agama`, `id_kk`, `foto`, `status`) VALUES
('1111', 'BARLEV', 'BOGOR', '12/12/1995', 'Laki-laki', 'A', 'GEMPOLS', '', 'INDONESIA', '000000002', '000000004', 'uploadfoto201712270801001111.jpeg', 1),
('12451341436', 'ASEP JAMALUDIN', 'KARAWANG', '03/09/1996', 'Laki-laki', 'AB', 'GOMPOLS', '', 'INDONESIA', '000000002', '000000003', 'uploadfoto2017122707424112451341436.jpeg', 1),
('15077', 'IRFAN MAULANA', 'BOGOR', '01/01/1997', 'Laki-laki', 'A', 'KARAWANG', 'GAMER', 'INDONESIA', '000000001', '000000002', '', 1),
('15078', 'IRFAN MAULANA', 'KARAWANG', '01/01/1997', 'Laki-laki', 'A', 'KARAWANG', 'SUPIR BABEH', 'INDONESIA', '000000001', '000000001', '', 1),
('15082', 'ANGEL', 'KARAWANG', '03/09/1996', 'Perempuan', 'AB', 'GOMPOLS', 'MAHASISWI', 'INDONESIA', '000000002', '000000003', 'uploadfoto2017122706260715082.jpeg', 1),
('15094', 'MUHAMAD SHOLIKIN', 'LAMPUNG', '15/11/1996', 'Laki-laki', 'A', 'KARAWANG', 'MUSISI', 'INDONESIA', '000000001', '000000002', 'uploadfoto2017122705560015094.jpeg', 1),
('9879878978', 'MUHAMAD ZAQI IRWANSYAH', 'KARAWANG', '27/02/1996', 'Laki-laki', 'O', 'JALAN BUNTU', 'MAHASISWA', 'INDONESIA', '000000001', '000000001', 'uploadfoto201712270425449879878978.jpeg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`desa`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kk`
--
ALTER TABLE `kk`
  ADD PRIMARY KEY (`id_kk`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
