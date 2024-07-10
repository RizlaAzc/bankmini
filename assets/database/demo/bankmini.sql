-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jul 2024 pada 10.06
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankmini`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`, `kompetensi_keahlian`) VALUES
(2, 'X', 'PPLG'),
(4, 'X', 'MPLB'),
(16, 'X', 'AKL'),
(17, 'X', 'TJKT'),
(18, 'XII', 'PPLG'),
(19, 'XI', 'TJKT'),
(20, 'XI', 'PPLG'),
(21, 'XI', 'TJKT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` enum('Admin','Petugas') NOT NULL,
  `status` enum('Tidak Aktif','Sudah Aktif') NOT NULL,
  `waktu_dibuat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_lengkap`, `email`, `level`, `status`, `waktu_dibuat`) VALUES
(0, 'admin', '$2y$10$oDK6S5LHLMEeajxB2.jN4Od3thtCSQ3NolIkktst32qvdy.NwftK2', 'Admin', 'admin@gmail.com', 'Admin', 'Sudah Aktif', '2024-05-12 03:37:16'),
(14, 'tes', '$2y$10$myprSwdzBpGB3x4ryPdSYeSBokhr739UxkMxAhq/1fcmpGkVI19ry', 'tes', 'tes@gmail.com', 'Petugas', 'Tidak Aktif', '2024-05-22 10:46:21'),
(15, 'RizlaAzc', '$2y$10$Yb78RuBWHVCI5hr3LXPNoOK/Sd4x1PchuEr2A0uFM2nemwFmDYkAq', 'Rizla Azcha Fahrezi', 'azchafahrezi@gmail.com', 'Petugas', 'Sudah Aktif', '2024-05-22 11:12:11'),
(16, 'hanfit', '$2y$10$W0kqdSOxeCXhIySAO1GV4uQ5EpfNQkds52sPArdUt.Q9HGRbYlRne', 'Hana Fitria', 'annaftr@gmail.com', 'Petugas', 'Sudah Aktif', '2024-05-24 07:29:26'),
(17, 'tes1', '$2y$10$MwPEwlA2xFpMgchqX4bNguBNhRfKx9wx2NbH1pAnEhxNlgOorI6Zm', 'tes1', 'tes1@gmail.com', 'Admin', 'Sudah Aktif', '2024-06-10 02:06:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_transaksi`
--

CREATE TABLE `riwayat_transaksi` (
  `id_transaksi` int(9) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_tabungan` enum('Tabungan Harian','Tabungan Tahunan') NOT NULL,
  `keterangan` text NOT NULL,
  `debit` decimal(65,0) NOT NULL,
  `kredit` decimal(65,0) NOT NULL,
  `saldo` decimal(65,0) NOT NULL,
  `saldo_harian` decimal(65,0) NOT NULL,
  `saldo_tahunan` decimal(65,0) NOT NULL,
  `nis` char(9) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `riwayat_transaksi`
--

INSERT INTO `riwayat_transaksi` (`id_transaksi`, `tanggal`, `jenis_tabungan`, `keterangan`, `debit`, `kredit`, `saldo`, `saldo_harian`, `saldo_tahunan`, `nis`, `id_petugas`) VALUES
(1, '2024-05-22', 'Tabungan Harian', 'a', '1000', '0', '1000', '1000', '0', '212200000', 0),
(2, '2024-05-22', 'Tabungan Harian', 'asd', '10000', '0', '11000', '10000', '0', '212200002', 0),
(3, '2023-05-22', 'Tabungan Harian', 'asd', '4000', '0', '15000', '4000', '0', '212200003', 0),
(4, '2024-05-22', 'Tabungan Tahunan', 'a', '10000', '0', '25000', '0', '10000', '212200005', 0),
(6, '2024-05-22', 'Tabungan Harian', 'a', '0', '5000', '25000', '5000', '0', '212200002', 0),
(7, '2024-05-22', 'Tabungan Tahunan', 'a', '50000', '0', '75000', '4000', '50000', '212200003', 0),
(8, '2024-05-22', 'Tabungan Tahunan', 's', '0', '25000', '50000', '4000', '25000', '212200003', 0),
(9, '2024-05-22', 'Tabungan Harian', 'a', '5000', '0', '55000', '5000', '10000', '212200005', 0),
(11, '2024-05-22', 'Tabungan Tahunan', 'a', '40000', '0', '100000', '5000', '40000', '212200002', 0),
(19, '2024-05-22', 'Tabungan Harian', 'a', '1000', '0', '104000', '2000', '0', '212200000', 0),
(20, '2024-05-22', 'Tabungan Harian', 'a', '1000', '0', '105000', '3000', '0', '212200000', 0),
(21, '2024-05-23', 'Tabungan Harian', 'a', '2000', '0', '107000', '5000', '0', '212200000', 0),
(22, '2024-05-23', 'Tabungan Harian', 'a', '5000', '0', '112000', '10000', '0', '212200000', 0),
(23, '2024-05-24', 'Tabungan Harian', 'a', '5000', '0', '117000', '9000', '25000', '212200003', 0),
(24, '2024-06-09', 'Tabungan Harian', 'asd', '10000', '0', '127000', '19000', '25000', '212200003', 0),
(25, '2024-06-09', 'Tabungan Harian', 'asd', '20500', '0', '147500', '25500', '40000', '212200002', 0),
(26, '2024-06-09', 'Tabungan Harian', 'a', '0', '10000', '137500', '0', '0', '212200000', 0),
(27, '2024-06-09', 'Tabungan Harian', 'a', '1000', '0', '138500', '1000', '0', '212200000', 15),
(28, '2024-06-09', 'Tabungan Harian', 's', '5000', '0', '143500', '6000', '0', '212200000', 15),
(29, '2024-06-09', 'Tabungan Harian', 'a', '5000', '0', '148500', '11000', '0', '212200000', 15),
(30, '2024-06-09', 'Tabungan Harian', 'a', '5000', '0', '153500', '16000', '0', '212200000', 15),
(31, '2024-06-09', 'Tabungan Tahunan', 'aa', '5000', '0', '158500', '16000', '5000', '212200000', 15),
(32, '2024-06-09', 'Tabungan Harian', 'sad', '1000', '0', '159500', '6000', '10000', '212200005', 15),
(33, '2024-06-09', 'Tabungan Harian', 'a', '1000', '0', '160500', '26500', '40000', '212200002', 15),
(34, '2024-06-09', 'Tabungan Harian', 'a', '0', '5000', '155500', '14000', '25000', '212200003', 15),
(35, '2024-06-09', 'Tabungan Harian', 'a', '10000', '0', '165500', '26000', '5000', '212200000', 15),
(36, '2024-06-09', 'Tabungan Harian', 'a', '5000', '0', '170500', '31000', '5000', '212200000', 15),
(37, '2024-06-09', 'Tabungan Tahunan', 'a', '0', '5000', '165500', '14000', '20000', '212200003', 15),
(38, '2024-06-09', 'Tabungan Harian', 'aasddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd', '5000', '0', '170500', '36000', '5000', '212200000', 15),
(39, '2024-06-09', 'Tabungan Tahunan', 'ljnm', '0', '5000', '165500', '14000', '15000', '212200003', 15),
(40, '2024-06-10', 'Tabungan Harian', 'aaa', '10000', '0', '175500', '36500', '40000', '212200002', 17),
(41, '2024-07-08', 'Tabungan Harian', 'a', '10000', '0', '185500', '10000', '0', '222316004', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` char(9) NOT NULL,
  `nama_siswa` varchar(225) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `kelas` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama_siswa`, `jenis_kelamin`, `kelas`) VALUES
('212200000', 'Sample Nama 1', 'P', 'X AKL'),
('212200001', 'Sample Nama 2', 'L', 'XII RPL'),
('212200002', 'Sample Nama 3', 'P', 'XII RPL'),
('212200003', 'Sample Nama 4', 'L', 'XII RPL'),
('212200004', 'Sample Nama 5', 'P', 'XII RPL'),
('212200005', 'Sample Nama 6', 'P', 'XII RPL'),
('222316002', 'Abi Latiful Azis', 'L', 'XI TJKT'),
('222316003', 'Achmad Ardian Syahputra', 'L', 'XI TJKT'),
('222316004', 'Adam Chaesar Priambodo', 'L', 'XI TJKT'),
('222316005', 'Ade Ardiyansyah', 'L', 'XI TJKT'),
('222316010', 'Ahmad Fhatah Hardinata', 'L', 'XI TJKT'),
('222316012', 'Ajeng Pangestu', 'L', 'XI TJKT'),
('222316018', 'Anggara Pratama', 'L', 'XI TJKT'),
('222316027', 'Dika Refian Adittiya', 'L', 'XI TJKT'),
('222316029', 'Dwi Indra Permana', 'L', 'XI TJKT'),
('222316030', 'Dwi Prayogi', 'L', 'XI TJKT'),
('222316034', 'Faadhilah Akmal', 'L', 'XI TJKT'),
('222316037', 'Fadillah Rosyad Taufiqurrohman', 'L', 'XI TJKT'),
('222316039', 'Fahrezi Yudya Rahman', 'L', 'XI TJKT'),
('222316041', 'Fandi Pangestu', 'L', 'XI TJKT'),
('222316045', 'Febriansyah Alpharizi', 'L', 'XI TJKT'),
('222316047', 'Ferdiansyah', 'L', 'XI TJKT'),
('222316056', 'Ilham Bagus Setiawan', 'L', 'XI TJKT'),
('222316063', 'Kafka Muhammad Fitrah', 'L', 'XI TJKT'),
('222316064', 'Kafka Zul Xena', 'L', 'XI TJKT'),
('222316074', 'Mochamad Satria Dwi Jaka', 'L', 'XI TJKT'),
('222316076', 'Muhajir Kholid Awalid', 'L', 'XI TJKT'),
('222316077', 'Muhamad Farhan', 'L', 'XI TJKT'),
('222316080', 'Muhammad Afif Robbani', 'L', 'XI TJKT'),
('222316081', 'Muhammad Aldi Zakaria', 'L', 'XI TJKT'),
('222316084', 'Muhammad Dzaky Dzul Imtiyaz', 'L', 'XI TJKT'),
('222316094', 'Nanda Laily Sanie', 'P', 'XI TJKT'),
('222316103', 'Pasha Aditya Pratama', 'L', 'XI TJKT'),
('222316105', 'Rafli Setiawan', 'L', 'XI TJKT'),
('222316114', 'Restu Bagus Wicaksono', 'L', 'XI TJKT'),
('222316115', 'Reza Ahmad Fauzi', 'L', 'XI TJKT'),
('222316116', 'Rifqi Ramdhani', 'L', 'XI TJKT'),
('222316122', 'Said Agyl Alfathoni', 'L', 'XI TJKT'),
('222316130', 'Satrio Jiwandono', 'L', 'XI TJKT'),
('222316138', 'Subali', 'L', 'XI TJKT'),
('222316145', 'Tirta Wijaya Kusuma', 'L', 'XI TJKT'),
('222316146', 'Tri Sendi Saputra', 'L', 'XI TJKT'),
('222316153', 'Zahra Fitriany', 'P', 'XI TJKT'),
('232417001', 'Abu Sofyan Al Farish', 'L', 'X TJKT'),
('232417003', 'Adryan Juditia Irawan', 'L', 'X TJKT'),
('232417006', 'Akbar Rizki Pratama', 'L', 'X TJKT'),
('232417012', 'Ananda Damar Zakaesa', 'L', 'X TJKT'),
('232417017', 'Awalis Solihin', 'L', 'X TJKT'),
('232417019', 'Bagas Adiprasetyo', 'L', 'X TJKT'),
('232417025', 'Candra Wijaya Kusumah', 'L', 'X TJKT'),
('232417032', 'Dwi Ahmad Husairi', 'L', 'X TJKT'),
('232417039', 'Faisal Yusuf Al Zafar Sidiq', 'L', 'X TJKT'),
('232417042', 'Farij Rijiq', 'L', 'X TJKT'),
('232417058', 'Khavian Qais Banyu Pandu Riva', 'L', 'X TJKT'),
('232417072', 'Muhamad Alvi Rizkysyah', 'L', 'X TJKT'),
('232417073', 'Muhamad Fadhila Akbar', 'L', 'X TJKT'),
('232417074', 'Muhamad Hafizh Al-Muzaqy', 'L', 'X TJKT'),
('232417075', 'Muhamad Qory', 'L', 'X TJKT'),
('232417076', 'Muhamad Rafa Adibha', 'L', 'X TJKT'),
('232417077', 'Muhamad Rizki', 'L', 'X TJKT'),
('232417078', 'Muhamad Sahrul Putra Pratama', 'L', 'X TJKT'),
('232417080', 'Muhammad Alvarizki Nuh', 'L', 'X TJKT'),
('232417081', 'Muhammad Aryo Pratama', 'L', 'X TJKT'),
('232417082', 'Muhammad Erlangga Alfi Djaohar', 'L', 'X TJKT'),
('232417086', 'Muhammad Fajar Firmansyah', 'L', 'X TJKT'),
('232417087', 'Muhammad Ibnu Hafidz', 'L', 'X TJKT'),
('232417089', 'Muhammad Rafik Hidayat', 'L', 'X TJKT'),
('232417090', 'Muhammad Rizal', 'L', 'X TJKT'),
('232417099', 'Nayla Apriliani Putri', 'P', 'X TJKT'),
('232417101', 'Nisrina Arya Putri', 'P', 'X TJKT'),
('232417105', 'Nurida', 'P', 'X TJKT'),
('232417108', 'Rachmat Pasha Nugraha', 'L', 'X TJKT'),
('232417112', 'Rasya Aditya Sanjaya', 'L', 'X TJKT'),
('232417116', 'Revan Pratama', 'L', 'X TJKT'),
('232417119', 'Rionaldo Hermawan', 'L', 'X TJKT'),
('232417120', 'Rizki Ananda', 'L', 'X TJKT'),
('232417124', 'Sabrina Pratiwi', 'P', 'X TJKT'),
('232417135', 'Sinta Trihapsari', 'P', 'X TJKT'),
('232417139', 'Sururi Ahmad Muzaki', 'L', 'X TJKT'),
('232417150', 'Yazid Ramadhan Rendis', 'L', 'X TJKT');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `riwayat_transaksi`
--
ALTER TABLE `riwayat_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `riwayat_transaksi`
--
ALTER TABLE `riwayat_transaksi`
  MODIFY `id_transaksi` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `riwayat_transaksi`
--
ALTER TABLE `riwayat_transaksi`
  ADD CONSTRAINT `riwayat_transaksi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `riwayat_transaksi_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
