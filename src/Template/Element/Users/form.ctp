<div id="inputs">
    <div class="row">
        <div class="col-md-6">
            <div class="title">
                <h3><?= $text_profile ?></h3>
            </div>
            <div class="col-md-12">
                <div class="form-group bmd-form-group">
                    <label for="exampleInput1" class="bmd-label-floating"><?= $text_first_name; ?></label>
                    <input type="text" class="form-control" id="exampleInput1"
                           value="<?= (isset($user['first_name']) ? $user['first_name'] : '') ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group bmd-form-group">
                    <label for="exampleInput2" class="bmd-label-floating"><?= $text_last_name; ?></label>
                    <input type="text" class="form-control" id="exampleInput2"
                           value="<?= (isset($user['last_name']) ? $user['last_name'] : '') ?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group bmd-form-group">
                    <label for="exampleInput3" class="bmd-label-floating"><?= $text_email; ?></label>
                    <input type="email" class="form-control" id="exampleInput3"
                           value="<?= (isset($user['email']) ? $user['email'] : '') ?>">
                </div>
            </div>
        </div>
    </div>
</div>