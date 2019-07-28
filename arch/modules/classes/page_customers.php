<?
class page_customers {
	

	function CurrentSection(){
		if (isset($_POST["page"])) $page = $_POST["page"];
		elseif (isset($_GET["page"])) $page = $_GET["page"];
		else  $page = "100";

		switch ($page) {
			case '110':
				return 'SectionSended';
				break;
			case '120':
				return 'SectionSendedDay';
				break;
			case '300':
				return 'FormAdd';
				break;
			case '555':
				return 'SectionSetting';
				break;
			default:
			// страница 100 или все непонятные страницы
				return 'SectionRequest';
				break;
		}
	}

	public function SectionMain($page = "100")	{
		$section = $this->CurrentSection();		
		$content = $this->PegaMenu($page);
		$table = "<div class='main-container'>";

		$table .= $this->$section();
		$table .= "</div>";
		$feedback = new feedback();
		$feedback_res = $feedback->FeedBack();

		return $feedback_res.$content.$table;
	}

	public function PegaMenu($page)	{
		$class_punkt_100 = ($page=='100') ? "selected-punkt-menu" : "";
		$class_punkt_110 = ($page=='110') ? "selected-punkt-menu" : "";
		$class_punkt_120 = ($page=='120') ? "selected-punkt-menu" : "";
		$class_punkt_130 = ($page=='130') ? "selected-punkt-menu" : "";
		$class_punkt_555 = ($page=='555') ? "selected-punkt-menu" : "";

		ob_start();
		?>
		<div class="section_menu">
			<ul class="top_menu">
				<li class="blank-new-order"></li>
				<li class="<?=$class_punkt_100?>"><a href='100.html'>Запросы</a></li>
				<li class="<?=$class_punkt_110?>"><a href='110.html'>В ожидании</a></li>
				<li class="<?=$class_punkt_120?>"><a href='120.html'>История за сутки</a></li>
				<!--<li class="<?=$class_punkt_130?>"><a href='100.html'>Аналитика</a></li>-->
				<li class="<?=$class_punkt_555?>"><a href='555.html'><span class="fontawesome-setting" title="Настройки"></span></a></li>
				<li><a href='606.html'><span class="fontawesome-sing-out" title="exit"></span></a></li>
			</ul>
		</div>
		<?
		$content = ob_get_clean();

		return $content;
	}

	function SectionRequest (){

		$AGet = new api_get('GetCustomerApplicationsRequests', 'key='.$_SESSION['login_token']['Key']);
		$error = $AGet->DataResult ('Error');
		$array = $AGet->DataResults();

		if ($error == '0') {
			$actions = "<button class='button-catch'>взять</button>";
			$result = $this->DataTableRequest($array);
		} elseif ($error == '2') {
			$result = '<div class="order-no-row">записи отсутствуют</div>';
		}
		unset($array);
		return $result;
	}

	function SectionSendedDay (){

		//$today = date("d.m.Y", time());

		//$AG = new api_get('GetCustomerApplications', 'D='.$today.'&t=0&key='.$_SESSION['login_token']['Key']);
		$AG = new api_get('GetCustomerApplications', 't=3&key='.$_SESSION['login_token']['Key']);
		$error = $AG->DataResult ('Error');
		$array = $AG->DataResults();

		if ($error == '0') {
			$result = $this->DataTableHistory($array);
		} elseif ($error == '2') {
			$result = '<div class="order-no-row">записи отсутствуют</div>';
		}

		return $result;
	}

	function SectionSended (){

		$AG = new api_get('GetCustomerApplications', 't=4&key='.$_SESSION['login_token']['Key']);
		$error = $AG->DataResult ('Error');
		$array = $AG->DataResults();

		if ($error == '0') {
			$result = $this->DataTableSended($array);
		
		} elseif ($error == '2') {
			$result = '<div class="order-no-row">записи отсутствуют</div>';
		}


		return $result;
	}

	function SectionSetting (){

		ob_start();
		$sc = new setting();
		return ob_get_clean();
	}

	function FormAdd (){

		$method = "PostApplication";
		$DQ = new decode_query();	


		$AppPlace = $DQ->PostToBase64($_POST["AppPlace"]);
		$AppNotes = $DQ->PostToBase64($_POST["AppNotes"]);
		$AppCardNo = $DQ->PostToBase64($_POST["AppCardNo"]);
		$AppFN = $DQ->PostToBase64($_POST["AppFN"]);
		$AppCFN = $DQ->PostToBase64($_POST["AppCFN"]);

		if (!$AppCFN or empty($AppCFN)) $AppCFN = $AppFN;
		$AppFA = $DQ->PostToBase64($_POST["AppFA"]);
		$AppM = $DQ->PostToBase64($_POST["AppM"]);

		$AppSL = $_POST["AppSL"]; // ? "1" : "0";

		$time_to_stop = date("d.m.Y H:i:s", time() + $_POST["AppRelevanceDateTime"]*60);


		$data = array(
			"AppType" => $_POST["AppType"],
			"AppAge" => $_POST["AppAge"],
			"AppType" => $_POST["AppType"],
			"AppAge" => $_POST["AppAge"], 
			"AppDate" => $_POST["AppDate"],
			"AppPartOfDate" => $_POST["AppPartOfDate"],
			"AppRelevanceDateTime" => $time_to_stop,
			"AppSL" => $AppSL,
			"key" => $_SESSION['login_token']['Key'],
			"AppPlace" => $AppPlace,
			"AppNotes" => $AppNotes,
			"AppCardNo" => $AppCardNo,
			"AppFN" => $AppFN,
			"AppCFN" => $AppCFN,
			"AppFA" => $AppFA,
			"AppM" => $AppM,
			"AppPayer" => '0',
			"AppRegID2" => '0',
			"AppRegID1" => '0',
			"AppRecID" => '1'
		);

		$AP = new api_post($method, $data);
		$error = $AP->ErrorData();
		print "<meta http-equiv=\"refresh\" content=\"0;URL=100.html\">";

	}
/*
	function PostToBase64 ($data) {

		$data1 =  trim($data);
		$data2	= htmlspecialchars($data1,  ENT_QUOTES, 'utf-8');
		$data3 = base64_encode($data2);
		return $data3;

	}

*/
	function DataTableRequest ($data)	{
		$tttt = 
		'<h3 class="h3-title-section">Входящие</h3>'.
		'<div class="divTable" >'.
			'<div class="divTableHeading">'.
				'<div class="divTableRow">'.
					'<div class="divTableHead">Заявка</div>'.
					'<div class="divTableHead">Провайдер</div>'.
					'<div class="divTableHead">Клиент</div>'.
					'<div class="divTableHead">Диагноз</div>'.
					'<div class="divTableHead">Выполнено</div>'.
					'<div class="divTableHead">Статус</div>'.
				'</div>'.
			'</div>'.
			'<div class="divTableBody">';

		foreach ( $data as $line ) {

			$answer = $line[RNew]." ".$line[APending];
			if ($line[RNew]) {
				$answer = "<span class='fontawesome-warning order-new-request'></span>";
			} else {
				$answer = "<span class='fontawesome-clock order-pending'></span>";

			}

			$tttt .= "<div class='divTableRow openUnit' rel='$line[inID]'>";
			$tttt .= "<div class='divTableCell'>№$line[inID]</div>";
				$tttt .= "<div class='divTableCell'>$line[inProvider]</div>";
				$tttt .= "<div class='divTableCell'>$line[InFullName] (Полис: $line[InCardNo])</div>";
				$tttt .= "<div class='divTableCell'>$line[inDS]</div>";
				$tttt .= "<div class='divTableCell'>$line[inServed]</div>";
				$tttt .= "<div class='divTableCell order-status-cont'>$answer</div>";
			$tttt .= "</div>";
		}

		$tttt .= "</div></div>";
		return $tttt;	
	}
		function DataTableHistory ($data)	{
		$tttt = 
		'<h3 class="h3-title-section">История за сутки</h3>'.
		'<div class="divTable" >'.
			'<div class="divTableHeading">'.
				'<div class="divTableRow">'.
					'<div class="divTableHead">Провайдер</div>'.
					'<div class="divTableHead">Клиент</div>'.
					'<div class="divTableHead">Тип запроса</div>'.
					'<div class="divTableHead">Статус</div>'.
				'</div>'.
			'</div>'.
			'<div class="divTableBody">';

		foreach ( $data as $line ) {

			$tttt .= "<div class='divTableRow openUnit' rel='$line[inID]'>";
				$tttt .= "<div class='divTableCell'>$line[ProviderName]</div>";
				$tttt .= "<div class='divTableCell'>$line[InFullName] </div>";
				$tttt .= "<div class='divTableCell'>$line[inType]</div>";
				$tttt .= "<div class='divTableCell'>$line[ApplicationStatus]</div>";
			$tttt .= "</div>";
		}

		$tttt .= "</div></div>";
		return $tttt;	
	}


	function DataTableSended ($data)	{
		$tttt = 
		'<h3 class="h3-title-section">Отправленные</h3>'.
		'<div class="divTable" >'.
			'<div class="divTableHeading">'.
				'<div class="divTableRow">'.
					'<div class="divTableHead">Заявка</div>'.
					'<div class="divTableHead">Статус</div>'.
					'<div class="divTableHead">Клиент</div>'.
					'<div class="divTableHead">Тип запроса</div>'.
					
				'</div>'.
			'</div>'.
			'<div class="divTableBody">';

		foreach ( $data as $line ) {
			//print_r($line);

			$status =  ($line[ProviderName] == "-") ? $line[ApplicationStatus] : "Взял провайдер: ".$line[ProviderName];

			$tttt .= "<div class='divTableRow openUnit' rel='$line[inID]'>";
				$tttt .= "<div class='divTableCell'>№ $line[inID] от $line[inStamp]</div>";
				$tttt .= "<div class='divTableCell'>$status</div>";
				$tttt .= "<div class='divTableCell'>$line[InFullName] </div>";
				$tttt .= "<div class='divTableCell'>$line[inType]</div>";
				
			$tttt .= "</div>";
		}

		$tttt .= "</div></div>";
		return $tttt;	
	}

}



?>