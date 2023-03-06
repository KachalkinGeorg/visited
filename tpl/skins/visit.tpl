<link href="{{ admin_url }}/plugins/visited/tpl/skins/css/style.css" type="text/css" rel="stylesheet"/>
<a onclick="show_alert(this)" tabindex="-1"> открыть</a> 
	<div class="modal">
	<div class="modal-close" onclick="this.parentNode.style.display='none';"><i class="fa fa-times-circle fa-2x" aria-hidden="true"></i></div>
	<div style="text-align: center;">Нас сегодня посетили</div>
	{{visit}}
	</div>
