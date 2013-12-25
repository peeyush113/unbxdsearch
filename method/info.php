<?php 

	function info(){
		$app =  \Slim\Slim::getInstance();
		$request = $app->request();
		$infoId = $request->get('infoId');
		require 'unbxd.class.php';
		$infoResult = unbxd::getInfo($infoId);
		return $infoResult;
	}
 ?>