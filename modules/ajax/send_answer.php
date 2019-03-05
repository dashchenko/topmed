<?
session_start();
require_once('../config.php');

class action {

	function __construct () {

		$method = "postAnswer";	
		$DQ = new decode_query();			
		$Answer = $DQ->PostToBase64($_POST["Answer"]);

		$data = array(
			"Answer" => $Answer, 
			"key" => $_SESSION['login_token']['Key'],
			"ApplicationID" => $_POST['ApplicationID'],
			"FeedBackID" => $_POST['FeedBackID'],
			"RequestID" => $_POST['RequestID']
		);

		$AP = new api_post($method, $data);
		$ApiError = new api_errors();
		$error = $AP->ErrorData();
		print $ApiError->check($error);
	}
/*
	function PostToBase64 ($data) {

		$data1 =  trim($data);
		$data2	= htmlspecialchars($data1,  ENT_QUOTES, 'utf-8');
		$data3 = base64_encode($data2);
		return $data3;
	}
	*/
}
$result = new action ();
?>
