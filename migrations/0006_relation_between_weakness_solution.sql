USE pvm;

CREATE TABLE `pvm`.`weakness_solution` (
  `weakness_id` INT NOT NULL ,
  `solution_id` INT NOT NULL ,
  CONSTRAINT fk_weakness_id FOREIGN KEY (`weakness_id`) REFERENCES `weaknesses` (`id`) ON DELETE CASCADE,
  CONSTRAINT fk_solution_id FOREIGN KEY (`solution_id`) REFERENCES `solutions` (`id`) ON DELETE CASCADE,
  INDEX `weakness_solution_index` (`weakness_id`, `solution_id`)
) ENGINE = InnoDB;
