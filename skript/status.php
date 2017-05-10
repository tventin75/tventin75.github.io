<?php
include 'config.php';

if (isset($_POST['m_operation_id']) && isset($_POST['m_sign']))
{
	$key = mysqli_fetch_array(mysqli_query($db, "select * from settings where `set` = 'm_key'"));
	$m_key = $key['value'];
	$arHash = array($_POST['m_operation_id'],
			$_POST['m_operation_ps'],
			$_POST['m_operation_date'],
			$_POST['m_operation_pay_date'],
			$_POST['m_shop'],
			$_POST['m_orderid'],
			$_POST['m_amount'],
			$_POST['m_curr'],
			$_POST['m_desc'],
			$_POST['m_status'],
			$m_key);
	$sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
	if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success')
	{
		$id = intval($_POST['m_orderid']);
		$res = mysqli_query($db, "select user_id,sum from inserts where id = '$id' and status = '0' limit 1");
		if (mysqli_num_rows($res) == 1) {
			$rr = mysqli_fetch_array($res);
			if ($_POST['m_amount'] == $rr['sum']) {
				$user_res = mysqli_fetch_assoc(mysqli_query($db, "select * from users where id = '".$rr['user_id']."'"));
				$t = time();
				
				mysqli_query($db, "update users set reclmoney = reclmoney + '".$rr['sum']."' where id = '".$rr['user_id']."'");
				mysqli_query($db, "update inserts set status = '1' where id = '$id'");
				echo $_POST['m_orderid'].'|success';
				exit;
			}else{
				echo $_POST['m_orderid'].'|error';
				exit;
			}
		}else{
			echo $_POST['m_orderid'].'|error';
			exit;
		}
	}
	echo $_POST['m_orderid'].'|error';
}
?>