CREATE DATABASE IF NOT EXISTS unbxd;
USE unbxd;
CREATE TABLE movies (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	group_id VARCHAR(100),
	product_id VARCHAR(100),
	title VARCHAR(200),
	store_type VARCHAR(200),
	category_type VARCHAR(200),
	sub_category_type VARCHAR(200),
	price_in_rs INT,
	shipping_duration_in_day INT,
	FULLTEXT (title)
	)ENGINE=MyISAM;

LOAD DATA LOCAL INFILE 'movies.txt' 
INTO TABLE movies 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '' 
LINES TERMINATED BY '\n' 
IGNORE 1 LINES 
(@group_id, 
	product_id, 
	title, 
	store_type, 
	category_type, 
	sub_category_type, 
	price_in_rs, 
	shipping_duration_in_day) SET group_id = nullif(@group_id, '');





SELECT title, MATCH(title) AGAINST('district 9' IN NATURAL LANGUAGE MODE) 
FROM movies 
WHERE MATCH(title) AGAINST('district 9' IN NATURAL LANGUAGE MODE);

-- SELECT SQL_CALC_FOUND_ROWS, * FROM 

SELECT DISTINCT (group_id), id, title FROM movies WHERE title LIKE "%broken%" AND group_id IS NOT NULL GROUP BY group_id


SELECT * FROM ( SELECT DISTINCT (group_id), id, title FROM movies WHERE title LIKE "%broken%" AND group_id IS NOT NULL GROUP BY group_id UNION ALL SELECT DISTINCT (group_id), id, title FROM movies WHERE title LIKE "%broken%" AND group_id IS NULL ) liketbl 
WHERE NOT EXISTS ( SELECT DISTINCT (group_id), id, title FROM movies WHERE MATCH(title) AGAINST('broken' IN NATURAL LANGUAGE MODE) AND group_id IS NOT NULL GROUP BY group_id UNION ALL SELECT DISTINCT (group_id), id, title FROM movies WHERE MATCH(title) AGAINST('broken' IN NATURAL LANGUAGE MODE) AND group_id IS NULL );



SELECT DISTINCT (group_id), id, title FROM movies WHERE (MATCH(title) AGAINST('bro' IN NATURAL LANGUAGE MODE) OR title LIKE "%bro%") AND group_id IS NOT NULL GROUP BY group_id UNION ALL SELECT DISTINCT (group_id), id, title FROM movies WHERE (MATCH(title) AGAINST('bro' IN NATURAL LANGUAGE MODE) OR title LIKE "%bro%") AND group_id IS NULL;



SELECT SQL_CALC_FOUND_ROWS * FROM ( SELECT DISTINCT (group_id), id, title FROM movies WHERE MATCH(title) AGAINST('bro' IN NATURAL LANGUAGE MODE) AND group_id IS NOT NULL GROUP BY group_id UNION ALL SELECT DISTINCT (group_id), id, title FROM movies WHERE MATCH(title) AGAINST('bro' IN NATURAL LANGUAGE MODE) AND group_id IS NULL ) mtchtbl UNION ALL SELECT * FROM ( SELECT DISTINCT (group_id), id, title FROM movies WHERE title LIKE "%bro%" AND group_id IS NOT NULL GROUP BY group_id UNION ALL SELECT DISTINCT (group_id), id, title FROM movies WHERE title LIKE "%bro%" AND group_id IS NULL ) liketbl WHERE FOUND_ROWS() = 0
