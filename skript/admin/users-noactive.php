<?php
include '../settings.php';
$site_name = mysqli_fetch_array(mysqli_query($db, "select value from settings where `set` = 'site_name'"));
?>
<html>
<head>
		<meta charset="utf-8">
        <title><?=$site_name['value']; ?></title>
        <link href="/css.css" rel="stylesheet">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</head>
<body>
	<div id="loader"></div>

	<div class="top_menu">
		<div>
			<span><?=$site_name['value']; ?></span>
			<a href="/">На главную</a>
			<a href="/admin/">Админка</a>
			<a href="/admin/stat.php">Статистика</a>
			<a href="/admin/users-noactive.php">Неактивные люди</a>
		</div>
	</div>
	
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
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == "true"){ 
		?>
<!--тут будет вывод трупиков-->
		Неактивные люди.

<?
if(count($_POST) > 0)
				{
mysqli_query($db, "update users set money = '0' where last < '".(time()-86400)."'");
echo '<div>Списание у неактивных завершено!</div>';
}else{
?>
<form id="obnull" method="POST" action="">
<table width='700px' border='0' cellpadding='0' cellspacing='0'>

<tbody>
<input type="hidden" name="null" type="text" value="0">
<tr>
<td align="left"><input class="gotovo" type="submit" value="Обнулить" tabindex="5" /></td></tr>
</tbody>
</table>
	</form>
<?
	}
	
$q_re = mysqli_query($db, "select * from users where last < '".(strtotime(date('d-m-Y',time()-86400)))."' and money > 0 order by last desc");
while ($user_row = mysqli_fetch_array($q_re)) {
echo'
<table sryle="text-align: right;
    width: 200px;
    margin: auto;
    border: 1px solid #B799A9;">
<tr>
	<td>
		'.$user_row['id'].'
	</td>
	<td>
		'.$user_row['money'].'
	</td>
	<td>
		'.$t=date('Y-m-d H:i:s', $user_row['last']).'
	</td>
</tr>
</table>'
;?> 

<!--тут будет вывод самой статистики-->
		<?
		}}else{
			echo '<form action="" method="POST">
				<input type="text" placeholder="Логин" name="log">
				<input type="password" placeholder="Пароль" name="pass">
				<input type="submit" value="Войти">
			</form>';
		}
		?>
		</div>
	</div>
</body>
</html>


