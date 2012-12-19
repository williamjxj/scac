<?php
session_start();
error_reporting(E_ALL);
define('SITEROOT', './');

ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.SITEROOT.'configs/'.PATH_SEPARATOR.SITEROOT.'include/');
require_once("setting.inc.php");
require_once("config.inc.php");
require_once("ListAdvanced.inc.php");
global $config;

$config['tabs'] = array('1'=>'团契列表', '2'=>'添加团契');

class GroupsClass extends ListAdvanced
{
  var $url, $self, $session;
  public function __construct() {
    parent::__construct();
  }

  function get_search_form_settings() {
	return array(
		array(
			'type' => 'text',
			'display_name' => '团契名称:',
			'id' => 'name_s',
			'name' => 'name',
		),
		array(
			'type' => 'radio',
			'display_name' => '状态:',
			'name' => 'active',
			'lists' => array(
				'N' => '禁止',
				'Y' => '允许',
				'A' => '所有',
			),
			'checked' => 'A',
			'ignore' => 'A',
		),
		array(
			'type' => 'date',
			'display_name' => '创建日期:',
			'id' => 'created_s',
			'name' => 'created',
			'size' => INPUT_SIZE,
		),
		array(
			'type' => 'text',
			'display_name' => '创建者:',
			'id' => 'createdby_s',
			'name' => 'createdby',
		),			
	);
  }

  function get_edit_form_settings() {
	return array(
		array(
			'type' => 'text',
			'display_name' => '团契名称:',
			'name' => 'name',
		),
		array(
			'type' => 'textarea',
			'display_name' => '描述说明:',
			'name' => 'description',
		),
		array(
			'type' => 'date',
			'display_name' => '创建日期:',
			'name' => 'created',
			'size' => INPUT_SIZE,
		),
		array(
			'type' => 'radio',
			'display_name' => '活动状态:',
			'name' => 'active',
			'lists' => array(
				'N' => '禁止',
				'Y' => '允许',
			),
		),
		array(
			'type' => 'hidden',
			'name' => 'gid',
		)
	);
  }
  
  function get_group_by_id($gid) {
  	$query = "SELECT gid, name FROM groups WHERE gid=".$gid;
	$row = $this->mdb2->queryRow($query);
	echo  "\t<option value=\"" . $row[0] . "\">$row[1]</option>\n";
  }
  
  function get_groups() {
	$sql = "SELECT gid, name FROM groups";
	$result = $this->mdb2->query($sql);
	echo "\t<option value=''> ------ </option>\n";
	while ($row=$result->fetchRow()) {
		echo "\t<option value=\"" . $row[0] . "\">$row[1]</option>\n";
	}
  }
  function get_add_form_settings() {
	return array(
		array(
		  'type' => 'text',
		  'display_name' => '团契名称:',
		  'id' => 'name',
		  'name' => 'name',
		),
		array(
		  'type' => 'textarea',
		  'display_name' => '描述说明:',
		  'id' => 'description',
		  'name' => 'description',
		  'size' => INPUT_SIZE+10,
		),
	  );
  }
  
  function get_header() {
	return array(
		'索引' => 'gid',
		'团契名称' => 'name',
		'描述' => 'description',
		'活动状态' => 'active',
		'创建者' => 'created',
		'创建于' => 'createdby',
		'更新者' => 'updated',
		'更新于' => 'updatedby',
	);
  }
    
}

$group = new GroupsClass();
if(! $group->check_access()) {
  $group->set_breakpoint();
  echo "<script>if(window.opener){window.opener.location.href='".LOGIN."';} else{window.parent.location.href='".LOGIN."';}</script>";exit;
}
$group->get_table_info();
$group->set_default_config(array('calender'=>true,'jvalidate'=>true));

if(isset($_GET['js_search_form'])) {
	$ary = $group->get_search_form_settings();
	// $group->get_search_form($ary);
	$group->assign('search_form', $ary);	
	$group->assign('config', $config);
	// $group->print_array($config);
	$group->display($config['templs']['search']); //'search.tpl.html'
}
elseif(isset($_GET['js_edit_form'])) {
	$ary = $group->get_edit_form_settings();
	// $group->get_edit_form($_GET['id'], $ary);
	$record = $group->get_record($_GET['id']);

        if(isset($_GET['tr'])) $form_id = 'ef_'.$_GET['id'].'-'.$_GET['tr'];
        else $form_id = 'ef_'.$_GET['id'];

	$group->assign('form_id', $form_id);	
	$group->assign('record', $record);	
	$group->assign('edit_form', $ary);	
	$group->assign('config', $config);
	$group->display($config['templs']['edit']); //'edit.tpl.html');
}
elseif(isset($_GET['js_add_form'])) {
	$ary = $group->get_add_form_settings();
	$group->assign('add_form', $ary);	
	$group->assign('config', $config);
	$group->display($config['templs']['add']); //'add.tpl.html'
}
elseif(isset($_POST['js_edit_column'])) {
	$ret = $group->update_column(array('updatedby'=>$group->username));
	echo json_encode($ret);
}
elseif(isset($_REQUEST['action'])) {
	switch($_REQUEST['action']) {
		case 'edit':
		  $ary = $group->get_edit_form_settings();
		  echo json_encode($group->edit_table($ary));
			break;
		case 'delete':
			$group->delete($_GET['id']);
			break;
		case 'add':
			$group->create(array('createdby'=>$group->username, 'updatedby'=>$group->username, 'created'=>'NOW()'));
			break;    
		default:
			break;
	}
}
else if( isset($_POST['search']) || (isset($_GET['page']) && isset($_GET['sort'])) || isset($_GET['page']) || isset($_GET['js_reload_list']) ) {
	if(isset($_POST['search'])) $group->parse();

	$data = $group->list_all();
	$data['options'] = array(EDIT, DELETE);
	
	$header = $group->get_header();
	//$header = $group->get_header($group->get_mappings());

	$pagination = $group->draw( $data['current_page'], $data['total_pages'] );
	
	$group->assign('config', $config);

	$group->assign('header', $header);
	$group->assign('data', $data);
	$group->assign("pagination", $pagination);
	$tpl = $group->get_html_template();
	$group->display($tpl); // not use display, should use AJAX.
}
else {
	if (isset($_SESSION[$group->self][$group->session['sql']])) $_SESSION[$group->self][$group->session['sql']] = '';

	$total_rows = $group->get_total_rows($group->get_count_sql());

	$_SESSION[$group->self][$group->session['rows']] = $total_rows < 1 ? 1 : $total_rows;
	
	$data = $group->list_all();
	$data['options'] = array(EDIT, DELETE);
	
	$header = $group->get_header($group->get_mappings());

	$pagination = $group->draw( $data['current_page'], $data['total_pages'] );
	
	$tpl = $group->get_html_template();

	$group->assign('config', $config);
	$group->assign('header', $header);
	$group->assign('data', $data);
	$group->assign("pagination", $pagination);

	$group->assign("template", $tpl);
	$group->display($config['templs']['main']);
}
?>
