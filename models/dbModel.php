<?php

/***********************************
 * Database connections
 ***********************************/
error_reporting(E_ALL);
//echo "start";

try{
    $dbh=new PDO('mysql:host=' . $settings['dbname'] .';dbname=' . $settings['dbname'],$settings['dbuser'],$settings['dbpass']);
} 
catch(PDOException $e){
    echo 'Error connecting to MySQL!: '.$e->getMessage();
    exit();
}

function getSingleRow($db,$sql,$id) {
	$result = $db->prepare($sql);
	$result->execute(array($id));
	$rows = $result->fetch(PDO::FETCH_ASSOC);
	return($rows);
}

function getRows($db,$sql,$id) {
	$result = $db->prepare($sql);
	$result->execute(array($id));
	$rows = $result->fetchAll(PDO::FETCH_ASSOC);
	return($rows);
}

function getTable($db,$sql){
	$result = $db->prepare($sql);
	$result->execute();
	$rows = $result->fetchALL(PDO::FETCH_ASSOC);
	return($rows);
}

function updateRecord($db,$sql,$data){
	$result = $db->prepare($sql);
	$result->execute($data);
	return;
}

function addRecord($db,$sql,$data){
	$result = $db->prepare($sql);
	$result->execute($data);
	return;
}

function deleteRecord($db,$sql,$id){
	$result = $db->prepare($sql);
	$result->execute(array($id));
	return;
}

function searchKeyword($db,$sql,$key){
	$result = $db->prepare($sql);
	$result->bindValue(':key', "%{$key}%");
	$result->execute();
	$rows = $result->fetchALL(PDO::FETCH_ASSOC);
	return($rows);
}

function getNav($dbh){
	$result = $dbh->query('SELECT netgroup.name AS "netname", networks.* FROM netgroup LEFT JOIN (SELECT * FROM networks ORDER BY vlan ASC, name ASC) networks ON netgroup.id=networks.netgroup');
	$rows = $result->fetchAll();
	return($rows);
}

function getHash($db,$info){
	$result = $db->prepare('SELECT * FROM users WHERE username= :user LIMIT 1');
	$result->bindParam(':user', $info);
	$result->execute();
	$hash = $result->fetch(PDO::FETCH_ASSOC);
	return($hash);
}

function getRowCount($db,$sql,$id){
	$result = $db->prepare($sql);
	$result->execute(array($id));
	$rows = $result->rowCount();
	return($rows);
}

function updateStats($db){
	$session = session_id();
	$time = time();
	$ip = $_SERVER['REMOTE_ADDR'];
	$user = $_SESSION['username'];
	$testsql='SELECT * FROM stats WHERE session=? LIMIT 1';
	$test = getRowCount($db,$testsql,$session);
	if ($test!=1){
		$result = $db->prepare('INSERT INTO stats (`ipaddress`,`user`,`session`,`time`,`online`) VALUES (?,?,?,?,?)');
		$result->execute(array($ip,$user,$session,$time,"1"));
	}else{
		$result = $db->prepare('UPDATE stats SET `time`=? WHERE session=?');
		$result->execute(array($time,$session));
	}
}

?>
