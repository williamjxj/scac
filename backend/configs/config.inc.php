<?php
$config = array(
	'debug' => true,
	'path' => SITEROOT,
	'smarty' => SITEROOT.'/configs/smarty.ini',
	'layout' => array(
		'header' => 'header.tpl.html',  
		'title' => 'title.tpl.html',
		'navigator' => 'left.tpl.html',
		'footer' => 'footer.tpl.html',
		'include' => 'include.tpl.html',
		'main' => 'main.tpl.html',
	),
	'header' => array(
		'title' => 'Surrey Christian Alliance Church,基督教素里华人宣道会',
		'description' => 'Surrey Christian Alliance Church,基督教素里华人宣道会',
		'keywords' => 'Surrey Christian Alliance Church,基督教素里华人宣道会',
		'meta_content' => 'text/html; charset=utf-8',
		'meta_defaultrobots' => 'index,follow',
		'meta_robots' => '',
	),
	'dcn' => 2,
	'calender' => true,
	'qtip' => true,
	'list' => get_list_defs(),
	'templs' => get_templs(),
);

function get_templs($default_path='') {
	if($default_path && (!empty($default_path)))
		$path = $default_path.'/templates/';
	else
		$path = SITEROOT.'/templates/';
	return array(
		'index' => $path.'index.tpl.html',
		'layout' => $path.'layout.tpl.html',
		'header' => $path.'header.tpl.html',
		'left' => $path.'left.tpl.html',
		'main' => $path.'main.tpl.html',
		'list' => $path.'list.tpl.html',
		'search' => $path.'search.tpl.html',
		'add' => $path.'add.tpl.html',
		'edit' => $path.'edit.tpl.html',
		'add_plupload' => $path.'add_plupload.tpl.html',
		'add_tinymce' => $path.'add_tinymce.tpl.html',
		'edit_tinymce' => $path.'edit_tinymce.tpl.html',
		'assign' => $path.'assign.tpl.html',
		'assign_cr' => $path.'assign_contents-resources.tpl.html',
		'assign_rc' => $path.'assign_resources-contents.tpl.html',
		'assign_cm' => $path.'assign_pages-modules.tpl.html',
		'assign_mc' => $path.'assign_modules-contents.tpl.html',
		'resources' => $path.'resources.tpl.html',
		'pension_form' => $path.'pension_form.tpl.html',
		'calculator' => $path.'calculator.tpl.html',
	);
}

$timezone = "America/Vancouver";

if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
