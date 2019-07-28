<?

class login {


	function __construct() {

		if ($_SESSION['login_error'] AND $_GET['page'] == '012') $this->nom = 2;
		else $this->nom = 1;

	}

	function form (){
		$form = "form".$this->nom;
		return $this->$form();
	}

	function form1 () {

		if ($_SESSION['login_error']) $remind_password = "<a href='012.html'>Забыли пароль?</a>";
		
		ob_start();
		?>
		
		<div class="page-inner container">
				<div class="off-canvas-content">

		<main class="main" role="main">
			<div class="container">
				
				<div class="box-head box"><div class="logo-login"><img src="img/topmed.png" alt="SMART ISP" title="SMART ISP" style="max-height: 10rem"></div>
				</div>
				<div  class="login box enter_email" action="" method="POST">		
					<div class="form_enter">


						<form action='' method='POST'>	
							<div class="form-group">
								<p>
									<span class="fontawesome-envelope symbol"></span><input id="login-email" class="form-control" type="text" name="L" placeholder="Login">
								</p>
							</div>		

							<div class='form-group'>
								<p>
									<span class="fontawesome-lock symbol"></span><input class="form-control" type="password" id ="password_target" name="P" placeholder="Password">
								</p>
							</div>
							<div class='form-group'>
								<?=$remind_password?>
							</div>

							<div id="autorize_button_enter">
								<button class="login-btn btn btn-secondary-outline" type="submit">Вход</button>
							</div>
						</form>
					</div>
				</div>
				<div class="box box-end"></div>
			</div>
		</main></div></div>
		<?
		$return = ob_get_clean();
		return $return;
	}

	function form2 () {


		
		ob_start();
		?>
		
		<div class="page-inner container">
				<div class="off-canvas-content">

		<main class="main" role="main">
			<div class="container">
				
				<div class="box-head box"><div class="logo-login"><img src="img/topmed.png" alt="SMART ISP" title="SMART ISP" style="max-height: 10rem"></div>
				</div>
				<div  class="login box enter_email" action="" method="POST">		
					<div class="form_enter" id='rmd-pwd-answ'>


						<form id = 'form-rmd-pwd' method='POST'>	
							<div class='form-group'>
								<p>СБРОС ПАРОЛЯ</p>
							</div>
							<div class="form-group">
								<p>
									<span class="fontawesome-envelope symbol"></span><input id="login-email" class="form-control" type="text" name="L" placeholder="Login">
								</p>
							</div>		

							<div id="autorize_button_enter">
								<button class="login-btn btn btn-secondary-outline" type="submit">Сбросить пароль</button>
							</div>
						</form>
					</div>
				</div>
				<div class="box box-end"></div>
			</div>
		</main></div></div>
		<?
		$return = ob_get_clean();
		return $return;
	}

}

