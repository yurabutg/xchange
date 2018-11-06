<div class="hero-section">
    <div class="container nopadding">

        <div class="card">
            <div class="card-body">
                <div class="blockquote undefined">
                    <p>
                        <?= $text_how_exxchange; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 margin-top-20">
                        <ul class="nav nav-pills nav-pills-icons nav-pills-danger" role="tablist">
                            <?php if (!empty($crypto_currencys) && isset($crypto_currencys)) : ?>
                                <?php foreach ($crypto_currencys as $id => $currency) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= ($id == 0) ? 'active' : ''; ?>"
                                           href="#primary_coin_<?= $currency['full_name'] ?>" role="tab"
                                           data-toggle="tab">
                                            <?= $this->Html->image('coins_icons/' . $currency['image'], ['alt' => $currency['name'], 'width' => '50px']); ?>
                                            <br><?= $currency['full_name'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        <div class="tab-content tab-space">
                            <?php if (!empty($crypto_currencys) && isset($crypto_currencys)) : ?>
                                <?php foreach ($crypto_currencys as $id => $currency) : ?>
                                    <div class="tab-pane <?= ($id == 1) ? 'active' : ''; ?>"
                                         id="primary_coin_<?= $currency['full_name'] ?>">
                                        <ul class="nav nav-pills nav-pills-icons nav-pills-success" role="tablist">
                                            <?php if (!empty($fiat_currencys) && isset($fiat_currencys)) : ?>
                                                <?php foreach ($fiat_currencys as $k => $fiat_currency) : ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link <?= ($k == 0) ? 'active' : ''; ?>"
                                                           href="#secondary_coin_<?= $fiat_currency['full_name'] ?>"
                                                           role="tab"
                                                           data-toggle="tab">
                                                            <?= $this->Html->image('coins_icons/' . $fiat_currency['image'], ['alt' => $fiat_currency['name'], 'width' => '50px']); ?>
                                                            <br><?= $fiat_currency['full_name'] ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                        <div class="tab-content tab-space">
                                            <?php if (!empty($fiat_currencys) && isset($fiat_currencys)) : ?>
                                                <?php foreach ($fiat_currencys as $h => $fiat_currency_h) : ?>
                                                    <div class="tab-pane <?= ($h == 0) ? 'active' : ''; ?>"
                                                         id="secondary_coin_<?= $fiat_currency_h['full_name'] ?>">
                                                        <button class="btn btn-primary col-md-12">GO</button>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>