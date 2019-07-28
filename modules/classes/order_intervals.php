<?
class order_intervals {
	public function Check5Minutes($stamp) {

		$resullt = 0;

		if ($stamp['done'] == 1 ) {
		
			$date1 = new DateTime($stamp[stamp]);
			$date1->modify('+5 minutes');
			$stamp2 = $date1->format('d.m.Y H:i');

			$date3 = new DateTime();
			$date3->setTimezone(new DateTimeZone('+0300'));
			$stamp3 = $date3->format('d.m.Y H:i');

			if ($stamp3 >= $stamp2) $resullt = 1;
		}
		return $resullt;

	}
	public function IntervalSet($order) {
		
		$aproved_date =  $this->AprovedDate($order);
		$arr_params = $this->Intervals($order[inApplicationParams][intervals]);
		$stamp = $order[inApproved];

		if ($this->Check5Minutes($stamp) == 0) {

			ob_start();
			//print_r($order[inApproved]);
			?>

			<div class="OrderSectionParamTitle">Доступные интервалы времени:</div>
			<div class="OrderSectionParam" ><?=$arr_params?></div>
			<div class='hide' id="warning-time">время не сохранено</div>

			<?=$aproved_date?>
			<?
			return ob_get_clean();

		} else {
			$date = $order[inApproved][date];
			$time = $order[inApproved][time];
			$ttime  = substr($time, 0, strrpos ($time, ":"));

			return '<div class="OrderSectionParamTitle">Подтвержденное время приема:</div><div id="OrderSetDate" class="DateNotEditen font-blue"><span id="SelectedDay">'.$date.'</span><span id="SelectedDay">'.$ttime.'</span></div>';


		}

	}
	public function Intervals($data) {

		sort($data);

		$ttt = "<div class='order-interval-list'>";
		//$arr = $data[0];

		$day = 0;

		foreach ( $data as $line ) {

			$date = date("d.m.Y", strtotime($line['DateOfTimeInterval']));

			if ($day != $line['DateOfTimeInterval']) {

				$ttt .= ($day != 0) ? "</div>" : "";
				$ttt .="<div class='order-interval-newday' > $date";
				$day = $line['DateOfTimeInterval'];

			}

			$ttt .= "<div class='order-interval-inner' data-Date = '$date' data-minTime = '".$line['From']."' data-maxTime = '".$line['Untill']."'><div class='order-interval-time'>" . $line['From'] . "</div> &harr; ";
			$ttt .="<div class='order-interval-time'>" . $line['Untill'] ."</div></div>";

			//$ttt .= print_r($line, true);

		}
		$ttt .="</div></div>";
		return $ttt;
	}
	public function AprovedDate($order) {
		if ($order[inApproved][done] == 1) {
			$date = $order[inApproved][date];
			$time = $order[inApproved][time];
			$time  = substr($time, 0, strrpos ($time, ":"));
			$stamp = $order[inApproved][stamp];


			$class_hide = "";
			$class_aproved = "IntAproved";
			//$data_date_result = $date . " ". $time;
		} else {
			$date = '';
			$time = '';
			//$data_date_result = '';
			$class_hide = "hide";
			$class_aproved = "";
		}

		return '<div id="OrderSetDate" class="'.$class_hide.'" data-time="'.$time.'"
		data-stamp = "'.$stamp.'"><span id="SelectedDay">'.$date.'</span> <input class="time durationMinMax" type="text" value="'.$time.'" /> <a id="SetIntButtn" href="#" data-aplication-id = "'.$order['ApplicationID'].'" class="'.$class_aproved.'"></a></div>';
	}
}

?>