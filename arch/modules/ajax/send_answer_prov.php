<?
session_start();
require_once('../config.php');

class action {

	function __construct () {

		$method = "MarkAnswer";				

		$data = array("key" => $_SESSION['login_token']['Key'], "Answer_ID" => $_POST['Answer_ID'], "NewStatus" => '1');
		$AP = new api_post($method, $data);
		$ApiError = new api_errors();
		$error = $AP->ErrorData();;
		print $ApiError->check($error);
	}
}
$result = new action ();
?>
