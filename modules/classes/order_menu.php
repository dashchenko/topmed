<?

class order_menu {


	function Buttons($order) {

		$id = $order[ApplicationID];

		ob_start();
		?>
		<div id="AplicationMenuHamburger"><span class="fontawesome-reorder"></span></div>
		<div class="AplicationSectionMenu hide">

			<ul >
				<li class='button-back' rel='<?=$id?>'>вернуть</li> 

				<li class='button-exec ' rel='<?=$id?>'>выполнить</li>
					
				
			</ul>
		</div>

		<?
		return ob_get_clean();


	}

}

?>
