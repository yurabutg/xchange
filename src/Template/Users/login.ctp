<div id="pricing" class="pricing-section text-center">
    <div class="container">
        <div class="col-md-12 col-sm-12 nopadding">
            <div class="pricing-intro">
                <h1 class="wow fadeInUp" data-wow-delay="0s">Easy Pricing Plans</h1>
                <p class="wow fadeInUp" data-wow-delay="0.2s"> Lorem ipsum dolor sit. Incidunt laborum beatae earum
                    nihil odio consequatur officiis <br class="hidden-xs">tempore consequuntur officia ducimus unde
                    doloribus quod unt repell </p>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="table-right table-center wow fadeInUp" data-wow-delay="0.6s">
                    <div class="icon"><i class="ion-log-in"></i></div>
                    <div class="pricing-details">
                        <h2><?= $text_login; ?></h2>
                        <form method="post" action="">
                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                            <ul>
                                <li><input type="email" class="form-control" placeholder="<?= $text_email; ?>"
                                           name="email"
                                           autocomplete="off" required></li>
                                <li><input type="password" class="form-control" placeholder="<?= $text_password; ?>"
                                           name="password" autocomplete="off" required></li>
                                <li><a href="<?= $app_root; ?>users/recovery_email"
                                       class="btn btn-link btn-danger"><?= $text_password_forgotten; ?></a></li>
                            </ul>
                            <input type="submit" class="btn btn-primary btn-action btn-fill"
                                   value="<?= $text_login; ?>">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</div>