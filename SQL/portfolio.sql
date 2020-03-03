SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--
CREATE DATABASE IF NOT EXISTS `portfolio` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `portfolio`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ID` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Nickname` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blogposts`
--

CREATE TABLE `blogposts` (
  `ID` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `ImagePath` text,
  `Text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projectimages`
--

CREATE TABLE `projectimages` (
  `ID` int(11) NOT NULL,
  `Path` text NOT NULL,
  `ProjectID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `ID` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Teaser` varchar(150) NOT NULL,
  `GithubLink` text,
  `YoutubeLink` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `projectskills`
--

CREATE TABLE `projectskills` (
  `ProjectID` int(11) NOT NULL,
  `SkillID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `ID` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `ImagePath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `blogposts`
--
ALTER TABLE `blogposts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `projectimages`
--
ALTER TABLE `projectimages`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProjectID` (`ProjectID`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `projectskills`
--
ALTER TABLE `projectskills`
  ADD PRIMARY KEY (`ProjectID`,`SkillID`),
  ADD KEY `SkillID` (`SkillID`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogposts`
--
ALTER TABLE `blogposts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projectimages`
--
ALTER TABLE `projectimages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projectimages`
--
ALTER TABLE `projectimages`
  ADD CONSTRAINT `ProjectID` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ID`);

--
-- Constraints for table `projectskills`
--
ALTER TABLE `projectskills`
  ADD CONSTRAINT `projectskills_ibfk_1` FOREIGN KEY (`ProjectID`) REFERENCES `projects` (`ID`),
  ADD CONSTRAINT `projectskills_ibfk_2` FOREIGN KEY (`SkillID`) REFERENCES `skills` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
