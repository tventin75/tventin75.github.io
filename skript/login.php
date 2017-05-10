<? require 'header.php';?>
    
    <!-- Begin Menu -->
	
			
 <section class="author boxed-mini">
    <div class="container">
      <div class="form-page login">
<?
if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
{
  echo '<div class="ui error message" style="display: block">Вы уже вошли!!!</div>';
}else{

if(count($_POST) > 0)
				{
					
					$email = (isset($_POST["log_email"])) ? text($_POST["log_email"], $db,'email') : false;					
					$pass = (isset($_POST["pass"])) ? text($_POST["pass"], $db) : false;	
					$email_exist = mysqli_num_rows(mysqli_query($db, "SELECT email FROM users WHERE email='$email'"));
					$pass_exist1 = mysqli_num_rows(mysqli_query($db, "SELECT pass FROM users WHERE pass='$pass' and email='$email'"));


                    
					


						   if($email==NULL){
						   echo '<div class="ui error message" style="display: block">Поле email не заполнено!!!</div>';
					   }else{
								if($pass==NULL){
								echo '<div class="ui error message" style="display: block">Поле пароль не заполнено!!!</div>';
					    }else{
										if ($email_exist<1){
										echo '<div class="ui error message" style="display: block">Такая почта еще не зарегистрирована!!!</div>';
                        }else{
										if ($pass_exist1<1){
										echo '<div class="ui error message" style="display: block">Пароль заполнен не верно!!!</div>';
                        }else{	
										echo '<div class="ui success message" style="display: block">Авторизация успешна!!!</div>';
										 $_SESSION["username"]=$email;
										 $_SESSION["password"]=$pass;
?>
<script type="text/javascript"> 
	setTimeout('location.replace("/")',1000); 
</script> 
<noscript> 
	<meta http-equiv="refresh" content="1; url=/"> 
</noscript>
<?										 
	}
		}										 									  
			}
				}
					}else{
?>
      
      <form class="ui large form" action="" method="post">
        <div class="ui stacked segment">

          <div class="field">
            <div class="ui left input">
              <input placeholder="Ваш Email" name="log_email" type="text">           
			  </div>
            <span class="pass-toggle" style="display: none;"><a href="javascript: void(0);" onclick="forgot()">Вспомнил пароль</a></span>
          </div>

          <div class="field pass-toggle">
            <div class="ui left input">
              <input name="pass" type="password" placeholder="Пароль">
            </div>
            <span class="pass-forgot"><a href="/recovery.php">Восстановить пароль</a></span>
          </div>


        <input type="submit" value="Войти" class="ui fluid large teal submit button">

        </div>

      </form>

<?}
	}?> 
     </div><!-- form -->
    </div>
  </section>
  
 
			
<? require 'footer.php';?>