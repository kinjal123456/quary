<?php
    require_once 'criticaldata.php';
    define('_PERPAGE_LISTING_', 10);
	
	//IMPORT EXCEL
    define("_CHUNKSIZE_", 800);
	
	//CUSTOMER LICENCE INFORMATION
	define("_EXPLOSIVE_LICENCE_TYPE_", 1);
	define("_SHORTFIRE_LICENCE_TYPE_", 2);
	
	/****************************************CUSTOMERS CONSTANTS**********************************************************************************/
    define("_CUSTOMER_REQUIRED_ESTABLISHMENTNAME_", "0");
    define("_CUSTOMER_REQUIRED_EMAIL_", "1");
    define("_CUSTOMER_REQUIRED_PHONE_", "2");
	define("_CUSTOMER_REQUIRED_ZONE_", "3");
	
	define("_CUSTOMER_MESSAGE_REQUIRED_ESTABLISHMENTNAME_", "&bull; The establishment name must not be empty.");
    define("_CUSTOMER_MESSAGE_REQUIRED_EMAIL_", "&bull; The email must not be empty.");
    define("_CUSTOMER_MESSAGE_REQUIRED_PHONE_", "&bull; The phone number must not be empty.");
	define("_CUSTOMER_MESSAGE_REQUIRED_ZONE_", "&bull; The zone must not be empty.");
	define("_CUSTOMER_MESSAGE_INVALID_ZONE_", "&bull; The zone does not exists in the system.");
	
	/****************************************REGISTER FORM CONSTANTS*****************************************************************************/
	$REGISTER_FORM_A_1_CATEGORY_ADDRESS_ = array(
			1 => "HS",
			2 => "S",
			3 => "SS",
			4 => "US"
	);
	
	/****************************************REGISTER FORM D ATTENDANCE ABBRIVIATION*****************************************************************************/
	$REGISTER_FORM_D_ATTENDANCE_ = array(
			1 => "A",
			2 => "P",
			3 => "X"
	);
	
	/****************************************BILLS REPORTS PAYMENT STATUS*****************************************************************************/
	$BILLS_PAYMENT_STATUS_ = array(
			1 => "Payment due",
			2 => "Paid"
	);
	
	/****************************************REGISTER FORM B RATES VALUES*****************************************************************************/
	$REGISTER_FORM_B_RATES_ = array("Select", "Yes", "No");
		
	/****************************************CAPACITY EXPLOSIVE NAME VALUES*****************************************************************************/
	$CAPACITY_EXPLOSIVE_NAMES_ = array("Nitrate mixture", "Safely fuse", "Detoriating fuse", "Detoriators");
	
	/****************************************CAPACITY UNIT VALUES*****************************************************************************/
	$CAPACITY_UNIT_ = array("Kgs", "Mtrs", "Nos");
?>