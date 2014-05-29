<?php

include($settings['site_path'] . 'models/dbModel.php');
include($settings['site_path'] . 'models/dashModel.php');

if($settings['new'] <> 1){
	$top = getTop($dbh);
}

updateStaleStats($dbh);
$latest = getLatestLogins($dbh);

$current = getCurrentStats($dbh);
$total = getHistoryStats($dbh);

?>
