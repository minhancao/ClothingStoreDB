USE ClothingDatabase;

DELIMITER $$
CREATE OR REPLACE TRIGGER deleteProductInCorrespondingTables 
    AFTER DELETE ON Product
    FOR EACH ROW 
BEGIN
    DELETE FROM Top
  WHERE productID = OLD.productID;
    DELETE FROM Bottom
  WHERE productID = OLD.productID;
    DELETE FROM Shoe
  WHERE productID = OLD.productID;
END$$
DELIMITER ;


DELIMITER $$
CREATE OR REPLACE TRIGGER checkCustomer
    BEFORE INSERT ON Customer FOR EACH ROW
BEGIN
    IF (NEW.cardNumber IS NULL) THEN
     SET NEW.cardNumber="9999999999999999";
    END IF;
    IF (NEW.cardNumber = 0) THEN
     SET NEW.cardNumber="9999999999999999";
    END IF;
    IF (NEW.cardNumber < 1000000000000000) THEN
     SET NEW.cardNumber="9999999999999999";
    END IF;
    IF (NEW.email NOT REGEXP '^[^@]+@[^@]+\.[^@]{2,}$') THEN
     SET NEW.email = 'default@email.com';
    END IF;
END$$
DELIMITER ;

DELIMITER //
CREATE OR REPLACE PROCEDURE decrementCountInProduct
(IN p_productID INT)
BEGIN
  UPDATE Product
  SET count = count - 1
  WHERE productID = p_productID;
END //
DELIMITER ;

DELIMITER //
CREATE OR REPLACE PROCEDURE finalizeCartTransact
(IN p_transactionID INT, IN p_customerID INT)
BEGIN
  DECLARE v_totalprice FLOAT DEFAULT 0;

  SELECT SUM(p1.price) INTO v_totalprice
  FROM Product p1 INNER JOIN (SELECT * FROM Cart WHERE transactionID = p_transactionID AND customerID = p_customerID) c1 ON p1.productID = c1.productID;
  
  SET v_totalprice = ROUND(calculateTotal(v_totalprice),2); 

  INSERT INTO Transaction(transactionID, price)
  VALUES(p_transactionID, v_totalprice);

  INSERT INTO CustomerPurchases(transactionID, customerID)
  VALUES(p_transactionID, p_customerID);

  INSERT INTO Purchases(transactionID, productID)
  SELECT transactionID, productID
  FROM Cart WHERE transactionID = p_transactionID AND customerID = p_customerID;

  CALL decrementProductsInCart(p_transactionID);

  DELETE FROM Cart WHERE transactionID = p_transactionID AND customerID = p_customerID;

END //
DELIMITER ;

DELIMITER //
CREATE OR REPLACE PROCEDURE decrementProductsInCart 
(IN p_transactionID INT)
BEGIN
  DECLARE done BOOLEAN DEFAULT FALSE;
  DECLARE _id BIGINT UNSIGNED;
  DECLARE cur CURSOR FOR SELECT productID FROM Cart WHERE transactionID = p_transactionID;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done := TRUE;

  OPEN cur;

  testLoop: LOOP
    FETCH cur INTO _id;
    IF done THEN
      LEAVE testLoop;
    END IF;
    CALL decrementCountInProduct(_id);
  END LOOP testLoop;

  CLOSE cur;
END //
DELIMITER ;

DELIMITER $$
CREATE FUNCTION calculateTax (input FLOAT) RETURNS FLOAT
    DETERMINISTIC
  BEGIN
    RETURN input * 0.0875;
END

DELIMITER $$
CREATE FUNCTION calculateTotal (input FLOAT) RETURNS FLOAT
    DETERMINISTIC
BEGIN
  DECLARE subtotal FLOAT DEFAULT 0;
  SET subtotal = input;
  SET subtotal = subtotal + calculateTax(subtotal);
    RETURN subtotal + 6.99;
END

CREATE INDEX ProductNameIndex on Product(name);
CREATE INDEX ProductBrandNameIndex on Product(brandName);
CREATE INDEX ProductTypeIndex on Product(type);
CREATE INDEX ProducttPriceIndex on Product(price);
CREATE INDEX CustomerTransactions on CustomerPurchases(customerID, transactionID);
CREATE INDEX ProductsInOneTransaction on Purchases(transactionID, productID);
CREATE INDEX transactionPrice on Transaction(transactionID, price);