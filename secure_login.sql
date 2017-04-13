-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema secure_login
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `secure_login` ;

-- -----------------------------------------------------
-- Schema secure_login
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `secure_login` DEFAULT CHARACTER SET latin1 ;
USE `secure_login` ;

-- -----------------------------------------------------
-- Table `secure_login`.`login_attempts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `secure_login`.`login_attempts` ;

CREATE TABLE IF NOT EXISTS `secure_login`.`login_attempts` (
  `user_id` INT(11) NOT NULL,
  `time` VARCHAR(30) NOT NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `secure_login`.`user_profile`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `secure_login`.`user_profile` ;

CREATE TABLE IF NOT EXISTS `secure_login`.`user_profile` (
  `user_id` INT(11) NOT NULL,
  `salutation` VARCHAR(5) NULL DEFAULT NULL,
  `first_name` VARCHAR(45) NULL DEFAULT NULL,
  `middle_initial` VARCHAR(2) NULL DEFAULT NULL,
  `last_name` VARCHAR(45) NULL DEFAULT NULL,
  `suffix` VARCHAR(5) NULL DEFAULT NULL,
  `date_of_birth` DATETIME NULL DEFAULT NULL,
  `address_1` VARCHAR(45) NULL DEFAULT NULL,
  `address_2` VARCHAR(45) NULL DEFAULT NULL,
  `unit_no` VARCHAR(7) NULL DEFAULT NULL,
  `city` VARCHAR(45) NULL DEFAULT NULL,
  `state` VARCHAR(2) NULL DEFAULT NULL,
  `zip_code` VARCHAR(10) NULL DEFAULT NULL,
  `country` VARCHAR(45) NULL DEFAULT NULL,
  `county` VARCHAR(45) NULL DEFAULT NULL,
  `created` DATETIME NULL DEFAULT NULL,
  `updated` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `secure_login`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `secure_login`.`users` ;

CREATE TABLE IF NOT EXISTS `secure_login`.`users` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(30) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` CHAR(128) NOT NULL,
  `salt` CHAR(128) NOT NULL,
  `newpass` TINYINT(4) NULL DEFAULT '0',
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
