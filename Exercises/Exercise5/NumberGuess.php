<?php
require_once "functions.php";

session_start();
header("Access-Control-Allow-Origin: *");

$cmd = getValue("cmd", "");
if ($cmd == "add")
{
    $response = add();
    header('Content-type: application/json');
    echo json_encode($response);
}
else // list all supported commands
{
  echo
  "
    <pre>
        Command: add
      
            Description: allows the user to guess a number from 1 to 10
            
            Parameters: num

            Example:
                Query string: ?cmd=add&num=5 
                Returns: {'list of numbers': 5, 'greatest': 5}
    </pre>            
  ";
}

function add()
{
	$numbers = getSessionValue("numbers", array());
	$num = getValue("num", -1);
	
	array_push($numbers, intval($num));
	
	setSessionValue("numbers", $numbers);
	$largest = 0;
	
	foreach($numbers as $i){
		if ($i > $largest){
			$largest = $i;
		}
	}
	
	
    return array("listOfNumber:"=> $numbers, "largest:"=> $largest);
}

?>
