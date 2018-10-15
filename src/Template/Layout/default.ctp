<!DOCTYPE html>
<html>
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

<body class="profile-page sidebar-collapse">
<?= $this->Element('nav_bar'); ?>
<div class="page-header header-filter" data-parallax="true" style="background-image: url('../img/city-profile.jpg');"></div>
<div class="main main-raised">
    <div class="section main-section">
        <div class="container">
            <?= $this->fetch('content')?>
        </div>
    </div>
</div>
<?= $this->Element('footer');?>
<?= $this->Element('js');?>
</body>
</html>