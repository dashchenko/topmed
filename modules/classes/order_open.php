<?


class order_open {
	
	function Order($section, $id){

		$AG = new api_get('GetApplicationValues', 'key='.$_SESSION['login_token']['Key'].'&ApplicationID='.$id );
		$error = $AG->DataResult ('Error');
		$array = $AG->DataResults();

		if ($array[ApplicationID]) {
			return $this->OrderView($array);
		} else {
			print "<meta http-equiv=\"refresh\" content=\"0;URL=".$_GET[page].".html\">";
		}
	}
	function OrderView($order) {

		$status_class = "status-class-".$order['inStatus']['State'];		
		$OI = new order_icons();
		$icon = $OI->TypeIcon($order[ApplicationTypeInt], "", $order[ApplicationID]);
		$return .= "<div class='order-open-top-block $status_class' >$icon</div>";
		$return .= '<div class="OrderOpenCont '.$status_class.'">';
		
		$return.= $this->OrderViewHead($order, $status_class);
		$return.= $this->OrderViewBody($order);
		$return.= '</div>';
		return $return;
	}


	function OrderViewHead($order) {

		if ($order[ApplicationSFBR] == 1) $summ_text = '<div class="form-group1"><input type="number" placeholder="Сумма" class="form-control"  id="order-input-summ"></div>';
		else $summ_text = '';

		$OD = new order_data();
		$status = $OD->OrderStatus($order);	

		ob_start();
		?>

	<div class="modal1" id="modal_ds" style="display: none">
		<div class="close_modal1_button closeModal">&#x2715;</div>
		<div class="modal_content">
			<form id ="OrderSendForm" action="" class="formName">
				<div class="form-group1">
					<label>Диагноз</label>
					<input type="text" placeholder="Диагноз" class="DS form-control" >
				</div>
				<div class="form-group1">
					<label>Оказанные услуги /назначения </label>
					<textarea class="Served form-control" ></textarea>
				</div>

				<?=$summ_text?>

				<div class="form-group1">
					<div class="add-more-served"><input type="checkbox" id="checkbox1">
				 необходимы дополнительнительные назначения (требуется подтверждение от СК)</div>
				</div>
				<div class="form-group1 add-requred">
				</div>
				<div class="form-group1 modal-buttons2">
					<button type="button" class="btn btn-blue SendOrderBtn" rel="<?=$order['ApplicationID']?>">Отправить</button>
					<button type="button" class="btn btn-default CancelOrderBtn">Отмена</button>
				</div>
			</form>		
		</div>
	</div>

	<div class="modal1" id="modal_req" style="display: none">
		<div class="close_modal1_button closeModal">&#x2715;</div>
		<div class="modal_content">

			<form id ="OrderSendForm2" action="" class="formName">
				<div class="form-group1">
					<label>Запрос</label>
					<textarea class="Req form-control" ></textarea>
				</div>
				<div class="form-group1 modal-buttons2">
					<button type="button" class="btn btn-blue SendOrderBtn2" rel="<?=$order['ApplicationID']?> <?=$order['ApplicationFeedBackID']?>">Отправить</button>
					<button type="button" class="btn btn-default CancelOrderBtn">Отмена</button>
				</div>
			</form>
		</div>
	</div>

		<div class='OrderOpenClose' rel='<?=$_GET[page]?>'>+</div>
		<div class="OrderHeader">заявка №<?=$order['ApplicationID']?> <b><?=$order['ApplicationCustomerName']?></b> (<?=$order['ApplicationCustomerCreatorName']?>, тел.:<?=$order['ApplicationCustomerPhone']?>)</div>
		<?=$status?>
		<?
		return ob_get_clean();
	}

	function OrderViewBody($order) {


		//$debug = print_r($order, true);

		$return = '<div class="OrderBody">'.$debug;

		$return.= $this->OrderViewBodyPers($order);
		$return.= $this->OrderViewBodyOrder($order);
		$return.= $this->OrderViewBodyAction($order);
		//$return.= $this->OrderViewBodyParams($order);

		$return.= '</div>';
		$return.= $this->OrderViewFooter($order);
		return $return;

	}

	function OrderViewBodyPers($order) {
		$params = $this->OrderParams($order[inParams]);
		ob_start();
		?>
		<div class="OrderSectionHead">клиент</div>
		<div class="OrderSection OrderSectionPers">
			<div class="OrderSectionInnerBlock">
				<?=$order['ApplicationPerson']?>, <br>
				<?=$order['ApplicationPersonBirthday']?> (<?=$order['ApplicationPersonAge']?> лет)
			</div>
			<div class="OrderSectionInnerBlock">
				<span class='OrderSectionParamTitle'>Позвонить:</span> <br><a href="tel:<?=$order['ApplicationMobileNo']?>"><?=$order['ApplicationMobileNo']?></a>
			</div>			
			<div class="OrderSectionInnerBlock">
				<span class='OrderSectionParamTitle'>Полис:</span> <br><?=$order['ApplicationCardNo']?>
			</div>
			<div class="OrderSectionInnerBlock">
				<span class='OrderSectionParamTitle'>Параметры:</span> <ul><?=$params?></ul>
			</div>

		</div>
		<?
		return ob_get_clean();
	}

	function OrderViewBodyOrder($order) {
		
		$OI = new order_intervals();
		$intervals = $OI->IntervalSet($order);
		//$aproved_date =  $OI->AprovedDate($order);
		//$aplication_menu = $OI->AplicationMenu($order);

		$OM = new order_menu();
		$aplication_menu = $OM->Buttons($order);	


		ob_start();
		?>
		<div class="OrderSectionHead" id="AplicationSection"><?=$aplication_menu?>заявка</div>
		<div class="OrderSection">
			<div class="OrderSectionInnerBlock">
				<div class="OrderSectionParamTitle">Задача по заявке:</div>
				<div class="OrderSectionParam"><?=$order['ApplicationNotes']?></div>
			</div>			
			<div class="OrderSectionInnerBlock">
				<div class="OrderSectionParamTitle">Описание:</div>
				<div class="OrderSectionParam"><?=$order['ApplicationLocation']?>, <?=$order['ApplicationAdress']?></div>
			</div>
			<div class="OrderSectionInnerBlock">
				<?=$intervals?>
				

			</div>

		</div>

		<?
		return ob_get_clean();
	}

	function OrderViewBodyAction($order) {

		$ds = $this->Diagnos($order);
	
		$OD = new order_data();
		$actions = $OD->order_data_section($order);	

		ob_start();
		?>
		<div class="OrderSectionHead">действия</div>
		<div class="OrderSection align-center">
			<div class="OrderSectionParam"><?=$ds?><?=$actions?></div>

		</div>

		<?
		return ob_get_clean();
	}

	function Diagnos($value)
	{
		

		if ($value[ApplicationFeedBackDS]) {
			$tt = '<div class="order-ds"><span class="OrderSectionParamTitle">Дигноз:</span> '.$value[ApplicationFeedBackDS]."</div>";
			$tt .= '<div class="order-text"><DIV class="OrderSectionParamTitle">Описание:</div>'.$value[ApplicationFeedBackText]."</div>";

			if ($value[ApplicationFeedBackSum] > 0) $tt .= '<div class="order-text"><span class="OrderSectionParamTitle">Сумма:</span> '.$value[ApplicationFeedBackSum]."</div>";

		} else {
			$tt = '';
		}

		return $tt;
	}

/*	function OrderViewBodyParams($order) {

		$params = $this->OrderParams($order[inParams]);
		$return = '<div class="OrderSectionHead">параметры</div>';
		$return.= '<div class="OrderSection">';
		$return.= $params;
		$return.= '</div>';
		return $return;
	}*/

	function OrderParams($inParams)
	{
		foreach ( $inParams as $key => $value ) {

			$IP = new InParams();

			$param = $IP->Param($key);
	
			$return .= "<li><span class='OrderSectionParamTitle'>$param:</span> $value</li>";
		}

		return $return;
	}


	function OrderViewFooter() {
		return '<div class="OrderFooter"> </div>';
	}
}

?>

