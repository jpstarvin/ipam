<?php

include($settings['site_path'] . 'models/dbModel.php');
include($settings['site_path'] . 'inc/ad_auth/adLDAP.php');
//login processing

if($_REQUEST['a'] == 'login'){
	$username = strtolower($_POST['username']);
	$pass = $_POST['password'];
	
	if($settings['auth_method'] == 'local'){
		$userinfo = getHash($dbh,$username);

		if (crypt($pass,$userinfo['password']) == $userinfo['password']){
			$_SESSION['isLoggedIn'] = 'yes';
			$_SESSION['role'] = $userinfo['role'];
			$_SESSION['username'] = $username;
			updateStats($dbh);
			echo "<script>window.location='?v=dash';</script>";
		}else{
			echo "<script>showNotificationBar('Username or Password Incorrect!!');</script>";
		}	
	}
	elseif($settings['auth_method'] == 'ldap') {
			
		//Sets the domain properties for LDAP auth.
		$options = array(
			'account_suffix' => $settings['ad_domain_suffix'],
			'base_dn' => $settings['ad_base_dn'],
			'domain_controllers' => array($settings['ad_domain_controller']));
		if($settings['ad_user'] <> ''){
			$options['admin_username'] = $settings['ad_user'];
		}
		if($settings['ad_pass'] <> ''){
			$options['admin_password'] = $settings['ad_pass'];
		}
		//adLDAP::__construct($options);
			
		try {
		    $adldap = new adLDAP($options);
		}
        catch (adLDAPException $e) {
            echo $e; 
            exit();   
        }
		
		//authenticate the user
		if ($adldap -> authenticate($username,$pass)){
			//Check and see if the user is in the specified group
			
			if ($result = $adldap->user()->inGroup($username,$settings['ad_admin_group'])) {
				$_SESSION['isLoggedIn'] = 'yes';
				$_SESSION['role'] = 'Administrator';
				$_SESSION['username'] = $username;
				updateStats($dbh);
				echo "<script>window.location='?v=dash';</script>";
			}elseif ($result = $adldap->user()->inGroup($username,$settings['ad_manager_group'])) {
				$_SESSION['isLoggedIn'] = 'yes';
				$_SESSION['role'] = 'Manager';
				$_SESSION['username'] = $username;
				updateStats($dbh);
				echo "<script>window.location='?v=dash';</script>";
			}elseif ($result = $adldap->user()->inGroup($username,$settings['ad_view_group'])) {
				$_SESSION['isLoggedIn'] = 'yes';
				$_SESSION['username'] = $username;
				$_SESSION['role'] = 'View-Only';
				updateStats($dbh);
				echo "<script>window.location='?v=dash';</script>";
			}
		}else{
			echo "<script>showNotificationBar('Username or Password Incorrect!!');</script>";
		}
		
	}
}	
?>
