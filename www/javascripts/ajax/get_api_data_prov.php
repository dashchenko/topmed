<?
session_start();
require_once('../../../modules/config.php');

class data_return {

	function __construct () {
		if ($_GET['mode'] != 'show') {
			$ApiGet = new api_get('GetAnswersItems', 'ApplicationID='.$_GET[ad].'&key='.$_SESSION['login_token']['Key']);
			$GetAnswersItems = $ApiGet->DataResults();
			print $this->InfoOrderAnswer($GetAnswersItems);
		} else {
			$ApiGet = new api_get('GetRequestsItems', 'ApplicationID='.$_GET[ad].'&key='.$_SESSION['login_token']['Key']);
			$GetRequestsItems = $ApiGet->DataResults();
			print $this->InfoOrderAskOnly($GetRequestsItems);
		}

		//$error = $ApiGet->DataResult ('Error');
		
		
		//print_r($GetAnswersItems);

	}

	function InfoOrderAnswer($GetAnswersItems) {
		$return =  "<div class='modal-order-req-box'>";
			$return .=  "<div class='order-req-box-container-head'>Заявка №".$_GET[ad]."</div>";
			$return .=  "<div class='order-req-box-container-chat'>";	
			$return .= $this->ChatList($GetAnswersItems);
			$return .=  "</div>";
			$return .=  "<button class='btn-blue stopPending' rel='".$GetAnswersItems[0][Answer_ID]."'>с ответом ознакомлен</button> <button class='CancelOrderBtn'>оставить непрочтенным</button>";
		$return .=  "</div>";
		return $return;
	}

	function InfoOrderAskOnly($GetRequestsItems) {
		$return =  "<div class='modal-order-req-box'>";
		$return .=  "<div class='order-req-box-container-head'>Заявка №".$_GET[ad]."</div>";
		$return .=  "<div class='order-req-box-container-chat'>";	

		if (is_array($GetRequestsItems)) {
			$return .= "<div class='chat-list-cont'>";
			foreach ( $GetRequestsItems as $line ) {
				$return .= $this->ChatListAsk ($line);
			}
			$return .= "</div>";
		} 

		$return .=  "</div>";
		$return .=  "</div>";
		return $return;
	}	

	function ChatList ($data) {

		if (is_array($data)) {
			$tttt .= "<div class='chat-list-cont'>";
			foreach ( $data as $line ) {
				$tttt .= $this->ChatListAnswer ($line);
				$tttt .= $this->ChatListAsk ($line);
			}
		} 
		
		return $tttt;
	}

	function ChatListAnswer ($line) {	
		$tttt .= "<div class='chat-list-request'>";
			$tttt .= "<div class='chat-list-request-author'>$line[AuthorName]</div>";
			$tttt .= "<div class='chat-list-request-text'><div>[$line[Stamp]]</div>".nl2br($line[AnswerText])."</div>";
		$tttt .="</div>";
		return $tttt;
	}

	function ChatListAsk ($data) {	
		$tttt .= "<div class='chat-list-answer'>";
			$tttt .= "<div class='chat-list-answer-author'>Запрос:</div>";
			$tttt .= "<div class='chat-list-answer-text'>".nl2br($data[RequestText])."</div>";
		$tttt .="</div>";
		return $tttt;
	}
}


new data_return ();
?>
