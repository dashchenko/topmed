<?


class page_providers {
	
	function CurrentSection(){
		if (isset($_POST["page"])) $page = $_POST["page"];
		elseif (isset($_GET["page"])) $page = $_GET["page"];
		else  $page = "100";

		switch ($page) {
			case '110':
				return 'SectionInProgress';
				break;
			case '120':
				return 'SectionComplited';
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

	public function SectionMain($page='100')	{
		$section = $this->CurrentSection();		
		$content = $this->PegaMenu($page);
		$table = "<div class='main-container'>";
		$table .= $this->$section();
		$table .= "</div>";

		return $content.$table;
	}

	public function PegaMenu($page)	{		
		$class_punkt_100 = ($page=='100') ? "selected-punkt-menu" : "";
		$class_punkt_110 = ($page=='110') ? "selected-punkt-menu" : "";
		$class_punkt_120 = ($page=='120') ? "selected-punkt-menu" : "";
		$class_punkt_555 = ($page=='555') ? "selected-punkt-menu" : "";

		ob_start();
		?>
		<div class="section_menu">
			<ul class="top_menu">
				<li class="<?=$class_punkt_100?>"><a href='100.html'>новые</a></li>
				<li class="<?=$class_punkt_110?>"><a href='110.html'>в работе</a></li>
				<li class="<?=$class_punkt_120?>"><a href='120.html'>закрытые</a></li>
				<li class="<?=$class_punkt_555?>"><a href='555.html'><span class="fontawesome-setting" title="Настройки"></span></a></li>
				<li><a href='606.html'><span class="fontawesome-sing-out" title="exit"></span></a></li>
			</ul>
		</div>
		<?
		$content = ob_get_clean();
		return $content;
	}

	function SectionNew (){

		$AG = new api_get('GetApplications', 'key='.$_SESSION['login_token']['Key']);
		$error = $AG->DataResult ('Error');
		$array = $AG->DataResults();

		$result = "<h3 class='h3-title-section'>Новые заявки</h3>";
		if ($error == '0') {
			$result .= $this->DataTableNew($array);
		} elseif ($error == '2') {
			$result .= '<div class="order-no-row">записи отсутствуют</div>';
		}

		return $result;
	}

	function SectionInProgress (){

		$AG = new api_get('GetMyApplications', 'key='.$_SESSION['login_token']['Key']);
		$error = $AG->DataResult ('Error');
		$array = $AG->DataResults();

		$result = "<h3 class='h3-title-section'>В работе</h3>";
		if ($error == '0') {
			$result .= $this->DataTableInProgress($array);
		} elseif ($error == '2') {
			$result .= '<div class="order-no-row">записи отсутствуют</div>';
		}

		return $result;
	}

	function SectionComplited (){

		$AG = new api_get('GetMyApplications', 'key='.$_SESSION['login_token']['Key'].'&complited=true');
		$error = $AG->DataResult ('Error');
		$array = $AG->DataResults();

		$result ='<h3 class="h3-title-section">Закрытые</h3>';
		if ($error == '0') {
			$result .= $this->DataTableComplited($array);
		} elseif ($error == '2') {
			$result .= '<div class="order-no-row">записи отсутствуют</div>';
		}
		return $result;
	}

	function SectionSetting (){

		ob_start();
		$sc = new setting();
		return ob_get_clean();
	}

	function DataTableNew($data)	{

		$datetime1 = new DateTime();
		$tttt = 
		'<div class="divTable" >'.
			'<div class="divTableHeading">'.
				'<div class="divTableRow">'.
					'<div class="divTableHead">Заявка</div>'.
					'<div class="divTableHead">Время</div>'.
					'<div class="divTableHead">Тип</div>'.
					'<div class="divTableHead">Место</div>'.
					'<div class="divTableHead">Возраст</div>'.
					'<div class="divTableHead">Б/л</div>'.
					'<div class="divTableHead">Заказчик</div>'.
					'<div class="divTableHead">Период</div>'.
				'</div>'.
			'</div>'.
			'<div class="divTableBody">';

		foreach ( $data as $line ) {

			//$datetime1 = new DateTime();

			$datetime2 = new DateTime($line[inApplicationRelevanceDateTime]);
			$interval = $datetime1->diff($datetime2);
			$datetime3=$datetime2->format('Y-m-d H:i:s');

			$znak =$interval->format('%r');
			$days =$interval->format('%a дней ');
			$days_null =$interval->format('%a');
			$dddd = $interval->format("%H:%I:%S");
			$class_redd = "1";
			$actual_time = ($days_null != '0') ? $days.$dddd : $dddd;
			if (!$znak)  { //если отрицательное не время

			$tttt .= "<div class='divTableRow CatchNewOrder' rel='$line[inID]'>";
				$tttt .= "<div class='divTableCell'>№$line[inID]</div>";
				$tttt .= "<div class='divTableCell'><span class='timers' rel='$datetime3'>".$actual_time."</span></div>";
				$tttt .= "<div class='divTableCell'>$line[inType]</div>";
				$tttt .= "<div class='divTableCell'>$line[inApplicationPlace] </div>";
				$tttt .= "<div class='divTableCell'>$line[inPersonAge]</div>";
				$tttt .= "<div class='divTableCell'>$line[inApplicationSicklist]</div>";
				$tttt .= "<div class='divTableCell'>$line[inCustomerName]</div>";
				$tttt .="<div class='divTableCell'>$line[inApplicationDate] $line[inApplicationPartOfDay]</div>";
			$tttt .= "</div>";

			}
			//$class_redd = "time-red";


		}
		$tttt .= "</div></div>";
		return $tttt;	
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
				$tttt .= "<div class='divTableCell'>$line[inApplicationDate] $line[inApplicationPartOfDay]</div>";
				$tttt .= "<div class='divTableCell'>$actions</div>";
				$tttt .= "<div class='divTableCell'>$line[InFullName] (лет: $line[inPersonAge])</div>";
				$tttt .= "<div class='divTableCell'>$line[inApplicationSicklist]</div>";
				$tttt .= "<div class='divTableCell'>$line[inCustomerName]</div>";
				$tttt .= "<div class='divTableCell'>$line[inApplicationPlace]</div>";
			$tttt .= "</div>";
		}
		$tttt .= "</div></div>";
		return $tttt;	
	}
}

?>