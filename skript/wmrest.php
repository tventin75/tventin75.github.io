<?php
// ���� ��� ����� ���������������� �������, �� ���� ������...
IF($_POST['LMI_PREREQUEST']==1) {

  // ���������, �� ��������� �� ������� ��������.
  // C��������� ��� ��������� ������� � ��� ���������, ������� ������� ��� ���������.
  // ���� �������� �� ���������, �� ������� ������ � ��������� ������ �������.
  if(trim($_POST['LMI_PAYEE_PURSE'])!="R001174399346") {
    echo "ERR: �������� ������� ���������� ".$_POST['LMI_PAYEE_PURSE'];
    exit;
  }
  // ���� ������ �� �������� � �� ����� �� ����� �����, �� ������� YES
  echo "YES";
}

ELSE {

# ���� ������
$db = mysqli_connect('localhost', '������������', '������', '����');

  // �������� ������
  $secret_key="Gfddfr54Grjr6";
  $common_string = $_POST['LMI_PAYEE_PURSE'].$_POST['LMI_PAYMENT_AMOUNT'].$_POST['LMI_PAYMENT_NO'].
     $_POST['LMI_MODE'].$_POST['LMI_SYS_INVS_NO'].$_POST['LMI_SYS_TRANS_NO'].
     $_POST['LMI_SYS_TRANS_DATE'].$secret_key.$_POST['LMI_PAYER_PURSE'].$_POST['LMI_PAYER_WM'];
  $hash = strtoupper(hash('sha256', $common_string));
  if($hash!=$_POST['LMI_HASH']) exit;
  // �� �����, ��������� � ����� � ����
  $sum = $_POST['LMI_PAYMENT_AMOUNT'];
  $ik_payment_amount = $sum;
  $id_user = (int)$_POST['id_user'];
  $user_id = $id_user;
  $u_name = $_POST['name_user'];
  
  $id = $_POST['LMI_PAYMENT_NO'];
  $res = mysqli_query($db, "select user_id,sum from inserts where id = '$id' and status = '0' limit 1");
  $rr = mysqli_fetch_array($res);
  
				mysqli_query($db, "update users set reclmoney = reclmoney + '".$rr['sum']."' where id = '".$rr['user_id']."'");
				mysqli_query($db, "update inserts set status = '1' where id = '$id'");  
  
 
  
}