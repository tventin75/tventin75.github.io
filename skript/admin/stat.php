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
		<script src="/admin/highcharts2.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>

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
<!--тут будет вывод самой статистики-->
		Статистика сайта.
<?
$colvv = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(sum) from sp where time > ".mktime(0,0,0))); 

$colv = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(sum) from sp where time > '".(strtotime(date('d-m-Y',time()-86400)))."'")); 
$colv1 = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(sum) from sp where time > '".(strtotime(date('d-m-Y',time()-169200)))."'"));
$colv2 = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(sum) from sp where time > '".(strtotime(date('d-m-Y',time()-255600)))."'")); 
$colv3 = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(sum) from sp where time > '".(strtotime(date('d-m-Y',time()-345600)))."'")); 
$colv4 = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(sum) from sp where time > '".(strtotime(date('d-m-Y',time()-432000)))."'")); 
$colv5 = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(sum) from sp where time > '".(strtotime(date('d-m-Y',time()-518400)))."'")); 
$colv6 = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(sum) from sp where time > '".(strtotime(date('d-m-Y',time()-604800)))."'")); 
$colv7 = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(sum) from sp where time > '".(strtotime(date('d-m-Y',time()-691200)))."'")); 
$colv8 = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(sum) from sp where time > '".(strtotime(date('d-m-Y',time()-777600)))."'")); 
$colv9 = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(sum) from sp where time > '".(strtotime(date('d-m-Y',time()-864000)))."'")); 

//за сегодня
$vhh = $colvv[0];
//день назад
$vh = $colv1[0] - $colv[0];
//2 дня назад
$vh1 = $colv2[0] - $colv1[0];
//3 дня назад
$vh2 = $colv3[0] - $colv2[0];
//4 дня назад
$vh3 = $colv4[0] - $colv3[0];
//5 дня назад
$vh4 = $colv5[0] - $colv4[0];
//6 дня назад
$vh5 = $colv6[0] - $colv5[0];
//7 дня назад
$vh6 = $colv7[0] - $colv6[0];
//8 дня назад
$vh7 = $colv8[0] - $colv7[0];
//9 дня назад
$vh8 = $colv9[0] - $colv8[0];

$ss = round($colvv[0], 2);
$s = round($colv[0], 2);
$s1 = round($vh, 2);
$s2 = round($vh1, 2);
$s3 = round($vh2, 2);
$s4 = round($vh3, 2);
$s5 = round($vh4, 2);
$s6 = round($vh5, 2);
$s7 = round($vh6, 2);
$s8 = round($vh7, 2);
$s9 = round($vh8, 2);

$tt = date('d.m',time());

$t = date('d.m',time()-86400);
$t1 = date('d.m',time()-86400*2);
$t2 = date('d.m',time()-86400*3);
$t3 = date('d.m',time()-86400*4);
$t4 = date('d.m',time()-86400*5);
$t5 = date('d.m',time()-86400*6);
$t6 = date('d.m',time()-86400*7);
$t7 = date('d.m',time()-86400*8);
$t8 = date('d.m',time()-86400*9);
$t9 = date('d.m',time()-86400*10);
?>
<?
echo '
<table sryle="text-align: right;
    width: 200px;
    margin: auto;
    border: 1px solid #B799A9;">
<tr>
	<td>
		'.date('d.m.Y',time()).'
	</td>
	<td>
		'.$ss.'
	</td>
</tr>	
<tr>
	<td>
		'.date('d.m.Y',time()-86400).'
	</td>
	<td>
		'.$s.'
	</td>
</tr>
<tr>
	<td>
		'.date('d.m.Y',time()-86400*2).' 
	</td>
	<td>
		'.$s1.'
	</td>
</tr>
<tr>
	<td>
		'.date('d.m.Y',time()-86400*3).' 
	</td>
	<td>
		'.$s2.'
	</td>
</tr>
<tr>
	<td>
		'.date('d.m.Y',time()-86400*4).' 
	</td>
	<td>
		'.$s3.'
	</td>
</tr>
<tr>
	<td>
		'.date('d.m.Y',time()-86400*5).' 
	</td>
	<td>
		'.$s4.'
	</td>
</tr>
<tr>
	<td>
		'.date('d.m.Y',time()-86400*6).' 
	</td>
	<td>
		'.$s5.'
	</td>
</tr>
<tr>
	<td>
		'.date('d.m.Y',time()-86400*7).' 
	</td>
	<td>
		'.$s6.'
	</td>
</tr>
<tr>
	<td>
		'.date('d.m.Y',time()-86400*8).' 
	</td>
	<td>
		'.$s7.'
	</td>
</tr>
<tr>
	<td>
		'.date('d.m.Y',time()-86400*9).' 
	</td>
	<td>
		'.$s8.'
	</td>
</tr>
<tr>
	<td>
		'.date('d.m.Y',time()-86400*10).' 
	</td>
	<td>
		'.$s9.'
	</td>
</tr>
</table>'
;?> 



<script>
$(function () {
    $('#container').highcharts({
        title: {
            text: 'Выплачено по дням',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ["<? echo $t9.'","'.$t8.'","'.$t7.'","'.$t6.'","'.$t5.'","'.$t4.'","'.$t3.'","'.$t2.'","'.$t1.'","'.$t.'","'.$tt.'"'; ?>]
        },
        yAxis: {
            title: {
                text: 'Руб.'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'р.'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Выплачено',
            data: [<? echo $s9.','.$s8.','.$s7.','.$s6.','.$s5.','.$s4.','.$s3.','.$s2.','.$s1.','.$s.','.$ss;?>]
        }]
    });
});
</script>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<!--тут будет вывод самой статистики-->
		<?}else{
			echo '<form action="" method="POST">
				<input type="text" placeholder="Логин" name="log">
				<input type="password" placeholder="Пароль" name="pass">
				<input type="submit" value="Войти">
			</form>';
		}?>
		</div>
	</div>
</body>
</html>


