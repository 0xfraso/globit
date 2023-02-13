<?php
list(
    "username" => $username,
    "full_name" => $full_name,
    "profile_picture" => $profile_picture,
) = $user;
?>

<aside class="col-md-4 mt-4">
    <div class="p-3 d-flex flex-row flex-wrap gap-3 align-items-center mb-4">
        <img src="<?php echo PROFILE_PIC_DIR . $profile_picture ?>" class="rounded-circle avatar" alt="Immagine del profilo" style="width: 120px; height: 120px;">
        <div>
            <h3><?php echo $full_name ?></h3>
            <h5 class="text-<?php echo $main_color ?> mt-3 fw-bold">@<?php echo $username ?></h5>
        </div>
    </div>
    <div class="p-3 ms-4">
        <a href="#" data-bs-toggle="modal" data-bs-target="#signoutModal" class="btn bg-danger p-3 px-4">
            <span class="h6 m-0 fw-bold text-white">Esci</span>
        </a>
    </div>
</aside>
