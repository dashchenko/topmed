<?
class order_db {

	public function __construct () {
		$host = "smarta00.mysql.tools";
		$db = $user = "smarta00_topmed";
		$password = "88pkc48m";

		$this->mysqli = new mysqli($host, $user, $password, $db);
		if ($mysqli->connect_errno) {
    		$this->error = "1";
		} else {
			$this->mysqli->set_charset("utf8");
			$this->error = "0";
		}
	}

	public function CreateTmp($user_login, $pwd)	{


		if ($this->error == "0") {

			$result = $this->mysqli->query("SELECT id FROM new_pwd WHERE user_login = '$user_login'");

			if ($result->num_rows) {
				$query = "UPDATE LOW_PRIORITY new_pwd SET tmp_pwd = '$pwd' WHERE user_login = '$user_login'";
			} else {
				$query = "INSERT IGNORE INTO new_pwd SET user_login = '$user_login',  tmp_pwd = '$pwd'";
			}
			$this->mysqli->query($query);
		} 
		return $this->error;
	}

	public function CheckTmp()	{

		if ($this->error == "0") {

			if ($_GET['var']) {
				$pwd = $_GET['var'];
				$result = $this->mysqli->query("SELECT user_login FROM new_pwd WHERE tmp_pwd = '$pwd'");

				if ($result->num_rows) {

					$row = $result->fetch_assoc();
					$result->close();
					return $row[user_login];
				} else {
					return "0";
				}
			}

		} 
		return $this->error;
	}

	
}

class randomName {

	public function creat($wordlenght, $type_of_chars) {
		if		($type_of_chars == "lit&dig")	$chars	=	"qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP"; 
		elseif ($type_of_chars == "dig")		$chars	=	"1234567890"; 
		elseif ($type_of_chars == "lit")		$chars	=	"qazxswedcvfrtgbnhyujmkiolpQAZXSWEDCVFRTGBNHYUJMKIOLP"; 
		elseif ($type_of_chars == "all")		$chars	=	"qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP!@#$%^&*()_-+-{[}];|,.?~";
		else exit;
		$size	=	StrLen($chars)-1; 
		$str	=	null; 
		while($wordlenght--)  $str.=$chars[rand(0,$size)]; 
		return $str;
	}
}


class SendMail1 {
	public function __construct ($to, $subject, $text, $from_text="Topmed", $from = "support@topmed.com.ua") {
		$subject = "=?UTF-8?B?".base64_encode($subject)."?=";  
		$headers = 'From: '.$from_text.' <'.$from.'>' . "\r\n" .
			'Content-type: text/plain; charset=utf-8' . "\r\n" .
			'Reply-To: '.$from. "\r\n" .
			'X-Mailer: PHP/' . phpversion(); 
		mail($to, $subject, $text, $headers, "-f".$from);
	}
}	
?>