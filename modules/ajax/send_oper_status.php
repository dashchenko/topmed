<?
session_start();
require_once('../config.php');
class action {

	function __construct () {

		$method = "SetOperativeStatus";

		$DQ = new decode_query();				
		$Status = $DQ->PostToBase64($_POST["operstat"]);

		$data = array(
			"OperativeStatus" => $Status, 
			"key" => $_SESSION['login_token']['Key'], 
			"ApplicationID" => $_POST['appid']
		);

		$AP = new api_post($method, $data);
		$error = $AP->ErrorData();
		$ApiError = new api_errors();
		$error_result = $ApiError->check($error);

		if ($error_result == 0) print $_POST[operstat];
		else print "хуйня";
	}
}

$return = new action ();
?>