CREATE TABLE Sectors(
	sectorID INT IDENTITY(1,1) PRIMARY KEY,
	sector_name VARCHAR(50) NOT NULL
);

INSERT INTO Sectors (sector_name) VALUES
    ('Technology'),
    ('Finance'),
    ('Education'),
    ('Health'),
    ('Automotive'),
    ('Food'),
    ('Construction'),
    ('Energy'),
    ('Services');