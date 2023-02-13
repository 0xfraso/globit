<li class="nav-item list-unstyled dropstart" id='nav-login-dropdown'>
    <a href="#" class="btn btn-<?php echo $main_color; ?> nav-link" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
        Accedi
    </a>
    <form action="actions/process-signin.php" method="post" enctype="multipart/form-data" class="dropdown-menu p-3 rounded border border-1 bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?> needs-validation text-center">
        <h3 class="mb-5 fw-bold">Accedi</h3>

        <div class="row g-4">
            <div class="col-sm-12">
                <div class="form-floating">
                    <input name="email" type="email" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="email" placeholder="Indirizzo e-mail" required>
                    <label for="email">e-mail</label>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-floating">
                    <input name="password" type="password" class="form-control bg-<?php echo $theme ?> text-<?php echo $opposite_theme ?>" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <input class="btn btn-<?php echo $main_color ?> btn-lg mb-3" type="submit" value="Accedi">
        <p>Non hai un account? <a href="signup.php" class="text-<?php echo $main_color; ?>">Iscriviti</a></p>
    </form>
</li>
