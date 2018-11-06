<nav class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <a class="navbar-brand page-scroll" href="<?= $app_root; ?>"><img src="<?= $app_root ?>img/images/logo.png"
                                                                              width="80" height="30" alt="iLand"/></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php if ($is_logged) : ?>
                    <li class="nav-item">
                        <a href="<?= $app_root; ?>users/profile/<?= $current_user['token']; ?>"
                        > <?= $text_profile; ?> </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $app_root; ?>users/logout"
                        > <?= $text_logout; ?> </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="<?= $app_root; ?>users/login"
                        > <?= $text_login; ?> </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $app_root; ?>users/registration"
                        > <?= $text_registration; ?> </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <!--    --><? //= $this->Element('alerts'); ?>
</nav>