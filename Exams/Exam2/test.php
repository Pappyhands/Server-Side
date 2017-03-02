<?php
require_once "../../Utilities/functions.php";

session_start();
header("Access-Control-Allow-Origin: *");

# Variables
$cmd = getValue("cmd", "");
$mpg = getValue("mpg", 0);
$sizeOfTank = getValue("size", 0);
$costPerGallon = getValue("cost", 0);
$distanceOfTrip = getValue("distance", 0);

# Test cmd, returns API doc if invalid cmd is passed
if ($cmd == "howMuchGas"){
    $response = howMuchGas($mpg, $sizeOfTank, $costPerGallon, $distanceOfTrip);
    header('Content-type: application/json');
    echo json_encode($response);
}
else // list all supported commands
{
  echo
  "
    <pre>
        Command: howMuchGas

        Description: 
            Returns number of tanks you must fill up on a trip 
            and the cost to do so.  NOTE: this assumes that when 
            you add gas to your tank you always fill it up.
        
        Parameters: 
                mpg - miles per gallon of your vehicle
                tankSize - how many gallons your tank holds
                cost = the cost of a gallon of gas
                distance = how many miles you will be traveling
                
                NOTE: An error should be printed if any of these
                paraeters is less than or equal to 0 or  not a valid number.
    
        Example:
            Query string: ?cmd=howMuchGas&mpg=1&size=2&cost=10&distance=5
            Returns:  
                {'error':'','tanksFills':3,'totalCost':60}
    </pre>            
  ";
}

# Function that does all the work
function howMuchGas($mpg, $sizeOfTank, $costPerGallon, $distanceOfTrip){
    
    
    # Determines the Error Message
    $errorMsg;

    if(!is_numeric($mpg) or $mpg < 0){
        $errorMsg = "Please specify mpg of Car.";
    }elseif (!is_numeric($sizeOfTank) or $sizeOfTank < 0){
        $errorMsg = "Please specify size of gas tank.";
    }elseif(!is_numeric($costPerGallon) or $costPerGallon < 0){
        $errorMsg = "Cost per gallon must be a positive integer.";
    }elseif(!is_numeric($distanceOfTrip) or $distanceOfTrip < 0){
        $errorMsg = "Cost per gallon must be a positive integer.";
    }else{
        $errorMsg = "";
    }
    # ----------------------------------------------
    
    # Calculates Values and then returns them.
    if($errorMsg == ""){
        
        $tankFills = ceil($distanceOfTrip / $sizeOfTank);
        
        $totalCost = $tankFills * $sizeOfTank * $costPerGallon;
    }else{
        $tankFills = 0;
        
        $totalCost = 0;
    }
    
    return array("error:" => $errorMsg, "tankFills:" => $tankFills, "totalCost" => $totalCost);
}
