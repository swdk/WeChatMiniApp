<?php


/*
This is the modified from the decryption example from Wechat.

I have modified the code to use our sessionkey,encrypted data nad iv passed from http request and returning the decoded messages
AppId is hardcoded as it will not change

*/
include_once "wxBizDataCrypt.php";


$appid = 'wxdf874a02383b8f72';
$sessionKey = $_GET['session_key']; 

$encryptedData= $_GET['encryptedData'];

$iv = $_GET['iv'];

$pc = new WXBizDataCrypt($appid, $sessionKey);
$errCode = $pc->decryptData($encryptedData, $iv, $data );

if ($errCode == 0) {
    echo($data . "\n");
} else {
    echo($errCode . "\n");
}
