</div>
<?php
if (isset($templateParams['header'])) {
  require($templateParams['header']);
}
?>

<div class="container">
  <div class="row">
    <?php
    if (isset($templateParams['aside'])) {
      require($templateParams['aside']);
    }
    if (isset($templateParams['main'])) {
      require($templateParams['main']);
    }
    ?>
  </div>
</div>
