<?php /* Smarty version Smarty-3.0.4, created on 2012-12-18 20:02:29
         compiled from ".//templates/add.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:597350d13c554f0481-30976703%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b794ab01a01201abda704e12575f655e0847094d' => 
    array (
      0 => './/templates/add.tpl.html',
      1 => 1355869583,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '597350d13c554f0481-30976703',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php  $_config = new Smarty_Internal_Config(((isset($_smarty_tpl->getVariable('config')->value['smarty']) ? $_smarty_tpl->getVariable('config')->value['smarty'] : null)), $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars(null, 'local'); ?>
<link type="text/css" rel="stylesheet" href="css/scac-style.css">
<style type="text/css">
.message-succ {
	font-family: "Courier New", Courier, monospace;
	font-size: 14px;
	font-weight: bold;
	color: #FF0000;
	margin: 20px auto;
	padding: 4px;
	border: thin dotted #0000FF;
	width: 60%;
	display: none;
	text-shadow: 0 1px 0 #FFF;
}
</style>
<?php if ((isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null)=='themes'){?>
<div id="upload_response"></div>
<iframe id="iframe" name="iframe" src="about:blank" frameborder="0" style="width:100;height:100;border:0px solid #fff;"></iframe>
<form class="page-form add-form" id="add_form" name="add_form" method="POST" action="<?php echo (isset($_SERVER['SCRIPT_NAME'])? $_SERVER['SCRIPT_NAME'] : null);?>
" enctype="multipart/form-data" target="iframe">
<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
<?php }else{ ?>
<form class="page-form add-form" id="add_form" name="add_form" method="POST" action="<?php echo (isset($_SERVER['SCRIPT_NAME'])? $_SERVER['SCRIPT_NAME'] : null);?>
" >
  <?php }?>
  <div class="content-headline">Add <?php echo (($tmp = @(isset($_smarty_tpl->getVariable('config')->value['title']) ? $_smarty_tpl->getVariable('config')->value['title'] : null))===null||$tmp==='' ? (isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null) : $tmp);?>
 Form:</div>
  <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('add_form')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
  <?php ob_start();?><?php echo $_smarty_tpl->getVariable('dcn')->value;?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo (isset($_smarty_tpl->getVariable('config')->value['dcn']) ? $_smarty_tpl->getVariable('config')->value['dcn'] : null);?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp1%$_tmp2){?><?php }?>
  

  <?php if ((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='text'){?>
  <div class="input input-<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
">
    <label for="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
"><?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label>
    <input name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" type="text" id="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
" class="validate[required]" />
  </div>

  <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='password'){?>
  <div class="input">
    <label for="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
"> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label>
    <?php if ((isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null)=='password1'){?>
    <input name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" type="password" id="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
" class="validate[required]" />
    <?php }else{ ?>
    <input name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" type="password" id="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
" class="validate[required,confirm[password1]]" />
    <?php }?> </div>

  <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='select'){?>
  <div class="input">
    <label for="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
"> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label>
    <div class="selectWrapper">
      <select name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" id="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
" class="validate[required]">          
    <?php if ((isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null)=='users'){?><?php echo $_smarty_tpl->smarty->registered_objects['obj'][0]->get_level();?>

	<?php }elseif((isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null)=='common_users'){?><?php echo $_smarty_tpl->smarty->registered_objects['obj'][0]->get_groups_options();?>

	<?php }?>          
      </select>
    </div>
  </div>

  <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='date'){?>
  <div class="input">
    <label for="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
"> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label>
    <a href="javascript: fPopCalendar('<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
')">
    <input type="text" name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" id="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
"  value="YYYY-MM-DD" onFocus="this.select();" size="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['size']) ? $_smarty_tpl->tpl_vars['item']->value['size'] : null);?>
" class="validate[required,custom[date]]"/>
    <img src="<?php echo (isset($_smarty_tpl->getVariable('config')->value['path']) ? $_smarty_tpl->getVariable('config')->value['path'] : null);?>
images/cal2.jpg" width="14" height="14" alt="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" border="0"></a> </div>

  <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='textarea'){?>
  <div class="input" style="height: auto;">
    <label for="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
"> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label>
    <textarea class="textarea"  id="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
" name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
"></textarea>
  </div>

  <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='radio'){?>
  <div class="input">
    <label> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label>
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = (isset($_smarty_tpl->tpl_vars['item']->value['lists']) ? $_smarty_tpl->tpl_vars['item']->value['lists'] : null); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
    <?php if ((isset($_smarty_tpl->tpl_vars['k']->value) ? $_smarty_tpl->tpl_vars['k']->value : null)==(isset($_smarty_tpl->tpl_vars['item']->value['checked']) ? $_smarty_tpl->tpl_vars['item']->value['checked'] : null)){?>
    <input class="radio"  name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" type="radio" value="<?php echo (isset($_smarty_tpl->tpl_vars['k']->value) ? $_smarty_tpl->tpl_vars['k']->value : null);?>
" checked="checked">
    <span style="left"><?php echo (isset($_smarty_tpl->tpl_vars['v']->value) ? $_smarty_tpl->tpl_vars['v']->value : null);?>
</span>
    <?php }else{ ?>
    <input  class="radio" name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" type="radio" value="<?php echo (isset($_smarty_tpl->tpl_vars['k']->value) ? $_smarty_tpl->tpl_vars['k']->value : null);?>
" />
    <span style="left"><?php echo (isset($_smarty_tpl->tpl_vars['v']->value) ? $_smarty_tpl->tpl_vars['v']->value : null);?>
</span> <?php }?>
    <?php }} ?> </div>

  <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='file'){?>
  <div class="input">
    <label> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label>
    <input name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" id="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" type="file" class="validate[required,file]" size="50" />
    <!--style="width:250px; border:solid 1px !important;" -->
  </div>

  <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='checkbox'){?>
  <?php $_smarty_tpl->tpl_vars['checked'] = new Smarty_variable((isset($_smarty_tpl->tpl_vars['item']->value['checked']) ? $_smarty_tpl->tpl_vars['item']->value['checked'] : null), null, null);?> 
  <div class="input">
    <label> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label>
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = (isset($_smarty_tpl->tpl_vars['item']->value['lists']) ? $_smarty_tpl->tpl_vars['item']->value['lists'] : null); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
    <input name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" type="checkbox" value="<?php echo (isset($_smarty_tpl->tpl_vars['k']->value) ? $_smarty_tpl->tpl_vars['k']->value : null);?>
" <?php echo $_smarty_tpl->getVariable('checked')->value;?>
 class="validate[required] check" >
    <label> <?php echo (isset($_smarty_tpl->tpl_vars['v']->value) ? $_smarty_tpl->tpl_vars['v']->value : null);?>
 </label>
    <?php }} ?> </div>
  <?php }?>
  
  <?php ob_start();?><?php echo $_smarty_tpl->getVariable('dcn')->value;?>
<?php $_tmp3=ob_get_clean();?><?php ob_start();?><?php echo (isset($_smarty_tpl->getVariable('config')->value['dcn']) ? $_smarty_tpl->getVariable('config')->value['dcn'] : null);?>
<?php $_tmp4=ob_get_clean();?><?php if (!$_tmp3%$_tmp4){?> <?php }?>
  <?php ob_start();?><?php echo $_smarty_tpl->getVariable('dcn')->value;?>
<?php $_tmp5=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['dcn'] = new Smarty_variable($_tmp5+1, null, null);?>
  <?php }} ?>
  
  <div class="submit-buttons">
    <div class="green-btn">
      <input type="submit" id="add_submit" name="add_submit" value="添加 <?php echo (($tmp = @(isset($_smarty_tpl->getVariable('config')->value['title']) ? $_smarty_tpl->getVariable('config')->value['title'] : null))===null||$tmp==='' ? (isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null) : $tmp);?>
 Record!">
      <img src="<?php echo (isset($_smarty_tpl->getVariable('config')->value['path']) ? $_smarty_tpl->getVariable('config')->value['path'] : null);?>
images/ajax-loader.gif" id="upload_loading" border="0" width="35" height="35" style="display:none;" /> </div>
    <input type="reset" name="reset" value="Reset">
    &nbsp; <span id="add_msg" name="msg" style="display: none"> <?php ob_start();?><?php echo $_smarty_tpl->getConfigVariable('wait1');?>
<?php $_tmp6=ob_get_clean();?><?php echo (($tmp = @(isset($_smarty_tpl->getVariable('config')->value['list']['wait1']) ? $_smarty_tpl->getVariable('config')->value['list']['wait1'] : null))===null||$tmp==='' ? $_tmp6 : $tmp);?>
 </span> &nbsp; </div>
</form>
<script language="javascript" type="text/javascript">
$(document).ready(function() { 
    var this_form = $('#add_form');
	var url = this_form.attr('action');
	var this_submit = $('#add_submit');
	var this_msg = $('#add_msg');
	
<?php if ((isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null)=='themes'){?>
	var ifr = $('#iframe');
	var res = '#upload_response';
	this_form.validationEngine();
	var options = {
		target: res,
		url: url,
		type: this_form.attr('method'),
		iframe: true,
		iframeSrc: 'about:blank',
		timeout: 120000,
		beforeSubmit: function() {
			if ($('#upload_loading').length>0) $('#upload_loading').show();
			return true;
		},
		success: function(data) {
			if ($('#upload_loading').length>0) $('#upload_loading').hide();
		}
	};
	this_form.ajaxForm(options);

<?php }else{ ?>	
    this_form.bind('submit', function(event) {
        this_form.validationEngine();
        event.preventDefault();
        if(this_form.validationEngine({ returnIsValid:true })) {
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize()+'&action=add',
                beforeSend: function() {
                    this_submit.hide();
                    this_msg.show();
                },
                success: function(data) {
                    var msg = '';
                   	if(/MDB2 Error/i.test(data)) msg = data;
                   	else msg =  'Successfully insert this record:' + data;
                   	msg += 'Click reset button then to add more.';
                   	
                    if($('div.message-succ').length)
                        $('div.message-succ').show();
                    else
						$('<div></div>').addClass('message-succ').html(msg).insertBefore('#add_form').fadeIn(100);
                    this_submit.show().attr('disabled', 'disabled');
                    this_msg.hide();
                    $('#div_list').load(url+'?js_reload_list=1');
                }
            });
        }
        return false;
    });
<?php }?>

	$('input:reset', this_form).click( function() {
        this_submit.attr('disabled', false); //removeAttr("disabled");
        $('#add_form div.message-succ').fadeOut(100);
		if($('div.message-succ').length) $('div.message-succ').fadeOut(100);
    });
    // reject non-digit input, not used here.
    $('input.class').keypress( function(event) {
        if(event.charCode && (event.charCode<48 || event.charCode>57))
            event.preventDefault();
    });
	if($('.page-form div.input').size() > 4){
		$('.page-form').removeClass('add-form');
	}
});
</script>
