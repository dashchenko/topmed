<?
session_start();
require_once('../config.php');
class action {

	function __construct () {

		$method = "PostReply";

		$DQ = new decode_query();				

		$DS = $DQ->PostToBase64($_POST["DS"]);
		$Served = $DQ->PostToBase64($_POST["Served"]);

		if ($_POST["checked"]) {
			$NewStatus = "8";
			$Req = $DQ->PostToBase64($_POST["Req"]);
		} else {
			$Req='';
			$NewStatus = "7";
		}

		$data = array(
			"DS" => $DS, 
			"key" => $_SESSION['login_token']['Key'], 
			"Served" => $Served, 
			"Req" => $Req, 
			"NewStatus" => $NewStatus,
			"ApplicationID" => $_POST['order_id']
		);

		$AP = new api_post($method, $data);
		$error = $AP->ErrorData();
		//print_r ($data);
		//print_r($_POST);
		$ApiError = new api_errors();
		print $ApiError->check($error);
		//print $result;
	}
	/*
	function PostToBase64 ($data) {

		$data1 =  trim($data);
		$data2	= htmlspecialchars($data1,  ENT_QUOTES, 'utf-8');
		$data3 = base64_encode($data2);
		return $data3;

	}


	function OrderExec()	{
		$key = $_SESSION[login_token][Key];
		$data = "key=$key&ApplicationID=$_POST[order_id]&NewStatus=5";
		$AG = new api_get('SetApplicationStatus', $data);
		$error = $AG->DataResult ('Error');
		return $this->CheckError($error);
	}
	*/
}

$return = new action ();
?>
