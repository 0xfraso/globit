<div class="container text-center d-flex min-vh-100 align-items-center justify-content-around">
    <?php
    if (isset($templateParams['aside'])) {
        require($templateParams['aside']);
    }
    if (isset($templateParams['main'])) {
        require($templateParams['main']);
    }
    ?>
</div>
