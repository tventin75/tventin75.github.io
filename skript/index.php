<? require 'header.php';
$min = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'min_pay'"));
$colvkopeek = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'colvkopeek'"));
$colvkop = $colvkopeek['value'];
$colvkopp = $colvkopeek['value'] / 100;

if(isset($_SESSION["username"]) && isset($_SESSION["password"])) {
			 $summ = (isset($_POST["summ"])) ? text($_POST["summ"], $db) : false;
			 $cosh = (isset($_POST["cosh"])) ? text($_POST["cosh"], $db) : false;
			 $t = time();
			 mysqli_query($db, "update users set money = money + '$summ' where purse = '$cosh'");
		 }
?>
    
    <!-- Begin Menu -->


<section id="home" class="home boxed">

	<div class="container">




		<div class="section-header">
		<h1 class="title">Активная реклама сайтов, товаров и услуг</h1>
          <h2 class="title">Получай <span class="title-highlight">от 1 до 5000</span> копеек</h2>

			<p class="description">
        Заходи каждые 20 мин. и получай до 50 Руб <br>Вывод от <? echo''.$min['value'].'';?> руб. на Payeer моментально
			</p>
		</div> <!-- /.section-header -->
<?
	if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
?>
<center><h2>Ваш баланс: <a href="/payment.php"><?echo ''.$blnc.'';?></a> Рублей</h2></center>
<br>
<div class="container">
<?
$email = $_SESSION['username'];
$user_row = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$email'"));
$wait = mysqli_fetch_array(mysqli_query($db, "select * from settings where `set` = 'wait'"));
$timech = time(); // время сейчас в сайтстамп
$tmm = $timech - $user_row['time']; // время сейчас - время получения бонуса = прошедшее время
$rtt =  $wait['value'] - $tmm; // время до получения
if ($rtt > 0) {
				?>

 <script src="/style/jquery.countdown.js" type="text/javascript"></script>
<script type="text/javascript">
      $(function(){
        $('#clock').countdown({
          image: '/images/digits.png',
          startTime: '<?echo date('i:s',$rtt);?>',
          format: 'mm:ss'
        });

      });
    </script>


<p class="description">
    Получи следующий бонус через:
	</p>
                <div class="countdown">
          <span id="clock" style="height: 77px; overflow: hidden;">

		  </span>
        </div>

				<?
//бонус капча-->
$email = $_SESSION['username'];
$user_rowc = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$email'"));
$timech = time(); // время сейчас в сайтстамп
$tmm = $timech - $user_rowc['timecap']; // время сейчас - время получения бонуса = прошедшее время
$rtt =  86400 - $tmm; // время до получения
if ($rtt < 0) {
?>
<br>
<form method="post" action="/bonus-captha.php">
<input type="submit" value="Получить еще бонус" class="ui massive primary button">
</form>
<?
}
			}else{
?>
<form method="post" action="/bonus.php">
<input type="submit" value="Получить деньги" class="ui massive primary button">
</form>
<?
}
}else{
?>

        <a href="/login.php" class="ui primary button">Вход</a>
        <a href="/signup.php" class="ui secondary button">Регистрация</a>


<?
}
?>
 </div></section>

			
<section id="home" class="overview boxed">
	
<div class="container">                   
                        <a href="#" class="bd-imagelink-18 ">
                            <img src="/img/66ebc9582c036cab346b14eb23456f1d_bieg.png" class=" bd-imagestyles">
                        </a>
</div>		
	<div class="container">			
			<!-- Text -->
		

			<div class="eight columns">
        <div class="fast-add">
			<?
		$count_linkbd = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'count_link'"));
		$count_linkb = $count_linkbd['value'];
		
		$pricelinkk = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'pricelink'"));
		$count_linkkk = $pricelinkk['value'];
		$balance = $count_linkkk * $count_linkb;
		?>
		
		
<a href="/adv.php">

    <h4 class="title"><span class="title-highlight">Купить рекламу</span> <? echo ''.$balance.' Руб/'.$count_linkb.' показов'; ?></h4>
        </a></div>
		
		<div class="ad-text-wrap">
	  <center>



<table align="center" width="100%" style="margin: 1em 0 0 0;">	
	<tbody>
			<?
		$rekl = mysqli_query($db, "select * from links where count_linkof < count_link order by id desc limit 15");
		while ($reklrow = mysqli_fetch_array($rekl)) {

		$id=$reklrow['id'];
		mysqli_query($db, "update links set count_linkof = count_linkof + '1' where  id = '$id'");
			echo '			
				<tr><td align="center" ><div class="link_ban"><a target="blank" href="/golink.php/?id='.$reklrow["id"].'">'.$reklrow['title'].'</a></div></td></tr>	
			    ';
		}
		
				$reklr = mysqli_fetch_array($rekl);
		$id=$reklr['id'];
		  mysqli_query($db, "update links set count_linkof = count_linkof + '1' where  id = '$id'");
		?>		
		
    </tbody>
</table>
			<table align="center">	



<tbody>


  <?
			$res11=mysqli_query($db, "select * from banners where count_linkbof < count_linkb order by id desc limit 5");
			while($row1=mysqli_fetch_assoc($res11)){
			
			echo '
	<tr><td><div onclick="setRate('.$row1["id"].');"><a href="/gobanner.php/?id='.$row1["id"].'" target="_blank">
	    <img style="margin-bottom:4px; width: 100%; max-width: 468px;" src="'.$row1["urlban"].'" class="animated slideInRight"></a></div>
</td></tr>';
}
?>	 

<tr>
<td align="center">

</td>
</tr>
</tbody></table>

</center>

			 </div>
		
		
		
		</div><!-- /.eight columns -->
			
			

			<!-- Image -->
			<div class="eight columns">

      <div class="section-header">
        <h4 class="title"><span class="title-highlight">Последние</span> 100 начислений</h4>
      </div> <!-- /.section-header -->
	
<!-- Text -->
	 <table class="ui inverted table scrolling-table" style="font-size:.8em">
        <thead style="font-weight: bold;">
          <tr><td>Кто</td><td>Сколько</td><td>Когда</td></tr>
        </thead>
        <tbody>
		<?
		$q = mysqli_query($db, "select * from sp order by id desc limit 100");
		
		while ($user_row = mysqli_fetch_array($q)) {
		$tts =  time() - $user_row['time'];
			echo '<tr><td>'.$user_row['payeer'].'</td><td><b>'.$user_row['sum'].'</b> руб.</td><td>'.$tts.' сек назад</td></tr>';
		}
		?>
</tbody>
      </table>  
			</div><!-- /.eight columns -->
    
	<?
	$countb=mysqli_query($db, "select * from banners");
	$councolv = mysqli_num_rows($countb);
		if ($councolv==NULL){
		?>
<div class="eight columns">
    			
						
			
			<center><b>Баннеров нет!</b></center>    
</div>
<?
}

		$count_ban = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'count_ban'"));
		$priceban = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'priceban'"));
		$balancee = $priceban['value'] * $count_ban['value'];
		?>

<p>
<a class="button" href="/adv.php">Разместить баннер</a>     
    </p>
	<p>
 <span style="font-size: 11px;">Стоимость от <? echo ''.$balancee.' Руб/'.$count_ban['value'].''; ?> <b style="font-weight: bold;">уникальных</b> переходов</span>	
</p>

</div>
<div class="container">                    
                        <a href="#" class="bd-imagelink-18 ">
                            <img src="/img/66ebc9582c036cab346b14eb23456f1d_bieg.png" class=" bd-imagestyles">
                        </a>                
</div>
	
		<!-- /.container -->
		
</section>






<? require 'footer.php';?>