<?


class progress_order {

	function SectionProgress (){

		$AG = new api_get('GetMyApplications', 'key='.$_SESSION['login_token']['Key']);
		$error = $AG->DataResult ('Error');
		$array = $AG->DataResults();

		if ($error == '0') {
			$result .= $this->DataTable($array);
		} elseif ($error == '2') {
			$result .= '<div class="order-no-row">записи отсутствуют</div>';
		}
		return $result;
	}


	function DataTable($data)	{

		$datetime1 = new DateTime();
		$tttt = 
		'<div class="divTable" >'.
			'<div class="divTableBody">';

		foreach ( $data as $line ) {

				$actions = $line[inStatus];

				$status_class = "status-class-".$line[State];

				$OI = new order_icons();

				$icon = $OI->TypeIcon($line[inTypeInt], $line[inType]);

				if (DEBUG == "on") $status_ = "status ".$line[State]." ";


				$tttt .= "<div class='order-cont-main ProgressingOrder ' rel='".$_GET[page].$line[inID]."'>";
				$tttt .= "<div class='order-cont-status $status_class' rel='$line[inID]'>$status_$actions</div>";
				$tttt .= "<div class='order-cont-text $status_class'>";

				$tttt .= "<div class='order-icon'>$icon</div>";
				$tttt .= "<div class='order-nfo'>";

				$tttt .= "<div class='order-nfo-text'>Заявка №$line[inID] <span class='fontawesome-array'></span> </div>";
				$tttt .= "<div class='order-nfo-text'>$line[inCustomerName] ($line[inApplicationCreatorUserName]) </div>";
				
				$tttt .= "<div>";

				$tttt .= "<div class='order-nfo-text'>$line[InFullName], возраст: $line[inPersonAge].</div>";
				$tttt .= "<div class='order-nfo-text'>Больничный: $line[inApplicationSicklist].</div>";
				$tttt .= "<div class='order-nfo-text'>$line[inApplicationPlace]. </div>";
				$tttt .="<div class='order-nfo-text'>$line[inApplicationDate] $line[inApplicationPartOfDay] ($line[inTimeFrom] - $line[inTimeTo])</div></div>";
				$tttt .= "</div></div></div>";

		}
		$tttt .= "</div></div>";
		return $tttt;	
	}
}

?>