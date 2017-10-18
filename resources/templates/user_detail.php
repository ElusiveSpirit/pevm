
<?php if ($message) { ?>
<div class="alert <?php echo $status ? 'alert-success' : 'alert-danger' ?>" role="alert">
  <?php echo $message; ?>
</div>
<?php } ?>

<?php if ($user) { ?>
<form method="post" action="<?php echo url('/user_detail.php?id='.$user['id']) ?>">
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
  <a href="<?php echo url('/user.php'); ?>" class="btn btn-secondary">Назад</a>
  <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
<form action="<?php echo url('/user_delete.php'); ?>" method="post">
  <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
  <input type="submit" class="btn btn-danger float-right" value="Удалить">
</form>
<?php } else { ?>
  <a href="<?php echo url('/user.php'); ?>" class="btn btn-secondary">Назад</a>
<?php } ?>
