-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Des 2021 pada 09.41
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counter`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `line` varchar(25) NOT NULL,
  `model` varchar(25) NOT NULL,
  `ok` int(11) NOT NULL,
  `ng` int(11) NOT NULL,
  `start` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `model`
--

INSERT INTO `model` (`id`, `model`) VALUES
(1, 'K59'),
(2, 'K60'),
(5, 'K2SA'),
(6, 'K2PG'),
(7, 'K15P'),
(8, 'K56R'),
(9, 'K0JA'),
(10, 'K1ZA'),
(11, 'K1GA'),
(17, 'K2PJ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ng_details`
--

CREATE TABLE `ng_details` (
  `log_id` int(11) NOT NULL,
  `kbhb1` int(11) NOT NULL,
  `kbhb2` int(11) NOT NULL,
  `kbhb3` int(11) NOT NULL,
  `kbhb4` int(11) NOT NULL,
  `knsb1` int(11) NOT NULL,
  `knsb2` int(11) NOT NULL,
  `knsb3` int(11) NOT NULL,
  `knsb4` int(11) NOT NULL,
  `mvsb1` int(11) NOT NULL,
  `mvsb2` int(11) NOT NULL,
  `mvsb3` int(11) NOT NULL,
  `mvsb4` int(11) NOT NULL,
  `pksb1` int(11) NOT NULL,
  `pksb2` int(11) NOT NULL,
  `pksb3` int(11) NOT NULL,
  `pksb4` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ng_details`
--
ALTER TABLE `ng_details`
  ADD KEY `ng_details_ibfk_1` (`log_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ng_details`
--
ALTER TABLE `ng_details`
  ADD CONSTRAINT `ng_details_ibfk_1` FOREIGN KEY (`log_id`) REFERENCES `log` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
