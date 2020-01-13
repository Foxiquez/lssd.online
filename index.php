<?php session_start();
$config_site = array (
	'sub_url' => $_SERVER['REQUEST_URI'],
	'full_url' => "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
	'exist_url' => 'ls-sd.online',
	'pre_exist_url' => 'ls-sd.online',
	'replay_email_admin' => 'godworld46@mail.com'
);

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './forum/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
include($phpbb_root_path . '/includes/functions_user.php');
include($phpbb_root_path . "/includes/functions_posting.php");
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);
$user->session_begin();
$auth->acl($user->data);
$user->setup();
$request->enable_super_globals();

if (isset($_GET['changemenuview']) and group_memberships(27,$user->data['user_id'],true)) {
	if ($_SESSION["mcp-menu-view"] == true){
		$_SESSION["mcp-menu-view"] = false;
	}
	else {
		$_SESSION["mcp-menu-view"] = true;
	}
}


echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/head.html'));

echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/overall-header.html'));

if ($user->data['user_id'] != ANONYMOUS and (group_memberships(27,$user->data['user_id'],true))) {
	if ($_SESSION["mcp-menu-view"] == false){
		$tmp = str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/overall-header__nav-first.html'));
		$tmp = str_replace('<TYPE-MENU>', '#head', $tmp);
		$tmp = str_replace('<TYPE-MENU-IF>', 'onclick="Menu();"', $tmp);
		echo str_replace('<TYPE-MENU-TEXT>', $user->data['username'], $tmp);

		$tmp = str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/overlay-nav__first.html'));
		$tmp = str_replace('<TYPE-MENU>', '#head', $tmp);
		$tmp = str_replace('<TYPE-MENU-IF>', 'onclick="Menu();"', $tmp);
		echo str_replace('<TYPE-MENU-TEXT>', $user->data['username'], $tmp);
	}
	else {
		$tmp = str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/overall-header__nav-second.html'));
		echo  str_replace('<TYPE-MENU>', '#head', $tmp);

		$tmp = str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/overlay-nav__second.html'));
		echo str_replace('<TYPE-MENU>', '#head', $tmp);
	}
}
else {
	$tmp = str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/overall-header__nav-first.html'));
	$tmp = str_replace('<TYPE-MENU>', 'login', $tmp);
	$tmp = str_replace('<TYPE-MENU-IF>', 'onclick="Menu();"', $tmp);
	echo str_replace('<TYPE-MENU-TEXT>', "Вход", $tmp);

	$tmp = str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/overlay-nav__first.html'));
	$tmp = str_replace('<TYPE-MENU>', 'login', $tmp);
	$tmp = str_replace('<TYPE-MENU-IF>', 'onclick="Menu();"', $tmp);
	echo str_replace('<TYPE-MENU-TEXT>', "Вход", $tmp);
}
unset($tmp);

if ($config_site['sub_url'] == '/aboutus') {
	echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/description.html'));
}
else if ($config_site['sub_url'] == '/detectives') {
	echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/det.html'));
}
else if ($config_site['sub_url'] == '/seb') {
	echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/seb.html'));
}
else if ($config_site['sub_url'] == '/org-chart') {
	echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/chart.html'));
}
else if ($config_site['sub_url'] == '/dispatch' and group_memberships(5,$user->data['user_id'],true)) {
	echo str_replace('<USERNAME>', $user->data['username'], file_get_contents('sources/pages/dispatch.html'));
}
else if (isset($_GET['form']) and group_memberships(27,$user->data['user_id'],true)) {
	if ($_GET['form'] == 'folder' and group_memberships(56,$user->data['user_id'],true)) {
		echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/generator-folder.html'));
	}
	elseif ($_GET['form'] == 'gdb') {
		echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/generator-gdb.html'));
	}
	elseif ($_GET['form'] == 'dm') {
		echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/generator-dm.html'));
	}
	elseif ($_GET['form'] == 'ar') {
		echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/generator-ar.html'));
	}
	elseif ($_GET['form'] == 'to') {
		echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/generator-to.html'));
	}
	elseif ($_GET['form'] == 'wd') {
		echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/generator-wd.html'));
	}
	elseif ($_GET['form'] == 'rwd') {
		echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/generator-rwd.html'));
	}
}
else if (isset($_GET['post']) and group_memberships(27,$user->data['user_id'],true)) {
	$subject	= $_POST['topic-title'];
	$text		= $_POST['topic-text'];

	$poll = $uid = $bitfield = $options = '';

	generate_text_for_storage($subject, $uid, $bitfield, $options, false, false, false);
	generate_text_for_storage($text, $uid, $bitfield, $options, true, true, true);

	$data = array( 
		'forum_id'			=> 0,
		'topic_id'			=> 0,
		'icon_id'			=> false,		 
		'enable_bbcode'		=> true,
		'enable_smilies'	=> true,
		'enable_urls'		=> true,
		'enable_sig'		=> true,
					 
		'message'			=> $text,
		'message_md5'		=> md5($text),
									
		'bbcode_bitfield'	=> $bitfield,
		'bbcode_uid'		=> $uid,
					 
		'post_edit_locked'	=> 0,
		'topic_title'		=> $subject,
		'notify_set'		=> false,
		'notify'			=> false,
		'post_time' 		=> 0,
		'forum_name'		=> '',
		'enable_indexing'	=> true,
	);

	if ($_GET['post'] == 'folder' and group_memberships(56,$user->data['user_id'],true)) {
		$data['forum_id'] = 125;
		$mode = 'post';
		$result = true;
	}
	elseif ($_GET['post'] == 'gdb') {
		$data['forum_id'] = 31;
		$mode = 'post';
		$result = true;
	}
	elseif ($_GET['post'] == 'ar') {
		$data['forum_id'] = 31;
		$data['topic_id'] = $subject;
		$data['topic_title'] = '';
		$mode = 'reply';
		$result = true;
	}
	elseif ($_GET['post'] == 'to') {
		$data['forum_id'] = 31;
		$data['topic_id'] = $subject;
		$data['topic_title'] = '';
		$mode = 'reply';
		$result = true;
	}
	elseif ($_GET['post'] == 'wd') {
		$data['forum_id'] = 32;
		$mode = 'post';
		$result = true;
	}
	elseif ($_GET['post'] == 'rwd') {
		$data['forum_id'] = 32;
		$data['topic_id'] = $subject;
		$data['topic_title'] = '';
		$mode = 'reply';
		$result = true;
	}
	elseif ($_GET['post'] == 'dm') {
		$data['forum_id'] = 59;
		$mode = 'post';
		$result = true;
	}


	if ($result == true) {
		if ($mode == "post") $title = $subject; else $title = '';
	 	$result = submit_post($mode, $title, '', POST_NORMAL, $poll, $data);
		echo '<script>var loc = "'. $result .'"; loc = loc.replace("&amp;t","&t"); window.location.href = loc;</script>';
	}
	else {
		echo '<script>window.location.href = "http://ls-sd.online";</script>';
	}
}
else if ($config_site['sub_url'] == '/database' and group_memberships(27,$user->data['user_id'],true)) {
	echo '<link href="./sources/css/db.css" rel="stylesheet">'."\n".'<section class="database">';
	$tmp = '
		<a href="<URL>">
			<div class="black-btn">
				<div class="btn-wrap">
					<p class="btn-text"><i class="fa fa-angle-left"></i> <TEXT> <i class="fa fa-angle-right"></i></p>
				</div>
			</div>
		</a>
		';
	if (group_memberships(56,$user->data['user_id'],true)) {
		$echo = str_replace('<TEXT>', "Генератор фолдера IID", $tmp);
		echo str_replace('<URL>', "/generate?form=folder", $echo);
	}
	$echo = str_replace('<TEXT>', "Генератор личного дела в Department Members", $tmp);
	echo str_replace('<URL>', "/generate?form=dm", $echo);

	$echo = str_replace('<TEXT>', "Генератор General Database", $tmp);
	echo str_replace('<URL>', "/generate?form=gdb", $echo);

	$echo = str_replace('<TEXT>', "Генератор Arrest Record", $tmp);
	echo str_replace('<URL>', "/generate?form=ar", $echo);

	$echo = str_replace('<TEXT>', "Генератор Traffic Offender", $tmp);
	echo str_replace('<URL>', "/generate?form=to", $echo);

	$echo = str_replace('<TEXT>', "Генератор Wanted Database", $tmp);
	echo str_replace('<URL>', "/generate?form=wd", $echo);

	$echo = str_replace('<TEXT>', "Генератор Responses to the Wanted", $tmp);
	echo str_replace('<URL>', "/generate?form=rwd", $echo);

	echo "\n".'</section>';
}
else {
	echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/main-page.html'));
	unset($_SESSION['tmp-first-time']);
	if (!isset($_SESSION['tmp-first-time'])) {
		$_SESSION['tmp-first-time'] = true;
		echo "\n".'<script>
		window.onload = function() {
		header = document.getElementById("header").clientHeight + document.getElementsByClassName("menu")[0].clientHeight;
		$("body,html").animate({scrollTop: header}, 1);
		}
	</script>'."\n";
	}
}

echo str_replace('<DOMAIN-NAME>', $config_site['exist_url'], file_get_contents('sources/pages/overall-footer.html'));

?>