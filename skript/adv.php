<? require 'header.php';

if (isset($_POST['dell_banner_id'])) {

			$dell_banner_id = (isset($_POST["dell_banner_id"])) ? text($_POST["dell_banner_id"], $db) : false;
			$nobanner = mysqli_query($db, "select * from banners where id='$dell_banner_id' and email = '$user'");
			$s = mysqli_num_rows($nobanner);
			if($dell_banner_id==NULL){
					echo '<center><b><font color="red">Какой именно вы баннер удаляете???</font></b></center>';
			}else{
			
			if($nobanner==NULL){
					echo '<center><b><font color="red">Нельзя удалить чужой баннер!!!</font></b></center>';
				}else{
					if ($s==NULL){
					echo '<center><b><font color="red">Такого баннера нет!!!</font></b></center>';
			}else{	
			mysqli_query($db, "DELETE FROM banners where id='$dell_banner_id'");
			echo '<center><b><font color="green">Баннер успешно удален!!!</font></b></center>';
			}
		}
	}
	
	
}

						if (isset($_POST['dell_link_id'])) {

									$dell_link_id = (isset($_POST["dell_link_id"])) ? text($_POST["dell_link_id"], $db) : false;
									$nolink = mysqli_query($db, "select * from links where id='$dell_link_id' and email = '$user'"); //ид ссылки у юзера
									$nolinkk = mysqli_query($db, "select * from links where id='$dell_link_id'"); //ид ссылки в бд
									$sw = mysqli_num_rows($nolink);
									if ($dell_link_id==NULL) {
											echo '<center><b><font color="red">Какую именно ссылку удаляете???</font></b></center>';
									}else{
										 if ($nolink < $nolinkk) {
											echo '<center><b><font color="red">Нельзя удалить чужую ссылку!!!</font></b></center>';
									}else{
											if ($sw==NULL) {
											echo '<center><b><font color="red">Такой ссылки нет!!!</font></b></center>';
									}else{	
									mysqli_query($db, "DELETE FROM links where id='$dell_link_id'");
									echo '<center><b><font color="green">Ссылка успешно удалена!!!</font></b></center>';
									}
								}
							}
						}	
?>
    
    <!-- Begin Menu -->

			
<section class="home boxed" style="padding-bottom: 0;">
		<div class="section-header">
      <h1 class="title">Размещение <span class="title-highlight">рекламы</span></h1>
      
	  
	  		<?

		
		if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
		{
		$user = $_SESSION["username"];
		$user_row = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$user'"));
		$reclmoney = round($user_row["reclmoney"],2);
		  echo '<p>Баланс для рекламы: '.$reclmoney.' руб. <a href="/insert.php" class="ui tiny button green">Пополнить</a></p>';
		}?>
	  
             		</div> <!-- /.section-header -->
	</section>
<section class="features adv-list">
    <div class="container">
	<div id="adverst-grid" class="grid-view">
<h4>Баннеры</h4>
			<?
		$count_linkvv = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'count_ban'"));
		$count_linkv = $count_linkvv['value'];
		
		$pricelinkc = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'priceban'"));
		$count_linkkc = $pricelinkc['value'];
		?>
<p>Пользователи делают обязательный переход по баннеру при получении бонуса.
Цену перехода устанавливаете Вы, но не менее <? echo ''.$count_linkkc.''; ?> руб. за переход. Баннеры с большей стоимостью показываются выше в списке.</p>

<a href="/newadv.php" class="button"><i></i>Добавить</a> 

  <?
  		if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
		{
  		$q = mysqli_query($db, "select * from banners where email = '$user' order by id desc");
		$s = mysqli_num_rows($q);
		if ($s > 0){
		?>
		<div id="payment-grid" class="grid-view">
<table class="items">
<thead>
<tr>
	<th align="center">Баннер</th>
	<th align="center">Стоимость</th>
	<th align="center">Переходов</th>
	<th align="center">Дата</th>
	<th align="center"> - </th>
  </tr></thead>
  <tbody>
		<?
		while ($user_row = mysqli_fetch_array($q)) {
			echo '			
	<tr class="adv_dell">
	<td align="center"><a href="'.$user_row['url'].'" target="blank"><img width="140px" src="'.$user_row['urlban'].'"></a></td>
    <td align="center">'.$user_row['go_amount'].' Руб</td>
	<td align="center">'.$user_row['count_linkbof'].' из '.$user_row['count_linkb'].'</td>
	<td align="center">'.date('d.m.Y H:i:s', $user_row['time']).'</td>';
	
	if ($user_row['count_linkbof'] < $user_row['count_linkb']){
	echo '<td align="center"><img src="/images/yes.png"></td></tr>';
	}else{
	echo '<td align="center">
	<form action="" method="post">
			<input type="hidden" name="dell_banner_id" value="'.$user_row['id'].'">
			<input type="submit" name="dell_banner" value="Удалить">
	</form>
	</td></tr>';
	}
  	
				
		}
		

			
?>
</tbody></table>
</div>
<?
		}else{
  ?>
  
<i>У вас ещё нет баннеров</i>
  
  <?}
  }else{
  ?>
  
<i>У вас ещё нет баннеров</i>
  <?
  }
  ?>
</div>
 </div>
  </section>
  

<section class="features adv-list">
    <div class="container">
	

<h4>Контекстная реклама</h4>
	
	<?

		$count_linkbd = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'count_link'"));
		$count_linkb = $count_linkbd['value'];
		
		$pricelinkk = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'pricelink'"));
		$count_linkkk = $pricelinkk['value'];
		$balance = $count_linkkk * $count_linkb;
		?>

<p>Текстовая реклама показывается на главной странице, по цене <? echo ''.$balance.' руб. за '.$count_linkb.' показов.'; ?></p>

<a href="/newadv.php" class="button"><i></i>Добавить</a> 





  <?
  	  		if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
		{
		$user = $_SESSION["username"];
  		$qw = mysqli_query($db, "select * from links where email = '$user' order by id desc");
		$ss = mysqli_num_rows($qw);
		if ($ss > 0) {
	?>
								<div id="payment-grid" class="grid-view">
						<table class="items">
						<thead>
						<tr>
							<th align="center">Реклама</th>
							<th align="center">Показов</th>
							<th align="center">Дата</th>
							<th align="center"> - </th>
						</tr></thead>
						  <tbody>
								<?
								while ($user_row = mysqli_fetch_array($qw)) {
									echo '
						<tr class="htt">
							<td align="center"><a href="'.$user_row['url'].'" target="blank">'.$user_row['title'].'</a></td>
							<td align="center">'.$user_row['count_linkof'].' из '.$user_row['count_link'].'</td>
							<td align="center">'.date('d.m.Y H:i:s', $user_row['time']).'</td>';
							
						if ($user_row['count_linkof'] < $user_row['count_link']){
							echo '<td align="center"><img src="/images/yes.png"></td></tr>';
							}else{
							echo '<td align="center">
							<form action="" method="post">
									<input type="hidden" name="dell_link_id" value="'.$user_row['id'].'">
									<input type="submit" name="dell_link" value="Удалить">
							</form>
							</td></tr>';
							}
								}

									

						?>
						</tbody></table>
						</div>
<?
		}else{
  ?>
  
<i>У вас ещё нет контекстной рекламы</i>
  
  <?}
  }else{?>

<i>У вас ещё нет контекстной рекламы</i>
  <?}?>

</div>
  </section>
 




	

<? require 'footer.php';?>