<?
session_start();

if($_SESSION["username"]==NULL or $_SESSION["password"]==NULL)
{
	?>
	<script type="text/javascript">
	location.replace("login.php");
	</script>
	<noscript>
	<meta http-equiv="refresh" content="0; url=login.php">
	</noscript>
	<?
	exit();
}else{
	unset($_SESSION["username"]);
	unset($_SESSION["password"]);
	?>
	<script type="text/javascript">
	location.replace("index.php");
	</script>
	<noscript>
	<meta http-equiv="refresh" content="0; url=index.php">
	</noscript>
	<?
}
