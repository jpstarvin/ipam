<?php

/******************************************
 * Controller for listIP.php view
 ******************************************/
 
include($settings['site_path'] . 'models/dbModel.php');
include($settings['site_path'] . 'models/listIPModel.php');

$netid = @$_REQUEST['netid'];

switch(@$_REQUEST['a']){
	case 'update':
		$data = array($_POST['ipadd'],$_POST['devname'],$_POST['devtype'],$_POST['desc'],$_POST['notes'],$_POST['netid'],$_POST['assigned'],$_POST['id']);
		updateIP($data,$dbh);
		break;
	case 'add':
		$data = array($_POST['devname'],$_POST['devtype'],$_POST['desc'],$_POST['notes'],$_POST['netid'],$_POST['assigned'],$_POST['ipadd']);
		addIP($data,$dbh);
		break;
	case 'unassign':
		$id = $_REQUEST['id'];
		$data = array("0",$id);
		unassignIP($data,$dbh);
		$network = getNetworks($netid,$dbh);
		$ipaddr = getIPs($netid,$dbh);	
		break;
	case 'search':
		$keyword = $_POST['keyword'];
		$ipaddr = searchIP($keyword,$dbh);	
		break;
	case 'export':
		//Get network information for top of list
		$network = getNetworks($netid,$dbh);
		//Get array of IPs
		$ipaddr = getIPs($netid,$dbh);
		break;
	default:
		//Get network information for top of list
		$network = getNetworks($netid,$dbh);
		//Get array of IPs
		$ipaddr = getIPs($netid,$dbh);
		break;
}

/*
if($_REQUEST['a'] == 'update') {
	$data = array($_POST['ipadd'],$_POST['devname'],$_POST['devtype'],$_POST['desc'],$_POST['notes'],$_POST['netid'],$_POST['assigned'],$_POST['id']);
	updateIP($data,$dbh);
}

if($_REQUEST['a'] == 'add') {
	$data = array($_POST['devname'],$_POST['devtype'],$_POST['desc'],$_POST['notes'],$_POST['netid'],$_POST['assigned'],$_POST['ipadd']);
	addIP($data,$dbh);
}

if($_REQUEST['a'] == 'unassign') {
	$id = $_REQUEST['id'];
	$data = array("0",$id);
	unassignIP($data,$dbh);	
}

if($_REQUEST['a'] == 'search') {
	$keyword = $_POST['keyword'];
	$ipaddr = searchIP($keyword,$dbh);
}else{
	//Get network information for top of list
	$network = getNetworks($netid,$dbh);
	//Get array of IPs
	$ipaddr = getIPs($netid,$dbh);
}
*/
if(@$_REQUEST['m'] == 'modal'){
	//$navs=getNav($dbh);
	if($_REQUEST['id'] <> ''){
		$id = $_REQUEST['id'];
		$ip = getIP($id,$dbh);
		$form = "update";
		
	}
	if($netid <> ''){
		$form = "add";
		$ipaddr = getIPs($netid,$dbh);
	}
}


?>
