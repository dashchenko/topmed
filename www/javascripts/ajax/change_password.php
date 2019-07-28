<?php
session_start();
require_once('../../../modules/config.php');

$pass =  trim($_POST["new1"]);
$npass = trim($_POST["new_password"]);

$npass_len = iconv_strlen($npass); 

if (!$_SESSION['pass_try'] OR $_SESSION['pass_try'] < 5) {
	if ($pass != $_SESSION['login_pass']) {
		print "Пароль неверный";
		//print_r($_SESSION['login_token']['UserLogin']);

		$_SESSION['pass_try'] +=1;
	} elseif (!$npass OR $npass == '') {

		print "Не указан пароль!";

	} elseif ($npass_len < 4){
		print "Пароль слишком короткий!";

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

} else {
	$_SESSION = array();
	session_destroy();
	print "<meta http-equiv=\"refresh\" content=\"0;URL=100.html\">";
	exit;
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