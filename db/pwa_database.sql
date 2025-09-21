-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2025 at 10:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwa_database`
--
CREATE DATABASE IF NOT EXISTS `pwa_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `pwa_database`;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `publishDate` date NOT NULL,
  `title` varchar(150) NOT NULL,
  `summary` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `imagePath` varchar(128) NOT NULL,
  `category` int(11) NOT NULL,
  `archived` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `publishDate`, `title`, `summary`, `content`, `imagePath`, `category`, `archived`) VALUES
(3, '2025-05-21', 'Martin Baturina odlazi za 25 mil', 'Martin Baturina trenutačno je najtraženiji dinamovac.', 'Ono što se već dugo nagađa moglo bi postati i službeno. Fabrizio Romano tvrdi da je Martin Baturina blizu odlaska iz Dinama.\r\n\r\nBaturina je najskuplji igrač Dinama i najveće ime u izlogu za transfere, Romano tvrdi da su na Maksimir svoje ponude poslali engleski i talijanski klubovi, a potvrđena je ona Eintracht Frankfurta.', '63084822-martin-baturina.jpg', 3, b'0'),
(5, '2025-05-21', 'Bild: Hajduku stigla odbijenica ', 'Njegova prva veća prilika došla je u Red Bull Salzburgu.', 'Nakon utakmice u Šibeniku Hajduk i službeno nema trenera. Gennaro Gattuso je odavno odlučio da više ne želi biti trener Hajduka.\r\n\r\nSplićani su tako već duže u potrazi za novim trenerom, a u javnosti se pojavilo ime Renea Marića, Hrvata iz Austrije koji je pomoćnik Vincentu Kompanyju u Bayernu.\r\nMarić u Bayernu radi jako dobar posao, znaju to i vlasnici bavarskog velikana pa prema pisanju Bild, Hajduk je odbijen. Traženi Hrvat na želi napustiti Bavarsku i život nastaviti u Splitu.\r\n\r\n\'\'René Marić vjerojatno neće napustiti Bayern unatoč navodnom interesu Hajduka. Marić se osjeća kao kod kuće u svom omiljenom klubu i smatra se važnom sponom između analize, strategije i svlačionice\'\', tvrdi Bild.\r\n\r\n', '63084863-bayern-i-hajduk.jpg', 3, b'0'),
(6, '2025-05-21', 'Možete li vjerovati da je ova žena bila muškarac!!', 'Pedro Pascal i njegova sestra Lux zasjenili su sve prisutne na crvenom tepihu u Cannesu.', 'Crvenim tepihom Filmskog festivala u Cannesu ovih dana prošetao je i trenutno megapopularni glumac Pedro Pascal. \r\nIpak, njegovu prisutnost zasjenila je njegova sestra Lux. U elegantnoj haljini ova dama pozirala je kao najuspješniji model, a šokirat ćete se kad pročitate da je nekad bila muškarac. \r\n', '63084809-lux-pascal.jpg', 2, b'0'),
(7, '2025-05-21', 'Adi Šoše prvi put progovorio o ljubavi s prelijepom Beograđankom', 'Nakon što je najavio i šesti koncert u Lisinskom, Adi Šoše se prema broju nastupa u istoj sezoni svrstao uz Olivera Dragojevića ', 'S Adijem se u Omišu družio naš Gordan Vasilj. Miljenik publike mu je, među ostalim, rekao sve o planovima za koncert u zagrebačkoj Areni, duetu sa Senidom te kupnji stana. Prvi put za medije progovorio je i o svojoj ljubavi s lijepom Beograđankom.\r\nČast da uveliča feštu povodom Dana grada Omiša pripala je Adiju Šoši čija popularnost strelovitom brzinom raste u cijeloj regiji. Karizmatičnog Mostarca sljedeći ponedjeljak čeka četvrti od čak šest koncerata u Lisinskom. Prvi nastup u zagrebačkom hramu kulture, kaže, ima posebno mjesto u njegovu srcu.', '63084125-adi-sose.jpg', 2, b'0'),
(8, '2025-05-21', 'Kakva bomba! Lille pokazala duge noge u izdanju koje je postalo ', '\'\'Nije legalno koliko si lijepa\'\'', 'izdanje Lidije Bačić raspametilo je njezine obožavatelje na društvenim mrežama.\r\nLille je pozirala u kratkoj crnoj haljini kojom je istaknula svoje duge noge. Pohvala na račun njezina izgleda, kao i uvijek, nije nedostajalo.\r\n\r\n\'\'Prekrasna\'\', \'\'Elegantna\'\', \'\'Kakve noge\'\', \'\'Nije legalno koliko si lijepa\'\', \'\'Lidija, prava si ljepotica\'\', \'\'Tea Tairović je mala maca naspram naše Lidije\'\', \'\'Prekrasna dama\'\', \'\'Odlično ti stoji sve, uživo još ljepše\'\', \'\'Nestvarna ljepotica Lille\'\', samo je dio komentara u moru emotikona vatre i srca.', '63084297-lidija-bacic.webp', 3, b'0'),
(9, '2025-06-05', 'Vlada donijela važnu odluku u vezi bolnica, ministar otkrio kada stižu pozivi sindikatima', 'Vlada je donijela odluku o isplati dodatnih 76 milijuna eura bolnicama čiji su osnivači RH i županije za podmirivanje dijela dospjelih obveza prema dobavljačima lijekova, potrošnog i ugradbenog medicinskog materijala.', 'Vlada je na sjednici u četvrtak donijela odluku o pokretanju postupka pregovora o sklapanju dodatka Kolektivnom i Temeljnom kolektivnom ugovoru za zaposlene u državnim i javnim službama te imenovala pregovarački odbor Vlade, a sindikati će dobiti poziv za sastanak već idućeg tjedna.  ', '63085142-novac-ilustracija.webp', 1, b'0'),
(10, '2025-06-05', 'Vege burger od slanutka: 5 recepata za ljetni roštilj', 'Oduševit će i mesoljupce', 'Burgeri su danas toliko popularno jelo da postoje specijalizirani restorani brze hrane posvećeni upravo njima, a nerijetko možemo naići i na razne festivale posvećene raznim recepturama s burgerima. Iako su mesni burgeri vrlo popularni, za njima ne zaostaju ni biljni burgeri koji nude čak i veći izbor okusa i kombinacija.\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\nU čast Svjetskog dana biljnih burgera koji se obilježava 5. lipnja donosimo nekoliko recepata za ovu idealnu ljetnu namirnicu, posebice za roštilj kod kuće, u prirodi ili na odmoru.', 'Vege-burger-od-slanutka.jpg', 4, b'0'),
(11, '2025-06-05', 'Turci tvrde da poznati veznjak želi raskinuti ugovor i otići u Hajduk', 'Navodno Garcija želi ukrajinskog veznjaka u klubu, a ako Garcija i dođe, onda je Ukrajinac jako blizu Hajduka…', 'Tko će otići, a tko će doći u Hajduk svodi se samo na nagađanja. A posljednja informacija govori da bi na Poljud mogao Ukrajinac Oleksandr Petrusenko.\\r\\n\\r\\nSpomenuti veznjak poznat je onima koji prate SHNL, imao je 69 nastupa za Istru 1961, a prošle godine otišao je u Tursku. Tamo se i nije baš snašao, a u Istri ga je trenirao Gonzalo Garcija, izgledni novi trener Hajduka.', '63094420-ante-coric-i-oleksandr-petrusenko.jpg', 3, b'0'),
(12, '2025-06-05', 'novov', 'vvv', 'sasfafsa', 'BZ.jpg', 3, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categoryName`) VALUES
(1, 'Politics'),
(2, 'ShowBizz'),
(3, 'Sport'),
(4, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `ID` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `username` varchar(64) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `permission` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1250 COLLATE=cp1250_croatian_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`ID`, `ime`, `prezime`, `username`, `pass`, `permission`) VALUES
(1, 'adminName', 'adminLastName', 'admin1', '$2y$10$fUEVqUuJvjwq2Misg55Seub.5cSO2RmyMXStgLxSSU3TQkSP87KmK', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
