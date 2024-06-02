CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255),
    -- nic,email, password,address01, address02, city, zip, img
    Email VARCHAR(255),
    Password VARCHAR(255),
    UserType ENUM('seller', 'bidder'),
    Status ENUM('active', 'blocked')
);

CREATE TABLE Products (
    ProductID INT PRIMARY KEY AUTO_INCREMENT,
    SellerID INT,
    ProductName VARCHAR(255),
    Description TEXT,
    StartDate DATETIME,
    EndDate DATETIME,
    Status ENUM('pending', 'active', 'sold'),
    FOREIGN KEY (SellerID) REFERENCES Users(UserID)
);

CREATE TABLE Bids (
    BidID INT PRIMARY KEY AUTO_INCREMENT,
    ProductID INT,
    BidAmount DECIMAL(10,2),
    BidderID INT,
    BidTime TIMESTAMP,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID),
    FOREIGN KEY (BidderID) REFERENCES Users(UserID)
);

CREATE TABLE Admin (
    AdminID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(255),
    Email VARCHAR(255),
    Password VARCHAR(255)
);
