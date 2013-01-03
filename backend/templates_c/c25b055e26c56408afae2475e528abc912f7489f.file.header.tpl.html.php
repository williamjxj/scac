<?php /* Smarty version Smarty-3.0.4, created on 2013-01-03 06:12:44
         compiled from "./templates/header.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:3125450e5134c246865-71351640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c25b055e26c56408afae2475e528abc912f7489f' => 
    array (
      0 => './templates/header.tpl.html',
      1 => 1357166597,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3125450e5134c246865-71351640',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />
<base target="mainFrame">
<link rel="stylesheet" type="text/css" href="<?php echo (isset($_smarty_tpl->getVariable('config')->value['path']) ? $_smarty_tpl->getVariable('config')->value['path'] : null);?>
css/header.css" />
<link rel="stylesheet" type="text/css" href="<?php echo (isset($_smarty_tpl->getVariable('config')->value['ipath']) ? $_smarty_tpl->getVariable('config')->value['ipath'] : null);?>
bootstrap/css/bootstrap.css" />
<link rel="shortcut icon" href="favicon.ico">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo (isset($_smarty_tpl->getVariable('config')->value['ipath']) ? $_smarty_tpl->getVariable('config')->value['ipath'] : null);?>
bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
;(function($) {
  getDateTime = function() {
	var dt = new Date();
	return dt.getFullYear() + '年' + (dt.getMonth() + 1) + '月' + dt.getDate() + '日 ' + dt.getHours() + '时' + dt.getMinutes() + '分' + dt.getSeconds() + '秒';
  };
})(jQuery);
$(function() {
  $('#dt').html(getDateTime());
});
</script>
</head>
<body>
<div id="header_<?php echo (isset($_smarty_tpl->getVariable('config')->value['browser_id']) ? $_smarty_tpl->getVariable('config')->value['browser_id'] : null);?>
">
  <div class="row">
    <div class="dixilogo"></div>
    <div class="span8 hlist"> <span class="user-info"><i class="icon-check icon-white"></i>&nbsp;欢迎 <strong> <?php echo (isset($_SESSION['scac']['username'])? $_SESSION['scac']['username'] : null);?>
, </strong> <i class="icon-time icon-white"></i>&nbsp;当前时间: <span id="dt"></span> </span> &nbsp;&nbsp; <a class="btn btn-danger" href="login.php?logout=1" onClick="parent.document.location.href=this.href;return false;"><i class="icon-share icon-white"></i> 注销</a> <a class="btn btn-info" href="javascript:void(0);"><i class="icon-info-sign icon-white"></i> 更多信息&raquo;</a> </div>
    <div class="btn-toolbar" style="margin-bottom: 9px">
      <div class="btn-group"> <a href="#" class="btn btn-primary"><i class="icon-user icon-white"></i>帮助</a> <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#"><i class="icon-pencil"></i> 联络我们</a></li>
          <li><a href="#"><i class="icon-trash"></i> 客户服务</a></li>
          <li><a href="#"><i class="icon-ban-circle"></i> 帮助中心</a></li>
          <li class="divider"></li>
          <li><a href="#"><i class="icon-cog"></i> 系统管理员</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript">
$(function() {
});
</script>
</body>
</html>
