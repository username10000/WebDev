DROP TABLE Users;
DROP TABLE Books;
DROP TABLE Categories;
DROP TABLE Reservations;

CREATE TABLE Users (
	Username VARCHAR(50) PRIMARY KEY, 
	Password VARCHAR(50),
	FirstName VARCHAR(30),
    Surname VARCHAR(30),
    AddressLine1 VARCHAR(50),
	AddressLine2 VARCHAR(50),
    City VARCHAR(20),
    Telephone INT,
    Mobile INT
);

CREATE TABLE Books (
	ISBN VARCHAR(13) PRIMARY KEY,
    BookTitle VARCHAR(50),
    Author VARCHAR(60),
    Edition INT,
	Year INT,
    Category VARCHAR(3),
    Reserved CHAR(1)
);

CREATE TABLE Categories (
	CategoryID VARCHAR(3) PRIMARY KEY,
    CategoryDescription VARCHAR(50)
);

CREATE TABLE Reservations (
	ISBN VARCHAR(13),
    Username VARCHAR(50),
    ReservedDate DATE
);