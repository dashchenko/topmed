<?
session_start();
define("ROOT_PASS", "http://".$_SERVER['HTTP_HOST']."/");
define("API_URL", "https://api.topmed.com.ua/test/");
foreach (glob(__DIR__."/classes/*.php") as $filename) {
	require_once ($filename);
}

define("TITLE", "LOCAL topmed");
define("DEBUG", "off");
?>