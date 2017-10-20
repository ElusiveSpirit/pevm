USE pvm;

CREATE TABLE `pvm`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `fio` VARCHAR(120) NOT NULL ,
  `password` VARCHAR(120) NOT NULL ,
  `is_admin` BOOLEAN NOT NULL DEFAULT false,
  `is_verified` BOOLEAN NOT NULL DEFAULT false,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


INSERT INTO `users` (`id`, `fio`, `password`, `is_admin`, `is_verified`) VALUES (NULL, 'Admin', '12345', '1', '1')
