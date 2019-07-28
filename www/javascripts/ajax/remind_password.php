<?php
session_start();
require_once('../../../modules/config.php');

$login =  trim($_POST["L"]);
$login_len = iconv_strlen($login); 
$CL = new check_login();

if ($login_len < 4) {
	print "Указан неверный логин";
	exit;
}
if ($CL->CheckLogin ($login) == 0) {
	print "Ошибка валидации данных, свяжитесь с поддержкой: support@topmed.com.ua";
	exit;
} else {
	//$RN = new randomName();
	//$pwd = $RN->creat(10, "lit&dig");

	//$ODB = new order_db();
	//$ODB -> CreateTmp($login, $pwd);
	//$link = ROOT_PASS."417".$pwd.".html";

	$to = "support@topmed.com.ua";
	$subject = "Заявка на сброс пароля от $login";
	$text = "Пользователь $login отправил заявку на сброс пароля.";

	new SendMail1 ($to, $subject, $text);


	print "Заявка на сброс пароля отправлена в службу поддержки. Ожидайте ответа на почту.";

}



class check_login {

	public function CheckLogin ($login)	{

		$data = array("L" => $login,"P" => "");
		$AP = new api_post("validate", $data);
		$result = $AP->ReturnData();

		if ($result[UserLogin] == $login) { 
			return "1";
		} else {
			return "0";
		}
	}
}
?>