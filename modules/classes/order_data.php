<?

/*
class OrderStatus {
	function GetFuckingStatus ($status_arr){

		//if ($status_arr['R'] == 0 AND $status_arr['A'] == 0 AND $status_arr['P'] == 0) {
		//	return 0;
		//}

		if ($status_arr['R'] == $status_arr['A'] AND $status_arr['P'] == 0) {
			return 3;
		}
		if ($status_arr['P'] != 0) {
			return 2;
		} else {
			return 1;			
		}
	}
}
*/
class order_data {

	function order_data_section ($order) {

		switch ($order['inStatus']['State']) {
			case '0':
				return $this->InfoOrderAnswer($order);	
				break;	
			case '1':
				return $this->InfoButtons($order);	
				break;
			case '2':
				return $this->InfoOrderAskOnly($order);	
				break;	
			case '3':
				return $this->InfoOrderAnswer($order);	
				break;		
			case '4':
				return $this->InfoOrderAnswer($order, "all");	
				break;			
			default:
				break;
		}
	}



	function InfoButtons($order) {

		$id = $order[ApplicationID];

		$return .=  "<div id = 'current-status' class='order-req-box-container-head'>$order[ApplicationOperativeStatus]</div>";

		$return .= "<form id='form-sent-status' method='post'><input type='hidden' name='appid' value='$id'><input type='text' class='order-oper-status-input' name='operstat' placeholder='Оперативный статус'> <button class='btn-blue'>применить</button></form>";

		return "<div class='order-oper-status'>$return</div><button class='button-back' rel='$id'>вернуть</button> <button class='button-exec btn-blue' rel='$id'>выполнить</button>";
	}


	function InfoOrderAnswer($order, $all = '') {

		$id = $order[ApplicationID];

		$ApiGet = new api_get('GetChatRA', 'ApplicationID='.$id.'&key='.$_SESSION['login_token']['Key']);
		$GetAnswersItems = $ApiGet->DataResults();

		if ($GetAnswersItems[0][Error] != 2) {

			if ($all =='')	{
				$return1 =  "<div class='order-req-box-container-head'>Получен ответ, требует подтверждения</div>";
				$return2 =  "<button class='btn-blue stopPending' rel='".$order[ApplicationLastAnswerID]." ".$id."'>с ответом ознакомлен</button> <button class='button-exec2 btn-blue'>запросить еще</button>";
			} else {
				$return1 =  "<div class='order-req-box-container-head'>История обращений</div>";			
			}

			
			$return =  "<div class='modal-order-req-box'>";
				$return .= $return1.$return22;
				$return .=  "<div class='order-req-box-container-chat'>";
				$return .= $return2;	
				$return .= $this->ChatList($GetAnswersItems);
				$return .=  "</div></div>";

		} else {
			$return =  "";
		}

		return $return;
	}

	function InfoOrderAskOnly($order, $all = '') {

		$id = $order[ApplicationID];

		$ApiGet = new api_get('GetChatRA', 'ApplicationID='.$id.'&key='.$_SESSION['login_token']['Key']);
		$GetRequestsItems = $ApiGet->DataResults();

		$return =  "<div class='modal-order-req-box'>";
		$return .=  "<div class='order-req-box-container-head'>Отправлен запрос Заказчику</div>";
		$return .=  "<div class='order-req-box-container-chat'>";

		$return .= $this->ChatList($GetRequestsItems);
		$return .=  "</div></div>";
		return $return;
	}	

	function ChatList ($data) {

		if (is_array($data)) {
			$tttt .= "<div class='chat-list-cont'>";
			foreach ( $data as $line ) {
				if ($line[Answer_ID] != 0) $tttt .= $this->ChatListAnswer ($line);
				$tttt .= $this->ChatListAsk ($line);
			}
		} 
		return "</div>".$tttt;
	}

	function ChatListAnswer ($line) {	
		$tttt .= "<div class='chat-list-request'>";
			$tttt .= "<div class='chat-list-request-author'>$line[AnswerUserName]</div>";
			$tttt .= "<div class='chat-list-request-text'><div>[$line[AnswerStamp]]</div>".nl2br($line[AnswerText])."</div>";
		$tttt .="</div>";
		return $tttt;
	}

	function ChatListAsk ($data) {	
		$tttt .= "<div class='chat-list-answer'>";
			$tttt .= "<div class='chat-list-answer-author'>Запрос (".$data['RequestUserName']."):</div>";
			$tttt .= "<div class='chat-list-answer-text'><div>[$data[RequestStamp]]</div>".nl2br($data[RequestText])."</div>";
		$tttt .="</div>";
		return $tttt;
	}
}

?>
