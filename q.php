<?php

require('functions.php');
require('common.php');

if($_INPUT['id'] > 0) $showDetails = TRUE;
else $showDetails = FALSE;

/*
$i = 0;
$result = array();
foreach($hcl as $entry) {
    if($_INPUT['type'] == 'ssd' || $_INPUT['type'] == 'hdd') {
        $entry['information'] = $entry['model'];
        $entry['model'] = trim($sshd2pid[$entry['id']]);
    }
    if(isIn($entry['id'],$_INPUT['id']) && 
        isIn($entry['model'],$_INPUT['model']) &&
        isIn($entry['vendor'],$_INPUT['vendor']) && 
        isIn($entry['vid'],$_INPUT['vid']) &&
        isIn($entry['did'],$_INPUT['did']) &&
        isIn($entry['ssid'],$_INPUT['ssid']) &&
        isIn($entry['svid'],$_INPUT['svid'])
    ) { 
        $result[$i] = $entry;
        $i ++;
    }
}
*/

$result = searchHCL($hcl,$_INPUT);

$result = array_slice($result,0,50);

print_r($result);


?>
