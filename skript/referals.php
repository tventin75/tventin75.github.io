<? require 'header.php';

if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{


						$refmoney = mysqli_fetch_array(mysqli_query($db, "select * from settings where `set` = 'refmoney'"));
						$ref_bon = $refmoney['value'];
						$ref_bon24 = $ref_bon * 24;
?>
       
    <!-- Begin Menu -->
	


<section class="home boxed-mini">
		<div class="section-header">
      <h1 class="title"><span class="title-highlight">Рефералы</span></h1>
      <p>Приглашайте на проект своих друзей и знакомых, Вы будете получать по <? echo''.$ref_bon.'';?> Руб за каждый бонус!<br>А это до <? echo''.$ref_bon24.'';?> Руб в сутки с каждого реферала!<br>
Привлекайте рекламодателей и получайте 1% с заказа рекламы.<br>
Ниже представлена ссылка для привлечения и количество приглашенных Вами людей.</p>
      
		</div> <!-- /.section-header -->
	</section>
 





<?
$user = $_SESSION["username"];
$user_row = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$user'"));
$id = $user_row["id"];
		$user = $_SESSION["username"];
  		$fefef = mysqli_query($db, "select * from users where email = '$user'");
		$ffaa = mysqli_fetch_array($fefef);
		$id=$ffaa['id'];
  		$qw = mysqli_query($db, "select * from users where referer = '$id'");
		$ss = mysqli_num_rows($qw);
?>

<section class="features boxed-mini">
    <div class="container">
            Количество Ваших рефералов: <strong><? echo ''.$ss.'';?> чел.</strong><br>
			<p>Ваша реферальная ссылка: <div class="qotref"><strong><code>http://moysite.ru/?i=</code><?echo ''.$id.'';?></strong></div><br>			
        

		
		<h3 style="clear: both; padding: 30px 0;">Реферальные баннеры 468Х60:</h3>
		
     <div class="l">
	 <img src="/images/ref-banner2.gif"><br>
	 <p>Ваш реферальный код этого баннера:</p>
	 <div class="qotref">
	 <strong><code>&#60;a href=&#34;http://moysite.ru/?i=</code><?echo ''.$id.'';?><br><code>&#34;&#62;&#60;img src=&#34;http://moysite.ru/images/ref-banner2.gif&#34;&#62;&#60;/a&#62;</code></strong>
	 </div>
	 </div>
	 
      <div class="l">
	 <img src="/images/ref-banner1.gif"><br>
	 <p>Ваш реферальный код этого баннера:</p>
<div class="qotref">	 
	 <strong><code>&#60;a href=&#34;http://moysite.ru/?i=</code><?echo ''.$id.'';?><br><code>&#34;&#62;&#60;img src=&#34;http://moysite.ru/images/ref-banner1.gif&#34;&#62;&#60;/a&#62;</code></strong>	 
	 </div>
	 </div>
	  

 <h3 style="clear: both; padding: 30px 0;">Статистика рефералов:</h3>    
	  </p><div id="adverst-grid" class="grid-view">

<table class="items">
<thead>
<tr bgcolor="#c7c7ff" height="25" valign="middle" align="center">
<th id="adverst-grid_c0">Логин</th>
<th id="adverst-grid_c1">Дата регистрации</th>
<th id="adverst-grid_c2">Доход от партнера</th></tr>
</thead>
<tbody>
  <?
  
		$user = $_SESSION["username"];
  		$fefef = mysqli_query($db, "select * from users where email = '$user'");
		$ffaa = mysqli_fetch_array($fefef);
		$id=$ffaa['id'];
  		$qw = mysqli_query($db, "select * from users where referer = '$id' ORDER BY `datereg` DESC ");
		$ss = mysqli_num_rows($qw);
					if ($ss > 0) {
													
									while ($user_row = mysqli_fetch_array($qw)) {
								
								
									echo '
						<tr class="htt">
							<td align="center">'.$user_row['login'].'</a></td>
							<td align="center">'.date('d.m.Y H:i:s', $user_row['datereg']).'</td>
							<td align="center">'.$user_row['refmoney'].'</td>
						</tr>';
								}

						?>

<?
		}else{
  ?>
  
<tr><td align="center" colspan="3">У вас нет рефералов</td></tr>
  
  <?}?>



</tbody>
</table>



<div class="keys" style="display:none" title="/referrals.php"></div>
</div>    </div>
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