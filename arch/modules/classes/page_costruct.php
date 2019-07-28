<?
class page_construct {
	
	function __construct() {

		$this->CheckConnect();
		if ($_GET['page'] == '606') $this->UserExit();
		if ($_GET['page'] == '607') $this->UserExitAnswer();
		if ($_GET['page'] == '417') $this->SetPwd();

		if ($_SESSION['login_token']) { // inside 

			// потом убрать в объект load_page() //////////////////////////////////////////

			if ($_SESSION['login_token']['UserRole'] == 1) {	// cutomers
				$Ppage = new page_customers();
			} else { 											// providers
				$Ppage = new page_providers();
			}

			$inside = $Ppage->SectionMain($_GET['page']);

			print $this->PageDesign($inside);

			////////////////////////////////////////////////////////////////////////////////

		} else {// нет входа
			if ($_POST) { // отправлены данные
				new get_token();
				print "<meta http-equiv=\"refresh\" content=\"0;URL=\">";
			} else { // форма входа
				$NP = new login();
				$inside = $NP->form();
				print $this->PageDesign($inside);
			}
		}
	}

	function SetPwd (){

		ob_start();
		$sc = new change_pwd();
		$inside = ob_get_clean();
		print $this->PageDesign($inside);
		exit;
	}

	public function PageDesign($inside)
	{		
		ob_start();
		?><!DOCTYPE html>
		<html>
		<head><meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">		
			<title><?=TITLE?></title>

		<link rel="stylesheet" type="text/css" href="css/modal.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/jquery-confirm.css" />
		<link rel="stylesheet" type="text/css" href="css/style_.css" media="all">

		<link rel="icon" href="icon.ico" type="image/x-icon">

		<script type="text/javascript" src="javascripts/jquery-1.11.2.js"></script>
		<script type="text/javascript" src="javascripts/jquery-ui.js"></script>
		<script type="text/javascript" src="javascripts/jquery.maskedinput-1.2.2.js"></script>
		<script type="text/javascript" src="javascripts/my.plug.js"></script>
		<script type="text/javascript" src="javascripts/jquery-confirm.js"></script>
		<script type="text/javascript" src="javascripts/loadingoverlay.js"></script>

		<script type="text/javascript" src="javascripts/myjq.js"></script>

		</head>
		<body><div class="page-wrapper">
		<div class="modal1" id="modal_wind" style="display: none">
			<div class="close_modal1_button closeModal">&#x2715;</div>
			<div id="modal_content"></div>
		</div>
			<?=$inside?>
		</div></body>
		</html>
		<?
		return ob_get_clean();
	}

	function UserExit() {
		$_SESSION = array();
		session_destroy();
		print "<meta http-equiv=\"refresh\" content=\"0;URL=100.html\">";
		exit;
		return false;
	}

	function UserExitAnswer() {
		$_SESSION = array();
		@session_destroy();
		$inside = 'Сессия устарела <a href="100.html">перезайти<a/>';
		print $this->PageDesign($inside);
		exit;
		return false;
	}

	function CheckConnect(){
		$CH = new api_valid();
		$connect = $CH->ConnectValid();
		if (!$connect) {
			$inside = 'Сервис недоступен';
			print $this->PageDesign($inside);
			exit;			
		}
		return true;
	}
}



?>
