<?
session_start();
require_once('../config.php');
class action {

	function __construct () {

		$method = "PostMessage";

		$DQ = new decode_query();				
		$Req = $DQ->PostToBase64($_POST["Req"]);
		$data = array(
			"key" => $_SESSION['login_token']['Key'], 
			"Message" => $Req, 
			"ApplicationID" => $_POST['order_id'],
			"FeedBackID" => $_POST['fb_id']
		);

		$AP = new api_post($method, $data);
		$error = $AP->ErrorData();
		//print_r ($data);
		//print_r($_POST);
		$ApiError = new api_errors();
		print $ApiError->check($error);
		//print $result;
	}
}

$return = new action ();
?>
