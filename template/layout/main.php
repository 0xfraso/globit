<?php
if (isset($templateParams['header'])) {
    require($templateParams['header']);
}
?>

<div class="container">
    <div class="row">
        <?php
        if (isset($templateParams['main'])) {
            require($templateParams['main']);
        }
        if (isset($templateParams['aside'])) {
            require($templateParams['aside']);
        }
        ?>
    </div>
</div>
