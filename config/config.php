<?php
/* App settings */
$config['app_root'] = '/';
$config['app_name'] = 'X change';
$config['https_domain'] = $_SERVER['REQUEST_SCHEME'].'://'. $_SERVER['HTTP_HOST'];
$config['server_port'] = 'http://'.$_SERVER['HTTP_HOST'];
$config['app_owner'] = 'xxxxxxx';
$config['app_text_footer'] = '© '.date('Y').' - '.$config['app_owner'].' - All Rights Reserved.';
$config['app_logo_name_big'] = 'logo_webadge_big.png';
$config['app_logo_name_medium'] = 'logo_webadge_medium.png';
$config['app_logo_name_small'] = 'logo_webadge_small.png';
$config['app_logo_big'] = $config['app_root'].'webroot/img/'.$config['app_logo_name_big'];
$config['app_logo_medium'] = $config['app_root'].'webroot/img/'.$config['app_logo_name_medium'];
$config['app_logo_small'] = $config['app_root'].'webroot/img/'.$config['app_logo_name_small'];
$config['app_logo_report'] = $config['app_root'].'webroot/img/logo_gl.jpg';

/* Locale Format */
$config['date_format'] = 'd/m/Y';
$config['date_format_for_db'] = 'Y-m-d';

/* VERSIONING */
$config['app_version'] = '0.1';

debug($config);