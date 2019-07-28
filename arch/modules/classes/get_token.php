<?

class get_token
{
	function __construct ()	{
		
		$result = $this->PostForm ();
		if ($result[UserID] AND $result[UserID] != '0'){ 
			$_SESSION['login_token'] = $result;
			$_SESSION['login_pass'] = trim($_POST["P"]);
			unset ($_SESSION['login_error']);
		} else {
			$_SESSION['login_error'] = $result;
		}
	}
	public function PostForm ()	{

		$method = "validate";
		$pass =  trim($_POST["P"]);
		$login = trim($_POST["L"]);
		$data = array("L" => $login,"P" => sha1($pass));
		$AP = new api_post($method, $data);
		$result = $AP->ReturnData();
		return $result;

	}
}
?>
