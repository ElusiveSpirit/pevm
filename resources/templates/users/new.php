
<?php if ($message) { ?>
<div class="alert <?php echo $status ? 'alert-success' : 'alert-danger' ?>" role="alert">
  <?php echo $message; ?>
</div>
<?php } ?>

<?php if (!$user) { ?>
<form method="post">
  <div class="form-group">
    <input value="<?php echo $user['fio'] ?>" type="text" class="form-control" name="fio" id="fio" placeholder="ФИО">
  </div>
  <div class="form-group">
    <input type="password" class="form-control" name="password" id="password" placeholder="Пароль">
  </div>
  <div  class="form-group">
    <label class="form-check-label">
      <input <?php echo $user['is_verified'] ? 'checked' : '' ?>  type="checkbox" class="form-check-input" name="is_verified" id="is_verified">
      Верефицирован
    </label>
  </div>
  <div class="form-group">
    <label class="form-check-label">
      <input <?php echo $user['is_admin'] ? 'checked' : '' ?> type="checkbox" class="form-check-input" name="is_admin" id="is_admin">
      Администратор
    </label>
  </div>
  <a href="<?php echo url('/users/'); ?>" class="btn btn-secondary">Отмена</a>
  <button type="submit" class="btn btn-primary">Создать</button>
</form>
<?php } else { ?>
  <p>Пользователь <?php echo $user['fio']; ?> создан. Через 5 секунд вы будете перенаправлены на его страницу.</p>
  <a href="<?php echo url('/users/'); ?>" class="btn btn-secondary">К списку пользователей</a>
<?php } ?>
