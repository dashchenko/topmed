<?

function ApiConnect () {		
		$url = API_URL.$method;


		$post = array("key" => "key","P" => "pass", "L" => "login");

		$url = "http://smarthelptest.requestcatcher.com/";
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

ApiConnect();


?>