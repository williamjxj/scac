<?php
session_start();
error_reporting(E_ALL);
define('SITEROOT', './');

ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.SITEROOT.'configs/'.PATH_SEPARATOR.SITEROOT.'include/');
require_once("setting.inc.php");
require_once("config.inc.php");
require_once("ListAdvanced.inc.php");
global $config;

class EmailClass extends ListAdvanced
{
  var $url, $self, $session;
  public function __construct() {
    parent::__construct();
  }

  function get_search_form_settings() {
  return array(
    array(
      'type' => 'text',
      'display_name' => '用户名称',
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
      'display_name' => 'English Name:',
      'id' => 'englishname_s',
      'name' => 'englishname',
    ),
    array(
      'type' => 'text',
      'display_name' => '中文名字:',
      'id' => 'chinesename_s',
      'name' => 'chinesename',
    ),
    array(
      'type' => 'text',
      'display_name' => '邮件:',
      'id' => 'email_s',
      'name' => 'email',
    ),
    array(
      'type' => 'radio',
      'display_name' => 'Active:',
      'name' => 'active',
      'lists' => array(
        'N' => 'No',
        'Y' => 'Yes',
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
    array(
      'type' => 'select',
      'display_name' => '所属团契:',
      'id' => 'fellowship_s',
      'name' => 'fellowship',
      'call_func' => 'get_groups_options',
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
      'display_name' => '用户名称:',
      'name' => 'username',
    ),
    array(
      'type' => 'text',
      'display_name' => '中文名字:',
      'name' => 'chinesename',
    ),
    array(
      'type' => 'text',
      'display_name' => 'English Name:',
      'name' => 'englishname',
    ),
    array(
      'type' => 'text',
      'display_name' => '电话:',
      'name' => 'phone',
    ),
    array(
      'type' => 'text',
      'display_name' => '邮件:',
      'name' => 'email',
    ),
    array(
      'type' => 'text',
      'display_name' => '所属团契:',
      'name' => 'fellowship',
    ),
    array(
      'type' => 'radio',
      'display_name' => 'Active:',
      'name' => 'active',
      'lists' => array(
        'N' => 'No',
        'Y' => 'Yes',
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
      'display_name' => '用户名称:',
      'id' => 'username',
      'name' => 'username',
    ),
    array(
      'type' => 'text',
      'display_name' => '邮件:',
      'id' => 'email',
      'name' => 'email',
    ),
    array(
      'type' => 'text',
      'display_name' => '电话:',
      'id' => 'phone',
      'name' => 'phone',
    ),
    array(
      'type' => 'text',
      'display_name' => '地址:',
      'id' => 'address',
      'name' => 'address',
    ),
    array(
      'type' => 'text',
      'display_name' => '中文名字:',
      'id' => 'chinesename',
      'name' => 'chinesename',
    ),
    array(
      'type' => 'text',
      'display_name' => 'English Name:',
      'id' => 'englishname',
      'name' => 'englishname',
    ),
    array(
      'type' => 'select',
      'display_name' => '团契:',
      'id' => 'fellowship',
      'name' => 'fellowship',
      'call_func' => 'get_groups_options',
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
		'用户名称' => 'username',
		'电邮' => 'email',
		'电话' => 'phone',
		'团契' => 'fellowship',
		'英文名' => 'englishname',
		'中文名' => 'chinesename',
		'地址' => 'address',
		'描述' => 'description',
		'创建' => 'created,createdby',
		'更新' => 'updated,updatedby',
	);
  }
  
  function get_emails_asc()
  {
    $emails = "";
    $query = "SELECT email FROM emails ORDER BY email";
	$res = $this->mdb2->query($query);
    while ($row = $res->fetchRow()) {
      $emails .= $row[0] . ",<br>";
    }
	return preg_replace("/,$/", '', $emails);
  }
  
  function get_emails_desc()
  {
    $emails = "";
    $query = "SELECT email FROM emails ORDER BY email DESC";
	$res = $this->mdb2->query($query);
    while ($row = $res->fetchRow()) {
      $emails .= $row[0] . ",<br>";
    }
	return preg_replace("/,$/", '', $emails);
  }
}

try {
  $email = new EmailClass();
} catch (Exception $e) {
  echo $e->getMessage(), "\n";
}

if(! $email->check_access()) {
  $email->set_breakpoint();
  echo "<script>if(window.opener){window.opener.location.href='".LOGIN."';} else{window.parent.location.href='".LOGIN."';}</script>";exit;
}

$email->set_default_config(array('jvalidate' => true,'tabs' => array('1' => '邮件列表', '2' => '添加邮件', '3' => '邮件管理')));
$email->get_table_info();

if(isset($_GET['js_search_form'])) {
  $ary = $email->get_search_form_settings();
  $email->assign('search_form', $ary);  
  $email->assign('config', $config);
  $email->display($config['templs']['search']);
}
elseif(isset($_GET['js_get_emails'])) {
  $emails = array();
  $emails['asc'] = $email->get_emails_asc();
  $emails['desc'] = $email->get_emails_desc();
  $email->assign('emails', $emails);  
  $email->display('emails.tpl.html');
}
elseif(isset($_GET['js_edit_form'])) {
  $ary = $email->get_edit_form_settings();
  $record = $email->get_record($_GET['id']);

  if(isset($_GET['tr'])) $form_id = 'ef_'.$_GET['id'].'-'.$_GET['tr'];
  else $form_id = 'ef_'.$_GET['id'];

  $email->assign('form_id', $form_id);  
  $email->assign('record', $record);  
  $email->assign('edit_form', $ary);  
  $email->assign('config', $config);
  $email->display($config['templs']['edit']); //'edit.tpl.html');
}
elseif(isset($_GET['js_add_form'])) {
  $ary = $email->get_add_form_settings();
  $email->assign('add_form', $ary);  
  $email->assign('config', $config);
  $email->display($config['templs']['add']); //'add.tpl.html'
}
elseif(isset($_POST['js_edit_column'])) {
  $ret = $email->update_column(array('updatedby'=>$email->username));
  echo json_encode($ret);
}
elseif(isset($_REQUEST['action'])) {
  switch($_REQUEST['action']) {
    case 'edit':
      $ary = $email->get_edit_form_settings();
      echo json_encode($email->edit_table($ary));
      break;
    case 'delete':
      $email->delete($_GET['id']);
      break;
    case 'add':
      $last_uid = $email->create(array('createdby'=>$email->username, 'updatedby'=>$email->username, 'created'=>'NOW()', 'updated'=>'NOW()'));
      break;    
    default:
      break;
  }
}
else if( isset($_POST['search']) || (isset($_GET['page']) && isset($_GET['sort'])) || isset($_GET['page']) || isset($_GET['js_reload_list']) ) {
  if(isset($_POST['search'])) $email->parse();

  $data = $email->list_all();
  $data['options'] = array(EDIT, DELETE);

  $header = $email->get_header();
  $pagination = $email->draw( $data['current_page'], $data['total_pages'] );
  
  $email->assign('config', $config);
  $email->assign('header', $header);
  $email->assign('data', $data);
  $email->assign("pagination", $pagination);
  $tpl = $email->get_html_template();
  $email->display($tpl);
}
else {
  if (isset($_SESSION[$email->self][$email->session['sql']])) $_SESSION[$email->self][$email->session['sql']] = '';

  $total_rows = $email->get_total_rows($email->get_count_sql());

  $_SESSION[$email->self][$email->session['rows']] = $total_rows < 1 ? 1 : $total_rows;
  
  $data = $email->list_all();
  $data['options'] = array(EDIT, DELETE);

  $header = $email->get_header();
  $pagination = $email->draw( $data['current_page'], $data['total_pages'] );

  $email->assign('config', $config);
  $email->assign('header', $header);
  $email->assign('data', $data);
  $email->assign("pagination", $pagination);
  $email->assign("template", $email->get_html_template());
  $email->display($config['templs']['main']);
}
?>
