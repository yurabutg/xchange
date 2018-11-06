<?php $js_version = '?' . $app_version; ?>

    <!-- jQuery -->
<?= $this->Html->script('jquery-2.1.1'); ?>
<?= $this->Html->script('bootstrap.min'); ?>
<?= $this->Html->script('plugins'); ?>
<?= $this->Html->script('menu'); ?>
<?= $this->Html->script('custom'); ?>

<?= ($current_controller === 'Users' && $current_action === 'confirmation') ? $this->Html->script('confirmation' . $js_version) : ''; ?>


    <!--reCaptcha Google-->
<?= $this->Html->script('https://www.google.com/recaptcha/api.js?render=' . $reCAPTCHA_key); ?>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('<?= $reCAPTCHA_key; ?>', {action: 'login'}).then(function (token) {
                $('#g-recaptcha-response').val(token);
            });
        });
    </script>