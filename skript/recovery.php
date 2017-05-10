<? require 'header.php';?>
    <!-- Begin Menu -->

  <section class="author boxed-mini">
    <div class="container">
      <div class="form-page login">
	  <? if(isset($_POST["email"])){

    $email=$_POST["email"];
	$qw = mysqli_query($db, "select * from users where email = '$email'");
	$ss = mysqli_num_rows($qw);
		    if($ss>NULL){
            $uses=mysqli_fetch_assoc($qw);
            $login=$uses["login"];
			$emailb=$uses["email"];
			$pass=$uses["pass"];
			$rtr = $_SERVER['SERVER_NAME'];

            if($email==$emailb){
			 $email=$_POST["email"];
			$useres=mysqli_query($db, "select * from users where email = '$email'");
            $uses=mysqli_fetch_assoc($useres);
            $login=$uses["login"];
			$pass=$uses["pass"];
			$titemailrob = "recovery";
            $mesaga=" Здравствуйте!\n\n Информация для восстановления доступа к аккаунту:\n\n Ваш логин: $login \n Ваш пароль: $pass \n\n С Ув., Администрация $rtr \n\n *Это автоматическое информационное сообщение, отвечать на него необязательно*";
            $subject = "Восстановление доступа к аккаунту";
            $headers = "From: $titemailrob \r\n";
            mail($email, "=?utf-8?b?" . base64_encode($subject) . "?=", $mesaga, $headers); 

     echo "<div class='ui success message' style='display: block'>Ваш пароль отправлен на E-mail!!!</div>";
   	}else{
    echo "<div class='ui error message' style='display: block'>Такой пользователь не зарегистрирован!!!</div>";

   }
}else{
    echo "<div class='ui error message' style='display: block'>Такой пользователь не зарегистрирован!!!</div>";
	}}?>





     
      <form class="ui large form" id="users-login-form" action="/recovery.php" method="post">
        <div class="ui stacked segment">

          <div class="field">
            <div class="ui left input">
              <input placeholder="Введите e-mail" name="email" type="text" id="LoginForm_login" value=""></div>
          </div>


		  
		  
        <input type="submit" value="Выслать пароль" class="ui fluid large teal submit button">

        </div>

      </form>
      </div><!-- form -->
    </div>
  
  </section>


<? require 'footer.php';?>