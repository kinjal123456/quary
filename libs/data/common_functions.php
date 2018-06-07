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
	
	//Delete multiple zones
	function deleteZoneByZoneid($zoneid){
		global $db,$sql;
		$query="DELETE FROM zones WHERE id in (%l)";
		$query=$sql->query($query, array($zoneid));
		if ($db->query($query)) {
			$type='success';
		}
		return $type;
	}
	
	//Delete multiple customers
	function deletecustomerBycustomerid($customerid){
		global $db,$sql;
		$customersreturn=array();
		$query="DELETE FROM customers WHERE id in (%l)";
		$query=$sql->query($query, array($customerid));
		if ($db->query($query)) {
			//Delete customers bills
			$qrybills="SELECT COUNT(*) AS totalcount FROM customers_bills WHERE=%i";
			$qrybills=$sql->query($qrybills, array($customerid));
			$billsCount=$db->queryUniqueValue($qrybills);
			if($billsCount>0){
				$queryBills="DELETE FROM customers_bills WHERE customerid=%i";
				$queryBills=$sql->query($queryBills, array($customerid));
				$db->query($queryBills);
			}
			
			//Delete customers additional info
			$qryadd="SELECT COUNT(*) AS totalcount FROM customer_additional_info WHERE=%i";
			$qryadd=$sql->query($qryadd, array($customerid));
			$addCount=$db->queryUniqueValue($qryadd);
			if($addCount>0){
				$queryAdd="DELETE FROM customer_additional_info WHERE customerid=%i";
				$queryAdd=$sql->query($queryAdd, array($customerid));
				$db->query($queryAdd);
			}
			
			//Delete customers employees
			$qryemp="SELECT COUNT(*) AS totalcount FROM customer_employees WHERE=%i";
			$qryemp=$sql->query($qryemp, array($customerid));
			$empCount=$db->queryUniqueValue($qryemp);
			if($empCount>0){
				$queryEmp="DELETE FROM customer_employees WHERE customerid=%i";
				$queryEmp=$sql->query($queryEmp, array($customerid));
				$db->query($queryEmp);
			}
			
			//Delete customers licence info
			$qryemp="SELECT COUNT(*) AS totalcount FROM customer_licence_info clf 
					 LEFT JOIN customer_explosive_capacity cxc ON clf.id=cxc.customer_licence_id WHERE clf.customerid=%i";
			$qryemp=$sql->query($qryemp, array($customerid));
			$empCount=$db->queryUniqueValue($qryemp);
			if($empCount>0){
				$queryEmp="DELETE clf FROM customer_licence_info clf 
						   LEFT JOIN customer_explosive_capacity cxc ON clf.id=cxc.customer_licence_id WHERE clf.customerid=%i";
				$queryEmp=$sql->query($queryEmp, array($customerid));
				$db->query($queryEmp);
			}
			
			//Delete customers Regiser form A - 1
			$qryregA1="SELECT COUNT(*) AS totalcount FROM customer_register_form_a_type_a WHERE=%i";
			$qryregA1=$sql->query($qryregA1, array($customerid));
			$regA1Count=$db->queryUniqueValue($qryregA1);
			if($regA1Count>0){
				$queryregA1="DELETE FROM customer_register_form_a_type_a WHERE customerid=%i";
				$queryregA1=$sql->query($queryregA1, array($customerid));
				$db->query($queryregA1);
			}
			
			//Delete customers Regiser form A - 2
			$qryregA2="SELECT COUNT(*) AS totalcount FROM customer_register_form_a_type_b WHERE=%i";
			$qryregA2=$sql->query($qryregA2, array($customerid));
			$regA2Count=$db->queryUniqueValue($qryregA2);
			if($regA2Count>0){
				$queryregA2="DELETE FROM customer_register_form_a_type_b WHERE customerid=%i";
				$queryregA2=$sql->query($queryregA2, array($customerid));
				$db->query($queryregA2);
			}
			
			//Delete customers Regiser form B
			$qryregB="SELECT COUNT(*) AS totalcount FROM customer_register_form_b WHERE=%i";
			$qryregB=$sql->query($qryregB, array($customerid));
			$regBCount=$db->queryUniqueValue($qryregB);
			if($regBCount>0){
				$queryregB="DELETE FROM customer_register_form_b WHERE customerid=%i";
				$queryregB=$sql->query($queryregB, array($customerid));
				$db->query($queryregB);
			}
			
			//Delete customers Regiser form C
			$qryregC="SELECT COUNT(*) AS totalcount FROM customer_register_form_c WHERE=%i";
			$qryregC=$sql->query($qryregC, array($customerid));
			$regCCount=$db->queryUniqueValue($qryregC);
			if($regCCount>0){
				$queryregC="DELETE FROM customer_register_form_c WHERE customerid=%i";
				$queryregC=$sql->query($queryregC, array($customerid));
				$db->query($queryregC);
			}
			
			//Delete customers Regiser form D
			$qryregD="SELECT COUNT(*) AS totalcount FROM customer_register_form_d WHERE=%i";
			$qryregD=$sql->query($qryregD, array($customerid));
			$regDCount=$db->queryUniqueValue($qryregD);
			if($regDCount>0){
				$queryregD="DELETE FROM customer_register_form_d WHERE customerid=%i";
				$queryregD=$sql->query($queryregD, array($customerid));
				$db->query($queryregD);
			}
			
			if($billsCount>0 || $billsCount>0 || $billsCount>0 || $billsCount>0 || $billsCount>0 || $billsCount>0 || $billsCount>0 || $billsCount>0 || $billsCount>0){
				$customersreturn["type"]="success";
				$customersreturn["usernotiy"]=true;
			}
		}
		return $customersreturn;
	}
?>