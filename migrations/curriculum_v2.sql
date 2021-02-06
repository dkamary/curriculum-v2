-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 06 fév. 2021 à 15:48
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `curriculum_v2`
--

-- --------------------------------------------------------

--
-- Structure de la table `applier`
--

DROP TABLE IF EXISTS `applier`;
CREATE TABLE `applier` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `proposal_id` int(10) UNSIGNED NOT NULL,
  `apply_date` datetime DEFAULT NULL,
  `is_validate` tinyint(1) DEFAULT NULL,
  `validate_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `asset`
--

DROP TABLE IF EXISTS `asset`;
CREATE TABLE `asset` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED DEFAULT NULL,
  `asset_type_id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `asset_type`
--

DROP TABLE IF EXISTS `asset_type`;
CREATE TABLE `asset_type` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `mime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extensions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `asset_type`
--

INSERT INTO `asset_type` (`id`, `mime`, `extensions`, `name`, `description`, `is_active`) VALUES
(1, 'image/jpeg', 'jpg jpeg', 'Image JPEG', NULL, 1),
(2, 'image/png', 'png', 'Portable Network Graphics (PNG)', NULL, 1),
(3, 'image/gif', 'gif', 'Graphics Interchange Format', NULL, 1),
(4, ' application/pdf', 'pdf', 'Adobe Portable Document Format', NULL, 1),
(5, ' application/xml', 'xml', 'XML - Extensible Markup Language', NULL, 1),
(6, 'application/json', 'json', 'JavaScript Object Notation (JSON)', NULL, 1),
(7, ' text/plain', 'txt text', 'Text File', NULL, 1),
(8, 'application/xhtml+xml', 'xhtml', 'XHTML - The Extensible HyperText Markup Language', NULL, 1),
(9, 'text/html', 'html htm', 'HyperText Markup Language (HTML)', NULL, 1),
(10, 'image/x-icon', 'ico', 'Icon Image', NULL, 1),
(11, 'application/javascript', 'js', 'JavaScript', NULL, 1),
(12, 'text/css', 'css', 'Cascading Style Sheets (CSS)', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `company_type`
--

DROP TABLE IF EXISTS `company_type`;
CREATE TABLE `company_type` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `company_type`
--

INSERT INTO `company_type` (`id`, `name`) VALUES
(4, 'Particulier'),
(3, 'SA: Société anonyme'),
(1, 'SARL: Société à responsabilité limitée'),
(2, 'SARL: Société à responsabilité limitée unipersonnelle');

-- --------------------------------------------------------

--
-- Structure de la table `contract_type`
--

DROP TABLE IF EXISTS `contract_type`;
CREATE TABLE `contract_type` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contract_type`
--

INSERT INTO `contract_type` (`id`, `name`, `is_active`) VALUES
(1, 'CDI: Contrat à Durée Indéterminé', 1),
(2, 'CDD: Contrat à Durée Déterminé', 1),
(3, 'Freelance', 1);

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alpha2` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alpha3` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`id`, `name`, `alpha2`, `alpha3`) VALUES
(4, 'Afghanistan', 'AF', 'AFG'),
(5, 'Albanie', 'AL', 'ALB'),
(6, 'Antarctique', 'AQ', 'ATA'),
(7, 'Algérie', 'DZ', 'DZA'),
(8, 'Samoa Américaines', 'AS', 'ASM'),
(9, 'Andorre', 'AD', 'AND'),
(10, 'Angola', 'AO', 'AGO'),
(11, 'Antigua-et-Barbuda', 'AG', 'ATG'),
(12, 'Azerbaïdjan', 'AZ', 'AZE'),
(13, 'Argentine', 'AR', 'ARG'),
(14, 'Australie', 'AU', 'AUS'),
(15, 'Autriche', 'AT', 'AUT'),
(16, 'Bahamas', 'BS', 'BHS'),
(17, 'Bahreïn', 'BH', 'BHR'),
(18, 'Bangladesh', 'BD', 'BGD'),
(19, 'Arménie', 'AM', 'ARM'),
(20, 'Barbade', 'BB', 'BRB'),
(21, 'Belgique', 'BE', 'BEL'),
(22, 'Bermudes', 'BM', 'BMU'),
(23, 'Bhoutan', 'BT', 'BTN'),
(24, 'Bolivie', 'BO', 'BOL'),
(25, 'Bosnie-Herzégovine', 'BA', 'BIH'),
(26, 'Botswana', 'BW', 'BWA'),
(27, 'Île Bouvet', 'BV', 'BVT'),
(28, 'Brésil', 'BR', 'BRA'),
(29, 'Belize', 'BZ', 'BLZ'),
(30, 'Territoire Britannique de l\'Océan Indien', 'IO', 'IOT'),
(31, 'Îles Salomon', 'SB', 'SLB'),
(32, 'Îles Vierges Britanniques', 'VG', 'VGB'),
(33, 'Brunéi Darussalam', 'BN', 'BRN'),
(34, 'Bulgarie', 'BG', 'BGR'),
(35, 'Myanmar', 'MM', 'MMR'),
(36, 'Burundi', 'BI', 'BDI'),
(37, 'Bélarus', 'BY', 'BLR'),
(38, 'Cambodge', 'KH', 'KHM'),
(39, 'Cameroun', 'CM', 'CMR'),
(40, 'Canada', 'CA', 'CAN'),
(41, 'Cap-vert', 'CV', 'CPV'),
(42, 'Îles Caïmanes', 'KY', 'CYM'),
(43, 'République Centrafricaine', 'CF', 'CAF'),
(44, 'Sri Lanka', 'LK', 'LKA'),
(45, 'Tchad', 'TD', 'TCD'),
(46, 'Chili', 'CL', 'CHL'),
(47, 'Chine', 'CN', 'CHN'),
(48, 'Taïwan', 'TW', 'TWN'),
(49, 'Île Christmas', 'CX', 'CXR'),
(50, 'Îles Cocos (Keeling)', 'CC', 'CCK'),
(51, 'Colombie', 'CO', 'COL'),
(52, 'Comores', 'KM', 'COM'),
(53, 'Mayotte', 'YT', 'MYT'),
(54, 'République du Congo', 'CG', 'COG'),
(55, 'République Démocratique du Congo', 'CD', 'COD'),
(56, 'Îles Cook', 'CK', 'COK'),
(57, 'Costa Rica', 'CR', 'CRI'),
(58, 'Croatie', 'HR', 'HRV'),
(59, 'Cuba', 'CU', 'CUB'),
(60, 'Chypre', 'CY', 'CYP'),
(61, 'République Tchèque', 'CZ', 'CZE'),
(62, 'Bénin', 'BJ', 'BEN'),
(63, 'Danemark', 'DK', 'DNK'),
(64, 'Dominique', 'DM', 'DMA'),
(65, 'République Dominicaine', 'DO', 'DOM'),
(66, 'Équateur', 'EC', 'ECU'),
(67, 'El Salvador', 'SV', 'SLV'),
(68, 'Guinée Équatoriale', 'GQ', 'GNQ'),
(69, 'Éthiopie', 'ET', 'ETH'),
(70, 'Érythrée', 'ER', 'ERI'),
(71, 'Estonie', 'EE', 'EST'),
(72, 'Îles Féroé', 'FO', 'FRO'),
(73, 'Îles (malvinas) Falkland', 'FK', 'FLK'),
(74, 'Géorgie du Sud et les Îles Sandwich du Sud', 'GS', 'SGS'),
(75, 'Fidji', 'FJ', 'FJI'),
(76, 'Finlande', 'FI', 'FIN'),
(77, 'Îles Åland', 'AX', 'ALA'),
(78, 'France', 'FR', 'FRA'),
(79, 'Guyane Française', 'GF', 'GUF'),
(80, 'Polynésie Française', 'PF', 'PYF'),
(81, 'Terres Australes Françaises', 'TF', 'ATF'),
(82, 'Djibouti', 'DJ', 'DJI'),
(83, 'Gabon', 'GA', 'GAB'),
(84, 'Géorgie', 'GE', 'GEO'),
(85, 'Gambie', 'GM', 'GMB'),
(86, 'Territoire Palestinien Occupé', 'PS', 'PSE'),
(87, 'Allemagne', 'DE', 'DEU'),
(88, 'Ghana', 'GH', 'GHA'),
(89, 'Gibraltar', 'GI', 'GIB'),
(90, 'Kiribati', 'KI', 'KIR'),
(91, 'Grèce', 'GR', 'GRC'),
(92, 'Groenland', 'GL', 'GRL'),
(93, 'Grenade', 'GD', 'GRD'),
(94, 'Guadeloupe', 'GP', 'GLP'),
(95, 'Guam', 'GU', 'GUM'),
(96, 'Guatemala', 'GT', 'GTM'),
(97, 'Guinée', 'GN', 'GIN'),
(98, 'Guyana', 'GY', 'GUY'),
(99, 'Haïti', 'HT', 'HTI'),
(100, 'Îles Heard et Mcdonald', 'HM', 'HMD'),
(101, 'Saint-Siège (état de la Cité du Vatican)', 'VA', 'VAT'),
(102, 'Honduras', 'HN', 'HND'),
(103, 'Hong-Kong', 'HK', 'HKG'),
(104, 'Hongrie', 'HU', 'HUN'),
(105, 'Islande', 'IS', 'ISL'),
(106, 'Inde', 'IN', 'IND'),
(107, 'Indonésie', 'ID', 'IDN'),
(108, 'République Islamique d\'Iran', 'IR', 'IRN'),
(109, 'Iraq', 'IQ', 'IRQ'),
(110, 'Irlande', 'IE', 'IRL'),
(111, 'Israël', 'IL', 'ISR'),
(112, 'Italie', 'IT', 'ITA'),
(113, 'Côte d\'Ivoire', 'CI', 'CIV'),
(114, 'Jamaïque', 'JM', 'JAM'),
(115, 'Japon', 'JP', 'JPN'),
(116, 'Kazakhstan', 'KZ', 'KAZ'),
(117, 'Jordanie', 'JO', 'JOR'),
(118, 'Kenya', 'KE', 'KEN'),
(119, 'République Populaire Démocratique de Corée', 'KP', 'PRK'),
(120, 'République de Corée', 'KR', 'KOR'),
(121, 'Koweït', 'KW', 'KWT'),
(122, 'Kirghizistan', 'KG', 'KGZ'),
(123, 'République Démocratique Populaire Lao', 'LA', 'LAO'),
(124, 'Liban', 'LB', 'LBN'),
(125, 'Lesotho', 'LS', 'LSO'),
(126, 'Lettonie', 'LV', 'LVA'),
(127, 'Libéria', 'LR', 'LBR'),
(128, 'Jamahiriya Arabe Libyenne', 'LY', 'LBY'),
(129, 'Liechtenstein', 'LI', 'LIE'),
(130, 'Lituanie', 'LT', 'LTU'),
(131, 'Luxembourg', 'LU', 'LUX'),
(132, 'Macao', 'MO', 'MAC'),
(133, 'Madagascar', 'MG', 'MDG'),
(134, 'Malawi', 'MW', 'MWI'),
(135, 'Malaisie', 'MY', 'MYS'),
(136, 'Maldives', 'MV', 'MDV'),
(137, 'Mali', 'ML', 'MLI'),
(138, 'Malte', 'MT', 'MLT'),
(139, 'Martinique', 'MQ', 'MTQ'),
(140, 'Mauritanie', 'MR', 'MRT'),
(141, 'Maurice', 'MU', 'MUS'),
(142, 'Mexique', 'MX', 'MEX'),
(143, 'Monaco', 'MC', 'MCO'),
(144, 'Mongolie', 'MN', 'MNG'),
(145, 'République de Moldova', 'MD', 'MDA'),
(146, 'Montserrat', 'MS', 'MSR'),
(147, 'Maroc', 'MA', 'MAR'),
(148, 'Mozambique', 'MZ', 'MOZ'),
(149, 'Oman', 'OM', 'OMN'),
(150, 'Namibie', 'NA', 'NAM'),
(151, 'Nauru', 'NR', 'NRU'),
(152, 'Népal', 'NP', 'NPL'),
(153, 'Pays-Bas', 'NL', 'NLD'),
(154, 'Antilles Néerlandaises', 'AN', 'ANT'),
(155, 'Aruba', 'AW', 'ABW'),
(156, 'Nouvelle-Calédonie', 'NC', 'NCL'),
(157, 'Vanuatu', 'VU', 'VUT'),
(158, 'Nouvelle-Zélande', 'NZ', 'NZL'),
(159, 'Nicaragua', 'NI', 'NIC'),
(160, 'Niger', 'NE', 'NER'),
(161, 'Nigéria', 'NG', 'NGA'),
(162, 'Niué', 'NU', 'NIU'),
(163, 'Île Norfolk', 'NF', 'NFK'),
(164, 'Norvège', 'NO', 'NOR'),
(165, 'Îles Mariannes du Nord', 'MP', 'MNP'),
(166, 'Îles Mineures Éloignées des États-Unis', 'UM', 'UMI'),
(167, 'États Fédérés de Micronésie', 'FM', 'FSM'),
(168, 'Îles Marshall', 'MH', 'MHL'),
(169, 'Palaos', 'PW', 'PLW'),
(170, 'Pakistan', 'PK', 'PAK'),
(171, 'Panama', 'PA', 'PAN'),
(172, 'Papouasie-Nouvelle-Guinée', 'PG', 'PNG'),
(173, 'Paraguay', 'PY', 'PRY'),
(174, 'Pérou', 'PE', 'PER'),
(175, 'Philippines', 'PH', 'PHL'),
(176, 'Pitcairn', 'PN', 'PCN'),
(177, 'Pologne', 'PL', 'POL'),
(178, 'Portugal', 'PT', 'PRT'),
(179, 'Guinée-Bissau', 'GW', 'GNB'),
(180, 'Timor-Leste', 'TL', 'TLS'),
(181, 'Porto Rico', 'PR', 'PRI'),
(182, 'Qatar', 'QA', 'QAT'),
(183, 'Réunion', 'RE', 'REU'),
(184, 'Roumanie', 'RO', 'ROU'),
(185, 'Fédération de Russie', 'RU', 'RUS'),
(186, 'Rwanda', 'RW', 'RWA'),
(187, 'Sainte-Hélène', 'SH', 'SHN'),
(188, 'Saint-Kitts-et-Nevis', 'KN', 'KNA'),
(189, 'Anguilla', 'AI', 'AIA'),
(190, 'Sainte-Lucie', 'LC', 'LCA'),
(191, 'Saint-Pierre-et-Miquelon', 'PM', 'SPM'),
(192, 'Saint-Vincent-et-les Grenadines', 'VC', 'VCT'),
(193, 'Saint-Marin', 'SM', 'SMR'),
(194, 'Sao Tomé-et-Principe', 'ST', 'STP'),
(195, 'Arabie Saoudite', 'SA', 'SAU'),
(196, 'Sénégal', 'SN', 'SEN'),
(197, 'Seychelles', 'SC', 'SYC'),
(198, 'Sierra Leone', 'SL', 'SLE'),
(199, 'Singapour', 'SG', 'SGP'),
(200, 'Slovaquie', 'SK', 'SVK'),
(201, 'Viet Nam', 'VN', 'VNM'),
(202, 'Slovénie', 'SI', 'SVN'),
(203, 'Somalie', 'SO', 'SOM'),
(204, 'Afrique du Sud', 'ZA', 'ZAF'),
(205, 'Zimbabwe', 'ZW', 'ZWE'),
(206, 'Espagne', 'ES', 'ESP'),
(207, 'Sahara Occidental', 'EH', 'ESH'),
(208, 'Soudan', 'SD', 'SDN'),
(209, 'Suriname', 'SR', 'SUR'),
(210, 'Svalbard etÎle Jan Mayen', 'SJ', 'SJM'),
(211, 'Swaziland', 'SZ', 'SWZ'),
(212, 'Suède', 'SE', 'SWE'),
(213, 'Suisse', 'CH', 'CHE'),
(214, 'République Arabe Syrienne', 'SY', 'SYR'),
(215, 'Tadjikistan', 'TJ', 'TJK'),
(216, 'Thaïlande', 'TH', 'THA'),
(217, 'Togo', 'TG', 'TGO'),
(218, 'Tokelau', 'TK', 'TKL'),
(219, 'Tonga', 'TO', 'TON'),
(220, 'Trinité-et-Tobago', 'TT', 'TTO'),
(221, 'Émirats Arabes Unis', 'AE', 'ARE'),
(222, 'Tunisie', 'TN', 'TUN'),
(223, 'Turquie', 'TR', 'TUR'),
(224, 'Turkménistan', 'TM', 'TKM'),
(225, 'Îles Turks et Caïques', 'TC', 'TCA'),
(226, 'Tuvalu', 'TV', 'TUV'),
(227, 'Ouganda', 'UG', 'UGA'),
(228, 'Ukraine', 'UA', 'UKR'),
(229, 'L\'ex-République Yougoslave de Macédoine', 'MK', 'MKD'),
(230, 'Égypte', 'EG', 'EGY'),
(231, 'Royaume-Uni', 'GB', 'GBR'),
(232, 'Île de Man', 'IM', 'IMN'),
(233, 'République-Unie de Tanzanie', 'TZ', 'TZA'),
(234, 'États-Unis', 'US', 'USA'),
(235, 'Îles Vierges des États-Unis', 'VI', 'VIR'),
(236, 'Burkina Faso', 'BF', 'BFA'),
(237, 'Uruguay', 'UY', 'URY'),
(238, 'Ouzbékistan', 'UZ', 'UZB'),
(239, 'Venezuela', 'VE', 'VEN'),
(240, 'Wallis et Futuna', 'WF', 'WLF'),
(241, 'Samoa', 'WS', 'WSM'),
(242, 'Yémen', 'YE', 'YEM'),
(243, 'Serbie-et-Monténégro', 'CS', 'SCG'),
(244, 'Zambie', 'ZM', 'ZMB');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20201130155157', '2020-11-30 16:53:30', 6966),
('DoctrineMigrations\\Version20201130171111', '2020-11-30 18:11:22', 103),
('DoctrineMigrations\\Version20201130213856', '2020-11-30 22:39:06', 331),
('DoctrineMigrations\\Version20201201001341', '2020-12-01 01:13:47', 183),
('DoctrineMigrations\\Version20201208155427', '2020-12-08 16:54:53', 794),
('DoctrineMigrations\\Version20201208155610', '2020-12-08 16:56:18', 369),
('DoctrineMigrations\\Version20201210114533', '2020-12-10 12:45:53', 221),
('DoctrineMigrations\\Version20201210122711', '2020-12-10 13:27:17', 88),
('DoctrineMigrations\\Version20201227231349', '2020-12-28 00:14:28', 833),
('DoctrineMigrations\\Version20210204083136', '2021-02-04 09:31:53', 90);

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

DROP TABLE IF EXISTS `experience`;
CREATE TABLE `experience` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `long_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `job_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `experience`
--

INSERT INTO `experience` (`id`, `owner_id`, `company`, `start`, `end`, `long_description`, `created_at`, `updated_at`, `job_title`) VALUES
(1, 1, 'JM-Contacts', '2013-03-01 00:00:00', '2020-01-18 00:00:00', 'Responsable des projets', '2020-12-01 01:18:04', '2020-12-01 01:22:16', ''),
(2, 1, 'DCLICK', '2009-08-20 00:00:00', '2013-02-28 00:00:00', 'Administrateur Parc informatique', '2020-12-01 08:03:40', NULL, ''),
(3, 1, 'IIS Madagascar', '2008-06-01 00:00:00', '2009-01-01 00:00:00', 'Developpeur Backend', '2020-12-01 08:38:23', NULL, ''),
(4, 18, 'Societe fictive', '2019-01-01 00:00:00', NULL, NULL, '2020-12-08 16:59:54', NULL, 'Poste fictive'),
(5, 20, 'Societe fictive', '2019-01-01 00:00:00', '2020-01-01 00:00:00', 'TESTIMONY', '2020-12-14 16:36:20', '2020-12-15 08:21:08', 'Poste fictive'),
(6, 19, 'Societe fictive', '2013-01-01 00:00:00', '2013-02-28 00:00:00', 'TEST', '2020-12-27 21:29:35', '2020-12-27 23:06:47', 'Poste fictif'),
(7, 19, 'Societe fictive II', '2012-01-01 00:00:00', '2012-12-31 00:00:00', 'TESTIMONY', '2020-12-27 21:41:39', NULL, 'Poste fictif II'),
(8, 19, 'Societe fictive III', '2013-03-01 00:00:00', '2020-01-18 00:00:00', 'TESTIMONY 3rd', '2020-12-27 21:49:35', NULL, 'Poste fictif III'),
(9, 21, 'Societe fictive', '2020-01-01 00:00:00', NULL, 'TEST', '2021-02-03 20:41:02', '2021-02-03 20:41:42', 'Poste fictif'),
(10, 21, 'Societe fictive II', '2021-01-01 00:00:00', NULL, 'TEST 2', '2021-02-03 20:42:46', NULL, 'Poste fictif II');

-- --------------------------------------------------------

--
-- Structure de la table `experience_skill`
--

DROP TABLE IF EXISTS `experience_skill`;
CREATE TABLE `experience_skill` (
  `id` int(10) UNSIGNED NOT NULL,
  `experience_id` int(10) UNSIGNED NOT NULL,
  `skill_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `experience_skill`
--

INSERT INTO `experience_skill` (`id`, `experience_id`, `skill_id`) VALUES
(4, 1, 8),
(5, 1, 9),
(1, 1, 51),
(3, 1, 53),
(2, 2, 29),
(7, 2, 30),
(8, 3, 8),
(6, 3, 52),
(31, 6, 8),
(30, 6, 22),
(28, 6, 51),
(29, 6, 53),
(35, 7, 11),
(34, 7, 12),
(33, 8, 29),
(37, 9, 34),
(38, 9, 35),
(39, 10, 24);

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `icon_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alpha2` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alpha3` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `language`
--

INSERT INTO `language` (`id`, `icon_id`, `name`, `alpha2`, `alpha3`, `is_active`) VALUES
(1, NULL, 'Français', 'fr', 'fra', 1),
(2, NULL, 'Anglais', 'en', 'eng', 1),
(3, NULL, 'Espagnol', 'es', 'esp', 1),
(4, NULL, 'Allemand', 'de', 'deu', 1),
(5, NULL, 'Japonais', 'ja', 'jpn', 1),
(6, NULL, 'Russe', 'ru', 'rus', 1),
(7, NULL, 'Chinois', 'zh', 'chi', 1),
(8, NULL, 'Italien', 'it', 'ita', 1),
(9, NULL, 'Coréen', 'ko', 'kor', 1),
(10, NULL, 'Créole', 'rc', 'rcf', 1);

-- --------------------------------------------------------

--
-- Structure de la table `language_knowledge`
--

DROP TABLE IF EXISTS `language_knowledge`;
CREATE TABLE `language_knowledge` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `language_id` smallint(5) UNSIGNED NOT NULL,
  `level_id` smallint(5) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `language_knowledge`
--

INSERT INTO `language_knowledge` (`id`, `owner_id`, `language_id`, `level_id`, `created_at`, `updated_at`) VALUES
(1, 19, 1, 4, '2021-02-03 22:29:41', NULL),
(2, 19, 2, 2, '2021-02-03 22:29:54', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `language_level`
--

DROP TABLE IF EXISTS `language_level`;
CREATE TABLE `language_level` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` smallint(5) UNSIGNED NOT NULL,
  `rank` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `language_level`
--

INSERT INTO `language_level` (`id`, `name`, `score`, `rank`) VALUES
(1, 'débutant', 1, 1),
(2, 'intermédiaire', 2, 2),
(3, 'courant', 3, 3),
(4, 'bilingue', 4, 4),
(5, 'langue maternelle', 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `nationality`
--

DROP TABLE IF EXISTS `nationality`;
CREATE TABLE `nationality` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `country_id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `nationality`
--

INSERT INTO `nationality` (`id`, `country_id`, `name`) VALUES
(1, 4, 'Afghanistan'),
(2, 204, 'Afrique du Sud'),
(3, 5, 'Albanie'),
(4, 7, 'Algérie'),
(5, 87, 'Allemagne'),
(6, 9, 'Andorre'),
(7, 10, 'Angola'),
(8, 189, 'Anguilla'),
(9, 6, 'Antarctique'),
(10, 11, 'Antigua-et-Barbuda'),
(11, 154, 'Antilles Néerlandaises'),
(12, 195, 'Arabie Saoudite'),
(13, 13, 'Argentine'),
(14, 19, 'Arménie'),
(15, 155, 'Aruba'),
(16, 14, 'Australie'),
(17, 15, 'Autriche'),
(18, 12, 'Azerbaïdjan'),
(19, 16, 'Bahamas'),
(20, 17, 'Bahreïn'),
(21, 18, 'Bangladesh'),
(22, 20, 'Barbade'),
(23, 37, 'Bélarus'),
(24, 21, 'Belgique'),
(25, 29, 'Belize'),
(26, 62, 'Bénin'),
(27, 22, 'Bermudes'),
(28, 23, 'Bhoutan'),
(29, 24, 'Bolivie'),
(30, 25, 'Bosnie-Herzégovine'),
(31, 26, 'Botswana'),
(32, 28, 'Brésil'),
(33, 33, 'Brunéi Darussalam'),
(34, 34, 'Bulgarie'),
(35, 236, 'Burkina Faso'),
(36, 36, 'Burundi'),
(37, 38, 'Cambodge'),
(38, 39, 'Cameroun'),
(39, 40, 'Canada'),
(40, 41, 'Cap-vert'),
(41, 46, 'Chili'),
(42, 47, 'Chine'),
(43, 60, 'Chypre'),
(44, 51, 'Colombie'),
(45, 52, 'Comores'),
(46, 57, 'Costa Rica'),
(47, 113, 'Côte d\'Ivoire'),
(48, 58, 'Croatie'),
(49, 59, 'Cuba'),
(50, 63, 'Danemark'),
(51, 82, 'Djibouti'),
(52, 64, 'Dominique'),
(53, 230, 'Égypte'),
(54, 67, 'El Salvador'),
(55, 221, 'Émirats Arabes Unis'),
(56, 66, 'Équateur'),
(57, 70, 'Érythrée'),
(58, 206, 'Espagne'),
(59, 71, 'Estonie'),
(60, 167, 'États Fédérés de Micronésie'),
(61, 234, 'États-Unis'),
(62, 69, 'Éthiopie'),
(63, 185, 'Fédération de Russie'),
(64, 75, 'Fidji'),
(65, 76, 'Finlande'),
(66, 78, 'France'),
(67, 83, 'Gabon'),
(68, 85, 'Gambie'),
(69, 84, 'Géorgie'),
(70, 74, 'Géorgie du Sud et les Îles Sandwich du Sud'),
(71, 88, 'Ghana'),
(72, 89, 'Gibraltar'),
(73, 91, 'Grèce'),
(74, 93, 'Grenade'),
(75, 92, 'Groenland'),
(76, 94, 'Guadeloupe'),
(77, 95, 'Guam'),
(78, 96, 'Guatemala'),
(79, 97, 'Guinée'),
(80, 68, 'Guinée Équatoriale'),
(81, 179, 'Guinée-Bissau'),
(82, 98, 'Guyana'),
(83, 79, 'Guyane Française'),
(84, 99, 'Haïti'),
(85, 102, 'Honduras'),
(86, 103, 'Hong-Kong'),
(87, 104, 'Hongrie'),
(88, 27, 'Île Bouvet'),
(89, 49, 'Île Christmas'),
(90, 232, 'Île de Man'),
(91, 163, 'Île Norfolk'),
(92, 73, 'Îles (malvinas) Falkland'),
(93, 77, 'Îles Åland'),
(94, 42, 'Îles Caïmanes'),
(95, 50, 'Îles Cocos (Keeling)'),
(96, 56, 'Îles Cook'),
(97, 72, 'Îles Féroé'),
(98, 100, 'Îles Heard et Mcdonald'),
(99, 165, 'Îles Mariannes du Nord'),
(100, 168, 'Îles Marshall'),
(101, 166, 'Îles Mineures Éloignées des États-Unis'),
(102, 31, 'Îles Salomon'),
(103, 225, 'Îles Turks et Caïques'),
(104, 32, 'Îles Vierges Britanniques'),
(105, 235, 'Îles Vierges des États-Unis'),
(106, 106, 'Inde'),
(107, 107, 'Indonésie'),
(108, 109, 'Iraq'),
(109, 110, 'Irlande'),
(110, 105, 'Islande'),
(111, 111, 'Israël'),
(112, 112, 'Italie'),
(113, 128, 'Jamahiriya Arabe Libyenne'),
(114, 114, 'Jamaïque'),
(115, 115, 'Japon'),
(116, 117, 'Jordanie'),
(117, 116, 'Kazakhstan'),
(118, 118, 'Kenya'),
(119, 122, 'Kirghizistan'),
(120, 90, 'Kiribati'),
(121, 121, 'Koweït'),
(122, 229, 'L\'ex-République Yougoslave de Macédoine'),
(123, 125, 'Lesotho'),
(124, 126, 'Lettonie'),
(125, 124, 'Liban'),
(126, 127, 'Libéria'),
(127, 129, 'Liechtenstein'),
(128, 130, 'Lituanie'),
(129, 131, 'Luxembourg'),
(130, 132, 'Macao'),
(131, 133, 'Madagascar'),
(132, 135, 'Malaisie'),
(133, 134, 'Malawi'),
(134, 136, 'Maldives'),
(135, 137, 'Mali'),
(136, 138, 'Malte'),
(137, 147, 'Maroc'),
(138, 139, 'Martinique'),
(139, 141, 'Maurice'),
(140, 140, 'Mauritanie'),
(141, 53, 'Mayotte'),
(142, 142, 'Mexique'),
(143, 143, 'Monaco'),
(144, 144, 'Mongolie'),
(145, 146, 'Montserrat'),
(146, 148, 'Mozambique'),
(147, 35, 'Myanmar'),
(148, 150, 'Namibie'),
(149, 151, 'Nauru'),
(150, 152, 'Népal'),
(151, 159, 'Nicaragua'),
(152, 160, 'Niger'),
(153, 161, 'Nigéria'),
(154, 162, 'Niué'),
(155, 164, 'Norvège'),
(156, 156, 'Nouvelle-Calédonie'),
(157, 158, 'Nouvelle-Zélande'),
(158, 149, 'Oman'),
(159, 227, 'Ouganda'),
(160, 238, 'Ouzbékistan'),
(161, 170, 'Pakistan'),
(162, 169, 'Palaos'),
(163, 171, 'Panama'),
(164, 172, 'Papouasie-Nouvelle-Guinée'),
(165, 173, 'Paraguay'),
(166, 153, 'Pays-Bas'),
(167, 174, 'Pérou'),
(168, 175, 'Philippines'),
(169, 176, 'Pitcairn'),
(170, 177, 'Pologne'),
(171, 80, 'Polynésie Française'),
(172, 181, 'Porto Rico'),
(173, 178, 'Portugal'),
(174, 182, 'Qatar'),
(175, 214, 'République Arabe Syrienne'),
(176, 43, 'République Centrafricaine'),
(177, 120, 'République de Corée'),
(178, 145, 'République de Moldova'),
(179, 55, 'République Démocratique du Congo'),
(180, 123, 'République Démocratique Populaire Lao'),
(181, 65, 'République Dominicaine'),
(182, 54, 'République du Congo'),
(183, 108, 'République Islamique d\'Iran'),
(184, 119, 'République Populaire Démocratique de Corée'),
(185, 61, 'République Tchèque'),
(186, 233, 'République-Unie de Tanzanie'),
(187, 183, 'Réunion'),
(188, 184, 'Roumanie'),
(189, 231, 'Royaume-Uni'),
(190, 186, 'Rwanda'),
(191, 207, 'Sahara Occidental'),
(192, 188, 'Saint-Kitts-et-Nevis'),
(193, 193, 'Saint-Marin'),
(194, 191, 'Saint-Pierre-et-Miquelon'),
(195, 101, 'Saint-Siège (état de la Cité du Vatican)'),
(196, 192, 'Saint-Vincent-et-les Grenadines'),
(197, 187, 'Sainte-Hélène'),
(198, 190, 'Sainte-Lucie'),
(199, 241, 'Samoa'),
(200, 8, 'Samoa Américaines'),
(201, 194, 'Sao Tomé-et-Principe'),
(202, 196, 'Sénégal'),
(203, 243, 'Serbie-et-Monténégro'),
(204, 197, 'Seychelles'),
(205, 198, 'Sierra Leone'),
(206, 199, 'Singapour'),
(207, 200, 'Slovaquie'),
(208, 202, 'Slovénie'),
(209, 203, 'Somalie'),
(210, 208, 'Soudan'),
(211, 44, 'Sri Lanka'),
(212, 212, 'Suède'),
(213, 213, 'Suisse'),
(214, 209, 'Suriname'),
(215, 210, 'Svalbard etÎle Jan Mayen'),
(216, 211, 'Swaziland'),
(217, 215, 'Tadjikistan'),
(218, 48, 'Taïwan'),
(219, 45, 'Tchad'),
(220, 81, 'Terres Australes Françaises'),
(221, 30, 'Territoire Britannique de l\'Océan Indien'),
(222, 86, 'Territoire Palestinien Occupé'),
(223, 216, 'Thaïlande'),
(224, 180, 'Timor-Leste'),
(225, 217, 'Togo'),
(226, 218, 'Tokelau'),
(227, 219, 'Tonga'),
(228, 220, 'Trinité-et-Tobago'),
(229, 222, 'Tunisie'),
(230, 224, 'Turkménistan'),
(231, 223, 'Turquie'),
(232, 226, 'Tuvalu'),
(233, 228, 'Ukraine'),
(234, 237, 'Uruguay'),
(235, 157, 'Vanuatu'),
(236, 239, 'Venezuela'),
(237, 201, 'Viet Nam'),
(238, 240, 'Wallis et Futuna'),
(239, 242, 'Yémen'),
(240, 244, 'Zambie'),
(241, 205, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Structure de la table `other`
--

DROP TABLE IF EXISTS `other`;
CREATE TABLE `other` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `other`
--

INSERT INTO `other` (`id`, `owner_id`, `created_at`, `updated_at`) VALUES
(1, 19, '2020-12-29 07:06:01', NULL),
(2, 19, '2020-12-29 07:06:12', NULL),
(3, 19, '2020-12-29 07:11:32', NULL),
(4, 19, '2020-12-29 07:12:06', NULL),
(5, 19, '2020-12-29 07:16:56', NULL),
(6, 19, '2020-12-29 07:17:20', NULL),
(7, 19, '2020-12-29 07:17:33', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `other_skill`
--

DROP TABLE IF EXISTS `other_skill`;
CREATE TABLE `other_skill` (
  `id` int(10) UNSIGNED NOT NULL,
  `other_id` int(10) UNSIGNED NOT NULL,
  `skill_id` smallint(5) UNSIGNED NOT NULL,
  `level_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `other_skill`
--

INSERT INTO `other_skill` (`id`, `other_id`, `skill_id`, `level_id`) VALUES
(1, 1, 8, 3),
(2, 2, 51, 3),
(3, 3, 22, 3),
(4, 4, 24, 2),
(5, 5, 10, 2),
(6, 6, 44, 1),
(7, 7, 45, 2);

-- --------------------------------------------------------

--
-- Structure de la table `proposal`
--

DROP TABLE IF EXISTS `proposal`;
CREATE TABLE `proposal` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `featured_image_id` int(10) UNSIGNED DEFAULT NULL,
  `banner_image_id` int(10) UNSIGNED DEFAULT NULL,
  `long_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `proposal_attachment`
--

DROP TABLE IF EXISTS `proposal_attachment`;
CREATE TABLE `proposal_attachment` (
  `id` int(10) UNSIGNED NOT NULL,
  `proposal_id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `proposal_favorite`
--

DROP TABLE IF EXISTS `proposal_favorite`;
CREATE TABLE `proposal_favorite` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `proposal_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE `skill` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `category_id` smallint(5) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `skill`
--

INSERT INTO `skill` (`id`, `category_id`, `name`, `description`) VALUES
(8, 1, 'PHP', NULL),
(9, 1, 'Javascript', NULL),
(10, 1, 'Java', NULL),
(11, 1, 'C sharp', NULL),
(12, 1, 'ASP.NET', NULL),
(13, 1, 'C/C++', NULL),
(14, 1, 'Python', NULL),
(22, 2, 'Symfony', NULL),
(23, 2, 'Zend Framework', NULL),
(24, 2, 'Laravel', NULL),
(25, 2, 'Spring', NULL),
(26, 2, 'Java SE', NULL),
(27, 2, 'Java ME', NULL),
(28, 2, 'Maven', NULL),
(29, 3, 'Maintenance Informatique', NULL),
(30, 3, 'Saisie Informatique', NULL),
(34, 4, 'Microsoft Word', NULL),
(35, 4, 'Microsoft Excel', NULL),
(36, 4, 'Microsoft Powerpoint', NULL),
(37, 5, 'Ciel Compta', NULL),
(38, 5, 'Sage SAARI', NULL),
(39, 6, 'Adobe Premiere', NULL),
(40, 6, 'Adobe After Effect', NULL),
(41, 7, 'Adobe Illustrator', NULL),
(42, 7, 'Figma', NULL),
(43, 7, 'Inkscape', NULL),
(44, 8, 'Adobe Photoshop', NULL),
(45, 8, 'Gimp', NULL),
(46, 8, 'Paint', NULL),
(47, 9, 'Audacity', NULL),
(48, 9, 'Adobe Audition', NULL),
(49, 10, 'UML', NULL),
(50, 10, 'MERISE', NULL),
(51, 11, 'WordPress', NULL),
(52, 11, 'Joomla', NULL),
(53, 11, 'Prestashop', NULL),
(54, 11, 'Drupal', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `skill_category`
--

DROP TABLE IF EXISTS `skill_category`;
CREATE TABLE `skill_category` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `icon_id` int(10) UNSIGNED DEFAULT NULL,
  `banner_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `skill_category`
--

INSERT INTO `skill_category` (`id`, `icon_id`, `banner_id`, `name`, `description`) VALUES
(1, NULL, NULL, 'Langage de programmation', NULL),
(2, NULL, NULL, 'Framework', NULL),
(3, NULL, NULL, 'Informatique', NULL),
(4, NULL, NULL, 'Logiciel bureautique', NULL),
(5, NULL, NULL, 'Logiciel Comptabilité', NULL),
(6, NULL, NULL, 'Logiciel Montage vidéo', ''),
(7, NULL, NULL, 'Logiciel dessin vectoriel', NULL),
(8, NULL, NULL, 'Logiciel dessin matriciel', NULL),
(9, NULL, NULL, 'Logiciel de montage audio', NULL),
(10, NULL, NULL, 'Méthode d\'analyse', NULL),
(11, NULL, NULL, 'CMS', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `skill_level`
--

DROP TABLE IF EXISTS `skill_level`;
CREATE TABLE `skill_level` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` smallint(5) UNSIGNED NOT NULL,
  `rank` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `skill_level`
--

INSERT INTO `skill_level` (`id`, `name`, `score`, `rank`) VALUES
(1, 'débutant', 1, 1),
(2, 'intermédiaire', 2, 2),
(3, 'avancé', 3, 3),
(4, 'expert', 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `training`
--

DROP TABLE IF EXISTS `training`;
CREATE TABLE `training` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `school` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diploma` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `training`
--

INSERT INTO `training` (`id`, `owner_id`, `school`, `diploma`, `note`, `start`, `end`, `created_at`, `updated_at`) VALUES
(5, 19, 'ESP BIG', 'Licence en informatique', 'Option: Génie Logiciel', '2018-01-01 00:00:00', '2020-12-31 00:00:00', '2021-02-04 09:08:27', '2021-02-04 09:08:41');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type_id` smallint(5) UNSIGNED DEFAULT NULL,
  `company_type_id` smallint(5) UNSIGNED DEFAULT NULL,
  `nationality_id` smallint(5) UNSIGNED DEFAULT NULL,
  `country_id` smallint(5) UNSIGNED DEFAULT NULL,
  `language_id` smallint(5) UNSIGNED DEFAULT NULL,
  `avatar_id` int(10) UNSIGNED DEFAULT NULL,
  `banner_id` int(10) UNSIGNED DEFAULT NULL,
  `login` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` smallint(6) DEFAULT NULL,
  `firstname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `birthplace` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualities` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interests` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `user_type_id`, `company_type_id`, `nationality_id`, `country_id`, `language_id`, `avatar_id`, `banner_id`, `login`, `email`, `password`, `gender`, `firstname`, `lastname`, `birthdate`, `birthplace`, `address`, `zipcode`, `town`, `created_at`, `updated_at`, `deleted_at`, `is_active`, `phone`, `qualities`, `interests`) VALUES
(1, 2, 4, 131, 133, 1, NULL, NULL, 'candidate1', 'candidate1@yopmail.com', '$2y$13$7BegtLcWg7v0ZN5SfxZNCep1Nynw0IbdXydhZtFyRMhSRR1AAESq2', 1, 'Candidate #1', 'TEST', '2000-01-01', 'Lieu fictif', '123 Adresse fictive', '123456', 'Ville fictive', '2020-11-30 23:01:43', '2020-12-01 00:26:46', NULL, 1, NULL, NULL, NULL),
(2, 2, 4, 131, 133, 1, NULL, NULL, 'candidate2', 'candidate2@yopmail.com', '$2y$13$mlb9N1kh8L3oStND17BY2O.1REE.QCDbEPb0l5H3G3L0EA2RGUTd.', 1, 'Candidate #2', 'TEST', '2000-01-01', 'Lieu fictif', 'Adresse fictive', '123456', 'Ville fictive', '2020-11-30 23:24:34', NULL, NULL, 1, NULL, NULL, NULL),
(3, 2, 4, 131, NULL, 1, NULL, NULL, 'dummy1', 'dummy1@yopmail.com', '123', 1, 'Dummy 1', 'TESTER', '2000-12-10', 'Lieu fictif', NULL, NULL, NULL, '2020-12-07 23:14:08', NULL, NULL, 1, NULL, NULL, NULL),
(5, 2, 4, 131, NULL, 1, NULL, NULL, 'dummy2', 'dummy2@yopmail.com', '$2y$13$gvTUBbg8pM/uuG.Y5D.pIu3fBUNeL6csazKk8ig5WzQo85Gs.HPtW', 1, 'Dummy 2', 'TESTER', '2000-12-10', 'Lieu fictif', NULL, NULL, NULL, '2020-12-07 23:19:32', NULL, NULL, 1, NULL, NULL, NULL),
(6, 2, 4, 131, NULL, 1, NULL, NULL, 'dummy3', 'dummy3@yopmail.com', '$2y$13$njrvQbEndQhEFGnaV.4CrewpY.Gv.tcgPKOie.EJ2hg4AkIQLhS9u', 1, 'Dummy 3', 'TESTER', '2000-12-10', 'Lieu fictif', NULL, NULL, NULL, '2020-12-07 23:30:29', NULL, NULL, 1, NULL, NULL, NULL),
(7, 2, 4, 131, NULL, 1, NULL, NULL, 'dummy4', 'dummy4@yopmail.com', '$2y$13$EazRq.nGdgUc/t.74Q6xCe1sAMLbV3gZdGF9r2IpUWfIoqfBRHok.', 1, 'Dummy 4', 'TESTER', '2000-01-01', 'Lieu fictif', NULL, NULL, NULL, '2020-12-08 00:02:42', NULL, NULL, 1, NULL, NULL, NULL),
(8, 2, 4, 131, NULL, 1, NULL, NULL, 'dummy5', 'dummy5@yopmail.com', '$2y$13$rf3KMCaHnFpeuhjQhooPp.Xuwf8q5cJx7a62r7k54tu.x34omwex.', 1, 'Dummy 5', 'TEST', '2000-01-01', 'Lieu fictif', NULL, NULL, NULL, '2020-12-08 00:37:19', NULL, NULL, 1, NULL, NULL, NULL),
(9, 2, 4, 131, NULL, 1, NULL, NULL, 'dummy6', 'dummy6@yopmail.com', '$2y$13$x4QKfLrE0EzDB1CAj8PRGetZjXVKQSZQO4lHAeuj7XXT5iCKk4CAm', 1, 'Dummy 6', 'TESTER', '2000-01-01', 'Lieu fictif', NULL, NULL, NULL, '2020-12-08 00:41:32', NULL, NULL, 1, NULL, NULL, NULL),
(10, 2, 4, 131, NULL, 1, NULL, NULL, 'dummy7', 'dummy7@yopmail.com', '$2y$13$UAPjc1DBo8PYfo43XkRCEeyDkhUQ1eGxWyFHv2V0bZqRbXmVkF1Qu', 1, 'Dummy 7', 'TESTER', '2000-01-01', 'Lieu fictif', NULL, NULL, NULL, '2020-12-08 00:49:51', NULL, NULL, 1, NULL, NULL, NULL),
(12, 2, 4, 131, 133, 1, NULL, NULL, 'dummy8', 'dummy8@yopmail.com', '$2y$13$7voLVdDgIjcu5uD1IOH9BOp7PIdqBQ5BEUQG0pYck72/8QZAqtLOC', 1, 'Dummy 8', 'TESTER', '2000-01-01', 'Lieu fictif', '155 A bis Antanetibe Antehiroka', '105', 'Antananarivo', '2020-12-08 01:01:30', '2020-12-08 01:02:22', NULL, 1, NULL, NULL, NULL),
(13, 2, 4, 131, 132, 1, NULL, NULL, 'dummy9', 'dummy9@yopmail.com', '$2y$13$AYGUR0VWe7Lubmr/gb6nc.yO06zyp8YB5y6WFPYQYgDGJPN1NObCe', 1, 'Dummy 9', 'TESTER', '2000-01-01', 'Lieu fictif', '155 A bis Antanetibe Antehiroka', '105', 'Antananarivo', '2020-12-08 09:43:57', '2020-12-08 09:44:40', NULL, 1, NULL, NULL, NULL),
(14, 2, 4, 131, 133, 1, NULL, NULL, 'dummy10', 'dummy10@yopmail.com', '$2y$13$.yJ4i3MrIpXL2qHE8HVylO8jTpDhPp4gBgLRncEURkFrAhqwEYvZW', 1, 'Dummy 10', 'TESTER', '2000-01-01', 'Lieu fictif', 'Adresse fictive', '123456', 'Ville fictive', '2020-12-08 09:58:25', '2020-12-08 09:59:04', NULL, 1, NULL, NULL, NULL),
(15, 2, 4, 131, NULL, 1, NULL, NULL, 'dummy11', 'dummy11@yopmail.com', '$2y$13$yvtaslz3D7qyvsR60V.N9OFrQXdwqinIt6T2J/tQdxNt5XiXmFp6O', 1, 'Dummy 11', 'TESTER', '2000-01-01', 'Lieu fictif', NULL, NULL, NULL, '2020-12-08 10:01:15', NULL, NULL, 1, NULL, NULL, NULL),
(16, 2, 4, 131, 4, 1, NULL, NULL, 'dummy12', 'dummy12@yopmail.com', '$2y$13$uCsPlAyl5ui3zmWXMF29qOvARVRPzRRpgR4QfBZYxQ8NUkoKNTY.i', 1, 'Dummy 12', 'TESTER', '2000-01-01', 'Lieu fictif', 'Adresse fictive', '123456', 'Ville fictive', '2020-12-08 10:03:06', '2020-12-08 10:04:53', NULL, 1, NULL, NULL, NULL),
(17, 2, 4, 131, 7, 1, NULL, NULL, 'dummy13', 'dummy13@yopmail.com', '$2y$13$1gWCq29oeatLJ0w1WIf0MubLW/xeVnRYC2KJCQwQKKui2GyVpX1PS', 1, 'Dummy 13', 'TESTER', '2000-01-01', 'Lieu fictif', 'Adresse fictive', '123456', 'Ville fictive', '2020-12-08 16:31:32', '2020-12-08 16:31:55', NULL, 1, NULL, NULL, NULL),
(18, 2, 4, 131, NULL, 1, NULL, NULL, 'dummy14', 'dummy14@yopmail.com', '$2y$13$cVeWmWrujqAdA2NBXvIg2elrta1NV5ifXIqbiHit45DaJP.58KiTe', 1, 'Dummy 14', 'TESTER', '2000-01-01', 'Lieu fictif', NULL, NULL, NULL, '2020-12-08 16:51:08', NULL, NULL, 1, NULL, NULL, NULL),
(19, 2, 4, 131, 133, 1, NULL, NULL, 'user1', 'user1@yopmail.com', '$2y$13$nqhYhSMC99Y3E/hRUgKlLeQ2Xxchye/qYKxfMuFK97ynf5/h3pRwm', 1, 'User One', 'TEST', '2000-01-01', 'Lieu fictif', 'Adresse fictive', '123456', 'Ville fictive', '2020-12-14 13:06:08', '2020-12-27 17:51:32', NULL, 1, '+261 34 09 129 01', 'Curieux, Autonome, Réactif ', 'Basketball, Musculation, Développement de jeux vidéo'),
(20, 2, 4, 131, 133, 1, NULL, NULL, 'user2', 'user2@yopmail.com', '$2y$13$gsID1.D4Mts9yBdzcV4GFeHkmYtIHkw2s1rIF9POY2/tPrZkdC3DS', 1, 'User Two', 'TEST', '2000-01-01', 'Lieu fictif', 'Adresse fictive', '123456', 'Ville fictive', '2020-12-14 13:08:58', '2020-12-14 13:35:40', NULL, 1, NULL, NULL, NULL),
(21, 2, 4, 131, 133, 1, NULL, NULL, 'user3', 'user3@yopmail.com', '$2y$13$3XyP.Gvj96tT3.5UNOMY8eseVJqGVoWwKyheMbeaxSUlYoyv.MKfO', 1, 'Candidat 3', 'TEST', '2000-01-01', 'Lieu fictif', 'Adresse fictive', '123456', 'Ville fictive', '2021-02-03 20:34:46', '2021-02-03 20:37:55', NULL, 1, NULL, NULL, NULL),
(22, 3, 2, 61, NULL, 2, NULL, NULL, 'moukary', 'moukary@yopmail.com', '$2y$13$MKG1wSjx1i4HazSuRQsu1..wsfodKQVrO8iML8WTfZsWAFiyfKo2a', 1, 'Matt', 'Murdock', '1970-01-01', 'Marvel Comics', NULL, NULL, NULL, '2021-02-04 13:48:24', NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_attachment`
--

DROP TABLE IF EXISTS `user_attachment`;
CREATE TABLE `user_attachment` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_destination`
--

DROP TABLE IF EXISTS `user_destination`;
CREATE TABLE `user_destination` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `country_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_destination`
--

INSERT INTO `user_destination` (`id`, `owner_id`, `country_id`) VALUES
(2, 19, 78),
(1, 19, 141);

-- --------------------------------------------------------

--
-- Structure de la table `user_favorite`
--

DROP TABLE IF EXISTS `user_favorite`;
CREATE TABLE `user_favorite` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `favorite_user_id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_motivation`
--

DROP TABLE IF EXISTS `user_motivation`;
CREATE TABLE `user_motivation` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `contract_id` smallint(5) UNSIGNED NOT NULL,
  `presentation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_traveller` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_motivation`
--

INSERT INTO `user_motivation` (`id`, `owner_id`, `contract_id`, `presentation`, `is_traveller`) VALUES
(1, 19, 2, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptates doloribus recusandae qui magnam rerum quas harum laudantium laborum? Voluptatem pariatur expedita cum repellat eaque autem suscipit incidunt nesciunt, a rerum.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_stat`
--

DROP TABLE IF EXISTS `user_stat`;
CREATE TABLE `user_stat` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `viewed` int(10) UNSIGNED NOT NULL,
  `searched` int(10) UNSIGNED NOT NULL,
  `last_connection` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `description`, `is_active`) VALUES
(1, 'Administrateur', NULL, 1),
(2, 'Candidat', NULL, 1),
(3, 'Société', NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `applier`
--
ALTER TABLE `applier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `U_applier_owner_proposal` (`owner_id`,`proposal_id`),
  ADD KEY `IDX_D22A42C77E3C61F9` (`owner_id`),
  ADD KEY `IDX_D22A42C7F4792058` (`proposal_id`);

--
-- Index pour la table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2AF5A5CB548B0F` (`path`),
  ADD KEY `IDX_2AF5A5C7E3C61F9` (`owner_id`),
  ADD KEY `IDX_2AF5A5CA6A2CDC5` (`asset_type_id`);

--
-- Index pour la table `asset_type`
--
ALTER TABLE `asset_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_68BA92E15E237E06` (`name`);

--
-- Index pour la table `company_type`
--
ALTER TABLE `company_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CFB34DC75E237E06` (`name`);

--
-- Index pour la table `contract_type`
--
ALTER TABLE `contract_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E4AB19415E237E06` (`name`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5373C9665E237E06` (`name`),
  ADD UNIQUE KEY `UNIQ_5373C966B762D672` (`alpha2`),
  ADD UNIQUE KEY `UNIQ_5373C966C065E6E4` (`alpha3`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_590C1037E3C61F9` (`owner_id`),
  ADD KEY `IDX_experience_start` (`start`),
  ADD KEY `IDX_experience_end` (`end`),
  ADD KEY `IDX_experience_start_end` (`start`,`end`),
  ADD KEY `IDX_experience_company` (`company`);
ALTER TABLE `experience` ADD FULLTEXT KEY `IDX_experience_description` (`long_description`);

--
-- Index pour la table `experience_skill`
--
ALTER TABLE `experience_skill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `U_user_exp_skill` (`experience_id`,`skill_id`),
  ADD KEY `IDX_3D6F986146E90E27` (`experience_id`),
  ADD KEY `IDX_3D6F98615585C142` (`skill_id`);

--
-- Index pour la table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D4DB71B55E237E06` (`name`),
  ADD UNIQUE KEY `UNIQ_D4DB71B5B762D672` (`alpha2`),
  ADD UNIQUE KEY `UNIQ_D4DB71B5C065E6E4` (`alpha3`),
  ADD KEY `IDX_D4DB71B554B9D732` (`icon_id`);

--
-- Index pour la table `language_knowledge`
--
ALTER TABLE `language_knowledge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_586755F77E3C61F9` (`owner_id`),
  ADD KEY `IDX_586755F75FB14BA7` (`level_id`),
  ADD KEY `IDX_586755F782F1BAF4` (`language_id`);

--
-- Index pour la table `language_level`
--
ALTER TABLE `language_level`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E5B2C8425E237E06` (`name`);

--
-- Index pour la table `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8AC58B705E237E06` (`name`),
  ADD KEY `IDX_8AC58B70F92F3E70` (`country_id`);

--
-- Index pour la table `other`
--
ALTER TABLE `other`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D95835207E3C61F9` (`owner_id`);

--
-- Index pour la table `other_skill`
--
ALTER TABLE `other_skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_368913D9998D9879` (`other_id`),
  ADD KEY `IDX_368913D95585C142` (`skill_id`),
  ADD KEY `IDX_368913D95FB14BA7` (`level_id`);

--
-- Index pour la table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BFE594727E3C61F9` (`owner_id`),
  ADD KEY `IDX_BFE594723569D950` (`featured_image_id`),
  ADD KEY `IDX_BFE594723F9CEB4E` (`banner_image_id`),
  ADD KEY `IDX_proposal_start` (`start`),
  ADD KEY `IDX_proposal_end` (`end`),
  ADD KEY `IDX_proposal_start_end` (`start`,`end`);
ALTER TABLE `proposal` ADD FULLTEXT KEY `FT_proposal_long_description` (`long_description`);

--
-- Index pour la table `proposal_attachment`
--
ALTER TABLE `proposal_attachment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B6DEACD9474526C` (`comment`),
  ADD KEY `IDX_B6DEACDF4792058` (`proposal_id`),
  ADD KEY `IDX_B6DEACD5DA1941` (`asset_id`);

--
-- Index pour la table `proposal_favorite`
--
ALTER TABLE `proposal_favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_899EB2F17E3C61F9` (`owner_id`),
  ADD KEY `IDX_899EB2F1F4792058` (`proposal_id`);

--
-- Index pour la table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5E3DE4775E237E06` (`name`),
  ADD KEY `IDX_5E3DE47712469DE2` (`category_id`);

--
-- Index pour la table `skill_category`
--
ALTER TABLE `skill_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_44E474335E237E06` (`name`),
  ADD KEY `IDX_44E4743354B9D732` (`icon_id`),
  ADD KEY `IDX_44E47433684EC833` (`banner_id`);

--
-- Index pour la table `skill_level`
--
ALTER TABLE `skill_level`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BFC25F2F5E237E06` (`name`);

--
-- Index pour la table `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D5128A8F7E3C61F9` (`owner_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649AA08CB10` (`login`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D6499D419299` (`user_type_id`),
  ADD KEY `IDX_8D93D649E51E9644` (`company_type_id`),
  ADD KEY `IDX_8D93D649F92F3E70` (`country_id`),
  ADD KEY `IDX_8D93D64982F1BAF4` (`language_id`),
  ADD KEY `IDX_8D93D64986383B10` (`avatar_id`),
  ADD KEY `IDX_8D93D649684EC833` (`banner_id`),
  ADD KEY `IDX_user_login_password` (`login`,`password`,`is_active`),
  ADD KEY `IDX_user_email_password` (`email`,`password`,`is_active`),
  ADD KEY `IDX_user_login_email_password` (`login`,`email`,`password`,`is_active`),
  ADD KEY `IDX_user_email_login_password` (`email`,`login`,`password`,`is_active`),
  ADD KEY `IDX_user_login_email` (`login`,`email`,`is_active`),
  ADD KEY `IDX_user_email_login_` (`email`,`login`,`is_active`),
  ADD KEY `IDX_8D93D6491C9DA55` (`nationality_id`);

--
-- Index pour la table `user_attachment`
--
ALTER TABLE `user_attachment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_DE381F579474526C` (`comment`),
  ADD KEY `IDX_DE381F577E3C61F9` (`owner_id`),
  ADD KEY `IDX_DE381F575DA1941` (`asset_id`);

--
-- Index pour la table `user_destination`
--
ALTER TABLE `user_destination`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `U_destination_user_country` (`owner_id`,`country_id`),
  ADD KEY `IDX_97DDF73F7E3C61F9` (`owner_id`),
  ADD KEY `IDX_97DDF73FF92F3E70` (`country_id`);

--
-- Index pour la table `user_favorite`
--
ALTER TABLE `user_favorite`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_88486AD99474526C` (`comment`),
  ADD KEY `IDX_88486AD97E3C61F9` (`owner_id`),
  ADD KEY `IDX_88486AD9FA3A7DFB` (`favorite_user_id`);

--
-- Index pour la table `user_motivation`
--
ALTER TABLE `user_motivation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4707B5017E3C61F9` (`owner_id`),
  ADD KEY `IDX_4707B5012576E0FD` (`contract_id`);

--
-- Index pour la table `user_stat`
--
ALTER TABLE `user_stat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `U_user_stat_owner` (`owner_id`);

--
-- Index pour la table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F65F1BE05E237E06` (`name`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `applier`
--
ALTER TABLE `applier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `asset_type`
--
ALTER TABLE `asset_type`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `company_type`
--
ALTER TABLE `company_type`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `contract_type`
--
ALTER TABLE `contract_type`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT pour la table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `experience_skill`
--
ALTER TABLE `experience_skill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `language`
--
ALTER TABLE `language`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `language_knowledge`
--
ALTER TABLE `language_knowledge`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `language_level`
--
ALTER TABLE `language_level`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT pour la table `other`
--
ALTER TABLE `other`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `other_skill`
--
ALTER TABLE `other_skill`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `proposal_attachment`
--
ALTER TABLE `proposal_attachment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `proposal_favorite`
--
ALTER TABLE `proposal_favorite`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `skill_category`
--
ALTER TABLE `skill_category`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `skill_level`
--
ALTER TABLE `skill_level`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `training`
--
ALTER TABLE `training`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `user_attachment`
--
ALTER TABLE `user_attachment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_destination`
--
ALTER TABLE `user_destination`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user_favorite`
--
ALTER TABLE `user_favorite`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_motivation`
--
ALTER TABLE `user_motivation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `user_stat`
--
ALTER TABLE `user_stat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `applier`
--
ALTER TABLE `applier`
  ADD CONSTRAINT `FK_D22A42C77E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_D22A42C7F4792058` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`);

--
-- Contraintes pour la table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `FK_2AF5A5C7E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2AF5A5CA6A2CDC5` FOREIGN KEY (`asset_type_id`) REFERENCES `asset_type` (`id`);

--
-- Contraintes pour la table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `FK_590C1037E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `experience_skill`
--
ALTER TABLE `experience_skill`
  ADD CONSTRAINT `FK_3D6F986146E90E27` FOREIGN KEY (`experience_id`) REFERENCES `experience` (`id`),
  ADD CONSTRAINT `FK_3D6F98615585C142` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`);

--
-- Contraintes pour la table `language`
--
ALTER TABLE `language`
  ADD CONSTRAINT `FK_D4DB71B554B9D732` FOREIGN KEY (`icon_id`) REFERENCES `asset` (`id`);

--
-- Contraintes pour la table `language_knowledge`
--
ALTER TABLE `language_knowledge`
  ADD CONSTRAINT `FK_586755F75FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `language_level` (`id`),
  ADD CONSTRAINT `FK_586755F77E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_586755F782F1BAF4` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`);

--
-- Contraintes pour la table `nationality`
--
ALTER TABLE `nationality`
  ADD CONSTRAINT `FK_8AC58B70F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `other`
--
ALTER TABLE `other`
  ADD CONSTRAINT `FK_D95835207E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `other_skill`
--
ALTER TABLE `other_skill`
  ADD CONSTRAINT `FK_368913D95585C142` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`),
  ADD CONSTRAINT `FK_368913D95FB14BA7` FOREIGN KEY (`level_id`) REFERENCES `skill_level` (`id`),
  ADD CONSTRAINT `FK_368913D9998D9879` FOREIGN KEY (`other_id`) REFERENCES `other` (`id`);

--
-- Contraintes pour la table `proposal`
--
ALTER TABLE `proposal`
  ADD CONSTRAINT `FK_BFE594723569D950` FOREIGN KEY (`featured_image_id`) REFERENCES `asset` (`id`),
  ADD CONSTRAINT `FK_BFE594723F9CEB4E` FOREIGN KEY (`banner_image_id`) REFERENCES `asset` (`id`),
  ADD CONSTRAINT `FK_BFE594727E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `proposal_attachment`
--
ALTER TABLE `proposal_attachment`
  ADD CONSTRAINT `FK_B6DEACD5DA1941` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`id`),
  ADD CONSTRAINT `FK_B6DEACDF4792058` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`);

--
-- Contraintes pour la table `proposal_favorite`
--
ALTER TABLE `proposal_favorite`
  ADD CONSTRAINT `FK_899EB2F17E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_899EB2F1F4792058` FOREIGN KEY (`proposal_id`) REFERENCES `proposal` (`id`);

--
-- Contraintes pour la table `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `FK_5E3DE47712469DE2` FOREIGN KEY (`category_id`) REFERENCES `skill_category` (`id`);

--
-- Contraintes pour la table `skill_category`
--
ALTER TABLE `skill_category`
  ADD CONSTRAINT `FK_44E4743354B9D732` FOREIGN KEY (`icon_id`) REFERENCES `asset` (`id`),
  ADD CONSTRAINT `FK_44E47433684EC833` FOREIGN KEY (`banner_id`) REFERENCES `asset` (`id`);

--
-- Contraintes pour la table `training`
--
ALTER TABLE `training`
  ADD CONSTRAINT `FK_D5128A8F7E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6491C9DA55` FOREIGN KEY (`nationality_id`) REFERENCES `nationality` (`id`),
  ADD CONSTRAINT `FK_8D93D649684EC833` FOREIGN KEY (`banner_id`) REFERENCES `asset` (`id`),
  ADD CONSTRAINT `FK_8D93D64982F1BAF4` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `FK_8D93D64986383B10` FOREIGN KEY (`avatar_id`) REFERENCES `asset` (`id`),
  ADD CONSTRAINT `FK_8D93D6499D419299` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`),
  ADD CONSTRAINT `FK_8D93D649E51E9644` FOREIGN KEY (`company_type_id`) REFERENCES `company_type` (`id`),
  ADD CONSTRAINT `FK_8D93D649F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `user_attachment`
--
ALTER TABLE `user_attachment`
  ADD CONSTRAINT `FK_DE381F575DA1941` FOREIGN KEY (`asset_id`) REFERENCES `asset` (`id`),
  ADD CONSTRAINT `FK_DE381F577E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user_destination`
--
ALTER TABLE `user_destination`
  ADD CONSTRAINT `FK_97DDF73F7E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_97DDF73FF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Contraintes pour la table `user_favorite`
--
ALTER TABLE `user_favorite`
  ADD CONSTRAINT `FK_88486AD97E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_88486AD9FA3A7DFB` FOREIGN KEY (`favorite_user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user_motivation`
--
ALTER TABLE `user_motivation`
  ADD CONSTRAINT `FK_4707B5012576E0FD` FOREIGN KEY (`contract_id`) REFERENCES `contract_type` (`id`),
  ADD CONSTRAINT `FK_4707B5017E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user_stat`
--
ALTER TABLE `user_stat`
  ADD CONSTRAINT `FK_5A39B3E87E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
