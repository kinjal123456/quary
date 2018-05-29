<?php
    session_start();
    set_time_limit(0);

    if(isset($_SESSION['userId']) && $_SESSION['userId'] > 0){
        $userid=intval($_SESSION['userId']);
    }

    ini_set('memory_limit', '-1');
    $refresh=1;
    require_once 'libs/data/db.connect.php';
    require_once 'phpExcel/Classes/PHPExcel.php';

    $arraydata=array();

    //-----------------------working read data----------------------------//
    $arraydata=array();
    $uploadid=0;
    $countcolms=array();
    if(isset($_POST['uploadid']) && $_POST['uploadid'] > 0){
        $uploadid=intval($_POST['uploadid']);
    }
    $query="SELECT filename, created_at FROM `customerupload` WHERE id=%i";
    $query=$sql->query($query,array($uploadid));
    $result=$db->query($query);
    if($row = $db->fetchNextObject($result)){
        $creationdate=$row->created_at;
        $filename=$row->filename;
        $path="data/customers/".$uploadid."/";
        $filepath=$path."/".$filename;
    }else{
        header("Location: customers.php");
        exit(0);
    }

    /*----------------------------------read excel file-----------------------------------*/
    $inputFileName=$filepath;
    $output=readExcelFile($inputFileName);
    $highestRow=$output[0];
    $highestColumnIndex=$output[1];
    $objWorksheet=$output[2];
    /*----------------------calculate the chunk size----------------------------------*/
    $chunksize=_CHUNKSIZE_;
    $startRow=1;
    $endRow=$chunksize;
    $count=ceil($highestRow/$chunksize);

    //-----------------------page related data----------------------------//
    $page_title = "Upload Customers";
	
    require_once 'header.php';
?>
<script>
    $(document).ready(function(){
        var errorflag=$("#errorflag").val();
        hideLoader();
        if(errorflag==0){
            $('#tableheader').hide();
            msg="The file has been imported successfully. Please <a href='customers.php' class='import_link_success'>click here</a> to view data.";
            $('#notify').notification({"caption":msg , "sticky": true, "type": "information"});
        }else if(errorflag==1){
            $('#printerror').show();
            msg="The file could not be imported successfully due to the following row(s) which contain errors. Please correct the errors and <a class='import_link_error' href='customers.php'>click here</a> to import the data.";
            $('#notify').notification({"caption":msg , "sticky": true, "type": "warning"});
        }
    });
</script>
<input type="hidden" name="errorflag" id="errorflag" value="0"/>
<td valign="top" style="padding: 20px">
	<div class="table-container" style="min-height:383px">
		<div id="printerror" class="paddingbottom10">
			<div class="printbutton">
				<input type="button" name="printerror" value="Print" onclick="printError();" class="add-button"/>
			</div>
		</div>
		<div style="padding:10px">
			<div id="notify"><!-- --></div>
		</div>
		<div id="tableheader">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
			<td align="left" valign="top" class="table-title" style="width:40px">Sr no.</td>
            <td align="left" valign="top" class="table-title" style="width:150px">First name</td>
            <td align="left" valign="top" class="table-title" style="width:150px">Last name</td>
            <td align="left" valign="top" class="table-title" style="width:200px">Email</td>
            <td align="left" valign="top" class="table-title" style="width:100px">Phone number</td>
            <td align="left" valign="top" class="table-title">Reason</td>
        </tr>
        <?php
            $chekvalidateloop=1;
            $errorflag=0;
            $colString=array();
            $dbdataArray=array();
            while($chekvalidateloop<=$count){
                for ($row=$startRow;$row<=$endRow;$row++)
                {
                    if($row>$highestRow){
                        break;
                    }
                    for ($col=0;$col<$highestColumnIndex;$col++)
                    {
                        $colString[$row-1][$col] = PHPExcel_Cell::stringFromColumnIndex($col)."".$row; //gets the column name-eg.A2;
                        $rowString[$row-1]=$row;
                        $cellobj=$objWorksheet->getCellByColumnAndRow($col, $row);
                        $value=$cellobj->getValue();
                        if(PHPExcel_Shared_Date::isDateTime($cellobj)) { //to check the date
                            $value=PHPExcel_Style_NumberFormat::ToFormattedString($value, 'DD-MM-YYYY');
                        }
                        $arraydata[$row-1][$col]=$value;
                    }
                }
                array_filter($arraydata);
				$counter=1;
                foreach($arraydata as $columnkey=>$columnvalue){
                    if($columnkey>0){ //skip the first row
                        if(array_filter($columnvalue)){
                            //------------------------------------VALIDATION FOR REQUIRE FIRST NAME-------------------------------------//
                            $fnamevalue=replaceMultiWhiteSpace(trim($columnvalue[_CUSTOMER_REQUIRED_FIRSTNAME_]));
                            $fnamecolname=$colString[$columnkey][_CUSTOMER_REQUIRED_FIRSTNAME_];
                            if($fnamevalue==""){
                                $error_list[]=_CUSTOMER_MESSAGE_REQUIRED_FIRSTNAME_." <span class='import_error_cellname'>[Cell ".$fnamecolname."]</span>";
                            }
                            //------------------------------------VALIDATION FOR REQUIRE LAST NAME-------------------------------------//
                            $lnamevalue=trim(cleanstring($columnvalue[_CUSTOMER_REQUIRED_LASTNAME_]));
                            $lnamecolname=$colString[$columnkey][_CUSTOMER_REQUIRED_LASTNAME_];
                            if($lnamevalue==""){
                                $error_list[]=_CUSTOMER_MESSAGE_REQUIRED_LASTNAME_." <span class='import_error_cellname'>[Cell ".$lnamecolname."]</span>";
                            }
                            //------------------------------------VALIDATION FOR REQUIRE EMAIL-------------------------------------//
                            $emailvalue=replaceMultiWhiteSpace(trim($columnvalue[_CUSTOMER_REQUIRED_EMAIL_]));
                            $emailcolname=$colString[$columnkey][_CUSTOMER_REQUIRED_EMAIL_];
                            if($emailvalue==""){
                                $error_list[]=_CUSTOMER_MESSAGE_REQUIRED_EMAIL_." <span class='import_error_cellname'>[Cell ".$emailcolname."]</span>";
                            }
							//------------------------------------VALIDATION FOR REQUIRE PHONE NUMBER-------------------------------------//
                            $phonevalue=replaceMultiWhiteSpace(trim($columnvalue[_CUSTOMER_REQUIRED_PHONE_]));
                            $phonecolname=$colString[$columnkey][_CUSTOMER_REQUIRED_PHONE_];
                            if($phonevalue==""){
                                $error_list[]=_CUSTOMER_MESSAGE_REQUIRED_PHONE_." <span class='import_error_cellname'>[Cell ".$phonecolname."]</span>";
                            }
							//------------------------------------VALIDATION FOR REQUIRE ZONE-------------------------------------//
                            $zonevalue=replaceMultiWhiteSpace(trim($columnvalue[_CUSTOMER_REQUIRED_ZONE_]));
                            $zonecolname=$colString[$columnkey][_CUSTOMER_REQUIRED_ZONE_];
                            if($zonevalue==""){
                                $error_list[]=_CUSTOMER_MESSAGE_REQUIRED_ZONE_." <span class='import_error_cellname'>[Cell ".$zonecolname."]</span>";
                            }else {
                            	$zone=getZoneId($zonevalue);
                            	
                            	if($zone<=0){
                            		$error_list[]=_CUSTOMER_MESSAGE_INVALID_ZONE_." <span class='import_error_cellname'>[Cell ".$zonecolname."]</span>";
                            	}
                            }
                            //------------------------------------VALIDATION FOR REQUIRE LICENCE-------------------------------------//
                            $licencevalue=replaceMultiWhiteSpace(trim($columnvalue[_CUSTOMER_REQUIRED_LICENCE_]));
                            $licencecolname=$colString[$columnkey][_CUSTOMER_REQUIRED_LICENCE_];
                            if($licencevalue==""){
                            	$error_list[]=_CUSTOMER_MESSAGE_REQUIRED_LICENCE_." <span class='import_error_cellname'>[Cell ".$licencecolname."]</span>";
                            }

                            //-------------if error - show the row data------------------//
                            if(!empty($error_list)){ //rows containing errors-print
                                $error=implode('<br/>',$error_list);
                                $errorflag=1;

                                /*-----------------------------delete the data and file datafileuploads table if error occurs------------------------------------*/
                                $querydelete="DELETE FROM customerupload WHERE id=%i";
                                $querydelete=$sql->query($querydelete,array($uploadid));
                                if($db->query($querydelete)){
                                    if(deletefile($filepath)){
                                        deletedir($path);
                                    }
                                }
        ?>
                                <tr>
									<td align="left" valign="top" class="table-data"><?php echo $counter; ?></td>
                                    <td align="left" valign="top" class="table-data" title="<?php echo $fnamevalue; ?>"><?php echo ellipses($fnamevalue, 50); ?></td>
                                    <td align="left" valign="top" class="table-data" title="<?php echo $lnamevalue; ?>"><?php echo ellipses($lnamevalue, 50); ?></td>
                                    <td align="left" valign="top" class="table-data" title="<?php echo $emailvalue; ?>"><?php echo ellipses($emailvalue, 50); ?></td>
                                    <td align="left" valign="top" class="table-data" title="<?php echo $phonevalue; ?>"><?php echo ellipses($phonevalue, 50); ?></td>
                                    <td align="left" valign="top" class="table-data">
                                        <div class="import_error">
                                            <?php echo $error; ?>
                                        </div>
                                    </td>
                                </tr>
                                <script type="text/javascript">
                                    $("#errorflag").val(<?php echo $errorflag; ?>);
                                </script>
                            <?php
                            }
                        }
                    }
                    unset($error_list);
                $counter++; }
                unset($arraydata);
                $chekvalidateloop++;
                $startRow=$startRow+$chunksize;
                $endRow=$chekvalidateloop*$chunksize;
            }

            /*-----------------------------------insert data when no error found in the file----------------------------------*/
			if($errorflag==0){
				$insertloop=1;
				$highestRow=$output[0];
				$highestColumnIndex=$output[1];
				$objWorksheet=$output[2];
				$startRow=1;
				$endRow=$chunksize;

				while($insertloop<=$count){
					for ($row=$startRow;$row<=$endRow;$row++)
					{
						if($row>$highestRow){
							break;
						}
						for ($col=0;$col<$highestColumnIndex;$col++)
						{
							$colString[$row-1][$col] = PHPExcel_Cell::stringFromColumnIndex($col)."".$row; //gets the column name-eg.A2
							$rowString[$row-1]=$row;
							$cellobj=$objWorksheet->getCellByColumnAndRow($col, $row);
							$value=$cellobj->getValue();
							if(PHPExcel_Shared_Date::isDateTime($cellobj)) { //to check the date
								$value=PHPExcel_Style_NumberFormat::ToFormattedString($value, 'DD-MM-YYYY');
							}
							$arraydata[$row-1][$col]=$value;
						}
					}
					array_filter($arraydata);
					foreach($arraydata as $columnkey=>$columnvalue){
						if($columnkey>0){ //skip the first row (title)
							if(array_filter($arraydata)){ //check for complete blank row,skip complete empty row
								$fname=replaceMultiWhiteSpace(trim($columnvalue[_CUSTOMER_REQUIRED_FIRSTNAME_]));
								$lname=trim(cleanstring($columnvalue[_CUSTOMER_REQUIRED_LASTNAME_]));
								$email=replaceMultiWhiteSpace(trim($columnvalue[_CUSTOMER_REQUIRED_EMAIL_]));
								$phone=replaceMultiWhiteSpace(trim($columnvalue[_CUSTOMER_REQUIRED_PHONE_]));
								$zoneval=replaceMultiWhiteSpace(trim($columnvalue[_CUSTOMER_REQUIRED_ZONE_]));
								$zoneId=getZoneId($zoneval);
								$licenceno=replaceMultiWhiteSpace(trim($columnvalue[_CUSTOMER_REQUIRED_LICENCE_]));
								
								$querycustomer="SELECT id as recordexist FROM `customers` WHERE email='%s'";
								$querycustomer=$sql->query($querycustomer,array($email));
								$rowcustomer=$db->queryUniqueObject($querycustomer);
								$recordexist=intval($rowcustomer->recordexist);
										
								//-------------------insert new customers----------------------//
								if($recordexist<=0){
									$querycont="INSERT INTO `customers` SET `uploadid`=%i,`zoneid`=%i,`firstname`='%s',`lastname`='%s',`email`='%s',`phone`='%s',`licenceno`='%s',
												`created_at`=NOW(),`updated_at`=NOW()";
									$querycont=$sql->query($querycont,array($uploadid,$zoneId,$fname,$lname,$email,$phone,$licenceno));
									$db->query($querycont);
									$customerid=$db->lastInsertedId();
								}else{
									$querycont="UPDATE `customers` SET `uploadid`=%i,`zoneid`=%i,`firstname`='%s',`lastname`='%s',`email`='%s',`phone`='%s',`licenceno`='%s',
												`updated_at`=NOW() WHERE LOWER(email)='%s'";
									$querycont=$sql->query($querycont,array($uploadid,$zoneId,$fname, $lname,$email,$phone,$licenceno,$email));
									$db->query($querycont);
								}
							}
						}
					}
					unset($arraydata);
					$insertloop++;
					$startRow=$startRow+$chunksize;
					$endRow=$insertloop*$chunksize;
				}
			}
        ?>
        </table>
    </div>
</div>
</td>