<? require 'header.php';
if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
?>
        <!-- Begin Menu -->


  <section class="home boxed-mini">
		<div class="section-header">
      <h1 class="title">Выберите тип <span class="title-highlight">рекламы</span></h1>
  <?
  		$user = $_SESSION["username"];
		$user_row = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$user'"));
		$reclmoney = round($user_row["reclmoney"],2);
	?>
    <b><font color="black">Рекламный баланс: <a href="insert.php"><?echo''.$reclmoney.''?></a> рублей</font></b> <br><br>
	<script>
	$(document).ready(function(){
		$('[name="adv_toggle_b"]').click(function(){
			if ($("#adv_banner").css("display") == "none") {
				$("#adv_banner").slideDown(300);
				$("#adv_links").slideUp(300);
			}else{
				$("#adv_banner").slideUp(300);
			}
			return false;
		});
		
		$('[name="adv_toggle_l"]').click(function(){
			if ($("#adv_links").css("display") == "none") {
				$("#adv_links").slideDown(300);
				$("#adv_banner").slideUp(300);
			}else{
				$("#adv_links").slideUp(300);
			}
			return false;
		});
	});
	</script>

<center>
<a href="#" name="adv_toggle_b" class="button">Баннерная реклама</a>
<a href="#" name="adv_toggle_l" class="button">Контекстная реклама</a>
</center>
		</div> <!-- /.section-header -->
	</section>
<div class="container">
  <section class="features boxed-mini">
  <?
  //заказ ссылок
  		if (isset($_POST['url_link'])) {
		$url_link = (isset($_POST["url_link"])) ? text($_POST["url_link"], $db) : false;
		$text_link = (isset($_POST["text_link"])) ? text($_POST["text_link"], $db) : false;
		$count_link = (isset($_POST["count_link"])) ? text($_POST["count_link"], $db) : false;
		$t = time();
        $pricelinkk = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'pricelink'"));
		$count_linkkk = $pricelinkk['value'];
		$balance = $count_linkkk * $count_link;
		
		$user = $_SESSION["username"];
		$user_row = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$user'"));
		$reclmoney = round($user_row["reclmoney"],2);
		$id = $user_row["id"];
		$count_linkbd = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'count_link'"));
		$count_linkb = $count_linkbd['value'];
		
		
			if($url_link==NULL){
				echo '<center><b><font color="red">Поле url не заполнено!!!</font></b></center>';
		}else{
				  if($text_link==NULL){
				  echo '<center><b><font color="red">Поле заголовок не заполнено!!!</font></b></center>';
		}else{
					  if($count_link==NULL){
					  echo '<center><b><font color="red">Поле число показов не заполнено!!!</font></b></center>';
		}else{
		
		
					if ($reclmoney < $balance){
						echo'<center><b><font color="red">Недостаточно средств на рекламном балансе &gt; <a href="/insert.php">пополнить</a></font></b></center>';
						}else{
							if ($count_link < $count_linkb){
								echo'<center><b><font color="red">Количество показов не может быть меньше '.$count_linkb.'!</font></b></center>';
								}else{
								mysqli_query($db, "update users set reclmoney = reclmoney - '$balance' where id = '$id'");
								mysqli_query($db, "INSERT INTO links (email, title, url, status, balance, time, count_link) VALUES('$user', '$text_link', '$url_link', '1', '$balance', '$t', '$count_link')");
							echo'<center><b><font color="green">Ссылка успешно добавлена!!!</font></b></center>';
						}
					}
				}
			}
		}
	}

	 //заказ баннеров
	
	if (isset($_POST['go_url'])) {
		$go_url = (isset($_POST["go_url"])) ? text($_POST["go_url"], $db) : false;
		$img_url = (isset($_POST["img_url"])) ? text($_POST["img_url"], $db) : false;
		$go_amount = (isset($_POST["go_amount"])) ? text($_POST["go_amount"], $db) : false;
		$count_banner = (isset($_POST["count_banner"])) ? text($_POST["count_banner"], $db) : false;
		$t = time();
        $priceban = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'priceban'"));
		$count_linkkk = $priceban['value'];
		$balance = $count_linkkk * $count_banner; //сумма за баннер * количество из пост запроса = сумма
		
		$user = $_SESSION["username"];
		$user_row = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$user'"));
		$reclmoney = round($user_row["reclmoney"],2); //рекл счет
		$id = $user_row["id"];
		$count_linkbd1 = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'count_ban'"));
		$count_linkb = $count_linkbd1['value']; //число переходов мин
		$count_linkbof = 0;
		
			if($go_url==NULL){
				echo '<center><b><font color="red">Поле url не заполнено!!!</font></b></center>';
		}else{
				  if($img_url==NULL){
				  echo '<center><b><font color="red">Поле url баннера не заполнено</font></b></center>';
		}else{
					  if($go_amount==NULL){
					  echo '<center><b><font color="red">Поле стоимости переходов не заполнено!!!</font></b></center>';
		}else{
						  if($count_banner==NULL){
						  echo '<center><b><font color="red">Поле количество переходов не заполнено!!!</font></b></center>';
		}else{
		
		
					if ($reclmoney < $balance){
						echo'<center><b><font color="red">Недостаточно средств на рекламном балансе &gt; <a href="/insert.php">пополнить</a></font></b></center>';
						}else{
							if ($count_banner < $count_linkb){ // заказ < минимально
								echo'<center><b><font color="red">Количество переходов не может быть меньше '.$count_linkb.'!</font></b></center>';
								}else{
								mysqli_query($db, "update users set reclmoney = reclmoney - '$balance' where id = '$id'");
								mysqli_query($db, "INSERT INTO banners (url, email, urlban, status, balance, time, count_linkb, count_linkbof,go_amount) VALUES('$go_url', '$user', '$img_url', '1', '$balance', '$t', '$count_banner', '$count_linkbof', '$go_amount')");
								echo'<center><b><font color="green">Баннер успешно добавлен!!!</font></b></center>';
							}
						}
					}
				}
			}
		}
	}

		?>
		
			<?
		$count_linkvv = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'count_ban'"));
		$count_linkv = $count_linkvv['value'];
		
		$pricelinkc = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'priceban'"));
		$count_linkkc = $pricelinkc['value'];
		$balance = $count_linkkc * $count_linkv;
		$count_linkkcc = $count_linkkc + 0.01;
		?>

<div id="adv_banner" class="form-pages" style="display: none;">
<form class="ui large form" action="" method="post">
    <div class="ui stacked segment">
<div class="field">
	
		<div style="text-align: center;font-size: 80%;">Url перехода (включая http://)</div>
		<input name="go_url" placeholder="http://..." type="text" style="width:100%;" size="25" maxlength="100" value="">
	
	
		<div style="text-align: center;font-size: 80%;">Url картинки (включая http://)</div>
		<input name="img_url" placeholder="http://..." type="text" style="width:100%;" size="25" maxlength="120" value="">
	
	
		<div style="text-align: center;font-size: 80%;">Стоимость перехода</div>
		<input name="go_amount" type="text" size="25" maxlength="10" style="width:100%;" value="<? echo ''.$count_linkkc.''; ?>">
	
	
		<div style="text-align: center;font-size: 80%;">Количество переходов</div>
		<input name="count_banner" placeholder="<? echo ''.$count_linkv.''; ?>" type="text" style="width:100%;" size="25" maxlength="10" value="">
	
<br>
	<span style="font-size:80%;">
    <br>Рекомендуемая стоимость <span class="link dotted"><? echo ''.$count_linkkcc.''; ?> руб.</span> чтобы баннер был первым. Минимальная стоимость <? echo ''.$count_linkkc.''; ?> руб.
    </span>
    <br><br>
<center><input name="add_banner" type="submit" class="ui fluid large teal submit button" value="Оплатить"></center>
	
	
	
	<?
		$count_linkbd = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'count_link'"));
		$count_linkb = $count_linkbd['value'];
		
		$pricelinkk = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'pricelink'"));
		$count_linkkk = $pricelinkk['value'];
		$balance = $count_linkkk * $count_linkb;
		?>

	
</div></div>
</form>

</div>

<div id="adv_links" class="form-pages" style="display: none;">
<form class="ui large form" action="" method="post">
    <div class="ui stacked segment">

	
		<div style="text-align: center;font-size: 80%;">Url перехода (включая http://)</div>
		<input name="url_link" placeholder="http://..." type="text" style="width:100%;" size="25" maxlength="100" value="">
	
	
		<div style="text-align: center;font-size: 80%;">Рекламный текст</div>
		<input name="text_link" placeholder="Моя реклама" type="text" style="width:100%;" size="25" maxlength="40" value="">
	
	
		<div style="text-align: center;font-size: 80%;">Количество показов</div>
		<input name="count_link" placeholder="<? echo ''.$count_linkb.''; ?>" type="text" style="width:100%;" size="25" maxlength="10" value="">
	<br><br>
	<div style="text-align: center;font-size: 80%;">Стоимость <? echo ''.$count_linkb.' показов = '.$balance.' Руб'; ?>.</div><br>
	<center><input name="add_link" type="submit" class="button red" value="Оплатить"></center>
	
</div>
</form>
</div>
</section>

</div>

  
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