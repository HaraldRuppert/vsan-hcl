<?php

if(in_array($_GET['type'], array('controller','ssd','hdd')))
	$_INPUT['type'] = $_GET['type'];
else
	$_INPUT['type'] = NULL;

$_INPUT['model'] = filter_var($_GET['model'],FILTER_SANITIZE_STRING);
$_INPUT['vendor'] = filter_var($_GET['vendor'],FILTER_SANITIZE_STRING);


// always 4 digt hex
if(strlen($_GET['vid']) < 5 && ctype_xdigit($_GET['vid']))
	$_INPUT['vid'] = $_GET['vid'];
else
	$_INPUT['vid'] = NULL;

if(strlen($_GET['did']) < 5 && ctype_xdigit($_GET['did']))
	$_INPUT['did'] = $_GET['did'];
else
    $_INPUT['did'] = NULL;

if(strlen($_GET['ssid']) < 5 && ctype_xdigit($_GET['ssid']))
	$_INPUT['ssid'] = $_GET['ssid'];
else
    $_INPUT['ssid'] = NULL;

if(strlen($_GET['svid']) < 5 && ctype_xdigit($_GET['svid']))
	$_INPUT['svid'] = $_GET['svid'];
else
	$_INPUT['svid'] = NULL;

if(is_int($_GET['id']))
    $_INPUT['id'] = intval($_GET['id']);
else
    $_INPUT['id'] = NULL;

$_INPUT['release'] = filter_var($_GET['release'],FILTER_SANITIZE_STRING);

/*
print_r($_INPUT);

$_INPUT = $_GET;
echo "<br>";
print_r($_INPUT);
*/

if(empty($_INPUT['id']) &&
    empty($_INPUT['model']) &&
    empty($_INPUT['vendor']) &&
    empty($_INPUT['vid']) &&
    empty($_INPUT['did']) &&
    empty($_INPUT['ssid']) &&
    empty($_INPUT['svid'])) {
    exit;
}
elseif(!empty($_INPUT['model']) ||
    !empty($_INPUT['vendor']) ||
    !empty($_INPUT['vid']) ||
    !empty($_INPUT['did']) ||
    !empty($_INPUT['ssid']) ||
    !empty($_INPUT['svid'])) {
    unset($_INPUT['id']);
}

if(file_exists("all.json"))
	$hcl = file_get_contents("all.json");
else
    $hcl = file_get_contents("../all.json");


$hcl = json_decode($hcl,TRUE);

$hcl = $hcl['data'][$_INPUT['type']];

if(file_exists("sshd2pid.json"))
	$sshd2pid = file_get_contents("sshd2pid.json");
else
    $sshd2pid = file_get_contents("../sshd2pid.json");

$sshd2pid = file_get_contents("sshd2pid.json");
$sshd2pid = json_decode($sshd2pid,TRUE);

?>
