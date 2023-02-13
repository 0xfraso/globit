<main class="col-md-8 py-5">
    <section class="rounded p-4 bg-<?php echo $theme ?> mb-3">
        <h3 class="mb-4 fw-bold">Informazioni utente</h3>
        <form action="actions/update-user.php" enctype="multipart/form-data" method="post" class="needs-validation registration-form">
            <?php if (isset($_GET["error"])) : ?>
                <h4 class="form-error text-danger mb-3">
                    <?php echo $_GET["error"] ?>
                </h4>
            <?php endif; ?>
            <?php if (isset($_GET["msg"])) : ?>
                <h4 class="form-error text-success mb-3">
                    <?php echo $_GET["msg"] ?>
                </h4>
            <?php endif; ?>

            <div class="row g-4">
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input value="<?php echo $user["full_name"]; ?>" name="full_name" type="text" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="full_name" placeholder="Nome completo" required>
                        <label for="full_name">Nome completo</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-floating">
                        <input value="<?php echo $user["username"]; ?>" name="username" type="text" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="username" placeholder="Username" required>
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
                <div class="col-sm-12">
                    <div class="form-floating">
                        <input value="<?php echo $user["email"]; ?>" name="email" type="email" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="email" placeholder="Indirizzo e-mail" required>
                        <label for="email">e-mail</label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-floating">
                        <input name="profile_picture" type="file" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="profile_picture" required>
                        <label for="profile_picture">Immagine del profilo</label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-floating">
                        <input name="description" type="text" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="description" value="<?php echo $user['description'] ?>" required>
                        <label for="description">Descrizione</label>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <input class="btn btn-<?php echo $main_color ?> btn-lg mb-3" type="submit" value="Conferma">
        </form>
    </section>
</main>
