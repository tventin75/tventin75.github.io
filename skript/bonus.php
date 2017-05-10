<? require 'header.php';

if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
?>
    
    
    <!-- Begin Menu -->




<script type="text/javascript">
function setRate(id)
{
 // Отсылаем паметры
 $.ajax({
 type: "POST",
 url: "/ajax/go.php",
 data: "id=" + id,
 //При удачном завершение запроса - выводим то, что нам вернул PHP
 success: function(html) {
 //предварительно очищаем нужный элемент страницы
 $("#response").empty();
//и выводим ответ php скрипта
 $("#response").append(html);
 }
 });

}
</script>


  <section class="home boxed-mini">
  <div class="container">

    <p style="text-align: center;">Нажмите по одному из баннеров, для получения бонуса.<br>Рекламный сайт будет открыт в новой вкладке.<br>
<br>
    <a href="/adv.php" class="ui massive primary button">Разместить баннер</a>
    </p>
	
<?
$email = $_SESSION['username'];
$user_row = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$email'"));
$wait = mysqli_fetch_array(mysqli_query($db, "select * from settings where `set` = 'wait'"));
$timech = time(); // время сейчас в сайтстамп
$tmm = $timech - $user_row['time']; // время сейчас - время получения бонуса = прошедшее время
$rtt =  $wait['value'] - $tmm; // время до получения
if ($rtt > 0) {
				?>
				<script type="text/javascript"> 
					setTimeout('location.replace("/")',1000); 
				</script> 
				<noscript> 
					<meta http-equiv="refresh" content="1; url=/"> 
				</noscript>
				<?
			}else{

if(count($_POST) > 0)
				{
				$colvkopeek = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'colvkopeek'"));
				$colvkop = $colvkopeek['value'];
				$chislo = mt_rand(1,30); //$colvkop рандом копееки до 11 копеек
				$money = ($chislo / 100);
				$user = $_SESSION["username"];
				$user_row = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$user'"));
				$login = $user_row["login"];
				$t = time();
				$refmoney = mysqli_fetch_array(mysqli_query($db, "select * from settings where `set` = 'refmoney'"));
				$ref_bon = $refmoney['value'];
				mysqli_query($db, "insert into sp (payeer,sum,time) values ('$login','$money','$t')");
				mysqli_query($db, "update users set money = money + '$money', kolv = kolv + 1, refmoney = refmoney + 0, time = '$t' where  login = '$login'");
					if ($user_row['referer'] > 0) {
						$refmoney = mysqli_fetch_array(mysqli_query($db, "select * from settings where `set` = 'refmoney'"));
						$ref_bon = $refmoney['value'];
						mysqli_query($db, "update users set money = money + '$ref_bon' where id = '".$user_row['referer']."'");
						mysqli_query($db, "update users set refmoney = refmoney + '$ref_bon' where id = '".$user_row['id']."'");
					}
				echo '<div id="response"><center><b><font color="green">Ваш бонус - '.$money.' Руб!</font></b></center></div><p></p>';
				?>
				<script type="text/javascript"> 
					setTimeout('location.replace("/")',5000); 
				</script> 
				<noscript> 
					<meta http-equiv="refresh" content="5; url=/"> 
				</noscript>
<?
				}
					}
?>
	


<center>
<table align="center" width="70%">	






<tbody>
<?
if ($rtt < 0) {
?>



		<?
  $res=mysqli_query($db, "select * from banners");
  if (mysqli_num_rows($res) > 0){

?>
<form method="POST"><tr>
<?

			$res1=mysqli_query($db, "select * from banners where count_linkbof < count_linkb ORDER BY  `banners`.`go_amount` DESC ");
			while($row1=mysqli_fetch_assoc($res1)){
			
			echo '
<td align="center">
<input value="" style="background: url('.$row1["urlban"].'); width: 468px; height: 60px; border:1px solid black; margin-top: 5px; margin-bottom: 5px;" type="submit" name="cool" onclick="window.open(\'gobanner.php/?id='.$row1["id"].'\');">
<input value="1" type="hidden">
</td>';

?>
</tr>	
</form>
<?
			}
		}

}else{
echo '<div class="ui error message" style="display: block">Вы получали бонус недавно!!!</div>';
}?>

<tr>
<td align="center">
<br>
<!--<b><font color="red">Не оплачиваемая реклама!</font></b>-->
</td>
</tr>
<tr>
<td align="center">

</td>
</tr>
</tbody></table>

</center>
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