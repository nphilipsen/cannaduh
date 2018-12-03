SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Cart;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Payment;
DROP TABLE IF EXISTS Shipment;
DROP TABLE IF EXISTS Supplier;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Accessories;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE Users (
  userName VARCHAR(20),
  password VARCHAR(32),
  firstName VARCHAR(30),
  lastName VARCHAR(30),
  age INTEGER,
  province CHAR(2),
  city VARCHAR(50),
  address VARCHAR(100),
  postal CHAR(6),
  email VARCHAR(100),
  phoneNum VARCHAR(12),
  isAdmin BOOLEAN NOT NULL,
  profImg MEDIUMBLOB,
  profImgType VARCHAR(10),
  CONSTRAINT User_pk PRIMARY KEY (userName)
);


CREATE TABLE Payment (
  methodPayment VARCHAR(10),
  cardName VARCHAR(30),
  cardNum INTEGER,
  expiryDate DATE,
  cvv INTEGER,
  province CHAR(2),
  city VARCHAR(20),
  address VARCHAR(100),
  postalCode CHAR(6),
  phoneNum VARCHAR(12),
  userName VARCHAR(20),
  CONSTRAINT Payment_pk PRIMARY KEY (cardNum, userName),
  FOREIGN KEY (userName) REFERENCES Users(userName)
    ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE Supplier (
  supplierId INTEGER,
  supplierName VARCHAR(100),
  province CHAR(2),
  city VARCHAR(20),
  address VARCHAR(100),
  postalCode CHAR(6),
  email VARCHAR(100),
  phoneNum VARCHAR(12),
  CONSTRAINT Supplier_pk PRIMARY KEY (supplierId)
);

CREATE TABLE Product (
  productId INTEGER,
  productName VARCHAR(50),
  strain CHAR(6),
  potencyThc INTEGER,
  potencyCbd INTEGER,
  price DECIMAL(15,2),
  description MEDIUMTEXT,
  stock INTEGER,
  isLimited BOOLEAN,
  prodImg MEDIUMBLOB,
  prodImgType VARCHAR(10),
  supplierId INTEGER,
  CONSTRAINT Product_pk PRIMARY KEY (productId),
  FOREIGN KEY (supplierId) REFERENCES Supplier(supplierId)
    ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE Accessories (
  productId INTEGER,
  productName VARCHAR(50),
  price DECIMAL(15,2),
  description MEDIUMTEXT,
  accImg MEDIUMBLOB,
  accImgType VARCHAR(10),
  supplierId INTEGER,
  CONSTRAINT Accessories_pk PRIMARY KEY (productId),
  FOREIGN KEY (supplierId) REFERENCES Supplier(supplierId)
    ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE Review (
  reviewId INTEGER,
  reviewContent MEDIUMTEXT,
  rating INTEGER,
  userName VARCHAR(20),
  productId INTEGER,
  CONSTRAINT Review_pk PRIMARY KEY (reviewId),
  FOREIGN KEY (userName) REFERENCES Users(userName)
    ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (productId) REFERENCES Product(productId)
    ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE Cart (
  cartId INTEGER,
  userName VARCHAR(20),
  productId INTEGER,
  quantity INTEGER,
  CONSTRAINT Cart_pk PRIMARY KEY (cartId, productId),
  FOREIGN KEY (userName) REFERENCES Users(userName)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (productId) REFERENCES Product(productId)
    ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE Orders (
  orderId INTEGER,
  isUnder30 BOOLEAN,
  isOpen BOOLEAN,
  cartId INTEGER,
  userName VARCHAR(20),
  orderDate DATE,
  CONSTRAINT Order_pk PRIMARY KEY (orderId),
  FOREIGN KEY (cartId) REFERENCES Cart(cartId)
  ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (userName) REFERENCES Users(userName)
  ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Shipment (
  shipmentId INTEGER,
  orderId INTEGER,
  shipmentTotal DECIMAL(15,2),
  shipmentDate DATE,
  CONSTRAINT Shipment_pk PRIMARY KEY (shipmentId),
  FOREIGN KEY (orderId) REFERENCES Orders(orderId)
    ON DELETE NO ACTION ON UPDATE CASCADE
);

INSERT INTO Users VALUES ('maryw1', '5b5b1a55b910c93b4d20c3384176c7af', 'Mary', 'Whitten', 22, 'AB', 'Calgary', '123 Road Street', 'A1B2C3', 'whitten.mary175@gmail.com', '123-456-7890', TRUE, NULL, NULL);
INSERT INTO Users VALUES ('sebCN', 'f3aabd76ea0a9810394fdb9816a5ce89', 'Sebastian', 'Caron-Nowak', 23, 'BC', 'Vancouver', '357 Real Road', 'D1E2F3', 'sebastian.caron.nowak@gmail.com', '123-987-2375', TRUE, NULL, NULL);
INSERT INTO Users VALUES ('nickP', 'ea5dc6553f4d915abc7579aad7d027d9', 'Nick', 'Philipsen', 25, 'BC', 'Kelowna', '85 Fake Ave', 'G1H2I3', 'nphilipsen@hotmail.ca', '123-983-4217', TRUE, NULL, NULL);
INSERT INTO Users VALUES ('user1', '2d98c7415017689038ed41186be3d2ea', 'John', 'Doe', 30, 'SK', 'Regina', '45 Moose Street', 'J1K2L3', 'joe.doe@hotmail.ca', '456-892-3408', FALSE, NULL, NULL);
INSERT INTO Users VALUES ('dankGirl', 'a906449d5769fa7361d7ecc6aa3f6d28', 'Jane', 'Doe', 45, 'ON', 'Ottawa', '1567 Maple Drive', 'M1N2O3', 'jane.doe@yahoo.ca', '783-579-2340', FALSE, NULL, NULL);
INSERT INTO Users VALUES ('dankBro', '5f4dcc3b5aa765d61d8327deb882cf99', 'Mike', 'Smith', 20, 'NL', 'Deer Lake', '34 Island Road', 'P1Q2R3', 'smith.mike@gmail.com', '569-103-2745', FALSE, NULL, NULL);
INSERT INTO Supplier VALUES (1, 'Krazy Kush', 'BC', 'Kelowna', '258 Clifton Ave', 'F3H6J1', 'contact@krazykush.ca', '250-762-1629');
INSERT INTO Supplier VALUES (2, 'Weed R Us', 'AB', 'Edmonton', '1729 17 Street', 'J4K9S3', 'support@weedrus.ca', '587-349-0155');
INSERT INTO Supplier VALUES (3, 'Canni Land', 'ON', 'Caledon', '783 Elm Road', 'W9Q8H2', 'contact@canniland.ca', '519-783-1156');
INSERT INTO Supplier VALUES (4, 'Weedmart', 'BC', 'Vancouver', '9034 Oak Street', 'V9E8C4', 'help@weedmart.ca', '250-334-7136');
INSERT INTO Product VALUES (1, 'OG Kush', 'Indica', 25, 0, 11.99, 'Indica-dominant with a deep fruit aroma.', 50, FALSE, NULL, NULL, 1);
INSERT INTO Product VALUES (2, 'Chewbacca', 'Sativa', 10, 0, 8.99, 'Sativa-dominant with light floral notes.', 100, FALSE, NULL, NULL, 1);
INSERT INTO Product VALUES (3, 'Spirit', 'Hybrid', 0,15, 9.99, 'High CBD hybrid with a mild citrus flavour.', 30, FALSE, NULL, NULL, 1);
INSERT INTO Product VALUES (4, 'Sleepy Bear', 'Indica', 20, 3, 12.99, 'Indica-dominant with an earthy musk.', 200, FALSE, NULL, NULL, 2);
INSERT INTO Product VALUES (5, 'Electric Fuzz', 'Sativa', 15, 0, 7.99, 'Sativa-dominant with undertones of peach.', 15, FALSE, NULL, NULL, 2);
INSERT INTO Product VALUES (6, 'Moon', 'Hybrid', 0, 15, 10.99, 'High CBD hybrid that mellows the soul.', 120, FALSE, NULL, NULL, 3);
INSERT INTO Product VALUES (7, 'Sloth Moment', 'Indica', 23, 0, 17.99, 'Indica-dominant with a mellow vibe.', 500, FALSE, NULL, NULL, 3);
INSERT INTO Product VALUES (8, 'Kung-Fu Panda', 'Sativa', 12, 0, 15.99, 'Sativa-dominant with a bamboo finish.', 300, FALSE, NULL, NULL, 4);
INSERT INTO Product VALUES (9, 'Busy Wagon', 'Hybrid', 16, 2, 14.99, 'A hybrid with cool cucumber notes.', 400, FALSE, NULL, NULL, 4);
INSERT INTO Product VALUES (10, 'Purple Rain', 'Indica', 23, 0, 13.99, 'Indica-dominant with a deep musk.', 800, FALSE, NULL, NULL, 4);
INSERT INTO Product VALUES (11, 'Paradise City', 'Sativa', 12, 0, 7.99, 'Sativa-dominant with a light finish.', 600, FALSE, NULL, NULL, 2);
INSERT INTO Product VALUES (12, 'Prius', 'Hybrid', 16, 2, 10.99, 'A hybrid with cool cucumber notes.', 700, FALSE, NULL, NULL, 3);
INSERT INTO Cart VALUES (1, 'dankBro', 12, 20);
INSERT INTO Cart VALUES (2, 'maryw1', 5, 30);
INSERT INTO Cart VALUES (3, 'user1', 1, 10);
INSERT INTO Cart VALUES (3, 'user1', 9, 15);
INSERT INTO Cart VALUES (4, 'nickP', 3, 22);
INSERT INTO Cart VALUES (5, 'dankBro', 7, 5);
INSERT INTO Cart VALUES (5, 'dankBro', 3, 10);
INSERT INTO Cart VALUES (6, 'sebCN', 6, 28);
INSERT INTO Cart VALUES (7, 'user1', 4, 8);
INSERT INTO Orders VALUES (1, TRUE, FALSE, 1, 'dankBro', '2018-10-18');
INSERT INTO Orders VALUES (5, TRUE, TRUE, 5, 'dankBro', '2018-10-21');
INSERT INTO Orders VALUES (2, TRUE, FALSE, 2, 'maryw1', '2018-10-26');
INSERT INTO Orders VALUES (6, TRUE, TRUE, 6, 'sebCN', '2018-10-31');
INSERT INTO Orders VALUES (3, TRUE, FALSE, 3, 'user1', '2018-11-04');
INSERT INTO Orders VALUES (7, TRUE, TRUE, 7, 'user1', '2018-11-10');
INSERT INTO Orders VALUES (4, TRUE, FALSE, 4, 'nickP', '2018-11-17');
INSERT INTO Shipment VALUES (1, 1, 219.80, '2018-10-17');
INSERT INTO Shipment VALUES (2, 2, 239.70, '2018-10-20');
INSERT INTO Shipment VALUES (3, 3, 344.75, '2018-10-25');
INSERT INTO Shipment VALUES (4, 4, 219.78, '2018-10-30');
INSERT INTO Shipment VALUES (5, 5, 189.95, '2018-11-03');
INSERT INTO Shipment VALUES (6, 6, 307.72, '2018-11-09');
INSERT INTO Shipment VALUES (7, 7, 103.92, '2018-11-16');
INSERT INTO Accessories VALUES (13, '4-piece Grinder', 34.99, '4 piece aluminum grinder', NULL, NULL, 1);
INSERT INTO Accessories VALUES (14, 'Thunderdome', 69.99, '12 inch glass bong', NULL, NULL, 2);
INSERT INTO Accessories VALUES (15, 'Gandalf Pipe', 15.99, 'Silicon gandalf pipe', NULL, NULL, 3);

