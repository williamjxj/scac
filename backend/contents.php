<?php
session_start();
error_reporting(E_ALL);
define('SITEROOT', './');

ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.SITEROOT.'configs/'.PATH_SEPARATOR.SITEROOT.'include/');
require_once("setting.inc.php");
require_once("config.inc.php");
require_once("ListAdvanced.inc.php");
global $config;

$config['tabs'] = array('1'=>'列表', '2'=>'添加', '3'=> '更新');
$config['WYSIWYG'] = true;

class ContentsClass extends ListAdvanced
{
  var $url, $self, $session, $allowedTags;
  public function __construct() {
    parent::__construct();
	$this->allowedTags = ALLOWTAGS;
  }

  function get_search_form_settings() {
	return array(
		array(
		  'type' => 'select',
		  'display_name' => '模块:',
		  'id' => 'mid_s',
		  'name' => 'mid',
		  'call_func' => 'get_modules_options',
		  'db_type' => 'int',
		),
		array(
		  'type' => 'select',
		  'display_name' => '团契:',
		  'id' => 'group_s',
		  'name' => 'group',
		  'call_func' => 'get_groups_options',
		),
		array(
			'type' => 'radio',
			'display_name' => 'Active:',
			'id' => 'active_s',
			'name' => '活动状态',
			'lists' => array(
				'N' => '禁止',
				'Y' => '正常',
				'A' => '所有',
			),
			'checked' => 'A',
			'ignore' => 'A',
		),
		array(
			'type' => 'text',
			'display_name' => '标题:',
			'id' => 'title_s',
			'name' => 'title',
		),
		array(
			'type' => 'text',
			'display_name' => '作者/出处:',
			'id' => 'author_s',
			'name' => 'author',
		),
		array(
			'type' => 'date',
			'display_name' => '创建日期:',
			'id' => 'created_s',
			'name' => 'created',
			'size' => INPUT_SIZE,
		),
		array(
			'type' => 'date',
			'display_name' => '更改日期:',
			'id' => 'updated_s',
			'name' => 'updated',
			'size' => INPUT_SIZE,
		),
		array(
			'type' => 'text',
			'display_name' => '创建:',
			'id' => 'createdby_s',
			'name' => 'createdby',
		),
	);
  }

  function get_edit_form_settings() {
	return array(
		array(
		  'type' => 'text',
		  'display_name' => '模块:',
		  'name_value' => 'mid',
		  'name' => 'mname',
		),
		array(
		  'type' => 'select',
		  'display_name' => '团契:',
          'name_value' => 'gid',
		  'name' => 'gname',
		  'call_func' => 'get_groups_options',
		),
		array(
			'type' => 'radio',
			'display_name' => '活动状态:',
			'name' => 'active',
			'lists' => array(
				'N' => 'No',
				'Y' => 'Yes',
			),
		),
		array(
			'type' => 'text',
			'display_name' => '标题:',
			'name' => 'title',
		),
		array(
			'type' => 'text',
			'display_name' => '作者/出处:',
			'name' => 'author',
		),
		array(
			'type' => 'textarea',
			'display_name' => '注释:',
			'name' => 'notes',
		),
		array(
			'type' => 'text',
			'display_name' => '创建者:',
			'name' => 'createdby',
		),
		array(
			'type' => 'text',
			'display_name' => '更改者:',
			'name' => 'updatedby',
		),
		array(
			'type' => 'hidden',
			'name' => 'cid',
			'db_type' => 'int',
		)
	);
  }
  function get_header() {
	return array(
		'索引' => 'cid',
		'标题' => 'title',
		'模块名称' => 'notes',
		'模块' => 'mid',
		'模块' => 'mname',
		'团契' => 'gid',
		'团契' => 'gname',
		'注释' => 'tags',
		'语言' => 'guanzhu',
		'创建' => 'created,createdby',
		'更新' => 'updated,updatedby'
	);
  }
  function get_contents_options_by_mid($module_id){
	$sql = "SELECT cid, title, author, mname, gname, gid, mid FROM contents c WHERE mid=" . $module_id . " ORDER BY title";
	return 	$this->get_select_options($sql);
  }  
  function get_contents_options_by_group($module_id, $group){
  	if($group) {
		$sql = "SELECT cid, concat(title,'[',mid,']','[',gname,']') as title, author, mname, gname FROM contents c WHERE mid=" . $module_id . " AND gname='".$group."' ORDER BY title";
		return 	$this->get_select_options($sql);
	}
	else
		return $this->get_contents_options_by_mid($module_id);
  }  

  function update_modules_contents()
  {
	$mid = intval($_POST['modules']);
	$cids = explode(",", $_POST['mids']);

	$sql = "DELETE FROM contents WHERE mid=". $mid." AND weight<250";
	$affected = $this->mdb2->exec($sql);
	if (PEAR::isError($affected)) {
		echo $affected->getMessage().' line: ' . __LINE__; echo "[".$sql."]\n";
	}
	foreach($cids as $cid) {
		$sql = "INSERT INTO contents(
			title,author,notes,content,mid,gname,weight,active,createdby,created) 		
		SELECT
			title,author,notes,content,".$mid.",gname,weight,'Y','".$this->username."',NOW()
		FROM contents
		WHERE cid = ".$cid;
		echo $sql."\n";
		$affected = $this->mdb2->exec($sql);
		if (PEAR::isError($affected)) {
			continue;
		}
	}
	return true;
  }

  function update_contents_resources()
  {
	$cid = $_POST['cid'];
	$mids = explode(",", $_POST['mids']);

	$sql = "DELETE FROM contents_resources WHERE cid=". $cid;
	$affected = $this->mdb2->exec($sql);
	if (PEAR::isError($affected)) {
		die($affected->getMessage());
	}
	foreach($mids as $rid) {
		$sql = "INSERT INTO contents_resources(cid, rid, createdby) VALUES(". $cid. ", ".$rid.", '".$this->username."')";
		echo $sql."\n";
		$affected = $this->mdb2->exec($sql);
		if (PEAR::isError($affected)) {
			continue;
		}
	}
	return true;
  }

 function edit($username)
  {
	$gid = isset($_POST['gid'])?$_POST['gid']:'';
	$cid = $_POST['cid'];
	$active = $_POST['active'];

	if (get_magic_quotes_gpc()) {
		$title = trim($_POST['title']);
		$author = trim($_POST['author']);
		$notes = trim($_POST['notes']);
	}
	else {
		$title = $this->mdb2->escape(trim($_POST['title']));
		$author = $this->mdb2->escape(trim($_POST['author']));
		$notes = $this->mdb2->escape(trim($_POST['notes']));
	}

	$query = "UPDATE contents set title = '" . $title . "', " .
		 "author    = '" . $author ."', " .
		 "notes    = '" . $notes . "', " .
		 "active = '" . $active . "', " .
		 "gid = '" . $gid . "', updatedby='".$username."' WHERE cid =  " . $cid; 

	$affected = $this->mdb2->exec($query);
	if (PEAR::isError($affected)) {
		die($affected->getMessage(). ' line: [' . __LINE__ . ']. ' . $query);
	}

	$query = "SELECT * FROM contents WHERE cid=" . $cid;
	$row = $this->mdb2->queryRow($query, '', MDB2_FETCHMODE_ASSOC);

	$ary = array();
	$ary['cid'] = $cid;
	$ary['title'] = $row['title'];
	$ary['author'] = $row['author'];
	$ary['notes'] = $row['notes'];
	$ary['gid'] = $row['gid'];
	$ary['content'] = $row['content'];
	$encodedArray = array_map("utf8_encode", $ary);
	return $encodedArray;
  }

  // Quotes a string so it can be safely used in a query. It will quote the text so it can safely be used within a query. 
  function add()
  {
	$mid = $_POST['modules'];
	$mid2 = $_POST['modules2'];
	$gid = isset($_POST['groups'])?$_POST['groups']:'';
	if(isset($_POST['content'])) $content = $_POST['content'];
	elseif(isset($_POST['elm3'])) $content = $_POST['elm3'];

	if (get_magic_quotes_gpc()) {
		$title = trim($_POST['input_title_3']);
		$author = trim($_POST['input_author_3']);
		$notes = trim($_POST['input_notes_3']);
	}
	else {
		$title = $this->mdb2->escape(trim($_POST['input_title_3']));
		$author = $this->mdb2->escape(trim($_POST['input_author_3']));
		$notes = $this->mdb2->escape(trim($_POST['input_notes_3']));
		$content = $this->mdb2->escape($content);
	}

	$content = strip_tags($content,$this->allowedTags);

	$query = "INSERT INTO contents (title, author, notes, content, createdby, created, updatedby,mid,gid,mname,gname)
		VALUES('".$title."', '".$author."', '".$notes."', '" . $content . "', '" . $this->username . "', NOW(), '".$this->username."', ".
		$mid . ", " . $gid . ", '".$this->get_mname_from_mid($mid)."', '" . $this->get_gname_from_gid($gid) . "')";

	$affected = $this->mdb2->exec($query);
	if (PEAR::isError($affected)) {
		die($affected->getMessage().' line: ' . __LINE__.$query);
	}
	
	$id = $this->mdb2->lastInsertID();
	$query = "SELECT * FROM contents WHERE cid=" . $id;
	$row = $this->mdb2->queryRow($query, '', MDB2_FETCHMODE_ASSOC);

	$ary = array();
	$ary['cid'] = $id;
	$ary['title'] = $row['title'];
	$ary['author'] = $row['author'];
	$ary['notes'] = $row['notes'];
	$ary['content'] = $row['content'];
	$ary['mid'] = $row['mid'];
	$ary['gid'] = $row['gid'];
	$ary['mname'] = $row['mname'];
	$ary['gname'] = $row['gname'];
	$encodedArray = array_map("utf8_encode", $ary);
	return $encodedArray;
  }

  function edit_wysiwyg_table()
  {
	$mid = $_POST['modules'];
	$gid = $_POST['gid'];
	$cid = $_POST['id'];
	if(isset($_POST['content'])) $content = $_POST['content'];
	else foreach($_POST as $k=>$v) if(preg_match("/^elm_/", $k)) $content = $_POST[$k];

	if (get_magic_quotes_gpc()) {
		$title = trim($_POST['input_title_3']);
		$author = trim($_POST['input_title_3']);
		$notes = trim($_POST['input_notes_3']);
	}
	else {
		$title = $this->mdb2->escape(trim($_POST['input_title_3']));
		$author = $this->mdb2->escape(trim($_POST['input_title_3']));
		$notes = $this->mdb2->escape(trim($_POST['input_notes_3']));
		$content = addslashes($content);
	}

	$content = strip_tags($content, $this->allowedTags);

	$query = "UPDATE contents SET title = '" . $title . "', " .
		 "author    = '" . $author ."', " .
		 "notes    = '" . $notes . "', " .
		 "content  = '" . $content . "', " .
		 "mid      = " . $mid . ", " .
		 "gid = '" . $group . "', updatedby = '".$this->username."' WHERE cid =  " . $cid; 

	$affected = $this->mdb2->exec($query);
	if (PEAR::isError($affected)) {
		die($affected->getMessage() . ' line: ' . __LINE__);
	}

	$query = "SELECT * FROM contents WHERE cid=" . $cid;
	$row = $this->mdb2->queryRow($query, '', MDB2_FETCHMODE_ASSOC);
	$this->print_array($row);

	$ary = array();
	$ary['cid'] = $cid;
	$ary['title'] = $row['title'];
	$ary['author'] = $row['author'];
	$ary['notes'] = $row['notes'];
	$ary['content'] = $row['content'];
	$encodedArray = array_map("utf8_encode", $ary);
	return $encodedArray;
  }

  function get_module_name($query) {
	if(isset($query) && $query) {
		if (preg_match("/,\s*mid,/", $query))
			$query = preg_replace("/mid/", '(select name from modules where modules.mid=contents.mid) as mid', $query);
		return $query;
	}
	return;
  }

  function get_available_resources($cid) {
  	$sql = "SELECT rid, author, file FROM resources WHERE rid NOT IN (SELECT rid from contents_resources cr WHERE cid = " . $cid . ") AND active='Y' ORDER BY author";
	return 	$this->get_select_array($sql);
  }
  function get_assigned_resources($cid) {
  	$sql = "SELECT r.rid, author, file FROM resources r INNER JOIN contents_resources cr WHERE r.rid=cr.rid AND cr.cid = " . $cid . " AND active='Y' ORDER BY author";
	return 	$this->get_select_array($sql);
  }
    
  function get_content_record($cid) {
  	$ary = array();	
  	$query = "SELECT * FROM contents WHERE cid=".$cid;

	$result = $this->mdb2->query($query);
	$row = $result->fetchRow(MDB2_FETCHMODE_ASSOC);

	$ary['cid'] = $cid;
	$ary['title'] = $row['title'];
	$ary['author'] = $row['author'];
	$ary['notes'] = $row['notes'];
	$ary['content'] = $row['content'];
	$ary['mid'] = $row['mid'];
	$ary['mname'] = $row['mname'];
	$ary['gid'] = $row['gid'];
	$encodedArray = array_map("utf8_encode", $ary);
	return $encodedArray;
  }
  // different with resources.php.
  function select_assigned_contents($mid)
  {
	$sqlc = "SELECT cid, title, author, (SELECT name FROM modules m WHERE m.mid=c.mid) AS mname, gid  FROM contents c WHERE active='Y' AND mid=".$mid." ORDER BY title";
	return 	$this->get_select_options($sqlc, false);
  }  
  function select_available_contents($mid)
  {
	$sqlc = "SELECT cid, title, author, (SELECT name FROM modules m WHERE m.mid=c.mid) AS mname, gid FROM contents c WHERE active='Y' AND mid!=".$mid."  ORDER BY title";
	return 	$this->get_select_options($sqlc, false);
  }

  function get_emails($cid)
  {
    $num = rand(1,10);
    if ($num % 2 == 0 ) 
	  $order = " ORDER BY email";
    else
      $order = " ORDER BY email DESC";
	
	$emails = '';  
    $query = "SELECT email FROM emails " . $order;
	$res = $this->mdb2->query($query);
    while ($row = $res->fetchRow()) {
      $emails .= $row[0] . ',';
    }
	return preg_replace("/,$/", '', $emails);
  }

  function send_email($cid) 
  {
	$query = "SELECT * FROM contents WHERE cid=" . $cid;	

	$row = $this->mdb2->queryRow($query, '', MDB2_FETCHMODE_ASSOC);

    // by default send_email_flag='N', means this content is not sent email yet.
    if($row['send_email_flag']=='Y') {
	  echo "该信息已经发送过了,请不要重复发送. This content have already sent as email, no sending email anymore.";
	  return false;
	}

	$message = "邮件来自 http://www.scac-church.org/ ";
	$message .= "\n日期: " . date("Y-m-d h:i:s");
    $message .= $row['content'];

    $siteEmails = $this->get_emails($cid);

    $emailTitle = '素里华人宣道会一家团契';

    if(! mail($siteEmails, $emailTitle, $message, 'admin@surreyonefamil.ca'))
      echo '邮件没有成功发送.';
	  
	$query = "UPDATE contents SET send_email_flag = 'Y' WHERE cid = " . $cid;
	$affected = $this->mdb2->exec($query);
    if (PEAR::isError($affected)) {
      die($affected->getMessage());
    }
    return true;
  }

}

//////////////////////////////////
$cont = new ContentsClass();
if(! $cont->check_access()) {
  $cont->set_breakpoint();
  echo "<script>if(window.opener){window.opener.location.href='".LOGIN."';} else{window.parent.location.href='".LOGIN."';}</script>";exit;
}
$cont->get_table_info();
$cont->set_default_config(array('WYSIWYG'=>true,'dvalidate'=>true,'calender'=>true));

// controller to dispatch the HTTP REQUESTS.
if(isset($_GET['js_search_form'])) {
	$ary = $cont->get_search_form_settings();
	$cont->assign('search_form', $ary);	
	$cont->assign('config', $config);
	$cont->display($config['templs']['search']);
}
elseif(isset($_GET['js_get_record'])) {
	$ret = $cont->get_content_record($_GET['cid']);
	echo json_encode($ret);
}
elseif(isset($_GET['js_edit_form_3'])) {
  $data = array();
  if(!isset($data['self'])) $data['self'] = $cont->self;

  if(isset($_GET['id']))
	$record = $cont->get_record($_GET['id']);
  else
  	$record = array();

  $data['modules'] = $cont->get_modules_array();
  $data['gid'] = $cont->get_groups_array();
  $data['record'] = $record;
  
  $cont->assign('config', $config);
  $cont->assign("data", $data);
  $cont->display($config['templs']['edit_tinymce']);
}
elseif(isset($_GET['js_edit_form_4'])) {
  $data = array();
  if(!isset($data['self'])) $data['self'] = $cont->self;
  if(isset($_GET['id']))
	$record = $cont->get_record($_GET['id']);
  else
  	$record = array();

  $data['contents'] = $cont->get_contents_array();
  $data['record'] = $record;
  if(isset($_GET['id'])) {
	  $data['resources1'] = $cont->get_available_resources($_GET['id']);
	  $data['resources2'] = $cont->get_assigned_resources($_GET['id']);
  }
  $data['modules'] = $cont->get_modules_array();
  $data['groups'] = $cont->get_groups_array();  
  $cont->assign('config', $config);
  $cont->assign("data", $data);
  $cont->display($config['templs']['assign_mc']); //'assign_modules-contents.tpl.html'
}
elseif(isset($_GET['js_edit_form_5'])) {
  $data = array();
  if(!isset($data['self'])) $data['self'] = $cont->self;
  if(isset($_GET['id']))
	$record = $cont->get_record($_GET['id']);
  else
  	$record = array();

  $data['contents'] = $cont->get_contents_array();
  $data['record'] = $record;
  if(isset($_GET['id'])) {
	  $data['resources1'] = $cont->get_available_resources($_GET['id']);
	  $data['resources2'] = $cont->get_assigned_resources($_GET['id']);
  }
  $data['modules'] = $cont->get_modules_array();
  $data['groups'] = $cont->get_groups_array();  
  $cont->assign('config', $config);
  $cont->assign("data", $data);
  $cont->display($config['templs']['assign_rc']); //'assign_resources-contents.tpl.html'
}
elseif(isset($_GET['js_edit_form'])) {
	$ary = $cont->get_edit_form_settings();

	$record = $cont->get_record($_GET['id']);
	$cont->assign('record', $record);	

	if(isset($_GET['tr'])) $cont->assign('form_id', 'ef_'.$_GET['id'].'-'.$_GET['tr']);
	else $cont->assign('form_id', 'ef_'.$_GET['id']);

	$cont->assign('edit_form', $ary);	
	$cont->assign('config', $config);
	$cont->display($config['templs']['edit']);
}
elseif(isset($_GET['js_add_form'])) {
  $data['groups'] = $cont->get_groups_array();
  
  $cont->assign('config', $config);
  $cont->assign("data", $data);
  $cont->display($config['templs']['add_tinymce']); //'add_tinymce.tpl.html'
}
elseif(isset($_REQUEST['js_get_pages'])) {
	$cont->get_pages_options();
}
elseif(isset($_REQUEST['js_get_modules'])) {
	$cont->get_modules_options();
}
elseif(isset($_REQUEST['js_get_submenu'])) {
	$cont->js_get_submenu();
}
elseif(isset($_REQUEST['js_get_groups'])) {
	$cont->get_groups_options();
}
elseif(isset($_REQUEST['js_get_contents_by_mid'])) {
	$cont->get_contents_options_by_mid($_REQUEST['mid']);
}
elseif(isset($_REQUEST['js_get_contents_by_group'])) {
	$cont->get_contents_options_by_group($_REQUEST['mid'], $_REQUEST['group']);
}
elseif(isset($_GET['js_assign_form'])) {
	$data = array();
	$cont->assign('config', $config);
	$cont->assign('data', $data);
	$cont->display($config['templs']['assign_rc']); //'assign_resources-contents.tpl.html'
}
elseif(isset($_POST['js_update'])) {
	$cont->update_contents_resources();
}
elseif(isset($_POST['js_update_modules_contents'])) {
	$cont->update_modules_contents();
}
elseif(isset($_POST['js_edit_column'])) {
	$ret = $cont->update_column(array('updatedby'=>$cont->username));
	echo json_encode($ret);
}
elseif(isset($_REQUEST['action'])) {
	switch($_REQUEST['action']) {
		case 'edit':
		  echo json_encode($cont->edit($cont->username));
			break;
		case 'delete':
			$cont->delete($_GET['id']);
			break;
		case 'add':
			$cont->create(array('username'=>$cont->username));
			break;    
		default:
			break;
	}
}
elseif(isset($_POST['add_submit'])) {
	$ret = $cont->add();
	echo json_encode($ret);
}
elseif(isset($_POST['edit_submit'])) {
	$ret = $cont->edit_wysiwyg_table();
	echo json_encode($ret);
}
else if( isset($_POST['search']) || (isset($_GET['page']) && isset($_GET['sort'])) || isset($_GET['page']) || isset($_GET['js_reload_list']) ) {
	if(isset($_POST['search'])) $cont->parse();

	$data = $cont->list_all();
	$data['options'] = array(VIEW, EDIT, EMAIL, DELETE);
	
	$header = $cont->get_header($cont->get_mappings());

	$pagination = $cont->draw( $data['current_page'], $data['total_pages'] );
	
	$cont->assign('config', $config);
	$cont->assign('header', $header);
	$cont->assign('data', $data);
	$cont->assign("pagination", $pagination);
	$tpl = $cont->get_html_template();
	$cont->display($tpl); // not use display, should use AJAX.
}
elseif(isset($_REQUEST['js_send_mail'])) {
	$cont->send_email($_REQUEST['id']);
}
else {
	if (isset($_SESSION[$cont->self][$cont->session['sql']])) $_SESSION[$cont->self][$cont->session['sql']] = '';

	$total_rows = $cont->get_total_rows($cont->get_count_sql());

	$_SESSION[$cont->self][$cont->session['rows']] = $total_rows < 1 ? 1 : $total_rows;
	
	$data = $cont->list_all();
	$data['options'] = array(VIEW, EDIT, EMAIL, DELETE);
	
	$header = $cont->get_header($cont->get_mappings());

	$pagination = $cont->draw( $data['current_page'], $data['total_pages'] );
	
	$tpl = $cont->get_html_template();

	$cont->assign('config', $config);
	$cont->assign('header', $header);
	$cont->assign('data', $data);
	$cont->assign("pagination", $pagination);

	$cont->assign("template", $tpl);
	$cont->display($config['templs']['main']);
}
?>
