-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20230121.0cf02972ff
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Bulan Mei 2023 pada 05.30
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_hiskia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username_admin` varchar(30) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `password_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username_admin`, `nama_admin`, `password_admin`) VALUES
('admin_hiskia', 'Hiskia', '$2y$10$fLHl25jCv2l9NBHK22HY0egG9HahNM49c2gOC5SZxWMuAyNDhziZa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `kode_kategori` varchar(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `kode_kategori`, `harga`, `stok`) VALUES
('B-01', 'Aqua', 'K-01', 5000, 30),
('B-02', 'Le Mineral', 'K-01', 4000, 30),
('B-03', 'Vit', 'K-01', 3000, 50),
('B-04', 'Nestle', 'K-01', 5000, 20),
('B-05', 'Ades', 'K-01', 5000, 25),
('B-06', 'Beras Setra Ramos 25 kg', 'K-02', 261900, 10),
('B-07', 'Beras Raja Tawon 25 kg', 'K-02', 280000, 15),
('B-08', 'Beras Rojolele 5 kg', 'K-02', 60000, 20),
('B-09', 'Beras BMW 5 kg', 'K-02', 70000, 15),
('B-10', 'Beras Petruk 5 kg', 'K-02', 65000, 20),
('B-11', 'Indomie Goreng', 'K-03', 3000, 100),
('B-12', 'Indomie Goreng Rendang', 'K-03', 3000, 50),
('B-13', 'Indomie Ayam Bawang', 'K-03', 3000, 50),
('B-14', 'Indomie Soto', 'K-03', 3000, 30),
('B-15', 'Sedap Kari Special', 'K-03', 3500, 40),
('B-16', 'Harga Minyak Goreng Filma 1 Liter', 'K-04', 22800, 30),
('B-17', 'Harga Minyak Goreng Sania 1 Liter', 'K-04', 23700, 25),
('B-18', 'Harga Minyak Goreng Tropical 1 Liter', 'K-04', 23000, 30),
('B-19', 'Harga Minyak Goreng Fortune 1 Liter', 'K-04', 16000, 40),
('B-20', 'Harga Minyak Goreng Rose Brand 1 Liter', 'K-04', 16500, 30),
('B-21', 'Gudang Garam Filter Isi 12', 'K-05', 24500, 30),
('B-22', 'Sampoerna Mild Isi 16', 'K-05', 32000, 50),
('B-23', 'Djarum Super Isi 12', 'K-05', 24500, 30),
('B-24', 'Malrboro Merah Isi 20', 'K-05', 35000, 30),
('B-25', 'Surya Pro Mild Isi 16', 'K-05', 25000, 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangkeluar`
--

CREATE TABLE `barangkeluar` (
  `id_bk` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `kode_barang` varchar(11) NOT NULL,
  `kode_kategori` varchar(11) NOT NULL,
  `jumlah_bk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `barangkeluar`
--
DELIMITER $$
CREATE TRIGGER `pengurangan_stok` AFTER INSERT ON `barangkeluar` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok-NEW.jumlah_bk
WHERE kode_barang=NEW.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `id_bm` int(11) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `kode_barang` varchar(11) NOT NULL,
  `kode_kategori` varchar(11) NOT NULL,
  `jumlah_bm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `barangmasuk`
--
DELIMITER $$
CREATE TRIGGER `tambah_stok` AFTER INSERT ON `barangmasuk` FOR EACH ROW BEGIN
UPDATE barang SET stok = stok+NEW.jumlah_bm
WHERE kode_barang=NEW.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` varchar(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`) VALUES
('K-01', 'Air Mineral'),
('K-02', 'Beras'),
('K-03', 'Mie Instan'),
('K-04', 'Minyak Goreng'),
('K-05', 'Rokok');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username_admin`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `fk_kode_kategori` (`kode_kategori`);

--
-- Indeks untuk tabel `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD PRIMARY KEY (`id_bk`),
  ADD KEY `fk_kode_barang2` (`kode_barang`),
  ADD KEY `fk_kode_kategori3` (`kode_kategori`);

--
-- Indeks untuk tabel `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`id_bm`),
  ADD KEY `fk_kode_barang` (`kode_barang`),
  ADD KEY `fk_kode_kategori2` (`kode_kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barangkeluar`
--
ALTER TABLE `barangkeluar`
  MODIFY `id_bk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `barangmasuk`
--
ALTER TABLE `barangmasuk`
  MODIFY `id_bm` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_kode_kategori` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori` (`kode_kategori`);

--
-- Ketidakleluasaan untuk tabel `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD CONSTRAINT `fk_kode_barang2` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`),
  ADD CONSTRAINT `fk_kode_kategori3` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori` (`kode_kategori`);

--
-- Ketidakleluasaan untuk tabel `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD CONSTRAINT `fk_kode_barang` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`),
  ADD CONSTRAINT `fk_kode_kategori2` FOREIGN KEY (`kode_kategori`) REFERENCES `kategori` (`kode_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
