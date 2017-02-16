<?php
require_once "../../Utilities/functions.php";

session_start();
header("Access-Control-Allow-Origin: *");

$cmd = getValue("cmd", "");
$numbers = getValue("num", array(0));

if ($cmd == "add")
{
    $response = add($numbers);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if ($cmd == "sub")
{
    $response = sub($numbers);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if ($cmd == "multi")
{
    $response = multi($numbers);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if ($cmd == "divide")
{
    $response = divide($numbers);
    header('Content-type: application/json');
    echo json_encode($response);
}
else // list all supported commands
{
  echo
  "
    <pre>
        Command: add
      
            Description: Adds an Array of Numbers together and returns a sum.
            
            Parameters: An array of numbers (num[])

            Example:
                Query string: calcs.php?cmd=add&num[]=1&num[]=1
                Returns: {\"Total\":2}

        Command: sub
      
            Description: Substract each number in an array from the previous.
            
            Parameters: An array of numbers (num[])

            Example:
                Query string: calcs.php?cmd=sub&num[]=4&num[]=1
                Returns: {\"Total\":3}
                
        Command: multi
      
            Description: Multiplies each number in an array by the each other.
            
            Parameters: An array of numbers (num[])

            Example:
                Query string: calcs.php?cmd=multi&num[]=5&num[]=2
                Returns: {\"Total\":4}
        
        Command: divide
      
            Description: Dividies each number in an array by the next number.
            
            Parameters: An array of numbers (num[])

            Example:
                Query string: calcs.php?cmd=divide&num[]=6&num[]=2
                Returns: {\"Total\":3}
        

    </pre>            
  ";
}

function add($numbers)
{
    $response = 0;
    foreach ($numbers as $num){
        $response += $num;
    }
    return array("Total" => $response);
}

function sub($numbers)
{
    $response = $numbers[0];
    for ($i =1; $i < count($numbers); $i++){
        $response -= $numbers[$i];
    }
    return array("Total" => $response);
}

function multi($numbers)
{
    $response = 1;
    foreach ($numbers as $num){
        $response *= $num;
    }
    return array("Total" => $response);
}

function divide($numbers)
{
    $response = $numbers[0];
    for ($i =1; $i < count($numbers); $i++){
        if($numbers[$i] == 0)
            return array("Error" => "Can't divide by 0!");
        else
            $response /= $numbers[$i];
    }
    return array("Total" => $response);
}
?>
