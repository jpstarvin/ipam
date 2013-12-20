<?php

/**********************************
 * Model for listIP.php view
 **********************************/

 
//Get the network information for page.
function getNetworks($id,$dbh) {
	$sql = 'SELECT * FROM networks WHERE id=?';
	$rows = getSingleRow($dbh,$sql,$id);
	return($rows);	
}
  
//Get IPS
function getIPs($id,$dbh){
	$sql = 'SELECT * FROM ipaddress WHERE netid=?';
	$rows = getRows($dbh,$sql,$id);
	return ($rows);
}

//Get single IP
function getIP($id,$dbh){
	$sql = 'SELECT * FROM ipaddress WHERE id=?';
	$rows = getSingleRow($dbh,$sql,$id);
	return ($rows);
}

function updateIP($data,$dbh){
	$sql = 'UPDATE ipaddress SET `ipaddress`=?,`devicename`=?,`devicetype`=?,`desc`=?,`notes`=?,`netid`=? WHERE `id`=?';
	updateRecord($dbh,$sql,$data);
}

function addIP($data,$dbh){
	$sql = 'INSERT INTO ipaddress(`ipaddress`,`devicename`,`devicetype`,`desc`,`notes`,`netid`) VALUES (?,?,?,?,?,?)';
	addRecord($dbh,$sql,$data);
}

function deleteIP($id,$dbh){
	$sql = 'DELETE FROM ipaddress WHERE id=?';
	deleteRecord($dbh,$sql,$id);
}

function searchIP($key,$dbh){
	$sql = 'SELECT * FROM ipaddress WHERE `ipaddress` LIKE :key OR `devicename` LIKE :key OR `devicetype` LIKE :key OR `desc` LIKE :key OR `notes` LIKE :key';
	$rows = searchKeyword($dbh,$sql,$key);
	return($rows);
}
?>
