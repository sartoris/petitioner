-- Server version: 5.6.49-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Petitioner`
--

-- --------------------------------------------------------
--
-- Table structure for table `State`
--

CREATE TABLE `State` (
  `ShortName` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LongName` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `State` (`ShortName`, `LongName`) VALUES
('AL', 'Alabama'),
('AK', 'Alaska'),
('AZ', 'Arizona'),
('AR', 'Arkansas'),
('CA', 'California'),
('CO', 'Colorado'),
('CT', 'Connecticut'),
('DE', 'Delaware'),
('FL', 'Florida'),
('GA', 'Georgia'),
('HI', 'Hawaii'),
('ID', 'Idaho'),
('IL', 'Illinois'),
('IN', 'Indiana'),
('IA', 'Iowa'),
('KS', 'Kansas'),
('KY', 'Kentucky'),
('LA', 'Louisiana'),
('ME', 'Maine'),
('MD', 'Maryland'),
('MA', 'Massachusetts'),
('MI', 'Michigan'),
('MN', 'Minnesota'),
('MS', 'Mississippi'),
('MO', 'Missouri'),
('MT', 'Montana'),
('NE', 'Nebraska'),
('NV', 'Nevada'),
('NH', 'New Hampshire'),
('NJ', 'New Jersey'),
('NM', 'New Mexico'),
('NY', 'New York'),
('NC', 'North Carolina'),
('ND', 'North Dakota'),
('OH', 'Ohio'),
('OK', 'Oklahoma'),
('OR', 'Oregon'),
('PA', 'Pennsylvania'),
('RI', 'Rhode Island'),
('SC', 'South Carolina'),
('SD', 'South Dakota'),
('TN', 'Tennessee'),
('TX', 'Texas'),
('UT', 'Utah'),
('VT', 'Vermont'),
('VA', 'Virginia'),
('WA', 'Washington'),
('WV', 'West Virginia'),
('WI', 'Wisconsin'),
('WY', 'Wyoming');

-- --------------------------------------------------------

--
-- Table structure for table `County`
--

CREATE TABLE `County` (
  `Name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `County` (`Name`) VALUES
('Apache'),
('Cochise'),
('Coconino'),
('Gila'),
('Graham'),
('Greenlee'),
('La Paz'),
('Maricopa'),
('Mohave'),
('Navajo'),
('Pima'),
('Pinal'),
('Santa Cruz'),
('Yavapai'),
('Yuma');

-- --------------------------------------------------------

--
-- Table structure for table `PetitionNames`
--

CREATE TABLE `PetitionNames` (
  `Name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `PetitionNames` (`Name`) VALUES
('SB1485'),
('HB2569'),
('SB1819');

-- --------------------------------------------------------

--
-- Table structure for table `Organization`
--

CREATE TABLE `Organization` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactId` int(11) DEFAULT NULL,
  `Endorsement` tinyint(1) NOT NULL DEFAULT '0',
  `Notes` mediumtext COLLATE utf8mb4_unicode_ci,
  `CreatedBy` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `Organization`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `Organization`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;


-- --------------------------------------------------------

--
-- Table structure for table `Depot`
--

CREATE TABLE `Depot` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Street1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Street2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `State` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Zip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `County` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Hours` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NotaryHours` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ContactId` int(11) DEFAULT NULL,
  `CheckOutPetitions` tinyint(1) NOT NULL DEFAULT '0',
  `SubmitCompletedPetitions` tinyint(1) NOT NULL DEFAULT '0',
  `NotaryAvailable` tinyint(1) NOT NULL DEFAULT '0',
  `Notes` mediumtext COLLATE utf8mb4_unicode_ci,
  `InternalNotes` mediumtext COLLATE utf8mb4_unicode_ci,
  `CreatedBy` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `Depot`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `Depot`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;


-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `ID` int(11) NOT NULL,
  `isPending` tinyint(1) NOT NULL DEFAULT '1',
  `LastName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FirstName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Middle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Street1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Street2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `City` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `State` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `County` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Zip` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PhoneType` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CanText` bit(1) NOT NULL DEFAULT b'0',
  `LegislativeDistrict` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PC` tinyint(1) NOT NULL DEFAULT '0',
  `Notes` text COLLATE utf8mb4_unicode_ci,
  `CirculatorID` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OrganizationID` int(11) DEFAULT NULL,
  `HoursAvailable` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isCoordinator` tinyint(1) NOT NULL DEFAULT '0',
  `isAmbassador` tinyint(1) NOT NULL DEFAULT '0',
  `isPetitioner` tinyint(1) NOT NULL DEFAULT '0',
  `isDepotContact` tinyint(1) NOT NULL DEFAULT '0',
  `DepotID` int(11) DEFAULT NULL,
  `isNotary` tinyint(1) NOT NULL DEFAULT '0',
  `isPersonOfInterest` tinyint(1) NOT NULL DEFAULT '0',
  `CreatedBy` int(11) NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` int(11) NULL,
  `ModifiedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `Person`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_to_DepotId` (`DepotID`);

ALTER TABLE `Person`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;


-- --------------------------------------------------------

--
-- Table structure for table `PetitionHistory`
--

CREATE TABLE `PetitionHistory` (
  `ID` int(11) NOT NULL,
  `Batch` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PetitionNumber` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PetitionName` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `BulkCheckOutDate` date DEFAULT NULL,
  `BulkCheckOutBy` int(11) DEFAULT NULL,
  `County` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DepotID` int(11) DEFAULT NULL,
  `CoordinatorID` int(11) DEFAULT NULL,
  `AmbassadorID` int(11) DEFAULT NULL,
  `CirculatorID` int(11) DEFAULT NULL,
  `SignatureCount` int(11) NOT NULL DEFAULT '0',
  `ValidSignatureCount` int(11) NOT NULL DEFAULT '0',
  `isCheckedIn` tinyint(1) NOT NULL DEFAULT '0',
  `isNotarized` tinyint(1) NOT NULL DEFAULT '0',
  `isValid` tinyint(1) NOT NULL DEFAULT '0',
  `Comments` mediumtext COLLATE utf8mb4_unicode_ci,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PetitionID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `PetitionHistory`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Petition_DepotId` (`DepotID`),
  ADD KEY `fk_Petition_CoordinatorId` (`CoordinatorID`),
  ADD KEY `fk_Petition_AmbassadorId` (`AmbassadorID`),
  ADD KEY `fk_Petition_CirculatorId` (`CirculatorID`);

ALTER TABLE `PetitionHistory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Table structure for table `Petition`
--

CREATE TABLE `Petition` (
  `ID` int(11) NOT NULL,
  `Batch` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PetitionNumber` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PetitionName` varchar(255) COLLATE utf8mb4_unicode_ci NULL,
  `BulkCheckOutDate` date DEFAULT NULL,
  `BulkCheckOutBy` int(11) DEFAULT NULL,
  `County` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DepotID` int(11) DEFAULT NULL,
  `CoordinatorID` int(11) DEFAULT NULL,
  `AmbassadorID` int(11) DEFAULT NULL,
  `CirculatorID` int(11) DEFAULT NULL,
  `SignatureCount` int(11) NOT NULL DEFAULT '0',
  `ValidSignatureCount` int(11) NOT NULL DEFAULT '0',
  `isCheckedIn` tinyint(1) NOT NULL DEFAULT '0',
  `isNotarized` tinyint(1) NOT NULL DEFAULT '0',
  `isValid` tinyint(1) NOT NULL DEFAULT '0',
  `Comments` mediumtext COLLATE utf8mb4_unicode_ci,
  `CreatedBy` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `Petition`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Petition_DepotId` (`DepotID`),
  ADD KEY `fk_Petition_CoordinatorId` (`CoordinatorID`),
  ADD KEY `fk_Petition_AmbassadorId` (`AmbassadorID`),
  ADD KEY `fk_Petition_CirculatorId` (`CirculatorID`);

ALTER TABLE `Petition`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

-- 1st run in mysql: set global log_bin_trust_function_creators=1;
CREATE TRIGGER onPetitionUpdate AFTER UPDATE ON Petition
FOR EACH ROW INSERT INTO PetitionHistory 
(PetitionID, Batch, PetitionNumber, PetitionName, BulkCheckOutDate, BulkCheckOutBy, County, DepotID, CoordinatorID, AmbassadorID, CirculatorID,
SignatureCount, ValidSignatureCount, isCheckedIn, isNotarized, isValid, Comments, ModifiedBy, ModifiedOn)
VALUES
(NEW.ID, NEW.Batch, NEW.PetitionNumber, NEW.PetitionName, NEW.BulkCheckOutDate, NEW.BulkCheckOutBy, NEW.County, NEW.DepotID, NEW.CoordinatorID, NEW.AmbassadorID, NEW.CirculatorID,
NEW.SignatureCount, NEW.ValidSignatureCount, NEW.isCheckedIn, NEW.isNotarized, NEW.isValid, NEW.Comments, NEW.ModifiedBy, NEW.ModifiedOn);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `ID` int(11) NOT NULL,
  `LoginId` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Type` enum('User','Admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
 	`Token` varchar(255) NULL,
  `ResetAttempts` TINYINT NOT NULL DEFAULT '0',
  `CreatedBy` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` int(11) NOT NULL,
  `ModifiedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `User`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `User`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

INSERT INTO User (ID, LoginId, Name, Password, Type, CreatedBy, CreatedOn, ModifiedBy, ModifiedOn) VALUES
(1,'admin','Admin','$2y$10$aOsnzPCWc/FHiOnSIBAhg.qpjzxOvsw2XW5wPQS6EzTvpmn6hILI.','Admin',1,NOW(),0,NOW())
-- password = Password1!

-- --------------------------------------------------------

--
-- Table structure for table `tblreports`
--

CREATE TABLE `tblreports` (
  `id` int(11) NOT NULL auto_increment,
  `appliedConditions` longtext,
  `txtReportName` text,
  `lstSortName` text,
  `lstSortOrder` text,
  `txtRecPerPage` text,
  `selectedFields` text,
  `selectedTables` text,
  `status` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Views for reporting

CREATE
 ALGORITHM = UNDEFINED
VIEW `PetitionCirculatorCheckOut` AS
  SELECT 
    concat(FirstName, ' ', LastName) AS Circulator,
    PetitionNumber,
    min(cast(h.ModifiedOn as date)) AS CheckedOut
  FROM PetitionHistory h
  JOIN Person p
    ON p.Id = h.CirculatorId
    AND IsCheckedIn = 0
  GROUP BY PetitionNumber, FirstName, LastName;

CREATE
 ALGORITHM = UNDEFINED
VIEW `PetitionCirculatorCheckIn` AS
  SELECT 
    concat(FirstName, ' ', LastName) AS Circulator,
    PetitionNumber,
    min(cast(h.ModifiedOn as date)) AS CheckInDate
  FROM PetitionHistory h
  JOIN Person p
    ON p.Id = h.CirculatorId
  WHERE IsCheckedIn = 1
  GROUP BY PetitionNumber, FirstName, LastName;

CREATE
 ALGORITHM = UNDEFINED
VIEW CirculatorPetitionCount AS
  SELECT
    concat(c.FirstName, ' ', c.LastName) AS Circulator,
    count(PetitionNumber) AS PetitionCount,
    sum(SignatureCount) as SignatureCount
  FROM Petition p
  JOIN Person c
    ON c.Id = p.CirculatorId
  where p.IsCheckedIn = 1
  group by p.CirculatorId

CREATE
 ALGORITHM = UNDEFINED
VIEW `PetitionCirculator` AS
  SELECT 
    p.PetitionName,
    p.PetitionNumber,
    p.County AS CountySignaturesAreFor,
    pd.Name AS PetitionDepot,
    if(p.isCheckedIn = 1, 'Y', 'N') AS IsPetitionCheckedIn,
    p.SignatureCount,
    p.Comments,
    concat(c.FirstName, ' ', c.LastName) AS Circulator,
    c.County AS CirculatorCounty,
    c.City AS CirculatorCity,
    c.Zip AS CirculatorZip,
    c.Phone AS CirculatorPhone,
    c.Email AS CirculatorEmail,
    c.LegislativeDistrict AS CirculatorLD,
    if(c.isPetitioner = 1, 'Y', 'N') AS IsCirculator,
    if(c.isAmbassador = 1, 'Y', 'N') AS IsAmbassador,
    if(c.isCoordinator = 1, 'Y', 'N') AS IsCoordinator,
    if(c.isDepotContact = 1, 'Y', 'N') AS IsDepotContact,
    d.Name AS CirculatorDepot,
    o.Name AS CirculatorOrganization
  FROM Petition p
  LEFT JOIN Depot pd
    ON pd.Id = p.DepotId
  JOIN Person c
    ON c.Id = p.CirculatorId
  LEFT JOIN Depot d
    ON d.Id = c.DepotId
  LEFT JOIN Organization o
    ON o.Id = c.OrganizationId;

CREATE
 ALGORITHM = UNDEFINED
VIEW `Circulators` AS
  SELECT 
    p.FirstName, 
    p.Middle, 
    p.LastName, 
    p.Street1, 
    p.Street2, 
    p.City, 
    p.State, 
    p.Zip, 
    p.County, 
    p.Phone, 
    p.Email, 
    if(p.CanText = 1, 'Y', 'N') AS CanText,
    p.LegislativeDistrict, 
    p.CirculatorID, 
    o.Name as Organization, 
    p.HoursAvailable, 
    if(p.isPetitioner = 1, 'Y', 'N') AS IsCirculator,
    if(p.isAmbassador = 1, 'Y', 'N') AS IsAmbassador,
    if(p.isCoordinator = 1, 'Y', 'N') AS IsCoordinator,
    if(p.isDepotContact = 1, 'Y', 'N') AS IsDepotContact,
    if(p.isNotary = 1, 'Y', 'N') AS IsNotary,
    if(p.isPersonOfInterest = 1, 'Y', 'N') AS IsPersonOfInterest,
    d.name as Depot, 
    p.Notes, 
    uc.name as CreatedBy, 
    p.CreatedOn, 
    um.name as ModifiedBy, 
    p.ModifiedOn 
  FROM Person p 
  LEFT JOIN Depot d on d.ID = p.DepotID 
  LEFT JOIN Organization o on o.ID = p.OrganizationID 
  LEFT JOIN User uc on uc.ID = p.CreatedBy 
  LEFT JOIN User um on um.ID = p.ModifiedBy 
  WHERE isPending = 0 AND p.isPetitioner = 1
  order by p.FirstName, p.LastName;

CREATE
 ALGORITHM = UNDEFINED
VIEW `Ambassadors` AS
  SELECT 
    p.FirstName, 
    p.Middle, 
    p.LastName, 
    p.Street1, 
    p.Street2, 
    p.City, 
    p.State, 
    p.Zip, 
    p.County, 
    p.Phone, 
    p.Email, 
    if(p.CanText = 1, 'Y', 'N') AS CanText,
    p.LegislativeDistrict, 
    p.CirculatorID, 
    o.Name as Organization, 
    p.HoursAvailable, 
    if(p.isPetitioner = 1, 'Y', 'N') AS IsCirculator,
    if(p.isAmbassador = 1, 'Y', 'N') AS IsAmbassador,
    if(p.isCoordinator = 1, 'Y', 'N') AS IsCoordinator,
    if(p.isDepotContact = 1, 'Y', 'N') AS IsDepotContact,
    if(p.isNotary = 1, 'Y', 'N') AS IsNotary,
    if(p.isPersonOfInterest = 1, 'Y', 'N') AS IsPersonOfInterest,
    d.name as Depot, 
    p.Notes, 
    uc.name as CreatedBy, 
    p.CreatedOn, 
    um.name as ModifiedBy, 
    p.ModifiedOn 
  FROM Person p 
  LEFT JOIN Depot d on d.ID = p.DepotID 
  LEFT JOIN Organization o on o.ID = p.OrganizationID 
  LEFT JOIN User uc on uc.ID = p.CreatedBy 
  LEFT JOIN User um on um.ID = p.ModifiedBy 
  WHERE isPending = 0 AND p.isAmbassador = 1
  order by p.FirstName, p.LastName;

CREATE
 ALGORITHM = UNDEFINED
VIEW `Coordinators` AS
  SELECT 
    p.FirstName, 
    p.Middle, 
    p.LastName, 
    p.Street1, 
    p.Street2, 
    p.City, 
    p.State, 
    p.Zip, 
    p.County, 
    p.Phone, 
    p.Email, 
    if(p.CanText = 1, 'Y', 'N') AS CanText,
    p.LegislativeDistrict, 
    p.CirculatorID, 
    o.Name as Organization, 
    p.HoursAvailable, 
    if(p.isPetitioner = 1, 'Y', 'N') AS IsCirculator,
    if(p.isAmbassador = 1, 'Y', 'N') AS IsAmbassador,
    if(p.isCoordinator = 1, 'Y', 'N') AS IsCoordinator,
    if(p.isDepotContact = 1, 'Y', 'N') AS IsDepotContact,
    if(p.isNotary = 1, 'Y', 'N') AS IsNotary,
    if(p.isPersonOfInterest = 1, 'Y', 'N') AS IsPersonOfInterest,
    d.name as Depot, 
    p.Notes, 
    uc.name as CreatedBy, 
    p.CreatedOn, 
    um.name as ModifiedBy, 
    p.ModifiedOn 
  FROM Person p 
  LEFT JOIN Depot d on d.ID = p.DepotID 
  LEFT JOIN Organization o on o.ID = p.OrganizationID 
  LEFT JOIN User uc on uc.ID = p.CreatedBy 
  LEFT JOIN User um on um.ID = p.ModifiedBy 
  WHERE isPending = 0 AND p.isCoordinator = 1
  order by p.FirstName, p.LastName;

CREATE
 ALGORITHM = UNDEFINED
VIEW `DepotList` AS
  SELECT 
    d.Name,
    d.Street1,
    d.Street2,
    d.City,
    d.Zip,
    d.County,
    d.Phone,
    d.Email,
    d.Hours,
    concat(p.FirstName, ' ', p.LastName) as Contact,
    d.NotaryHours,
    if(d.CheckOutPetitions = 1, 'Y', 'N') as CheckOutPetitions,
    if(d.SubmitCompletedPetitions = 1, 'Y', 'N') as SubmitCompletedPetitions,
    if(d.NotaryAvailable = 1, 'Y', 'N') as NotaryAvailable,
    d.Notes,
    d.InternalNotes
  FROM Depot d
  LEFT JOIN Person p
    ON p.ID = d.ContactId;

CREATE
 ALGORITHM = UNDEFINED
VIEW `OrganizationList` AS
  SELECT 
    o.Name,
    concat(p.FirstName, ' ', p.LastName) as Contact,
    if(o.Endorsement = 1, 'Y', 'N') as Endorsement,
    o.Notes
  FROM Organization o
  LEFT JOIN Person p
    ON p.ID = o.ContactId;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
