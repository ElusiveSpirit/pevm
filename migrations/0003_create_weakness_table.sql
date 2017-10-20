USE pvm;

CREATE TABLE `pvm`.`weaknesses` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(300) NOT NULL ,
  `text` TEXT NOT NULL ,
  `is_local` BOOLEAN NOT NULL ,
   PRIMARY KEY (`id`)
) ENGINE = InnoDB;
