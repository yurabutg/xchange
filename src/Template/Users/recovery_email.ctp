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
                    <div class="icon"><i class="ion-key"></i></div>
                    <div class="pricing-details">
                        <h2><?= $text_reset_password; ?></h2>
                        <form method="post" action="">
                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                            <ul>
                                <li><input type="email" class="form-control" placeholder="<?= $text_email; ?>"
                                           name="email"
                                           autocomplete="off" required></li>
                            </ul>
                            <input type="submit" class="btn btn-primary btn-action btn-fill"
                                   value="<?= $text_button_recovery; ?>">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
    </div>
</div>