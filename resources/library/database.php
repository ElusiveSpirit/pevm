<?php
require_once(realpath(dirname(__FILE__) . "/../config.php"));


/**
  * Функция для подключения к СУБД MySQL.
  * Функция не принимает никаких параметров.
  * Функция предназначена для использования, в основном,
  * с одной базой данных
  */
function db_connect() {
	global $config;
	// Объявляем переменные, в которых будут храниться параметры для подключения к СУБД
	$db_host = $config['db']['host'];				  // Сервер
	$db_user = $config['db']['username'];			// Имя пользователя
	$db_password = $config['db']['password'];	// Пароль пользователя
	$db_name = $config['db']['dbname'];				// Имя базы данных

	// Подключаемся к серверу
	// Закрывать соединение нет необходимости. PHP сделает всё сам.
	$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

	if ($mysqli->connect_errno) {
	    die("Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
	}

	$mysqli->query("SET NAMES UTF8");

	return $mysqli;
}

$db = db_connect();

?>
