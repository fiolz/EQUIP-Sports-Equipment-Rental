-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2026 at 03:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_peminjaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id_alat` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga_per_hari` int(11) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `min_pinjam` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id_alat`, `id_kategori`, `nama_alat`, `deskripsi`, `gambar`, `stok`, `harga_per_hari`, `lokasi`, `min_pinjam`) VALUES
(5, 13, 'Bola Basket size 7', 'Bola basket berkualitas, mudah dimainkan.', 'bola-basket.jpg', 17, 5000, 'Klaten', 1),
(6, 13, 'Raket Badminton 83 Gram', 'Dengan teknologi penyeimbang berat, Yonex Astrox 77 PLAY adalah raket bulutangkis serbaguna yang menggabungkan kemampuan menyerang dan mengendalikan.', 'raket-badminton.jpg', 9, 8000, NULL, 2),
(8, 9, 'Adjustable Dumbbell', 'Satu set dumbbell pintar yang menggantikan 15 pasang dumbbell konvensional. Menggunakan sistem dial putar untuk memilih beban mulai dari 2kg hingga 24kg secara instan.', '1770538350_adjustable-dumbell.jpg', 9, 15000, NULL, 5),
(9, 9, 'Olympic Barbell (20kg) & Bumper Plates', 'Besi standar olimpiade dengan panjang 2,2 meter. Dilengkapi dengan Bumper Plates (piringan beban karet) yang aman dijatuhkan ke lantai. Cocok untuk latihan Deadlift, Squat, dan Bench Press.', '1770538721_barbell.jpg', 5, 15000, NULL, 7),
(10, 9, 'Adjustable Weight Bench', 'Kursi latihan dengan 7 posisi sandaran (Incline, Flat, Decline). Dibuat dengan busa tebal dan kulit sintetis anti-keringat agar stabil saat mengangkat beban berat.', '1770538498_weight-bench.jpg', 5, 20000, NULL, 7),
(11, 9, 'Kettlebell Cast Iron (Set 4kg - 16kg)', 'Alat beban berbentuk bola dengan pegangan. Sangat efektif untuk latihan swing yang menggabungkan kekuatan otot inti (core) dan kardio.', '1770539001_kettlebell.jpg', 5, 20000, NULL, 7),
(12, 9, 'Power Rack / Squat Stand (Portable)', 'Rak besi penyangga barbell yang bisa diatur ketinggiannya. Memberikan keamanan ekstra saat melakukan squat atau press sendirian di rumah.', '1770539049_power-rack.jpg', 5, 18500, NULL, 7),
(13, 10, 'Walking Pad / Folding Treadmill', 'Treadmill ramping tanpa stang yang bisa dilipat 180 derajat. Bisa disimpan di bawah sofa. Memiliki kecepatan hingga 6 km/jam, cocok buat jalan cepat sambil kerja (working while walking).', '1770539063_walking-pad.jpg', 0, 17000, NULL, 5),
(14, 10, 'Magnetic Spinning Bike', 'Sepeda statis dengan sistem hambatan magnetik sehingga suara sangat senyap. Dilengkapi layar LCD untuk memantau kecepatan, jarak, dan kalori yang terbakar.', '1770539081_spinning-bike.jpg', 5, 17000, NULL, 5),
(15, 10, 'Concept2 Rowing Machine', 'Rowing machine standar atlet profesional. Melatih 85% otot tubuh dalam satu gerakan. Menggunakan hambatan udara yang menyesuaikan dengan kekuatan tarikan pengguna.', '1770539099_rowing-machine.jpg', 4, 20000, NULL, 7),
(16, 10, 'Air Bike (Assault Bike)', 'Sepeda yang menggunakan kipas besar sebagai hambatan. Semakin cepat lo gowes, semakin berat hambatannya. Gabungan antara latihan kaki dan tangan secara bersamaan.', '1770539160_airbike.jpg', 5, 16000, NULL, 7),
(17, 10, 'Battle Rope (9 Meter)', 'Tali tambang nilon tebal untuk latihan kekuatan bahu dan stamina. Memberikan efek bakar kalori yang sangat tinggi dalam waktu singkat (HIIT).', '1770539189_Battlerope.jpg', 9, 10000, NULL, 5),
(18, 11, 'Meja Billiard Portable (6 Feet)', 'Meja billiard ukuran medium yang kaki-kakinya bisa dilipat. Menggunakan bahan high-quality velvet dan kayu MDF solid. Paket sewa sudah termasuk 2 stick, 1 set bola pro, dan kapur.', 'mejabilliard.jpg', 2, 18000, NULL, 7),
(19, 11, 'Professional Table Tennis Set (Foldable)', 'Meja pingpong standar internasional (ITTF) yang bisa dilipat dan memiliki roda untuk mobilitas. Termasuk 4 bet, net, dan 10 bola.', 'table-tennis.jpg', 4, 15000, NULL, 7),
(20, 13, 'Set Stick Golf Full Set (Beginner Friendly)', 'Paket lengkap stick golf (Driver, Iron set, Putter, Bag). Cocok untuk pemula yang baru ingin mencoba turun ke lapangan tanpa harus beli alat jutaan rupiah.', 'golf-fullset.jpg', 10, 25000, NULL, 2),
(21, 13, 'Full Set Raket Tenis (Wilson/Babolat)', 'Sepasang raket tenis kualitas turnamen (graphite) beserta 1 kaleng bola tenis (isi 3). Ringan, kuat, dan minim getaran di tangan.', 'raket-tenis.jpg', 8, 17000, NULL, 1),
(22, 12, 'Theragun / Massage Gun Pro', 'Alat terapi perkusi elektrik untuk memijat jaringan otot dalam. Membantu meredakan nyeri otot (DOMS) dan melancarkan sirkulasi darah dengan cepat.', 'theragun.jpg', 8, 8000, NULL, 3),
(23, 12, 'Yoga & Pilates Set (Premium)', 'Paket berisi Matras TPE anti-slip 8mm, 2 buah Yoga Block, dan Resistance Band. Fokus pada kenyamanan sendi saat melakukan pose sulit.', 'yoga-set.jpg', 10, 15000, NULL, 1),
(24, 12, 'Foam Roller Grid 2-in-1', 'Alat silinder dengan tekstur bergerigi untuk self-massage. Sangat berguna untuk melemaskan otot punggung dan paha yang kaku.', 'foam-roller.jpg', 10, 5000, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(9, 'Strength Training'),
(10, 'Cardio'),
(11, 'Club Sport'),
(12, 'Yoga & Pilates'),
(13, 'Court & Field Sports');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_alat` int(11) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak','kembali') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_alat`, `tgl_pinjam`, `tgl_kembali`, `jumlah`, `total_harga`, `status`) VALUES
(5, 3, 6, '2026-02-05', '2026-02-10', 2, 80000, 'kembali'),
(6, 3, 5, '2026-02-07', '2026-02-13', 3, 90000, 'ditolak'),
(7, 3, 6, '2026-02-07', '2026-02-08', 1, 8000, 'ditolak'),
(9, 3, 17, '2026-02-09', '2026-02-14', 1, 50000, 'disetujui'),
(10, 3, 8, '2026-02-09', '2026-02-14', 1, 75000, 'disetujui'),
(11, 9, 6, '2026-02-17', '2026-02-23', 1, 48000, 'disetujui'),
(12, 10, 13, '2026-02-10', '2026-02-28', 7, 2142000, 'disetujui');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjaman` int(11) DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `kondisi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` enum('admin','petugas','peminjam') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `level`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Admin EQUIP.', 'admin'),
(2, 'petugas', '570c396b3fc856eceb8aa7357f32af1a', 'Staff EQUIP.', 'petugas'),
(3, 'peminjam', 'a0a2f49fce72297e6a424581b46cb8ba', 'Ola', 'peminjam'),
(9, 'Muiii', '42369686dc4fd3ebf7ebf6617671b292', 'king sekte bulan', 'peminjam'),
(10, 'aullzs', '20f822e3d53981ee38f4327d8342b093', 'Di bawah langit', 'peminjam'),
(13, 'pakpunky', '42f1ca2ce0c87222255717e6f6f90593', 'Punky Indra ', 'peminjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id_alat`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_alat` (`id_alat`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_peminjaman` (`id_peminjaman`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alat`
--
ALTER TABLE `alat`
  ADD CONSTRAINT `alat_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
