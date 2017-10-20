USE pvm;

CREATE TABLE `pvm`.`analysises` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(300) NOT NULL ,
  `text` TEXT NOT NULL ,
  PRIMARY KEY (`id`),
) ENGINE = InnoDB;
