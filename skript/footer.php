<?
$vs = mysqli_fetch_row(mysqli_query($db, "select sum(`sum`) from sp"));
$s = round($vs[0], 2);
$user = mysqli_fetch_row(mysqli_query($db, "SELECT count(id) FROM users"));

$userr = round($user[0], 2);

$startdate = mysqli_fetch_array(mysqli_query($db, "select * from settings where `set` = 'startdate'"));
$startdatee = $startdate['value'];
?>
	
	<footer class="boxed-mini">

		
		

<div class="container"> 
    Выплачено <?echo ''.$s.'';?> руб.&nbsp;|&nbsp;Пользователей <?echo ''.$userr.'';?> чел.&nbsp;|&nbsp;Старт <?echo ''.$startdatee.'';?><br><br>
   <div class="index_footer">     
      <a href="/faq.php">Частые вопросы</a>&nbsp;|&nbsp;
      <a href="/about.php">О проекте</a>&nbsp;|&nbsp;
      <a href="/contacts.php">Контакты</a>&nbsp;|&nbsp;
      <a href="/rules.php">Cоглашение</a>&nbsp;|&nbsp;
	  <a href="/script.php">Купить такой скрипт</a>
    </div> 
   </div>	
 <center>    
<table>
    <tbody><tr>
        <td>
<!--счетчики-->

<!-- /Yandex.Metrika counter -->

<!--счетчики-->
		</td>
        <td style="padding: 7px 0px 0px 9px;">
            <a href="https://payeer.com/" target="_blank" rel="nofollow"><img src="https://payeer.com/bitrix/templates/difiz/img/quote-logo.png" style="width: 88px; height: 31px;" alt=""></a>
        </td>
		<td style="padding: 7px 0px 0px 9px;">
		<a target="_blank" href="http://webmoney.ru"><img height="31" width="88" title="Мы принимаем WebMoney" src="/img/acc_blue_on_white_ru.png" alt="Мы принимаем WebMoney"></a>
		 </td>
    </tr>
</tbody></table>
 </center> 
<div class="social"> 
		</div> <!-- /.social -->

		<div class="copyright">
			<p>
				© Powered by <a href="/"><?echo ''.$_SERVER['SERVER_NAME'].''?></a> All rights reserved.

			</p>
		</div>

		<div id="back-to-top" class="back-to-top">
			<a href="#"><img class="ff-ap" src="img/ff-ap.png"></a>
		</div>
	</footer>

<!-- JS -->
<script src="/tpl/js/vendor/jquery.placeholder.js"></script>
<script src="/tpl/js/vendor/waypoints.min.js"></script>
<script src="/tpl/js/main.js"></script>
<!--script src="/js/main.js"></script-->
<script src="/tpl/js/animations.js"></script>

</body></html>
