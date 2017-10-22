USE pvm;

CREATE TABLE `pvm`.`analysises` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `text` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  PRIMARY KEY (`id`),
) ENGINE = InnoDB;
