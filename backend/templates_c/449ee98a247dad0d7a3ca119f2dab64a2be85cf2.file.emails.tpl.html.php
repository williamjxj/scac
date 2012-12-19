<?php /* Smarty version Smarty-3.0.4, created on 2012-12-18 20:34:19
         compiled from "./templates/emails.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2002950d143cb913e13-96420390%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '449ee98a247dad0d7a3ca119f2dab64a2be85cf2' => 
    array (
      0 => './templates/emails.tpl.html',
      1 => 1355864683,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2002950d143cb913e13-96420390',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<meta content="text/html; charset=utf-8" />
<style type="text/css">
.box1 {
	background-color: #F9F9F9;
	color: #666666;
	padding: 4px;
	-moz-box-shadow:0px 0px 5px #888;
	-moz-border-radius: 4px;
	-webkit-box-shadow: 0px 0px 5px #888;
	-webkit-border-radius: 4px;
	box-shadow: 0px 0px 5px #888;
	text-shadow: 1px 1px 0 #FFFFFF;
	border-radius: 10px;
	border: 1px solid white;
	height: 240px;
	overflow-y: scroll;
	overflow-x: scroll;
	white-space: normal;
	word-wrap: break-word;
}
.econtent {
	background: url(images/box-bgr.gif) repeat scroll center top #FFFFFF;
	padding: 18px;
}
</style>
<div id="emails">
  <p>这里包括 一家团契 最新的邮件列表.</p>
  <h2>邮件降序排列:</h2>
  <div class="box1 econtent"><?php echo (isset($_smarty_tpl->getVariable('emails')->value['asc']) ? $_smarty_tpl->getVariable('emails')->value['asc'] : null);?>
</div>
  <h2>邮件升序排列:</h2>
  <div class="box1 econtent"><?php echo (isset($_smarty_tpl->getVariable('emails')->value['desc']) ? $_smarty_tpl->getVariable('emails')->value['desc'] : null);?>
</div>
  <h2>相关信息：</h2>
  <div class="box1">
    <p> Homepage:	 	http://www.scac-church.org/ </p>
  </div>
</div>
