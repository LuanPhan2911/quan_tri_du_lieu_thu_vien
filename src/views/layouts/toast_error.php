<?php
if (isset($_SESSION["err"])) {
?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3 ">
        <div class="toast show bg-danger">
            <div class="d-flex">
                <div class="toast-body text-white">
                    <?php echo flash("err") ?>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>

        </div>
    </div>

<?php

}
?>