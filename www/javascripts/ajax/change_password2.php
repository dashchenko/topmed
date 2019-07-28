<?php
session_start();
require_once('../../modules/config.php');

$pass =  trim($_POST["new1"]);
$pass2 = trim($_POST["new2"]);

$npass_len = iconv_strlen($pass); 
$npass2_len = iconv_strlen($pass2); 


if ($npass_len < 4 OR $npass2_len < 4) {
	print "Пароль слишком короткий!";

} elseif ($pass != $pass2 ) {

	print "Пароли не совпадают!";

} else {

	$CP = new change_password();
	$result = $CP->Result($pass, $npass);

	if ($result[Result] == "OK") {
		print "Пароль изменен успешно";
		$_SESSION['login_pass'] = $npass;
	} else {
		print "Изменить не удалось";
	}
		//print $result[Result]; 
}




class change_password
{

	public function Result ($pass, $npass)	{

		$method = "SetPwd";
		$login = $_SESSION['login_token']['UserLogin'];

		$data = array("NewP" => $npass,"P" => sha1($pass), "L" => $_SESSION['login_token']['UserLogin']);
		//print_r($data);

		$AP = new api_post($method, $data);
		$result = $AP->ReturnData();
		return $result;

	}
}
?>