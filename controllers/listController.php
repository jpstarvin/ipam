<?php

/******************************************
 * Controller for listIP.php view
 ******************************************/
 
include($settings['site_path'] . 'models/dbModel.php');
include($settings['site_path'] . 'models/listIPModel.php');

$netid = $_REQUEST['netid'];

if($_REQUEST['a'] == 'update') {
	$data = array($_POST['ipadd'],$_POST['devname'],$_POST['devtype'],$_POST['desc'],$_POST['notes'],$_POST['netid'],$_POST['id']);
	updateIP($data,$dbh);
}

if($_REQUEST['a'] == 'add') {
	$data = array($_POST['ipadd'],$_POST['devname'],$_POST['devtype'],$_POST['desc'],$_POST['notes'],$_POST['netid']);
	addIP($data,$dbh);
}

if($_REQUEST['a'] == 'delete') {
	$id = $_REQUEST['id'];
	deleteIP($id,$dbh);	
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

if($_REQUEST['m'] == 'modal'){
	$navs=getNav($dbh);
	if($_REQUEST['id'] <> ''){
		$id = $_REQUEST['id'];
		$ip = getIP($id,$dbh);
		$form = "update";
		
	}
	if($_REQUEST['netid'] <> ''){
		$form = "add";
	}
}


?>
