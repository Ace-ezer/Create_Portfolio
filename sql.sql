/*Create a database named portfolio and in that following table*/

CREATE TABLE form (
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	username VARCHAR(20) NOT NULL,
 	email VARCHAR(120) NOT NULL, 
 	password VARCHAR(120) NOT NULL,
  	first VARCHAR(120) NOT NULL, 
  	last VARCHAR(120) NOT NULL,
   	age VARCHAR(20) NOT NULL, 
   	gender VARCHAR(20) NOT NULL,
    country VARCHAR(20) NOT NULL, 
    city VARCHAR(20) NOT NULL,
    education VARCHAR(120) NOT NULL,
    techinal_skills VARCHAR(120) NOT NULL,
    achievements VARCHAR(120) NOT NULL,
    description VARCHAR(120) NOT NULL, 
    status INT(11) NOT NULL, 
    contact BIGINT(11) NOT NULL,
    fb VARCHAR(120) NOT NULL, 
	git VARCHAR(120) NOT NULL
);