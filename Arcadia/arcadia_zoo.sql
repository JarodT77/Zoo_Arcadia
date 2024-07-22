-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 22 juil. 2024 à 01:08
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `arcadia_zoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

CREATE TABLE `animal` (
  `id` int(10) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `race` varchar(50) NOT NULL,
  `image` blob NOT NULL,
  `habitat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`id`, `prenom`, `race`, `image`, `habitat_id`) VALUES
(36, 'Ariane', 'Ara ', 0x6172612e6a7067, 2),
(37, 'Bastien ', 'Chimpanze', 0x6368696d70616e7a652e6a7067, 2),
(38, 'Elodie', 'Elephant ', 0x656c657068616e742e6a7067, 2),
(40, 'Julien ', 'Jaguar', 0x6a61677561722e6a7067, 2),
(41, 'Chantal ', 'Ours ', 0x6f7572732e6a7067, 2),
(42, 'Hugo ', 'Panthere ', 0x70616e74686572652e6a7067, 2),
(43, 'Gaby', 'Serpent ', 0x73657270656e742e6a7067, 2),
(44, 'Antoine ', 'Antilope ', 0x616e74696c6f70652e6a7067, 3),
(45, 'Brigitte', 'Buffle', 0x627566666c652e6a7067, 3),
(46, 'Cedric ', 'Caracal ', 0x6361726163616c2e6a7067, 3),
(47, 'Delphine ', 'Girafe ', 0x6769726166652e6a7067, 3),
(48, 'Albert', 'Hyene ', 0x6879656e652e6a7067, 3),
(49, 'Simba ', 'Lion ', 0x6c696f6e2e6a7067, 3),
(50, 'Tala ', 'Tigre ', 0x74696772652e6a7067, 3),
(51, 'Billy ', 'Zebre ', 0x7a656272652e6a7067, 3),
(54, 'Denver', 'Alligator', 0x616c6c696761746f722e6a7067, 27),
(55, 'Oreo', 'Capybara', 0x63617079626172612e6a7067, 27),
(56, 'Edgar', 'Chouette', 0x63686f75657474652e6a7067, 27),
(57, 'Yvonne', 'Crapaud', 0x637261706175642e6a7067, 27),
(58, 'Camille', 'Iguane', 0x696775616e652e6a7067, 27),
(59, 'Delphine', 'Flamant rose', 0x666c616d616e7420726f73652e6a7067, 27),
(60, 'Albert', 'Ragondin', 0x7261676f6e64696e2e6a7067, 27),
(61, 'Dona', 'Tortue', 0x746f727475652e6a7067, 27);

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `commentaire` varchar(50) NOT NULL,
  `isVisible` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `pseudo`, `commentaire`, `isVisible`) VALUES
(8, 'Jarod', 'c&#039;esst cool ', 1),
(9, 'Jarod', 'Bienvenue sur le site !', 1),
(10, 'Jarod', 'pas mal ', 1);

-- --------------------------------------------------------

--
-- Structure de la table `feeding`
--

CREATE TABLE `feeding` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `nourriture` text NOT NULL,
  `quantite` text NOT NULL,
  `animal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `feeding`
--

INSERT INTO `feeding` (`id`, `date`, `nourriture`, `quantite`, `animal_id`) VALUES
(9, '2024-07-21 12:00:00', 'graine', '100', 36);

-- --------------------------------------------------------

--
-- Structure de la table `habitats`
--

CREATE TABLE `habitats` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `discribe` text NOT NULL,
  `commentaire` text NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `habitats`
--

INSERT INTO `habitats` (`id`, `nom`, `discribe`, `commentaire`, `image`) VALUES
(2, 'La savane ', 'Plongez au cœur de la savane africaine, où les vastes plaines et les acacias forment le decor idéale pour nos majestueux lions, élégantes girafes, et puissants éléphants. Cet habitat recrée l\'écosystème de la savane, offrant à nos animaux de grands espaces pour se déplacer et interagir, tout en permettant aux visiteurs d\'observer ces créatures dans un environnement qui reflète fidèlement leur habitat naturel.', '', 0x736176616e652d312e6a7067),
(3, 'La jungle ', 'Plongez au cœur de la jungle, un véritable paradis tropical ! Cette forêt luxuriante, remplie de végétation exotique et d\'arbres majestueux, est le foyer de nombreuses espèces fascinantes. Découvrez les singes espiègles, les oiseaux aux plumes éclatantes et les majestueux jaguars qui règnent sur ce royaume verdoyant. La jungle vous promet une aventure inoubliable, riche en découvertes et en émerveillements. ', '', 0x6a756e676c652d312e6a7067),
(27, 'Le marais ', 'Explorez cet environnement unique où les crocodiles se prélassent au soleil, les oiseaux aquatiques chantent et les tortues glissent paisiblement dans les eaux calmes. Le marais offre une immersion totale dans un monde où la nature sauvage règne en maître, promettant une expérience inoubliable pour tous les visiteurs.', '', 0x6d6172616973322e6a7067);

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `role_id`) VALUES
(12, 'create_account', 1),
(13, 'modify_animals', 1),
(14, 'modify_service', 1),
(15, 'modify_habitat', 1),
(16, 'view_rapport', 2),
(17, 'view_dashboard', 1),
(18, 'feeding_animal', 3),
(19, 'reviews_client', 3),
(20, 'vet_feeding', 2),
(21, 'admin_rapport', 1);

-- --------------------------------------------------------

--
-- Structure de la table `rapports_veterinaires`
--

CREATE TABLE `rapports_veterinaires` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rapports_veterinaires`
--

INSERT INTO `rapports_veterinaires` (`id`, `animal_id`, `detail`, `date`) VALUES
(9, 36, 'Etat de l\'animal: En forme\r\nNourriture donnee: Graine\r\nGrammage: 100g ', '2024-07-21'),
(10, 37, 'Bastien en forme . nourriture donnee 1kg de fruit', '2024-07-21');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `label`) VALUES
(1, 'administrateur'),
(2, 'veterinaire'),
(3, 'employe');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` int(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `discribe` text NOT NULL,
  `image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `nom`, `discribe`, `image`) VALUES
(3, 'train ', 'Faite le tour du zoo en train ideal pour les enfants', 0x747261696e2e6a7067),
(4, 'guide ', 'Decouvrez les habitats du zoo avec nos guide qui vous feront decouvrir les coulisses du parc ', 0x7a6f6f6b65657065722e706e67),
(5, 'Restaurant', 'Profitez et degustez nos meilleurs plat dans notre restaurant avec magnifique vue sur le parc ', 0x72657374617572616e742e6a7067);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `password`, `role_id`, `email`) VALUES
(4, '123', 1, 'admin@mail.com'),
(5, '123', 2, 'veterinaire@mail.com'),
(6, '123', 3, 'employe@mail.com'),
(8, '123', 3, 'Jarod@mail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `habitat_id` (`habitat_id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `feeding`
--
ALTER TABLE `feeding`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_id` (`animal_id`);

--
-- Index pour la table `habitats`
--
ALTER TABLE `habitats`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Index pour la table `rapports_veterinaires`
--
ALTER TABLE `rapports_veterinaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animal_id` (`animal_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `feeding`
--
ALTER TABLE `feeding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `habitats`
--
ALTER TABLE `habitats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `rapports_veterinaires`
--
ALTER TABLE `rapports_veterinaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`);

--
-- Contraintes pour la table `feeding`
--
ALTER TABLE `feeding`
  ADD CONSTRAINT `feeding_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`);

--
-- Contraintes pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Contraintes pour la table `rapports_veterinaires`
--
ALTER TABLE `rapports_veterinaires`
  ADD CONSTRAINT `rapports_veterinaires_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animal` (`id`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
