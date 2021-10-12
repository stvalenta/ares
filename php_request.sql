-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost
-- Vytvořeno: Stř 29. zář 2021, 18:39
-- Verze serveru: 10.4.21-MariaDB
-- Verze PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `php_request`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `firmy_podle_ico`
--

CREATE TABLE `firmy_podle_ico` (
  `ico` int(11) NOT NULL,
  `dic` varchar(255) NOT NULL,
  `firma` varchar(255) NOT NULL,
  `ulice` varchar(255) NOT NULL,
  `mesto` varchar(255) NOT NULL,
  `psc` int(11) NOT NULL,
  `stav` varchar(255) NOT NULL,
  `datum_cas` varchar(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `firmy_podle_ico`
--

INSERT INTO `firmy_podle_ico` (`ico`, `dic`, `firma`, `ulice`, `mesto`, `psc`, `stav`, `datum_cas`, `id`) VALUES
(47114983, 'CZ47114983', 'Česká pošta, s.p.', 'Politických vězňů 909/4', 'Praha', 11000, 'ok', '29. 09. 2021. 18 : 18', 1);

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `firmy_podle_ico`
--
ALTER TABLE `firmy_podle_ico`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `firmy_podle_ico`
--
ALTER TABLE `firmy_podle_ico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
