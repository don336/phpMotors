<?php
// Accounts
// Register a nw client
function regVehicle($classificationId,$invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invColor, $invStock){
    $db = phpmotorsConnect();

    // The SQL Statement
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invColor, invStock, classificationId) VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invColor, :invStock, :classificationId)';

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next four lines replace the placeholder in the SQL
    // statement with actual values in the variales and tells the database the types of data it is

    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of the succes (rows changed)
    return $rowsChanged;
}
function add_Classification($classificationName){
    $db = phpmotorsConnect();

    // The SQL Statement
    $sql = 'INSERT INTO carclassification (classificationName) VALUES (:classificationName)';

    // Create the prepared statement using the phpmotors connection
    $cv = $db->prepare($sql);

    // The next four lines replace the placeholder in the SQL
    // statement with actual values in the variales and tells the database the types of data it is
    $cv->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);

    // Insert the data
    $cv->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $cv->rowCount();
    // Close the database interaction
    $cv->closeCursor();
    // Return the indication of the succes (rows changed)
    return $rowsChanged;
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
 $db = phpmotorsConnect(); 
 $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
 $stmt = $db->prepare($sql); 
 $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
 $stmt->execute(); 
 $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
 $stmt->closeCursor(); 
 return $inventory; 
}

function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}
// Update Vehicle
function updateVehicle($classificationId,$invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invColor, $invStock,$invId){
    $db = phpmotorsConnect();

    // The SQL Statement
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
	invDescription = :invDescription, invImage = :invImage, 
	invThumbnail = :invThumbnail, invPrice = :invPrice, 
	invStock = :invStock, invColor = :invColor, 
	classificationId = :classificationId WHERE invId = :invId';

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next four lines replace the placeholder in the SQL
    // statement with actual values in the variales and tells the database the types of data it is

    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_INT);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of the succes (rows changed)
    return $rowsChanged;
}
// Delete a vehicle
function DeleteVehicle($invId){
    $db = phpmotorsConnect();

    // The SQL Statement
    $sql = 'DELETE FROM inventory WHERE invId = :invId';

    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    // The next four lines replace the placeholder in the SQL
    // statement with actual values in the variales and tells the database the types of data it is
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of the succes (rows changed)
    return $rowsChanged;
}

// Get a list of vehicles based on the classification.
function getVehiclesByClassification($classificationName){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
}

function getVehicleById($vehicleId){
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $vehicleId, PDO::PARAM_INT);
    $stmt->execute();
    $vehicleDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicleDetails;
}