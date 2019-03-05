<?


class new_order {

	function SectionNew (){

		$AG = new api_get('GetApplications', 'key='.$_SESSION['login_token']['Key']);
		$error = $AG->DataResult ('Error');
		$array = $AG->DataResults();

		//$result = "<h3 class='h3-title-section'>Новые заявки</h3>";
		if ($error == '0') {
			$result .= $this->DataTableNew($array);
		} elseif ($error == '2') {
			$result .= '<div class="order-no-row">записи отсутствуют</div>';
		}
		return $result;
	}


	function DataTableNew($data)	{

		$datetime1 = new DateTime();
		$tttt = 
		'<div class="divTable" >'.
			'<div class="divTableBody">';

		foreach ( $data as $line ) {

			$datetime2 = new DateTime($line[inApplicationRelevanceDateTime]);
			$interval = $datetime1->diff($datetime2);
			$datetime3=$datetime2->format('Y-m-d H:i:s');

			$znak =$interval->format('%r');
			$days =$interval->format('%a дней ');
			$days_null =$interval->format('%a');
			$dddd = $interval->format("%H:%I:%S");
			//$class_redd = "1";
			$actual_time = ($days_null != '0') ? $days.$dddd : $dddd;
			if (!$znak)  { //если отрицательное не время

				$OI = new order_icons();

				$icon = $OI->TypeIcon($line[inTypeInt], $line[inType]);

				
				$tttt .= "<div class='order-cont-main CatchNewOrder' rel='$line[inID]'>";
				$tttt .= "<div class='order-cont-timer' rel='$line[inID]'>доступна: <span class='timers' rel='$datetime3'>".$actual_time."</span></div>";
				$tttt .= "<div class='order-cont-text'>";

				$tttt .= "<div class='order-icon'>$icon</div>";
				$tttt .= "<div class='order-nfo'>";

				$tttt .= "<div class='order-nfo-text'>Заявка №$line[inID] <span class='fontawesome-array'></span> </div>";
				$tttt .= "<div class='order-nfo-text'>$line[inCustomerName]</div><div>";
				$tttt .= "<div class='order-nfo-text'>Пациент, возраст: $line[inPersonAge].</div>";
				$tttt .= "<div class='order-nfo-text'>Больничный: $line[inApplicationSicklist].</div>";
				$tttt .= "<div class='order-nfo-text'>$line[inApplicationPlace]. </div>";
				$tttt .="<div class='order-nfo-text'>$line[inApplicationDate] $line[inApplicationPartOfDay] ($line[inTimeFrom] - $line[inTimeTo])</div></div>";
				$tttt .= "</div></div></div>";
			}

		}
		$tttt .= "</div></div>";
		return $tttt;	
	}


	function TypeIcon ($int, $text)
	{
		switch ($int) {
			case '1':
				$icon = 'vrach';
				break;
			case '2':
				$icon = 'sto';
				break;
			case '3':
				$icon = 'mrt';
				break;
			case '4':
				$icon = 'kt';
				break;

			case '5':
				$icon = 'uzi';
				break;
			default:
				$icon = 'policlinica';
				break;
		}

		$icon_string = '<span class="fontawesome-'.$icon.'" title="'.$text.'"></span><p>'.$text.'</p>';



		return $icon_string;
	}
}

?>