<nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100"
     id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="<?= $app_root; ?>"><?= $text_home; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <?php if ($is_logged) : ?>
                    <li class="nav-item">
                        <a href="<?= $app_root; ?>users/profile/<?= $current_user['token']; ?>"
                           class="btn btn-raised btn-round"> <?= $text_profile; ?> </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $app_root; ?>users/logout"
                           class="btn btn-danger btn-raised btn-round"> <?= $text_logout; ?> </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="<?= $app_root; ?>users/login"
                           class="btn btn-raised btn-round"> <?= $text_login; ?> </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $app_root; ?>users/registration"
                           class="btn btn-primary btn-raised btn-round"> <?= $text_registration; ?> </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>