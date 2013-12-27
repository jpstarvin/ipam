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

$qry = $dbh->prepare("INSERT INTO ipaddress (`ipaddress`,`devicename`,`netid`) VALUES (?,?,?)");

 foreach ($output as $res){
        $data = NULL;
        $out = explode(",",$res);
        if (trim($out[1]) == 'Up'){
                $data = array(trim($out[0]));
                if(trim($out[2]) <>''){
                        array_push($data,trim($out[2]));
                }elseif(trim($out[3]) <> ''){
                        array_push($data,trim($out[3]));
                }else{
                        array_push($data,"");
                }
                array_push($data,$netid);
                $qry->execute($data);
        }
 }

 ?>

