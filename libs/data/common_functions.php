<?php 
	function getAdminDetails($adminid){
		global $db, $sql;
		
		$query="select id, username, email from admin where id=%i";
		$query=$sql->query($query, array($adminid));
		$result=$db->query($query);
		$row=$db->fetchNextObject($result);
		$admin['id'] = intval($row->id);
		$admin['username'] = trim($row->username);
		
		return $admin;
	}
	
	function getZoneId($zonename){
		global $db, $sql;
		
		$query="SELECT id from zones WHERE LOWER(zonename)='%s'";
		$query=$sql->query($query, array($zonename));
		$zoneId=$db->queryUniqueValue($query);
		
		return $zoneId;
	}
?>