-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 28, 2025 at 10:24 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bazasamochody`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `IdKlienta` int(11) NOT NULL,
  `Imie` varchar(20) NOT NULL,
  `Nazwisko` varchar(20) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Numer` varchar(15) NOT NULL,
  `Haslo` char(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klienci`
--

INSERT INTO `klienci` (`IdKlienta`, `Imie`, `Nazwisko`, `Email`, `Numer`, `Haslo`) VALUES
(1, 'Adam', 'Białobrzeski', '123@ex.pl', '123123123', '123123'),
(2, 'Adam', 'Białobrzeski', '123@ex.pl', '123123123', '123123'),
(3, 'Mariusz', 'Kowalski', '1243@ex.pl', '567123123', '63333333xd'),
(4, 'Ola', 'Nowak', '12437@ex.pl', '567128523', 'asdvcxt4rew4'),
(5, 'uzytkownik', 'testowy', 'ut@ex.pl', '123234345', '$2y$10$XrU1iiTkCnV/nis5wOTfy.zOpSmjkXftKFs4YTiWKEj/kYfaATLdO'),
(6, 'XY', 'XY', 'XY@XY.com', '123123123', '$2y$10$RcnHCMfu4v8FBlhxjS/iVuEraV5c6wIIjkCp5GM.5xV/uAORXZ7aW');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszenia`
--

CREATE TABLE `ogloszenia` (
  `IdOgloszenia` int(11) NOT NULL,
  `IdKlienta` int(11) NOT NULL,
  `IdSamochodu` int(11) NOT NULL,
  `Cena` int(12) NOT NULL,
  `Przebieg` int(12) NOT NULL,
  `Rocznik` int(4) NOT NULL,
  `Opis` text DEFAULT NULL,
  `dataDodania` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ogloszenia`
--

INSERT INTO `ogloszenia` (`IdOgloszenia`, `IdKlienta`, `IdSamochodu`, `Cena`, `Przebieg`, `Rocznik`, `Opis`, `dataDodania`) VALUES
(1, 1, 2, 50000, 150000, 2018, 'Sprzedam toyote, nie bita(jak żona)', '2025-05-02'),
(2, 2, 6, 60000, 1400000, 2016, '', '2025-05-02'),
(3, 4, 9, 100000, 40000, 2021, 'Skręca, jeździ, hamuje!', '2025-05-01'),
(6, 5, 49, 9000, 315921, 2004, 'używana w wyścigach', '2025-05-27');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `samochody`
--

CREATE TABLE `samochody` (
  `IdSamochodu` int(11) NOT NULL,
  `Marka` varchar(20) NOT NULL,
  `Model` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `samochody`
--

INSERT INTO `samochody` (`IdSamochodu`, `Marka`, `Model`) VALUES
(1, 'Toyota', 'Corolla'),
(2, 'Toyota', 'Yaris'),
(3, 'Ford', 'Focus'),
(4, 'Ford', 'Fiesta'),
(5, 'Volkswagen', 'Golf'),
(6, 'Volkswagen', 'Passat'),
(7, 'BMW', '3 Series'),
(8, 'BMW', 'X5'),
(9, 'Mercedes-Benz', 'C-Class'),
(10, 'Mercedes-Benz', 'E-Class'),
(11, 'Audi', 'A4'),
(12, 'Audi', 'Q5'),
(13, 'Hyundai', 'i30'),
(14, 'Kia', 'Ceed'),
(15, 'Renault', 'Megane'),
(16, 'Peugeot', '208'),
(17, 'Skoda', 'Octavia'),
(18, 'Skoda', 'Fabia'),
(19, 'Opel', 'Astra'),
(20, 'Opel', 'Corsa'),
(21, 'Nissan', 'Qashqai'),
(22, 'Nissan', 'Juke'),
(23, 'Mazda', 'CX-5'),
(24, 'Mazda', '3'),
(25, 'Fiat', 'Panda'),
(26, 'Fiat', '500'),
(27, 'Chevrolet', 'Cruze'),
(28, 'Chevrolet', 'Aveo'),
(29, 'Honda', 'Civic'),
(30, 'Honda', 'Accord'),
(31, 'Mitsubishi', 'Lancer'),
(32, 'Mitsubishi', 'Outlander'),
(33, 'Subaru', 'Impreza'),
(34, 'Subaru', 'Forester'),
(35, 'Suzuki', 'Swift'),
(36, 'Suzuki', 'Vitara'),
(37, 'Seat', 'Leon'),
(38, 'Seat', 'Ibiza'),
(39, 'Volvo', 'XC60'),
(40, 'Volvo', 'V40'),
(41, 'Lexus', 'RX'),
(42, 'Lexus', 'NX'),
(43, 'Jeep', 'Renegade'),
(44, 'Jeep', 'Compass'),
(45, 'Citroen', 'C3'),
(46, 'Citroen', 'C4'),
(47, 'Toyota', 'Corolla'),
(49, 'Toyota', 'Corolla'),
(50, 'Toyota', 'Corolla');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia_ogloszen`
--

CREATE TABLE `zdjecia_ogloszen` (
  `IdZdjecia` int(11) NOT NULL,
  `IdOgloszenia` int(11) NOT NULL,
  `Sciezka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zdjecia_ogloszen`
--

INSERT INTO `zdjecia_ogloszen` (`IdZdjecia`, `IdOgloszenia`, `Sciezka`) VALUES
(1, 2, '/katalog/przykladowy'),
(2, 3, '/katalog/przykladowy'),
(3, 3, '/katalog/przykladowy'),
(4, 3, '/katalog/przykladowy'),
(5, 1, '/katalog/przykladowy'),
(8, 6, 'uploads/68362bff9f940_OIP.jpg');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`IdKlienta`);

--
-- Indeksy dla tabeli `ogloszenia`
--
ALTER TABLE `ogloszenia`
  ADD PRIMARY KEY (`IdOgloszenia`),
  ADD KEY `IdKlienta_Index` (`IdKlienta`),
  ADD KEY `fk_idSamochodu` (`IdSamochodu`);

--
-- Indeksy dla tabeli `samochody`
--
ALTER TABLE `samochody`
  ADD PRIMARY KEY (`IdSamochodu`);

--
-- Indeksy dla tabeli `zdjecia_ogloszen`
--
ALTER TABLE `zdjecia_ogloszen`
  ADD PRIMARY KEY (`IdZdjecia`),
  ADD KEY `FK_Zdjecia_Ogloszenia` (`IdOgloszenia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `IdKlienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ogloszenia`
--
ALTER TABLE `ogloszenia`
  MODIFY `IdOgloszenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `samochody`
--
ALTER TABLE `samochody`
  MODIFY `IdSamochodu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `zdjecia_ogloszen`
--
ALTER TABLE `zdjecia_ogloszen`
  MODIFY `IdZdjecia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ogloszenia`
--
ALTER TABLE `ogloszenia`
  ADD CONSTRAINT `fk_idSamochodu` FOREIGN KEY (`IdSamochodu`) REFERENCES `samochody` (`IdSamochodu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ogloszenia_klienci` FOREIGN KEY (`IdKlienta`) REFERENCES `klienci` (`IdKlienta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zdjecia_ogloszen`
--
ALTER TABLE `zdjecia_ogloszen`
  ADD CONSTRAINT `FK_Zdjecia_Ogloszenia` FOREIGN KEY (`IdOgloszenia`) REFERENCES `ogloszenia` (`IdOgloszenia`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
