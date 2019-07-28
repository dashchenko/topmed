<?
class put_time_patient {
	public function __construct($order_id, $date, $time)
	{
		$method = "Approve";	
		$DQ = new decode_query();			
		$Answer = $DQ->PostToBase64($_POST["Answer"]);

		$arrtime = explode(":", $time);
		$arrdate = explode(".", $date);

		$data = array(
			"key" => $_SESSION['login_token']['Key'],
			"ApplicationID" => $order_id,
			"hour" => $arrtime[0],
			"min" => $arrtime[1],
			"D" => $arrdate[0],
			"M" => $arrdate[1],			
		);

		$approved = $this->CheckAproved ($order_id);

		if ($approved['done'] == 1) {
			$apimethod = "POST";
		} else {
			$apimethod = "PUT";
		}

		$AP = new api_post($method, $data, $apimethod);
		$error = ($AP->ErrorData()) ?? '0';;

		$ApiError = new api_errors();
		$ttime  = substr($approved['time'], 0, strrpos ($approved['time'], ":"));

		//$error = ($ApiError->check($error)

		if 	($error != '0') {

			$error1 = 1;
			$answer = $ApiError->check($error);

		} else {

			$error1 = 0;
			$answer = "установлено предварительное время приема: $date $time";
		}

		$return_array = array('error' => $error1, 'answer' => $answer, 'done' => $approved['done'], 'date' => $approved['date'], 'time' => $ttime, 'stamp' => $approved['stamp']);

		echo json_encode($return_array);
	}

	function CheckAproved ($order_id){

		$AG = new api_get('Approve', 'key='.$_SESSION['login_token']['Key'].'&ApplicationID='.$order_id );
		$error = $AG->DataResult ('Error');
		$array = $AG->DataResults();

		return $array;
	}

}

?>
