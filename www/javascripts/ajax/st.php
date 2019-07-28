<?
require_once("../../../modules/config.php");
//$id = htmlspecialchars($_POST[code],  ENT_QUOTES, 'utf-8');
new put_time_patient($_POST['order_id'], $_POST['setDate'], $_POST['setTime']);

?>