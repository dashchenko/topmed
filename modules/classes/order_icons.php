<?

class order_icons {
	function TypeIcon ($int, $text, $id='')
	{
		switch ($int) {
			case '1':
				$icon = 'icon-pict-vrach';
				break;
			case '2':
				$icon = 'icon-pict-sto';
				break;
			case '3':
				$icon = 'icon-pict-mrt';
				break;
			case '4':
				$icon = 'icon-pict-ct';
				break;
			case '5':
				$icon = 'icon-pict-uzi';
				break;
			default:
				$icon = 'icon-pict-hosp';
				break;
		}

		if ($id == '') {
			$icon_string = '<div class="icon-pict '.$icon.'" title="'.$text.'"></div><p>'.$text.'</p>';
		} else {
			$icon_string = '<div class="icon-open-pict '.$icon.'" title="'.$text.'"></div><div class="icon-open-pict-id"># '.$id.'</div>';

		}

		return $icon_string;
	}
}

?>