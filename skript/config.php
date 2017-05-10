<?
error_reporting(E_ALL);
ini_set('display_errors','On');

session_start();
$db = mysqli_connect('localhost', 'пользователь', 'пароль', 'база');

if (!$db) { 
   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
   exit; 
}

mysqli_set_charset($db, "utf8");


function text($text, $db, $set = "") {
	$text = strip_tags($text);
	if ($set == 'email') {
		if (!filter_var($text, FILTER_VALIDATE_EMAIL)) {
			$text = "";
		}
	}elseif ($set == 'en_num') {
		if (!preg_match('/^[a-zA-Z0-9]+$/', $text)) {
			$text = "";
		}
	}elseif ($set == 'ru_en_num') {
		if (!preg_match('/^[а-Яa-Z0-9]+$/', $text)) {
			$text = "";
		}
	}elseif ($set == 'ip') {
		if (!filter_var($text, FILTER_VALIDATE_IP)) {
			$text = "";
		}
	}elseif ($set == 'login') {
		if (!preg_match('/^[a-zA-Z0-9\-\_]+$/', $text)) {
			$text = "";
		}
	}
	$text = mysqli_real_escape_string($db, $text);
	$text = htmlspecialchars($text, ENT_QUOTES);
	if(get_magic_quotes_gpc ()){$text = stripslashes($text);}
	$text = trim($text);

	return $text;
}
function login_e($login){
    if (preg_match("/^[a-zA-Z0-9\-\.\@\_]+$/", $login)){
      $login = str_replace("'"," ",$login);
      $login = htmlentities($login, ENT_QUOTES, 'WINDOWS-1251');
      return $login;

    }else{
      echo "<fieldset class='warning'>Введенные данные содержат запрещенные символы. Проверьте правильность ввода";
	  include('footer.php');
	  exit();
    }

}

function rand_str($length) {
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
	$numChars = strlen ($chars);
	$string = '';
	for ($i = 0; $i < $length; $i++) {
		$string .= substr ($chars, rand (1, $numChars) - 1, 1);
	}
	return $string;
}

function mysqli_result($result, $row = 0) {
	$data = mysqli_fetch_array($result);
    return $data[$row];
}
?>