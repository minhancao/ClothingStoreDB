CREATE DATABASE ClothingDatabase;
USE ClothingDatabase;

CREATE TABLE Store (
	storeName VARCHAR(255),
	popularity FLOAT,
	PRIMARY KEY(storeName)
);

CREATE TABLE Customer (
	customerID INT,
	customerName VARCHAR(255),
	address VARCHAR(255),
	email VARCHAR(255),
	cardNumber VARCHAR(16),
	transactionID INT,
	PRIMARY KEY(customerID)
);

CREATE TABLE Transaction (
	transactionID INT,
	price FLOAT,
	storeName VARCHAR(255),
	customerID INT,
	productID INT, 
	PRIMARY KEY(transactionID)
);

CREATE TABLE Product (
	productID INT,
	transactionID INT,
	storeName VARCHAR(255),
	color VARCHAR(255),
	price FLOAT, 
	brandName VARCHAR(255),	
	name VARCHAR(255),
	type VARCHAR(255),
	PRIMARY KEY(productID)
);
CREATE TABLE Top (
	productID INT PRIMARY KEY,
	hood BIT,
	size VARCHAR(5),
	pocket BIT,
	zipper BIT
);

CREATE TABLE Bottom (
	productID INT PRIMARY KEY,
	lengthSize FLOAT,
	waistSize FLOAT
);
CREATE TABLE Shoe (
	productID INT PRIMARY KEY,
	shoeSize FLOAT
);

LOAD DATA INFILE 'storeInput.txt'
INTO TABLE Store COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'customerInput.txt'
INTO TABLE Customer COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'transactionInput.txt'
INTO TABLE Transaction COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'productInput.txt'
INTO TABLE Product COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'topInput.txt'
INTO TABLE Top COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'bottomInput.txt'
INTO TABLE Bottom COLUMNS TERMINATED BY '\t';

LOAD DATA INFILE 'shoeInput.txt'
INTO TABLE Shoe COLUMNS TERMINATED BY '\t';




