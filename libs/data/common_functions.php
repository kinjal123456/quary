<?php 
	function getAdminDetails($adminid){
		global $db, $sql;
		
		$query="select id, adminname, username, email from admin where id=%i";
		$query=$sql->query($query, array($adminid));
		$result=$db->query($query);
		$row=$db->fetchNextObject($result);
		$admin['id'] = intval($row->id);
		$admin['adminname'] = trim($row->adminname);
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
	
	//Delete multiple zones
	function deleteZoneByZoneid($zoneid){
		global $db,$sql;
		
		$custquery = "SELECT count(*) as totalrecords FROM customers WHERE zoneid in (%l)";
		$custquery = $sql->query($custquery, array($zoneid));
    	$custcount = intval($db->queryUniqueValue($custquery));
	
		if($custcount==0){
			$query="DELETE FROM zones WHERE id in (%l)";
			$query=$sql->query($query, array($zoneid));
			if ($db->query($query)) {
				$type='success';
			}
		}else {
			$type='recordexist';
		}
		return $type;
	}
	
	//Delete multiple customers
	function deletecustomerBycustomerid($customerid, $confirmFlag){
		global $db,$sql;
		$customersreturn=array();
		
		$qrybills="SELECT COUNT(*) AS totalcount FROM customers_bills WHERE customerid IN (%l)";
		$qrybills=$sql->query($qrybills, array($customerid));
		$billsCount=$db->queryUniqueValue($qrybills);
		
		$qryadd="SELECT COUNT(*) AS totalcount FROM customer_additional_info WHERE customerid IN (%l)";
		$qryadd=$sql->query($qryadd, array($customerid));
		$addCount=$db->queryUniqueValue($qryadd);
		
		$qryemp="SELECT COUNT(*) AS totalcount FROM customer_employees WHERE customerid IN (%l)";
		$qryemp=$sql->query($qryemp, array($customerid));
		$empCount=$db->queryUniqueValue($qryemp);
		
		$qrylicence="SELECT COUNT(*) AS totalcount FROM customer_licence_info WHERE customerid IN (%l)";
		$qrylicence=$sql->query($qrylicence, array($customerid));
		$licenceCount=$db->queryUniqueValue($qrylicence);
		
		$qrycapacity="SELECT COUNT(*) AS totalcount FROM customer_explosive_capacity WHERE customerid IN (%l)";
		$qrycapacity=$sql->query($qrycapacity, array($customerid));
		$capacityCount=$db->queryUniqueValue($qrycapacity);
		
		$qryregA1="SELECT COUNT(*) AS totalcount FROM customer_register_form_a_type_a WHERE customerid IN (%l)";
		$qryregA1=$sql->query($qryregA1, array($customerid));
		$regA1Count=$db->queryUniqueValue($qryregA1);
		
		$qryregA2="SELECT COUNT(*) AS totalcount FROM customer_register_form_a_type_b WHERE customerid IN (%l)";
		$qryregA2=$sql->query($qryregA2, array($customerid));
		$regA2Count=$db->queryUniqueValue($qryregA2);
		
		$qryregC="SELECT COUNT(*) AS totalcount FROM customer_register_form_c WHERE customerid IN (%l)";
		$qryregC=$sql->query($qryregC, array($customerid));
		$regCCount=$db->queryUniqueValue($qryregC);
		
		$qryregB="SELECT COUNT(*) AS totalcount FROM customer_register_form_b WHERE customerid IN (%l)";
		$qryregB=$sql->query($qryregB, array($customerid));
		$regBCount=$db->queryUniqueValue($qryregB);
		
		$qryregD="SELECT COUNT(*) AS totalcount FROM customer_register_form_d WHERE customerid IN (%l)";
		$qryregD=$sql->query($qryregD, array($customerid));
		$regDCount=$db->queryUniqueValue($qryregD);
		
		if(($billsCount==0 || $addCount==0 || $empCount==0 || $licenceCount==0 || $capacityCount==0 || $regA1Count==0 || $regA2Count==0 || $regBCount==0 || $regCCount==0 || $regDCount==0) && $confirmFlag==0){
			$qry="SELECT DISTINCT uploadid FROM customers WHERE id IN (%l)";
			$qry=$sql->query($qry, array($customerid));
			$res=$db->query($qry);
			while($rw=$db->fetchNextObject($res)){
				$uploadid[]=intval($rw->uploadid);
			}
					
			$query="DELETE FROM customers WHERE id IN (%l)";
			$query=$sql->query($query, array($customerid));
			if ($db->query($query)) {
				//Delete customer upload
				$delqry="DELETE FROM customerupload WHERE id IN (%l)";
				$delqry=$sql->query($delqry, array($uploadid));
				$db->query($delqry);
				
				$customersreturn["type"]="success";
				$customersreturn["usernotiy"]=false;
			}
		}else if(($billsCount>0 || $addCount>0 || $empCount>0 || $licenceCount>0 || $capacityCount>0 || $regA1Count>0 || $regA2Count>0 || $regBCount>0 || $regCCount>0 || $regDCount>0) && $confirmFlag==0){
			$customersreturn["type"]="success";
			$customersreturn["usernotiy"]=true;
		}else {
			if($confirmFlag>0){
				$query="DELETE FROM customers WHERE id in (%l)";
				$query=$sql->query($query, array($customerid));
				if ($db->query($query)) {
					$qry="SELECT DISTINCT uploadid FROM customers WHERE id IN (%l)";
					$qry=$sql->query($qry, array($customerid));
					$res=$db->query($qry);
					while($rw=$db->fetchNextObject($res)){
						$uploadid[]=intval($rw->uploadid);
					}
					
					//Delete customer upload
					$delqry="DELETE FROM customerupload WHERE id IN (%l)";
					$delqry=$sql->query($delqry, array($uploadid));
					$db->query($delqry);
					
					//Delete customers bills
					if($billsCount>0){
						$queryBills="DELETE FROM customers_bills WHERE customerid=%i";
						$queryBills=$sql->query($queryBills, array($customerid));
						$db->query($queryBills);
					}
					
					//Delete customers additional info
					if($addCount>0){
						$queryAdd="DELETE FROM customer_additional_info WHERE customerid=%i";
						$queryAdd=$sql->query($queryAdd, array($customerid));
						$db->query($queryAdd);
					}
					
					//Delete customers employees
					if($empCount>0){
						$queryEmp="DELETE FROM customer_employees WHERE customerid=%i";
						$queryEmp=$sql->query($queryEmp, array($customerid));
						$db->query($queryEmp);
					}
					
					//Delete customers licence info
					if($licenceCount>0){
						$queryLic="DELETE FROM customer_licence_info WHERE customerid=%i";
						$queryLic=$sql->query($queryLic, array($customerid));
						$db->query($queryLic);
					}
					
					//Delete customers capacity
					if($capacityCount>0){
						$queryCap="DELETE FROM customer_explosive_capacity WHERE customerid=%i";
						$queryCap=$sql->query($queryCap, array($customerid));
						$db->query($queryCap);
					}
					
					//Delete customers Regiser form A - 1
					if($regA1Count>0){
						$queryregA1="DELETE FROM customer_register_form_a_type_a WHERE customerid=%i";
						$queryregA1=$sql->query($queryregA1, array($customerid));
						$db->query($queryregA1);
					}
					
					//Delete customers Regiser form A - 2
					if($regA2Count>0){
						$queryregA2="DELETE FROM customer_register_form_a_type_b WHERE customerid=%i";
						$queryregA2=$sql->query($queryregA2, array($customerid));
						$db->query($queryregA2);
					}
					
					//Delete customers Regiser form B
					if($regBCount>0){
						$queryregB="DELETE FROM customer_register_form_b WHERE customerid=%i";
						$queryregB=$sql->query($queryregB, array($customerid));
						$db->query($queryregB);
					}
					
					//Delete customers Regiser form C
					if($regCCount>0){
						$queryregC="DELETE FROM customer_register_form_c WHERE customerid=%i";
						$queryregC=$sql->query($queryregC, array($customerid));
						$db->query($queryregC);
					}
					
					//Delete customers Regiser form D
					if($regDCount>0){
						$queryregD="DELETE FROM customer_register_form_d WHERE customerid=%i";
						$queryregD=$sql->query($queryregD, array($customerid));
						$db->query($queryregD);
					}
				}
				
				$customersreturn["type"]="success";
				$customersreturn["usernotiy"]=false;
			}
		}
			
		return $customersreturn;
	}
?>