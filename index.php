<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

$fp = fopen("all.json","r");
$str = fread($fp,100);
fclose($fp);
$json_changed = explode('"',$str);
$json_changed = $json_changed[5];
$json_updated = filemtime("all.json");
unset($str);
?>
<html lang="en-US">
<head>
<title>vSAN HCL viewer</title>
<script src="jquery-3.2.1.min.js"></script>
<script src="functions.js?v=<?php echo date("Ymd").rand(1,99)?>"></script>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="banner">&bull;vSAN HCL&bull;</div>
<div class="subbanner">Harald's Compatibility List</div>
<form name="data" id="formInput">

<select name="type" onchange="refreshList()">
    <option value="controller" <?php if ($_GET['type'] == 'controller') echo 'selected';?>>Controller</option>
    <option value="ssd"  <?php if ($_GET['type'] == 'ssd') echo 'selected';?>>SSD</option>
    <option value="hdd"  <?php if ($_GET['type'] == 'hdd') echo 'selected';?>>HDD</option>
</select>


<label for="txModel">Model</label>
<input type="text" id="txModel" name="model" class="searchtext">

<label for="txVendor">Vendor</label>
<input type="text" id="txVendor" name="vendor" class="searchtext">

<label for="txVID">VID</label>
<input type="text" id="txVID" name="vid" size="5" class="searchtext">

<label for="txDID">DID</label>
<input type="text" id="txDID" name="did" size="5" class="searchtext">

<label for="txSVID">SVID</label>
<input type="text" id="txSVID" name="svid" size="5" class="searchtext">

<label for="txSSID">SSID</label>
<input type="text" id="txSSID" name="ssid" size="5" class="searchtext">

<input type="hidden" name="id" value="<?php echo $_GET['id']?>">
<input type="hidden" name="release" value="<?php echo $_GET['release']?>">

</form>
<a href="index.php">restart</a></br></br>
<div id="divList"></div>
<script type="text/javascript">
 $("form :input").each(function(index, elem) {
    var eId = $(elem).attr("id");
    var label = null;
    if (eId && (label = $(elem).parents("form").find("label[for="+eId+"]")).length == 1) {
        $(elem).attr("placeholder", $(label).html());
        $(label).remove();
    }
 });

refreshList();
</script>
</br>
vSAN HCL viewer &copy; 2017 Harald Ruppert
<a href="https://twitter.com/HaraldRuppert"><img src="img/social-1_logo-twitter.svg" height="16" width="16"></a>
<a href="https://www.linkedin.com/in/harald-ruppert-10967812b"><img src="img/social-1_logo-linkedin.svg" height="16" width="16"></a></br>
data based on <a href="http://vmwa.re/vsanhcljson">http://vmwa.re/vsanhcljson</a> &copy; VMware Inc.</br>
Last change in data: <?php echo $json_changed;?>, last updated: <?php echo gmdate("F j, Y, g:i A T",$json_updated)?></br>
</body>
</html>
