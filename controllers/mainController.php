<?php

/*************************************************
 * filename = mainController.php
 * 
 * This file checks, sets, and returns the APC
 * Cache.
 *************************************************/


  
function getView() {
	global $settings;
	
	if($_REQUEST['logout']=='logout'){
		session_start();
	    session_unset();
	    session_destroy();
	    session_write_close();
	}
	
	session_start();
	if ($_SESSION['isLoggedIn'] == 'yes'){
		if($_REQUEST['v']){
			$view = $settings['site_path'] . 'views/' . $_REQUEST['v'] . '.php';
			include($view);
			return;		
		}
		else {
			$view = $settings['site_path'] . 'views/dash.php';
			include($view);
			return;
		}
	}
	else {
		$view = $settings['site_path'] . 'views/login.php';
		include($view);
		return;
	}
}



 ?>