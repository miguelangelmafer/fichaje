CREATE OR REPLACE TABLE users( 
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(30), 
	surname VARCHAR(60), 
	email VARCHAR(30) UNIQUE, 
	password VARCHAR(20),
    inside BOOLEAN);

    CREATE OR REPLACE TABLE registration(
	id INT PRIMARY KEY AUTO_INCREMENT,
    date DATE,
    hour TIME,
    inside VARCHAR(5),
    id_user int references users (id));