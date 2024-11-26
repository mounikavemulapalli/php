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



CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `department` (`id`, `department_name`) VALUES
(7, 'Computer Programming'),
(9, 'Construction Engineering Technology');



CREATE TABLE `Consultant Details` (
  `id` int(11) NOT NULL,
  `Title_id` int(11) NOT NULL,
  `Consultant_id` int(11) NOT NULL,
  `Department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `Consultant Details` (`id`, `Title_id`, `Consultant_id`, `Department_id`) VALUES
(26, 2, 43, 7),
(29, 1, 48, 9),
(30, 1, 52, 7);


CREATE TABLE `Periods` (
  `id` int(11) NOT NULL,
  `period_year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `Periods` (`id`, `period_year`) VALUES
(1, 2022);



CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `First Name` varchar(255) NOT NULL,
  `Last Name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sifreHash` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `users` (`id`, `First Name`, `Last Name`, `email`, `sifreHash`, `rol_id`) VALUES
(1, 'Mounika', 'Vemulapalli', 'mounikavemulapalli289@gmail.com', '304e19039eda30537eb597547b43f2d3', 1),
(43, 'Yelda', 'Fırat', 'yelda@comu.ogr.edu.tr', '4e6fec3630db86b46933bfef7b8f8d48', 2),
(44, 'Personel', 'Test', 'personel@comu.edu.tr', '24d5cf4a7c1c01020a4131757f1406f7', 3),
(45, 'Aytuğ', 'Tuncer', '200929029@ogr.comu.edu.tr', '475669a24cedc37ff25aedf47397aa7c', 4),
(48, 'Murat', 'Dalkırıç', 'murat@comu.ogr.edu.tr', '7b6bb36f3b0e576af4fff416d7d7a2fa', 2),
(49, 'Berke', 'Altuntaş', '200624029@ogr.comu.edu.tr', '6cc2d13dba8f8b5678bb299f55e69140', 4),
(52, 'test', 'danisman', 'testdanisman@comu.edu.tr', '5675cbeda1e9fb22910ed7ac90fb1dac', 2);


CREATE TABLE `student_details` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `consultant_id_fk` int(11) NOT NULL,
  `department_id_fk` int(11) NOT NULL,
  `student_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `student_details` (`id`, `student_id`, `consultant_id_fk`, `department_id_fk`, `student_no`) VALUES
(9, 45, 43, 7, 200929029),
(10, 49, 48, 9, 200624029);



CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'manager'),
(2, 'consultant'),
(3, 'employee'),
(4, 'student');


CREATE TABLE `social_security` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `social_security` (`id`, `name`) VALUES
(1, 'Receives healthcare services from Bagkur'),
(2, 'Receives healthcare services from SGK\n'),
(3, 'Receives healthcare services from the Pension Fund'),
(4, 'Does not have any insurance');



CREATE TABLE `internship_registration` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `tc` bigint(20) NOT NULL,
  `tel` bigint(20) NOT NULL,
  `internship_date_id` int(11) NOT NULL,
  `insurance` int(11) NOT NULL,
  `address` text NOT NULL,
  `manager_approval` tinyint(1) NOT NULL DEFAULT 0,
  `advisor_approval` tinyint(1) NOT NULL DEFAULT 0,
  `company_name` varchar(255) NOT NULL,
  `company_address` text NOT NULL,
  `service_receiver` varchar(255) NOT NULL,
  `company_number` varchar(255) NOT NULL,
  `company_fax_number` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_website` text NOT NULL,
  `insurance_entry_approval` tinyint(1) NOT NULL DEFAULT 0,
  `insurance_exit_approval` tinyint(1) NOT NULL DEFAULT 0,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `internship_registration` 
(`id`, `student_id`, `tc`, `tel`, `internship_date_id`, `insurance`, `address`, `manager_approval`, `advisor_approval`, `company_name`, `company_address`, `service_receiver`, `company_number`, `company_fax_number`, `company_email`, `company_website`, `insurance_entry_approval`, `insurance_exit_approval`, `creation_date`) 
VALUES
(7, 45, 33302383892, 5445678503, 12, 1, 'Çanakkale/Gelibolu', 1, 1, 'Çanakkale Municipality', 'İsmet Paşa Neighborhood, Demircioğlu Street, No:132, 17100 Çanakkale', 'Information Technology', '444 17 17', '0 286 212 39 91', 'canakkale.belediyesi@bel.com', 'https://www.canakkale.bel.tr/', 1, 0, '2022-05-01 15:22:47'),
(8, 49, 11111111111, 5111111111, 6, 1, 'Çanakkale/Çan', 0, 1, '300dpi', 'Çanakkale/Barbaros', 'Software', '5445689603', '2125668501', '300dpi@gmail.com', '300dpi.com', 0, 0, '2022-05-01 15:29:50');

CREATE TABLE `internship_date` (
  `id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `weekly_day_count` int(11) NOT NULL,
  `internship_start` date NOT NULL,
  `internship_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `internship_date` (`id`, `term_id`, `weekly_day_count`, `internship_start`, `internship_end`) VALUES
(6, 1, 5, '2022-05-18', '2022-05-30'),
(12, 1, 5, '2022-05-18', '2022-05-30'),
(14, 1, 6, '2022-04-22', '2022-04-02'),
(15, 1, 6, '2022-06-01', '2022-08-20');




CREATE TABLE `titles` (
  `id` int(11) NOT NULL,
  `title_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `titles` (`id`, `title_name`) VALUES
(1, 'Prof. Dr.'),
(2, 'Assoc. Prof. Dr.'),
(3, 'Dr. Lecturer');


ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `Consultant Details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Consultant Details_ibfk_1` (`department_id`),
  ADD KEY `Consultant Details_ibfk_2` (`consultant_id`),
  ADD KEY `Consultant Details_ibfk_3` (`title_id`);


ALTER TABLE `Periods`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rol_id` (`rol_id`);


ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_details_ibfk_1` (`student_id`);


ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `social_security`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `internship_registration`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `internship_date`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `Consultant Details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

ALTER TABLE `periods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

ALTER TABLE `student_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;


ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `social_security`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `internship_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `internship_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;


ALTER TABLE `titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `Consultant Details`
  ADD CONSTRAINT `Consultant Details_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Consultant Details_ibfk_2` FOREIGN KEY (`consultant_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Consultant Details_ibfk_3` FOREIGN KEY (`title_id`) REFERENCES `titles` (`id`) ON DELETE CASCADE;


ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`);


ALTER TABLE `student_details`
  ADD CONSTRAINT `student_details_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

COMMIT;

