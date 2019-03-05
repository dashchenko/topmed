<?


class page_providers {
	
	function CurrentSection(){
		if (isset($_POST["page"])) $page = $_POST["page"];
		elseif (isset($_GET["page"])) $page = $_GET["page"];
		else  $page = "100";

		if ($_GET["var"]) {
			return 'OpenOreder';
		} else {

			switch ($page) {
				case '110':
					return 'SectionInProgress';
					break;
				case '120':
					return 'Section24';
					break;
				case '140':
					return 'SectionDate';
					break;

				case '555':
					return 'SectionSetting';
					break;
				default:
				// страница 100 или все непонятные страницы
					return 'SectionNew';
					//$this->result = $this->SectionMain($section);
					break;
			}
		}
	}

	public function OpenOreder($page='100')	{
		$section = new order_open();
		$return = $section->Order("provider", $_GET["var"]);		

		return $return;
	}

	public function SectionMain($page='100')	{
		$section = $this->CurrentSection();		
		$content = $this->PageMenu($page);
		$table = "<div class='main-container'>";
		$table .= $this->$section();
		$table .= "</div>";

		return $content.$table;
	}

	public function PageMenu($page)	{		
		$class_punkt_100 = ($page=='100') ? "selected-punkt-menu" : "";
		$class_punkt_110 = ($page=='110') ? "selected-punkt-menu" : "";
		$class_punkt_120 = ($page=='120') ? "selected-punkt-menu" : "";
		$class_punkt_140 = ($page=='140') ? "selected-punkt-menu" : "";
		$class_punkt_555 = ($page=='555') ? "selected-punkt-menu" : "";

		ob_start();
		?>
		<div class="section_menu">
			<ul class="top_menu">
				<li class="<?=$class_punkt_100?>"><a href='100.html'>новые</a></li>
				<li class="<?=$class_punkt_110?>"><a href='110.html'>в работе</a></li>
				<li class="<?=$class_punkt_120?>"><a href='120.html'>24h</a></li>
				<li class="<?=$class_punkt_140?>"><a href='140.html'><span class="fontawesome-calendar" title="Настройки"></span></a></li>
				<li class="<?=$class_punkt_555?>"><a href='555.html'><span class="fontawesome-setting" title="Настройки"></span></a></li>
				<li><a href='606.html'><span class="fontawesome-sing-out" title="exit"></span></a></li>
			</ul>
		</div>
		<?
		$content = ob_get_clean();
		return $content;
	}

	function SectionNew (){

		$SN = new new_order();
		return $SN -> SectionNew();
	}

	function SectionInProgress (){

		$SP = new progress_order();
		return $SP -> SectionProgress();
	}

	function Section24 ($date=''){

		if ($date == '') {
			$param = 'key='.$_SESSION['login_token']['Key'].'&complited=true';
		} else {
			$param = 'key='.$_SESSION['login_token']['Key'].'&complited=true&date='.$date;
		}

		$AG = new api_get('GetMyApplications', $param);
		$error = $AG->DataResult ('Error');
		$array = $AG->DataResults();

		if ($date) $tttt_date = "<div clas='date-title'>заявки за $date</div>";

		$result ='<h3 class="h3-title-section">24h</h3>';
		if ($error == '0') {
			$PO = new progress_order();
			$result .= $PO->DataTable($array);
			//$result .= $this->DataTableComplited($array);
		} elseif ($error == '2') {
			$result .= '<div class="order-no-row">записи отсутствуют</div>';
		}
		return $tttt_date.$result;
	}

	function SectionDate()	{

		$result ='<form method="post">Выберите дату: 
					<input type="text" class="datepicker form-order-top field-input-check fop-medium field-input-check" name="date" autocomplete="off" value="'.$date.'"> <button>показать</button></form>';
		if ($_POST[date]) {
			$result .= "<hr>".$this->Section24($_POST[date]);
		}

		return $result;
	}


	function SectionSetting (){

		ob_start();
		$sc = new setting();
		return ob_get_clean();
	}


	function DataTableComplited($data)	{

		
		$tttt = 
		'<div class="divTable" >'.
			'<div class="divTableHeading">'.
				'<div class="divTableRow">'.
					'<div class="divTableHead">Заявка</div>'.
					'<div class="divTableHead">Период</div>'.
					'<div class="divTableHead">Клиент (возраст)</div>'.
					'<div class="divTableHead">Диагноз</div>'.
					'<div class="divTableHead">Заказчик</div>'.
					'<div class="divTableHead">Тип услуги</div>'.
				'</div>'.
			'</div>'.
			'<div class="divTableBody">';

		foreach ( $data as $line ) {

			$tttt .= "<div class='divTableRow ProgressingOrder' rel='$line[inID]'>";
				$tttt .= "<div class='divTableCell'>№$line[inID]</div>";
				$tttt .= "<div class='divTableCell'>$line[inApplicationDate] $line[inApplicationPartOfDay]</div>";
				$tttt .= "<div class='divTableCell'>$line[InFullName] (лет: $line[inPersonAge])</div>";
				$tttt .= "<div class='divTableCell'>$line[inDS]</div>";
				$tttt .= "<div class='divTableCell'>$line[inCustomerName]</div>";
				$tttt .= "<div class='divTableCell'>$line[inType]</div>";
			$tttt .= "</div>";
		}
		$tttt .= "</div></div>";
		return $tttt;	
	}


	function DataTableInProgress($data)	{
		$tttt = 
		'<div class="divTable" >'.
			'<div class="divTableHeading">'.
				'<div class="divTableRow">'.
					'<div class="divTableHead">Заявка</div>'.
					'<div class="divTableHead">Период</div>'.
					'<div class="divTableHead">Статус</div>'.
					'<div class="divTableHead">Клиент (возраст)</div>'.
					'<div class="divTableHead">б/л</div>'.
					'<div class="divTableHead">Заказчик</div>'.
					'<div class="divTableHead">Локация</div>'.
				'</div>'.
			'</div>'.
			'<div class="divTableBody">';

		foreach ( $data as $line ) {
			$actions_class = "";
			if ($line[State] == "0" and $line[inApplicationCurrentStatus] == 8) { // КОСТЫЛЬ если ожидает действия провайдера
				$actions_class = "orderPending";
				$actions = "<div class='order-pending-answer'>получен ответ</div>";
			} elseif($line[State] == "-1" and $line[inApplicationCurrentStatus] == 8) {
				$actions_class = "waitingShow";
				$actions = "<div class='order-wait-answer'>ожидание ответа</div>";
			} else {
				$actions = "<button class='button-back '>вернуть</button> <button class='button-exec btn-blue'>выполнить</button>";
			}
		
			$tttt .= "<div class='divTableRow ProgressingOrder $actions_class' rel='$line[inID]'>";
				$tttt .= "<div class='divTableCell'>№$line[inID]</div>";
				$tttt .= "<div class='divTableCell'>$line[inApplicationDate] $line[inApplicationPartOfDay] ($line[inTimeFrom] - $line[inTimeTo])</div>";
				$tttt .= "<div class='divTableCell'>$actions</div>";
				$tttt .= "<div class='divTableCell'>$line[InFullName] (лет: $line[inPersonAge])</div>";
				$tttt .= "<div class='divTableCell'>$line[inApplicationSicklist]</div>";
				$tttt .= "<div class='divTableCell'>$line[inCustomerName] ($line[inApplicationCreatorUserName])</div>";
				$tttt .= "<div class='divTableCell'>$line[inApplicationPlace]</div>";
			$tttt .= "</div>";
		}
		$tttt .= "</div></div>";
		return $tttt;	
	}
}

?>