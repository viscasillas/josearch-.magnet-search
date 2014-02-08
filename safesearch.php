<?php
if(isset($_GET['q'])){
	setcookie("safesearch", $_GET['q']);
}
?>