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
