<main class="rounded bg-<?php echo $theme ?> p-5 m-5 border">

    <?php
    if (isset($_GET["error"])) : ?>
        <div class="text-white fw-bold p-3 rounded bg-danger mb-3 ">
            <?php
            echo $_GET['error'];
            ?>
        </div>
    <?php endif; ?>

    <form action="actions/process-signup.php" method="post" enctype="multipart/form-data" class="needs-validation registration-form">
        <h3 class="mb-5 fw-bold">Registrati</h3>

        <div class="row g-4">
            <div class="col-sm-6">
                <div class="form-floating">
                    <input name="full_name" type="text" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="full_name" placeholder="Nome completo" required>
                    <label for="full_name">Nome completo</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating">
                    <input name="username" type="text" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="username" placeholder="Username" required>
                    <label for="username">@Username</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating">
                    <input name="password" type="password" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating">
                    <input name="password_repeat" type="password" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="password_repeat" placeholder="Password" required>
                    <label for="password_repeat">Ripeti password</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating">
                    <input name="email" type="email" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="email" placeholder="Indirizzo e-mail" required>
                    <label for="email">e-mail</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-floating">
                    <input name="profile_picture" type="file" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="profile_picture" required>
                    <label for="profile_picture">Immagine del profilo</label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-floating">
                    <input name="description" type="text" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="description" required>
                    <label for="description">Descrizione</label>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <input class="btn btn-<?php echo $main_color ?> btn-lg mb-3" type="submit" value="Iscriviti">
        <p>Hai già un account? <a href="signin.php" class="text-<?php echo $main_color; ?>">Accedi</a></p>
    </form>
</main>
