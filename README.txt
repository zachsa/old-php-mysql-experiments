#Just a simple PHP framework with a simple database schema (see below for create schema).


In hindsight, I would have first packaged the SQL query results into data objects. I know that mysqli does this, but I think it would be better to be much clearer on the information that I pass to the tables. I also could have had a better response to non-existing entries. It works now, but a lot of the times registers as an HTML error when I try to validate things.



#CREATE
All create statements are dynamically created by the "insert_into_db($db)" function.


#RETRIEVE
A batch of select-statement functions to access the various tables, including a function to swap field names called by the insert function when taking user parameters of the dropdown menu


#UPDATE
No update functionality


#DELETE
A couple functions to, well, delete things. Each table row containes a form that allows you to call a delete statement, I don't know a better way to do this at this point.


#DATABASE SCHEMA CREATE STATEMENT

Table design was done as an ERD diagram in MySQL Workbench, and then forward engineered to create the following: 


SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema bme
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bme
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bme` DEFAULT CHARACTER SET utf8 ;
USE `bme` ;

-- -----------------------------------------------------
-- Table `bme`.`galleries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bme`.`galleries` (
  `gallery_id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `contact_person` VARCHAR(45) NOT NULL,
  `landline` VARCHAR(45) NULL DEFAULT NULL,
  `cellphone` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`gallery_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bme`.`photos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bme`.`photos` (
  `photo_id` VARCHAR(20) NOT NULL DEFAULT '',
  `description` VARCHAR(45) NOT NULL,
  `native_height_px` VARCHAR(45) NULL DEFAULT NULL,
  `native_width_px` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`photo_id`),
  UNIQUE INDEX `photo_id_UNIQUE` (`photo_id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bme`.`prints`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bme`.`prints` (
  `print_id` INT(11) NOT NULL AUTO_INCREMENT,
  `photo_id` VARCHAR(20) NOT NULL,
  `product_id` VARCHAR(45) NOT NULL,
  `assigned` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`print_id`),
  INDEX `fk_prints_photos1_idx` (`photo_id` ASC),
  INDEX `fk_product_id_idx` (`product_id` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bme`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bme`.`products` (
  `product_id` VARCHAR(45) NOT NULL,
  `print_type` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  `print_cost` VARCHAR(45) NOT NULL,
  `retail_price` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`product_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bme`.`shops`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bme`.`shops` (
  `shop_id` INT(11) NOT NULL AUTO_INCREMENT,
  `shop_name` VARCHAR(45) NOT NULL,
  `location` VARCHAR(45) NOT NULL,
  `shop_telephone` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`shop_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 16
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bme`.`sizes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bme`.`sizes` (
  `size_id` INT(11) NOT NULL AUTO_INCREMENT,
  `size` VARCHAR(30) NOT NULL,
  `cost_price` VARCHAR(45) NOT NULL,
  `retail_price` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`size_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bme`.`stock_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bme`.`stock_details` (
  `gallery_id` INT(11) NOT NULL,
  `print_id` INT(11) NOT NULL,
  `quantity` INT(11) NULL DEFAULT NULL,
  `stock_id` INT(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`stock_id`),
  UNIQUE INDEX `print_id_UNIQUE` (`print_id` ASC),
  INDEX `FK_stock_prints_idx` (`print_id` ASC),
  INDEX `FK_gallery_id_idx` (`gallery_id` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 203
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

