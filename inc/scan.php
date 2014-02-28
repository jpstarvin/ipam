<?php

/*******************************************
 * This script starts the network scan
 * in the background.
 *******************************************/
 include('/var/www/html/ipam/config.php');
 include('/var/www/html/ipam/models/dbModel.php');
 
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

$qry = $dbh->prepare("INSERT INTO ipaddress (`ipaddress`,`devicename`,`netid`,`used`) VALUES (?,?,?,?)");
$qry2 = $dbh->prepare("UPDATE ipaddress SET `devicename`=?, `used`=? WHERE ipaddress=? AND netid=?");
$getqry = $dbh->prepare("SELECT ipaddress FROM ipaddress WHERE netid=?");
$getqry->execute(array($netid));
$ips = $getqry->fetchAll(PDO::FETCH_ASSOC);

foreach ($output as $res){
 	$data = NULL;
	$out = explode(",",$res);
	$update = "0";
	if (trim($out[1]) == 'Up'){
		foreach ($ips as $ip){
			if(trim($ip['ipaddress']) == trim($out[0])){
				$update = "1";
			}
		}
		if ($update == "1"){
			echo "update " . $out[0] . "\n";
			if(trim($out[2]) <>''){
				$data = array(trim($out[2]));
          	}elseif(trim($out[3]) <> ''){
            	$data=array(trim($out[3]));
            }else{
	        	$data= array("");
        	}
			array_push($data,trim($out[0]));
			array_push($data,$netid);
			array_push($data,1);
			print_r($data);
			$qry2->execute($data);
		}else{
			echo "insert " . $out[0] . "\n";
			$data = array(trim($out[0]));
			if(trim($out[2]) <>''){
                       		array_push($data,trim($out[2]));
                	}elseif(trim($out[3]) <> ''){
                       		array_push($data,trim($out[3]));
               		}else{
                       		array_push($data,"");
                	}
			array_push($data,$netid);
			array_push($data,1);
			print_r($data);
			$qry->execute($data);
		}
	}else{
		$data = array(trim($out[0]));
		array_push($data,"");
		array_push($data,$netid);
		array_push($data,0);
		print_r($data);
		$qry->execute($data);
	}
}

 ?>
