<?php

function friends_widget_name() {
	return "Shows profile contacts";
}
function friends_widget_help() {
	return "";
}

function friends_widget_args(){
	return Array();
}

function friends_widget_content(&$a, $conf){

	$r = q("SELECT `profile`.`uid` AS `profile_uid`, `profile`.* , `user`.* FROM `profile` 
			LEFT JOIN `user` ON `profile`.`uid` = `user`.`uid`
			WHERE `user`.`uid` = %s AND `profile`.`is-default` = 1 LIMIT 1",
			intval($conf['uid'])
	);
	if(!count($r)) return;
	$a->profile = $r[0];

	$o = "";
	$o .= "<style>
		.f9k_widget {font-size: 0.8em;}
		.f9k_widget #contact-block { overflow: hidden; height: auto; }
		.f9k_widget .contact-block-h4 { float: left; margin: 0px; }
		.f9k_widget .allcontact-link { float: right; margin: 0px; }
		.f9k_widget .contact-block-content { clear:both; }
		.f9k_widget .contact-block-div { display: block !important; float: left!important; width: 50px!important; height: 50px!important; margin: 2px!important;}
		
	</style>";
	$o .= _abs_url(contact_block());
	$o .= "<a href='".$a->get_baseurl().'/profile/'.$a->profile['nickname']."'>". t('Connect on Friendika!') ."</a>";
	return $o;
}
