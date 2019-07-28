<?
class setting {

	function __construct()	{
 		print '
 		<div class="order-no-row"><h3>Настройки</h3>

	 		<form id="form111" method=post autocomplete="false">
	 		<p>
	 			<div class="change_pass_form_text">Старый пароль: </div>
	 			<input class="change_pass_form" type="text" name="new1" placeholder="" autocomplete="off">
	 		</p>
	 		<p>
	 			<div class="change_pass_form_text">Новый пароль: </div>
	 			<input class="change_pass_form" type="text" name="new_password" placeholder="" autocomplete="off">
	 		</p>
			<button class="login-btn btn btn-secondary-outline btn-ch-pass" type="submit">Изменить</button>
			</form>

		</div>';
		

	}
}
?>
