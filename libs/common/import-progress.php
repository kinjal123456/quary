<?php
    if(isset($_POST['action']) && $_POST['action']=="getReadProgress"){
		$importfilename=(isset($_POST['importfilename']))?trim($_POST['importfilename']):'';
		
        require_once '../../libs/data/db.connect.php';
        $type = "error";
        $progress = 0;
        $progressfilepath = _PROGRESS_FILES_.$importfilename.'_progress.txt';
        if(file_exists($progressfilepath)){
            $type = "success";
            $progresshandle = fopen($progressfilepath, "r");
            $progress = trim(fread($progresshandle, filesize($progressfilepath)));
            fclose($progresshandle);
        }else{
            $progressarray=array('status' => 'success','description' => 'Start processing','value' => 0);
            $progress=json_encode($progressarray);
        }
        echo $progress;
        exit(0);
    }
?>