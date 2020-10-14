-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Okt 2019 pada 16.26
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pln`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$qvDdH4jmo6f4GlfV30BX6.Dr0KfbcH9qOi2i7LVlpGuFPcIpJPcSu', 'JoV2cnsQygDujMIlre7dcRhDaC0fNu2VaatZ9ADkOwrtSsQlZtlZM3XYHb1L', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `datadokters`
--

CREATE TABLE `datadokters` (
  `id` int(11) NOT NULL,
  `yakes_id` int(11) NOT NULL,
  `nama_dokter` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `datadokters`
--

INSERT INTO `datadokters` (`id`, `yakes_id`, `nama_dokter`, `nip`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dr. Malik', '343422222', 'Aktif', 'Ok', '2019-10-06 04:22:33', '2019-10-06 04:33:47'),
(3, 1, 'Dr. Yahya', '09857334', 'Aktif', 'Baik', '2019-10-06 04:26:24', '2019-10-06 04:26:24'),
(5, 2, 'Dr. Wahyuni', '563329923', 'Aktif', 'Ahli Bedah', '2019-10-08 06:05:35', '2019-10-08 06:05:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datakeluargas`
--

CREATE TABLE `datakeluargas` (
  `id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` int(10) UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `datakeluargas`
--

INSERT INTO `datakeluargas` (`id`, `pegawai_id`, `nik`, `nama`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(5, 1, '4567890876534', 'Ayu Anita', 'Saudara', '-', '2019-09-28 05:19:01', '2019-09-30 03:08:57'),
(9, 1, '45678945', 'Rahmatia', 'Ibu', '-', '2019-09-29 04:52:18', '2019-09-30 03:09:36'),
(10, 2, '127890876545', 'Rohani', 'Ibu', '-', '2019-10-03 07:36:04', '2019-10-03 07:36:04'),
(11, 3, '99900909090', 'Bunga Buriati', 'Ibu', '-', '2019-10-07 23:48:48', '2019-10-07 23:48:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datapengajuans`
--

CREATE TABLE `datapengajuans` (
  `id` int(10) UNSIGNED NOT NULL,
  `pegawai_id` int(10) UNSIGNED NOT NULL,
  `nama_pasien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hub_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengaju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `progres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dalam Proses',
  `foto_kuitansi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proses` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `datapengajuans`
--

INSERT INTO `datapengajuans` (`id`, `pegawai_id`, `nama_pasien`, `status`, `hub_keluarga`, `pengaju`, `progres`, `foto_kuitansi`, `proses`, `created_at`, `updated_at`) VALUES
(2, 1, 'Rahmat Ilyas', 'Pegawai', '-', 'Pegawai', 'Selesai', 'foto_kuitansi_1909305936.jpg', 1, '2019-09-29 22:59:36', '2019-10-08 05:44:54'),
(4, 1, 'Ayu Anita', 'Anggota Keluarga', 'Saudara', 'Pegawai', 'Dalam Proses', 'foto_kuitansi_1909304011.jpg', 0, '2019-09-30 05:40:11', '2019-09-30 05:40:11'),
(5, 1, 'Rahmatia', 'Anggota Keluarga', 'Ibu', 'Pegawai', 'Dalam Proses', 'foto_kuitansi_1909303934.jpg', 0, '2019-09-30 06:39:35', '2019-09-30 06:39:35'),
(8, 2, 'Rohani', 'Anggota Keluarga', 'Ibu', 'Pegawai', 'Dalam Proses', 'foto_kuitansi_1910035212.jpg', 0, '2019-10-03 07:52:12', '2019-10-03 07:52:12'),
(9, 2, 'Wirna Sintia Rahayu', 'Pegawai', '-', 'Pegawai', 'Dalam Proses', 'foto_kuitansi_1910050213.jpg', 0, '2019-10-05 05:02:13', '2019-10-05 05:02:13'),
(12, 1, 'Rahmat Ilyas', 'Pegawai', '-', 'Klinik Rakyat', 'Ditolak', '', 1, '2019-10-06 02:45:51', '2019-10-08 05:49:01'),
(13, 2, 'Rohani', 'Anggota Keluarga', 'Ibu', 'Klinik Rakyat', 'Selesai', '', 1, '2019-10-06 02:48:21', '2019-10-08 06:20:55'),
(14, 3, 'Wahyudin Annur', 'Pegawai', '-', 'Klinik Rakyat', 'Dalam Proses', '', 0, '2019-10-07 23:39:58', '2019-10-07 23:39:58'),
(15, 3, 'Bunga Buriati', 'Anggota Keluarga', 'Ibu', 'Klinik Rakyat', 'Dalam Proses', '', 0, '2019-10-07 23:50:31', '2019-10-07 23:50:31'),
(16, 3, 'Wahyudin Annur', 'Pegawai', '-', 'Klinik Bersalin', 'Selesai', '', 1, '2019-10-08 06:06:44', '2019-10-08 06:13:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuangans`
--

CREATE TABLE `keuangans` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keuangans`
--

INSERT INTO `keuangans` (`id`, `nama`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Muhammad Ilham', 'keuangan', '$2y$10$qvDdH4jmo6f4GlfV30BX6.Dr0KfbcH9qOi2i7LVlpGuFPcIpJPcSu', 'Bbp0SK5nykwV3Wj22TBoAg2RVsFCeRywHxK16kyFX2PlhTdaoacd1P87Ssbu', '2019-10-07 16:00:00', '2019-10-07 16:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_09_15_062231_create_admins_table', 2),
(4, '2019_09_15_072839_create_pegawais_table', 2),
(5, '2019_09_17_055938_create_yakes_table', 3),
(7, '2019_09_27_115617_create_datakeluargas_table', 4),
(10, '2019_09_29_152421_create_notadinas_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nomorsurats`
--

CREATE TABLE `nomorsurats` (
  `id` int(11) NOT NULL,
  `no_surat` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nomorsurats`
--

INSERT INTO `nomorsurats` (`id`, `no_surat`, `created_at`, `updated_at`) VALUES
(2, 396, NULL, '2019-10-08 06:12:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notadinas`
--

CREATE TABLE `notadinas` (
  `id` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `no_nota` varchar(255) DEFAULT NULL,
  `tggl_nota` date DEFAULT NULL,
  `nama_dokter` varchar(255) NOT NULL,
  `total_tagihan` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notadinas`
--

INSERT INTO `notadinas` (`id`, `pengajuan_id`, `no_nota`, `tggl_nota`, `nama_dokter`, `total_tagihan`, `created_at`, `updated_at`) VALUES
(1, 12, '393/KEU.00.02/KSA/2019', '2019-10-08', 'Dr. Yahya', 520000, '2019-10-06 02:45:51', '2019-10-08 02:27:50'),
(2, 13, '394/KEU.00.02/KSA/2019', '2019-10-08', 'Dr. Yahya', 700000, '2019-10-06 02:48:21', '2019-10-08 02:40:51'),
(3, 14, NULL, NULL, 'Dr. Malik', 0, '2019-10-07 23:39:58', '2019-10-07 23:39:58'),
(4, 15, NULL, NULL, 'Dr. Malik', 0, '2019-10-07 23:50:31', '2019-10-07 23:50:31'),
(5, 2, '392/KEU.00.02/KSA/2019', '2019-10-08', 'Dr. Hariyanto', 1230000, '2019-10-08 02:31:07', '2019-10-08 02:31:07'),
(6, 16, '395/KEU.00.02/KSA/2019', '2019-10-08', 'Dr. Wahyuni', 520000, '2019-10-08 06:06:44', '2019-10-08 06:12:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawais`
--

CREATE TABLE `pegawais` (
  `id` int(10) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tggl_lahir` date NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pegawais`
--

INSERT INTO `pegawais` (`id`, `nip`, `nama`, `email`, `jenis_kelamin`, `tggl_lahir`, `jabatan`, `unit`, `status`, `foto_kk`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '140298', 'Rahmat Ilyas', 'rahmat.ilyas142@gmail.com', 'Laki-laki', '1998-02-14', 'Direktur', 'Ntah', 'Lajang', 'foto_kk_id_1.jpg', '$2y$10$qvDdH4jmo6f4GlfV30BX6.Dr0KfbcH9qOi2i7LVlpGuFPcIpJPcSu', 'jDjiXad89s6tIlrZ46txOSE7MCqMVHNgthyS7lDlDMYfCFh4VYnaF3UpCJrg', NULL, '2019-10-03 06:51:01'),
(2, '3456789', 'Wirna Sintia Rahayu', 'wirna.stry@gmail.com', 'Perempuan', '1997-10-03', 'Pegawai', 'Ntah', 'Lajang', 'foto_kk_id_2.jpg', '$2y$10$ueCbAae8RQOeKBLcCjx7HemgsS2bpl7X1L0fYYTf8lxUjBBqVfNJK', 'Gs8M3C2ObsSlzR8wirpU4L65zXarLiPEdXl15inlMOy4nvbD8z6pglsZJ6jS', '2019-10-03 04:43:02', '2019-10-03 07:37:04'),
(3, '122321', 'Wahyudin Annur', 'yudhiannur@gmail.com', 'Laki-laki', '1998-10-02', 'Pegawai', 'Ntah', 'Lajang', 'foto_kk_id_3.jpg', '$2y$10$NEPJpONcoEPECrXvwSA4P.zV5gxwidcrdxzMgZLezchDlfhthkXWy', 'Sip5jH7MaZuV3KU9KAZ3r1mh4Eu3YQbxhcAEpWv6atccFzmFNOZvipFkpcjj', '2019-10-03 07:29:51', '2019-10-08 00:09:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihans`
--

CREATE TABLE `tagihans` (
  `id` int(11) NOT NULL,
  `notadinas_id` int(11) NOT NULL,
  `no_tagihan` varchar(255) NOT NULL,
  `jumlah_tagihan` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tagihans`
--

INSERT INTO `tagihans` (`id`, `notadinas_id`, `no_tagihan`, `jumlah_tagihan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 'REG-KR023', 500000, NULL, '2019-10-07 16:00:00', '2019-10-07 16:00:00'),
(2, 2, 'KRY-REG0923', 700000, NULL, '2019-10-07 16:00:00', '2019-10-07 16:00:00'),
(3, 3, '07/RJ-KITLUR/VII/2019', 1000000, NULL, '2019-10-07 23:39:58', '2019-10-07 23:39:58'),
(4, 4, '010-KITLUR/VII/2019', 650000, NULL, '2019-10-07 23:50:32', '2019-10-07 23:50:32'),
(5, 1, 'PPh', 20000, NULL, '2019-10-08 02:27:50', '2019-10-08 02:27:50'),
(6, 5, 'MRT-239/2019', 1200000, NULL, '2019-10-08 02:31:07', '2019-10-08 02:31:07'),
(7, 5, 'PPh-03/19', 30000, NULL, '2019-10-08 02:31:07', '2019-10-08 02:31:07'),
(8, 6, 'RKB/12-19/0034', 500000, NULL, '2019-10-08 06:06:45', '2019-10-08 06:06:45'),
(9, 6, 'PPh', 20000, NULL, '2019-10-08 06:12:31', '2019-10-08 06:12:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rahmat Ilyas', 'admin@test.com', '$2y$10$jTejzSxcl2oaX7Phu0fwlOXDiFL.R45tUNGyzzhB4GM2gIUe/fA3m', NULL, '2019-09-14 22:17:54', '2019-09-14 22:17:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `yakes`
--

CREATE TABLE `yakes` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_yakes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_yakes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telpon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `yakes`
--

INSERT INTO `yakes` (`id`, `id_yakes`, `nama_yakes`, `alamat`, `telpon`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'yks210429', 'Klinik Rakyat', 'Jl. Syekh Yusuf No.16', '08764543233', 'yakes', '$2y$10$qvDdH4jmo6f4GlfV30BX6.Dr0KfbcH9qOi2i7LVlpGuFPcIpJPcSu', 'xoo8KbsMrWNzQtqg4Pty2iQgZebRYpyvtz1RmncFqValCHV0DOJnKvMTrhU8', '2019-09-17 22:10:14', NULL),
(2, 'yks051709', 'Klinik Bersalin', 'Jl. Kemakmuran, No. 52', '085657255142', 'yks051709', '$2y$10$PbnjuuIw/LKt9k6se0IN7eFgcTTb3J3da2eIQO0tQbqNJ5u2ta3Xy', NULL, '2019-10-05 03:18:20', '2019-10-05 03:23:03');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indeks untuk tabel `datadokters`
--
ALTER TABLE `datadokters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `datakeluargas`
--
ALTER TABLE `datakeluargas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datakeluargas_pegawai_id_foreign` (`pegawai_id`);

--
-- Indeks untuk tabel `datapengajuans`
--
ALTER TABLE `datapengajuans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notadinas_pegawai_id_foreign` (`pegawai_id`);

--
-- Indeks untuk tabel `keuangans`
--
ALTER TABLE `keuangans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nomorsurats`
--
ALTER TABLE `nomorsurats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notadinas`
--
ALTER TABLE `notadinas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawais_nip_unique` (`nip`);

--
-- Indeks untuk tabel `tagihans`
--
ALTER TABLE `tagihans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `yakes`
--
ALTER TABLE `yakes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `datadokters`
--
ALTER TABLE `datadokters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `datakeluargas`
--
ALTER TABLE `datakeluargas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `datapengajuans`
--
ALTER TABLE `datapengajuans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `keuangans`
--
ALTER TABLE `keuangans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `nomorsurats`
--
ALTER TABLE `nomorsurats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `notadinas`
--
ALTER TABLE `notadinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pegawais`
--
ALTER TABLE `pegawais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tagihans`
--
ALTER TABLE `tagihans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `yakes`
--
ALTER TABLE `yakes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `datakeluargas`
--
ALTER TABLE `datakeluargas`
  ADD CONSTRAINT `datakeluargas_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`);

--
-- Ketidakleluasaan untuk tabel `datapengajuans`
--
ALTER TABLE `datapengajuans`
  ADD CONSTRAINT `notadinas_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawais` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
