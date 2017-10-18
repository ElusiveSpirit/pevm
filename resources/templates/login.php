<?
// Если запущен процесс авторизации, но она не была успешной,
// или же авторизация еще не запущена, отображаем форму авторизации
if($auth !== true) {
?>
	<?php if (isset($errors['full_error'])) { ?>
	<div class="alert alert-danger" role="alert">
		<?php echo $errors['full_error']; ?>
	</div>
	<?php } ?>
	<form method="post">
	  <div class="form-group">
	    <input type="text" class="form-control" name="login" id="login" aria-describedby="emailHelp" placeholder="ФИО">
	  </div>
	  <div class="form-group">
	    <input type="password" class="form-control" name="password" id="password" placeholder="Пароль">
	  </div>
		<p>Если вы не зарегистрированы в системе, <a href="<?php echo url('/registration.php') ?>">зарегистрируйтесь</a>.</p>
	  <button type="submit" class="btn btn-primary">Войти</button>
	</form>
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
