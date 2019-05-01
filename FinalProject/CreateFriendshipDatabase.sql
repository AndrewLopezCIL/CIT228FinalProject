CREATE DATABASE gamesale;
CREATE TABLE `friendrequests` (
  `requestID` int(11) NOT NULL AUTO_INCREMENT,
  `requestStatus` varchar(75) DEFAULT NULL,
  `requestSender` varchar(75) DEFAULT NULL,
  `requestReceiver` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`requestID`)
); 
CREATE TABLE `friends` (
  `friendshipID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(75) DEFAULT NULL,
  `friendUsername` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`friendshipID`)
);
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(75) DEFAULT NULL,
  `username` varchar(75) DEFAULT NULL,
  `pass` varchar(75) DEFAULT NULL,
  `firstName` varchar(75) DEFAULT NULL,
  `lastName` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
