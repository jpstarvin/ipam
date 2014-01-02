<?php

/******************************************
 * Controller for admin.php view
 ******************************************/
 
include($settings['site_path'] . 'models/dbModel.php');
include($settings['site_path'] . 'models/adminModel.php');

$manage = $_REQUEST['m'];

if($_REQUEST['a'] <> ''){
	$form = $_REQUEST['a'];
}
else{
	$form = 'add';
}

if (isset($_REQUEST['id'])){
	$id = $_REQUEST['id'];
}

if ($_REQUEST['notif'] == 1){
	echo "<script>showNotificationBar('The scan has been started.',3000,'#99FF99','#003300');</script>";
}
if ($manage == 'netgroup'){
	$netgroups = getNetgroups($dbh);
	if ($form == 'update'){
		$netgroup = getNetgroup($id,$dbh);
		if ($_POST['id'] <> ''){
			$data = array($_POST['name'],$_POST['desc'],$id);
			updateNetgroup($data,$dbh);
			echo "<script> window.location = \"?v=admin&m=netgroup\";</script>";
		}
	}
	elseif ($form == 'delete'){
		deleteNetgroup($id,$dbh);
		echo "<script> window.location = \"?v=admin&m=netgroup\";</script>";
	}	
	elseif ($form == 'add'){
		if($_POST['name'] <> '') {
			$data = array($_POST['name'],$_POST['desc']);
			addNetgroup($data,$dbh);
			echo "<script> window.location = \"?v=admin&m=netgroup\";</script>";
		}
	}
	
}elseif ($manage == 'network'){
	$netgroups = getNetgroups($dbh);
	$networks = getNav($dbh);
	if ($form == 'update'){
		$net = getNet($id,$dbh);
		if ($_POST['id'] <> ''){
			$data = array($_POST['netgroup'],$_POST['name'],$_POST['network'],$_POST['exclusion'],$_POST['snmp'],$id);
			updateNetwork($data,$dbh);
			echo "<script> window.location = \"?v=admin&m=network\";</script>";
		}
	}
	elseif ($form == 'delete'){
		deleteNetwork($id,$dbh);
		echo "<script> window.location = \"?v=admin&m=network\";</script>";
	}	
	elseif ($form == 'add'){
		if($_POST['name'] <> ''){
			$data = array($_POST['netgroup'],$_POST['name'],$_POST['network'],$_POST['exclusion'],$_POST['snmp']);
			addNetwork($data,$dbh);
			echo "<script> window.location = \"?v=admin&m=network\";</script>";
		}
	}
	elseif ($form == 'scan'){
		$net = getNet($id,$dbh);
		if($net['exclusion_list'] == ""){
			$ex = "none";
		}else{$ex = $net['exclusion_list'];}
		if($net['snmp'] == ""){
			$snmp = "none";
		}else{$snmp = $net['snmp'];}
		$command = "php " . $settings['site_path'] ."inc/scan.php " . $net['network'] . " " . $ex . " " . $snmp . " " . $net['id'] . " > /dev/null 2>&1 & echo $!";
		exec($command);
		echo "<script> window.location = \"?v=admin&m=network&notif=1\";</script>";
	}
}elseif ($manage == 'users'){
	$users = getUsers($dbh);
	if ($form == 'update'){
		$user = getUser($id,$dbh);
		if ($_POST['id'] <> ''){
			$data = array(strtolower($_POST['username']),$_POST['fname'],$_POST['lname'],$_POST['role'],$id);
			$pass = $_POST['password'];
			updateUser($data,$pass,$dbh);
			echo "<script> window.location = \"?v=admin&m=users\";</script>";
		}
	}
	elseif ($form == 'delete'){
		deleteUser($id,$dbh);
		echo "<script> window.location = \"?v=admin&m=users\";</script>";
	}	
	elseif ($form == 'add'){
		if($_POST['username'] <> ''){
			$data = array($_POST['username'],$_POST['fname'],$_POST['lname'],$_POST['role']);
			$pass = $_POST['password'];
			addUser($data,$pass,$dbh);
			echo "<script> window.location = \"?v=admin&m=users\";</script>";
		}
	}
	
}elseif ($manage == 'site'){
	if ($_POST['sname']<>''){
		$result = updateConfigFile($_POST);
		if (! file_put_contents($settings['site_path'] . 'config.php', $result)){
			echo "Unable to write file";
		}
		echo "<script> window.location = \"?v=admin&m=site\";</script>";
	}
}


?>
