<?php


if(!defined('NGCMS')) exit('HAL');

add_act('index', 'plugin_visited');

function plugin_visited() {
	global $lang, $template, $mysql, $twig;

	$group_style[1] = 'style="color: rgb(210 27 27);" class="vizited"';
	$group_style[2] = 'style="color: #2c2c2c;" class="vizited"';
	$group_style[3] = 'style="color: #2c2c2c;" class="vizited"';
	$group_style[4] = 'style="color: rgb(7 216 34);" class="vizited"';
	$group_style[5] = 'style="color: #2c2c2c;" class="vizited"';
	$group_style[6] = 'style="color: #2c2c2c;" class="vizited"';
	$group_style[7] = 'style="color: #2c2c2c;" class="vizited"';
	$group_style[8] = 'style="color: #2c2c2c;" class="vizited"';
	$group_style[9] = 'style="color: #2c2c2c;" class="vizited"';
  
	$lim = pluginGetVariable('visited', 'limit');
	$limit = $lim ? $lim : 5;
	$today = mktime(0,0,0,date('m'),date('d'),date('Y'));
  
	$query = 'SELECT * FROM '.uprefix.'_users WHERE last < '. $today.' ORDER BY last DESC LIMIT '. $limit.'';
	$users = $mysql->select($query);
	
	foreach ($users as $row) {
		$userAvatar = userGetAvatar($row);
		$id = $row['id'];
		$visited .= '<a href="/users/'.urlencode($row['name']).'.html" '.$group_style[$row['status']].' target=_blank/><img src="'.$userAvatar[1].'" style="margin: 5px; border: 0px;" alt=""/><br/>'.$row['name'].'</a> ';
	}
   
	$tpath = locatePluginTemplates(array('skins/visit'), 'visited', pluginGetVariable('visited', 'localsource'));
	$xt = $twig->loadTemplate($tpath['skins/visit'].'skins/visit.tpl');
	
	$tVars = array(
		'visit' 	=> $visited,
		'id' 	=> $id,
		'css'       => $tpath['url::'],
	);
	
	$template['vars']['visited'] = $xt->render($tVars);
}

?>