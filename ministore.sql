-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 26 jan. 2024 à 09:47
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ministore`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240105134814', '2024-01-05 13:48:23', 52),
('DoctrineMigrations\\Version20240109092943', '2024-01-09 09:29:49', 23),
('DoctrineMigrations\\Version20240109102852', '2024-01-09 10:29:04', 76),
('DoctrineMigrations\\Version20240111104651', '2024-01-11 10:46:58', 59),
('DoctrineMigrations\\Version20240111110509', '2024-01-11 11:05:17', 370),
('DoctrineMigrations\\Version20240116093706', '2024-01-16 09:37:16', 67),
('DoctrineMigrations\\Version20240116102607', '2024-01-16 10:26:11', 60),
('DoctrineMigrations\\Version20240122132113', '2024-01-22 13:21:22', 34),
('DoctrineMigrations\\Version20240126080721', '2024-01-26 08:07:26', 44);

-- --------------------------------------------------------

--
-- Structure de la table `logo`
--

DROP TABLE IF EXISTS `logo`;
CREATE TABLE IF NOT EXISTS `logo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `logo`
--

INSERT INTO `logo` (`id`, `nom`) VALUES
(4, 'main-logo.png');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nav`
--

DROP TABLE IF EXISTS `nav`;
CREATE TABLE IF NOT EXISTS `nav` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nav`
--

INSERT INTO `nav` (`id`, `nom`, `lien`) VALUES
(1, 'bonjour', '/bonjour'),
(2, 'register', '/user/register');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `reference` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivery_adress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E52FFDEEAEA34913` (`reference`),
  KEY `IDX_E52FFDEEA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `reference`, `created_at`, `delivery_adress`) VALUES
(39, 3, '65ae24536cafa', '2024-01-22 08:16:19', 'Neymar Jean, 22 rue Alfred momo, 59264, Onnaing'),
(40, 3, '65ae2651730b7', '2024-01-22 08:24:49', 'DIGITAL LOUNGE AND LABS, 35 RUE DU FAUBOURG DES POSTES null, 59000, LILLE'),
(42, 3, '65ae49e6b00c8', '2024-01-22 10:56:38', 'SKY SHOP LILLE, 216 RUE DES POSTES null, 59000, LILLE'),
(44, 3, '65ae68dbd1d86', '2024-01-22 13:08:43', 'UNIQUE COIN, 89 BOULEVARD MONTEBELLO null, 59000, LILLE'),
(45, 3, '65afb001153e1', '2024-01-23 12:24:33', 'Neymar Jean, 22 rue Alfred momo, 59264, Onnaing'),
(46, 3, '65afb305757a2', '2024-01-23 12:37:25', 'LOCKER 24/7 LIDL ONNAING, 347 RUE JEAN JAURES null, 59264, ONNAING'),
(47, 3, '65afb48c0429a', '2024-01-23 12:43:56', 'BEAUTY PHONE, 2 RUE DU FAUBOURG DES POSTES null, 59000, LILLE'),
(48, 3, '65afb8feb4ec1', '2024-01-23 13:02:54', 'Neymar Jean, 22 rue Alfred momo, 59264, Onnaing'),
(49, 3, '65b21588a87a8', '2024-01-25 08:02:16', 'Neymar Jean, 22 rue Alfred momo, 59264, Onnaing'),
(50, 4, '65b230a637002', '2024-01-25 09:57:58', 'Carcel kevin, 2 rue de cambrai, 59264, Onnaing'),
(51, 4, '65b2557aca52a', '2024-01-25 12:35:06', 'BEAUTY PHONE, 2 RUE DU FAUBOURG DES POSTES null, 59000, LILLE');

-- --------------------------------------------------------

--
-- Structure de la table `orders_details`
--

DROP TABLE IF EXISTS `orders_details`;
CREATE TABLE IF NOT EXISTS `orders_details` (
  `orders_id` int NOT NULL,
  `produits_id` int NOT NULL,
  `quantity` int NOT NULL,
  `prix` int NOT NULL,
  PRIMARY KEY (`orders_id`,`produits_id`),
  KEY `IDX_835379F1CFFE9AD6` (`orders_id`),
  KEY `IDX_835379F1CD11A2CF` (`produits_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders_details`
--

INSERT INTO `orders_details` (`orders_id`, `produits_id`, `quantity`, `prix`) VALUES
(39, 2, 1, 110000),
(39, 4, 2, 68000),
(40, 2, 1, 110000),
(40, 3, 3, 87000),
(40, 5, 1, 78000),
(42, 1, 1, 98000),
(44, 1, 1, 98000),
(44, 4, 1, 68000),
(45, 2, 2, 110000),
(46, 3, 2, 87000),
(46, 6, 2, 150000),
(47, 6, 2, 150000),
(48, 7, 1, 130000),
(49, 7, 1, 130000),
(50, 7, 1, 130000),
(50, 8, 1, 75000),
(51, 1, 1, 98000);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `stock` int NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC27C54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `prix`, `stock`, `description`, `image`, `type_id`) VALUES
(1, 'IPHONE 10', 98000, 3, 'IphoneX : Découvrez l\'avenir de la technologie mobile avec l\'iPhone X, un bijou d\'ingénierie d\'Apple qui repousse les limites de l\'innovation. Avec un design épuré et des fonctionnalités avant-gardistes, cet appareil révolutionnaire offre une expérience u', 'product-item1.jpg', 1),
(2, 'IPHONE 11', 110000, 0, 'L\'iPhone 11, la dernière incarnation de l\'emblématique série d\'Apple, est conçu pour vous offrir une expérience mobile exceptionnelle. Doté de fonctionnalités de pointe, d\'une puissante puce et d\'une caméra perfectionnée, cet iPhone est l\'incarnation de l', 'product-item2.jpg', 1),
(3, 'PINK WATCH', 87000, 5, 'Découvrez la Montre Pink Watch, une fusion parfaite entre la sophistication et la modernité. Cette montre a été méticuleusement conçue pour la femme moderne qui recherche non seulement une manière pratique de rester à l\'heure, mais aussi un accessoire élé', 'product-item6.jpg', 2),
(4, 'HEAVY WATCH', 68000, 5, 'Faites une déclaration audacieuse avec la Heavy Watch, une montre conçue pour ceux qui apprécient la combinaison parfaite entre puissance et style. Cette montre imposante est un accessoire de choix pour ceux qui recherchent une pièce distinctive qui ne fa', 'product-item7.jpg', 2),
(5, 'IPHONE 8', 78000, 6, 'Découvrez l\'iPhone 8, une icône de fiabilité et de sophistication. Avec son design élégant et ses fonctionnalités avancées, cet iPhone incarne le mariage parfait entre style et performance.', 'product-item3.jpg', 1),
(6, 'IPHONE 13', 150000, 4, 'Plongez dans le futur de la technologie mobile avec l\'iPhone 13, une prouesse d\'ingénierie qui repousse les limites de la puissance, de la photographie et de la connectivité. Avec un design épuré et des fonctionnalités révolutionnaires, l\'iPhone 13 est co', 'product-item4.jpg', 1),
(7, 'SAMSUNG 12', 130000, 6, 'Découvrez le Samsung 12, une œuvre d\'art technologique qui allie performance de pointe et design élégant. Avec sa puissance inégalée, sa connectivité rapide, et son système de caméra avancé, le Samsung 12 élève votre expérience mobile à de nouveaux sommet', 'product-item5.jpg', 1),
(8, 'SPOTTED WATCH', 75000, 6, 'Une montre qui de manière surprenante, vous montre l\'heure.', 'product-item8.jpg', 2),
(9, 'BLACK WATCH', 65000, 3, 'Faites une déclaration audacieuse avec la Black Watch, une montre conçue pour ceux qui recherchent une fusion parfaite entre style sophistiqué et fonctionnalité de pointe. Cette montre noire emblématique est l\'accessoire idéal pour ceux qui apprécient la ', 'product-item9.jpg', 2),
(10, 'BLACK WATCH2', 75000, 2, 'C\'est la cousine de la Black Watch mais en plus sombre', 'product-item10.jpg', 2);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `nom`) VALUES
(1, 'Telephone'),
(2, 'Montre');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_tel` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_voie` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voie` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `livraison_fav` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `num_tel`, `num_voie`, `voie`, `ville`, `code_postal`, `livraison_fav`, `created_at`) VALUES
(2, 'momo@toto.fr', '[\"ROLE_USER\"]', '$2y$13$flbIpejuABDvbGw4jKWofebfQqWgm18FTA1S/ewwkb6VR.QmJFrAS', 'momo', 'toto', '0708091012', '34', 'rue des citrons', 'Saint-Saulve', '59880', 'Domicile', '2024-01-04 14:00:07'),
(3, 'jean@neymar.fr', '[\"ROLE_USER\"]', '$2y$13$YXl3aQLOzvHac3i5PMgkfOWrF7yw8XyaQ6jdNRXc7MP.W1IKsJRqG', 'Neymar', 'Jean', '0708091011', '22', 'rue Alfred momo', 'Onnaing', '59264', 'Domicile', '2024-01-08 12:20:57'),
(4, 'kevcarcel@yahoo.fr', '[\"ROLE_ADMIN\"]', '$2y$13$Fyl.YUnBTMZiKVA6CTD7X.KzV7rajtdzmTOM/kvV5Nlpw5cDL485G', 'Carcel', 'kevin', '0771897500', '2', 'rue de cambrai', 'Onnaing', '59264', 'Mondial Relay', '2024-01-25 08:43:07');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_E52FFDEEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `orders_details`
--
ALTER TABLE `orders_details`
  ADD CONSTRAINT `FK_835379F1CD11A2CF` FOREIGN KEY (`produits_id`) REFERENCES `produit` (`id`),
  ADD CONSTRAINT `FK_835379F1CFFE9AD6` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC27C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
