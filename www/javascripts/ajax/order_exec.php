<?
session_start();
require_once('../../../modules/config.php');
class action {

	function __construct () {

		$method = "PostReply";

		$DQ = new decode_query();				

		$DS = $DQ->PostToBase64($_POST["DS"]);
		$Served = $DQ->PostToBase64($_POST["Served"]);
		//$Costs = $DQ->PostToBase64($_POST["Costs"]);
		$Costs = $_POST["Costs"];



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
			"Costs"  => $Costs,
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
}

$return = new action ();
?>
