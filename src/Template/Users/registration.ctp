<div class="row">
    <div class="col-lg-6 col-md-6 ml-auto mr-auto">
        <div class="card card-login">
            <form class="form" method="post" action="">
                <div class="card-header card-header-primary text-center">
                    <h4 class="card-title"><?= $text_registration; ?></h4>
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">face</i>
                    </span>
                        </div>
                        <input type="text" name="first_name" class="form-control" placeholder="<?= $text_first_name; ?>" autocomplete="off" required>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">face</i>
                    </span>
                        </div>
                        <input type="text" name="last_name" class="form-control" placeholder="<?= $text_last_name; ?>"autocomplete="off" required>
                    </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">mail</i>
                    </span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="<?= $text_email; ?>" autocomplete="off" required>
                    </div>


                    <div class="input-group">
                        <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="<?= $text_password; ?>" autocomplete="off" required>
                    </div>
                </div>
                <div class="footer text-center margin-top-20">
                    <input type="submit" class="btn btn-primary btn-sm" value="<?= $text_registration; ?>">
                </div>
            </form>
        </div>
    </div>
</div>
