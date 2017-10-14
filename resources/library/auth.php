<?php
/**
  * functions.php
  * Файл с пользовательскими функциями
  */

// Подключаем файл с параметрами подключения к СУБД
require_once(LIBRARY_PATH . "/database.php");
require_once(LIBRARY_PATH . "/user.php");

// Проверка имени пользователя
function checkFio($str) {
	// Инициализируем переменную с возможным сообщением об ошибке
	$error = '';

	// Если отсутствует строка с логином, возвращаем сообщение об ошибке
	if(!$str) {
		$error = 'Вы не ввели имя пользователя';
		return $error;
	}

	/**
	  * Проверяем имя пользователя с помощью регулярных выражений
	  * Логин должен быть не короче 4, не длинне 16 символов
	  * В нем должны быть символы латинского алфавита, цифры,
	  * в нем могут быть символы '_', '-', '.'
	  */
	$pattern = '/^[-_.a-z\d]{4,16}$/i';
	$result = preg_match($pattern, $str);

	// Если проверка не прошла, возвращаем сообщение об ошибке
	if(!$result) {
		$error = 'Недопустимые символы в имени пользователя или имя пользователя слишком короткое (длинное)';
		return $error;
	}

	// Если же всё нормально, вернем значение true
	return true;
}

// Проверка пароля пользователя
function checkPassword($str) {
	// Инициализируем переменную с возможным сообщением об ошибке
	$error = '';

	// Если отсутствует строка с логином, возвращаем сообщение об ошибке
	if(!$str) {
		$error = 'Вы не ввели пароль';
		return $error;
	}

	/**
	  * Проверяем пароль пользователя с помощью регулярных выражений
	  * Пароль должен быть не короче 6, не длинне 16 символов
	  * В нем должны быть символы латинского алфавита, цифры,
	  * в нем могут быть символы '_', '!', '(', ')'
	  */
	$pattern = '/^[_!)(.a-z\d]{6,16}$/i';
	$result = preg_match($pattern, $str);

	// Если проверка не прошла, возвращаем сообщение об ошибке
	if(!$result) {
		$error = 'Недопустимые символы в пароле пользователя или пароль слишком короткий (длинный)';
		return $error;
	}

	// Если же всё нормально, вернем значение true
	return true;
}

// Функция регистрации пользователя
function registration($fio, $password) {
	// Инициализируем переменную с возможным сообщением об ошибке
	$error = '';

	// Если отсутствует строка с логином, возвращаем сообщение об ошибке
	if(!$fio) {
		$error = 'Не указан логин';
		return $error;
	}
	elseif(!$password) {
		$error = 'Не указан пароль';
		return $error;
	}

  if (user_is_exists($fio)) {
    $error = 'Пользователь с указанным логином уже зарегистрирован';
    return $error;
  }

	return user_create($fio, $password);
}

/**
  * Функция авторизации пользователя.
  * Авторизация пользователей у нас будет осуществляться
  * с помощью сессий PHP.
  */
function authorization($fio, $password) {
	// Инициализируем переменную с возможным сообщением об ошибке
	$error = '';

	// Если отсутствует строка с логином, возвращаем сообщение об ошибке
	if(!$fio) {
		$error = 'Не указан логин';
		return $error;
	}
	elseif(!$password) {
		$error = 'Не указан пароль';
		return $error;
	}

	$user = user_fetch_with_password($fio, $password);

	// И записываем в неё логин и пароль пользователя
	// Для этого мы используем суперглобальный массив $_SESSION
	$_SESSION['fio'] = $fio;
	$_SESSION['password'] = $password;
	session_update($user);

	// Возвращаем true для сообщения об успешной авторизации пользователя
	return true;
}


function checkAuth($fio, $password) {
	// Если нет логина или пароля, возвращаем false
	if(!$fio || !$password)	return false;

	return user_fetch_with_password($fio, $password);
}


function session_update($user=null, $new=false) {
	if ($new) {
		session_start();
	}

	$_SESSION['is_auth'] = false;

	if (isset($_SESSION['fio']) && isset($_SESSION['fio'])) {
		if (!$user) {
			$user = checkAuth($_SESSION['fio'], $_SESSION['password']);
		}

		if ($user) {
			$_SESSION['is_admin'] = $user['is_admin'];
			$_SESSION['is_verified'] = $user['is_verified'];
			$_SESSION['is_auth'] = true;
		}
	}
}

function session_clear() {
	session_unset();
	$_SESSION['is_auth'] = false;
}

session_update(null, true);

?>
