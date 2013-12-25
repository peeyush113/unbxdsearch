<?php 
	require 'lib/redbean/rb.php';
	R::setup('mysql:host=localhost;dbname=unbxd','root','algorithm');

	if (($handle = fopen("movies-catalog.csv", "r")) !== FALSE) {
		$i = 0;
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			if ($i != 0) {
				$movie = R::dispense('movies');
				$movie->group_id = $data[0];
				$movie->product_id = $data[1];
				$movie->title = $data[2];
				$movie->store_type = $data[3];
				$movie->category_type = $data[4];
				$movie->sub_category_type = $data[5];
				$movie->price_in_rs = $data[6];
				$movie->shipping_duration_in_day = $data[7];
				$movieId = R::store($movie);
				echo $movieId;
				echo "<br/>";
			}
			$i++;
		}
		fclose($handle);
	}




 ?>