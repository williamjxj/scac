<?php
session_start();
defined('SITEROOT') or define('SITEROOT', getcwd());

require_once(SITEROOT.'/configs/setting.inc.php');
require_once(SITEROOT.'/configs/config.inc.php');
global $config;

require_once(SITEROOT.'/configs/base.inc.php');

$config['path'] = SITEROOT . '/';
$config['list'] = get_list_defs($config['path']);

$base = new BaseClass();

if(! $base->check_access()) {
  echo "<script>if(window.opener){window.opener.location.href='".LOGIN."';} else{window.location.href='".LOGIN."';}</script>";exit;
}

$smarty = new Smarty();
$smarty->assign("config", $config);

$smarty->display($config['templs']['index']);
?>
