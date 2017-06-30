-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema monkeymanager
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema monkeymanager
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `monkeymanager` DEFAULT CHARACTER SET utf8 ;
USE `monkeymanager` ;

-- -----------------------------------------------------
-- Table `monkeymanager`.`keychain`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `monkeymanager`.`keychain` ;

CREATE TABLE IF NOT EXISTS `monkeymanager`.`keychain` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `creationDate` DATE NULL DEFAULT NULL,
  `destructionDate` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monkeymanager`.`provider`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `monkeymanager`.`provider` ;

CREATE TABLE IF NOT EXISTS `monkeymanager`.`provider` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  `office` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monkeymanager`.`room`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `monkeymanager`.`room` ;

CREATE TABLE IF NOT EXISTS `monkeymanager`.`room` (
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`name`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monkeymanager`.`door`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `monkeymanager`.`door` ;

CREATE TABLE IF NOT EXISTS `monkeymanager`.`door` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `roomId` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `index_door_room_id` (`roomId` ASC),
  CONSTRAINT `fk_door_room`
    FOREIGN KEY (`roomId`)
    REFERENCES `monkeymanager`.`room` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monkeymanager`.`enssat_lock`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `monkeymanager`.`enssat_lock` ;

CREATE TABLE IF NOT EXISTS `monkeymanager`.`enssat_lock` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `length` VARCHAR(45) NOT NULL,
  `doorId` INT NOT NULL,
  `providerId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_lock_provider_id` (`providerId` ASC),
  INDEX `fk_lock_door` (`doorId` ASC),
  CONSTRAINT `fk_lock_provider`
    FOREIGN KEY (`providerId`)
    REFERENCES `monkeymanager`.`provider` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lock_door`
    FOREIGN KEY (`doorId`)
    REFERENCES `monkeymanager`.`door` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monkeymanager`.`enssat_key`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `monkeymanager`.`enssat_key` ;

CREATE TABLE IF NOT EXISTS `monkeymanager`.`enssat_key` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NOT NULL,
  `lockId` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_enssat_key_lock` (`lockId` ASC),
  CONSTRAINT `fk_enssat_key_lock`
    FOREIGN KEY (`lockId`)
    REFERENCES `monkeymanager`.`enssat_lock` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monkeymanager`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `monkeymanager`.`user` ;

CREATE TABLE IF NOT EXISTS `monkeymanager`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ur1identifier` VARCHAR(45) NOT NULL,
  `enssatPrimaryKey` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `phone` VARCHAR(15) NOT NULL,
  `status` VARCHAR(20) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `enssatPrimaryKey_UNIQUE` (`enssatPrimaryKey` ASC),
  UNIQUE INDEX `ur1identifier_UNIQUE` (`ur1identifier` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monkeymanager`.`borrowing`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `monkeymanager`.`borrowing` ;

CREATE TABLE IF NOT EXISTS `monkeymanager`.`borrowing` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `keychainId` INT NOT NULL,
  `userId` INT NOT NULL,
  `borrowDate` DATE NOT NULL,
  `dueDate` DATE NULL DEFAULT NULL,
  `returnDate` DATE NULL DEFAULT NULL,
  `lostDate` DATE NULL DEFAULT NULL,
  `comment` TEXT NULL DEFAULT NULL,
  INDEX `index_borrowing_user_id` (`userId` ASC),
  INDEX `index_borrowing_keychain_id` (`keychainId` ASC),
  PRIMARY KEY (`id`, `userId`, `keychainId`),
  CONSTRAINT `fk_borrowing_user`
    FOREIGN KEY (`userId`)
    REFERENCES `monkeymanager`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_borrowing_keychain`
    FOREIGN KEY (`keychainId`)
    REFERENCES `monkeymanager`.`keychain` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `monkeymanager`.`keys_keychain`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `monkeymanager`.`keys_keychain` ;

CREATE TABLE IF NOT EXISTS `monkeymanager`.`keys_keychain` (
  `keyId` INT NOT NULL,
  `keychainId` INT NOT NULL,
  INDEX `index_key_has_keychain_keychain_id` (`keychainId` ASC),
  INDEX `index_key_has_keychain_key_id` (`keyId` ASC),
  CONSTRAINT `fk_keys_keychain_key`
    FOREIGN KEY (`keyId`)
    REFERENCES `monkeymanager`.`enssat_key` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_keys_keychain_keychain`
    FOREIGN KEY (`keychainId`)
    REFERENCES `monkeymanager`.`keychain` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `monkeymanager` ;

-- -----------------------------------------------------
-- procedure detailEmprunt
-- -----------------------------------------------------

USE `monkeymanager`;
DROP procedure IF EXISTS `monkeymanager`.`detailEmprunt`;

DELIMITER $$
USE `monkeymanager`$$
create procedure detailEmprunt(idK int)
	BEGIN
      select * from borrowing,user
      where (borrowing.userId=user.id and idK=borrowing.keychainid);
	END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure infoEmprunt
-- -----------------------------------------------------

USE `monkeymanager`;
DROP procedure IF EXISTS `monkeymanager`.`infoEmprunt`;

DELIMITER $$
USE `monkeymanager`$$
create procedure infoEmprunt(idK int,idU int)
	BEGIN
      select * from borrowing,user
      where (borrowing.userId=user.id and idK=borrowing.keychainid and idU=borrowing.userId);
	END;$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure laCleCorresp
-- -----------------------------------------------------

USE `monkeymanager`;
DROP procedure IF EXISTS `monkeymanager`.`laCleCorresp`;

DELIMITER $$
USE `monkeymanager`$$
create procedure laCleCorresp(nameSalle varchar(45))
Begin
    select enssat_key.id from enssat_key,enssat_lock,door,room where room.name=nom and room.name=door.roomId and door.id=enssat_lock.doorId and enssat_lock.id=enssat_key.lockId ;
end$$

DELIMITER ;

-- -----------------------------------------------------
-- procedure lesSallesCorrpond
-- -----------------------------------------------------

USE `monkeymanager`;
DROP procedure IF EXISTS `monkeymanager`.`lesSallesCorrpond`;

DELIMITER $$
USE `monkeymanager`$$
create procedure lesSallesCorrpond(idKey integer)
Begin
    select room.name from enssat_key,enssat_lock,door,room where enssat_key.id=idKey and room.name=door.roomId and door.id=enssat_lock.doorId and enssat_lock.id=enssat_key.lockId ;
end$$

DELIMITER ;
USE `monkeymanager`;

DELIMITER $$

USE `monkeymanager`$$
DROP TRIGGER IF EXISTS `monkeymanager`.`check_keychain_dates_insert` $$
USE `monkeymanager`$$
CREATE DEFINER = CURRENT_USER TRIGGER `monkeymanager`.`check_keychain_dates_insert` BEFORE INSERT ON `keychain` FOR EACH ROW
BEGIN
  if(new.destructionDate < new.creationDate) Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "La date de destruction ne peut pas être inférieure à la date de création"
    ,MYSQL_ERRNO = 5;
  end if;
END$$


USE `monkeymanager`$$
DROP TRIGGER IF EXISTS `monkeymanager`.`check_keychain_dates_update` $$
USE `monkeymanager`$$
CREATE DEFINER = CURRENT_USER TRIGGER `monkeymanager`.`check_keychain_dates_update` BEFORE UPDATE ON `keychain` FOR EACH ROW
BEGIN
  if(new.destructionDate < new.creationDate) Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "La date de destruction ne peut pas être inférieure à la date de création"
    ,MYSQL_ERRNO = 5;
  end if;

END$$


USE `monkeymanager`$$
DROP TRIGGER IF EXISTS `monkeymanager`.`test_provider_exist_insert Before` $$
USE `monkeymanager`$$
CREATE DEFINER = CURRENT_USER TRIGGER `monkeymanager`.`test_provider_exist_insert Before` BEFORE INSERT ON `provider` FOR EACH ROW
BEGIN
    if (new.phone IN (select phone from provider) and new.name IN (select name from provider) and new.username in (select username from provider))  Then
      SIGNAL SQLSTATE '45000'
        SET message_TEXT = 'Ce fournisseur existe deja'
              ,MYSQL_ERRNO = 2;
    end if;

    if (character_length(new.phone) < 9 ) Then
      SIGNAL SQLSTATE '45000'
      SET message_TEXT = 'Le numero de telephone saisi est incorrect : 10 chiffres minimum'
            ,MYSQL_ERRNO = 1;
  end if;

END$$


USE `monkeymanager`$$
DROP TRIGGER IF EXISTS `monkeymanager`.`test_provider_exist_update` $$
USE `monkeymanager`$$
CREATE DEFINER = CURRENT_USER TRIGGER `monkeymanager`.`test_provider_exist_update` BEFORE UPDATE ON `provider` FOR EACH ROW
BEGIN
  if (character_length(new.phone) < 9 ) Then
      SIGNAL SQLSTATE '45000'
      SET message_TEXT = 'Le numero de telephone saisi est incorrect : 10 chiffres minimum'
            ,MYSQL_ERRNO = 1;
  end if;

END$$


USE `monkeymanager`$$
DROP TRIGGER IF EXISTS `monkeymanager`.`check_lock_length_insert` $$
USE `monkeymanager`$$
CREATE DEFINER = CURRENT_USER TRIGGER `monkeymanager`.`check_lock_length_insert` BEFORE INSERT ON `enssat_lock` FOR EACH ROW
BEGIN
  if(new.length <= 0 OR new.length > 100) Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "La taille d'un canon doit être comprise entre 1 et 100"
    ,MYSQL_ERRNO = 6;
  end if;

END$$


USE `monkeymanager`$$
DROP TRIGGER IF EXISTS `monkeymanager`.`check_lock_length_update` $$
USE `monkeymanager`$$
CREATE DEFINER = CURRENT_USER TRIGGER `monkeymanager`.`check_lock_length_update` BEFORE UPDATE ON `enssat_lock` FOR EACH ROW
BEGIN
if(new.length <= 0 OR new.length > 100) Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "La taille d'un canon doit être comprise entre 1 et 100"
    ,MYSQL_ERRNO = 6;
  end if;

END$$


USE `monkeymanager`$$
DROP TRIGGER IF EXISTS `monkeymanager`.`check_key_type_insert` $$
USE `monkeymanager`$$
CREATE DEFINER = CURRENT_USER TRIGGER `monkeymanager`.`check_key_type_insert` BEFORE INSERT ON `enssat_key` FOR EACH ROW
BEGIN
  if(new.type != 'Simple' AND new.type != 'Partiel' AND new.type != 'Total') Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "Le type de clé ne doit pas être autre que : Simple, Partiel ou Total"
    ,MYSQL_ERRNO = 4;
  end if;
END$$


USE `monkeymanager`$$
DROP TRIGGER IF EXISTS `monkeymanager`.`check_key_type_update` $$
USE `monkeymanager`$$
CREATE DEFINER = CURRENT_USER TRIGGER `monkeymanager`.`check_key_type_update` BEFORE UPDATE ON `enssat_key` FOR EACH ROW
BEGIN
  if(new.type != 'Simple' AND new.type != 'Partiel' AND new.type != 'Total') Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "Le type de clé ne doit pas être autre que : Simple, Partiel ou Total"
    ,MYSQL_ERRNO = 4;
  end if;
END$$


USE `monkeymanager`$$
DROP TRIGGER IF EXISTS `monkeymanager`.`test_user_exist` $$
USE `monkeymanager`$$
CREATE DEFINER = CURRENT_USER TRIGGER `monkeymanager`.`test_user_exist` BEFORE INSERT ON `user` FOR EACH ROW
BEGIN
     if (new.email IN (select email from user) and new.name IN (select name from user) and new.username in (select username from user))  Then
      SIGNAL SQLSTATE '45000'
        SET message_TEXT = 'Utilisateur deja present dans la base'
              ,MYSQL_ERRNO = 2;
    end if;

    if (character_length(new.phone) < 9 ) Then
      SIGNAL SQLSTATE '45000'
      SET message_TEXT = 'Le numero de telephone saisi est incorrect : 10 chiffres minimum'
            ,MYSQL_ERRNO = 1;
  end if;
    if(new.status != 'Etudiant' AND new.status != 'Enseignant' AND new.status != 'Personnel') Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "Le status d'un utilisateur ne peut être autre que : Etudiant, Enseignant ou Personnel"
    ,MYSQL_ERRNO = 7;
  end if;

END$$


USE `monkeymanager`$$
DROP TRIGGER IF EXISTS `monkeymanager`.`test_user_exist_update` $$
USE `monkeymanager`$$
CREATE DEFINER = CURRENT_USER TRIGGER `monkeymanager`.`test_user_exist_update` BEFORE UPDATE ON `user` FOR EACH ROW
Begin
  if (character_length(new.phone) < 9 ) Then
      SIGNAL SQLSTATE '45000'
      SET message_TEXT = 'Le numero de telephone saisi est incorrect : 10 chiffres minimum'
            ,MYSQL_ERRNO = 1;
  end if;
  
  if(new.status != 'Etudiant' AND new.status != 'Enseignant' AND new.status != 'Personnel') Then
    SIGNAL SQLSTATE '45000'
    SET message_TEXT = "Le status d'un utilisateur ne peut être autre que : Etudiant, Enseignant ou Personnel"
    ,MYSQL_ERRNO = 7;
  end if;

end;$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
