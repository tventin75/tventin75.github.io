<? require 'header.php';
if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
	$idpay = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM  `inserts` ORDER BY  `inserts`.`id` DESC LIMIT 1"));

$last_id = $idpay["id"] + 1;
?>

    
    <!-- Begin Menu -->



<section class="home boxed" style="padding-bottom: 0;">
		<div class="section-header">
      <h1 class="title">Пополнение <span class="title-highlight">баланса</span></h1>
	  <?
	  	$user = $_SESSION["username"];
		$user_row = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$user'"));
		$reclmoney = round($user_row["reclmoney"],2);
			echo '<p>Баланс для рекламы: '.$reclmoney.' руб.</p>';
?>
        		</div> <!-- /.section-header -->
	</section>
<section class="features boxed-mini">

<div class="form-page"> 
   <center>
   <?
	if (isset($_POST['sum'])) {
		$sum = floatval($_POST['sum']);
		$shop = mysqli_fetch_array(mysqli_query($db, "select * from settings where `set` = 'm_shop'"));
		$m_shop = $shop['value'];
		$m_amount = number_format($sum, 2, '.', '');
		$m_curr = 'RUB';
		$m_desc = base64_encode('Оплата рекламного баланса');
		$key = mysqli_fetch_array(mysqli_query($db, "select * from settings where `set` = 'm_key'"));
		$m_key = $key['value'];
		$dateinsert = time();
		$hash = rand_str(5);
		mysqli_query($db,"insert into inserts (user_id,sum,hash,dateinsert) values ('".$user_row['id']."','$m_amount','$hash','$dateinsert')");
		$now_id = mysqli_result(mysqli_query($db, "select id from inserts where user_id = '".$user_row['id']."' and hash = '$hash' order by id desc limit 1"));
		
		$m_orderid = $now_id;
		$arHash = array(
			$m_shop,
			$m_orderid,
			$m_amount,
			$m_curr,
			$m_desc,
			$m_key
		);
		$sign = strtoupper(hash('sha256', implode(':', $arHash)));
		?>
		<form method="GET" action="https://payeer.com/merchant/">
			<input type="hidden" name="m_shop" value="<?=$m_shop?>">
			<input type="hidden" name="m_orderid" value="<?=$m_orderid?>">
			<input type="hidden" name="m_amount" value="<?=$m_amount?>">
			<input type="hidden" name="m_curr" value="<?=$m_curr?>">
			<input type="hidden" name="m_desc" value="<?=$m_desc?>">
			<input type="hidden" name="m_sign" value="<?=$sign?>">
			<input type="hidden" name="m_process" value="send" />
			<input type="submit" name="m_process" value="Оплатить Payeer" style="width: 240px" class="button red" />
		</form>
		
		
		<!-- пополнение вебмани-->
	<div class="wm-intro">	

<form method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp">
<input type="hidden" name="LMI_PAYMENT_NO" value="<?php echo $last_id; ?>">
<input type="hidden" name="LMI_PAYMENT_AMOUNT" id="wm_summ" value="<?=$m_amount?>">
<input type="hidden" name="LMI_PAYMENT_DESC" value="<?php echo "Popolnenie balansa - USER ";?><?php echo $user ;?>">
<input type="hidden" name="LMI_PAYEE_PURSE" value="R466764654786">
<input type="hidden" name="name_user" value="<?php echo $user ;?>">
<input type="submit" value="Оплатить WebMoney" style="width: 240px;" class="button red" />

</form>
</div>
<!-- пополнение вебмани-->
		</center>
	<?
	}else{
	?>
<form class="ui large form" method="POST" action="">
	<input type="hidden" name="m" value="">
	Введите сумму:<br>
	
	<input type="text" value="100" name="sum" size="7" id="psevdo"> <br><br>
	<input type="submit" class="button red" id="submit" value="Пополнить баланс">
</form> 
   <?}?>
    </div>
  </section>
 







 <section class="overview boxed-mini">
		<div class="section-header">
      <h4 class="title">История <span class="title-highlight">пополнений</span></h4>
      
		</div> <!-- /.section-header -->
    <div class="container">
      <div id="payment-grid" class="grid-view">
<table class="items">

 <?
  
		$user = $_SESSION["username"];
  		$fefef = mysqli_query($db, "select * from users where email = '$user'");
		$ffaa = mysqli_fetch_array($fefef);
		$id=$ffaa['id'];
		$inserts = mysqli_query($db, "select * from inserts where user_id = '$id' order by id DESC");
		$ss = mysqli_num_rows($inserts);
		if ($ss > 0) {
							
							
							echo '<thead>
										<tr>
											<th id="payment-grid_c1"><a class="sort-link">ID</a></th>
											<th id="payment-grid_c2"><a class="sort-link">Сумма</a></th>
											<th id="payment-grid_c3"><a class="sort-link">Дата</a></th>
											<th id="payment-grid_c4"><a class="sort-link">Статус</a></th>
										</tr>
								</thead>';
		
								while ($user_row = mysqli_fetch_array($inserts)) {
									echo '
								<tbody>
										<tr class="odd">
											<td>'.$user_row['id'].'</td>
											<td>'.$user_row['sum'].'</td>
											<td>'.date('d.m.Y H:i:s', $user_row['dateinsert']).'</td>';
											
							if ($user_row['status'] > 0){
								echo '<td><img src="/images/yes.png"> </td>
										</tr>
								</tbody>';
								}else{
								echo '<td><img src="/images/no.png"> </td>
										</tr>
								</tbody>';
							}		
											
								}

						?>

<?
		}else{
  ?>
<thead>
    <tr><td align="center" colspan="5">Пополнений баланса не было</td></tr>  
</thead>
<?}?>

</table>
</div>    
</div>
  </section>

<?
}else{
?>
				<script type="text/javascript">
				location.replace("/login.php");
				</script>
				<noscript>
				<meta http-equiv="refresh" content="0; url=/login.php">
				</noscript>

<?}?>

<? require 'footer.php';?>