-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 19 Apr 2021 pada 10.37
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.3.27

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
-- Struktur dari tabel `ls_m_course`
--

CREATE TABLE `ls_m_course` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `sub_judul` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `url_video` text DEFAULT NULL,
  `type_video` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ls_m_course`
--

INSERT INTO `ls_m_course` (`id`, `judul`, `sub_judul`, `deskripsi`, `url_video`, `type_video`) VALUES
(1, 'Pesawat', 'Asal Usul Pesawat Terbang', '<p>Di Amerika Serikat, Penerbangan pesawat pertama kali dilakukan oleh Wright bersaudara pada 1903. Mereka merancang pesawatnya sendiri. Pesawat ini hanya cukup untuk satu orang. Di Inggris, seorang penemu pesawat terbang bernama Samuel F. Cody berhasil melakukan penerbangan pada 1910. Waktu itu, bentuk pesawat yang diciptakan masih sangat sederhana. belum seperti yang bisa dinikmati saat ini.</p>\r\n\r\n<p>Setelah Perang Dunia I, masa penerbangan sipil mulai tumbuh dan mengalami perkembangan cepat. Akhirnya banyak pesawat yang diproduksi untuk transportasi sipil. Selain itu, mulai juga bermunculan perusahaan penerbangan di Eropa dan Amerika. Seiring perkembangan zaman, bentuk dan mesin pesawat terbang mulai disempurnakan.</p>\r\n\r\n<p>Hal ini dilakukan untuk memenuhi kebutuhan transportasi udara. Pada 1949, dibuatlah pesawat komersial. Pesawat ini ukurannya lebih besar daripada pesawat-pesawat sebelumnya.</p>', 'http://localhost/learning/uploads/course_video/Persiapan_Lepas_landas_video_5_detik3.mp4', 'video/mp4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ls_m_user`
--

CREATE TABLE `ls_m_user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `headline` text DEFAULT NULL,
  `tentang_saya` text DEFAULT NULL,
  `role` enum('admin','user') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ls_m_user`
--

INSERT INTO `ls_m_user` (`id`, `nama_lengkap`, `username`, `password`, `email`, `headline`, `tentang_saya`, `role`) VALUES
(1, 'Farhan Maulana', 'farhan', 'f7f1b8f0529d71e9fa8e5407fc652883', 'farhanmaulana88@gmail.com', 'Test', 'Test', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_menu`
--

CREATE TABLE `m_menu` (
  `id` int(11) NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `nama_menu` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_menu`
--

INSERT INTO `m_menu` (`id`, `id_parent`, `nama_menu`, `icon`, `target`, `url`) VALUES
(1, NULL, 'Interface', 'x', NULL, NULL),
(2, 1, 'Master', '<i class=\"fas fa-fw fa-cog\"></i>', 'Master', NULL),
(3, 2, 'User', NULL, NULL, 'admin/users'),
(4, 2, 'Course', NULL, NULL, 'admin/course'),
(5, NULL, 'Addon', NULL, NULL, NULL),
(6, 5, 'Page', NULL, 'Page', NULL),
(7, 6, 'Login', NULL, NULL, 'admin/login');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ls_m_course`
--
ALTER TABLE `ls_m_course`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `ls_m_user`
--
ALTER TABLE `ls_m_user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `m_menu`
--
ALTER TABLE `m_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ls_m_course`
--
ALTER TABLE `ls_m_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ls_m_user`
--
ALTER TABLE `ls_m_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `m_menu`
--
ALTER TABLE `m_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
