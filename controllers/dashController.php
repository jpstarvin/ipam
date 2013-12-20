<?php

include($settings['site_path'] . 'models/dbModel.php');
include($settings['site_path'] . 'models/dashModel.php');

$nets = getNets($dbh);

$ipcount = array();
foreach ($nets as $net){
	$ipcount[$net['id']] = getIPCount($dbh,$net['id']);
}

updateStaleStats($dbh);
$latest = getLatestLogins($dbh);

$current = getCurrentStats($dbh);
$total = getHistoryStats($dbh);

?>
