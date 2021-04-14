-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2021 at 05:48 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_learningsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `headline` varchar(50) NOT NULL,
  `tentang_saya` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id`, `nama_lengkap`, `username`, `password`, `email`, `headline`, `tentang_saya`) VALUES
(1, 'Dicky Arya Pratama', 'dicky_arya', 'arya654321', 'dickyarya.pratama@hotmail.com', 'Technology Enthusiast', 'Aku adalah seorang technology enthusiast, menyukai hal-hal baru dan juga seorang fast learner, ada 2'),
(2, 'Ackerman', 'ackerman11', 'ackerman123', 'ackerman@gmail.com', 'Most Brutal Person', 'nothing'),
(3, 'asdasdas', 'asdasasdasd', 'asdas', 'dickyarya17@outlook.com', 'asdaaS', 'sdasdas'),
(4, 'asas', 'asa', 'asa', 'asas', 'asa', 'asa'),
(5, 'Arya Pratama', 'arya654321', 'arya654321', 'arya@gmail.com', 'programmer', 'cool'),
(6, 'asd', 'asdas', 'asdas', 'asasdas', 'asd', 'asda'),
(7, 'as', 'AS', 'asA', 'asASa', 'ASas', 'ASa'),
(8, 'asdasdas', 'as', 'AS', 'as', 'AS', 'ASa'),
(9, 'dicky arya p', 'testmd5', 'a28c379d216d6b113ec1938d9', 'arya@yahoo.co.id', 'smartboy', 'nothing'),
(10, 'testmd5', 'testmd5euy', 'a28c379d216d6b113ec1938d9b4fdab2', 'arya@yahoo.co.il', 'aryaa', 'huhu'),
(11, 'Dicky Arya Pratama', 'arya_ackerman', 'a28c379d216d6b113ec1938d9b4fdab2', 'dickyarya@yahoo.com', 'Programmer', 'I am just a man who interested in code ');

-- --------------------------------------------------------

--
-- Table structure for table `testtable`
--

CREATE TABLE `testtable` (
  `id` varchar(5) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `alamat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testtable`
--

INSERT INTO `testtable` (`id`, `nama`, `kelas`, `alamat`) VALUES
('B1', 'Dicky Arya Pratama', 'Informatika', 'Padalarang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testtable`
--
ALTER TABLE `testtable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
