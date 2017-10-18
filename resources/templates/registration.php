
<?php
// Показываем форму только если пользователь еще не запустил процесс регистрации,
// и если регистрация не была успешной
if($reg !== true) {
?>
	<!-- Блок для вывода сообщений об ошибках -->
	<?php if (isset($errors['full_error'])) { ?>
	<div class="alert alert-danger" role="alert">
		<?php echo $errors['full_error']; ?>
	</div>
	<?php } ?>
	<form method="post">
		<div class="form-group">
			<input type="text" class="form-control" name="login" id="login" placeholder="ФИО">
			<?php if (isset($errors['login']) && $errors['login']) { ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $errors['login']; ?>
			</div>
			<?php } ?>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="password" id="password" placeholder="Пароль">
			<?php if (isset($errors['password']) && $errors['password']) { ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $errors['password']; ?>
			</div>
			<?php } ?>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="password_again" id="password_again" placeholder="Повторите пароль">
			<?php if (isset($errors['password_again']) && $errors['password_again']) { ?>
			<div class="alert alert-danger" role="alert">
				<?php echo $errors['password_again']; ?>
			</div>
			<?php } ?>
		</div>
		<p>Если вы зарегистрированы в системе, <a href="<?php echo url('/login.php') ?>">авторизируйтесь</a>.</p>
		<button type="submit" class="btn btn-primary">Зарегистрироваться</button>
	</form>
<?php
}	// закрывающая фигурная скобка условия проверки запущенного процесса регистрации
// Если регистрация прошла успешно, сообщаем об этом
else {
	print $message;
}
/**
  * Если всё пройдет как положено, вы сможете попробовать
  * зарегистрировать такого же точно пользователя. Скрипт
  * должен будет сообщить об ошибке
  */
?>
