SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `the_wall` ;
CREATE SCHEMA IF NOT EXISTS `the_wall` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `the_wall` ;

-- -----------------------------------------------------
-- Table `the_wall`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `the_wall`.`users` ;

CREATE  TABLE IF NOT EXISTS `the_wall`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `first_name` VARCHAR(255) NULL ,
  `last_name` VARCHAR(255) NULL ,
  `email` VARCHAR(255) NULL ,
  `password` VARCHAR(255) NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `the_wall`.`messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `the_wall`.`messages` ;

CREATE  TABLE IF NOT EXISTS `the_wall`.`messages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `message` TEXT NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_messages_users_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_messages_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `the_wall`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `the_wall`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `the_wall`.`comments` ;

CREATE  TABLE IF NOT EXISTS `the_wall`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `comment` TEXT NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  `user_id` INT NOT NULL ,
  `message_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_comments_users1_idx` (`user_id` ASC) ,
  INDEX `fk_comments_messages1_idx` (`message_id` ASC) ,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `the_wall`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_messages1`
    FOREIGN KEY (`message_id` )
    REFERENCES `the_wall`.`messages` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `the_wall` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
