<?php if (!$error) { ?>
  <h1>Отчёт</h1>

  <?php foreach ($report as $key => $value) { ?>
    <h3><?php echo $value['name']; ?></h3>
    <p><?php echo $value['text']; ?></p>
  <?php } ?>

  <button class="btn btn-primary btn-lg btn-block" onclick="window.print()">Печать</button>

<?php } else { ?>
  <h3><?php echo $error; ?></h3>
<?php } ?>
