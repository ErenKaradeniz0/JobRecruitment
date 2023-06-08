CREATE TABLE Companies(
	companyID INT PRIMARY KEY IDENTITY(1, 1),
	cityID INT,
	districtID INT,
	company_name VARCHAR(100),
	website VARCHAR(150),
	email VARCHAR(100),
	password VARCHAR(100),
	phone VARCHAR(100),
	address TEXT,
	FOREIGN KEY (cityID) REFERENCES Cities(cityID),
	FOREIGN KEY (districtID) REFERENCES Districts(districtID)
);
