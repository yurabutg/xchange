<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8"/>
    <title>iLand Multipurpose Landing Page Template</title>
    <link rel="icon" href="<?= $app_root; ?>img/images/favicon.png" type="image/png" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="iLand Multipurpose Landing Page Template">
    <meta name="keywords" content="iLand HTML Template, iLand Landing Page, Landing Page Template">
    <!-- CSS Files -->
    <?= $this->Element('css'); ?>
</head>

<body>
<div class="wrapper">
    <div class="container">
        <?= $this->Element('nav_bar'); ?>
    </div>
    <?= $this->Element('alerts') ?>
    <div class="main app form" id="main">
        <?= $this->fetch('content') ?>
        <?= $this->Element('footer'); ?>
    </div>
</div>
<? //= $this->Element('modals'); ?>
<?= $this->Element('js'); ?>
</body>
</html>