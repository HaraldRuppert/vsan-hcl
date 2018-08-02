<?php
require('functions.php');
require('common.php');

if($_INPUT['id'] > 0) $showDetails = TRUE;
else $showDetails = FALSE;

$result = searchHCL($hcl,$_INPUT,$sshd2pid);

$result = array_slice($result,0,50);



?>
<table>
<tr class="row">
<th>Model</th><th>Vendor</th><th>VID</th><th>DID</th><th>SVID</th><th>SSID</th><th>Releases</th><th>VMware HCL</th>
</tr>
<?php
foreach($result as $line) {
	echo '
	<tr class="row">
		<td class="datafield">'.substr(str_replace(' ','&nbsp;',$line['model']),0,100).'</td>
		<td>'.str_replace(' ','&nbsp;',$line['vendor']).'</td>
		<td>'.$line['vid'].'</td>
		<td>'.$line['did'].'</td>
        <td>'.$line['svid'].'</td>
		<td>'.$line['ssid'].'</td>
		<td>'.releases($line['releases'],$line['id'],$_INPUT['type']).'</td>
		<td><a href="'.$line['vcglink'].'" target="_blank">go &gt;&gt;</a></td>
	</tr>';
}
if ($_INPUT['release'] != "" && $_INPUT['id'] > 0) {
	?>
	</table>
	</br></br>
	<div id="configHeadline">Configurations:<br/></div>
	<ul>
	<li>Release: <?php echo $_INPUT['release']?></li>
	<?php
	$key =  array_search($_INPUT['id'], array_column($hcl, 'id'));
	//echo $key;
	foreach ($hcl[$key]['releases'][$_INPUT['release']]['vsanSupport'] as $config) {
			echo '<li>'.$config . '</li>';
	}

	$driverName = array_keys($hcl[$key]['releases'][$_INPUT['release']]);
	$driverName = $driverName[1];

	if(strlen($driverName) > 2) {

		?>
		<table>
			<tr>
				<th>&nbsp;Driver&nbsp;</th><th>&nbsp;Type&nbsp;</th><th>&nbsp;Firmware&nbsp;</th><th>&nbsp;Download&nbsp;</th>
			</tr>
		<?php
		$driverName = array_keys($hcl[$key]['releases'][$_INPUT['release']]);
		$driverName = $driverName[1];
		foreach($hcl[$key]['releases'][$_INPUT['release']][$driverName] as $driverVersion => $driverDetails) {
            $driverLink = explode(',',$driverDetails['downloadlink']);
			$driverLink = $driverLink[0];
			$driverLink = substr($driverLink, strpos($driverLink, ":") + 1);		
	
			echo '<tr>
				<td>'.$driverName . ' ' . $driverVersion.'</td>
		        <td>'.$driverDetails['type'].'</td>
		        <td>'.$driverDetails['firmware'].'</td>
		        <td><a href="'.$driverLink.'" target="_blank">Download</a></td>
			';
		}
	}
	elseif($hcl[$key]['releases'][$_INPUT['release']][0]['firmware']) {
        ?>
        <table>
            <tr>
                <th>&nbsp;Min. Firmware&nbsp;</th><th>&nbsp;Device Type&nbsp;</th><th>&nbsp;Additional Information&nbsp;</th>
            </tr>
        <?php
	    echo '<tr>
    	<td>'.$hcl[$key]['releases'][$_INPUT['release']][0]['firmware'].'</td>
		<td>'.$hcl[$key]['releases'][$_INPUT['release']][0]['devicetype'].'</td>
		<td>'.$hcl[$key]['model'].'</td>';
	
	}
}
?>
	</table>
</ul>
