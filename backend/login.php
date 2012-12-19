<?php
session_start();

$db = mysql_pconnect('localhost', 'scac', 'ilovejesus');
mysql_select_db('scac', $db);
mysql_query("SET NAMES 'utf8'", $db);

if (isset($_POST['js_check'])) {
	if(check()) echo 'Y';
	else echo 'N';
}
elseif(isset($_GET['logout'])) {
	update_logout_info();
	session_unset();
	session_destroy();
	init();
}
else {
	init();
}
exit;

///////////////////////////////

function init()
{
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="login/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="login/login.css" />
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="login/js/cookie.js"></script>
<script type="text/javascript" src="login/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="login/js/bootstrap.popover.js"></script>
<div id="container" class="container">
  <div class="row">
    <div class="span5 img"> <img src="images/logo.png" /> </div>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="form_id" class="well">
      <fieldset>
      <legend><img src="login/login-icon.png" /><strong>用户注册</strong></legend>
      <div class="control-group">
        <label class="control-label" for="username">用户名：</label>
        <div class="controls">
          <div class="input-prepend"> <span class="add-on"> <i class="icon-user"></i></span>
            <input name="username" id="username" type="text" placeholder="用 户 名" class="input-xlarge" data-content="用户名栏不能为空。" data-original-title="用户名验证" />
          </div>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="password">口令：</label>
        <div class="controls">
          <div class="input-prepend"> <span class="add-on"><i class="icon-lock"></i></span>
            <input name="password" id="password" type="password" placeholder="口 令" class="input-xlarge" data-content="口令栏不能为空。" data-original-title="口令验证"/>
          </div>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <label class="checkbox">
          <input type="checkbox" id="rememberme" name="rememberme">
          记住我的选择！ </label>
        </div>
      </div>
      <div class="control-group">
        <div align="center">
          <button type="submit" class="btn btn-primary">登 录</button>
          <img src="login/loading.gif" width="32" height="32" border="0" style="display:none;" /> </div>
      </div>
      <div class="control-group error">
        <label id="error"></label>
      </div>
      </fieldset>
    </form>
  </div>
</div>
<div class="copyright">Copyright &copy; 2012 <abbr title="基督教素里华人宣道会"> 基督教素里华人宣道会 | Surrey Christian Alliance Church </abbr>. All rights reserved.</div>
<script type="text/javascript">
$(function() {
	var validator = $('#form_id').validate({
		rules: {
			username: "required",
			password: "required"
		},
		messages: {
			username: "",
			password: ""
		},
		
		highlight:function(element, errorClass, validClass) {
		  $(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
		  $(element).parents('.control-group').removeClass('error');
		  $(element).parents('.control-group').addClass('success');
		}
	});

	var form = $('#form_id');
	$('input', form).focus(function() {
		if ($('#error').html().length>0)
			$('#error').empty().parent('div').hide();
	});
	
	form.submit(function(e) {
		e.preventDefault();
		
		if(!validator.element('#username')) {
			$('#username').closest('.control-group').removeClass('success').addClass('error');
			$('#username', '#form_id').popover('show');
			return false;
		}
		if(!validator.element('#password')) {
			$('#password').closest('.control-group').removeClass('success').addClass('error');
			$('#password', '#form_id').popover('show');
			return false;
		}

		$.ajax({
			type: form.attr('method'),
			url: form.attr('action'),
			data: form.serialize() + '&js_check=1',
			beforeSend: function() {
				$('button:submit', form).attr('disabled', true).next('img').fadeIn();
			},
			success: function(succ) {
			alert(succ);
				if(succ == 'Y')
					document.location.href='/scac2/';
				else {
					var msg = "登录信息不正确，请重新输入。";
					$('#error').html(msg).parent('div').fadeIn(100);
				}
				$('button:submit', form).attr('disabled', false).next('img').fadeOut();
			}
		});
		return false;
	});
	
	if( $.cookie("scac[username]") && $.cookie("scac[password]") ) {
		$('#username').val($.cookie("scac[username]"));
		$('#password').val($.cookie("scac[password]"));	
		$('#rememberme').attr('checked', true);
	}
	else {
		$('#rememberme').attr('checked', false);
	}
});
$('input:text, input:password', '#form_id')
.change(function() {
	var t = $(this).val();
	if(/^\s*$/.test(t)) $(this).popover('show');
	else $(this).popover('hide');
})
.hover(function() {
	$(this).popover('show');
});
</script>
<?php
}
	
function check()
{
    $username = strtolower(trim($_POST['username']));
    $password = strtolower($_POST['password']);
    $rememberme = isset($_POST['rememberme']) ? true : false;

	$query = "SELECT * FROM admin_users WHERE username='".mysql_real_escape_string($username)."' AND password='".$password."'";	
	//echo $query;
	$res = mysql_query($query);
	$total = mysql_num_rows($res);
	if ($total>0) {
		$username = ucfirst(strtolower($username));
		if($rememberme) {
			$expire = time() + 1728000; // Expire in 20 days
			setcookie('scac[username]', $username, $expire);
			setcookie('scac[password]', $password, $expire);
		}
		else {
			setcookie('scac[username]', NULL);
			setcookie('scac[password]', NULL);
		}

		$_SESSION['scac']['username'] = ucfirst($username);

		$row = mysql_fetch_assoc($res);
		$_SESSION['scac']['username'] = $username;
		$_SESSION['scac']['userid'] = $row['uid'];
		$_SESSION['scac']['userlevel'] = $row['level'];
		update_login_info($username, $row['uid']);
		return true;
	}
	else {
		if(! $rememberme) {
			setcookie('scac[username]', NULL);
			setcookie('scac[password]', NULL);
		}
	}
    return false;
}

function update_login_info($username, $uid)  
{
	$ip = get_real_ip();
	$browser = $_SERVER["HTTP_USER_AGENT"];
	$session = session_id();
	$query = "insert into login_info(uid,ip,browser,username,session,count,login_time,logout,logout_time, expired)
	  values(".$uid.", '".$ip."', '".$browser."', '".$username."', '".$session."', 1, NULL, 'N', '', NOW() + INTERVAL 10 HOUR)
	  on duplicate key update
	  count = count+1,
	  login_time = NULL,
	  expired = NOW() + INTERVAL 10 HOUR,
	  session = '".$session."', 
	  logout='N',
	  logout_time=''";
	  //echo $query;
	$affected = mysql_query($query);
}

function update_logout_info() {
	$query = "update login_info set logout='Y', logout_time=NULL, session=NULL where session='".session_id()."'";
	$affected = mysql_query($query);
}

function get_real_ip() {
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	  $ip=$_SERVER['HTTP_CLIENT_IP'];
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	else
	  $ip=$_SERVER['REMOTE_ADDR'];
	return $ip;
}

?>
