<?
// Если запущен процесс авторизации, но она не была успешной,
// или же авторизация еще не запущена, отображаем форму авторизации
if($auth !== true) {
?>
	<!-- Блок для вывода сообщений об ошибках -->
	<div id="full_error" class="error" style="display:
	<?
	echo array_key_exists('full_error', $errors) ? 'inline-block' : 'none';
	?>
	;">
	<?
	// Выводим сообщение об ошибке, если оно есть
	echo array_key_exists('full_error', $errors) ? $errors['full_error'] : '';
	?>
	</div>
	<form action="" method="post">
		<div class="row">
			<label for="login">Ваш логин:</label>
			<input type="text" class="text" name="login" id="login" />
		</div>
		<div class="row">
			<label for="password">Ваш пароль:</label>
			<input type="password" class="text" name="password" id="password" />
		</div>
		<div class="row">
			<input type="submit" name="submit" id="btn-submit" value="Авторизоваться" />
		</div>
	</form>
	<p class="to_reg">Если вы не зарегистрированы в системе, <a href="registration.php">зарегистрируйтесь</a>.</p>
<?
}	// Закрывающая фигурная скобка условного оператора проверки успешной авторизации
// Иначе выводим сообщение об успешной авторизации
else {
	print $message;
}

/**
  * Если всё правильно, будет выведено сообщение об успешной авторизации,
  * пользователь будет переадресован на защищенную страницу
  */
?>
