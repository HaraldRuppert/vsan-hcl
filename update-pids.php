<?php
$hcl = file_get_contents("all.json");
$hcl = json_decode($hcl,TRUE);

$hdd = $hcl['data']['hdd'];


$hdd2pid = array();

foreach ($hdd as $item) {
	$data = file($item['vcglink']);
	$pattern = '/<th>Product Id:<\/th><td>(.+)<\/td>/';
	$matches = preg_grep($pattern,$data);
	$matches = array_values($matches);
	preg_match($pattern,$matches[0],$pid);

	if(strlen($pid[1]) > 5)
		$sshd2pid[$item['id']] = $pid[1];
	else
		$sshd2pid[$item['id']] = $item['model'];
}

$ssd = $hcl['data']['ssd'];

foreach ($ssd as $item) {
	$data = file($item['vcglink']);
	$pattern = '/<th>Product Id:<\/th><td>(.+)<\/td>/';
	$matches = preg_grep($pattern,$data);
	$matches = array_values($matches);
	preg_match($pattern,$matches[0],$pid);
	$sshd2pid[$item['id']] = $pid[1];

	if(strlen($pid[1]) > 5)
		$sshd2pid[$item['id']] = $pid[1];
	else
		$sshd2pid[$item['id']] = $item['model'];

}



$fp = fopen("sshd2pid.json","w+");
fwrite($fp,json_encode($sshd2pid));
fclose($fp);

?>
