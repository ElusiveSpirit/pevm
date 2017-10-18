<?php
/**
  * registration.php
  * Страница регистрации пользователей. Предполагается, что в вашей
  * базе данных присутствует таблица пользователей users, в которой
  * есть поля id, login, password, reg_date
  */

  require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

  require_once(LIBRARY_PATH . "/templateFunctions.php");
  require_once(LIBRARY_PATH . "/database.php");
  require_once(LIBRARY_PATH . "/auth.php");
  require_once(LIBRARY_PATH . "/user.php");

  if ($_SESSION['is_auth']) {
    header('Location: index.php');
    return;
  }

  // Инициализируем переменные для введенных значений и возможных ошибок
  $errors = array();
  $fields = array();
  $message = '';

  // Заранее инициализируем переменную регистрации, присваивая ей ложное значение
  $reg = false;

  // Если была нажата кнопка регистрации
  if($_POST) {
  	// Делаем массив сообщений об ошибках пустым
  	$errors['login'] = $errors['password'] = $errors['password_again'] = '';

  	// С помощью стандартной функции trim() удалим лишние пробелы
  	// из введенных пользователем данных
  	$fields['login'] = trim($_POST['login']);
  	$password = trim($_POST['password']);
  	$password_again = trim($_POST['password_again']);

  	// Если логин не пройдет проверку, будет сообщение об ошибке
  	$errors['login'] = checkFio($fields['login']) == true ? '' : checkFio($fields['login']);

  	// Если пароль не пройдет проверку, будет сообщение об ошибке
  	$errors['password'] = checkPassword($password) == true ? '' : checkPassword($password);

  	// Если пароль введен верно, но пароли не идентичны, будет сообщение об ошибке
  	$errors['password_again'] = (checkPassword($password) == true && $password == $password_again) ? '' : 'Введенные пароли не совпадают';

  	// Если ошибок нет, нам нужно добавить информацию о пользователе в БД
  	if($errors['login'] == '' && $errors['password'] == '' && $errors['password_again'] == '') {
  		// Вызываем функцию регистрации, её результат записываем в переменную
  		$reg = registration($fields['login'], $password);

  		// Если регистрация прошла успешно, сообщаем об этом пользователю
  		// И создаем заголовок страницы, который выполнит переадресацию к форме авторизации
  		if($reg === true) {
        authorization($fields['login'], $password);
  			$message = '<p>Вы успешно зарегистрировались в системе. Сейчас вы будете переадресованы на главную страницу. Если это не произошло, перейдите на неё по <a href="index.php">прямой&nbsp;ссылке</a>.</p>';
  			header('Refresh: 5; URL = index.php');
  		}
  		// Иначе сообщаем пользователю об ошибке
  		else {
  			$errors['full_error'] = $reg;
  		}
  	}
  }


  renderLayoutWithContentFile("registration.php", array(
    'reg' => $reg,
  	'errors' => $errors,
  	'message' => $message,
  ));
?>
