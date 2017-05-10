<? require 'header.php';?>

    <!-- Begin Menu -->

			<?
if (isset($_GET['id'])) {
	$id=text($_GET['id'], $db);
	$res=mysqli_query($db, "select * from banners where id='$id'");
	if (mysqli_num_rows($res) > 0){
	$res=mysqli_query($db, "select * from banners where id='$id'");
	
	$benn=mysqli_fetch_assoc($res);
	$count_linkbof = $benn["count_linkbof"];
	$count_linkb = $benn["count_linkb"];
	  if ($count_linkb > $count_linkbof){
	  

		  if (mysqli_num_rows($res) > 0){
			  $id=text($_GET['id'], $db);
			  $res=mysqli_query($db, "select * from banners where id='$id'");
			  $row=mysqli_fetch_assoc($res);
			  $url=$row["url"];

			  mysqli_query($db, "update banners set count_linkbof = count_linkbof + '1' where  id = '$id'");
		  

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
				echo '<center>Такого баннера не существует!!!</center><br>';
		}
	}else{
				echo '<center>Этот баннер уже кончился!!!</center><br>';
		}
				}else{
				echo '<center>Такого баннера не существует!!!</center><br>';
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