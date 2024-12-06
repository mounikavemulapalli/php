-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2022 at 11:38 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comu_staj`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `bolum_ad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `bolum_ad`) VALUES
(7, 'Computer Programming'),
(9, 'Construction Technician');

-- --------------------------------------------------------

--
-- Table structure for table `advisor_details`
--

CREATE TABLE `advisor_details` (
  `id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL,
  `danisman_id` int(11) NOT NULL,
  `bolum_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advisor_details`
--

INSERT INTO `advisor_details` (`id`, `title_id`, `danisman_id`, `bolum_id`) VALUES
(26, 2, 43, 7),
(29, 1, 48, 9),
(30, 1, 52, 7);

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `donem_yil` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `donem_yil`) VALUES
(1, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `soyad` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sifreHash` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ad`, `soyad`, `email`, `sifreHash`, `rol_id`) VALUES
(1, 'Ümit', 'Demir', 'müdür@comu.edu.tr', '304e19039eda30537eb597547b43f2d3', 1),
(43, 'Yelda', 'Fırat', 'yelda@comu.ogr.edu.tr', '4e6fec3630db86b46933bfef7b8f8d48', 2),
(44, 'Personel', 'Test', 'personel@comu.edu.tr', '24d5cf4a7c1c01020a4131757f1406f7', 3),
(45, 'Aytuğ', 'Tuncer', '200929029@ogr.comu.edu.tr', '475669a24cedc37ff25aedf47397aa7c', 4),
(48, 'Murat', 'Dalkırıç', 'murat@comu.ogr.edu.tr', '7b6bb36f3b0e576af4fff416d7d7a2fa', 2),
(49, 'Berke', 'Altuntaş', '200624029@ogr.comu.edu.tr', '6cc2d13dba8f8b5678bb299f55e69140', 4),
(52, 'test', 'danisman', 'testdanisman@comu.edu.tr', '5675cbeda1e9fb22910ed7ac90fb1dac', 2);

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `id` int(11) NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `danisman_id_fk` int(11) NOT NULL,
  `bolum_id_fk` int(11) NOT NULL,
  `ogrenci_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`id`, `ogrenci_id`, `danisman_id_fk`, `bolum_id_fk`, `ogrenci_no`) VALUES
(9, 45, 43, 7, 200929029),
(10, 49, 48, 9, 200624029);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_ad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_ad`) VALUES
(1, 'manager'),
(2, 'danışman'),
(3, 'personel'),
(4, 'öğrenci');

-- --------------------------------------------------------

--
-- Table structure for table `social_security`
--

CREATE TABLE `social_security` (
  `id` int(11) NOT NULL,
  `ad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_security`
--

INSERT INTO `social_security` (`id`, `ad`) VALUES
(1, 'BAĞKUR’dan sağlık hizmeti alıyor'),
(2, 'SGK’dan sağlık hizmeti alıyor\r\n'),
(3, 'EMEKLİ SANDIĞI’ndan sağlık hizmeti alıyor'),
(4, 'Herhangi bir sigortam bulunmamakta');

-- --------------------------------------------------------

--
-- Table structure for table `internship_registration`
--

CREATE TABLE `internship_registration` (
  `id` int(11) NOT NULL,
  `ogrenci_id` int(11) NOT NULL,
  `tc` bigint(20) NOT NULL,
  `tel` bigint(20) NOT NULL,
  `Internship_date_id` int(11) NOT NULL,
  `sigorta` int(11) NOT NULL,
  `adres` text NOT NULL,
  `mudur_onay` tinyint(1) NOT NULL DEFAULT 0,
  `danisman_onay` tinyint(1) NOT NULL DEFAULT 0,
  `k_ad` varchar(255) NOT NULL,
  `k_adres` text NOT NULL,
  `k_hizmet_alan` varchar(255) NOT NULL,
  `k_no` varchar(255) NOT NULL,
  `k_faks_no` varchar(255) NOT NULL,
  `k_eposta` varchar(255) NOT NULL,
  `k_webadres` text NOT NULL,
  `sigorta_giris_onay` tinyint(1) NOT NULL DEFAULT 0,
  `sigorta_cikis_onay` tinyint(1) NOT NULL DEFAULT 0,
  `create_tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `internship_registration`
--

INSERT INTO `internship_registration` (`id`, `ogrenci_id`, `tc`, `tel`, `Internship_date_id`, `sigorta`, `adres`, `mudur_onay`, `danisman_onay`, `k_ad`, `k_adres`, `k_hizmet_alan`, `k_no`, `k_faks_no`, `k_eposta`, `k_webadres`, `sigorta_giris_onay`, `sigorta_cikis_onay`, `create_tarih`) VALUES
(7, 45, 33302383892, 5445678503, 12, 1, 'Çanakkale/Gelibolu', 1, 1, 'Çanakkale Belediyesi', 'İsmet Paşa Mahallesi Demircioğlu Caddesi No:132 17100 Çanakkale', 'Bilgi İşlem', '444 17 17', '0 286 212 39 91', 'canakkale.belediyesi@bel.com', 'https://www.canakkale.bel.tr/', 1, 0, '2022-05-01 15:22:47'),
(8, 49, 11111111111, 5111111111, 6, 1, 'Çanakkale/Çan', 0, 1, '300dpi', 'Çanakkale/Barbaros ', 'Yazılım', '5445689603', '2125668501', '300dpi@gmail.com', '300dpi.com', 0, 0, '2022-05-01 15:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `Internship_date`
--

CREATE TABLE `Internship_date` (
  `id` int(11) NOT NULL,
  `donem_id` int(11) NOT NULL,
  `haftalik_gun_sayi` int(11) NOT NULL,
  `staj_baslangic` date NOT NULL,
  `staj_bitis` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Internship_date`
--

INSERT INTO `Internship_date` (`id`, `donem_id`, `haftalik_gun_sayi`, `staj_baslangic`, `staj_bitis`) VALUES
(6, 1, 5, '2022-05-18', '2022-05-30'),
(12, 1, 5, '2022-05-18', '2022-05-30'),
(14, 1, 6, '2022-04-22', '2022-04-02'),
(15, 1, 6, '2022-06-01', '2022-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `id` int(11) NOT NULL,
  `unvan_ad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`id`, `unvan_ad`) VALUES
(1, 'Prof. Dr.'),
(2, 'Doç. Dr.'),
(3, 'Dr. Öğr.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advisor_details`
--
ALTER TABLE `advisor_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advisor_details_ibfk_1` (`bolum_id`),
  ADD KEY `advisor_details_ibfk_2` (`danisman_id`),
  ADD KEY `advisor_details_ibfk_3` (`title_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_details_ibfk_1` (`ogrenci_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_security`
--
ALTER TABLE `social_security`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `internship_registration`
--
ALTER TABLE `internship_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Internship_date`
--
ALTER TABLE `Internship_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `advisor_details`
--
ALTER TABLE `advisor_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `social_security`
--
ALTER TABLE `social_security`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `internship_registration`
--
ALTER TABLE `internship_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Internship_date`
--
ALTER TABLE `Internship_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advisor_details`
--
ALTER TABLE `advisor_details`
  ADD CONSTRAINT `advisor_details_ibfk_1` FOREIGN KEY (`bolum_id`) REFERENCES `department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `advisor_details_ibfk_2` FOREIGN KEY (`danisman_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `advisor_details_ibfk_3` FOREIGN KEY (`title_id`) REFERENCES `titles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `student_details`
--
ALTER TABLE `student_details`
  ADD CONSTRAINT `student_details_ibfk_1` FOREIGN KEY (`ogrenci_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
