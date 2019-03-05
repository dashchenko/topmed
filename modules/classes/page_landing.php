<?

class page_landing {

	function __construct() {
		print $this->LandBody();
	}

	
	function LandBody () {

		ob_start();
		?>
		
<!DOCTYPE html>
<html>
	<head><meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">		
			<title><?=TITLE?></title>


		<link rel="icon" href="icon.ico" type="image/x-icon">

		<script type="text/javascript" src="javascripts/jquery-1.11.2.js"></script>
		<script type="text/javascript" src="javascripts/my.plug.js"></script>
		<script type="text/javascript" src="javascripts/jquery-confirm.js"></script>
		<script type="text/javascript" src="javascripts/myjq.js"></script>

	<link rel="stylesheet" type="text/css" href="css/slick.css">
	<link rel="stylesheet" type="text/css" href="css/stylettt.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/jquery-confirm.css" />
		<link rel="stylesheet" type="text/css" href="css/modal.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" media="all">	

	<link href="https://fonts.googleapis.com/css?family=PT+Sans+Caption|Ubuntu" rel="stylesheet">
</head>
<body>
<div class="container-600">	
	<div class="header-600">
		<img src="img/topmed.png">
	</div>

	<hr>
	<div class="button-600">
		<button class="btn-600">Войти в кабинет</button>
	</div>
	<div class="main-singup-form-600">
		<p class="title-600">интеллектуальная коммуникационная платформа</p>
		<p class="sub-title-600">
		Предлагаемая интеллектуальная коммуникационная платформа TOPMED – это удобная облачная среда для передачи, обработки и хранения информации, объединяющая в себе аппаратные средства, программное обеспечение, каналы связи, техническую поддержку пользователей, и имеющая возможности и преимущества</p>
		
		<p class="sub-title-small-600">Зарегистрироваться <span class="btn-box-600">Сейчас</span></p>
		<form class="reg-form-600" method="POST">
			<input type="" name="L" placeholder="enter your e-mail">
			<input type="" name="P" placeholder="your name">
			<button class="btn-signup">Войти</button> <button class="btn-signup">Зарегистрироваться</button>
		</form>	
	</div>
	<div class="inform-block-600">
		<p class="title-600">что мы предлагаем?</p>
		<div class="info-block-600">
			<span class= "icon icon-cloud"></span><p class="block-sub-title-600">Быть мобильными</p>
			<p class="block-information-600">отсутствие привязанности к аппаратной платформе и месту нахождения – можно работать с любого устройства, имеющего доступ в Интернет, с любой точки нахождения</p>
		</div>
		<div class="info-block-600">
			<span class= "icon icon-talk"></span><p class="block-sub-title-600">Экономность</p>
			<p class="block-information-600">нет необходимости приобретать оборудование, программное обеспечение, тратиться на специалистов по обслуживанию</p>
		</div>
		<div class="info-block-600">
			<span class= "icon icon-watch"></span><p class="block-sub-title-600">Контроль выполнения на всех этапах</p>
			<p class="block-information-600">обработка, учет и хранение информации со всех этапов страхового случая, начиная с подачи заявки ассистансом и заканчивая выставлением счета медицинским учреждением; <br>
			использование дорогостоящих человеческих ресурсов сугубо на решение профессиональных задач, а не на телефонный трафик и рутинные функции передачи информации</p>
		</div>
		<div class="info-block-600">
			<span class= "icon icon-paper"></span><p class="block-sub-title-600">Возможность выбора</p>
			<p class="block-information-600">при необходимости, интеграция платформы с программным обеспечением медицинского учреждения (1С и др.);
			возможность модульного использования ресурсов платформы, а именно только необходимых;</p>
		</div>
	</div>
	<div class="gray-content-600">
		<div class="title-600">как происходит коммуникация в настояще время?</div>
		<div class="information-block-600">
			<p class="inform-text-600">В настоящее время преобладающим способом коммуникации и обмена информацией между страховой компанией / ассистансом и медицинским учреждением является вербальный (разговорный) способ передачи информации посредством телефонных каналов связи.</p>
			<p class="inform-text-600">Задействованы достаточно дорогостоящие интеллектуальные и временные ресурсы как специалистов/врачей обеих сторон коммуникации, так и не менее дорогостоящие службы обеспечения (помещение, операторы связи, оборудование и т.д.).</p>
			<p class="inform-text-600">
				Этот способ не исключает возможных человеческих ошибок при передаче информации (ошибся), временных трудностей с телефонным трафиком как в клинике, так и в кол-центре страховой компании / ассистента (не дозвонился), технических нарушений (поломался)
			</p>
			<p class="inform-text-600">Дополнительным каналом может выступать письменный способ коммуникации и передачи информации посредством электронной почты. Данный способ может минимизировать недостатки вербального, но также имеет ряд отрицательных качеств</p>
		</div>
	</div>
	<div class="footer-600">
		<img src="img/topmed.png">
	</div>

	<hr>
	<div class="button-600">
		<button class="btn-600">Войти в кабинет</button>
		<span class="f-icon-600 icon"></span>
	</div>
</div>	
	<div class="landing-wrap">
		<div class="header clearfix">
			<div class="main-logo">
				<a href="#">
					<img src="img/topmed.png" alt="Main-logo TopMed">
				</a>
			</div>	
			<div class="nav">
				<ul>
					<a href="#top"><li>Как это работает</li></a>
					<button id ="formBtn">Войти в кабинет</button>
					<!-- <div id="formModal" class="modal">
						<div class="modal-content">
							<span class="close">&times;</span>
							<div class="logo-box"><img src="img/topmed.png" alt="Logo-icon TopMed"></div>
								<form>
									<div class="wrap-form-fild">
										<label for="login"><img src="img/icon-login.png"></label>
										<input type="text" placeholder="login" id="login" name="">
									</div>

									<div class="wrap-form-fild">
										<label for="password"><img src="img/icon-login.png"></label>
										<input type="text" placeholder="your password" id="password" name="">
									</div>

									<div class="restore-password">
										<p class="sub-title-btn"><a href="#">Забыли пароль?</a></p>
									</div>
									<div>
										<button class="btn-submit"><span class ="sub-btn-title">Войти</span></button>
									</div>
								</form>
							</div>
						</div>	 -->
				</ul>
			</div>
		</div>
		<!-- end header -->

		<!-- blue-content -->
		<div class="blue-content">
			<div class="main-title-blue-wrap">
				<h1 class="h1-title">интеллектуальная коммуникационная платформа</h1>
				<p class="sub-title-small">Зарегистрироваться <span class="btn-box">Сейчас</span></p>
				<form method="POST">
					<input class="free-signup" type="" name="L" placeholder="Your login">
					<input class="free-signup" type="" name="P" placeholder="Your password">
					<button class="btn-signup">Войти</button> <button class="btn-signup">Зарегистрироваться</button>
				</form>
			</div>
			<div class="image-phone"><img src="img/phone.png"></div>
			<span class="cloud1-icon icon"></span>
			<span class="cloud2-icon icon"></span>
			<span class="cloud3-icon icon"></span>
			<span class="cloud4-icon icon"></span>
		</div>
		<div class="gray-content">
			<p class="about-firm"><a name="top"></a>Предлагаемая интеллектуальная коммуникационная платформа TOPMED – это удобная облачная среда для передачи, обработки и хранения информации, объединяющая в себе аппаратные средства, программное обеспечение, каналы связи, техническую поддержку пользователей, и имеющая возможности и преимущества</p>
		</div>
		<div class="white-content">
			<p class="content-title">ЧТО ПРЕДЛАГАЕМ МЫ?</p>
			<div class="container-box">
				<span class= "icon icon-cloud"></span><span class="title-description-service"> Быть мобильными</span>
					<p class="text-description-server">отсутствие привязанности к аппаратной платформе и месту нахождения – можно работать с любого устройства, имеющего доступ в Интернет, с любой точки нахождения</p>
				<span class= "icon icon-talk"></span><span class="title-description-service"> Экономность</span>
					<p class="text-description-server">нет необходимости приобретать оборудование, программное обеспечение, тратиться на специалистов по обслуживанию;</p>
				<span class= "icon icon-watch"></span><span class="title-description-service">Контроль выполнения на всех этапах</span>
					<p class="text-description-server">
					обработка, учет и хранение информации со всех этапов страхового случая, начиная с подачи заявки ассистансом и заканчивая выставлением счета медицинским учреждением;<br>	
					использование дорогостоящих человеческих ресурсов сугубо на решение профессиональных задач, а не на телефонный трафик и рутинные функции передачи информации</p>
				<span class= "icon icon-paper"></span><span class="title-description-service">Возможность выбора</span>
					<p class="text-description-server">при необходимости, интеграция платформы с программным обеспечением медицинского учреждения (1С и др.);<br>
					возможность модульного использования ресурсов платформы, а именно только необходимых;  </p>	
			</div>
			<div class="image-ipad"><img src="img/ipad.png"></div>
		</div>

		<div class="gray-contant clearfix">
			<p class="content-title slider-title">КАК ПРОИСХОДИТ КОММУНИКАЦИЯ В НАСТОЯЩЕЕ ВРЕМЯ? </p>
			<div class="slider" id="slider">
				<div class="slider-item">
					<p class="slider-ml"><span class= "icon icon-cloud"></span> 
					<span class="slider-service">Work on any device anyware</span></p>
					<p class="slider-service-discription">В настоящее время преобладающим способом коммуникации и обмена информацией между страховой компанией / ассистансом и медицинским учреждением является вербальный (разговорный) способ передачи информации посредством телефонных каналов связи. </p>
				</div>
				<div class="slider-item">
					<p class="slider-ml"><span class= "icon icon-cloud"></span> 
					<span class="slider-service">Work on any device anyware</span></p>
					<p class="slider-service-discription">Задействованы достаточно дорогостоящие интеллектуальные и временные ресурсы как специалистов/врачей обеих сторон коммуникации, так и не менее дорогостоящие службы обеспечения (помещение, операторы связи, оборудование и т.д.).</p>
				</div>
				<div class="slider-item">
					<p class="slider-ml"><span class= "icon icon-cloud"></span> 
					<span class="slider-service">Work on any device anyware</span></p>
					<p class="slider-service-discription">Этот способ не исключает возможных человеческих ошибок при передаче информации (ошибся), временных трудностей с телефонным трафиком как в клинике, так и в кол-центре страховой компании / ассистента (не дозвонился), технических нарушений (поломался)</p>
				</div>
				<div class="slider-item">
					<p class="slider-ml"><span class= "icon icon-cloud"></span> 
					<span class="slider-service">Work on any device anyware</span></p>
					<p class="slider-service-discription">Дополнительным каналом может выступать письменный способ коммуникации и передачи информации посредством электронной почты. Данный способ может минимизировать недостатки вербального, но также имеет ряд отрицательных качеств</p>
				</div>
			</div>		
		</div>
		<div class="white-form-container">
			<p class="content-title">Экономьте время и ресурсы</p>
			<p class="sub-title">Используя платформу TOPMED вы можете сфокусироваться на других аспектах вашего бизнеса
 			</p>
				<form>
					<input class="free-signup" type="" name="" placeholder="Your E-mail Adress">
					<button class="btn-signup">зарегистрироваться</button>
				</form>
		</div>
		<footer>
			<div class="main-logo">
				<a href="#">
					<img src="img/topmed.png" alt="Main-logo TopMed">
				</a>
			</div>	
			<div class="nav">
				<ul>
					<a href="#"><li>Как это работает</li></a>
					<a href="#"><li><span class="f-icon icon"></span></li></a>
					<button id ="formBtn">Войти в кабинет</button>	
				</ul>		
			</div>	
		</footer>
	</div>
<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>
<script type="text/javascript">
	$(document).ready (function (){
		$('#slider').slick({
			arrows: false,
			dots: true,
		});
	});
</script>
<script type="text/javascript" src="js/script-modal.js"></script>
</body>
</html>
		<?
		$return = ob_get_clean();
		return $return;
	}

}

