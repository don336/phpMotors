<?php
    function checkEmail($clientEmail){
         $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
         return $valEmail;
    }

    function checkPassword($clientPassword){
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
        return preg_match($pattern, $clientPassword);
    }

    function checkClassifications($classifications){
        // Generates a Navigation List
        $navList = '<ul class="navbar">';
        $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
        foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName="
        .urlencode($classification['classificationName']).
        "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
        }
        $navList .= '</ul>';

        return $navList;
    }


    // Build the classifications select list 
    function buildClassificationList($classifications){ 
    $classificationList = '<select name="classificationId" id="classificationList">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
    }

    // Build and display of vehicles with in an unordered list.
    function buildVehiclesDisplay($vehicles){
        $dv = '<ul id="inv-display">';
        foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<a class='black' href='/phpmotors/vehicles/?action=vehicleDetail&vehicleId=$vehicle[invId]'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
        $dv .= '<hr>';
        $dv .= "<a class='black' href='/phpmotors/vehicles/?action=vehicleDetail&vehicleId=$vehicle[invId]'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
        $dv .= "<span>$vehicle[invPrice]</span>";
        $dv .= '</li>';
        }
        $dv .= '</ul>';
        return $dv;
}
    function buildVehiclesDetails($vehicle){
        $dv = '<div id="detailContainer">';
        $dv .= '<div class="grid1">';
        $dv .= "<img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= " <h2>Price: $$vehicle[invPrice]</h2>";
        $dv .= '</div>';

        $dv .= "<div class='grid2'>
            <h1 class='black'>$vehicle[invModel] $vehicle[invMake] Details</h1>
            <p>$vehicle[invDescription]</P>
            <h3>Color: $vehicle[invColor]</h3>
            <p># in Stock: $vehicle[invStock]</P>
        </div>";
        $dv .= '</div>';
        return $dv;
}
?>