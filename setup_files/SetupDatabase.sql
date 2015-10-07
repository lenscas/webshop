-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Versie:              8.2.0.4675
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Databasestructuur van webshop wordt geschreven
CREATE DATABASE IF NOT EXISTS `webshop` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `webshop`;


-- Structuur van  tabel webshop.admin wordt geschreven
CREATE TABLE IF NOT EXISTS `admin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.admin: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


-- Structuur van  tabel webshop.cartitems wordt geschreven
CREATE TABLE IF NOT EXISTS `cartitems` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Products_Id` int(11) NOT NULL,
  `ShoppingCart_Id` varchar(50) NOT NULL,
  `PurchasePrice` decimal(10,0) NOT NULL,
  `Date` date NOT NULL,
  `Ean` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.cartitems: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `cartitems` DISABLE KEYS */;
/*!40000 ALTER TABLE `cartitems` ENABLE KEYS */;


-- Structuur van  tabel webshop.categories wordt geschreven
CREATE TABLE IF NOT EXISTS `categories` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.categories: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Structuur van  tabel webshop.catlink wordt geschreven
CREATE TABLE IF NOT EXISTS `catlink` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Cat_Id` int(11) NOT NULL,
  `Sub_Cat_Id` int(11) NOT NULL,
  `Products_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.catlink: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `catlink` DISABLE KEYS */;
/*!40000 ALTER TABLE `catlink` ENABLE KEYS */;


-- Structuur van  tabel webshop.countries wordt geschreven
CREATE TABLE IF NOT EXISTS `countries` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.countries: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;


-- Structuur van  tabel webshop.deliveraddress wordt geschreven
CREATE TABLE IF NOT EXISTS `deliveraddress` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Users_Id` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Zipcode` varchar(50) DEFAULT NULL,
  `Land` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `Users_Id` (`Users_Id`),
  CONSTRAINT `Users_Id` FOREIGN KEY (`Users_Id`) REFERENCES `users` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.deliveraddress: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `deliveraddress` DISABLE KEYS */;
/*!40000 ALTER TABLE `deliveraddress` ENABLE KEYS */;


-- Structuur van  tabel webshop.orders wordt geschreven
CREATE TABLE IF NOT EXISTS `orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `DeliverAddress_Id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Status` int(11) NOT NULL,
  `Tax` int(11) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `TotalPrice` decimal(10,0) NOT NULL,
  `Ean` int(11) NOT NULL,
  `Discount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.orders: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;


-- Structuur van  tabel webshop.productorders wordt geschreven
CREATE TABLE IF NOT EXISTS `productorders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Order_Id` int(11) NOT NULL,
  `Product_Id` int(11) NOT NULL,
  `SalePrice` decimal(10,0) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.productorders: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `productorders` DISABLE KEYS */;
/*!40000 ALTER TABLE `productorders` ENABLE KEYS */;


-- Structuur van  tabel webshop.products wordt geschreven
CREATE TABLE IF NOT EXISTS `products` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Sell_price` decimal(10,0) NOT NULL,
  `Picpath` varchar(50) NOT NULL,
  `Weight` decimal(10,0) NOT NULL,
  `Fragile` tinyint(1) NOT NULL,
  `Tax_Id` int(11) NOT NULL,
  `Warranty` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.products: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


-- Structuur van  tabel webshop.shoppingcart wordt geschreven
CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `Id` varchar(50) NOT NULL,
  `Users_Id` int(11) NOT NULL,
  `CartItems_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.shoppingcart: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `shoppingcart` DISABLE KEYS */;
/*!40000 ALTER TABLE `shoppingcart` ENABLE KEYS */;


-- Structuur van  tabel webshop.stock wordt geschreven
CREATE TABLE IF NOT EXISTS `stock` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Products_Id` int(11) NOT NULL,
  `Stock_Id` int(11) NOT NULL,
  `PurchasePrice` decimal(10,0) NOT NULL,
  `Date` date NOT NULL,
  `Ean` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.stock: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;


-- Structuur van  tabel webshop.subcat wordt geschreven
CREATE TABLE IF NOT EXISTS `subcat` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Cat_Id` int(11) NOT NULL,
  `Sub_Cat_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.subcat: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `subcat` DISABLE KEYS */;
/*!40000 ALTER TABLE `subcat` ENABLE KEYS */;


-- Structuur van  tabel webshop.tax wordt geschreven
CREATE TABLE IF NOT EXISTS `tax` (
  `Tax_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tax_Amount` decimal(10,0) NOT NULL,
  PRIMARY KEY (`Tax_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.tax: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `tax` DISABLE KEYS */;
/*!40000 ALTER TABLE `tax` ENABLE KEYS */;


-- Structuur van  tabel webshop.users wordt geschreven
CREATE TABLE IF NOT EXISTS `users` (
  `Id` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Birthdate` date NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Gender` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumpen data van tabel webshop.users: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
