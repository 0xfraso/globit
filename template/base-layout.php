<?php
if (isset($_COOKIE['theme'])) {
    $theme = $_COOKIE['theme'];
} else $theme = 'none';

$opposite_theme = $theme === 'light' ? 'dark' : 'light';
$main_color = $theme === 'light' ? 'primary' : 'secondary';
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- Rive runtime (themeswitcher) -->
    <script src="https://unpkg.com/@rive-app/canvas@1.0.79"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="assets/js/comment-toggle.js"></script>
    <script src="assets/js/preview-image.js"></script>
    <script src="assets/js/notifications.js"></script>
    <script src="assets/js/user-form.js"></script>
    <script src="assets/js/follow-form.js"></script>
    <script src="assets/js/vote-form.js"></script>
    <script src="assets/js/themeswitcher.js"></script>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">

    <title>
        <?php if (isset($templateParams['title'])) {
            echo $templateParams['title'];
        } ?>
    </title>

</head>

<body class="body-<?php echo $theme; ?> text-<?php echo $opposite_theme; ?>">
    <?php
    $logged_in = signin_check($dbh);
    require('template/navbar/navbar-template.php');

    if ($logged_in) {
        require_once('template/insert-post-modal.php');
        require_once('template/signout-modal.php');
    }

    if (isset($templateParams['layout'])) {
        require($templateParams['layout']);
    }
    ?>
    <?php if (signin_check($dbh) && basename($_SERVER['PHP_SELF']) == "index.php") : ?>
        <a href="#" data-bs-toggle="modal" data-bs-target="#postModal" class="post-button btn btn-<?php echo $main_color ?> rounded-pill">
            <div class="d-flex align-items-center justify-content-between gap-2 p-1">
                <?php require(SVG_DIR . "edit.svg") ?>
                <span class="h5 m-0 text-<?php echo $theme ?>">Posta</span>
            </div>
        </a>

        <script>
            $(function() {
                const button = $(".post-button")
                button.hide()
                $(document).on('scroll', function() {
                    const scrollTop = $(window).scrollTop()
                    const postFormOffset = $('#post-form').offset().top
                    const offset = 200
                    const animationTime = 200

                    scrollTop > postFormOffset + offset ? button.show(animationTime) : button.hide(animationTime)
                })
            })
        </script>
    <?php endif; ?>

</body>

</html>
