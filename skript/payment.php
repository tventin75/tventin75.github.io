<? require 'header.php';
if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
$min = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'min_pay'"));
?>

    
    <!-- Begin Menu -->


			
  <section class="home boxed-mini">
		<div class="section-header">
      <h1 class="title">Вывод <span class="title-highlight">средств</span></h1>
      <p>
        Минимальная сумма для вывода <? echo''.$min['value'].'';?> руб.
      </p>
    <b><font color="black">Выплаты осуществляются в автоматическом режиме и только на платежную систему PAYEER!</font></b> <br><br>
  
		</div> <!-- /.section-header -->
	</section>

<div class="container">
  <section class="features boxed-mini">
    <div class="container">
            

      <div class="form-page"> 
            <?
$user = $_SESSION["username"];
$user_row = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$user'"));
$blnc = round($user_row["money"],2);
$purse = $user_row["purse"];
$login = $user_row["login"];
$summa = (isset($_POST["sum"])) ? text($_POST["sum"], $db) : false;
$t = time();

			if (isset($_POST['purse'])) {
				$min = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'min_pay'"));
				if ($summa < 0) {
				echo '<div class="ui error message" style="display: block">А почему отрицательное?</div>';
				}else{
			if ($summa <= $blnc) {
				if ($summa >= $min['value']) {
					$sett_row_accountNumber = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'accountNumber'"));
					$sett_row_apiId = mysqli_fetch_array(mysqli_query($db, "select * from settings where `set` = 'apiId'"));
					$sett_row_apiKey = mysqli_fetch_array(mysqli_query($db, "select * from settings where `set` = 'apiKey'"));
				
					require_once('cpayeer.php');
					$accountNumber = $sett_row_accountNumber['value']; 
					$apiId = $sett_row_apiId['value'];
					$apiKey = $sett_row_apiKey['value'];
					$payeer = new CPayeer($accountNumber, $apiId, $apiKey);
					if ($payeer->isAuth())
					{
						$initOutput = $payeer->initOutput(array(
							'ps' => '1136053',
							//'sumIn' => 1,        
							'curIn' => 'RUB',
							'sumOut' => $summa, 
							'curOut' => 'RUB',  
							'param_ACCOUNT_NUMBER' => $user_row['purse']
						));
						
						if ($initOutput){
							$historyId = $payeer->output();
							if ($historyId > 0){
								echo '<div class="ui success message" style="display: block">Выплата успешна!!!</div>';
								mysqli_query($db, "update users set money = money - '".$summa."' where email = '".$user."'");
								mysqli_query($db, "insert into spviplat (payeer,login,sum,time) values ('$purse','$login','$summa','$t')");
							}else{
								echo '<pre>'.print_r($payeer->getErrors(), true).'</pre>';
							}
						}else{
							echo '<pre>'.print_r($payeer->getErrors(), true).'</pre>';
						}
					}else{
						echo '<pre>'.print_r($payeer->getErrors(), true).'</pre>';
					}
				}else{
					echo '<div class="ui error message" style="display: block">Ошибка, минимум для выплаты '.$min['value'].'</div>';
				}
			}else{
					echo '<div class="ui error message" style="display: block">Нельзя вывести больше чем есть!</div>';
				}
			}		
		}
?>
<center><h4 class="title"><span class="title-highlight">
Баланс: <?echo ''.$blnc.'';?> руб.</span></h4></center>


    <form class="ui large form" action="" method="post">
        <div class="field">
         Ваш кошелек Payeer 
          <div class="ui left input">
        <b><?echo ''.$purse.'';?></b>        
		</div>
                    </div>

        <div class="field field-wallet">
          Введите сумму (Мин. <?echo''.$min['value'].'';?> Руб.)        
		  <div class="ui left input">
            <input type="text" name="sum" id="sum" value="0" size="15">        
			</div>
                    </div>

        <div style="text-align: center">
          <input type="submit" name="purse" value="Получить выплату" class="ui fluid large primary submit button">
        </div>



      </form>      </div>
      
      
    </div>
  </section>
</div>











 <section class="overview boxed-mini">
		<div class="section-header">
      <h4 class="title">История <span class="title-highlight">выплат</span></h4>
      
		</div> <!-- /.section-header -->
    <div class="container">
      <div id="payment-grid" class="grid-view">
<table class="items">
<thead>
<tr>

<th id="payment-grid_c1"><a class="sort-link" href="/index.php/payout?Payments_sort=amount">Сумма</a></th>
<th id="payment-grid_c2"><a class="sort-link" href="/index.php/payout?Payments_sort=system">Платежная система</a></th>
<th id="payment-grid_c3"><a class="sort-link" href="/index.php/payout?Payments_sort=wallet">Кошелек</a></th>
<th id="payment-grid_c4"><a class="sort-link" href="/index.php/payout?Payments_sort=state">Статус</a></th>

<th id="payment-grid_c6"><a class="sort-link" href="/index.php/payout?Payments_sort=time">Время</a></th>

</tr></thead>
  <tbody>
  <?
		$user = $_SESSION["username"];
		$userow = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$user'"));
		$login = $userow["login"];
  		$q = mysqli_query($db, "select * from spviplat where login = '$login' order by id desc");
		$s = mysqli_num_rows($q);
		if ($s > 0){
		while ($user_row = mysqli_fetch_array($q)) {
			echo '<tr>
				<td>'.$user_row['sum'].'</td><td>PAYEER</td><td>'.substr($user_row['payeer'], 0, -2).'XX</td><td>Выплачено</td><td>'.date('d.m.Y H:i:s', $user_row['time']).'</td>
				</tr>';
		}
		}else{
  ?>
  
  <tr><td align="center" colspan="5">Нет записей</td></tr>
  
  <?}?>
  
  </tbody></table>
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