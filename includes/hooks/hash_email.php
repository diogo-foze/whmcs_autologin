<?php
/**
 * Auto Login Hash Merge Tag Email Template
 * @author     Diogo Soares Ferreira
 * @copyright  Copyright (c) 2020
 */

if (!defined('WHMCS')) die('This file cannot be accessed directly');
function hash_email_template($vars) {
	$whmcsAdmin							= 1;
	$invoiceID							= $vars['relid'];
 	$getinvoice							= 'getinvoice';
	$getinvoiceid['invoiceid']			= $invoiceID;
	$GetInvoiceResults					= localAPI($getinvoice,$getinvoiceid,$whmcsAdmin);
	$userID								= $GetInvoiceResults['userid'];
 	$getClient							= 'getclientsdetails';
	$getClientValues['clientid']		= $userID;
	$getClientValues['stats']			= true;
	$getClientValues['responsetype']	= 'json';
	$getClientResults					= localAPI($getClient,$getClientValues,$whmcsAdmin);
	$secret_key							= 'xxxxx_secret_key_xxxx'; // chave igual à inserida no /auth.php
	$merge_fields = array();
	$merge_fields['hash']				= md5($getClientResults['client']['email'].$getClientResults['client']['id'].$getClientResults['client']['firstname'].$getClientResults['client']['lastname'].$secret_key);
	return $merge_fields;
}
add_hook('EmailPreSend',1,'hash_email_template');
?>
