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
        <div class="col-md-6">
            <div class="title">
                <h3><?= $text_security; ?></h3>
            </div>
            <?php if (!isset($user['twofa_enabled']) || $user['twofa_enabled'] === 0) : ?>
                <div class="col-md-6">
                    <h4><?= $text_scan_qr; ?></h4>
                    <img src="<?= $qrCodeUrl; ?>" alt="Rounded Image" class="rounded img-fluid">
                </div>
                <div class="col-md-6">
                    <form method="post" action="#">
                        <h4><?= $text_confirm_qr; ?></h4>
                        <div class="form-group bmd-form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="material-icons">vpn_key</i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="twofa_confirm_key"
                                       placeholder="<?= $text_2fa_code; ?>">
                                <input type="hidden" name="twofa_secret"
                                       value="<?= isset($secret) ? $secret : null; ?>">
                            </div>
                            <input type="submit" class="btn btn-primary" name="btn_enable_2fa"
                                   value="<?= $text_confirm; ?>">
                        </div>
                    </form>
                </div>
            <?php endif; ?>
<!--            btn_disable_2fa-->


        </div>
    </div>
</div>