<?
class api_valid {

	public function __construct()	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL,API_URL."connect");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
		$this->result = curl_exec($ch);
		curl_close($ch);
	}

	public function ConnectValid()	{
		$result = $this->result;
		$return = "1";
		if($result === false) {
			$return = "0";
		} else {
			$result1 = json_decode($result, true);
			$error = $result1[0]["Error"];
			if ($result1["Error"]) {
				$return = "0";
			}
		}
		if ($return == "1") return true;
		else return false;
	}
}

class api_post {
	function __construct ($method, $post) {		
		$data = $this->ApiConnect ($method, $post);
		$this->result = $data;
		$TokenCheck = new TokenCheck ($data);
	}

	function ApiConnect ($method, $post) {		
		$url = API_URL.$method;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query($post));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 

		$info = curl_getinfo($ch);
		$error = curl_error($ch);
		$result=curl_exec($ch);

		if($result === false) {
			$result1  = array('Error' => 'error curl: '.curl_error($ch));
		}
		curl_close($ch);

		if (!$result1) $result1 = json_decode($result, true);
		return  $result1;
	}

	public function ReturnData() {
		$data = $this->result;
		return $data;
	}

	public function ErrorData() {
		$data = $this->result;
		return  $data[0]["Error"];
	}
}

class api_get {
	function __construct ($method, $data)  {
		$url = API_URL.$method."?".$data;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);

		$result_jsone=curl_exec($ch);
		curl_close($ch);

		if ($result_jsone === false) {
			$result = array(array('Error'=>'150'));
		} else {

			//print $result_jsone;

			//$result_jsone = str_replace(array("\r\n", "\r"), "\n", $result_jsone);
			//$result_jsone = preg_replace("/[\r\n]+/", "", $result_jsone);

			$result = json_decode($result_jsone, true);

			//$result = $result_jsone;
			//print $result_jsone;
			//$json = utf8_encode($result_jsone);
		}
		$this->result_array = $result;
		$this->result_debug = $result_jsone;
		//array_walk($result1, function(&$val){$val = html_entity_decode(nl2br($val));});

		$TokenCheck = new TokenCheck ($result);
		//print_r($result_jsone);
		//print_r($result1);
	}



	function ArrayDecode ($data) {

		function replace_unicode_escape($match) {
			return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
		}
		function unicode_decode2(&$item1) {
			return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape', $item1);
		}
		$data = unicode_decode2($data);
		//$data = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape', $data);
		//array_walk($data, 'unicode_decode2');
		return $data;
	}

	function DataResults ($mode = "normal") {
		if ($mode == "normal") {
			return $this->result_array;
		} else {
			return $this->result_debug;		
		}
	}

	function DataResult ($data,$num='0') {
		return $this->result_array[$num][$data];
	}	
}

class TokenCheck {
	function __construct($result){		
		$error = $result[0]["Error"];
		if ($error == '5') print "<meta http-equiv=\"refresh\" content=\"0;URL=607.html\">";
	}
}
?>

	