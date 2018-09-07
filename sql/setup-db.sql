--
-- Create database oophp.
-- By mahw17 for course "OOPHP -v4".
-- 2018-09-01
-- Setup for the article:
-- https://dbwebb.se/kunskap/kom-igang-med-php-pdo-och-mysql
--

-- Skapa ny databas om ingen existerar
CREATE DATABASE IF NOT EXISTS oophp;

-- Välj vilken databas du vill använda
USE oophp;

-- Skapa användaren "user" med
-- lösenordet "pass" och ge
-- fulla rättigheter till databasen "eshop"
-- när användaren loggar in oavsett från vilken plats
GRANT ALL ON oophp.* TO user@'%' IDENTIFIED BY 'pass';

-- Ensure UTF8 as chacrter encoding within connection.
SET NAMES utf8;
