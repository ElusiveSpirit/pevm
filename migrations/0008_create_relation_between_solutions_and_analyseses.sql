USE pvm;

CREATE TABLE `pvm`.`solution_analysises` (
  `solution_id` INT NOT NULL ,
  `analysis_id` INT NOT NULL ,
  CONSTRAINT fk_solution_an_id FOREIGN KEY (`solution_id`) REFERENCES `solutions` (`id`) ON DELETE CASCADE,
  CONSTRAINT fk_analysis_sol_id FOREIGN KEY (`analysis_id`) REFERENCES `analysises` (`id`) ON DELETE CASCADE,
  INDEX `weakness_solution_index` (`solution_id`, `analysis_id`)
) ENGINE = InnoDB;
