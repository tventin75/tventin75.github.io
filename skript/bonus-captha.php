<? require 'header.php';

if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
?>
    
    
    <!-- Begin Menu -->



  <section class="home boxed-mini">
  <div class="container">

    <p style="text-align: center;">Получите бонус пройдя капчу! Раз в 24 часа!<br>
	Бонус фиксированный - 0.5 - 5руб. Реферальный бонус 0.1руб.
<br>
    </p>
	

<!--бонус-->
<?
$email = $_SESSION['username'];
$user_rowc = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$email'"));
$timech = time(); // время сейчас в сайтстамп
$tmm = $timech - $user_rowc['timecap']; // время сейчас - время получения бонуса = прошедшее время
$rtt =  86400 - $tmm; // время до получения
if ($rtt < 0) {




		if (isset($_POST['moneycaptcha_code'])) {
				$handle = curl_init();
				curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1); 
				curl_setopt($handle, CURLOPT_URL, "https://moneycaptcha.ru/valid.php?code=$_POST[moneycaptcha_code]"); 
				curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); 
				$status = curl_exec($handle);
				if ( $status === false ) echo "<br>" . curl_error($handle);
				curl_close($handle);
				$xml = simplexml_load_string($status);

				if($xml->code == "1"){
					$chislo = mt_rand(50,99);
					$money = ($chislo / 100);
					$user = $_SESSION["username"];
					$user_row = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$user'"));
					$login = $user_row["login"];
					$t = time();

					$ref_bon = 0.1;
					mysqli_query($db, "insert into sp (payeer,sum,time) values ('$login','$money','$t')");
					mysqli_query($db, "update users set money = money + '$money', kolv = kolv + 1, refmoney = refmoney + 0, timecap = '$t' where  login = '$login'");
						if ($user_row['referer'] > 0) {
							$ref_bon = 0.1;
							mysqli_query($db, "update users set money = money + '$ref_bon' where id = '".$user_row['referer']."'");
							mysqli_query($db, "update users set refmoney = refmoney + '$ref_bon' where id = '".$user_row['id']."'");
						}
							echo '<div id="response"><center><b><font color="green">Ваш бонус - '.$money.' Руб!</font></b></center></div><p></p>';
					}
				}else{
			?>
			
		<div id="money_captcha_wrapper" class="money_captcha_wrapper">
			<script type="text/javascript" src="https://moneycaptcha.ru/captcha.php?siteid=33103&charset=utf-8&button=moneycaptchasubmit"></script>
			</div>
			<center>
			<form method = 'POST' action = ''>
									<td align='center' >
										<input name="moneycaptcha_code" id="moneycaptcha_code" type="hidden" value="">
										<input type="submit" id="moneycaptchasubmit" disabled="true" value="Получить бонус" title="Вам необходимо правильно ответить на капчу">
									</td>
			 </form>
			 </center>
			 <?}}else{
			 echo '<center><div class="ui error message" style="width: 300px; display: block">Вы получали бонус недавно!!!</div></center>';
			 }?>
<!--бонус-->
  </div>
  
</section>
<?}?>
<? require 'footer.php';?>