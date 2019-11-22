-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 22, 2019 at 11:44 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartKendaraan`
--

CREATE TABLE `cartKendaraan` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `am` varchar(255) NOT NULL,
  `harga` int(30) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartKendaraan`
--

INSERT INTO `cartKendaraan` (`id`, `nama`, `merk`, `am`, `harga`, `username`, `tanggal`) VALUES
(1, '123@email.com', '123', '123', 90000000, 'test', '2019-11-16 13:30:03'),
(2, '12345', '1234', '123', 0, '123', '2019-11-19 16:24:23'),
(3, '12345', '123', '123', 500000, '123', '2019-11-19 20:13:05'),
(4, 'kl', 'jb', 'jkb', 9780, '123', '2019-11-19 20:16:56'),
(5, 'Jazz', 'Honda', 'Manual', 250000, '123', '2019-11-21 01:02:39');

-- --------------------------------------------------------

--
-- Table structure for table `cartService`
--

CREATE TABLE `cartService` (
  `id` int(10) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `lama` int(10) NOT NULL,
  `harga` int(30) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `am` varchar(255) NOT NULL,
  `harga` int(30) NOT NULL,
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`id`, `nama`, `merk`, `am`, `harga`, `link`) VALUES
(2, 'Jazz', 'Honda', 'Manual', 250000, 'https://image.iol.co.za/image/1/process/620x349?source=https://inm-baobab-prod-eu-west-1.s3.amazonaws.com/public/inm/media/2018/03/29/iol/948/IOLmotJazzSportAa.JPG'),
(5, 'Karimun', 'Suzuki', 'Manual', 250000, 'https://imgx.gridoto.com/crop/98x52:658x409/700x465/filters:watermark(file/2017/gridoto/img/watermark.png,5,5,60)/photo/gridoto/2017/12/22/51844720.png'),
(6, 'Car', 'Patty', 'Auto', 2000000, 'https://vignette.wikia.nocookie.net/spongebob/images/2/2c/The_Wagon.png/revision/latest?cb=20091111191332'),
(8, 'kl', 'jb', 'jkb', 9780, 'https://vignette.wikia.nocookie.net/spongebob/images/2/2c/The_Wagon.png/revision/latest?cb=20091111191332'),
(9, '7858', 'iyg', 'auto', 90709, 'https://vignette.wikia.nocookie.net/spongebob/images/2/2c/The_Wagon.png/revision/latest?cb=20091111191332'),
(11, 'test', 'test', 'auto', 123, 'https://media.wired.com/photos/5d09594a62bcb0c9752779d9/master/pass/Transpo_G70_TA-518126.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE `motor` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `am` varchar(255) NOT NULL,
  `harga` int(30) NOT NULL,
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `motor`
--

INSERT INTO `motor` (`id`, `nama`, `merk`, `am`, `harga`, `link`) VALUES
(3, 'A BIKE', 'NICKELODEON', 'MANUAL', 250000, 'https://vignette.wikia.nocookie.net/spongebob/images/a/a0/SBn29.png/revision/latest?cb=20121005150049'),
(4, 'ehe', 'ehe', 'A', 25000, 'https://cdn.moladin.com/motor/yamaha/Yamaha_Aerox_155_2061_77787_thumbnail.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(10) UNSIGNED NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `lama` varchar(255) NOT NULL,
  `harga` int(30) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `jenis`, `lama`, `harga`, `deskripsi`, `link`) VALUES
(7, 'SERVICE AC ', 'SAME DAY', 123, 'SERVICE AC SAMPE MAMPUS', 'https://i.pinimg.com/originals/9f/28/64/9f2864640980f66b69163b5bbb85a0ce.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `noTelp` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `noTelp`, `role`, `status`) VALUES
(19, 'abcde', 'admin123@email.com', '$2y$10$nQUvtXQV3JJfJWnI/Q3teOFkRWOZmU5j6Q324s0SgWMv2SxE2nPJK', '12345678910', 'user', ''),
(21, 'admin', 'admin@email.com', '$2y$10$TWPN5bMjmp80Af/Dvx6nZeSbvUhH9daDq/M..Lzbzpqol1Bwpm7rC', '123456', 'admin', ''),
(22, 'calfa', 'calfa@email.com', '$2y$10$X3P1Agw38knhIBwLM5wBV.nhYTAwHhH.ZWaS5P.cDDYoywXfRja2y', '123', 'user', ''),
(23, '123456', '1@email.com', '$2y$10$ncb399MYygkWrgi1DmMd.eZYr7OgmaDvljK2reSbvhxBl1H2qCSwu', '12345678910', 'user', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartKendaraan`
--
ALTER TABLE `cartKendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cartService`
--
ALTER TABLE `cartService`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartKendaraan`
--
ALTER TABLE `cartKendaraan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cartService`
--
ALTER TABLE `cartService`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `motor`
--
ALTER TABLE `motor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
