<?php
/**
 * Auto Login Hash Merge Tag Email Template
 * @author     Diogo Soares Ferreira
 * @copyright  Copyright (c) 2020
 */
 
 // Modelo de URL para colar no template de email:
// {$whmcs_url}auth.php?email={$client_email}&uid={$client_id}&uname={$client_first_name}{$client_last_name}&hash={$hash}&whmcsurl={$whmcs_url}&goto=viewinvoice.php?id={$invoice_id}

$autoauthkey = "xxxxx_autoauthkey_xxxxx"; // chave igual à inserida no arquivo /configuration.php
$secret_key =  "xxxxx_secret_key_xxxx"; // chave igual à inserida no arquivo /includes/hooks/hash_email.php
$whmcsurl = $_GET["whmcsurl"].'dologin.php';
if (md5($_GET['email'].$_GET['uid'].$_GET['uname'].$secret_key) != $_GET['hash']){
die();
} 
$email		= $_GET['email'];
$timestamp	= time();
$goto		= $_GET["goto"];
$hash		= sha1($email.$timestamp.$autoauthkey);
$url		= $whmcsurl."?email=$email&timestamp=$timestamp&hash=$hash&goto=".urlencode($goto);
header("Location: $url");
exit;
?>
