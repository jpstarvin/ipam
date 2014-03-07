<?php
require('config.php');
include($settings['site_path'] . 'controllers/listController.php');


header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=export.csv");
header("Pragma: no-cache");
header("Expires: 0");

$sep = ",";

echo $_REQUEST['ng'];
print("\n");

echo "Network Name," . $network['name'];
print("\n");
echo "Network ," . $network['network'];
print("\n");
echo "Vlan ," . $network['vlan'];
print("\n\n");

echo "IP, Device Name, Device Type, Description, Notes";
print("\n");

foreach($ipaddr as $ip){
	$schema_insert = "";
	
	$schema_insert .= $ip['ipaddress'] . $sep;
	if($ip['devicename'] == ""){
		$schema_insert .= "".$sep;
	}else{
		$schema_insert .= $ip['devicename'] . $sep;
	}
	if($ip['devicetype'] ==""){
		$schema_insert .= "".$sep;
	}else{
		$schema_insert .= $ip['devicetype'] . $sep;
	}
	if($ip['desc'] == ""){
		$schema_insert .= "".$sep;
	}else{
		$schema_insert .= $ip['desc'] . $sep;
	}
	if($ip['notes'] == ""){
		$schema_insert .= "".$sep;
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