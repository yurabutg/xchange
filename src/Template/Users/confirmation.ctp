<input type="hidden" id="confirmation_result"
       value="<?= (isset($confirmation_result)) ? $confirmation_result : ''; ?>">

<div class="col-lg-10 col-md-10 ml-auto mr-auto">
    <div class="card margin-top-150">
        <?php //TODO: change text ?>
        <div class="d-none" id="confirmation_result_0">
            <div class="card-header card-header-primary text-center">
                <h4 class="card-title"><?= $text_user_confirmation_need_confirm_title; ?></h4>
            </div>
            <div class="card-body">
                <p>
                    <?= $text_user_confirmation_need_confirm; ?>
                </p>
            </div>
        </div>
        <div class="d-none" id="confirmation_result_1">
            <div class="card-header card-header-success text-center">
                <h4 class="card-title"><?= $text_user_confirmation_success_title; ?></h4>
            </div>
            <div class="card-body">
                <p>
                    <?= $text_user_confirmation_success; ?>
                </p>
            </div>
        </div>
        <div class="d-none" id="confirmation_result_2">
            <div class="card-header card-header-danger text-center">
                <h4 class="card-title"><?= $text_user_confirmation_no_user_title; ?></h4>
            </div>
            <div class="card-body">
                <p>
                    <?= $text_user_confirmation_no_user; ?>
                </p>
            </div>
        </div>
    </div>
</div>