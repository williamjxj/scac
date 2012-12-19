<?php /* Smarty version Smarty-3.0.4, created on 2012-12-18 22:36:50
         compiled from ".//templates/search.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1473050d16082c2bdb2-05457645%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee346a72fe4c8b2c122c2be14d9ed1dec8c6c55b' => 
    array (
      0 => './/templates/search.tpl.html',
      1 => 1355898998,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1473050d16082c2bdb2-05457645',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php  $_config = new Smarty_Internal_Config(((isset($_smarty_tpl->getVariable('config')->value['smarty']) ? $_smarty_tpl->getVariable('config')->value['smarty'] : null)), $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars(null, 'local'); ?>
<?php $_smarty_tpl->tpl_vars['dcn'] = new Smarty_variable(1, null, null);?>
<form id="search_form" name="search_form" method="post" action="<?php echo (isset($_SERVER['SCRIPT_NAME'])? $_SERVER['SCRIPT_NAME'] : null);?>
">
  <fieldset>
  <legend>Search [<?php echo ((mb_detect_encoding((($tmp = @(isset($_smarty_tpl->getVariable('config')->value['title']) ? $_smarty_tpl->getVariable('config')->value['title'] : null))===null||$tmp==='' ? (isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null) : $tmp), 'UTF-8, ISO-8859-1') === 'UTF-8') ? mb_strtoupper((($tmp = @(isset($_smarty_tpl->getVariable('config')->value['title']) ? $_smarty_tpl->getVariable('config')->value['title'] : null))===null||$tmp==='' ? (isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null) : $tmp),SMARTY_RESOURCE_CHAR_SET) : strtoupper((($tmp = @(isset($_smarty_tpl->getVariable('config')->value['title']) ? $_smarty_tpl->getVariable('config')->value['title'] : null))===null||$tmp==='' ? (isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null) : $tmp)));?>
] Form:</legend>
  <table border="0px">
    <tbody>
    
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('search_form')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
    <?php if ($_smarty_tpl->getVariable('dcn')->value%(isset($_smarty_tpl->getVariable('config')->value['dcn']) ? $_smarty_tpl->getVariable('config')->value['dcn'] : null)){?> 
    <tr> <?php }?>
    <?php if ((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='text'){?>
      <td><label for="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
"> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label></td>
      <td><input name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" type="text" id="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
" /></td>
    <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='select'){?>
      <td><label for="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
"> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label></td>
      <td><div class="selectWrapper"><select name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" id="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
">
      	<?php if ((isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null)=='users'){?><?php echo $_smarty_tpl->smarty->registered_objects['obj'][0]->get_level();?>

       	<?php }elseif((isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null)=='emails'){?><?php echo $_smarty_tpl->smarty->registered_objects['obj'][0]->get_groups_options();?>

		<?php }elseif((isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null)=='common_users'){?><?php echo $_smarty_tpl->smarty->registered_objects['obj'][0]->get_groups_options();?>

		<?php }?>
        <?php if ((isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null)=='modules'){?>
		  <?php if ((isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null)=='group'){?> <?php echo $_smarty_tpl->smarty->registered_objects['obj'][0]->get_groups_options();?>
 <?php }?>
        <?php }?>
        
        <?php if ((isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null)=='contents'){?>
		  <?php if ((isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null)=='mid'){?><?php echo $_smarty_tpl->smarty->registered_objects['obj'][0]->get_modules_options();?>

		  <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null)=='group'){?><?php echo $_smarty_tpl->smarty->registered_objects['obj'][0]->get_groups_options();?>

		  <?php }?>
        <?php }?>
        
        <?php if ((isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null)=='resources'){?>
		  <?php if ((isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null)=='mid'){?><?php echo $_smarty_tpl->smarty->registered_objects['obj'][0]->get_modules_options();?>

		  <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null)=='type'){?><?php echo $_smarty_tpl->smarty->registered_objects['obj'][0]->get_types_options();?>
            
		  <?php }?>
        <?php }?>
		
        <?php if ((isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null)=='actions'){?><?php echo $_smarty_tpl->smarty->registered_objects['obj'][0]->get_keyword_selection();?>
<?php }?>
        </select></div></td>
    <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='date'){?>
      <td><label for="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
"> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label></td>
      <td>
          
		      <a href="javascript: fPopCalendar('<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
')">        
              <div class="calendarinput">
              <input type="text" name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" id="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
"  value="YYYY-MM-DD" onFocus="this.select();" size="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['size']) ? $_smarty_tpl->tpl_vars['item']->value['size'] : null);?>
" />
              <img src="<?php echo (isset($_smarty_tpl->getVariable('config')->value['path']) ? $_smarty_tpl->getVariable('config')->value['path'] : null);?>
images/calendar.png" class="calendar" alt="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" border="0">
              </div>
              </a>
          
      </td>        
    <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='textarea'){?>
      <td><label for="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
"> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label></td>
      <td><textarea id="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['id']) ? $_smarty_tpl->tpl_vars['item']->value['id'] : null);?>
" name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
"></textarea></td>
      <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='radio'){?>
      <td><label> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label></td>
      <td><?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = (isset($_smarty_tpl->tpl_vars['item']->value['lists']) ? $_smarty_tpl->tpl_vars['item']->value['lists'] : null); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
        <div class="radio">
        <?php if ((isset($_smarty_tpl->tpl_vars['k']->value) ? $_smarty_tpl->tpl_vars['k']->value : null)==(isset($_smarty_tpl->tpl_vars['item']->value['checked']) ? $_smarty_tpl->tpl_vars['item']->value['checked'] : null)){?>
        <input name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" type="radio" value="<?php echo (isset($_smarty_tpl->tpl_vars['k']->value) ? $_smarty_tpl->tpl_vars['k']->value : null);?>
" checked="checked">
        <label><?php echo (isset($_smarty_tpl->tpl_vars['v']->value) ? $_smarty_tpl->tpl_vars['v']->value : null);?>
</label>        
        <?php }else{ ?>
        <input name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" type="radio" value="<?php echo (isset($_smarty_tpl->tpl_vars['k']->value) ? $_smarty_tpl->tpl_vars['k']->value : null);?>
" />        
        <label><?php echo (isset($_smarty_tpl->tpl_vars['v']->value) ? $_smarty_tpl->tpl_vars['v']->value : null);?>
</label>
        <?php }?>
        </div>
        <?php }} ?> </td>
      <?php }elseif((isset($_smarty_tpl->tpl_vars['item']->value['type']) ? $_smarty_tpl->tpl_vars['item']->value['type'] : null)=='checkbox'){?>
        <?php $_smarty_tpl->tpl_vars['checked'] = new Smarty_variable((isset($_smarty_tpl->tpl_vars['item']->value['checked']) ? $_smarty_tpl->tpl_vars['item']->value['checked'] : null), null, null);?>
      <td><label> <?php echo (isset($_smarty_tpl->tpl_vars['item']->value['display_name']) ? $_smarty_tpl->tpl_vars['item']->value['display_name'] : null);?>
 </label></td>
      <td><?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = (isset($_smarty_tpl->tpl_vars['item']->value['lists']) ? $_smarty_tpl->tpl_vars['item']->value['lists'] : null); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
        <div class="checkbox">
        <input name="<?php echo (isset($_smarty_tpl->tpl_vars['item']->value['name']) ? $_smarty_tpl->tpl_vars['item']->value['name'] : null);?>
" type="checkbox" value="<?php echo (isset($_smarty_tpl->tpl_vars['k']->value) ? $_smarty_tpl->tpl_vars['k']->value : null);?>
" <?php echo $_smarty_tpl->getVariable('checked')->value;?>
 >
        <label> <?php echo (isset($_smarty_tpl->tpl_vars['v']->value) ? $_smarty_tpl->tpl_vars['v']->value : null);?>
 </label>
        </div>
        <?php }} ?>
      </td>
      <?php }?>
      <?php if (!($_smarty_tpl->getVariable('dcn')->value%(isset($_smarty_tpl->getVariable('config')->value['dcn']) ? $_smarty_tpl->getVariable('config')->value['dcn'] : null))){?> </tr> <?php }?>
    <?php $_smarty_tpl->tpl_vars['dcn'] = new Smarty_variable($_smarty_tpl->getVariable('dcn')->value+1, null, null);?>
    <?php }} ?>
    <tr>
     </tr>
    </tbody>
    
  </table>      
      <div class="rowElem form-buttons">      
      	<div class="green-btn">
	        <input type="submit" id="seach_submit" name="seach_submit" value="Search <?php echo (($tmp = @(isset($_smarty_tpl->getVariable('config')->value['title']) ? $_smarty_tpl->getVariable('config')->value['title'] : null))===null||$tmp==='' ? (isset($_smarty_tpl->getVariable('config')->value['self']) ? $_smarty_tpl->getVariable('config')->value['self'] : null) : $tmp);?>
 Records" style="background-color:transparent; border-collapse:collapse; border-width:0px;">
        </div>
        <?php ob_start();?><?php echo $_smarty_tpl->getConfigVariable('wait1');?>
<?php $_tmp1=ob_get_clean();?><?php echo (($tmp = @(isset($_smarty_tpl->getVariable('config')->value['list']['wait1']) ? $_smarty_tpl->getVariable('config')->value['list']['wait1'] : null))===null||$tmp==='' ? $_tmp1 : $tmp);?>
        
        <input type="reset" id="reset" name="reset" value="Reset"></div>
   
  </fieldset>
</form>
<script language="javascript" type="text/javascript">
$('#search_form').bind('submit', function(event) {
	event.preventDefault();
	$.ajax({
		type: $(this).attr('method'),
		url: $(this).attr('action'),
		data: $(this).serialize()+'&search=1',
		beforeSend: function() {
			$('img.wait', '#search_form').css('visibility','visible');
			//$('img[attr=alt]', '#search_form').css('visibility','visible');
			$('#search_submit').hide();
		},
		success: function(data) {
			$('#div_list').hide().html(data).fadeIn(100);
			$('#search_submit').show();
			$('img.wait', '#search_form').css('visibility', 'hidden');
		}
	});
	return false;
});

$('#search_form fieldset legend').click( function() {
	$('#div_search_2').fadeOut(200);
	$('#div_search_1').fadeIn(200).mouseover( function() {
		$(this).css('cursor', 'hand').css('cursor', 'pointer');
	});
});
$('input.class').keypress( function(event) {
	if(event.charCode && (event.charCode<48 || event.charCode>57))
		event.preventDefault();
});
</script>
