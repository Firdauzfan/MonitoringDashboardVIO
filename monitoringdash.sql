-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2018 at 09:41 AM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoringdash`
--

-- --------------------------------------------------------

--
-- Table structure for table `camera`
--

CREATE TABLE `camera` (
  `id_camera` int(100) NOT NULL,
  `nama_camera` varchar(50) NOT NULL,
  `rtsp_camera` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `camera`
--

INSERT INTO `camera` (`id_camera`, `nama_camera`, `rtsp_camera`) VALUES
(1, 'Kamera Mushola', 'rtsp://admin:gspe12345@192.168.0.26:554/PSIA/streaming/channels/101'),
(2, 'Kamera Ruang Mushola 1', 'rtsp://admin:gspe12345@192.168.0.26:554/PSIA/streaming/channels/201'),
(3, 'Kamera Ruang Kerja 1', 'rtsp://admin:gspe12345@192.168.0.26:554/PSIA/streaming/channels/301'),
(4, 'Kamera Ruang Kerja 2', 'rtsp://admin:gspe12345@192.168.0.26:554/PSIA/streaming/channels/401'),
(5, 'Kamera Lantai 2', 'rtsp://admin:gspe12345@192.168.0.26:554/PSIA/streaming/channels/501'),
(6, 'Kamera Lantai 3', 'rtsp://admin:gspe12345@192.168.0.26:554/PSIA/streaming/channels/601'),
(7, 'Kamera Lantai 3 Tangga', 'rtsp://admin:gspe12345@192.168.0.26:554/PSIA/streaming/channels/701'),
(8, 'Kamera Resepsionis', 'rtsp://admin:gspe12345@192.168.0.26:554/PSIA/streaming/channels/801'),
(9, 'Kamera Parkir 1', 'rtsp://admin:gspe12345@192.168.0.26:554/PSIA/streaming/channels/901'),
(10, 'Kamera Lantai 1', 'rtsp://admin:gspe12345@192.168.0.26:554/PSIA/streaming/channels/1001'),
(11, 'Kamera Parkir 2', 'rtsp://admin:gspe12345@192.168.0.26:554/PSIA/streaming/channels/1601');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `path` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`path`) VALUES
('http://localhost/MonitoringDashboard');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `divisi` varchar(50) NOT NULL,
  `jumlah_karyawan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `divisi`, `jumlah_karyawan`) VALUES
(1, 'Sales', 30),
(2, 'IT', 20),
(3, 'Human Resource', 10),
(4, 'Procurement', 40);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `department` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_pegawai`, `username`, `department`, `jabatan`, `email`, `no_hp`, `password`, `photo`, `role`, `created_at`) VALUES
(1, 0, 'admin', '', '', 'admin@gmail.com', '0', 'admin', '', '', '2018-03-01 09:28:56'),
(2, 123, 'jourdan', '', '', 'jourdan@gmail.com', '0', 'jourdan', '', 'user', '2018-06-05 03:07:22'),
(3, 123456, 'ahmad', 'IT Dept', 'Staff', 'ahmad@gmail.com', '081567920578', 'ahmad', 'poto/ahmad_123456_180607115038_rack.jpg', 'supir', '2018-06-04 08:16:19'),
(5, 12345, 'Firdauz Fanani', 'IT Dept', 'Staff', 'firdauzfanani@gmail.com', '081567920578', '12345', 'poto/FirdauzFanani_12345_180809115615_FirdauzFanani.jpg', 'user', '2018-06-05 15:35:03'),
(6, 1234567, 'Jourdan', '', '', 'jourdan@gmail.com', '081567920578', 'jourdan', '', 'supir', '2018-06-20 13:37:18'),
(7, 1234, 'Firdauz', 'IT', 'Staff', 'firdauzfanani@gmail.com', '081567920578', '12345', '', 'user', '2018-06-20 14:27:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `camera`
--
ALTER TABLE `camera`
  ADD PRIMARY KEY (`id_camera`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `camera`
--
ALTER TABLE `camera`
  MODIFY `id_camera` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
