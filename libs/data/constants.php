<?php
    require_once 'criticaldata.php';
    define('_PERPAGE_LISTING_', 10);
	
	//IMPORT EXCEL
    define("_CHUNKSIZE_", 800);
	
	//CUSTOMER LICENCE INFORMATION
	define("_EXPLOSIVE_LICENCE_TYPE_", 1);
	define("_SHORTFIRE_LICENCE_TYPE_", 2);
	
	/****************************************CUSTOMERS CONSTANTS**********************************************************************************/
    define("_CUSTOMER_REQUIRED_FIRSTNAME_", "0");
    define("_CUSTOMER_REQUIRED_LASTNAME_", "1");
    define("_CUSTOMER_REQUIRED_EMAIL_", "2");
    define("_CUSTOMER_REQUIRED_PHONE_", "3");
	define("_CUSTOMER_REQUIRED_ZONE_", "4");
	define("_CUSTOMER_REQUIRED_LICENCE_", "5");
	
	define("_CUSTOMER_MESSAGE_REQUIRED_FIRSTNAME_", "&bull; The firstname must not be empty.");
    define("_CUSTOMER_MESSAGE_REQUIRED_LASTNAME_", "&bull; The lastname must not be empty.");
    define("_CUSTOMER_MESSAGE_REQUIRED_EMAIL_", "&bull; The email must not be empty.");
    define("_CUSTOMER_MESSAGE_REQUIRED_PHONE_", "&bull; The phone number must not be empty.");
	define("_CUSTOMER_MESSAGE_REQUIRED_ZONE_", "&bull; The zone must not be empty.");
	define("_CUSTOMER_MESSAGE_REQUIRED_LICENCE_", "&bull; The licence must not be empty.");
	define("_CUSTOMER_MESSAGE_INVALID_ZONE_", "&bull; The zone does not exists in the system.");
	
	/****************************************REGISTER FORM CONSTANTS*****************************************************************************/
	$REGISTER_FORM_A_1_CATEGORY_ADDRESS = array(
			1 => "HS",
			2 => "S",
			3 => "SS",
			4 => "US"
	);
?>