<?php
	function ellipses($value, $length) {
		if(strlen(trim($value))>$length)
			return substr($value, 0, $length) . "...";
		else
			return trim($value);
	}
	
	function getRatio($para1, $para2, $para3) {
		return (($para3 / $para1) * $para2);
	}

	function getPercentage($para1, $para2) {
		return (($para2 / $para1) * 100);
	}

	function genRandomString($length=5) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string = '';    

		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		return $string;
	}
	
	function genRandomNumber($length=5) {
		$characters = '0123456789';
		$string = '';    

		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		return $string;
	}

	function getTempName($path, $extension, $includepath=false) {
		do {

			$temp_file= $path . str_replace(array(" ", "."), "_", microtime()) . "." . $extension;
			//usleep(1);

		} while(file_exists($temp_file));
		
		if($includepath) 
			return $temp_file;
		else
			return basename($temp_file);
	}

	function concat($row, $fields, $concatby) {
		$return='';

		$row=get_object_vars($row);

		for($index=0;$index<count($fields);$index++) {
			if(strlen(trim($return))==0 and strlen(trim($row[$fields[$index]]))>0) {
				$return=$row[$fields[$index]];
			}
			else if(strlen(trim($row[$fields[$index]]))>0) {
				$return.=$concatby . $row[$fields[$index]];	
			}
		}

		return $return;
	}
	
	function strconcat($fields, $concatby) {
		$return='';

		for($index=0;$index<count($fields);$index++) 
		{
			if(strlen(trim($return))==0 and strlen(trim($fields[$index]))>0) {
				$return=$fields[$index];	
			}
			else if(strlen(trim($fields[$index]))>0) {
				$return.=$concatby . $fields[$index];	
			}
		}
		return $return;
	}

	function writetoconsole($text){
		echo date('m-d-Y  h:i:s a') . "    " . $text . "\n";
	}

	function writetolog($info) {
		if($handle=fopen("log.rtf", "a+")) {
			fwrite($handle, date('d/m/Y h:i:s') . "    " . $info . "\n");
			fclose($handle);
		}
	} 

	function writeservicelog($info) {
        $path = "log/"; createdir($path);
        $filename = $path."log_".date('Y-m-d').".rtf";
        if($handle=fopen($filename, "a+")) {
			fwrite($handle, date('d/m/Y h:i:s') . "    " . $info . "\n");
			fclose($handle);
		}
	}

	//User registration log
    function writetologUserRegistration($info) {
		$path = "../import-log/"; createdir($path);
        $filename = $path."User_Registration_".date('Y-m-d').".rtf";
        if($handle=fopen($filename, "a+")) {
            fwrite($handle, date('d/m/Y h:i:s') . "    " . $info . "\n");
            fclose($handle);
        }
    }
	
	function createdir($path) {
		$folders=explode("/", $path);
		$path="";
		for($i=0; $i<count($folders);$i++) {
			if(strlen(trim($folders[$i]))>0) {
				$path.=$folders[$i];
				if(!file_exists($path)) {
					mkdir($path);
					chmod($path, 0777);
				}
				$path.="/";
			}
		}
	}

	function deletedir($path) {
		if(file_exists($path)) {
			$dir=opendir($path);
			while($file=readdir($dir)) {
				if($file!="." and $file!="..") {
					if(filetype($path . "/" . $file)=="dir") {
						deletedir($path . "/" . $file);
					}
					else if(filetype($path . "/" . $file)=="file") {
						chmod($path . "/" . $file, 0777);
						unlink($path . "/" . $file);
					}
				}
			}
			closedir($dir);

			chmod($path, 0777);
			rmdir($path);
		}
	}
	
	function cleardir($path) {
		if(file_exists($path)) {
			$dir=opendir($path);
	
			while($file=readdir($dir)) {
				if($file!="." and $file!="..") {
					if(filetype($path . "/" . $file)=="file") {
						chmod($path . "/" . $file, 0777);
						unlink($path . "/" . $file);
					}
				}
			}
			closedir($dir);
		}
	}
	
	function deletefile($filepath){
		if(file_exists($filepath))
			return unlink($filepath);
		else
			return false;	
	}

	function foldersize($path) {
		$totalbytes=0;
		if(file_exists($path)) {
			$dir=opendir($path);
			while($file=readdir($dir)) {
				if($file!="." and $file!="..") {
					if(filetype($path . "/" . $file)=="dir") {
						$totalbytes+=foldersize($path . "/" . $file);
					}
					else if(filetype($path . "/" . $file)=="file") {
						$totalbytes+=filesize($path . "/" . $file);
					}
				}
			}
			closedir($dir);
		}

		return $totalbytes;
	}

	function filecount($path) {
		$count=0;
		if(file_exists($path)) {
			$dir=opendir($path);
	
			while($file=readdir($dir)) {
				if($file!="." and $file!="..") {
					if(filetype($path . "/" . $file)=="file") {
						$count++;
					}
				}
			}
			closedir($dir);
		}

		return $count;
	}
	
	function strwrap($str, $chars, $concatby) {
		$len = strlen($str);
		$returnlist = array();
		for($i=0; $i<$len; $i+=$chars) {
			$returnlist[] = substr($str, $i, $chars);
		}
		
		$return = implode($concatby, $returnlist);
		return $return;
	}
	
	function geturlpath() {
		$url = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http'. '://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
		return str_replace(basename($url), "", $url);
	}
	
	function getcurrentpath($protocol='http') {
		$url=trim($_SERVER['REQUEST_URI']);
		if(substr($url, strlen($url)-1)=="/") {
			$path=$url;
		}
		else {
			$page=basename($url);
			$urlinfo=parse_url($url);
			$pathinfo=concatsimple(array($urlinfo['path'], $urlinfo['query']), "?");
			$path= $protocol . '://' . $_SERVER['SERVER_NAME'] . str_replace($page, '', $pathinfo);	
		}
		return $path;
	}
	
	function getcurrenthost($protocol='http') {
		$url=trim($_SERVER['REQUEST_URI']);
		$server=$_SERVER['SERVER_NAME'];
		
		if(!strpos($server, '.virtualtourcafe.')) {
			$path= $protocol . '://' . $_SERVER['SERVER_NAME'] . "/vtcafe/";
		}
		else {
			$path= $protocol . '://' . $_SERVER['SERVER_NAME'] . "/";		
		}
				
		return $path;
	}
	
	function concatsimple($fields, $concatby) {
		$return='';

		//$row=get_object_vars($row);

		for($index=0;$index<count($fields);$index++) 
		{
			if(strlen(trim($return))==0 and strlen(trim($fields[$index]))>0) {
				$return=$fields[$index];	
			}
			else if(strlen(trim($fields[$index]))>0) {
				$return.=$concatby . $fields[$index];	
			}
		}
		return $return;
	}
	
	function checkspecialchars($str){
		return htmlentities($str, ENT_QUOTES, 'UTF-8');	
	}
	
	function setlength($user_word,$length) {
	
		if(strlen($user_word)>$length) {
			$user_word=substr($user_word,0,$length-4);
			$user_word=$user_word . "...";
		}
		return $user_word;
	}
	
	function copy_directory($source, $destination) {
		if(is_dir($source)) {
			mkdir($destination);
			chmod($destination, 0777);
			$directory = dir($source);
			while (FALSE !== ($readdirectory = $directory->read())) {
				if($readdirectory == '.' || $readdirectory == '..') {
					continue;
				}
				$PathDir = $source . '/' . $readdirectory; 
				if(is_dir($PathDir)) {
					copy_directory($PathDir, $destination . '/' . $readdirectory);
					continue;
				}
				copy($PathDir, $destination . '/' . $readdirectory);
			}
			$directory->close();
		}else {
			copy( $source, $destination );
		}
	}
	
	function decodeString($str) {
		return stripslashes(htmlspecialchars($str));
	}
	
	function decode_viewer_caption($str) {
		return stripslashes(html_entity_decode($str, ENT_QUOTES, 'UTF-8'));
	}
	
	function curPageURL() {
		 $pageURL = 'http';
		 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
			 if ($_SERVER["SERVER_PORT"] != "80") {
				  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			 } else {
			  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
	}
	
	//remove the unwanted tags from the text
	function removeTagfromText($content, $tags){
		$contentOriginal = $content;
		$content = strtolower($content);
		foreach ($tags as $tag) {
			$flag = 1;
			$tagfmt = "<".$tag;
			while($flag > 0){
				$posst = strpos($content, $tagfmt);
				if($posst === FALSE){
					$flag = 0;
				}
				else {
					$posend = 0;
					$posend = strpos($content, '/>');
					if(!($posend > 0)){
						$tagtext = strlen($tag);
						$posend = strpos($content, '</'.$tag.'>');
						$rplclen = ($posend-$posst+$tagtext+3);
						$content = substr_replace($content, '', $posst, $rplclen);
						$contentOriginal = substr_replace($contentOriginal, '', $posst, $rplclen);
					} else {
						$rplclen = ($posend-$posst+2);
						$content = substr_replace($content, '', $posst, $rplclen);
						$contentOriginal = substr_replace($contentOriginal, '', $posst, $rplclen);
					}
				}
			}
		}
		return $contentOriginal;
	}
	
	function html2text($html)
	{
		$tags = array (
		0 => '~<h[123][^>]+>~si',
		1 => '~<h[456][^>]+>~si',
		2 => '~<table[^>]+>~si',
		3 => '~<tr[^>]+>~si',
		4 => '~<li[^>]+>~si',
		5 => '~<br[^>]+>~si',
		6 => '~<p[^>]+>~si',
		7 => '~<div[^>]+>~si',
		);
		$html = preg_replace($tags,"\n",$html);
		$html = preg_replace('~</t(d|h)>\s*<t(d|h)[^>]+>~si',' - ',$html);
		$html = preg_replace('~<[^>]+>~s','',$html);
		// reducing spaces
		$html = preg_replace('~ +~s',' ',$html);
		$html = preg_replace('~^\s+~m','',$html);
		$html = preg_replace('~\s+$~m','',$html);
		// reducing newlines
		$html = preg_replace('~\n+~s',"\n",$html);
		return $html;
	}
	
	function adminEmail(){
		global $db,$sql;
		$adminemail=$db->queryUniqueValue('SELECT email FROM admin WHERE adminid=1');
		return $adminemail;
	}
	
	function replaceMultiWhiteSpace($string){
		return preg_replace('/(\s)+/', ' ', $string);
	}
	
	function replaceWhiteSpaceWithinString($string){
		return preg_replace('/(\s)+/', '', $string);
	}
	
	function getDigitsFromCharacters($string){
		return preg_replace("/\D+/", "", $string);
	}
	function cleanstring($string) {
		$string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
		$string = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $string);
		$string= preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        return preg_replace('/-+/', '', $string);
	}

    function clearBrowserCache() {
        header ("Expires: ".gmdate("D, d M Y H:i:s", time())." GMT");
        header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
    }
	
	/*Shell execution background process server detection function*/
	function execInBackground($cmd){
		if (substr(php_uname(), 0, 7) == "Windows"){
			$test=pclose(popen("start /B ". $cmd, "r"));
		}else{
			exec($cmd . " > /dev/null &"); ///dev/null 2>/dev/null &
		}
	}
	
	//reads the entire file to import excel File
	function readExcelFile($inputFileName){ //read the excel file to insert the data
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objReader->setReadDataOnly(false);

		$objPHPExcel = $objReader->load($inputFileName);
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
		$highestRow = $objWorksheet->getHighestRow();
		$highestColumn = $objWorksheet->getHighestColumn();
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

		return array($highestRow,$highestColumnIndex,$objWorksheet);
	}
	
	//Convert numbers to words
	function number_to_word($number){
	   $no = round($number);
	   $point = round($number - $no, 2) * 100;
	   $hundred = null;
	   $digits_1 = strlen($no);
	   $i = 0;
	   $str = array();
	   $words = array('0' => '', '1' => 'one', '2' => 'two',
		'3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
		'7' => 'seven', '8' => 'eight', '9' => 'nine',
		'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
		'13' => 'thirteen', '14' => 'fourteen',
		'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
		'18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
		'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
		'60' => 'sixty', '70' => 'seventy',
		'80' => 'eighty', '90' => 'ninety');
	   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
	   while ($i < $digits_1) {
		 $divider = ($i == 2) ? 10 : 100;
		 $number = floor($no % $divider);
		 $no = floor($no / $divider);
		 $i += ($divider == 10) ? 1 : 2;
		 if ($number) {
			$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			$str [] = ($number < 21) ? $words[$number] .
				" " . $digits[$counter] . $plural . " " . $hundred
				:
				$words[floor($number / 10) * 10]
				. " " . $words[$number % 10] . " "
				. $digits[$counter] . $plural . " " . $hundred;
		 } else $str[] = null;
	  }
	  $str = array_reverse($str);
	  $result = implode('', $str);
	  $points = ($point) ?
		"." . $words[$point / 10] . " " . 
			  $words[$point = $point % 10] : '';
	  return $result . "Rupees  " ;
   }
?>
