<?
session_start();
require_once('../config.php');

class action {

	function __construct () {
		$action = $_POST[order_act];
		print $this->$action();
		//print $action;
		//print_r($_POST);
	}

	function GetOrder()	{
		$key = $_SESSION[login_token][Key];
		$data = "key=$key&ApplicationID=$_POST[order_id]&NewStatus=5";
		$AG = new api_get('SetApplicationStatus', $data);
		$error = $AG->DataResult ('Error');
		$ApiError = new api_errors();
		return $ApiError->check($error);
		//print $data;
	}

	function BackOrder() {
		$key = $_SESSION[login_token][Key];
		$data = "key=$key&ApplicationID=$_POST[order_id]&NewStatus=6";
		$AG = new api_get('SetApplicationStatus', $data);
		$error = $AG->DataResult ('Error');

		$ApiError = new api_errors();
		return $ApiError->check($error);
	}
}


new action ();
?>
