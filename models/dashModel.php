<?php

function getTop($dbh){
	$sql = 'SELECT ipaddress.netid, networks.name, netgroup.name AS ngname, count(*) FROM ipaddress LEFT JOIN networks ON ipaddress.netid=networks.id LEFT JOIN netgroup ON networks.netgroup=netgroup.id GROUP BY ipaddress.netid ORDER BY count(*) DESC LIMIT 10';
	$rows = getTable($dbh,$sql);
	return($rows);
}

function updateStaleStats($dbh){
	$session = session_id();
	$timeout = time();
	$updatesql = 'UPDATE stats SET `time`=? WHERE session=?';
	$data = array($timeout,$session);
	updateRecord($dbh,$updatesql,$data);
	$check = 'SELECT session, (time+1440) AS timeout FROM stats';
	$rows = getTable($dbh,$check);
	foreach($rows as $row){
		if($row['timeout'] < $timeout){
			$sql = 'UPDATE stats SET `online`=? WHERE session=?';
			$data1 = array("0",$row['session']);
			updateRecord($dbh,$sql,$data1);
		}
	}
}

function getLatestLogins($dbh){
	$sql = 'SELECT user,ipaddress FROM stats ORDER BY id DESC LIMIT 5';
	$rows = getTable($dbh,$sql);
	return($rows);
}

function getCurrentStats($dbh){
	$sql = 'SELECT * FROM stats WHERE online=?';
	$rows = getRowCount($dbh,$sql,"1");
	return($rows);
}

function getHistoryStats($dbh){
	$sql = 'SELECT * FROM stats';
	$rows = getRowCount($dbh,$sql,"");
	return($rows);
}
