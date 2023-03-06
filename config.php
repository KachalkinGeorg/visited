<?php

if (!defined('NGCMS')) die ('HAL');

pluginsLoadConfig();
LoadPluginLang('visited', 'config', '', '', '#');

switch ($_REQUEST['action']) {
	case 'about':			about();		break;
	default: main();
}

function about()
{global $twig, $lang, $breadcrumb;
	$tpath = locatePluginTemplates(array('main', 'about'), 'visited', 1);
	$breadcrumb = breadcrumb('<i class="fa fa-user btn-position"></i><span class="text-semibold">'.$lang['visited']['visited'].'</span>', array('?mod=extras' => '<i class="fa fa-puzzle-piece btn-position"></i>'.$lang['extras'].'', '?mod=extra-config&plugin=visited' => '<i class="fa fa-user btn-position"></i>'.$lang['visited']['visited'].'',  '<i class="fa fa-exclamation-circle btn-position"></i>'.$lang['visited']['about'].'' ) );

	$xt = $twig->loadTemplate($tpath['about'].'about.tpl');
	$tVars = array();
	$xg = $twig->loadTemplate($tpath['main'].'main.tpl');
	
	$about = 'версия 0.1';
	
	$tVars = array(
		'global' => 'О плагине',
		'header' => $about,
		'entries' => $xt->render($tVars)
	);
	
	print $xg->render($tVars);
}

function main()
{global $twig, $lang, $breadcrumb;
	
	$tpath = locatePluginTemplates(array('main', 'general.from'), 'visited', 1);
	$breadcrumb = breadcrumb('<i class="fa fa-user btn-position"></i><span class="text-semibold">'.$lang['visited']['visited'].'</span>', array('?mod=extras' => '<i class="fa fa-puzzle-piece btn-position"></i>'.$lang['extras'].'', '?mod=extra-config&plugin=visited' => '<i class="fa fa-user btn-position"></i>'.$lang['visited']['visited'].'' ) );

	if (isset($_REQUEST['submit'])){
		pluginSetVariable('visited', 'limit', intval($_REQUEST['limit']));
		pluginSetVariable('visited', 'localsource', (int)$_REQUEST['localsource']);
		pluginsSaveConfig();
		msg(array("type" => "info", "info" => "сохранение прошло успешно"));
		return print_msg( 'info', ''.$lang['visited']['visited'].'', 'Cохранение прошло успешно', 'javascript:history.go(-1)' );
	}
	
	$limit = pluginGetVariable('visited', 'limit');

	$xt = $twig->loadTemplate($tpath['general.from'].'general.from.tpl');
	$xg = $twig->loadTemplate($tpath['main'].'main.tpl');
	
	$tVars = array(
		'limit' => $limit,
		'localsource'       => MakeDropDown(array(0 => 'Шаблон сайта', 1 => 'Плагина'), 'localsource', (int)pluginGetVariable('visited', 'localsource')),
	);
	
	$tVars = array(
		'global' => 'Общие',
		'header' => '<i class="fa fa-exclamation-circle"></i> <a href="?mod=extra-config&plugin=visited&action=about">'.$lang['visited']['about'].'</a>',
		'entries' => $xt->render($tVars)
	);
	
	print $xg->render($tVars);
}

?>