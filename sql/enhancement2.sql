--Query-1
INSERT INTO `clients`( `client_firstName`, `client_lastName`, `client_email`, `client_password`, `client_comment`) VALUES ('Tony','Stack','ton@starkent,com','Iam1ronM@n','I am the real Ironman')
--Query-2
SELECT inventory.invModel, carclassification.classificationName
FROM inventory
INNER JOIN carclassification ON inventory.invModel=carclassification.classificationName;
--Query-3
DELETE FROM `inventory` WHERE invModel='Model T'
--Query-4
UPDATE  `inventory` SET invThumbnail=concat('/phpmotors',invThumbnail)