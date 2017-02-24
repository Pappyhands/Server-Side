<?php
require_once "../../Utilities/functions.php";

session_start();
header("Access-Control-Allow-Origin: *");

$cmd = getValue("cmd", "");
$height = getValue("H", 0);
$weight = getValue("W", 0);

if ($cmd == "BMI"){
    $response = calcBMI($height,$weight);
    header('Content-type: application/json');
    echo json_encode($response);
}
else // list all supported commands
{
  echo
  "
    <pre>
        Command: BMI
      
            Description: Calculates a body mass index (BMI).
            
            Parameters: w = weight in lbs (default 0)
                        h = height in inches (default 0)
    
            Example:
                Query string: ?cmd=BMI&H=72&W=160
                Returns: {'w':72,'h':1.8,'bmi':22.222222222222,'status':'healty'}
    </pre>            
  ";
}

function calcBMI($h, $w)
{
    $hMetric = $h * .025;
    $wMetric = $w * .45;
    
    if($hMetric != 0 and $wMetric != 0){
        $BMI = $wMetric / ($hMetric * $hMetric);
    }else{
        return array("Error:"=> "Please enter valid inputs!");
    }
    
    
    $status;
    
    if($BMI >= 19 and $BMI <= 25){
        $status = 'Healthy';
    }else{
        $status = 'Unhealthy';
    }

    return array("H"=> intval($h),"W"=> intval($w), "BMI" => $BMI, "Status" => $status);
}

# NOTE: A healthy BMI is >= 19 <= 25

# BMI = weight [kg] / (height [meters] * height [meters])
// If your service is called without a valid command it should print the message shown above.  In addition, be sure to guard against a divide by zero error if the height is entered as 0.

// Notice that the query string accepts weight in pounds and height in inches.  Your service must convert these values to kg and meters.  Please use the following conversion factors:

// 0.45 kg/lb
// 0.025 m/in
// Finally, your service should return the result in JSON using the following format:

// {'w':72,'h':1.8,'bmi':22.222222222222,'status':'healty'}