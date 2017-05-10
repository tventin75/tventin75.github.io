<? require 'header.php';

if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
?>
    				<script type="text/javascript">
				location.replace("/");
				</script>
				<noscript>
				<meta http-equiv="refresh" content="0; url=/">
				</noscript>
<?
}else{
?>
<!-- Begin Menu -->

	  <section class="author boxed-mini">

<div class="container">
      <div class="form-page login">
<?
if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
?>
<script type="text/javascript"> 
	setTimeout('location.replace("/")',10000); 
</script> 
<noscript> 
	<meta http-equiv="refresh" content="10; url=/"> 
</noscript>
<?
}




if(count($_POST) > 0)
				{
					$login = (isset($_POST["login"])) ? text($_POST["login"], $db) : false;
					$email = (isset($_POST["email"])) ? text($_POST["email"], $db,'email') : false;					
					$pass = (isset($_POST["pass"])) ? text($_POST["pass"], $db) : false;	
					$repass = (isset($_POST["repass"])) ? text($_POST["repass"], $db) : false;
					$purse = (isset($_POST["purse"])) ? text($_POST["purse"], $db) : false;
					$t = time();

					$username_exist = mysqli_num_rows(mysqli_query($db, "SELECT login FROM users WHERE login='$login'"));
					$email_exist = mysqli_num_rows(mysqli_query($db, "SELECT email FROM users WHERE email='$email'"));
					$purse_exist = mysqli_num_rows(mysqli_query($db, "SELECT purse FROM users WHERE purse='$purse'"));
					$ip=$_SERVER['REMOTE_ADDR'];
					$ipreg = mysqli_num_rows(mysqli_query($db, "SELECT purse FROM users WHERE ipreg='$ip'"));

					if($ipreg>0){
					   echo '<div class="ui error message" style="display: block">На ваш ip уже была регистрация!!!</div>';
					  }else{
					if($login==NULL){
					   echo '<div class="ui error message" style="display: block">Поле логин не заполнено!!!</div>';
					  }else{
						   if($email==NULL){
						   echo '<div class="ui error message" style="display: block">Поле email не заполнено!!!</div>';
					   }else{
							   if($email==NULL){
							   echo '<div class="ui error message" style="display: block">Поле email не заполнено!!!</div>';
						}else{
								if($pass==NULL){
								echo '<div class="ui error message" style="display: block">Поле пароль не заполнено!!!</div>';
					    }else{
								  if($repass==NULL){
								  echo '<div class="ui error message" style="display: block">Поле повторный пароль не заполнено!!!</div>';
					    }else{
									  if($purse==NULL){
									  echo '<div class="ui error message" style="display: block">Поле кошелек не заполнено!!!</div>';
						}else{
										if ($username_exist>0){
										echo '<div class="ui error message" style="display: block">Такой логин есть в системе!!!</div>';
                        }else{
										if ($email_exist>0){
										echo '<div class="ui error message" style="display: block">Данная почта уже зарегистрирована!!!</div>';
                        }else{
										if ($purse_exist>0){
										echo '<div class="ui error message" style="display: block">Кошелек уже зарегистрирован!!!</div>';
                        }else{	
										mysqli_query($db, "INSERT INTO users (login, email, pass, purse, time, ref, referer, datereg, ipreg) VALUES('$login', '$email', '$pass', '$purse', '0', '0', '$ref', '$t', '$ip')");
										echo '<div class="ui success message" style="display: block">Регистрация успешна!!!</div>';
										 $_SESSION["username"]=$email;
										 $_SESSION["password"]=$pass;
				?>
				<script type="text/javascript"> 
					setTimeout('location.replace("/")',10000); 
				</script> 
				<noscript> 
					<meta http-equiv="refresh" content="10; url=/"> 
				</noscript>
				<?										 
										 
										 
	}
		}										 									  
			}
				}
					}
						}
							}
								}
									}
										}   
											}else{
?>




<form class="ui large form" id="users-register-form" action="/signup.php" method="post">
    <div class="ui stacked segment">
<div class="field">
            <div class="ui left input">
            <input style="width:100%;" name="login" placeholder=" Ваш логин" type="text" size="25" maxlength="10" value=""></div></div>
  
<div class="field">
            <div class="ui left input">
            <input style="width:100%;" name="email" type="text" placeholder=" Ваш email" size="25" maxlength="50" value=""></div></div>
<div class="field">
            <div class="ui left input">  
            <input style="width:100%;" name="pass" type="password" placeholder=" Введите пароль" size="25" maxlength="20"></div></div>
<div class="field">
            <div class="ui left input">  
            <input style="width:100%;" name="repass" placeholder=" Повторите пароль" type="password" size="25" maxlength="20">
			</div>
			</div>
			
<a class="hovertip" href="#" title="Payeer">Как?</a>
<span class='tipbubble'><span style="font-size: 12px;">

<strong>Пользователям:</strong><br>  Кошелек <a href="https://payeer.com/ru/">Payeer</a> можно оформить за 1-2 мин. Способов вывода-пополнения много. Для простых операций никакой верификации не требуется.</span>
<br>
<br>
<span style="font-size: 12px;"><strong>Рекламодателям:</strong><br> для пополнения доступны и Payeer и WebMoney.
<br>
 </span><!--Текст отображаемой подсказки--></span>

<div class="field">
            <div class="ui left input"> 		
	        <input type="text" name="purse" pattern="P[0-9]{3,15}" style="width:100%;" placeholder=" Кошелек Payeer или WebMoney"></div></div>		
          <div class="field">
              <input name="rules" type="checkbox" checked="">
              <label for="rules" style="display: inline">Я принимаю условия <a href="/rules.php" target="_blank">соглашения</a></label>
                        </div>
 
 <input type="submit" value="Зарегистрироваться" class="ui fluid large teal submit button">
</div>
</form>
<?
}
?>
    </div>
    </div>
  </section>
  
  
<?}?>

<? require 'footer.php';?>