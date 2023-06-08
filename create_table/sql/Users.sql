CREATE TABLE Users(
	userID INT IDENTITY(1, 1) PRIMARY KEY,
	cityID INT, 
	districtID INT,
	name VARCHAR(100),
	surname VARCHAR(100),
	password VARCHAR(100),
	email VARCHAR(100),
	phone VARCHAR(100),
	address TEXT,
	birth_date DATE,
	gender VARCHAR(10)
	FOREIGN KEY (cityID) REFERENCES Cities(cityID),
	FOREIGN KEY (districtID) REFERENCES Districts(districtID)
);