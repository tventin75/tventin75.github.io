<? require 'header.php';?>

    <!-- Begin Menu -->

<?
if (isset($_GET['id'])) {
	$id=text($_GET['id'], $db);
	$res=mysqli_query($db, "select * from links where id='$id'");
	if (mysqli_num_rows($res) > 0){
	$res=mysqli_query($db, "select * from links where id='$id'");
	$linn=mysqli_fetch_assoc($res);
	$count_linkof = $linn["count_linkof"];
	$count_link = $linn["count_link"];
	  if ($count_link > $count_linkof){
			if (mysqli_num_rows($res) > 0){
				$id=text($_GET['id'], $db);
				$res=mysqli_query($db, "select * from links where id='$id'");
				$row=mysqli_fetch_assoc($res);
				$url=$row["url"];
					mysqli_query($db, "update links set count_linkof = count_linkof + '1' where  id = '$id'");
	?>
						<center> Подождите секундочку. Идёт переадресация...</center><br>
						<script type="text/javascript"> 
							setTimeout('location.replace("<? echo ''.$url.'';?>")',1000); 
						</script> 
						<noscript> 
							<meta http-equiv="refresh" content="1; url=<? echo ''.$url.'';?>"> 
						</noscript>
			<?
			}else{
				echo '<center>Такой ссылки не существует!!!</center><br>';
			}
		}else{
			echo '<center>Эта ссылка уже кончилась!!!</center><br>';
	}
	}else{
				echo '<center>Такой ссылки не существует!!!</center><br>';
			}
}else{
	echo '<center>Возвращаемся!!!</center><br>';
?>
				<script type="text/javascript"> 
					setTimeout('location.replace("/")',1000); 
				</script> 
				<noscript> 
					<meta http-equiv="refresh" content="1; url=/"> 
				</noscript>
<?
}
?>


<? require 'footer.php';?>