<div class="container">
    <div class="wow fadeInDown">
        <div class="alert alert-<?= (isset($class)) ? $class : 'info'; ?>  <?= (isset($show_alert) && $show_alert) ? '' : '' ?>"
             role="alert">
            <div class="text-center">
                <?= (isset($alert_text)) ? $alert_text : ''; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>