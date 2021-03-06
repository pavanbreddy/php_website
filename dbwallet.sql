SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `walletRech` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` varchar(100) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `mobileNum` varchar(100) NOT NULL,
  `walletType` enum('paytm','freecharge') NOT NULL DEFAULT 'paytm',
  `wallCost` int(11) NOT NULL,
  `bookingtime` varchar(100) NOT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

