SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+05:30";

CREATE TABLE IF NOT EXISTS `ticketBook` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` varchar(100) NOT NULL,
  `boardLoc` varchar(100) NOT NULL,
  `destLoc` varchar(100) NOT NULL,
  `travelType` enum('bus','train','flight') NOT NULL DEFAULT 'bus',
  `doj` date NOT NULL,
  `cost` int(11) NOT NULL,
  `bookingtime` varchar(100) NOT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

