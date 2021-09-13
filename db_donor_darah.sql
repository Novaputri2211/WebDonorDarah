-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2021 at 06:34 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_donor_darah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `token`) VALUES
(4, 'novaputri', '$2y$10$6WIJXNq/q92BotfczPp/BuCDysweZrj3h64qcOdFqcJEFui5qq5Q.', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xOTIuMTY4LjEwMC4xNzZcL2RiX2Rvbm9yX2RhcmFoIiwiYXVkIjoiaHR0cDpcL1wvMTkyLjE2OC4xMDAuMTc2XC9kYl9kb25vcl9kYXJhaCIsImlhdCI6MTYyOTI3NDc5NCwiZXhwIjoxNjI5Mjc4Mzk0LCJkYXRhIjp7InVzZXJfaWQiOiI0In19.cr5_-q5qUMkftewgTrvVPYqcVYWIFwMShpsaVIMxjq0'),
(5, 'novaputrio', '$2y$10$3xhghl5CqG6ZGsI8za6Se.KR7omN9BUS1wTw3Kk6oXr42sxLvzncK', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xOTIuMTY4LjEwMC4xNjBcL2RiX2Rvbm9yX2RhcmFoIiwiYXVkIjoiaHR0cDpcL1wvMTkyLjE2OC4xMDAuMTYwXC9kYl9kb25vcl9kYXJhaCIsImlhdCI6MTYyOTM3NjQ4MiwiZXhwIjoxNjI5MzgwMDgyLCJkYXRhIjp7InVzZXJfaWQiOiI1In19.q1r4fFwuHjqEzZxVCuXqaQx_nkZE7IUprmfX-g3gTaI');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pendonor`
--

CREATE TABLE `tb_pendonor` (
  `id_pendonor` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pendonor` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `umur` int(11) NOT NULL,
  `jekel` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `gol_darah` varchar(5) NOT NULL,
  `bb` double NOT NULL,
  `tensi` varchar(25) NOT NULL,
  `kadar_hb` varchar(25) NOT NULL,
  `tanggal_donor` date NOT NULL,
  `jlh_kantong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pendonor`
--

INSERT INTO `tb_pendonor` (`id_pendonor`, `id_user`, `nama_pendonor`, `tempat_lahir`, `tgl_lahir`, `umur`, `jekel`, `alamat`, `lat`, `lng`, `no_hp`, `gol_darah`, `bb`, `tensi`, `kadar_hb`, `tanggal_donor`, `jlh_kantong`) VALUES
(1, 0, 'x', 'x', '0000-00-00', 0, 'x', 'x', 'x', 'x', 'x', 'x', 0, 'xx', 'x', '0000-00-00', 0),
(2, 0, 'Putri', 'Bandung', '2000-04-15', 27, 'P', 'Medan', '7899', '678', '08205363', 'A', 55, '135/60', '45', '2021-08-26', 0),
(5, 0, 'nope', 'jekardah', '2021-09-09', 20, 'Perem', 'Jl. Dr. Moh. Hatta No.8b, RT.01/RW.02, Kapala Koto, Kec. Pauh, Kota Padang, Sumatera Barat 25163, Indonesia', '-0.9258311', '100.435053', '082370456579', 'O', 43, '130/20', '35%', '2021-09-20', 0),
(7, 3, 'Fadil', 'Solok', '2021-09-10', 23, 'Laki-Laki', 'Jl. Dr. Moh. Hatta No.8b, RT.01/RW.02, Kapala Koto, Kec. Pauh, Kota Padang, Sumatera Barat 25163, Indonesia', '-0.9258317', '100.4350422', '08237063258', 'A', 45, '125/75', '45%', '2021-09-24', 3),
(9, 5, 'Nova Putri Octaviani', 'Jakarta', '2000-10-11', 21, 'Perempuan', 'Jl. Dr. Moh. Hatta No.8b, RT.01/RW.02, Kapala Koto, Kec. Pauh, Kota Padang, Sumatera Barat 25163, Indonesia', '-0.9258474', '100.4350266', '082370456579', 'AB', 43, '143/70', '35%', '2021-09-17', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_stock_darah`
--

CREATE TABLE `tb_stock_darah` (
  `id_stock_darah` int(11) NOT NULL,
  `gol_darah` varchar(5) NOT NULL,
  `jlh_kantong_darah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_stock_darah`
--

INSERT INTO `tb_stock_darah` (`id_stock_darah`, `gol_darah`, `jlh_kantong_darah`) VALUES
(1, 'A', 3),
(2, 'B', 0),
(3, 'AB', 5),
(4, 'O', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `email`, `jenis_kelamin`, `username`, `password`, `token`) VALUES
(3, 'fadil', 'fadil@gmail.com', 'Laki-Laki', 'fadil', '$2y$10$hcjaNqpxN/QU23bVbFJngelh1QQFp7kWsWznWMplYV/vkIBm426U6', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xNzIuMjUuNDEuMjJcL2RiX2Rvbm9yX2RhcmFoIiwiYXVkIjoiaHR0cDpcL1wvMTcyLjI1LjQxLjIyXC9kYl9kb25vcl9kYXJhaCIsImlhdCI6MTYzMTIwMjczNiwiZXhwIjoxNjMxMjA2MzM2LCJkYXRhIjp7InVzZXJfaWQiOiIzIn19.atI41QAidfrHVC4wlDJ4VuRunmwRPfjF2ORy23NiDqQ'),
(5, 'Nova Putri O', 'novaputri422@gmail.com', 'Perempuan', 'novaaputrii', '$2y$10$5s3wPjWHYjRVcFU0kmw6O.Uf/Vjs5uxM0wNhpnU1J3AjXwA5SaO4W', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xNzIuMjUuNDEuMjJcL2RiX2Rvbm9yX2RhcmFoIiwiYXVkIjoiaHR0cDpcL1wvMTcyLjI1LjQxLjIyXC9kYl9kb25vcl9kYXJhaCIsImlhdCI6MTYzMTI4MDU3MiwiZXhwIjoxNjMxMjg0MTcyLCJkYXRhIjp7InVzZXJfaWQiOiI1In19.2el2-T0CaR930E1FUpfajG1lTMfu13vPiaUVJsVJjDc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_pendonor`
--
ALTER TABLE `tb_pendonor`
  ADD PRIMARY KEY (`id_pendonor`);

--
-- Indexes for table `tb_stock_darah`
--
ALTER TABLE `tb_stock_darah`
  ADD PRIMARY KEY (`id_stock_darah`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pendonor`
--
ALTER TABLE `tb_pendonor`
  MODIFY `id_pendonor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_stock_darah`
--
ALTER TABLE `tb_stock_darah`
  MODIFY `id_stock_darah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
