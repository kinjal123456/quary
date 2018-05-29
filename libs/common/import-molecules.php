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
		
		$progressfilepath=__DIR__ .'/'._PROGRESS_FILES_._MOLECULES_.'_progress.txt';//progress file path
		
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
					if(strtolower($data[0])!="moleculeid"){//Ignore first row (titles)
						$moleculeid=(strlen($data[0])>0)?intval($data[0]):0;
						$name=trim($data[1]);
						$benchmark=$data[2];
						$status=($data[3]!='')?intval($data[3]):1;
						
						//get total molecules
						$getCountQuery="select isdeleted, count(id) as totalrecords from molecules where id=%i";
						$getCountQuery=$sql->query($getCountQuery, array($moleculeid));
						$getCountResult=$db->query($getCountQuery);
						$getCountRow=$db->fetchNextObject($getCountResult);
						$getCountIsdeleted=$getCountRow->isdeleted;
						$getTotalCount=$getCountRow->totalrecords;
						
						/*Checking for duplicate molecules*/
						$molExistQuery="select count(id) as molcount from molecules where id<>%i and lower(name)=lower('%s') and isdeleted=%i";
						$molExistQuery=$sql->query($molExistQuery, array($moleculeid, $name, 0));
						$molCount=$db->queryUniqueValue($molExistQuery);
						
						if($getTotalCount>0 && $getCountIsdeleted==0){
							$updateflag=1;//send for the form resubmition when record exists in the system
						}
						
						if($flag>0){// when user allow to update the entry, then update the flag to 0, to complete the import process
							$updateflag=0;
						}
						
						if($moleculeid>0 && $updateflag==0 && $molCount==0 && $name!="" && strlen($benchmark)>0){
							//update modificatindate for service
							$moldataquery="update molecular_data set modificationdate=now() where molecularid=%i and isdeleted=%i";
							$moldataquery=$sql->query($moldataquery, array($moleculeid, 0));
							$db->execute($moldataquery);
							
							if($getTotalCount>0){//If record exists, update
								$upquery="UPDATE `molecules` SET name='%s', benchmark=%i, status=%i, isdeleted=%i, modificationdate=now() where id=%i";
								$upquery=$sql->query($upquery,array($name, $benchmark, $status, 0, $moleculeid));
								$db->execute($upquery);
							}else {//else, insert
								$inquery="INSERT INTO `molecules` SET id=%i, name='%s', benchmark=%i, status=%i, modificationdate=now(), creationdate=now()";
								$inquery=$sql->query($inquery,array($moleculeid, $name, $benchmark, $status));
								$db->execute($inquery);
							}
						}else{//If validation fails, set error messages and bind that all in single array and pass it to json value
							$reason = "Reason : ";
							if($moleculeid==0){ $reason .= " Moleculeid must not be empty.<br>"; }
							if($name==""){ $reason .= " Name must not be empty.<br>"; }
							if($moleculeid>0 && $molCount>0){ $reason .= $name . " already exists.<br>"; }
							if(strlen($benchmark)==0){ $reason .= " Benchmark must not be empty.<br>"; }

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
				$errorfilename=_MOLECULES_CSV_.'error_'.$file;
				$query_csv="UPDATE `user_csv` SET `errorfilepath`='%s', `modificationdate`=NOW() WHERE id=%i";
				$query_csv=$sql->query($query_csv,array($errorfilename,$csvfileid));
				$db->execute($query_csv);
				$fp = fopen($errorfilename, 'w');
				fputcsv($fp, array('Moleculeid', 'Name', 'Benchmark', 'Status', 'Reason'));
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