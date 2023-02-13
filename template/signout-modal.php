<form action="actions/signout.php" class="modal fade" id="signoutModal" tabindex="-1" aria-labelledby="signoutModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-<?php echo $theme ?>">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="signoutModalLabel">Esci</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Sei sicuro di voler uscire?</p>
            </div>
            <div class="modal-footer border-top-0">
                <button type="submit" class="btn btn-<?php echo $main_color ?>" aria-label="Confirm">Conferma</button>
            </div>
        </div>
    </div>
</form>
