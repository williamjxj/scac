<?php
session_start();
error_reporting(E_ALL);
define('SITEROOT', './');

ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.SITEROOT.'configs/'.PATH_SEPARATOR.SITEROOT.'include/');
require_once("setting.inc.php");
require_once("config.inc.php");
require_once("ListAdvanced.inc.php");
global $config;

class CommonUsersClass extends ListAdvanced
{
  var $url, $self, $session;
  public function __construct() {
    parent::__construct();
  }

  function get_search_form_settings() {
	return array(
		array(
			'type' => 'text',
			'display_name' => '用户名:',
			'id' => 'username_s',
			'name' => 'username',
		),
		array(
			'type' => 'text',
			'display_name' => '描述:',
			'id' => 'description_s',
			'name' => 'description',
		),
		array(
			'type' => 'text',
			'display_name' => '名字:',
			'id' => 'firstname_s',
			'name' => 'firstname',
		),
		array(
			'type' => 'text',
			'display_name' => '姓氏:',
			'id' => 'lastname_s',
			'name' => 'lastname',
		),
		array(
			'type' => 'text',
			'display_name' => '电邮:',
			'id' => 'email_s',
			'name' => 'email',
		),
		array(
			'type' => 'radio',
			'display_name' => '状态:',
			'name' => 'active',
			'lists' => array(
				'N' => '禁止',
				'Y' => '活动',
				'A' => 'All',
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
	);
  }

  function get_edit_form_settings() {
	return array(
		array(
			'type' => 'text',
			'display_name' => '用户ID:',
			'name' => 'uid',
			'readonly' => 'readonly',
		),
		array(
			'type' => 'text',
			'display_name' => '用户名:',
			'name' => 'username',
		),
		array(
			'type' => 'password',
			'display_name' => '口令:',
			'name' => 'password',
		),
		array(
			'type' => 'text',
			'display_name' => '名字:',
			'name' => 'firstname',
		),
		array(
			'type' => 'text',
			'display_name' => '姓氏:',
			'name' => 'lastname',
		),
		array(
			'type' => 'date',
			'display_name' => '创建日期:',
			'name' => 'created',
			'size' => INPUT_SIZE,
			'readonly' => 'readonly',
		),
		array(
			'type' => 'text',
			'display_name' => '电邮:',
			'name' => 'email',
		),
		array(
			'type' => 'radio',
			'display_name' => '状态:',
			'name' => 'active',
			'lists' => array(
				'N' => '禁止',
				'Y' => '活动',
			),
		),
		array(
			'type' => 'textarea',
			'display_name' => '描述:',
			'name' => 'description',
		),
		array(
			'type' => 'hidden',
			'name' => 'uid',
			'db_type' => 'int',
		)
	);
  }

  function get_add_form_settings() {
	return array(
		array(
		  'type' => 'text',
		  'display_name' => '用户名:',
		  'id' => 'username',
		  'name' => 'username',
		),
		array(
		  'type' => 'password',
		  'display_name' => '口令:',
		  'id' => 'password1',
		  'name' => 'password',
		),
		array(
		  'type' => 'password',
		  'display_name' => '重复口令:',
		  'id' => 'password2',
		  'name' => 'password',
		),
		array(
		  'type' => 'text',
		  'display_name' => '名字:',
		  'id' => 'firstname',
		  'name' => 'firstname',
		),
		array(
		  'type' => 'text',
		  'display_name' => '姓氏:',
		  'id' => 'lastname',
		  'name' => 'lastname',
		),
		array(
			'type' => 'date',
			'display_name' => '生日:',
			'id' => 'dob',
			'name' => 'dob',
			'size' => INPUT_SIZE,
		),
		array(
			'type' => 'radio',
			'display_name' => '性别:',
			'name' => 'sex',
			'lists' => array(
				'M' => '男',
				'F' => '女',
			),
			'checked' => 'M',
		),
		array(
		  'type' => 'select',
		  'display_name' => '团契:',
		  'id' => 'group',
		  'name' => 'group',
		),
		array(
		  'type' => 'text',
		  'display_name' => '地址:',
		  'id' => 'address1',
		  'name' => 'address1',
		),
		array(
		  'type' => 'text',
		  'display_name' => '电话:',
		  'id' => 'phone',
		  'name' => 'phone',
		),
		array(
		  'type' => 'text',
		  'display_name' => '电邮:',
		  'id' => 'email',
		  'name' => 'email',
		),
		array(
		  'type' => 'textarea',
		  'display_name' => '描述:',
		  'id' => 'description',
		  'name' => 'description',
		  'size' => INPUT_SIZE+10,
		),
	 );
  }
  
  function get_header() {
	return array(
		'索引' => 'uid',
		'用户名' => 'username',
		'口令' => 'password',
		'名字' => 'firstname',
		'姓氏' => 'lastname',
		'电邮' => 'email',
		'描述' => 'description',
		'创建者' => 'created',
		'创建于' => 'createdby',
		'更新者' => 'updated',
		'更新于' => 'updatedby',
	);
  }
}

try {
	$user = new CommonUsersClass();
} catch (Exception $e) {
	echo $e->getMessage(), "\n";
}

if(! $user->check_access()) {
  $user->set_breakpoint();
  echo "<script>if(window.opener){window.opener.location.href='".LOGIN."';} else{window.parent.location.href='".LOGIN."';}</script>";exit;
}

$user->set_default_config(array('jvalidate' => true,'tabs' => array('1' => '注册用户列表', '2' => '添加用户')));
$user->get_table_info();

// controller to dispatch the HTTP REQUESTS.
if(isset($_GET['js_search_form'])) {
	$ary = $user->get_search_form_settings();

	$user->assign('search_form', $ary);	
	$user->assign('config', $config);
	$user->display($config['templs']['search']); //'search.tpl.html'
}
elseif(isset($_GET['js_edit_form'])) {
	$ary = $user->get_edit_form_settings();

	$record = $user->get_record($_GET['id']);

	if(isset($_GET['tr'])) $form_id = 'ef_'.$_GET['id'].'-'.$_GET['tr'];
	else $form_id = 'ef_'.$_GET['id'];

	$user->assign('form_id', $form_id);	
	$user->assign('record', $record);	
	$user->assign('edit_form', $ary);	
	$user->assign('config', $config);
	$user->display($config['templs']['edit']); //'edit.tpl.html');
}
elseif(isset($_GET['js_add_form'])) {
	$ary = $user->get_add_form_settings();

	$user->assign('add_form', $ary);	
	$user->assign('config', $config);
	$user->display($config['templs']['add']); //'add.tpl.html'
}
elseif(isset($_POST['js_edit_column'])) {
	$ret = $user->update_column(array('updatedby'=>$user->username));
	echo json_encode($ret);
}
elseif(isset($_REQUEST['action'])) {
	switch($_REQUEST['action']) {
		case 'edit':
		  $ary = $user->get_edit_form_settings();
		  echo json_encode($user->edit_table($ary));
			break;
		case 'delete':
			$user->delete($_GET['id']);
			break;
		case 'add':
			$user->create(array('createdby'=>$user->username, 'updatedby'=>$user->username, 'created'=>'NOW()'));
			break;    
		default:
			break;
	}
}
else if( isset($_POST['search']) || (isset($_GET['page']) && isset($_GET['sort'])) || isset($_GET['page']) || isset($_GET['js_reload_list']) ) {
	if(isset($_POST['search'])) $user->parse();

	$data = $user->list_all();
	$data['options'] = array(EDIT, DELETE);

	$header = $user->get_header();
	$pagination = $user->draw( $data['current_page'], $data['total_pages'] );
	
	$user->assign('config', $config);
	$user->assign('header', $header);
	$user->assign('data', $data);
	$user->assign("pagination", $pagination);
	$tpl = $user->get_html_template();
	$user->display($tpl); // not use display, should use AJAX.
}
else {
	if (isset($_SESSION[$user->self][$user->session['sql']])) $_SESSION[$user->self][$user->session['sql']] = '';

	$total_rows = $user->get_total_rows($user->get_count_sql());

	$_SESSION[$user->self][$user->session['rows']] = $total_rows < 1 ? 1 : $total_rows;
	
	$data = $user->list_all();
	$data['options'] = array(EDIT, DELETE);

	$header = $user->get_header();
	$pagination = $user->draw( $data['current_page'], $data['total_pages'] );

	$user->assign('config', $config);
	$user->assign('header', $header);
	$user->assign('data', $data);
	$user->assign("pagination", $pagination);
	$user->assign("template", $user->get_html_template());
	$user->display($config['templs']['main']);
}

?>
