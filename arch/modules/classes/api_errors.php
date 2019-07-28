<?
class api_errors {

	function check($error) {		
		if ($error != '0') {
			switch ($error) {
				case '12':
					return "Для работы с этой заявкой вам необходимо заключить договор с заказчиком";
					break;
				case '11':
				case '10':
				case '7':
				case '3':
					return "Ошибка записи данных";
					break;
				case '9':
					return "Странная ошибка";
					break;
				case '8':
				case '6':
				return "Действие запрещено";
				break;
				case '5':
				return "Ошибка авторизации";
				break;			
				default:
				return "Системная ошибка: $error";
				break;
			}
		} else {
			return "0";
		}
	}
}
?>
