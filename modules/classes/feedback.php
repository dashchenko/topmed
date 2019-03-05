<?
class feedback {
	public function __construct() {

		//$this->SQLclass	= new DbaseSelect();
		//print $this->Page($page);

	}
	
	public function FeedBackAddForm () {	
		$date =  date('d.m.Y');
	
		return '
		<div class="form-feedback">
			<form method="post" action="300.html">
				<div class="form-table-2">
					<div class="form-group">
						<div class="input-title">Тип услуги:</div>
						<div class="input-input"><select name="AppType">
							<option value="1">Врач на дом</option>
							<option value="2">Стоматология</option>
							<option value="3">Диагностика / МРТ</option>
							<option value="4">Диагностика / КТ</option>
							<option value="4">Диагностика / УЗИ</option>
							
						</select></div>
					</div>			
					<div class="form-group">
						<div class="input-title">Актуальна (мин.):</div>
						<div class="input-input"><input type="number" name="AppRelevanceDateTime" value="60" class = "form-order-top field-input-check fop-short"></div>
					</div>			
					<div class="form-group">
						<div class="input-title">ФИО:</div>
						<div class="input-input"><input class = "form-order-top field-input-check fop-long" type="text" name="AppFN"></div>
					</div>					

					<div class="form-group">
						<div class="input-title">Полных лет:</div>
						<div class="input-input"><input type="number" name="AppAge" class = "form-order-top field-input-check fop-short"></div>
					</div>

					<div class="form-group">
						<div class="input-title">Полис:</div>
						<div class="input-input"><input class = "form-order-top field-input-check fop-long" type="text" name="AppCardNo"></div>
					</div>
					<div class="form-group">			
						<div class="input-title">Телефон:</div>
						<div class="input-input"><input class = "form-order-top field-input-check fop-medium" type="text" name="AppM"></div>
					</div>

					<div class="form-group">
						<div class="input-title">Контактное лицо:</div>
						<div class="input-input"><input class = "form-order-top fop-long" type="text" name="AppCFN"></div>
					</div>
					<div class="form-group">
						<div class="input-title">Адрес:</div>
						<div class="input-input"> <textarea class = "form-order-top field-input-check fop-long" name="AppFA"></textarea></div>
					</div>

					<div class="form-group">
						<div class="input-title">Локация:</div>
						<div class="input-input"><input class = "form-order-top field-input-check fop-long" type="text" name="AppPlace"></div>

					</div>

					<div class="form-group">

						<div class="input-title">Дата выполнения:</div>
						<div class="input-input"><input type="text" class="datepicker form-order-top field-input-check fop-medium field-input-check" name="AppDate" autocomplete="off" value="'.$date.'"></div>

					</div>
					<div class="form-group">

						<div class="input-title">Время дня:</div>
						<div class="input-input">
							<select name="AppPartOfDate">
								<option value="0">В течение дня</option>
								<option value="1">Утро</option>
								<option value="2">День</option>
								<option value="3">Вечер</option>
								<option value="4">Как можно скорее</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="input-title">Описание:</div>
						<div class="input-input"><textarea class = "form-order-top field-input-check fop-long" name="AppNotes"></textarea></div>
					</div>

					<div class="form-group">
						<div class="input-title"></div>
						<div class="input-input">
							<select name="AppSL">
								<option value="0">Больничный не нужен</option>
								<option value="1">Больничный нужен</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="input-title"></div>
						<div class="input-input">
							<button type="submit" class="btn btn-secondary-outline form-check">Отправить</button>
						</div>
					</div>

				</div>

			</form>
		</div>';


	}

	public function FbRecords() {
		$DT = new date_time();
		$sql = "SELECT `User`, `Text`, `DateSt` FROM feedback WHERE `Status` = 'on' ORDER BY `DateSt` DESC";
		$result = mysql_query($sql) or die(mysql_error());
		if(mysql_num_rows($result)) {
			while($row=mysql_fetch_array($result)) {
				$dd = $DT->ddd_tt($row['DateSt']);
				$return .= $this->FBStyle($row['User'], $row['Text'], $dd);
			}
		}
		return $return;
	}

	public function FBStyle($uu, $tt, $dd) {
		return "<div class='fedback-text-h'>$uu ($dd)</div><div class='fedback-text-t'>$tt</div>";
	}




	public function FeedBack () {	

		//$fb_rec = $this->FbRecords();



		$form = $this->FeedBackAddForm();

		//$page_id = $this->SQLclass->selectRow("content_pages", "id", "Link = '$page'");
		//$record_id = $this->SQLclass->selectRow("cont_to_page", "ContentID", "PageID = '$page_id'");
		//$record_arr = $this->SQLclass->selectRow("content_records", "ContTitle, ContText", "id = '$record_id'", "arr");
		//$foto = ;

		return '
		<div class="feedback-area container">
			<div class="feedback-container hidden">

				'.$form.$fb_rec.'
			</div>			
			<div class="feedback-head">
				<div id="" class="feedback-button">Новая заявка</div>
			</div>	
		</div>';
	}
}
	
?>