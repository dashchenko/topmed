<?
session_start();
require_once('../../../modules/config.php');

class data_return {

	function __construct () {
		$ApiGet = new api_get('GetApplicationValues', 'ApplicationID='.$_GET[ad].'&key='.$_SESSION['login_token']['Key']);
		$error = $ApiGet->DataResult ('Error');
		$GetApplicationValues = $ApiGet->DataResults();
		//$GetApplicationValuesDebug = $ApiGet->DataResults("Debug");

		$ApiGet2 = new api_get('GetRequestsItems', 'ApplicationID='.$_GET[ad].'&key='.$_SESSION['login_token']['Key']);
		$error2 = $ApiGet2->DataResult ('Error');
		$GetRequestsItems = $ApiGet2->DataResults();

		print $this->InfoOrder($GetApplicationValues, $GetRequestsItems, $GetApplicationValuesDebug);

	}

	function InfoOrder($GetApplicationValues, $GetRequestsItems, $GetApplicationValuesDebug) {
		$return =  "<div class='modal-order-req-box'>";
			$return .=  "<div class='order-req-box-container-head'>Заявка №".$GetApplicationValues[ApplicationID]." от ".$GetApplicationValues[ApplicationStamp]."</div>";
			$return .=  "<div class='order-req-box-container-info'>";
				$return .=  "<div class='modal-order-req-box-line'>";
					$return .=  "<div class='modal-line-title'>Причина обращения: </div>";
				$return .=  "</div>";
				$return .=  "<div class='modal-order-req-box-line'>";
					$return .=  "<div class='modal-line-value'>$GetApplicationValues[ApplicationNotes]</div>";
				$return .=  "</div>";
				$return .=  "<div class='modal-order-req-box-line'>";
					$return .=  "<div class='modal-line-title'>Провайдер: </div>";
					$return .=  "<div class='modal-line-value'>$GetApplicationValues[ApplicationOwnerName]</div>";
				$return .=  "</div>";
				$return .=  "<div class='modal-order-req-box-line'>";
					$return .=  "<div class='modal-line-title'>Локация: </div>";
					$return .=  "<div class='modal-line-value'>$GetApplicationValues[ApplicationLocation]</div>";
				$return .=  "</div>";
				$return .=  "<div class='modal-order-req-box-line'>";
					$return .=  "<div class='modal-line-title'>Клиент: </div>";
					$return .=  "<div class='modal-line-value'>$GetApplicationValues[ApplicationPerson] (полис: ".$GetApplicationValues[ApplicationCardNo].")</div>";
				$return .=  "</div>";
				$return .=  "<div class='modal-order-req-box-line'>";
					$return .=  "<div class='modal-line-title'>Диагноз: </div>";
					$return .=  "<div class='modal-line-value'>". $GetApplicationValues[ApplicationFeedBackDS]."</div>";
				$return .=  "</div>";
				$return .=  "<div class='modal-order-req-box-line'>";
					$return .=  "<div class='modal-line-title'>Оказано: </div>";
				$return .=  "</div>";
				$return .=  "<div class='modal-order-req-box-line'>";
					$return .=  "<div class='modal-line-value'>". $GetApplicationValues[ApplicationFeedBackText].$GetApplicationValuesDebug."</div>";
				$return .=  "</div>";
				//$return .=  "<div class='modal-order-req-box-line'>";
					//$return .=  "<div class='modal-line-title'>Дата оказания: </div>";
					//$return .=  "<div class='modal-line-value'>".$GetRequestsItems[0][Stamp]."</div>";
				//$return .=  "</div>";
			$return .=  "</div>";

			if ($GetRequestsItems[0][Error] == 0) {
				$return .=  "<div class='order-req-box-container-chat'>";	
				$return .= $this->ChatList($GetRequestsItems);
				$return .=  "</div>";
			}		
		$return .=  "</div>";


		return $return;
	}

	function ChatList ($data) {

		if (is_array($data)) {
			$tttt .= "<div class='chat-list-cont'>";

			// КОСТЫЛЬ  $data[0][AnswerText] - рассово не верный способ понимать есть ли ответ на заявку и будет глючить при многомерном запросе
			if (!$data[0][AnswerText]) {					
				$tttt .= $this->ChatListForm($data[0]);	
			} else {
				$tttt .= $this->ChatListAnswer ($data[0]);
			}
			/////////////////////////////////////////////////////////////////////////
			foreach ( $data as $line ) {
				$tttt .= $this->ChatListAsk ($line);
			}
		} else {
			$tttt = "ошибка";
		}
			//$ttt= var_dump($data);
		$tttt .= "</div>";
		return $tttt;
	}

	function ChatListAsk ($line) {	
		$tttt .= "<div class='chat-list-request'>";
			$tttt .= "<div class='chat-list-request-author'>$line[AuthorName]</div>";
			$tttt .= "<div class='chat-list-request-text'><div>[$line[Stamp]]</div>".nl2br($line[RequestText])."</div>";
		$tttt .="</div>";
		return $tttt;
	}

	function ChatListAnswer ($data) {	
		$tttt .= "<div class='chat-list-answer'>";
			$tttt .= "<div class='chat-list-answer-author'>Ответ на запрос</div>";
			$tttt .= "<div class='chat-list-answer-text'>".nl2br($data[AnswerText])."</div>";
		$tttt .="</div>";
		return $tttt;
	}

	function ChatListForm ($data) {	
		$tttt .= "<div class='chat-list-form'><form id ='OrderSendAnsw' class='formName'>";
			$tttt .= "Шаблоны ответов: <br><button class='order-button-template'>Гарантируем покрытие в полном объеме</button>  <button class='order-button-template'>Не покрывается программой</button> ";
			$tttt .= "<textarea name='Answer' placeholder='Ответ'></textarea>";
			$tttt .= '<input type="hidden" name="ApplicationID" value="'.$data[ApplicationID].'">';
			$tttt .= '<input type="hidden" name="FeedBackID" value="'.$data[FeedBack_ID].'">';
			$tttt .= '<input type="hidden" name="RequestID" value="'.$data[Request_ID].'">';
			$tttt .= "<button type='button' class='btn btn-blue SendAnswerBtn' rel=>Отправить</button>";
		$tttt .= "</form></div>";	
		return $tttt;
	}
}


new data_return ();
?>
