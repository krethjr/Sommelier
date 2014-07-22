SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `sommelier` ;
CREATE SCHEMA IF NOT EXISTS `sommelier` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `sommelier` ;

-- -----------------------------------------------------
-- Table `sommelier`.`tbl_regions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`tbl_regions` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`tbl_regions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `region_name` VARCHAR(100) NOT NULL,
  `country` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sommelier`.`tbl_appellations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`tbl_appellations` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`tbl_appellations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `country` VARCHAR(45) NOT NULL,
  `region_id` INT NOT NULL,
  `appellation` VARCHAR(45) NOT NULL,
  `common_flg` CHAR(1) NULL,
  INDEX `fk_appellation_region_idx` (`region_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_appellation_region`
    FOREIGN KEY (`region_id`)
    REFERENCES `sommelier`.`tbl_regions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sommelier`.`tbl_wineries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`tbl_wineries` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`tbl_wineries` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `winery_name` VARCHAR(45) NOT NULL,
  `default_appellation_id` INT NULL,
  `phone` VARCHAR(12) NULL,
  `proprietor_name` VARCHAR(45) NULL,
  `winemaker_name` VARCHAR(45) NULL,
  `create_dt` DATETIME NULL,
  `update_dt` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `default_appellation_idx` (`default_appellation_id` ASC),
  CONSTRAINT `fk_winery_appellation`
    FOREIGN KEY (`default_appellation_id`)
    REFERENCES `sommelier`.`tbl_appellations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sommelier`.`tbl_varietals`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`tbl_varietals` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`tbl_varietals` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `common_flg` CHAR(1) NOT NULL,
  `varietal_type` VARCHAR(10) NULL,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sommelier`.`tbl_wines`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`tbl_wines` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`tbl_wines` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `wine_name` VARCHAR(45) NOT NULL,
  `winery_id` INT NOT NULL,
  `appellation_id` INT NOT NULL,
  `wine_year` VARCHAR(4) NOT NULL,
  `wine_varietal_id` INT NOT NULL,
  `create_dt` DATETIME NULL,
  `bottle_size` VARCHAR(45) NULL,
  `image_file` VARCHAR(255) NULL,
  `image_type` VARCHAR(5) NULL,
  `overall_rating` INT NULL,
  `description` VARCHAR(255) NULL,
  `upd_barcode` VARCHAR(20) NULL,
  `update_dt` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_wines_winery_idx` (`winery_id` ASC),
  INDEX `fk_wines_appellation_idx` (`appellation_id` ASC),
  INDEX `fk_wiines_varietal_idx` (`wine_varietal_id` ASC),
  CONSTRAINT `fk_wines_winery`
    FOREIGN KEY (`winery_id`)
    REFERENCES `sommelier`.`tbl_wineries` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wines_appellation`
    FOREIGN KEY (`appellation_id`)
    REFERENCES `sommelier`.`tbl_appellations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_wiines_varietal`
    FOREIGN KEY (`wine_varietal_id`)
    REFERENCES `sommelier`.`tbl_varietals` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sommelier`.`tbl_user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`tbl_user` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`tbl_user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(128) NOT NULL,
  `password` VARCHAR(128) NOT NULL,
  `email` VARCHAR(128) NOT NULL,
  `profile` TEXT NULL,
  `create_dt` DATETIME NULL,
  `last_login_dt` DATETIME NULL,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) BINARY NULL,
  `country` VARCHAR(45) NULL,
  `state` VARCHAR(2) NULL,
  `favorite_region_id` INT NULL,
  `allow_public_view` CHAR NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_fav_region_idx` (`favorite_region_id` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `fk_user_fav_region`
    FOREIGN KEY (`favorite_region_id`)
    REFERENCES `sommelier`.`tbl_regions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sommelier`.`tbl_cellars`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`tbl_cellars` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`tbl_cellars` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `owner_id` INT NOT NULL,
  `cellar_name` VARCHAR(45) NOT NULL,
  `create_dt` DATETIME NULL,
  `default_cellar_loc_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cellar_owner_idx` (`owner_id` ASC),
  CONSTRAINT `fk_cellar_owner`
    FOREIGN KEY (`owner_id`)
    REFERENCES `sommelier`.`tbl_user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sommelier`.`tbl_cellar_location`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`tbl_cellar_location` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`tbl_cellar_location` (
  `cellar_loc_id` INT NOT NULL AUTO_INCREMENT,
  `cellar_id` INT NOT NULL,
  `location` VARCHAR(10) NOT NULL,
  `location_desc` VARCHAR(255) NULL,
  PRIMARY KEY (`cellar_loc_id`),
  INDEX `fk_2_idx` (`cellar_id` ASC),
  CONSTRAINT `fk_cellar_location_cellar`
    FOREIGN KEY (`cellar_id`)
    REFERENCES `sommelier`.`tbl_cellars` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sommelier`.`tbl_cellar_wines`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`tbl_cellar_wines` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`tbl_cellar_wines` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cellar_id` INT NOT NULL,
  `wine_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  `rating` INT NULL,
  `create_dt` DATETIME NULL,
  `update_dt` DATETIME NULL,
  `cost` DECIMAL(10,2) NULL,
  `cellar_loc_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cellar_wines_wine_idx` (`wine_id` ASC),
  INDEX `fk_cellar_wines_cellar_idx` (`cellar_id` ASC),
  INDEX `fk_1_idx` (`cellar_loc_id` ASC),
  CONSTRAINT `fk_cellar_wines_wine`
    FOREIGN KEY (`wine_id`)
    REFERENCES `sommelier`.`tbl_wines` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cellar_wines_cellar`
    FOREIGN KEY (`cellar_id`)
    REFERENCES `sommelier`.`tbl_cellars` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_1`
    FOREIGN KEY (`cellar_loc_id`)
    REFERENCES `sommelier`.`tbl_cellar_location` (`cellar_loc_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sommelier`.`tbl_wine_comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`tbl_wine_comments` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`tbl_wine_comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `wine_id` INT NOT NULL,
  `comment_dt` DATETIME NOT NULL,
  `comment` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comment_user_idx` (`user_id` ASC),
  INDEX `fk_comment_wine_idx` (`wine_id` ASC),
  CONSTRAINT `fk_comment_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `sommelier`.`tbl_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_wine`
    FOREIGN KEY (`wine_id`)
    REFERENCES `sommelier`.`tbl_wines` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sommelier`.`tbl_systemconfig`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`tbl_systemconfig` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`tbl_systemconfig` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `systemName` VARCHAR(45) NULL,
  `version` VARCHAR(45) NULL,
  `wineOfTheDay_id` INT NULL,
  `wineOfTheDay_dt` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sommelier`.`tbl_api_access`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`tbl_api_access` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`tbl_api_access` (
  `api_id` INT NOT NULL AUTO_INCREMENT,
  `api_key_desc` VARCHAR(45) NOT NULL,
  `api_key_id` VARCHAR(45) NOT NULL,
  `api_key_secret` VARCHAR(45) NOT NULL,
  `update_dt` DATETIME NOT NULL,
  `responsible_user_id` INT NOT NULL,
  PRIMARY KEY (`api_id`),
  UNIQUE INDEX `api_user_UNIQUE` (`api_key_desc` ASC),
  INDEX `fk_2_idx` (`responsible_user_id` ASC),
  UNIQUE INDEX `api_key_id_UNIQUE` (`api_key_id` ASC),
  CONSTRAINT `fk_2`
    FOREIGN KEY (`responsible_user_id`)
    REFERENCES `sommelier`.`tbl_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sommelier`.`fr_api_device`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sommelier`.`fr_api_device` ;

CREATE TABLE IF NOT EXISTS `sommelier`.`fr_api_device` (
  `id` INT NOT NULL,
  `token` VARCHAR(63) NULL,
  `ip_address` VARCHAR(45) NULL,
  `update_time` DATETIME NULL,
  `connected_type` VARCHAR(45) NULL,
  `connected_id` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

USE `sommelier` ;

-- -----------------------------------------------------
-- Placeholder table for view `sommelier`.`user_wine_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sommelier`.`user_wine_details` (`userName` INT, `cellarName` INT, `wineryName` INT, `appelationName` INT, `varietalName` INT, `quantity` INT);

-- -----------------------------------------------------
-- View `sommelier`.`user_wine_details`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `sommelier`.`user_wine_details` ;
DROP TABLE IF EXISTS `sommelier`.`user_wine_details`;
USE `sommelier`;
CREATE  OR REPLACE VIEW `user_wine_details` AS
    SELECT 
        u.username as userName,
        c.cellar_name as cellarName,
        w.winery_name as wineryName,
        a.appellation as appelationName,
        v.name as varietalName,
        cw.quantity as quantity
    FROM
        tbl_user u,
        tbl_cellars c,
        tbl_wineries w,
        tbl_appellations a,
        tbl_varietals v,
        tbl_cellar_wines cw,
        tbl_wines wn
    WHERE
        u.id = c.owner_id
            and c.id = cw.cellar_id
            and wn.id = cw.wine_id
            and a.id = wn.appellation_id
            and v.id = wn.wine_varietal_id
            and w.id = wn.winery_id;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `sommelier`.`tbl_regions`
-- -----------------------------------------------------
START TRANSACTION;
USE `sommelier`;
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (1, 'Napa Valley', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (2, 'Sierra Foothills', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (3, 'Sonoma Valley', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (4, 'CA Central Valley', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (5, 'Bordeux', 'FRANCE');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (6, 'Sicily', 'ITALY');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (7, 'Albania', 'ALBANIA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (8, 'Algeria', 'ALGERIA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (9, 'California', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (10, 'Arizona', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (11, 'Arkansas', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (12, 'Colorado', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (13, 'Connecticut', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (14, 'Delaware', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (15, 'Idaho', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (16, 'Illinois', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (17, 'Indiana', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (18, 'Maryland', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (19, 'Massachusetts', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (20, 'Michigan', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (21, 'Minnisota', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (22, 'Mississippi', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (23, 'Missouri', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (24, 'New Jersey', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (25, 'New Mexico', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (26, 'New York', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (27, 'North Carolina', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (28, 'Ohio', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (29, 'Oregon', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (30, 'Pennsylvania', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (31, 'Texas', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (32, 'Virginia', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (33, 'Washington', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (34, 'Wisconsin', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (35, 'West Virginia', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (36, 'Tennesse', 'USA');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (37, 'Marllborough', 'New Zealand');
INSERT INTO `sommelier`.`tbl_regions` (`id`, `region_name`, `country`) VALUES (38, 'Unknown', 'Unknown');

COMMIT;


-- -----------------------------------------------------
-- Data for table `sommelier`.`tbl_appellations`
-- -----------------------------------------------------
START TRANSACTION;
USE `sommelier`;
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (208, 'Albania', 7, 'Zaberzan Skrapar', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (209, 'Algeria', 8, 'Chateau Romain', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (210, 'Algeria', 8, 'Chateau Tellagh', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (211, 'Algeria', 8, 'Coteaux de Mascara', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (212, 'Algeria', 8, 'Coteaux de Tlemcen', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (213, 'Algeria', 8, 'Coteaux de Zaccar', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (214, 'Algeria', 8, 'Cuvee du President', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (215, 'Algeria', 8, 'Dahra', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (216, 'Algeria', 8, 'Domaine Benchicao', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (217, 'Algeria', 8, 'Domaine Djendel', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (218, 'Algeria', 8, 'Domaine El Bordj', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (219, 'Algeria', 8, 'Domaine Khadra ', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (220, 'Algeria', 8, 'Domaine Mamounia ', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (221, 'Algeria', 8, 'Domaine Sebra', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (222, 'Algeria', 8, 'Medea', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (223, 'Algeria', 8, 'Monts du Tessala', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (155, 'USA', 10, 'Sonoita', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (4, 'USA', 11, 'Altus', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (7, 'USA', 11, 'Arkansas Mountain', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (113, 'USA', 11, 'Ozark Mountain [AR,MO,OK]', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (1, 'USA', 9, 'Alexander Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (3, 'USA', 9, 'Alta Mesa', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (5, 'USA', 9, 'Anderson Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (189, 'USA', 9, 'Antelope Valley of the California High Desert', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (8, 'USA', 9, 'Arroyo Grande Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (9, 'USA', 9, 'Arroyo Seco', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (10, 'USA', 9, 'Atlas Peak', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (13, 'USA', 9, 'Ben Lomond Mountain', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (14, 'USA', 9, 'Benmore Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (15, 'USA', 9, 'Bennett Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (16, 'USA', 9, 'Borden Ranch', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (17, 'USA', 9, 'California Shenandoah Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (190, 'USA', 9, 'Calistoga', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (18, 'USA', 9, 'Capay Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (19, 'USA', 9, 'Carmel Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (22, 'USA', 9, 'Central Coast', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (24, 'USA', 9, 'Chalk Hill', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (25, 'USA', 9, 'Chalone', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (27, 'USA', 9, 'Chiles Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (28, 'USA', 9, 'Cienega Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (29, 'USA', 9, 'Clarksburg', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (30, 'USA', 9, 'Clear Lake', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (31, 'USA', 9, 'Clement Hills', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (32, 'USA', 9, 'Cole Ranch', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (191, 'USA', 9, 'Coombsville', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (35, 'USA', 9, 'Cosumnes River', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (36, 'USA', 9, 'Covelo', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (37, 'USA', 9, 'Cucamonga Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (39, 'USA', 9, 'Diablo Grande', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (40, 'USA', 9, 'Diamond Mountain District', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (41, 'USA', 9, 'Dos Rios', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (42, 'USA', 9, 'Dry Creek Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (44, 'USA', 9, 'Dunnigan Hills', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (45, 'USA', 9, 'Edna Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (46, 'USA', 9, 'El Dorado', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (49, 'USA', 9, 'Fair Play', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (51, 'USA', 9, 'Fiddletown', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (192, 'USA', 9, 'Fort Ross-Seaview', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (56, 'USA', 9, 'Green Valley of Russian River Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (57, 'USA', 9, 'Guenoc Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (58, 'USA', 9, 'Hames Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (193, 'USA', 9, 'Happy Canyon of Santa Barbara', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (61, 'USA', 9, 'High Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (63, 'USA', 9, 'Howell Mountain', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (194, 'USA', 9, 'Inwood Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (66, 'USA', 9, 'Jahant', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (68, 'USA', 9, 'Knights Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (195, 'USA', 9, 'Leona Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (75, 'USA', 9, 'Lime Kiln Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (77, 'USA', 9, 'Livermore Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (78, 'USA', 9, 'Lodi', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (81, 'USA', 9, 'Los Carneros', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (82, 'USA', 9, 'Madera', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (83, 'USA', 9, 'Malibu-Newton Canyon', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (85, 'USA', 9, 'McDowell Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (87, 'USA', 9, 'Mendocino', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (88, 'USA', 9, 'Mendocino Ridge', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (89, 'USA', 9, 'Merritt Island', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (94, 'USA', 9, 'Mokelumne River', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (95, 'USA', 9, 'Monterey', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (97, 'USA', 9, 'Mount Harlan', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (98, 'USA', 9, 'Mount Veeder', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (99, 'USA', 9, 'Napa Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (101, 'USA', 9, 'North Coast', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (104, 'USA', 9, 'North Yuba', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (106, 'USA', 9, 'Northern Sonoma', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (107, 'USA', 9, 'Oak Knoll District of Napa Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (108, 'USA', 9, 'Oakville', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (114, 'USA', 9, 'Pacheco Pass', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (115, 'USA', 9, 'Paicines', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (116, 'USA', 9, 'Paso Robles', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (196, 'USA', 9, 'Pine Mountain-Cloverdale Peak', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (117, 'USA', 9, 'Potter Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (119, 'USA', 9, 'Ramona Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (122, 'USA', 9, 'Red Hills Lake County', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (124, 'USA', 9, 'Redwood Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (126, 'USA', 9, 'River Junction', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (127, 'USA', 9, 'Rockpile', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (130, 'USA', 9, 'Russian River Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (131, 'USA', 9, 'Rutherford', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (132, 'USA', 9, 'Saddle Rock Malibu', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (133, 'USA', 9, 'Saint Helena', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (134, 'USA', 9, 'Salado Creek', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (135, 'USA', 9, 'San Antonio Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (136, 'USA', 9, 'San Benito', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (137, 'USA', 9, 'San Bernabe', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (138, 'USA', 9, 'San Francisco Bay', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (139, 'USA', 9, 'San Lucas', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (140, 'USA', 9, 'San Pasqual Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (141, 'USA', 9, 'San Ysidro District', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (142, 'USA', 9, 'Santa Clara Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (143, 'USA', 9, 'Santa Cruz Mountains', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (144, 'USA', 9, 'Santa Lucia Highlands', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (145, 'USA', 9, 'Santa Maria Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (146, 'USA', 9, 'Santa Ynez Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (147, 'USA', 9, 'Seiad Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (151, 'USA', 9, 'Sierra Foothills', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (197, 'USA', 9, 'Sierra Pelona Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (152, 'USA', 9, 'Sloughhouse', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (154, 'USA', 9, 'Solano County Green Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (156, 'USA', 9, 'Sonoma Coast', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (157, 'USA', 9, 'Sonoma Mountain', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (158, 'USA', 9, 'Sonoma Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (159, 'USA', 9, 'South Coast', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (162, 'USA', 9, 'Spring Mountain District', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (163, 'USA', 9, 'Sta. Rita Hills', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (164, 'USA', 9, 'Stags Leap District', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (165, 'USA', 9, 'Suisun Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (166, 'USA', 9, 'Temecula Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (171, 'USA', 9, 'Tracy Hills', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (172, 'USA', 9, 'Trinity Lakes', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (180, 'USA', 9, 'Wild Horse Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (182, 'USA', 9, 'Willow Creek', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (186, 'USA', 9, 'York Mountain', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (187, 'USA', 9, 'Yorkville Highlands', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (188, 'USA', 9, 'Yountville', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (55, 'USA', 12, 'Grand Valley', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (178, 'USA', 12, 'West Elks', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (160, 'USA', 13, 'Southeastern New England [CT,MA,RI]', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (179, 'USA', 13, 'Western Connecticut Highlands', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (23, 'USA', 14, 'Central Delaware Valley [NJ,PA]', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (153, 'USA', 15, 'Snake River Valley [ID,OR]', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (149, 'USA', 16, 'Shawnee Hills', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (198, 'USA', 17, 'Indiana Uplands', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (109, 'USA', 17, 'Ohio River Valley [IN,KY,OH,WV]', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (20, 'USA', 18, 'Catoctin', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (38, 'USA', 18, 'Cumberland Valley [MD,PA]', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (76, 'USA', 18, 'Linganore', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (84, 'USA', 19, 'Martha\'s Vineyard', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (50, 'USA', 20, 'Fennville', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (70, 'USA', 20, 'Lake Michigan Shore', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (73, 'USA', 20, 'Leelanau Peninsula', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (110, 'USA', 20, 'Old Mission Peninsula', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (2, 'USA', 21, 'Alexandria Lakes', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (93, 'USA', 22, 'Mississippi Delta [LA,MS,TN]', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (11, 'USA', 23, 'Augusta', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (60, 'USA', 23, 'Hermann', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (112, 'USA', 23, 'Ozark Highlands', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (111, 'USA', 24, 'Outer Coastal Plain', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (177, 'USA', 24, 'Warren Hills', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (90, 'USA', 25, 'Mesilla Valley [NM,TX]', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (91, 'USA', 25, 'Middle Rio Grande Valley', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (92, 'USA', 25, 'Mimbres Valley', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (21, 'USA', 26, 'Cayuga Lake', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (52, 'USA', 26, 'Finger Lakes', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (64, 'USA', 26, 'Hudson River Region', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (69, 'USA', 26, 'Lake Erie [NY,OH,PA]', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (79, 'USA', 26, 'Long Island', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (100, 'USA', 26, 'Niagara Escarpment', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (102, 'USA', 26, 'North Fork of Long Island', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (148, 'USA', 26, 'Seneca Lake', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (59, 'USA', 26, 'The Hamptons, Long Island', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (199, 'USA', 27, 'Haw River Valley', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (200, 'USA', 27, 'Swan Creek', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (183, 'USA', 27, 'Yadkin Valley', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (54, 'USA', 28, 'Grand River Valley', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (65, 'USA', 28, 'Isle St. George', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (80, 'USA', 28, 'Loramie Creek', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (6, 'USA', 29, 'Applegate Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (26, 'USA', 29, 'Chehalem Mountains', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (33, 'USA', 29, 'Columbia Gorge [OR,WA]', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (34, 'USA', 29, 'Columbia Valley [OR,WA]', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (43, 'USA', 29, 'Dundee Hills', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (201, 'USA', 29, 'Elkton Oregon', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (47, 'USA', 29, 'Eola Amity Hills', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (86, 'USA', 29, 'McMinnville', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (121, 'USA', 29, 'Red Hill Douglas County', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (125, 'USA', 29, 'Ribbon Ridge', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (129, 'USA', 29, 'Rogue Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (161, 'USA', 29, 'Southern Oregon', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (173, 'USA', 29, 'Umpqua Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (176, 'USA', 29, 'Walla Walla Valley [OR,WA]', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (181, 'USA', 29, 'Williamette Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (185, 'USA', 29, 'Yamhill-Carlton District', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (72, 'USA', 30, 'Lancaster Valley', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (74, 'USA', 30, 'Lehigh Valley', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (12, 'USA', 31, 'Bell Mountain', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (48, 'USA', 31, 'Escondido Valley', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (53, 'USA', 31, 'Fredericksburg in the Texas Hill Country', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (167, 'USA', 31, 'Texas Davis Mountains', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (168, 'USA', 31, 'Texas High Plains', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (169, 'USA', 31, 'Texas Hill Country', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (170, 'USA', 31, 'Texoma', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (202, 'USA', 32, 'Middleburg Virginia', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (96, 'USA', 32, 'Monticello', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (103, 'USA', 32, 'North Fork of Roanoke', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (105, 'USA', 32, 'Northern Neck George Washington Birthplace', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (128, 'USA', 32, 'Rocky Knob', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (150, 'USA', 32, 'Shenandoah Valley [VA,WV]', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (174, 'USA', 32, 'Virginia\'s Eastern Shore', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (203, 'USA', 33, 'Ancient Lakes of Columbia Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (62, 'USA', 33, 'Horse Heaven Hills', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (204, 'USA', 33, 'Lake Chelan', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (205, 'USA', 33, 'Naches Heights', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (118, 'USA', 33, 'Puget Sound', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (120, 'USA', 33, 'Rattlesnake Hills', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (123, 'USA', 33, 'Red Mountain', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (206, 'USA', 33, 'Snipes Mountain', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (175, 'USA', 33, 'Wahluke Slope', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (184, 'USA', 33, 'Yakima Valley', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (67, 'USA', 35, 'Kanawha River Valley [OH,WV]', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (71, 'USA', 34, 'Lake Wisconsin', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (207, 'USA', 34, 'Wisconsin Ledge', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (224, 'USA', 36, 'Middle Tennesse', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (225, 'New Zealand', 37, 'Marllborough', 'N');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (226, 'France', 5, 'Bordeau', 'Y');
INSERT INTO `sommelier`.`tbl_appellations` (`id`, `country`, `region_id`, `appellation`, `common_flg`) VALUES (227, 'Unknown', 38, 'Unknown', 'N');

COMMIT;


-- -----------------------------------------------------
-- Data for table `sommelier`.`tbl_wineries`
-- -----------------------------------------------------
START TRANSACTION;
USE `sommelier`;
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (1, 'Cantiga Wineworks', 49, '530-555-1212', 'Rich', 'Rich', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (2, 'Van der Vijer', 49, '530-555-1213', 'Robert Van der Vijer', 'Robert Van der Vijer', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (3, 'Sobon Estates', 17, '530-555-1214', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (4, 'Charles Mitchell', 49, '530-555-1215', 'Charles Mitchell', 'Unknown', '2013-11-04 18:20:20', '2013-11-04 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (5, 'Arrington Winery', 224, '615-555-1111', 'Kick Brooks', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (6, 'Edna Valley Winery', 45, '888-555-2222', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (7, 'Brancott Estate', 225, '888-555-3333', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (8, 'Chateau de Macard', 226, '888-555-4444', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (9, 'Cielo Estate', 46, '888-555-5555', 'Bill Manson', 'Robert Van der Vijer', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (10, 'Cypher', 116, '888-555-6666', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (11, 'Donati', 45, '888-555-7777', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (12, 'Greywacke', 225, '888-555-8888', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (13, 'Karmere', 17, '888-555-9999', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (14, 'La Pristina', 9, '877-555-1111', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (15, 'Laetitia', 8, '877-555-2222', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (16, 'Miraflores', 49, '877-555-3333', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (17, 'Palisandro', 49, '877-555-4444', 'Unknown', 'Robert Van der Vijer', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (18, 'Patianna', 87, '877-555-5555', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (19, 'Sea Ridge', 227, '111-222-3333', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (20, 'Sextant', 116, '111-333-2222', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (21, 'Sierra Vista', 49, '222-111-3333', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (22, 'Story Vineyards', 17, '333-222-1111', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (23, 'Summerwood', 116, '444-222-1212', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');
INSERT INTO `sommelier`.`tbl_wineries` (`id`, `winery_name`, `default_appellation_id`, `phone`, `proprietor_name`, `winemaker_name`, `create_dt`, `update_dt`) VALUES (24, 'Trenza', 116, '555-333-2222', 'Unknown', 'Unknown', '2013-10-28 18:20:20', '2013-10-28 18:20:20');

COMMIT;


-- -----------------------------------------------------
-- Data for table `sommelier`.`tbl_varietals`
-- -----------------------------------------------------
START TRANSACTION;
USE `sommelier`;
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (1, 'Airen', 'N', 'White', 'By acreage the most widely planted white varietal in Spain, and the world as well.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (2, 'Albalonga', 'N', 'Red', 'German crossing known for producing rich if undistinguished dessert wines.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (3, 'Albarino', 'N', 'White', 'The great white grape of Galicia in northeastern Spain, which shows many characteristics of the riesling, but with a bit of honeysuckle in the nose that?s more reminiscent of viognier.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (4, 'Alvarinho', 'N', 'Red', 'The Portuguese name for the immediately above from which vinho verde is created.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (5, 'Alicante Bouschet', 'N', 'Red', 'Nearly unique among red wine grapes, in that its juice is not white?solid pinkish, rather. Good CA blender.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (6, 'Aligote', 'N', 'White', 'The second-tier grape of white burgundy, frequently dosed with creme de cassis to make kir.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (7, 'Barbera', 'Y', 'Red', 'Aggressive high-acid Piemontese red wine varietal, more suited to red sauce or red meat than to simple sipping.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (8, 'Blaufrankisch', 'N', 'Red', 'Among the more interesting of the Austrian red varietals, solid body, good straightforward flavors, picks up earth tones well.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (9, 'Brachetto', 'N', 'Red', 'A red Muscat variety producing slightly fizzy low-alcohol dessert reds in Piemonte');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (10, 'Cabernet Franc', 'Y', 'White', 'Very useful Bordeaux blender, softens the cabernet sauvignon in Medoc blends. Stands alone as a soft, luxuriant, chocolatey red in CA, food-friendly middleweight in France?s Anjou and Tourane.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (11, 'Cabernet Sauvignon', 'Y', 'Red', 'The great red grape of the Medoc, makes pretty decent wine in California and Australia, as well.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (12, 'Carignane/Carinena', 'Y', 'Red', 'Southern France & California for the first spelling, and Spain for the second, ripens rather well, full body.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (13, 'Carminere', 'N', 'Red', 'A substantial chunk of Chilean merlot has recently been shown to be this vanished sixth Bordeaux varietal.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (14, 'Catawba', 'N', 'Red', 'Good ?ol old fashioned Yankee grape. Nothing special.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (15, 'Chambourcin', 'N', 'Red', 'Hybrid varietal planted on the east coast USA; some pleasant aromatics, blends decently with pinot noir.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (16, 'Chardonnay', 'Y', 'White', 'Charter member of the champagne trio, where it absolutely shines as a stand-alone and a blender. Great white burgundies, not-so-great-but-still-yummy white burgundies, honking big California and Australian whites?');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (17, 'Chasselas/Gutedel', 'N', 'White', 'Light white with considerable terroir interest in Alsace and Switzerland under the former name, appears in Rheinhessen as the latter.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (18, 'Chenin Blanc', 'Y', 'White', 'Number one great white of the France?s Loire valley, long-living whites both dry and moelleux from Coteau de Layon and Vouvray, (also good value sparklers) and august dry white from Savennieres.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (19, 'Cinsault', 'Y', 'Red', 'Rhone valley blending red. Member of the Chateauneuf-du-Pape crew.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (20, 'Corvina', 'N', 'Red', 'A good chunk of what goes into Valpolicella, Amarone, and Bardolino.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (21, 'Counoise', 'N', 'Red', 'Rhone valley blending red. Member of the Chateauneuf-du-Pape crew.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (22, 'Dolcetto', 'Y', 'Red', 'Piemonte varietal producing luxuriously textured softish zaftig reds.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (23, 'Dornfelder', 'Y', 'Red', 'Rheinpfalz reds of some character, earthy and showing a bit of spice.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (24, 'Duriff', 'N', 'Red', 'French minor-leaguer once thought to be same as CA?s Petite Syrah.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (25, 'Dunkelfelder', 'N', 'Red', 'German red, not invariably awful, but rarely of interest.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (26, 'Ehrenfelser', 'N', 'White', 'Rheingau crossing, some interesting spicy white wines.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (27, 'Folle blanche', 'N', 'Red', 'French sort best used for distilling into firewater.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (28, 'French colombard', 'Y', 'White', 'Southern French, also used for brandy, widely planted for California jug-whites.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (29, 'Gamay', 'Y', 'Red', '(Un)fortunately banned in Burgundy (ca. 1486) by Duke Zorro the Vivisector, this cat beat it south to Beaujolais where he flourishes in the pretty weather. Can be made into real wine (Morgon, Moulin-a-Vent) as well as the dreaded Nouveau.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (30, 'Gewurztraminer', 'Y', 'White', 'German name, Italian origins (Termin); produces spicy (wurzig) aromatic whites in France?s Alsace region. Big wines?lots of flavor if occasionally simple.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (31, 'Graciano', 'N', 'Red', 'Spanish red varietal (small black grapes in Rioja and Navarra) producing high acid juice, blends nicely with tempranillo.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (32, 'Grenache/Garnacha', 'Y', 'Red', 'Prolific easy-ripening red popular in southern Rhone and Spain.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (33, 'Grenache Blanc', 'Y', 'White', 'Cotes-du-Rhone white varietal. Easy ripeness and alcohol makes it popular among growers.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (34, 'Gruner Veltliner', 'N', 'White', 'The Austrian national treasure?either light dry wines for guzzling in cafe, or profound fullbodied whites of a Burgundian cast. Characteristic green-pepper snap, nice citric aromas.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (35, 'Huxelrebe', 'N', 'Red', 'German crossing which ripens rather easily, and produces high-Pradikat wines of no particular distinction');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (36, 'Ives noir', 'N', 'Red', 'We needed an item beginning with ?I? and discovered this rare bird hiding up in the Finger Lakes.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (37, 'Jacquere', 'N', 'White', 'White grape making light crisp whites in Savoie.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (38, 'Kerner', 'N', 'White', 'Slightly unique crossing of riesling with trollinger (that?s a white with a red?), spicy soft wines from the Pfalz.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (39, 'Klevner', 'N', 'Red', 'Occasionally called pinot blanc in Alsace, as is auxerrois?the two are sometimes rather casually blended.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (40, 'Lemberger', 'N', 'Red', 'Red German varietal, (Austria?s Blaufrankisch) some tasty wines, some merely quirky. Not so distinctively aromatic as the homophonous formaggio?');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (41, 'Malbec', 'Y', 'Red', 'Useful Bordeaux blender, stands alone in Cahors where it yields big reds of character, and in Argentina, where it is responsible for a number of interesting medium-priced wines.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (42, 'Malmsey', 'N', 'Red', 'Madiera?s name for the malvasia, producing rich sweet fortified wines. See ?Duke of Clarence??');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (43, 'Malvasia', 'N', 'White', 'A collection of white varietals of distant Greek origin, often blended in Italy and Spain to yield wines of interest.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (44, 'Marechal Foch', 'N', 'Red', 'French/American hybrid red. Planted in the eastern US, with no spectacular results.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (45, 'Marsanne', 'Y', 'White', 'White Rhone favorite, also grown in state of Victoria.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (46, 'Melon de Bourgogne', 'N', 'Red', 'The grape of Muscadet. Also much of what?s been called pinot blanc in Califonia.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (47, 'Merlot', 'Y', 'Red', 'Source of the rare and precious Pomerol (and St. Emilion) in Bordeaux, along with a lot of nondescript soft reds from California and sometimes from Australia. Occasionally interesting as an Italian, from Tuscany, Friuli and elsewhere.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (48, 'Molinara', 'N', 'Red', 'Important member of the Valpolicella syndicate.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (49, 'Montepulciano', 'N', 'Red', 'The grape, not the village. Planted in the Abruzzo and the Marche regions of eastern Italia. Soft interesting reds. On the rise.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (50, 'Mourvedre/mataro', 'N', 'Red', 'Spanish, Cotes du Rhone and Provencial reds, frequently of great distinction, particularly when vines are old and yields are kept in check. Does nicely in California.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (51, 'Muller-thurgau', 'N', 'Red', 'German crossing of Riesling and Sylvaner, rarely distinguished.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (52, 'Muscadelle', 'N', 'Red', 'Sometimes seen in Sauternes blends, and in Gaillac.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (53, 'Muscat', 'Y', 'Red', 'Grand Cru Alsace, bright spritzy Portuguese, grand and viscous Australian fortified desserts?');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (54, 'Muskateller', 'N', 'White', 'Dry, spicy, tropical-fruit-toned whites from Austria and Germany.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (55, 'Nebbiolo', 'Y', 'Red', 'From Piemonte, the great red grape of Barolo and Barbaresco. Country-cousins are Gattinara, Ghemme, and Carema. Also called spanna?its home tag.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (56, 'Negromaro', 'N', 'Red', 'Southern Italian red?name means ?black and bitter.? Any questions?');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (57, 'Norton', 'N', 'Red', 'Indigenous Virginia varietal, famous for the Monticello clarets in the 19th century, occasionally observed nowadays to produce real wine.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (58, 'Odjaleshi', 'N', 'Red', 'Red from (formerly Soviet) Georgia.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (59, 'Ortega', 'N', 'Red', 'German heavyweight of no real distinction.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (60, 'Palomino', 'N', 'White', 'Spanish white, used to make dry sherries, and blended with PX to make the sweeter ones.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (61, 'Parellada', 'N', 'Red', 'Solid component of fizzy Cava in the Penedes region of Spain.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (62, 'Pedro Ximenez', 'N', 'Red', 'PX makes fabulously rich sweet wines in Montilla, and is used to enrich cream sherries');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (63, 'Petite Verdot', 'Y', 'Red', 'Bordeaux blender?if it wasn?t there, you?d miss it.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (64, 'Petite Sirah', 'Y', 'Red', 'A blender essential for making Zinfandel into great wine. Occasionally interesting as a varietal, now thought to be a loose confederation of some half-dozen minor French types planted together as a field blend in Sonoma, mostly 100 years ago.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (65, 'Pinot Auxerrois', 'N', 'White', 'Crisp Alsace whites, communicating interesting mineral tones.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (66, 'Pinot Blanc', 'Y', 'White', 'Light bodied gently spiced whites from Alsace, occasionally masquerades as Weissburgunder in Germany where it makes big fat wines.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (67, 'Pinot Gris /Pinot Grigio', 'Y', 'White', 'Produces whites both sublime and ridiculous in Alsace and Italy. Very fleshy and masculine in the former, light and dry in the latter. Planted in Oregon, where it produces some of the most interesting American whites, very much after the Alsace model. The Germans usually call it Grauburgunder?  They plant it in the south, in Baden, Franconia, the Pfalz.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (68, 'Pinot Noir', 'Y', 'Red', 'The brilliant?if occasionally difficult?red grape of Burgundy. Does well in California, Oregon, Germany, occasionally in Victoria. A standout in Champagne.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (69, 'Pinot Meunier', 'N', 'Red', 'Thusly named because the plant looks like the miller (Le Meunier) has been dusting the leaves with flour. Germans call it Mullerrebe for the same reason. Important third in the trio of champagne varietals, where it?s a sponge for soaking up terroir. ');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (70, 'Pinotage', 'Y', 'Red', 'South African crossing of cinsault and pinot noir. Interesting aromatic middleweight.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (71, 'Primitivo', 'Y', 'Red', 'Southern Italian red genetically resonant with California?s zinfandel.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (72, 'Quagliano', 'N', 'Red', 'Makes pale red sparklers in Piemonte, and begins with ?q.?');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (73, 'Riesling', 'Y', 'White', 'Great white grape of Germany, Austria, Alsace?very much a magnet for earth-tones, even with all of its glorious fruit?very popular once upon a time in Australia, and occasionally offering interesting wines in California.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (74, 'Rondinella', 'N', 'Red', 'See Corvina and Molinara.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (75, 'Roter Veltliner', 'N', 'White', 'Wachau-region rarity from Austria. White wine, despite the red label.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (76, 'Roussane', 'Y', 'White', 'Cotes du Rhone white grape. Nice soft, oily texture, spring flowers in the nose.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (77, 'Rulander', 'N', 'Red', 'Name used in Germany for the grauburgunder (pinot gris) when it yields a dessert wine. Ruland was the guy who brought the grape to Germany from Burgundy.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (78, 'Saint George', 'N', 'Red', 'This is Greek wine, made by wine Greeks. Red of sometimes surprisingly substantial character.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (79, 'Sangiovese/prugnolo', 'Y', 'Red', 'The great red grape of Tuscany?Chianta, Vino Nobile di Montepulciano, and (as sangioveto grosso) Brunello.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (80, 'Sankt Laurent', 'N', 'Red', 'Earthy Austrian red with spicy aromatics, often interesting.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (81, 'Sauvignon blanc', 'Y', 'White', 'Crisp dry whites on the Loire and from New Zealand, frequently overoaked pseudochards in California, surprisingly good in Austria?s Steiermark.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (82, 'Saperavi', 'N', 'Red', 'Another Georgian.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (83, 'Scheurebe', 'N', 'White', '1916 crossing of Riesling and Sylvanner?German whites both dry and sweet with magnificent tropical fruit aromas, burgundian texture.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (84, 'Schwarzriesling', 'N', 'Red', 'Franconian name for Mullerrebe, which is German name for pinot meunier.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (85, 'Scuppernong', 'N', 'Red', 'Slightly obscene-sounding eastern American wild thing with fabulously proportioned vines and forgettable wines.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (86, 'Semillon', 'Y', 'White', 'Bordeaux white, prime mover of the great dessert wines of Sauternes. Good figgy-aromatic dry whites from Graves, quite interesting dry whites from Australia, where it also blends well with chardonnay.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (87, 'Siegerrebe', 'N', 'White', 'This German white type will even ripen in England!');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (88, 'Syrah/Shiraz', 'Y', 'Red', 'Oh boy! The great long-living reds of the northern Cotes-du-Rhone, frequently impressive in California, interesting in Italy, Spain and Argentina?as Shiraz the benchmark for Australian red wine, where it shows a variety of styles, from soft and fruity to world-class profound. Also grown in South Africa.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (89, 'Sylvaner', 'N', 'White', 'Slightly rustic mildly spicy white from Alsace and Germany.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (90, 'Tempranillo', 'Y', 'Red', 'The great red grape of Spain, seen in many guises (Cencibel, Tinta del Pais, Tinto Fino, Tinto de Toro, et al) from the more delicate medium-bodied traditional Riojas to the rich, full bodied, more Bordeaux-like Ribera del Dueros to the powerfully ripe Toros.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (91, 'Tocai Friulano', 'N', 'White', 'aka sauvignon vert, sometimes bottled in Chile as sauvignon blanc; some nice crisp whites.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (92, 'Touriga Nacional', 'N', 'Red', 'Important in creating the great Portuguese fortified wines of Oporto.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (93, 'Trebbiano', 'N', 'Red', 'Italian of many uses (ugni blanc in France) including the vin santo of Tuscany.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (94, 'Ugni Blanc', 'N', 'White', 'Used to make Armagnac in Gascony, and to make wine by people who are too impatient to make Armagnac.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (95, 'Vidal Blanc', 'N', 'White', 'American /French white hybrid of little virtue.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (96, 'Viognier', 'Y', 'White', 'Honeysuckle, orange-rind, mango-tinged aromatics. Silky textured white on the northern Cotes du Rhone, fat and succulent in California.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (97, 'Viura', 'N', 'White', 'Good solid aromatic white Spaniard, also known as Macabeo in France and Catalunyia. Needs no oak to smell nice.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (98, 'Welschriesling', 'N', 'Red', 'Austrian varietal known for massively rich and spicy dessert wines, decent dry onces.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (99, 'Xarello', 'N', 'Red', 'Finds its way into fizz in Spain?s Penedes.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (100, 'Yuga', 'N', 'Red', 'Y? Because we love you.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (101, 'Zinfandel', 'Y', 'Red', 'The great American success story. Spicy rich complex wines, particularly in Sonoma; hulking monolithic offerings from Amador and elsewhere in the Sierra Nevada range.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (102, 'Zweigelt', 'N', 'Red', 'Austrian red, the source of many easy-quaffers, but with a bit of what almost might be considered pinot noir character.');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (103, 'Red Blend', 'Y', 'Red', 'Proprietors blend of red wines - no more than 49% of any single grape');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (104, 'White Blend', 'Y', 'White', 'Proprietors blend of red wines - no more than 49% of any single grape');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (105, 'Desert', 'Y', 'Red', 'Sweet Desert Wine');
INSERT INTO `sommelier`.`tbl_varietals` (`id`, `name`, `common_flg`, `varietal_type`, `description`) VALUES (106, 'Rose/Blush', 'Y', 'Blush', 'A typically blush or light red wine made from red grapes with skins removed early in the crush processing to produce a pink colored wine.');

COMMIT;


-- -----------------------------------------------------
-- Data for table `sommelier`.`tbl_wines`
-- -----------------------------------------------------
START TRANSACTION;
USE `sommelier`;
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (1, 'Syrah', 5, 224, 'nv', 88, '2013-11-25 20:00:00', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Syrah', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (2, 'Sauvignon Blanc', 7, 225, '2012', 81, '2013-11-25 20:00:01', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'marllborough New Zealand', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (3, 'Sierra Foothills', 1, 151, '2006', 7, '2013-11-25 20:00:02', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Sierra Foothills', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (4, 'Monterey Oakless', 1, 95, '2010', 16, '2013-11-25 20:00:03', '750ml', 'label_image_00003.jpg', 'jpg', 94, 'Monterey Oakless', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (5, 'Monterey Barrel Aged', 1, 95, '2003', 16, '2013-11-25 20:00:04', '750ml', 'label_image_00002.jpg', 'jpg', 92, 'Monterey Barrel Aged', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (6, 'El Dorado Estate Late Harvest Zinfandel', 1, 49, '2011', 32, '2013-11-25 20:00:05', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado Estate', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (7, 'Nocturne El Dorado', 1, 49, '2004', 101, '2013-11-25 20:00:06', '375ml', 'label_image_00000.jpg', 'jpg', 89, 'Nocturne El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (8, 'El Dorado Estate', 1, 49, '2006', 64, '2013-11-25 20:00:07', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado Estate', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (9, 'El Dorado Estate', 1, 49, '2009', 64, '2013-11-25 20:00:08', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado Estate', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (10, 'Vintage Dessert Wine Lodi', 1, 78, '2002', 64, '2013-11-25 20:00:09', '375ml', 'label_image_00000.jpg', 'jpg', 89, 'Vintage Dessert Wine Lodi', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (11, 'Petite Sirah Vintage Dessert wine', 1, 49, '2002', 64, '2013-11-25 20:00:10', '375ml', 'label_image_00000.jpg', 'jpg', 89, 'Petite Sirah Vintage Dessert wine', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (12, 'Petite Suite', 1, 49, '2007', 64, '2013-11-25 20:00:11', '375ml', 'label_image_00000.jpg', 'jpg', 89, 'Petite Suite', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (13, 'El Dorado Estate', 1, 49, '2010', 86, '2013-11-25 20:00:12', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado Estate', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (14, 'El Dorado', 1, 49, '2009', 86, '2013-11-25 20:00:13', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (15, 'Monterey', 1, 95, '2003', 64, '2013-11-25 20:00:14', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Monterey', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (16, 'El Dorado', 1, 46, '2003', 88, '2013-11-25 20:00:15', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (17, 'El Dorado Herbert Vineyard', 1, 46, '2008', 101, '2013-11-25 20:00:16', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado Herbert Vineyard', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (18, 'Reserve Naylor', 4, 46, '2006', 7, '2013-11-25 20:00:17', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Reserve Naylor', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (19, 'Fairplay Estate', 4, 46, '2008', 103, '2013-11-25 20:00:18', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Fairplay Estate', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (20, 'Bottle Your Own', 4, 46, 'nv', 47, '2013-11-25 20:00:19', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Bottle Your Own', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (21, 'Estate', 4, 46, '2007', 64, '2013-11-25 20:00:20', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Estate', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (22, 'Green Vineyards', 4, 46, '2007', 88, '2013-11-25 20:00:21', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Green Vineyards', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (23, 'Reserve', 4, 46, '2004', 88, '2013-11-25 20:00:22', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Reserve', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (24, 'Reserve El Dorado', 4, 46, '2005', 88, '2013-11-25 20:00:23', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Reserve El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (25, 'El Dorado', 4, 46, '2007', 101, '2013-11-25 20:00:24', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (26, 'El Dorado', 4, 46, '2007', 101, '2013-11-25 20:00:25', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (27, 'Bottle Your Own', 4, 46, 'nv', 101, '2013-11-25 20:00:26', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Bottle Your Own', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (28, 'Bordeau', 8, 226, '2010', 103, '2013-11-25 20:00:27', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Bordeau', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (29, 'Sierra Foothills', 9, 151, '2010', 103, '2013-11-25 20:00:28', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Sierra Foothills', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (30, 'El Dorado', 9, 49, '2011', 7, '2013-11-25 20:00:29', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (31, 'El Dorado', 9, 49, '2009', 32, '2013-11-25 20:00:30', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (32, 'Sierra Foothills', 9, 151, '2009', 103, '2013-11-25 20:00:31', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Sierra Foothills', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (33, 'El Dorado', 9, 46, '2009', 90, '2013-11-25 20:00:32', '500ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (34, 'Fairplay Estate', 9, 49, '2005', 79, '2013-11-25 20:00:33', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Fairplay Estate', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (35, 'Reserve Fairplay', 9, 49, '2006', 64, '2013-11-25 20:00:34', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Reserve Fairplay', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (36, 'Paso Robles', 10, 116, '2009', 64, '2013-11-25 20:00:35', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Paso Robles', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (37, 'Paso Robles', 10, 116, '2008', 64, '2013-11-25 20:00:36', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Paso Robles', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (38, 'Loco - Paso Robles', 10, 116, '2009', 90, '2013-11-25 20:00:37', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Paso Robles', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (39, 'Paso Robles', 10, 116, '2009', 103, '2013-11-25 20:00:38', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Paso Robles', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (40, 'Paso Robles', 10, 116, '2010', 88, '2013-11-25 20:00:39', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Paso Robles', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (41, 'Paso Robles', 10, 116, '2009', 88, '2013-11-25 20:00:40', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Paso Robles', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (42, 'Central Coast', 11, 22, '2010', 11, '2013-11-25 20:00:41', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Central Coast', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (43, 'Reserve Estate Grown Paragon Vineyard', 6, 45, '2008', 16, '2013-11-25 20:00:42', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Reserve Estate Grown Paragon Vineyard', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (44, 'Paragon', 6, 45, '2010', 68, '2013-11-25 20:00:43', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Paragon', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (45, 'New Zealand', 12, 225, '2011', 81, '2013-11-25 20:00:44', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'New Zealand', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (46, 'Empress Juana - Primabera', 13, 17, '2011', 103, '2013-11-25 20:00:45', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Empress Juana', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (47, 'Empress La Petite Rachel', 13, 17, '2011', 88, '2013-11-25 20:00:46', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Empress La Petite Rachel', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (48, 'Edna Valley', 14, 45, '2010', 16, '2013-11-25 20:00:47', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Edna Valley', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (49, 'Arroyo Grande Valley', 15, 8, '2010', 68, '2013-11-25 20:00:48', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Arroyo Grande Valley', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (50, 'Sierra Foothills', 16, 46, 'nv', 105, '2013-11-25 20:00:49', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Sierra Foothills', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (51, 'Sierra Foothills', 16, 46, '2011', 7, '2013-11-25 20:00:50', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Sierra Foothills', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (52, 'El Dorado', 16, 46, '2010', 103, '2013-11-25 20:00:51', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (53, 'El Dorado', 16, 46, '2010', 50, '2013-11-25 20:00:52', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (54, 'El Dorado', 16, 46, '2009', 101, '2013-11-25 20:00:53', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (55, 'Felice', 17, 49, '2010', 103, '2013-11-25 20:00:54', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Felice', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (56, 'Fairplay Estate', 17, 49, 'nv', 103, '2013-11-25 20:00:55', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Fairplay Estate', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (57, 'Mendocino', 18, 87, '2009', 16, '2013-11-25 20:00:56', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Mendocino', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (58, 'Pinot Noir', 19, 227, '2000', 68, '2013-11-25 20:00:57', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Pinot Noir', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (59, 'Wheelhouse Paso Robles', 20, 116, '2010', 101, '2013-11-25 20:00:58', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Wheelhouse Paso Robles', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (60, 'Blend Fleur de Montagne', 21, 49, '2007', 103, '2013-11-25 20:00:59', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Blend Fleur de Montagne', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (61, 'Picnic Hill Vineyards', 22, 17, '2011', 101, '2013-11-25 20:00:60', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Picnic Hill Vineyards', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (62, 'Alitia', 22, 17, '2008', 101, '2013-11-25 20:00:61', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Alitia', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (63, 'Paso Robles', 23, 116, '2006', 88, '2013-11-25 20:00:62', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Paso Robles', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (64, 'San Luis Obispo', 24, 116, '2009', 103, '2013-11-25 20:00:63', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'San Luis Obispo', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (65, 'Reserve Amador County', 2, 17, '2006', 7, '2013-11-25 20:00:64', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Reserve Amador County', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (66, 'Reserve Amador County', 2, 17, '2006', 7, '2013-11-25 20:00:65', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Reserve Amador County', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (67, 'Reserve Sierra Oaks Vineyard El Dorado', 2, 46, '2007', 47, '2013-11-25 20:00:66', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Reserve Sierra Oaks Vineyard El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (68, 'Reserve El Dorado Sierra Oaks', 2, 46, '2007', 47, '2013-11-25 20:00:67', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Reserve El Dorado Sierra Oaks', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (69, 'Sierra Oaks Vineyard', 2, 46, '2007', 47, '2013-11-25 20:00:68', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Sierra Oaks Vineyard', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (70, 'Reserve', 2, 49, '2007', 88, '2013-11-25 20:00:69', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Reserve', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (71, 'Reserve', 2, 49, '2007', 88, '2013-11-25 20:00:70', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Reserve', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (72, 'Estate El Dorado', 2, 49, '2007', 90, '2013-11-25 20:00:71', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Estate El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (73, 'Reserve El Dorado', 2, 49, '2007', 101, '2013-11-25 20:00:72', '750ml', 'label_image_00001.jpg', 'jpg', 93, 'Reserve El Dorado', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (74, 'Amador', 2, 17, '2005', 101, '2013-11-25 20:00:73', '750ml', 'label_image_00000.jpg', 'jpg', 89, 'Amador', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (75, 'Amador ReZerve', 3, 17, '2007', 71, '2013-12-16 14:39:05', '750ml', 'label_image_00004.jpg', 'jpg', 91, 'Really good wine and a great value for the price', NULL, NULL);
INSERT INTO `sommelier`.`tbl_wines` (`id`, `wine_name`, `winery_id`, `appellation_id`, `wine_year`, `wine_varietal_id`, `create_dt`, `bottle_size`, `image_file`, `image_type`, `overall_rating`, `description`, `upd_barcode`, `update_dt`) VALUES (76, 'Temprance Tarts Naughty Bawdy', 13, 17, 'nv', 103, '2013-12-16 14:40:00', '1L', 'label_image_00005.jpg', 'jpg', 90, 'Nice standard table wine in a 1 liter jug.  Fun to take to parties.', NULL, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `sommelier`.`tbl_user`
-- -----------------------------------------------------
START TRANSACTION;
USE `sommelier`;
INSERT INTO `sommelier`.`tbl_user` (`id`, `username`, `password`, `email`, `profile`, `create_dt`, `last_login_dt`, `first_name`, `last_name`, `country`, `state`, `favorite_region_id`, `allow_public_view`) VALUES (1, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'webmaster@example.com 	', 'demo user', '2013-10-28 18:20:20', NULL, 'demo', 'user', 'USA', 'CA', 1, 'N');
INSERT INTO `sommelier`.`tbl_user` (`id`, `username`, `password`, `email`, `profile`, `create_dt`, `last_login_dt`, `first_name`, `last_name`, `country`, `state`, `favorite_region_id`, `allow_public_view`) VALUES (2, 'jim', '58c688f4c95c43125542dfdadaad8834', 'jim@krethweb.org', 'Jim Kreth', '2013-10-28 18:20:20', NULL, 'Jim', 'Kreth', 'USA', 'TN', 2, 'Y');
INSERT INTO `sommelier`.`tbl_user` (`id`, `username`, `password`, `email`, `profile`, `create_dt`, `last_login_dt`, `first_name`, `last_name`, `country`, `state`, `favorite_region_id`, `allow_public_view`) VALUES (3, 'kim', '58c688f4c95c43125542dfdadaad8834', 'kim@krethweb.org', 'Kim Kreth', '2013-10-28 18:20:20', NULL, 'Kim', 'Kreth', 'USA', 'TN', 2, 'N');
INSERT INTO `sommelier`.`tbl_user` (`id`, `username`, `password`, `email`, `profile`, `create_dt`, `last_login_dt`, `first_name`, `last_name`, `country`, `state`, `favorite_region_id`, `allow_public_view`) VALUES (0, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@krethweb.org', 'Admin User', '2013-10-28 18:20:20', NULL, 'Admin', 'Admin', 'USA', 'TN', 1, 'N');

COMMIT;


-- -----------------------------------------------------
-- Data for table `sommelier`.`tbl_cellars`
-- -----------------------------------------------------
START TRANSACTION;
USE `sommelier`;
INSERT INTO `sommelier`.`tbl_cellars` (`id`, `owner_id`, `cellar_name`, `create_dt`, `default_cellar_loc_id`) VALUES (1, 2, 'Hill Road Wine Cellar', '2013-10-28 18:20:20', 5);
INSERT INTO `sommelier`.`tbl_cellars` (`id`, `owner_id`, `cellar_name`, `create_dt`, `default_cellar_loc_id`) VALUES (2, 3, 'Kim\'s Private Cellar', '2013-10-28 18:20:20', 7);
INSERT INTO `sommelier`.`tbl_cellars` (`id`, `owner_id`, `cellar_name`, `create_dt`, `default_cellar_loc_id`) VALUES (3, 2, 'Frans House in CA', '2013-10-28 18:20:20', 6);

COMMIT;


-- -----------------------------------------------------
-- Data for table `sommelier`.`tbl_cellar_location`
-- -----------------------------------------------------
START TRANSACTION;
USE `sommelier`;
INSERT INTO `sommelier`.`tbl_cellar_location` (`cellar_loc_id`, `cellar_id`, `location`, `location_desc`) VALUES (1, 1, 'Cooler', 'Wine Cooler in Kitchen');
INSERT INTO `sommelier`.`tbl_cellar_location` (`cellar_loc_id`, `cellar_id`, `location`, `location_desc`) VALUES (2, 1, 'Box', 'Wine in shipping Box in basement');
INSERT INTO `sommelier`.`tbl_cellar_location` (`cellar_loc_id`, `cellar_id`, `location`, `location_desc`) VALUES (3, 1, 'Cabinet', 'Wine cabinet in Living Room');
INSERT INTO `sommelier`.`tbl_cellar_location` (`cellar_loc_id`, `cellar_id`, `location`, `location_desc`) VALUES (4, 2, 'Box', 'Boxes at Fran\'s house in CA');
INSERT INTO `sommelier`.`tbl_cellar_location` (`cellar_loc_id`, `cellar_id`, `location`, `location_desc`) VALUES (5, 1, 'Other', 'Location not assigned');
INSERT INTO `sommelier`.`tbl_cellar_location` (`cellar_loc_id`, `cellar_id`, `location`, `location_desc`) VALUES (6, 2, 'Other', 'Location not assigned');
INSERT INTO `sommelier`.`tbl_cellar_location` (`cellar_loc_id`, `cellar_id`, `location`, `location_desc`) VALUES (7, 3, 'Other', 'Location not assigned');

COMMIT;


-- -----------------------------------------------------
-- Data for table `sommelier`.`tbl_cellar_wines`
-- -----------------------------------------------------
START TRANSACTION;
USE `sommelier`;
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (1, 1, 1, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (2, 1, 2, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (3, 1, 3, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (4, 1, 4, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (5, 1, 5, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (6, 1, 6, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (7, 1, 7, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (8, 1, 8, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (9, 1, 9, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (10, 1, 10, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (11, 1, 11, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (12, 1, 12, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (13, 1, 13, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (14, 1, 14, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (15, 1, 15, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (16, 1, 16, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (17, 1, 17, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (18, 1, 18, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (19, 1, 19, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (20, 1, 20, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (21, 1, 21, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (22, 1, 22, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 3);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (23, 1, 23, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (24, 1, 24, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (25, 1, 25, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (26, 1, 26, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (27, 1, 27, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (28, 1, 28, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (29, 1, 29, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (30, 1, 30, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (31, 1, 31, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (32, 1, 32, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (33, 1, 33, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (34, 1, 34, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (35, 1, 35, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (36, 1, 36, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (37, 1, 37, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (38, 1, 38, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (39, 1, 39, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (40, 1, 40, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (41, 1, 41, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (42, 1, 42, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (43, 1, 43, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (44, 1, 44, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (45, 1, 45, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (46, 1, 46, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (47, 1, 47, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (48, 1, 48, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (49, 1, 49, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (50, 1, 50, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (51, 1, 51, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (52, 1, 52, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (53, 1, 53, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (54, 1, 54, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (55, 1, 55, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (56, 1, 56, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (57, 1, 57, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (58, 1, 58, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (59, 1, 59, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (60, 1, 60, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (61, 1, 61, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (62, 1, 62, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (63, 1, 63, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (64, 1, 64, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (65, 1, 65, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (66, 1, 66, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (67, 1, 67, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 2);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (68, 1, 68, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 1);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (69, 1, 69, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 1);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (70, 1, 70, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 1);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (71, 1, 71, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 1);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (72, 1, 72, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 1);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (73, 1, 73, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 1);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (74, 1, 74, 1, 90, '11/25/2013 20:00', '11/25/2013 20:00', 0.00, 1);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (75, 1, 75, 1, 90, '12/16/2013 14:39', '11/25/2013 20:00', 0.00, 1);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (76, 1, 76, 1, 90, '12/16/2013 14:40', '12/16/2013 14:40', 0.00, 1);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (77, 2, 1, 24, 94, '2013-10-28 18:20:20', '2013-10-28 18:20:20', 23.00, 4);
INSERT INTO `sommelier`.`tbl_cellar_wines` (`id`, `cellar_id`, `wine_id`, `quantity`, `rating`, `create_dt`, `update_dt`, `cost`, `cellar_loc_id`) VALUES (78, 2, 3, 48, 91, '2013-10-28 18:20:20', '2013-10-28 18:20:20', 16.00, 4);

COMMIT;


-- -----------------------------------------------------
-- Data for table `sommelier`.`tbl_wine_comments`
-- -----------------------------------------------------
START TRANSACTION;
USE `sommelier`;
INSERT INTO `sommelier`.`tbl_wine_comments` (`id`, `user_id`, `wine_id`, `comment_dt`, `comment`) VALUES (1, 1, 1, '2013-10-28 18:20:20', 'Best Chardonay I\'ve ever tasted');

COMMIT;


-- -----------------------------------------------------
-- Data for table `sommelier`.`tbl_systemconfig`
-- -----------------------------------------------------
START TRANSACTION;
USE `sommelier`;
INSERT INTO `sommelier`.`tbl_systemconfig` (`id`, `systemName`, `version`, `wineOfTheDay_id`, `wineOfTheDay_dt`) VALUES (1, 'mySommelier', '0.1', 2, '2013-11-20 09:20:20');

COMMIT;

USE `sommelier`;

DELIMITER $$

USE `sommelier`$$
DROP TRIGGER IF EXISTS `sommelier`.`tbl_cellar_wines_AINS` $$
USE `sommelier`$$
CREATE TRIGGER `tbl_cellar_wines_AINS` AFTER INSERT ON `tbl_cellar_wines` 
FOR EACH ROW
begin
	UPDATE tbl_wines SET overall_rating = 
	(SELECT avg( rating )
		FROM tbl_cellar_wines
		WHERE wine_id = NEW.wine_id)
	WHERE tbl_wines.id = NEW.wine_id;
end
$$


USE `sommelier`$$
DROP TRIGGER IF EXISTS `sommelier`.`tbl_cellar_wines_AUPD` $$
USE `sommelier`$$
CREATE TRIGGER `tbl_cellar_wines_AUPD` AFTER UPDATE ON `tbl_cellar_wines`
FOR EACH ROW
begin
	UPDATE tbl_wines SET overall_rating = 
	(SELECT avg( rating )
		FROM tbl_cellar_wines
		WHERE wine_id = NEW.wine_id)
	WHERE tbl_wines.id = NEW.wine_id;
end
$$


DELIMITER ;
