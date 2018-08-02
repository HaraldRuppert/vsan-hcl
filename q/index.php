<?php

require('../functions.php');
require('../common.php');

$result = searchHCL($hcl,$_INPUT,$sshd2pid);
$result = array_slice($result,0,50);

$i = 0;
foreach($result as $line) {
	echo $line['vcglink'] . "\n";
	$i ++;
}

if ($i == 0) die("Nothing found, seems to be not vSAN certified. Please check manually\nNo NVME support yet\n");


?>
