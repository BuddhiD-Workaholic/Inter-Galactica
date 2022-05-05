/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heroku_764a5db4e5102c2`
-- Author: Buddhi Dhananjaya
--

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE IF NOT EXISTS `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text,
  `name` text,
  `password` varchar(128) DEFAULT NULL,
  `contact` varchar(12) DEFAULT NULL,
  `Xp` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `img` text,
  `isActive` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `player`
--

--
-- Inserting data to table `player`
--

INSERT INTO `player` (`id`, `email`, `name`, `password`, `contact`, `Xp`, `level`, `img`, `isActive`) VALUES
(4, 'buddhi2002625@gmail.com', 'P.D Buddhi Dananjaya', '$2y$10$f/t6Tl6csC6xrsBWU.f.Au82MWCLyly8KgsuH7FpW89ytkumINpXG', 'buddhi200262', 8864, 2, 'https://www.gravatar.com/avatar/6d0e4ac818989991b7da598a21f93e35', b'1'),
(134, 'dhananjaya2002625@gmail.com', 'P.D Buddhi Dananjaya', '$2y$10$V3U17HPx30H1X5opQcm5keZND06J0Ztru.gbEFPfANYUWlE9jba3i', '+94724256545', 1, 1, 'https://www.gravatar.com/avatar/1179e6126f044a976cebcaf950a16603', b'1'),
(144, 'fojas92322@xindax.com', 'P.D Buddhi Dananjaya', '$2y$10$LzIDckmDQasyOYMUpVHa1.RO6/eDIDMM0ZIcNcjVWRSkaTJJ3nmKa', '+94724256545', 1, 1, 'https://www.gravatar.com/avatar/94649f6ccd8099bcabfd5dda52b98fd6', b'1'),
(154, 'gafocog573@arpizol.com', 'P.D Dananjaya', '$2y$10$eizjEYJSO.fDtai2cAp2/u0tZhErqjz0RKMQSpcqr6ZpRFoD1I8KG', '+94704323860', 2011, 2, 'https://www.gravatar.com/avatar/6c392d6b76793c2b1a465f55b057cd3d', b'1'),
(164, 'yashabhi99@gmail.com', 'Yasas', '$2y$10$ixHtRqqy2BdIgrxnsiDoOOyDO5TVw6KN62Ou0uMcgaBD2zBb34W5q', '0711121159', 123, 1, 'https://www.gravatar.com/avatar/835176a6657082d0726f168bf1d58c63', b'1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
