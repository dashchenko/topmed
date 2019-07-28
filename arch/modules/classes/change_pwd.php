<?
class change_pwd {

	function __construct()	{


		$ODB = new order_db();
		$result = $ODB -> CheckTmp();

		if ($result != "0")	{
			print $this->form();
		} else {
			print "<meta http-equiv=\"refresh\" content=\"0;URL=100.html\">";
		}

	}

	function form()	{
		return '
		<div class="order-no-row"><h3>Новый пароль</h3>

		<form id="form112" method=post autocomplete="false">
		<p>
		<div class="change_pass_form_text">Пароль</div>
		<input class="change_pass_form" type="password" name="new1" autocomplete="off">
		</p>
		<p>
		<div class="change_pass_form_text">Пароль еще раз: </div>
		<input class="change_pass_form" type="password" name="new2" autocomplete="off">
		</p>
		<button class="login-btn btn btn-secondary-outline btn-ch-pass" type="submit">Сохранить</button>
		</form>

		</div>';
	}
}
?>
