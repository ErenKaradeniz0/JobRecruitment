CREATE TABLE Applications(
	applicationID INT PRIMARY KEY  IDENTITY(1, 1),
	jobID INT, 
	userID INT, 
	application_date DATE,
	application_status VARCHAR(50),
	FOREIGN KEY (jobID) REFERENCES Jobs(jobID),
	FOREIGN KEY (userID) REFERENCES Users(userID),	
);