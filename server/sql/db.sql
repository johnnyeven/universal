SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema universal_db
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `universal_db` ;
CREATE SCHEMA IF NOT EXISTS `universal_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `universal_db` ;

-- -----------------------------------------------------
-- Table `universal_db`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `universal_db`.`roles` ;

CREATE TABLE IF NOT EXISTS `universal_db`.`roles` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `account_id` BIGINT NOT NULL,
  `name` CHAR(16) NOT NULL,
  `planet_count` INT NOT NULL COMMENT '占领的行星数',
  `planet_count_max` INT NOT NULL COMMENT '占领行星的最大限制',
  PRIMARY KEY (`id`),
  INDEX `name` (`name` ASC),
  INDEX `account_id` (`account_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `universal_db`.`planets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `universal_db`.`planets` ;

CREATE TABLE IF NOT EXISTS `universal_db`.`planets` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `role_id` BIGINT NOT NULL,
  `name` CHAR(16) NOT NULL,
  `position_starfield` INT NOT NULL COMMENT '星域',
  `position_constellation` INT NOT NULL COMMENT '星座',
  `position_galaxy` INT NOT NULL COMMENT '星系',
  `position_index` INT NOT NULL COMMENT '星系索引',
  `resource_1` INT NOT NULL COMMENT '基础金属',
  `resource_2` INT NOT NULL COMMENT '活性气体',
  `resource_3` INT NOT NULL COMMENT '碳化合物',
  `resource_4` INT NOT NULL COMMENT '悬浮等离子',
  `resource_updated_at` INT NOT NULL,
  `resource_1_inc` DECIMAL NOT NULL COMMENT '基础金属每秒增加量',
  `resource_2_inc` DECIMAL NOT NULL,
  `resource_3_inc` DECIMAL NOT NULL,
  `resource_4_inc` DECIMAL NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `role_id` (`role_id` ASC),
  INDEX `position` (`position_starfield` ASC, `position_constellation` ASC, `position_galaxy` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `universal_db`.`skills`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `universal_db`.`skills` ;

CREATE TABLE IF NOT EXISTS `universal_db`.`skills` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `role_id` BIGINT NOT NULL,
  `skill_id` BIGINT NOT NULL,
  `name` CHAR(24) NOT NULL,
  `level` INT NOT NULL,
  `level_max` INT NOT NULL,
  `point` INT NOT NULL,
  `next_point` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `role_id` (`role_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `universal_db`.`skill_queue`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `universal_db`.`skill_queue` ;

CREATE TABLE IF NOT EXISTS `universal_db`.`skill_queue` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `role_id` BIGINT NOT NULL,
  `skill_id` BIGINT NOT NULL,
  `point` INT NOT NULL,
  `next_point` INT NOT NULL,
  `starttime` INT NOT NULL,
  `endtime` INT NOT NULL,
  `updated_at` INT NOT NULL,
  `statue` TINYINT NOT NULL DEFAULT 0 COMMENT '0=训' /* comment truncated */ /*��中
1=已完成*/,
  PRIMARY KEY (`id`),
  INDEX `role_id` (`role_id` ASC, `statue` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `universal_db`.`buildings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `universal_db`.`buildings` ;

CREATE TABLE IF NOT EXISTS `universal_db`.`buildings` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `role_id` BIGINT NOT NULL,
  `building_id` BIGINT NOT NULL,
  `name` CHAR(24) NOT NULL,
  `level` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `role_id` (`role_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `universal_db`.`fleets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `universal_db`.`fleets` ;

CREATE TABLE IF NOT EXISTS `universal_db`.`fleets` (
  `id` BIGINT NOT NULL,
  `fleet_id` BIGINT NOT NULL,
  `role_id` BIGINT NOT NULL,
  `name` CHAR(24) NOT NULL,
  `level` INT NOT NULL,
  `level_max` INT NOT NULL,
  `count` INT NOT NULL COMMENT '舰队',
  PRIMARY KEY (`id`),
  INDEX `role_id` (`role_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `universal_db`.`navigation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `universal_db`.`navigation` ;

CREATE TABLE IF NOT EXISTS `universal_db`.`navigation` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `role_id` BIGINT NOT NULL,
  `fleets` TEXT NOT NULL,
  `from_planet` BIGINT NOT NULL,
  `to_planet` BIGINT NOT NULL,
  `starttime` INT NOT NULL,
  `endtime` INT NOT NULL,
  `type` TINYINT NOT NULL DEFAULT 0 COMMENT '0=�' /* comment truncated */ /*遣
1=攻击
2=侦查*/,
  PRIMARY KEY (`id`),
  INDEX `role_id` (`role_id` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
