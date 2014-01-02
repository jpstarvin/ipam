<?php
/****************************************
 * Model for all admin functions
 ****************************************/

function getNetgroups($dbh){
	$sql = 'SELECT * FROM netgroup';
	$rows = getTable($dbh,$sql);
	return($rows);
}

function getUsers($dbh){
	$sql = 'SELECT * FROM users';
	$rows = getTable($dbh,$sql);
	return($rows);
}

function getNet($id,$dbh){
	$sql = 'SELECT * FROM networks WHERE `id`=?';
	$rows = getSingleRow($dbh,$sql,$id);
	return($rows);
}

function getNetgroup($id,$dbh){
	$sql = 'SELECT * FROM netgroup WHERE `id`=?';
	$rows = getSingleRow($dbh,$sql,$id);
	return($rows);
}

function getUser($id,$dbh){
	$sql = 'SELECT * FROM users WHERE `id`=?';
	$rows = getSingleRow($dbh,$sql,$id);
	return($rows);
}

function addNetwork($data,$dbh){
	$sql = 'INSERT INTO networks (`netgroup`,`name`,`network`,`exclusion_list`,`snmp`) VALUES (?,?,?,?,?)';
	addRecord($dbh,$sql,$data);

}

function updateNetwork($data,$dbh){
	$sql = 'UPDATE networks SET `netgroup`=?,`name`=?,`network`=?,`exclusion_list`=?,`snmp`=? WHERE id=?';
	updateRecord($dbh,$sql,$data);
}

function deleteNetwork($id,$dbh){
        $delip = 'DELETE FROM ipaddress WHERE netid=?';
        $sql = 'DELETE FROM networks WHERE `id`=?';
        deleteRecord($dbh,$delip,$id);
        deleteRecord($dbh,$sql,$id);
}

function addNetgroup($data,$dbh){
	$sql = 'INSERT INTO netgroup (`name`,`desc`) VALUES (?,?)';
	addRecord($dbh,$sql,$data);
}

function updateNetgroup($data,$dbh){
	$sql = 'UPDATE netgroup SET `name`=?,`desc`=? WHERE id=?';
	updateRecord($dbh,$sql,$data);
}

function deleteNetgroup($id,$dbh){
	$sql = 'DELETE FROM netgroup WHERE id=?';
	deleteRecord($dbh,$sql,$id);
}

function addUser($data,$pass,$dbh){	
	$pass = saltPass($pass);
	$sql = 'INSERT INTO users (`username`,`fname`,`lname`,`role`,`password`) VALUES(?,?,?,?,?)';
	array_push($data,$pass);
	addRecord($dbh,$sql,$data);	
}

function updateUser($data,$pass,$dbh){
	if($pass <> ''){
		$pass = saltPass($pass);	
		$sql = 'UPDATE users SET `password`=?,`username`=?,`fname`=?,`lname`=?,`role`=? WHERE id=?';
		array_unshift($data,$pass);
	
	}else{
		$sql = 'UPDATE users SET `username`=?,`fname`=?,`lname`=?,`role`=? WHERE id=?';
	}
	updateRecord($dbh,$sql,$data);
}

function deleteUser($id,$dbh){
	$sql = 'DELETE FROM users WHERE id=?';
	deleteRecord($dbh,$sql,$id);
}

//Create password salt for database storage
function saltPass($password){
	$cost = 10;

	// Create a random salt
	$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
	
	// Prefix information about the hash so PHP knows how to verify it later.
	// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
	$salt = sprintf("$2a$%02d$", $cost) . $salt;

		
	// Hash the password with the salt
	$hash = crypt($password, $salt);
	
	return($hash);
}

//Prepare and update config.php
function updateConfigFile($data){
	$config_contents='<?php

/************************************************************
 * filename = config.php
 * 
 * This file contains the global site settings not stored in
 * the database. These settings are loaded into APC Cache.
 ************************************************************/
 
 //General Settings
 $settings[\'site_name\'] = "' . $data['sname'] . '";
 $settings[\'site_title\'] = "' . $data['stitle'] . '";
 $settings[\'site_path\'] = "' . $data['spath'] . '";
 $settings[\'logo\'] =  "' . $data['slogo'] . '"; //image should be within 80px X 140px
 
 //Database settings
 $settings[\'dbhost\'] = "' . $data['dbhost'] . '";
 $settings[\'dbname\'] = "' . $data['dbname'] . '";
 $settings[\'dbuser\'] = "' . $data['dbuser'] . '";
 $settings[\'dbpass\'] = "' . $data['dbpass'] . '";

 //Authentication settings
 
$settings[\'auth_method\'] = "' . $data['auth_method'] . '";
//AD Specific settings
$settings[\'ad_domain_controller\'] = "' . $data['addc'] . '";
$settings[\'ad_domain_suffix\'] = "' . $data['dsuffix'] . '";
$settings[\'ad_base_dn\'] = "' . $data['bdn'] . '";
$settings[\'ad_user\'] = "' . $data['ldapuser'] . '";
$settings[\'ad_pass\'] = "' . $data['ldappass'] . '";
$settings[\'ad_admin_group\'] = "' . $data['adadmin'] . '";
$settings[\'ad_manager_group\'] = "' . $data['admanage'] . '";
$settings[\'ad_view_group\'] = "' . $data['adview'] . '";
?>';

return($config_contents);
}
?>
