CREATE TABLE Jobs(
	jobID INT PRIMARY KEY IDENTITY(1, 1),
	companyID INT, 
	job_title VARCHAR(100),
	job_description TEXT,
	listing_date DATE,
	listing_status VARCHAR(10),
	working_type VARCHAR(20),
	FOREIGN KEY (companyID) REFERENCES Companies(companyID)
);
