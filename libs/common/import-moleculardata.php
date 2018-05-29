<?php
	set_time_limit(0);
	
	require __DIR__ . '/../data/db.connect.php';
	
	//get values, from the shell script call
	$csvfileid=$argv[1];
	$csvpath=$argv[2];
	$totalcount=$argv[3];
	$flag=$argv[4];
	
	if($csvfileid>0){
		$que="select filepath from user_csv where id=%i";
		$que=$sql->query($que, array($csvfileid));
		$file=$db->queryUniqueValue($que);
		
		createdir(__DIR__ .'/'._PROGRESS_FILES_);//create directory to store progress files
		
		$progressfilepath=__DIR__ .'/'._PROGRESS_FILES_._MOLECULES_DATA_.'_progress.txt';//progress file path
		
		$type="error";
		$counter=0;
		$bunchpercentage = 1;
		$percentagecomplete=0;
		$totalprogressvalue = 100/$totalcount;
		$overhead = ($totalcount*$bunchpercentage)/100;
		
		$progressarray=array('status' => 'success','description' => 'Start processing','value' => 0);
		updateImportProgressFile($progressfilepath,$progressarray);
		
		if (($handle = fopen($csvpath, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				if(array_filter($data)){
					if(strtolower($data[0])!="moleculardataid"){//Ignore first row (titles)
						$moleculardataid=(strlen($data[0])>0)?intval($data[0]):0;
						$pharmacyid=intval($data[1]);
						$molecularid=intval($data[2]);
						$molecular_contribution=trim($data[3]);
						$cipla=trim($data[4]);
						
						//get total molecular data
						$getCountQuery="select isdeleted, count(id) as totalrecords from molecular_data where id=%i";
						$getCountQuery=$sql->query($getCountQuery, array($moleculardataid));
						$getCountResult=$db->query($getCountQuery);
						$getCountRow=$db->fetchNextObject($getCountResult);
						$getCountIsdeleted=$getCountRow->isdeleted;
						$getTotalCount=$getCountRow->totalrecords;
						
						//checking for pharmacyid exists in master 
						$getCustomerQuery="select count(id) as customerexists from customers where id=%i and isdeleted=%i";
						$getCustomerQuery=$sql->query($getCustomerQuery, array($pharmacyid, 0));
						$getCustomerCount=$db->queryUniqueValue($getCustomerQuery);
						
						//checking for moleuclarid exists in master
						$getMoleculeQuery="select count(id) as moleculeexists from molecules where id=%i and isdeleted=%i";
						$getMoleculeQuery=$sql->query($getMoleculeQuery, array($molecularid, 0));
						$getMoleculeCount=$db->queryUniqueValue($getMoleculeQuery);
						
						/*Checking for duplicate molecular id*/
						$molDataQuery="select count(id) as moldatacount from molecular_data where id<>%i and molecularid=%i and pharmacyid=%i and isdeleted=%i";
						$molDataQuery=$sql->query($molDataQuery, array($moleculardataid, $molecularid, $pharmacyid, 0));
						$molDataCount=$db->queryUniqueValue($molDataQuery);
						
						$molDataCustomerQuery="select pharmacyid, molecularid from molecular_data where id=%i and isdeleted=%i";
						$molDataCustomerQuery=$sql->query($molDataCustomerQuery, array($moleculardataid, 0));
						$molDataCustomerResult=$db->query($molDataCustomerQuery);
						$molDataCustomerCount=$db->numRows($molDataCustomerResult);
						if($molDataCustomerCount>0){
							$molDataCustomerRow=$db->fetchNextObject($molDataCustomerResult);
							$currentPharmacyId=intval($molDataCustomerRow->pharmacyid);
							$currentMolecularId=intval($molDataCustomerRow->molecularid);
							if($pharmacyid>0 && $molecularid>0){
								$pharmacyExists=($currentPharmacyId==$pharmacyid && $currentMolecularId==$molecularid)?0:1;
							}
						}else {
							$pharmacyExists=0;
						}
						
						if($getTotalCount>0 && $getCountIsdeleted==0){
							$updateflag=1;//send for the form resubmition when record exists in the system
						}
						
						if($flag>0){// when user allow to update the entry, then update the flag to 0, to complete the import process
							$updateflag=0;
						}

						if($pharmacyExists==0 && $moleculardataid>0 && $updateflag==0 && $molDataCount==0 && $getCustomerCount>0 && $getMoleculeCount>0 && $pharmacyid!="" && $molecularid!="" && $molecular_contribution!="" && $cipla!=""){
							if($getTotalCount>0){//If record exists, update
								$upquery="UPDATE `molecular_data` SET pharmacyid=%i, molecularid=%i, molecular_contribution='%f', cipla='%f', isdeleted=%i, modificationdate=now() where id=%i";
								$upquery=$sql->query($upquery,array($pharmacyid, $molecularid, $molecular_contribution, $cipla, 0, $moleculardataid));
								$db->execute($upquery);
							}else {//else, insert
								$inquery="INSERT INTO `molecular_data` SET id=%i, pharmacyid=%i, molecularid=%i, molecular_contribution='%f', cipla='%f', modificationdate=now(), creationdate=now()";
								$inquery=$sql->query($inquery,array($moleculardataid, $pharmacyid, $molecularid, $molecular_contribution, $cipla));
								$db->execute($inquery);
							}
						}else{//If validation fails, set error messages and bind that all in single array and pass it to json value
							$reason = "Reason : ";
							if($moleculardataid==0){ $reason .= " Moleculardata Id must not be empty.<br>"; }
							if($pharmacyid==""){ $reason .= " Pharmacy Id must not be empty.<br>"; }
							if($pharmacyid!='' && $getCustomerCount==0){ $reason .= 'Pharmacy Id does not exists.<br>'; }
							if($molecularid==""){ $reason .= " MolecularId must not be empty.<br>"; }
							if($molecularid!='' && $getMoleculeCount==0){ $reason .= " Molecular Id " . $molecularid . " does not exists.<br>"; }
							if($pharmacyExists>0){ $reason .= " Primary key " . $moleculardataid . " is already assign to the pharmacy.<br>"; }
							if($moleculardataid>0 && $molDataCount>0){ $reason .= "Molecular Id " . $molecularid . " already exists.<br>"; }
							if($molecular_contribution==""){ $reason .= " Molecular Contribution must not be empty.<br>"; }
							if($cipla==""){ $reason .= " Cipla M/S must not be empty.<br>"; }

							//bind errors to an array
							$tempArray = $data;
							$tempArray[] = $reason;
							$csvErrorArray[] = $tempArray;
							$reasonArray[] = $reason;
							unset($tempArray);
						}
					}
				}
				$counter++;
				
				if($counter%$overhead==0){
					if($updateflag>0){
						$percentagecomplete = 0;
					}else {
						$percentagecomplete = round($counter*$totalprogressvalue);
					}
					if($percentagecomplete==100){
						$percentagecomplete=99;
					}
					$progressarray=array('status' => 'success','description' => 'Start processing','value' => $percentagecomplete);
					updateImportProgressFile($progressfilepath,$progressarray);
				}
			}
			fclose($handle);

			if((is_array($csvErrorArray) && count($csvErrorArray) > 0 && $updateflag==0) || (is_array($reasonArray) && count($reasonArray)>0 && $updateflag==0)){
				$errorfilename=_MOLECULAR_CSV_DATA_.'error_'.$file;
				$query_csv="UPDATE `user_csv` SET `errorfilepath`='%s', `modificationdate`=NOW() WHERE id=%i";
				$query_csv=$sql->query($query_csv,array($errorfilename,$csvfileid));
				$db->execute($query_csv);
				$fp = fopen($errorfilename, 'w');
				fputcsv($fp, array('Moleculardata id', 'Pharmacyid', 'Molecularid', 'Molecular Contribution', 'Cipla M/S', 'Reason'));
				foreach ($csvErrorArray as $fields) {
					fputcsv($fp, $fields);
				}
				fclose($fp);
				$type="errorfound";
			}else {
				$type="success";
			}
			
			if($type == "success" && $percentagecomplete > 0){
				$status = "success";
				$statusarray=array('status' => $status,'description' => 'data imported successfully.','value' => 100);
				updateImportProgressFile($progressfilepath,$statusarray);
			}
		}else{
			$type="cantopenfile";
		}
		$json = '{"type" : "'.$type.'","errorfile" : "'.$errorfilename.'", "reason" : "'.implode(',',$reasonArray).'", "updateflag" : "'.$updateflag.'"}';
		echo $json;
		exit(0);
	}
?>