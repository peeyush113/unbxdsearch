<?php 

	function home(){
		$app =  \Slim\Slim::getInstance();
		$app->render('main.php');
	}
 ?>