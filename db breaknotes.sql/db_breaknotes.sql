-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2020 at 02:23 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_breaknotes`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes_of_links`
--

CREATE TABLE `likes_of_links` (
  `id_like_l` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_link` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id_link` int(11) NOT NULL,
  `label_link` text NOT NULL,
  `ref_link` text NOT NULL,
  `comment` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `visibility_link` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nom_user` text NOT NULL,
  `prenom_user` text NOT NULL,
  `username` text NOT NULL,
  `email_user` text NOT NULL,
  `pwd_user` text NOT NULL,
  `company_user` text NOT NULL,
  `address_user` text NOT NULL,
  `city_user` text NOT NULL,
  `country_user` text NOT NULL,
  `zip_user` text NOT NULL,
  `about_user` text NOT NULL,
  `avatar_user` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes_of_links`
--
ALTER TABLE `likes_of_links`
  ADD PRIMARY KEY (`id_like_l`,`id_user`,`id_link`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id_link`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likes_of_links`
--
ALTER TABLE `likes_of_links`
  MODIFY `id_like_l` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id_link` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
