-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 10:12 PM
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
-- Database: `gestion_livres_bib`
--

-- --------------------------------------------------------

--
-- Table structure for table `adherents`
--

CREATE TABLE `adherents` (
  `idAdherent` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `dateNaissance` date NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `nomUtilisateur` varchar(30) NOT NULL,
  `motPasse` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adherents`
--

INSERT INTO `adherents` (`idAdherent`, `nom`, `prenom`, `dateNaissance`, `adresse`, `telephone`, `nomUtilisateur`, `motPasse`) VALUES
(1, 'Dupont', 'Luc', '1990-06-15', '123 Rue de Paris', '0612345678', 'luc.dupont', 'pass1234'),
(2, 'Martin', 'Sophie', '1985-02-28', '456 Avenue de Lyon', '0612345679', 'sophie.martin', 'martin85'),
(3, 'Bernard', 'Claire', '1992-11-07', '789 Boulevard de Lille', '0612345680', 'claire.bernard', 'claire92'),
(4, 'Moreau', 'Julien', '1998-04-13', '321 Rue de Marseille', '0612345681', 'julien.moreau', 'jm12345'),
(5, 'Lefevre', 'Marie', '2000-09-30', '654 Rue de Bordeaux', '0612345682', 'marie.lefevre', 'marie2000');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom_utilisateur` varchar(30) NOT NULL,
  `mot_passe` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nom_utilisateur`, `mot_passe`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `auteurs`
--

CREATE TABLE `auteurs` (
  `idAuteur` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `dateNaissance` date NOT NULL,
  `idPays` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auteurs`
--

INSERT INTO `auteurs` (`idAuteur`, `nom`, `prenom`, `dateNaissance`, `idPays`) VALUES
(1, 'Wohlleben', 'Peter', '1964-06-23', 2),
(2, 'Camus', 'Albert', '1913-11-07', 1),
(3, 'Hugo', 'Victor', '1802-02-26', 1),
(4, 'Saint-Exupéry', 'Antoine', '1900-06-29', 1),
(5, 'Stendhal', 'Henri Beyle', '1783-01-23', 1),
(6, 'Goethe', 'Johann', '1749-08-28', 2),
(7, 'Hemingway', 'Ernest', '1899-07-21', 3),
(8, 'Fitzgerald', 'F. Scott', '1896-09-24', 3),
(11, 'Nice', 'MO7MED', '2024-11-20', 6),
(12, 'Nice', 'MO7MED', '2024-11-18', 7);

-- --------------------------------------------------------

--
-- Table structure for table `emprunts`
--

CREATE TABLE `emprunts` (
  `idEmprunt` int(11) NOT NULL,
  `dateCommande` date DEFAULT NULL,
  `dateEmprunt` date DEFAULT NULL,
  `dateRetour` date DEFAULT NULL,
  `etatEmprunt` varchar(20) DEFAULT NULL,
  `idAdherent` int(11) DEFAULT NULL,
  `idExemplaire` int(11) DEFAULT NULL,
  `idRetard` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emprunts`
--

INSERT INTO `emprunts` (`idEmprunt`, `dateCommande`, `dateEmprunt`, `dateRetour`, `etatEmprunt`, `idAdherent`, `idExemplaire`, `idRetard`) VALUES
(1, '2024-01-09', '2024-01-10', NULL, 'Regeté', 1, 1, 1),
(2, '2024-11-12', '2024-11-14', '2024-11-18', 'Accepté', 2, 2, 2),
(3, '2024-02-05', '2024-10-23', '2024-11-12', 'Retour', 3, 3, 3),
(4, '2024-03-29', '2024-04-01', '2024-11-13', 'Retour', 4, 4, 4),
(5, '2024-10-01', '2024-10-29', NULL, 'Accepté', 5, 5, 5),
(6, '2024-10-02', '2024-10-26', NULL, 'Accepté', 1, 6, 6),
(23, '2024-11-16', NULL, NULL, 'Regeté', 2, 21, 20),
(24, '2024-11-09', NULL, NULL, NULL, 2, 25, 21);

-- --------------------------------------------------------

--
-- Table structure for table `exemplaires`
--

CREATE TABLE `exemplaires` (
  `idExemplaire` int(11) NOT NULL,
  `etat` varchar(20) NOT NULL,
  `idLivre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exemplaires`
--

INSERT INTO `exemplaires` (`idExemplaire`, `etat`, `idLivre`) VALUES
(1, 'Disponible', 1),
(2, 'Utilisé', 1),
(3, 'Disponible', 1),
(4, 'Disponible', 1),
(5, 'Utilisé', 1),
(6, 'Utilisé', 1),
(7, 'Disponible', 1),
(8, 'Disponible', 1),
(9, 'Disponible', 1),
(10, 'Disponible', 1),
(11, 'Disponible', 2),
(12, 'Disponible', 2),
(13, 'Disponible', 2),
(14, 'Disponible', 2),
(15, 'Disponible', 2),
(16, 'Disponible', 2),
(17, 'Disponible', 2),
(18, 'Disponible', 2),
(19, 'Disponible', 2),
(20, 'Disponible', 2),
(21, 'Disponible', 3),
(22, 'Disponible', 3),
(23, 'Disponible', 3),
(24, 'Disponible', 3),
(25, 'Disponible', 3),
(26, 'Disponible', 3),
(27, 'Disponible', 3),
(28, 'Disponible', 3),
(29, 'Disponible', 3),
(30, 'Disponible', 3),
(31, 'Disponible', 4),
(32, 'Disponible', 4),
(33, 'Disponible', 4),
(34, 'Disponible', 4),
(35, 'Disponible', 4),
(36, 'Disponible', 4),
(37, 'Disponible', 4),
(38, 'Disponible', 4),
(39, 'Disponible', 4),
(40, 'Disponible', 4),
(41, 'Disponible', 5),
(42, 'Disponible', 5),
(43, 'Disponible', 5),
(44, 'Disponible', 5),
(45, 'Disponible', 5),
(46, 'Disponible', 5),
(47, 'Disponible', 5),
(48, 'Disponible', 5),
(49, 'Disponible', 5),
(50, 'Disponible', 5);

-- --------------------------------------------------------

--
-- Table structure for table `livres`
--

CREATE TABLE `livres` (
  `idLivre` int(11) NOT NULL,
  `titre` varchar(30) NOT NULL,
  `annee` int(11) NOT NULL,
  `resume` varchar(200) DEFAULT NULL,
  `descreption` text NOT NULL,
  `idAuteur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `livres`
--

INSERT INTO `livres` (`idLivre`, `titre`, `annee`, `resume`, `descreption`, `idAuteur`) VALUES
(1, 'La Vie Secrète des Arbres', 2015, 'Exploration de la communication des arbres.', 'La Vie Secrète des Arbres de Peter Wohlleben est un ouvrage captivant qui explore la vie cachée des forêts et des arbres. L\'auteur, forestier de profession, nous plonge dans un univers fascinant où les arbres ne sont pas des êtres solitaires, mais des entités sociales et interconnectées. À travers une série de découvertes scientifiques et d\'observations de terrain, Wohlleben révèle comment les arbres communiquent entre eux, s\'entraident, se protègent et même prennent soin de leurs \"proches\".  Le livre explique des phénomènes étonnants tels que le réseau souterrain des racines et des champignons, qui permet aux arbres de partager des ressources et d\'échanger des informations. Il décrit également la capacité des arbres à ressentir la douleur, à mémoriser certains événements et à s\'adapter à leur environnement. Wohlleben met en lumière les relations complexes qui existent dans les forêts et insiste sur leur rôle crucial pour la biodiversité et l\'équilibre de la planète.  À la fois scientifique et poétique, La Vie Secrète des Arbres est une invitation à revoir notre perception de la nature et à prendre conscience de l\'importance vitale des forêts pour notre avenir. Si vous êtes curieux de comprendre les arbres autrement et de découvrir un monde caché mais essentiel, ce livre est une lecture incontournable.', 1),
(2, 'L\'Étranger', 1942, 'Roman philosophique sur l\'absurdité de la vie', 'L\'Étranger d\'Albert Camus est un roman incontournable de la littérature française, publié en 1942. Il raconte l’histoire de Meursault, un homme ordinaire, qui vit une existence détachée et indifférente aux conventions sociales. Le livre commence par le décès de sa mère, événement qu’il aborde avec une étrange froideur et une absence totale d’émotion, ce qui suscite l’étonnement et la désapprobation de son entourage.  Au fur et à mesure de l’histoire, Meursault traverse une série d’événements qui le mènent à un meurtre apparemment sans raison, en plein cœur d\'une société qui cherche à comprendre et à juger son comportement. Le roman se concentre sur son procès, où son attitude détachée face à la vie est mise en lumière, et où il est condamné non seulement pour le meurtre qu’il a commis, mais aussi pour son manque d\'émotion et son indifférence aux normes sociales.  À travers le personnage de Meursault, Camus explore des thèmes philosophiques profonds, notamment l’absurdité de l\'existence, la liberté individuelle, et le non-sens de la vie humaine. Le livre questionne également la manière dont la société juge les individus en fonction de leurs comportements extérieurs plutôt que de leurs motivations profondes.', 2),
(3, 'Les Misérables', 1862, 'Classique sur la justice et la rédemption.', 'Les Misérables de Victor Hugo est un roman monumental publié en 1862, qui est l\'une des œuvres les plus célèbres et les plus influentes de la littérature française. L’histoire se déroule au début du XIXe siècle en France et suit plusieurs personnages, dont le destin s’entrelace de manière complexe, chacun étant marqué par les luttes sociales et personnelles.  Le personnage principal, Jean Valjean, est un ancien forçat qui cherche à se racheter après avoir purgé une peine de prison pour avoir volé du pain. Il devient un homme riche et respecté, mais il doit constamment échapper à l\'inspecteur Javert, un policier obsédé par la justice et la loi. L’histoire suit également d’autres personnages poignants, comme Fantine, une mère célibataire qui lutte pour subvenir aux besoins de sa fille Cosette, qui sera recueillie par Jean Valjean, et Marius, un jeune révolutionnaire amoureux de Cosette.  À travers ces personnages et leurs parcours, Hugo aborde des thèmes profonds comme l’injustice sociale, la rédemption, le sacrifice, et l’amour. Le roman dépeint la misère des plus démunis, tout en montrant les luttes intérieures et les dilemmes moraux qui définissent l\'humanité.  Les Misérables est une réflexion sur la société, les inégalités, et les conditions de vie des pauvres, mais aussi sur la lumière et l’espoir qui peuvent émerger même dans les situations les plus sombres. Le livre explore des questions de loi et de grâce, de pouvoir et de pauvreté, et il est imprégné de la volonté de l’auteur de changer le monde pour le mieux.', 3),
(4, 'Le Petit Prince', 1943, 'Conte philosophique pour enfants et adultes.', 'Le Petit Prince d\'Antoine de Saint-Exupéry, publié en 1943, est un conte philosophique intemporel qui, à travers l’histoire d’un petit garçon venu d’une autre planète, explore des thèmes profonds de l’amour, de l’amitié, de la perte et de la quête de sens dans la vie.  Le narrateur, un aviateur, raconte comment, après un accident dans le désert du Sahara, il rencontre un étrange garçon, le Petit Prince, qui lui raconte ses aventures. Le Petit Prince vient d\'une petite planète appelée l\'Astéroïde B-612 et a quitté son monde pour voyager à travers l\'univers. Au fil de ses rencontres avec divers personnages sur d\'autres planètes, il apprend des leçons sur la nature humaine, la vanité, l\'égoïsme, et la superficialité des adultes, qui ont perdu la capacité de voir l\'essentiel de la vie.  Parmi les personnages qu’il rencontre, on trouve le roi, le buveur, le businessman, le lampeur et le géographe, chacun incarnant des aspects absurdes et critiques de la société adulte. Il rencontre également le renard, qui lui enseigne l’importance de \"l\'apprivoisement\" et de la relation, et la vraie signification de l’amitié et de l\'amour.  Le Petit Prince nous invite à reconsidérer ce que nous valorisons dans la vie, à voir avec les yeux du cœur plutôt qu\'avec ceux de l\'esprit, et à ne pas oublier l\'enfant en nous. C\'est un récit poétique et rempli de symbolisme qui s\'adresse à la fois aux enfants et aux adultes, nous rappelant l\'importance des relations humaines et des choses simples mais essentielles dans la vie.', 4),
(5, 'Le Rouge et le Noir', 1830, 'Exploration des ambitions d\'un jeune homme.', 'Le Rouge et le Noir de Stendhal, publié en 1830, est un roman réaliste et psychologique qui raconte l\'ascension sociale et les luttes intérieures de Julien Sorel, un jeune homme ambitieux et brillant, mais issu d\'un milieu modeste. Ce roman est souvent vu comme une critique des sociétés monarchistes et bourgeoises de la Restauration en France.  L’histoire débute dans un petit village où Julien, fils du charpentier local, cherche à échapper à sa condition sociale en cultivant son intelligence et ses talents. Il devient le précepteur des enfants du maire, un rôle qui l’introduit dans le monde de la noblesse. Julien rêve de grandeur et souhaite devenir un homme influent, d\'où le \"rouge\" du titre, symbolisant la carrière militaire qu’il envisage, et le \"noir\", symbolisant la carrière ecclésiastique qu’il pourrait embrasser en raison de son ambition et de sa ruse.  Au fil du roman, Julien traverse des épreuves, des intrigues et des amours compliquées, notamment avec Madame de Rênal, l\'épouse d\'un de ses patrons, et avec Mathilde de la Mole, une aristocrate, qui l’attire dans des relations de pouvoir, de manipulation et de passion. Son ascension sociale se heurte cependant aux obstacles de la société de l’époque, de ses propres contradictions et de ses erreurs.  À travers Julien Sorel, Stendhal explore des thèmes puissants comme l’ambition, la passion, l’amour, l’hypocrisie sociale et la quête de soi. Julien incarne un homme en quête de sens, tiraillé entre ses aspirations personnelles et les pressions extérieures. Le Rouge et le Noir analyse la psychologie des personnages, notamment à travers la conscience de Julien de ses propres contradictions et de son désir de se confronter à l\'ordre social.', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pays`
--

CREATE TABLE `pays` (
  `idPays` int(11) NOT NULL,
  `nomPays` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pays`
--

INSERT INTO `pays` (`idPays`, `nomPays`) VALUES
(1, 'Algeria'),
(2, 'Arabie Saoudite'),
(3, 'Egypte'),
(6, 'Algeria'),
(7, 'Algeria');

-- --------------------------------------------------------

--
-- Table structure for table `retards`
--

CREATE TABLE `retards` (
  `idRetard` int(11) NOT NULL,
  `numJour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `retards`
--

INSERT INTO `retards` (`idRetard`, `numJour`) VALUES
(1, 296),
(2, 0),
(3, 5),
(4, 211),
(5, 5),
(6, 8),
(7, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(16, 0),
(17, 0),
(18, 0),
(19, 0),
(20, 0),
(21, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adherents`
--
ALTER TABLE `adherents`
  ADD PRIMARY KEY (`idAdherent`),
  ADD UNIQUE KEY `nomUtilisateur` (`nomUtilisateur`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`idAuteur`),
  ADD KEY `idPays` (`idPays`);

--
-- Indexes for table `emprunts`
--
ALTER TABLE `emprunts`
  ADD PRIMARY KEY (`idEmprunt`),
  ADD KEY `idAdherent` (`idAdherent`),
  ADD KEY `idExemplaire` (`idExemplaire`),
  ADD KEY `idRetard` (`idRetard`);

--
-- Indexes for table `exemplaires`
--
ALTER TABLE `exemplaires`
  ADD PRIMARY KEY (`idExemplaire`),
  ADD KEY `idLivre` (`idLivre`);

--
-- Indexes for table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`idLivre`),
  ADD KEY `idAuteur` (`idAuteur`);

--
-- Indexes for table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`idPays`);

--
-- Indexes for table `retards`
--
ALTER TABLE `retards`
  ADD PRIMARY KEY (`idRetard`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adherents`
--
ALTER TABLE `adherents`
  MODIFY `idAdherent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auteurs`
--
ALTER TABLE `auteurs`
  MODIFY `idAuteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `emprunts`
--
ALTER TABLE `emprunts`
  MODIFY `idEmprunt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `exemplaires`
--
ALTER TABLE `exemplaires`
  MODIFY `idExemplaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `livres`
--
ALTER TABLE `livres`
  MODIFY `idLivre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pays`
--
ALTER TABLE `pays`
  MODIFY `idPays` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `retards`
--
ALTER TABLE `retards`
  MODIFY `idRetard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auteurs`
--
ALTER TABLE `auteurs`
  ADD CONSTRAINT `auteurs_ibfk_1` FOREIGN KEY (`idPays`) REFERENCES `pays` (`idPays`);

--
-- Constraints for table `emprunts`
--
ALTER TABLE `emprunts`
  ADD CONSTRAINT `emprunts_ibfk_1` FOREIGN KEY (`idAdherent`) REFERENCES `adherents` (`idAdherent`),
  ADD CONSTRAINT `emprunts_ibfk_2` FOREIGN KEY (`idExemplaire`) REFERENCES `exemplaires` (`idExemplaire`),
  ADD CONSTRAINT `emprunts_ibfk_3` FOREIGN KEY (`idRetard`) REFERENCES `retards` (`idRetard`);

--
-- Constraints for table `exemplaires`
--
ALTER TABLE `exemplaires`
  ADD CONSTRAINT `exemplaires_ibfk_1` FOREIGN KEY (`idLivre`) REFERENCES `livres` (`idLivre`);

--
-- Constraints for table `livres`
--
ALTER TABLE `livres`
  ADD CONSTRAINT `livres_ibfk_1` FOREIGN KEY (`idAuteur`) REFERENCES `auteurs` (`idAuteur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
