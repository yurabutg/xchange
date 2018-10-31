<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Material Kit by Creative Tim
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!-- CSS Files -->
    <?= $this->Element('css'); ?>
</head>

<body class="login-page sidebar-collapse">
<?= $this->Element('nav_bar', ['class' => 'navbar navbar-inverse fixed-top navbar-expand-lg bg-dark']); ?>
<div class="page-header header-filter" data-parallax="true"
     style="background-image: url('<?= $app_root; ?>img/bg7.jpg');">
    <div class="container">
        <?= $this->fetch('content') ?>
    </div>
    <?= $this->Element('modals'); ?>
    <?= $this->Element('footer'); ?>
    <?= $this->Element('js'); ?>
</div>
</body>
</html>