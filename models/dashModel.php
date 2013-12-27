<?php

function getTop($dbh){
        $sql = 'SELECT ipaddress.netid, networks.name, count(*) FROM ipaddress LEFT JOIN networks ON ipaddress.netid=networks.id GROUP BY ipaddress.netid ORDER BY count(*) DESC LIMIT 10';
        $rows = getTable($dbh,$sql);
        return($rows);
}

function updateStaleStats($dbh){
	$timeout = 1440;
	$sql = 'UPDATE stats SET `online`="0" WHERE time<?';
	updateRecord($dbh,$sql,$timeout);
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
