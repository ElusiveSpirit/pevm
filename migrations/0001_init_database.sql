CREATE DATABASE pvm;

CREATE USER 'pvm_user'@'localhost' IDENTIFIED BY 'pa$$';
GRANT ALL PRIVILEGES ON pvm. * TO 'pvm_user'@'localhost';

FLUSH PRIVILEGES;
