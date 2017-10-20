USE pvm;

ALTER TABLE `pvm`.`users` ADD UNIQUE `user_unique_fio` (`fio`);
