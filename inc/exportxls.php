<?php

include($settings['site_path'] . 'controllers/listController.php');

$sep = "\t";

echo $_REQUEST['ng'];
print("\n");

echo "Network Name \t" . $network['name'];
print("\n");
echo "Network \t" . $network['network'];
print("\n");
echo "Vlan \t" . $network['vlan'];
print("\n");

echo "IP \t Device Name \t Device Type \t Description \t Notes";
print("\n");

foreach($ipaddr as $ip){
	$schema_insert = "";
	
	$schema_insert .= $ip['ipaddress'] . $sep;
	if($ip['devicename'] == ""){
		$schema_insert .= "NULL".$sep;
	}else{
		$schema_insert .= $ip['devicename'] . $sep;
	}
	if($ip['devicetype'] ==""){
		$schema_insert .= "NULL".$sep;
	}else{
		$schema_insert .= $ip['devicetype'] . $sep;
	}
	if($ip['desc'] == ""){
		$schema_insert .= "NULL".$sep;
	}else{
		$schema_insert .= $ip['desc'] . $sep;
	}
	if($ip['notes'] == ""){
		$schema_insert .= "NULL".$sep;
	}else{
		$schema_insert .= $ip['notes']. $sep;
	}
	
	$schema_insert = str_replace($sep."$", "", $schema_insert);
	$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
	$schema_insert .= "\t";
	print(trim($schema_insert));
	print("\n");
		
}


?>