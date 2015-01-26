SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`user` ;

CREATE TABLE IF NOT EXISTS `mydb`.`user` (
  `iduser` INT(11) NOT NULL AUTO_INCREMENT,
  `loginname` VARCHAR(45) NOT NULL,
  `password` VARCHAR(128) NOT NULL,
  `firstname` VARCHAR(45) NULL DEFAULT NULL,
  `lastname` VARCHAR(45) NULL DEFAULT NULL,
  `salt` VARCHAR(45) NOT NULL,
  `createdby` INT(11) NULL DEFAULT NULL,
  `creationdate` DATE NULL DEFAULT NULL,
  `modifiedby` INT(11) NULL DEFAULT NULL,
  `modifieddate` DATE NULL DEFAULT NULL,
  `User_idUser` INT(11) NOT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE INDEX `loginName_UNIQUE` (`loginname` ASC),
  UNIQUE INDEX `salt_UNIQUE` (`salt` ASC),
  INDEX `fk_User_User1_idx` (`createdby` ASC),
  INDEX `fk_User_User2_idx` (`modifiedby` ASC),
  CONSTRAINT `fk_User_User1`
    FOREIGN KEY (`createdby`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_User2`
    FOREIGN KEY (`modifiedby`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`content`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`content` ;

CREATE TABLE IF NOT EXISTS `mydb`.`content` (
  `idcontenarea` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `alias` VARCHAR(45) NULL DEFAULT NULL,
  `order` INT(11) NULL DEFAULT NULL,
  `desc` VARCHAR(100) NULL DEFAULT NULL,
  `createddate` DATE NULL DEFAULT NULL,
  `modifieddate` DATE NULL DEFAULT NULL,
  `createdby` INT(11) NOT NULL,
  `modifiedby` INT(11) NOT NULL,
  PRIMARY KEY (`idcontenarea`),
  INDEX `fk_content_User1_idx` (`createdby` ASC),
  INDEX `fk_content_User2_idx` (`modifiedby` ASC),
  CONSTRAINT `fk_content_User1`
    FOREIGN KEY (`createdby`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_content_User2`
    FOREIGN KEY (`modifiedby`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`webpage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`webpage` ;

CREATE TABLE IF NOT EXISTS `mydb`.`webpage` (
  `idwebpage` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `desc` VARCHAR(100) NOT NULL,
  `alias` VARCHAR(45) NOT NULL,
  `creationdate` DATE NOT NULL,
  `modifieddate` DATE NULL DEFAULT NULL,
  `createdby` INT(11) NOT NULL,
  `modifiedby` INT(11) NOT NULL,
  PRIMARY KEY (`idwebpage`),
  INDEX `fk_webPage_User1_idx` (`createdby` ASC),
  INDEX `fk_webPage_User2_idx` (`modifiedby` ASC),
  CONSTRAINT `fk_webPage_User1`
    FOREIGN KEY (`createdby`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_webPage_User2`
    FOREIGN KEY (`modifiedby`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`articles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`articles` ;

CREATE TABLE IF NOT EXISTS `mydb`.`articles` (
  `idarticles` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `desc` VARCHAR(100) NULL DEFAULT NULL,
  `html` TEXT NULL DEFAULT NULL,
  `createddate` DATE NULL DEFAULT NULL,
  `modifieddate` DATE NULL DEFAULT NULL,
  `page` INT(11) NOT NULL,
  `createdby` INT(11) NOT NULL,
  `modifiedby` INT(11) NOT NULL,
  `contentarea` INT(11) NOT NULL,
  `allpages` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`idarticles`),
  INDEX `fk_articles_webPage1_idx` (`page` ASC),
  INDEX `fk_articles_User1_idx` (`createdby` ASC),
  INDEX `fk_articles_User2_idx` (`modifiedby` ASC),
  INDEX `fk_articles_content1_idx` (`contentarea` ASC),
  CONSTRAINT `fk_articles_content1`
    FOREIGN KEY (`contentarea`)
    REFERENCES `mydb`.`content` (`idcontenarea`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_User1`
    FOREIGN KEY (`createdby`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_User2`
    FOREIGN KEY (`modifiedby`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_webPage1`
    FOREIGN KEY (`page`)
    REFERENCES `mydb`.`webpage` (`idwebpage`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`css`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`css` ;

CREATE TABLE IF NOT EXISTS `mydb`.`css` (
  `idcss` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `desc` VARCHAR(100) NULL DEFAULT NULL,
  `activestate` TINYINT(1) NULL DEFAULT NULL,
  `css` VARCHAR(800) NULL DEFAULT NULL,
  `creationdate` DATE NULL DEFAULT NULL,
  `modifieddate` DATE NULL DEFAULT NULL,
  `createdby` INT(11) NOT NULL,
  `modifiedby` INT(11) NOT NULL,
  PRIMARY KEY (`idcss`),
  INDEX `fk_css_User1_idx` (`createdby` ASC),
  INDEX `fk_css_User2_idx` (`modifiedby` ASC),
  CONSTRAINT `fk_css_User1`
    FOREIGN KEY (`createdby`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_css_User2`
    FOREIGN KEY (`modifiedby`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`privilege`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`privilege` ;

CREATE TABLE IF NOT EXISTS `mydb`.`privilege` (
  `idPrivilege` INT(11) NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idPrivilege`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`userprivilege`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`userprivilege` ;

CREATE TABLE IF NOT EXISTS `mydb`.`userprivilege` (
  `Privilege_idPrivilege` INT(11) NOT NULL,
  `User_idUser` INT(11) NOT NULL,
  PRIMARY KEY (`Privilege_idPrivilege`, `User_idUser`),
  INDEX `fk_UserPrivilege_Privilege1_idx` (`Privilege_idPrivilege` ASC),
  INDEX `fk_UserPrivilege_User1_idx` (`User_idUser` ASC),
  CONSTRAINT `fk_UserPrivilege_Privilege1`
    FOREIGN KEY (`Privilege_idPrivilege`)
    REFERENCES `mydb`.`privilege` (`idPrivilege`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_UserPrivilege_User1`
    FOREIGN KEY (`User_idUser`)
    REFERENCES `mydb`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
