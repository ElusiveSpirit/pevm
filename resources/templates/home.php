
<div class="starter-template">
  <h1>Справочник уязвимостей</h1>

  <ul class="nav nav-tabs">
    <li class="nav-item" >
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-class="type">Тип уязвимости</a>
      <div class="dropdown-menu"></div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-class="weaknesses">Уязвимость</a>
      <div class="dropdown-menu"></div>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-class="solutions">Dropdown</a>
      <div class="dropdown-menu"></div>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" data-class="analysises">Dropdown</a>
      <div class="dropdown-menu"></div>
    </li>
  </ul>

  <div id="wrapper">
  </div>

  <div class="mt-5">
    <button id="btnBack" class="btn btn-secondary" disabled>Назад</button>
    <button id="btnNext" class="btn btn-primary" disabled>Далее</button>
  </div>

</div>

<script>
  window.urlDetail = '<?php echo url('/detail.php') ?>';
  window.url = '<?php echo url('/data.php') ?>';
</script>
<script src="<?php echo url('/js/utils.js') ?>"></script>
<script src="<?php echo url('/js/app.js') ?>"></script>
