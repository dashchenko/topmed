
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">		
	<title>TESTTT</title>
</head>
<body>

<form action='' method="POST">
	<p>L <input type="text" name="L" size="50">
	<p>p <input type="text" name="P" size="50">
	<p> Encode<select name='encode'>
		<option value="no">no</option>
		<option value="sha1">sha1</option>
		<option value="base64">base64</option>		
	</select>
	<p><input type="submit" name="">
	</form>


	<?
	if ($_POST) {

		$url = "https://api3.smart-a.kiev.ua/topmed/validate";

		$data[] =  "L=".trim($_POST["L"]);
		$pass =  trim($_POST["P"]);

		switch ($_POST["encode"]) {
			case 'base64':
				$data[] =  "P=".base64_encode($pass);
				break;
			case 'sha1':
				$data[] =  "P=".sha1($pass);
				break;			
			default:
				$data[] =  "P=".$pass;
				break;
		}

		$AP = new api_post($url, $data);
	}



	class api_post {
		function __construct ($url, $post) {		
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS,  $post);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 

			$result=curl_exec($ch);
			$info = curl_getinfo($ch);
			$error = curl_error($ch);

			if($result === false) {
				$result = '??? curl: ' . curl_error($ch);
			} 
			curl_close($ch);
			$result1 = json_decode($result, true);

			print "Запрос POST: ";
			print_r ($post);
			print "<hr>Ответ json: $result<hr>";
			print "Декод json: $result1<hr>Массив внутри декода:<br>";
			print_r ($result1);
			print "<hr><br>Инфо: ";
			print_r ($info);
			print "<hr>Ошибка: ";
			print_r ($error);
			print "<hr>";

		}
		//function ResultArray 
	}



	?>
</body>
</html>
