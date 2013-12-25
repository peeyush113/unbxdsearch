<?php 

	function search(){
			$app =  \Slim\Slim::getInstance();
			$request = $app->request();
			$searchInput = $request->get('searchInput');
			$lowerLimit = $request->get('lowerLimit');
			// $upperLimit = $request->get('upperLimit');
			require 'unbxd.class.php';
			$searchResult = unbxd::search($searchInput, $lowerLimit);
			return $searchResult; 
	}
 ?>