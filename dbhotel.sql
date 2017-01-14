SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `hotelBook` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` varchar(100) NOT NULL,
  `hotelName` varchar(100) NOT NULL,
  `hotelAddr` varchar(100) NOT NULL,
  `booking` varchar(500) NOT NULL,
  `cost` int(11) NOT NULL,
  `bookingtime` varchar(100) NOT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

