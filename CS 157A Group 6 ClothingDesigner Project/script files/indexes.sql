USE ClothingDatabase;

CREATE OR REPLACE INDEX ProductNameIndex on Product(name);
CREATE OR REPLACE INDEX ProductBrandNameIndex on Product(brandName);
CREATE OR REPLACE INDEX ProducttPriceIndex on Product(price);
CREATE OR REPLACE INDEX CustomerTransactions on CustomerPurchases(customerID, transactionID);
CREATE OR REPLACE INDEX ProductsInOneTransaction on Purchases(transactionID, productID);
CREATE OR REPLACE INDEX transactionPrice on Transaction(transactionID, price);