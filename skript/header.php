<?require('config.php');

$ref = 0;
if (isset($_SESSION['ref'])) {
	$ref = $_SESSION['ref'];
}
if (isset($_GET['i']) && !isset($_SESSION['ref'])) {
	$ref = intval($_GET['i']);
	$_SESSION['ref'] = $ref;
}
?>

<html><head>
<meta charset="UTF-8">
		<title><?echo ''.$_SERVER['SERVER_NAME'].''?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		<meta name="description"">
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
  <script src="/tpl/js/UToolTip.js" type="text/javascript"></script>
	<!-- Favicons -->
  <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">
  <link rel="apple-touch-icon" href="/favicon.png" sizes="32x32">
  <link rel="apple-touch-icon" href="/favicon.png" sizes="48x48">
  <link rel="apple-touch-icon" href="/favicon.png" sizes="96x96">
  <link rel="apple-touch-icon" href="/favicon.png" sizes="144x144">
 <script> 

</script>
</head>

<body class="landing-page">


  <!-- Begin Header -->

	<header class="header" id="header">
	
		<div class="container">
			
			<div class="sixteen columns">

				<div class="logo">
					<a href="/"><?echo ''.$_SERVER['SERVER_NAME'].''?></a>
				</div>
   

<ul class="nav">
     
	  <li><a href="/">Главная</a></li>
	  <li><a href="/adv.php">Заказ рекламы</a></li>
	  
		<?
		if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
			
{
$user = $_SESSION["username"];
$user_row = mysqli_fetch_array(mysqli_query($db, "select * from users where email = '$user'"));
$blnc = round($user_row["money"],2);
  echo '
  <li><a href="/payment.php">Вывод '.$blnc.'</a></li>
  <li><a href="/referals.php">Рефералы</a></li>
  <li><a href="/exit.php">Выход</a></li>';
}else{
 echo '<li><a href="/signup.php">Регистрация</a></li>
 <li><a href="/login.php">Вход</a></li>';
}?>
		      </ul>

			
			</div> <!-- /.sixteen columns -->
		
		</div><!-- /.container -->
	</header>
	

	