--Tables info for form data
CREATE TABLE myapp.info (

	id int primary key auto_increment,
	name varchar(20) not null,
	email varchar(255) not null,
	dob varchar(10),
	gender enum('male','female')
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;


--Tables users for login informations
CREATE TABLE myapp.users (

	username varchar primary key,
	email varchar(20) not null,
	password varchar(255) not null,
	dob varchar(10)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;


