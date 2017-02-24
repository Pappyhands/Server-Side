<?php
require_once "../../Utilities/functions.php";

session_start();
header("Access-Control-Allow-Origin: *");

$cmd = getValue("cmd", "");
$wallArea = getValue("sqWalls", 0);
$canArea = getValue("sqCan", 0);
$cost = getValue("cost", 0);

if ($cmd == "calcCost"){
    $response = calcCost($wallArea, $canArea, $cost);
    header('Content-type: application/json');
    echo json_encode($response);
}
else // list all supported commands
{
  echo
  "
    <pre>
        Command: calcCost
      
            Description: Calculates total number of cans need to paint all of the area of the walls
            
            Parameters: wallArea = Total Area of Walls in Sq Ft (default 0)
                        canArea = Total Area a single Can of Paint can cover in Sq Ft (default 0)
                        cost = Cost for a Single Can of Paint (default 0)
    
            Example:
                Query string: ?cmd=calcCost&sqWalls=2sqCan=1cost=5
                Returns: 10
    </pre>            
  ";
}

function calcCost($wallArea, $canArea, $cost)
{

    $errorMsg;

    if(!is_numeric($wallArea) or $wallArea < 0){
        $errorMsg = "Please specify total area of Walls.";
    }elseif (!is_numeric($canArea) or $canArea < 0){
        $errorMsg = "Please specify number of square feet a can of paint can cover.";
    }elseif(!is_numeric($cost) or $cost < 0){
        $errorMsg = "Cost per can must be a positive number.";
    }else{
        $errorMsg = "None.";
    }

    
    if($errorMsg == "None."){
        $numberOfCans = $wallArea / $canArea;
        
        $totalCost = $cost * $numberOfCans;
    }else{
        $numberOfCans = 0;
        
        $totalCost = 0;
    }
    
    return array("Error:" => $errorMsg, "Cans:" => ceil($numberOfCans), "Total($):" => $totalCost);
}
