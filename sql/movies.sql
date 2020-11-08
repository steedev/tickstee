-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Lis 2020, 00:10
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `movies`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `username` varchar(32) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `img` varchar(225) NOT NULL,
  `description` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `movies`
--

INSERT INTO `movies` (`id`, `name`, `img`, `description`) VALUES
(1, 'Mission Impossible Fallout', 'https://fwcdn.pl/fpo/29/76/752976/7847249.3.jpg', 'Two years after Ethan Hunt had successfully captured Solomon Lane, the remnants of the Syndicate have reformed into another organization called the Apostles. Under the leadership of a mysterious fundamentalist known only as John Lark, the organization is planning on acquiring three plutonium cores. Ethan and his team are sent to Berlin to intercept them, but the mission fails when Ethan saves Luther and the Apostles escape with the plutonium.'),
(2, 'Jason Bourne', 'https://fwcdn.pl/fpo/28/12/732812/7742307.3.jpg', 'Jason Bourne is again being hunted by the CIA. It begins when Nicky Parsons a former CIA operative who helped Bourne, who went under and now works with a man who\'s a whistle blower and is out to expose the CIA\'s black ops. Nicky hacks into the CIA and downloads everything on all their Black Ops, including Treadstone which Bourne was a part of.'),
(3, 'Kingsman Secret Service', 'https://www.teatrosociale.it/images/cinema/kingsman.jpg', 'A young man named Gary \"Eggsy\" Unwin (Taron Egerton), whose father died when he was a young boy, is dealing with living with the creep his mother is with now, who mistreats her and him. He goes out and does something to one of the creep\'s friends. He gets arrested and he calls the number a man gave him around the time his father died, to call if he needs help. A man named Harry Hart (Colin Firth) approaches him and tells him he\'s the one who helped him. He tells him that he knew his father.'),
(4, 'Red Sparrow', 'https://6.allegroimg.com/s1024/0cb71c/4b7e511644ceaec3b597c696b1b6', 'A young Russian intelligence officer is assigned to seduce a first-tour CIA agent who handles the CIA\'s most sensitive penetration of Russian intelligence. The two young officers collide in a charged atmosphere of trade-craft, deception, and inevitably forbidden passion that threatens not just their lives but the lives of others as well.'),
(5, 'Hitman: Agent 47', 'https://fwcdn.pl/fpo/75/12/557512/7696298.3.jpg', 'HITMAN: AGENT 47 centers on an elite assassin who was genetically engineered from conception to be the perfect killing machine, and is known only by the last two digits on the barcode tattooed on the back of his neck. He is the culmination of decades of research and forty-six earlier Agent clones -- endowing him with unprecedented strength, speed, stamina and intelligence.'),
(6, 'Fast & Furious: Hobbs & Shaw', 'https://image.tmdb.org/t/p/w500/qRyy2UmjC5ur9bDi3kpNNRCc5nc.jpg', 'Lawman Luke Hobbs (Dwayne \"The Rock\" Johnson) and outcast Deckard Shaw (Jason Statham) form an unlikely alliance when a cyber-genetically enhanced villain threatens the future of humanity.'),
(7, 'Now You See Me 2', 'https://empirecinema.com.mt/wp-content/uploads/2016/06/now_you_see_me_two_ver15.jpg', 'One year after outwitting the F.B.I. and winning the public\'s adulation with their Robin Hood-style magic spectacles, The Four Horsemen resurface for a comeback performance in hopes of exposing the unethical practices of a tech magnate. The man behind their vanishing act is none other than Walter Mabry, a tech prodigy who threatens the Horsemen into pulling off their most impossible heist yet.'),
(8, 'Baby Driver', 'https://sfanytime-images-prod.secure.footprint.net/COVERM/dcac788f-3513-423f-802e-a7fd00dbb85a_COVERM_01.jpg?w=375&fm=pjpg&s=873d00a51890bd1e943bf4e5979f9486', 'Baby is a young and partially hearing impaired getaway driver who can make any wild move while in motion with the right track playing. It\'s a critical talent he needs to survive his indentured servitude to the crime boss, Doc, who values his role in his meticulously planned robberies. However, just when Baby thinks he is finally free and clear to have his own life with his new girlfriend, Debora, Doc coerces him back for another job.'),
(9, 'No Time to Die', 'https://www.szarmant.pl/wp-content/uploads/2020/09/No-Time-To-Die-poster.jpg', 'Bond has left active service and is enjoying a tranquil life in Jamaica. His peace is short-lived when his old friend Felix Leiter from the CIA turns up asking for help. The mission to rescue a kidnapped scientist turns out to be far more treacherous than expected, leading Bond onto the trail of a mysterious villain armed with dangerous new technology.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `movie` varchar(100) NOT NULL,
  `username` varchar(32) NOT NULL,
  `tel` varchar(32) NOT NULL,
  `places` varchar(225) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `reservations`
--

INSERT INTO `reservations` (`id`, `movie`, `username`, `tel`, `places`, `date`) VALUES
(2, 'Jason Bourne', 'Stee', '111-222-333', '11x11 11x12 ', '0000-00-00 00:00:00'),
(4, 'Mission Impossible Fallout ', 'Stee', '111-222-333', '7x4 7x5 ', '2020-11-07 23:00:00'),
(8, 'Kingsman Secret Service ', 'Stee', '111-222-333', '7x3 ', '2020-11-07 23:00:00'),
(9, 'Red Sparrow ', 'Stee', '222-333-111', '6x4 ', '2020-11-07 23:00:00'),
(11, 'Mission Impossible Fallout ', 'Stee', '111-222-333', '13x4 ', '2020-11-07 23:00:00'),
(13, 'Hitman: Agent 47 ', 'Wika', '111-222-333', '6x11 6x12 6x13 ', '2020-11-07 23:00:00'),
(16, 'Hitman: Agent 47 ', 'Stee', '235-247-320', '3x2 3x3 3x4 3x5 3x7 3x6 3x8 3x9 3x10 4x9 4x8 4x7 4x6 4x5 4x4 4x3 4x2 4x1 5x1 5x2 5x3 5x4 5x5 5x6 5x7 5x8 5x0 2x3 2x4 2x5 2x6 2x7 2x8 2x9 2x10 2x11 ', '2020-11-07 23:00:00'),
(17, 'No Time To Die ', 'Stee', '222-444-315', '2x4 2x5 2x6 ', '2020-11-08 22:24:17'),
(18, 'Now You See Me 2 ', 'Stee', '412-518-391', '9x6 ', '2020-11-08 22:45:11'),
(19, 'Jason Bourne ', 'Wika', '135-642-094', '5x4 5x5 5x6 ', '2020-11-08 22:53:24'),
(20, 'No Time To Die ', 'Janek', '243-529-240', '8x11 8x12 8x13 8x14 ', '2020-11-08 23:02:57');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `date`) VALUES
(12, 'Stee', '$2y$10$UeAvdotq6qR16AucEYb1FeODcljq6BWFnJuvHXM0RBlfEmNLbUQHW', '2020-11-07 23:00:00'),
(13, 'Wika', '$2y$10$z3NEjgYIkje8Gs6af3J.v.6FcfX44Lj1/0dkTsqNkCJ2OSSjVjq16', '2020-11-07 23:00:00'),
(14, 'Janek', '$2y$10$FxTG48w.wGL1VO0Lalgdse73Q3gm9JUKuHzHduQxbnoBQVmwyCRDu', '2020-11-08 22:59:23');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT dla tabeli `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
