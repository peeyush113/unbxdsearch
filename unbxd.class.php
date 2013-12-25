<?php 

require 'lib/redbean/rb.php';
R::setup('mysql:host=localhost;dbname=unbxd','root','algorithm');

class unbxd {

	public static function search($searchValue, $lowerLimit){
		$qry = "SELECT * FROM (SELECT DISTINCT (group_id), id, title 
		FROM movies 
		WHERE (MATCH(title) AGAINST(:searchVal IN NATURAL LANGUAGE MODE) OR title LIKE :searchValLike) 
		AND group_id IS NOT NULL 
		GROUP BY group_id
		UNION ALL 
		SELECT DISTINCT (group_id), id, title 
		FROM movies 
		WHERE (MATCH(title) AGAINST(:searchVal IN NATURAL LANGUAGE MODE) OR title LIKE :searchValLike) 
		AND group_id IS NULL) tbl LIMIT :start, 10";
		$result = R::getAll($qry, array(
			':searchVal' => $searchValue, 
			':searchValLike'=>'%'.$searchValue.'%', 
			':start'=>intval($lowerLimit)));
		if (count($result) > 0) {
			$response = json_encode(array('status'=>200, 'data'=>$result));
		} else{
			$response = json_encode(array('status'=>500));
		}
		return $response;
	}

	public static function getInfo($infoId){
		$qry = "SELECT * FROM movies WHERE id = :id";
		$info = R::getAll($qry, array(':id'=>$infoId));
		if ($info[0]['group_id'] != NULL) {
			$qry = "SELECT * FROM movies WHERE group_id = :groupId";
			$info = R::getAll($qry, array(':groupId'=>$info[0]['group_id']));
		}
		if (count($info) > 0) {
			$response = json_encode(array('status'=>200, 'data'=>$info));
		} else{
			$response = json_encode(array('status'=>500));
		}
		return $response;
	}
}

 ?>