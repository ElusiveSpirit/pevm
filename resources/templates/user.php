
<table class="table">
  <thead>
    <tr>
      <th>id</th>
      <th>ФИО</th>
      <th>Верефицирован</th>
      <th>Админ</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users_list as $user) { ?>
      <tr>
        <th scope="row"><?php echo $user['id']; ?></th>
        <td><?php echo $user['fio']; ?></td>
        <td><?php echo $user['is_verified'] ? 'Да' : 'Нет'; ?></td>
        <td><?php echo $user['is_admin'] ? 'Да' : 'Нет'; ?></td>
        <td><a class="btn btn-light" href="<?php echo url('/user_detail.php?id='.$user['id']) ?>">редактировать</a></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
