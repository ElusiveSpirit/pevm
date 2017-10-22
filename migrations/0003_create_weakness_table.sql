USE pvm;

CREATE TABLE `pvm`.`weaknesses` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `text` TEXT CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ,
  `is_local` BOOLEAN NOT NULL ,
   PRIMARY KEY (`id`)
) ENGINE = InnoDB;
