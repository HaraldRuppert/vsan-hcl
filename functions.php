<?php
function isIn($where,$what) {

	if(strlen($where) > 0) {
		if(preg_match("/".$what."/i",$where)) {
			return true;
		}
		else {
			return stripos($where,$what);
		}
	}
	else {
		if(empty($what)) {
			return true;
		}
	}
}	
function releases($releases,$id,$type) {
	reset($releases);
	foreach($releases as $esx => $content) {
		$str .= '<a href="?id='.$id.'&release='.$esx.'&type='.$type.'">'.preg_replace('/vSAN|ESXi|ESX/','',$esx).'</a>, ';
	}

	return rtrim($str,', ');
}

function searchHCL($hcl,$_INPUT,$sshd2pid) {
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
	        isIn($entry['svid'],$_INPUT['svid']) &&
			$entry['model'] != NULL
	    ) {
	        $result[$i] = $entry;
	        $i ++;
	    }
	}
	return $result;
}

?>
