<?php

/*******************************************
 * This script starts the network scan
 * in the background.
 *******************************************/
 include('/var/www/ipam/config.php');
 include('/var/www/ipam/models/dbModel.php');
 
 $network = $argv[1];
 $exclusion = $argv[2];
 $snmp = $argv[3];
 $netid = $argv[4];
 
 $cmd = "-n " . $network;
 if($exclusion <> "none"){
 	$cmd .= " -x " . $exclusion;
 }
 if($snmp <> "none"){
 	$cmd .= " -s " . $snmp;
 }
 
 $str=exec("python inc/scan.py $cmd",$output,$ret_code);
 
 foreach ($output as $res){
 	$out = explode(",",$res);
	$sql = 'INSERT INTO ipaddress (';
	if (trim($out[1]) == 'Up'){
		$sql .= '`ipaddress`';
		$values = ' VALUES (?';
		$data = array(trim($out[0]));
		if(trim($out[2]) <>''){
			$sql .= ',`devicename`';
			$values .= ',?';
			array_push($data,trim($out[2]));
		}elseif(trim($out[3]) <> ''){
			$sql .= ',`devicename`';
			$values .= ',?';
			array_push($data,trim($out[3]));
		}
		$sql .= ',`netid`) ' . $values . ',?)';
		array_push($data,$netid);
		print_r($data);
		echo $sql;
		addRecord($dbh,$sql,$data);
		
	}
 }

 ?>
