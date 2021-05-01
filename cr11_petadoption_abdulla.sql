-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 01, 2021 at 03:58 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_petadoption_abdulla`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `availability` int(11) DEFAULT NULL,
  `origin` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `size` char(5) DEFAULT NULL,
  `hobbies` varchar(255) DEFAULT NULL,
  `fk_supplierId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `picture`, `name`, `description`, `availability`, `origin`, `location`, `age`, `size`, `hobbies`, `fk_supplierId`) VALUES
(4, '608d5c77621e1.jpg', 'Bengal', 'Bengal cats are expensive because they are rarer than most domesticated cat breeds. ', 5, 'USA', 'koritastrasse 56/5', 6, 'large', 'Active  Agile  Lively  Affectionate', 3),
(5, '608d5bc8b8ac3.jpg', 'Sphynx', 'Sphynx cats are considered as one of the most expensive cat breeds in the world. ', 23, 'Canada', 'rokitanskigasse 12/14', 12, 'large', 'Loyal  Inquisitive  Friendly', 3),
(6, '608d5ad7aedcd.jpg', 'Devon Rex', 'Devon Rex kittens are no doubt precious and are also one of the most expensive kittens to buy because of them being less in number.', 23, 'United Kingdom', 'renlgasse 12/14', 7, 'small', 'Highly interactive  Mischievous  Loyal', 3),
(8, '608d5a0f5d626.jpg', 'Maine Coon', 'When buying a Maine Coon Kitten from a breeder, you can expect to be asked to pay anywhere between $1000 - $2000 for one in general.', 3, 'United States', 'ottakring 4/6', 6, 'small', 'Adaptable  Intelligent  Loving', 2),
(9, '608d595ce2daa.jpg', 'Persian cat', 'We have all heard the old adage &amp;amp;quot;you get what you pay for. Persian cats are purebred and are expensive', 5, 'Iran', 'hutterngasse 3/5', 9, 'small', 'Affectionate  loyal', 2),
(15, '608d58bfa5849.jpg', 'Ragdoll', 'Occasional grooming is advised to keep its coat in good shape. Though we see cats regularly lick their coats to clean themselves, some ', 3, 'USA', 'retekstrasse 43/54', 10, 'large', 'sdffasfaFriendly  Gentle  Quiet', 2),
(16, '608d5475155f4.jpg', 'karlos cat', 'Whether you’re shooting your cat with props or simply capturing them snuggled up in your arms, use depth of field to elevate the shot.', 10, 'usa', 'Keplerplatz 12/4', 9, 'large', 'Elevate Shots With Depth Of Field', 1),
(17, '608d53a7156c6.jpg', 'Spotted black boy', 'DescripitWhether it’s their spotted back, extra-long whiskers or perfectly-pink paws, use your cat’s quieter and relaxed moments to zoom on', 10, 'uk', 'absberggasse 22/2', 9, 'Small', 'HobbiesWhether it’s their spotted back, extra-long whiskers or perfectly-pink paws, use your cat’s quieter and relaxed moments to zoom ', 1),
(18, '608d52666e9ca.jpg', 'Warm-blooded feline', 'The domestic cat is a very intelligent, very independent animal. They only do what they feel like doing, when they feel like doing it.', 4, 'Asian', 'reumanplazt 43/3', 7, 'large', 'however this is very painful for the cat as a cat’s claw is actually a movable digit attached to muscle—the same as a finger.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierId` int(11) NOT NULL,
  `sup_name` varchar(100) NOT NULL,
  `sup_email` varchar(50) DEFAULT NULL,
  `sup_website` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierId`, `sup_name`, `sup_email`, `sup_website`) VALUES
(1, 'monsterpetsupplies', 'office@pplies.co.uk', 'www.monsterpetsupplies.co.uk'),
(2, 'zooplus', 'info@zooplus.com', 'www.zooplus.com'),
(3, 'petcostore', 'make@petco.uk', 'www.petco.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`, `status`) VALUES
(2, 'abdulla', 'rakib', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1988-11-30', 'rakib@yahoo.com', '608d48165c36b.jpg', 'user'),
(3, 'abdulla', 'rakib', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1997-05-20', 'rak@gmail.com', '6086e4e03581d.jpg', 'user'),
(4, 'rakib', 'abudlla', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2021-04-08', 'abdulla@gmax.com', 'admavatar.png', 'adm'),
(5, 'humayra', 'akter', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2002-03-03', 'humu@gmail.com', '608d0d915805a.jpg', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_supplierId` (`fk_supplierId`),
  ADD KEY `hobbies` (`hobbies`),
  ADD KEY `size` (`size`),
  ADD KEY `picture` (`picture`),
  ADD KEY `name` (`name`),
  ADD KEY `availability` (`availability`),
  ADD KEY `origin` (`origin`),
  ADD KEY `location` (`location`),
  ADD KEY `age` (`age`),
  ADD KEY `description` (`description`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`fk_supplierId`) REFERENCES `supplier` (`supplierId`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
