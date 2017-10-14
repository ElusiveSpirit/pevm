<?php
/**
  * Страница авторизации пользователей. Предполагается,
  * что в вашей базе данных присутствует таблица users,
  * в которой существуют поля id, login и password
  */
// Подлючаем файл с пользовательскими функциями
require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

require_once(LIBRARY_PATH . "/templateFunctions.php");
require_once(LIBRARY_PATH . "/database.php");
require_once(LIBRARY_PATH . "/auth.php");


// Заранее инициализируем переменную авторизации, присвоив ей ложное значение
$auth = false;
$errors = array();
$message = null;

// Если была нажата кнопка авторизации
if(isset($_POST['submit'])) {
	// Делаем массив сообщений об ошибках пустым
	$errors['login'] = $errors['password'] = $errors['password_again'] = '';

	// С помощью стандартной функции trim() удалим лишние пробелы
	// из введенных пользователем данных
	$login = trim($_POST['login']);
	$password = trim($_POST['password']);

	// Авторизуем пользователя
	// Вызываем функцию регистрации, её результат записываем в переменную
	$auth = authorization($login, $password);

	// Если авторизация прошла успешно, сообщаем об этом пользователю
	// И создаем заголовок страницы, который выполнит переадресацию на защищенную
	// от общего доступа страницу
	if($auth === true) {
		$message = '<p>Вы успешно авторизовались в системе. Сейчас вы будете переадресованы на главную страницу сайта. Если это не произошло, перейдите на неё по <a href="/">прямой&nbsp;ссылке</a>.</p>';
		header('Location: index.php');
	}
	// Иначе сообщаем пользователю об ошибке
	else {
		$errors['full_error'] = $auth;
	}
}


renderLayoutWithContentFile("login.php", array(
	'errors' => $errors,
	'auth' => $auth,
	'message' => $message,
));

?>
