<?php 
	require 'lib/Slim/Slim.php';
	\Slim\Slim::registerAutoloader();
	$app = new \Slim\Slim();
	$app->config(array(
		'log.enable' => true,
		'debug' => true,
		'templates.path' => 'templates',
		'mode' => 'development',
	));
	$uri = substr($app->request()->getResourceUri(), 1);
	if($uri != "") {
		$apimethodfile = "method/".strtolower($uri).".php";
		if(file_exists($apimethodfile)) {
			require_once $apimethodfile;
			if(!function_exists($uri)) {
				$app->halt(403, "message");
			}
		} else {
			$app->halt(403, "message");
		}
	}

	$app->get('/', 					function() use ($app){ $app->redirect('home'); });
	$app->get('/home', 			function(){ echo home();});
	$app->get('/search', 			function (){ echo search(); });
	$app->get('/info', 			function (){ echo info(); });
	$app->run();

 ?>