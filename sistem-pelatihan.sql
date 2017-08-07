-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07 Agu 2017 pada 06.07
-- Versi Server: 10.1.24-MariaDB
-- PHP Version: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem-pelatihan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `grup_latihan`
--

CREATE TABLE `grup_latihan` (
  `id` int(10) NOT NULL,
  `ketua_grup_id` int(10) UNSIGNED DEFAULT NULL,
  `nama_grup` varchar(25) NOT NULL,
  `lokasi_latihan_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(10) NOT NULL,
  `grup_id` int(10) NOT NULL,
  `hari` int(1) NOT NULL,
  `sesi` int(1) NOT NULL,
  `pelatih_i` int(10) UNSIGNED DEFAULT NULL,
  `pelatih_ii` int(10) UNSIGNED DEFAULT NULL,
  `pelatih_iii` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(7) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `name`) VALUES
(3310010, 'PRAMBANAN'),
(3310020, 'GANTIWARNO'),
(3310030, 'WEDI'),
(3310040, 'BAYAT'),
(3310050, 'CAWAS'),
(3310060, 'TRUCUK'),
(3310070, 'KALIKOTES'),
(3310080, 'KEBONARUM'),
(3310090, 'JOGONALAN'),
(3310100, 'MANISRENGGO'),
(3310110, 'KARANGNONGKO'),
(3310120, 'NGAWEN'),
(3310130, 'CEPER'),
(3310140, 'PEDAN'),
(3310150, 'KARANGDOWO'),
(3310160, 'JUWIRING'),
(3310170, 'WONOSARI'),
(3310180, 'DELANGGU'),
(3310190, 'POLANHARJO'),
(3310200, 'KARANGANOM'),
(3310210, 'TULUNG'),
(3310220, 'JATINOM'),
(3310230, 'KEMALANG'),
(3310710, 'KLATEN SELATAN'),
(3310720, 'KLATEN TENGAH'),
(3310730, 'KLATEN UTARA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi_latihan`
--

CREATE TABLE `lokasi_latihan` (
  `id` int(10) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `kecamatan_id` int(7) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `penanggung_jawab` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id` int(10) NOT NULL,
  `jadwal_id` int(10) NOT NULL,
  `status` enum('biasa','batal') NOT NULL,
  `pelatih` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `status` enum('santri','pelatih','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'santri',
  `no_hp` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan_id` int(7) NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `grup_id` int(10) DEFAULT NULL,
  `is_approved` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `status`, `no_hp`, `kecamatan_id`, `alamat`, `grup_id`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@pagarnusa.com', '$2y$10$AWpRME0MsVHp2SMJOuVaceP25oy05drslvfhw2d4lH1TaQqww6S5G', '6R63Q6AN1QPiI5Ss6c6WSA5B1OWBF19JjKgSuNpGVDR3v9TCBdTUtoR49gjl', 'admin', '13123', 3310140, NULL, NULL, 1, '2017-08-02 05:32:06', '2017-08-02 05:32:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grup_latihan`
--
ALTER TABLE `grup_latihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ketua_grup_id` (`ketua_grup_id`),
  ADD KEY `lokasi_latihan_id` (`lokasi_latihan_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grup_id` (`grup_id`),
  ADD KEY `pelatih_i` (`pelatih_i`),
  ADD KEY `pelatih_ii` (`pelatih_ii`),
  ADD KEY `pelatih_iii` (`pelatih_iii`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `lokasi_latihan`
--
ALTER TABLE `lokasi_latihan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`),
  ADD KEY `penanggung_jawab` (`penanggung_jawab`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelatih` (`pelatih`),
  ADD KEY `jadwal_id` (`jadwal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`),
  ADD KEY `id` (`id`),
  ADD KEY `grup_id` (`grup_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grup_latihan`
--
ALTER TABLE `grup_latihan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lokasi_latihan`
--
ALTER TABLE `lokasi_latihan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `grup_latihan`
--
ALTER TABLE `grup_latihan`
  ADD CONSTRAINT `grup_latihan_ibfk_1` FOREIGN KEY (`lokasi_latihan_id`) REFERENCES `lokasi_latihan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grup_latihan_ibfk_2` FOREIGN KEY (`ketua_grup_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`grup_id`) REFERENCES `grup_latihan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`pelatih_i`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`pelatih_ii`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `jadwal_ibfk_4` FOREIGN KEY (`pelatih_iii`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ketidakleluasaan untuk tabel `lokasi_latihan`
--
ALTER TABLE `lokasi_latihan`
  ADD CONSTRAINT `lokasi_latihan_ibfk_3` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lokasi_latihan_ibfk_4` FOREIGN KEY (`penanggung_jawab`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `pesan_ibfk_1` FOREIGN KEY (`pelatih`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesan_ibfk_2` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`grup_id`) REFERENCES `grup_latihan` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
