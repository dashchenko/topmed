<?

class decode_query {

	function PostToBase64 ($data) {

		$data1 =  trim($data);
		$data2	= htmlspecialchars($data1,  ENT_QUOTES, 'utf-8');
		$data3 = base64_encode($data2);
		return $data3;
	}
}
?>
