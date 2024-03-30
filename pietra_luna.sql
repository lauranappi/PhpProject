-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 30, 2023 alle 16:15
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pietra_luna`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tavoli`
--

CREATE TABLE `tavoli` (
  `numero` int(11) NOT NULL,
  `esterno` tinyint(1) NOT NULL,
  `persone` int(2) NOT NULL,
  `disponibilita` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tavoli`
--

INSERT INTO `tavoli` (`numero`, `esterno`, `persone`, `disponibilita`) VALUES
(2, 0, 4, 1),
(3, 1, 6, 1),
(7, 1, 2, 0),
(8, 1, 4, 0),
(9, 1, 4, 1),
(11, 1, 8, 1),
(12, 0, 6, 1),
(13, 0, 6, 1),
(14, 0, 6, 1),
(15, 0, 2, 0),
(16, 0, 4, 0),
(17, 0, 4, 1),
(18, 0, 8, 1),
(21, 1, 2, 0),
(22, 1, 2, 0),
(23, 1, 2, 0),
(24, 1, 2, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `genere` text NOT NULL DEFAULT '*',
  `punti` int(255) DEFAULT 0,
  `sconto` tinyint(1) NOT NULL,
  `prenotazioni` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `password`, `nome`, `cognome`, `genere`, `punti`, `sconto`, `prenotazioni`) VALUES
('admin', 'pietradiluna', 'laura', 'nappi', 'f', 0, 0, NULL),
('andrea', 'andrea1', 'andrea1', 'verdi', 'm', 1, 0, '20:33, 2 persone, tavolo n 7'),
('carla', 'carla', 'carla', 'rossi', 'a', 1, 0, '20:00, 2 persone, tavolo n 23'),
('chiara', 'chiara', 'chiara', 'rota', 'o', 0, 0, NULL),
('d', 'd', 'dd', 'd', '*', 2, 0, '20:00, 2 persone, tavolo n 15'),
('dd', 'dd', 'dd', 'dd', 'a', 0, 1, NULL),
('f', 'f', 'f', 'f', 'o', 2, 0, '20:00, 4 persone, tavolo n 8'),
('federica', 'federica2', 'federica2', 'corà', 'f', 1, 1, NULL),
('federico', 'federico', 'federico', 'locatelli', 'm', 1, 1, NULL),
('giuseppe', 'giu', 'giuseppe', 'gius', '*', 0, 0, NULL),
('laura', 'laura', 'laura', 'nappi', 'f', 2, 0, '20:08, 4 persone, tavolo n 16'),
('lauraas', 'a', 'a', 'a', 'o', 0, 0, NULL),
('lauraass', 'a', 'a', 'a', 'o', 0, 0, NULL),
('lauraasss', 'a', 'a', 'a', 'o', 0, 0, NULL),
('lauranappi', 'laura', 'Laura', 'Nappi', 'f', 0, 0, NULL),
('mario', 'mario', 'mario', 'rossi', '*', 0, 0, NULL),
('matteo', 'matteo', 'matteo', 'matteo', 'o', 0, 0, NULL),
('nico', 'nico', 'nico', 'nico', 'a', 0, 0, NULL),
('pippo', 'pippo', 'pippo', 'pluto', '*', 0, 0, NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `tavoli`
--
ALTER TABLE `tavoli`
  ADD PRIMARY KEY (`numero`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `tavoli`
--
ALTER TABLE `tavoli`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
