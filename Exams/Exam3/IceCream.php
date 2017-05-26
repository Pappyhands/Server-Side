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
else if ($cmd == "sub")
{
    $response = sub();
    header('Content-type: application/json');
    echo json_encode($response);
}
else if ($cmd == "fetch")
{
    $response = fetch();
    header('Content-type: application/json');
    echo json_encode($response);
}
else // list all supported commands
{
  echo
  "
    <pre>
        Command: add
      
            Description: adds a flavor to a list
            
            Parameters: num

            Example:
                Query string: ?cmd=add&num=Vanilla 
                Returns: {'last': 'Vanilla', 'numbers': ['Vanilla','Chocolate'] }
                
        Command: fetch
      
            Description: displays a flavor to a list
            

            Example:
                Query string: ?cmd=fetch
                Returns: {'last': 'Vanilla', 'numbers': ['Vanilla','Chocolate'] }
                
        Command: sub
      
            Description: subtract a flavor to a list
            
            Parameters: num

            Example:
                Query string: ?cmd=sub&num=Vanilla 
                Returns: {'last': 'Vanilla', 'numbers': ['Chocolate'] }                
    </pre>            
  ";
}

function add()
{
	$numbers = getSessionValue("numbers", []);
    $num = getValue("num", "N/A");
    if (in_array($num, $numbers) == false){
        $numbers[] = $num;
    }
	setSessionValue("numbers", $numbers);
	$max = $num;
	
    return array("last"=>$max, "numbers"=>$numbers);
}

function sub()
{
	$numbers = getSessionValue("numbers", []);
	$newNumbers = [];
    $num = getValue("num", "N/A");
    
    foreach ($numbers as $n){
        if ($n != $num){
            array_push($newNumbers,$n);
        }
    }
    
	setSessionValue("numbers", $newNumbers);
	$max = $num;
	
    return array("last"=>$max, "numbers"=>$newNumbers);
}

function fetch()
{
	$numbers = getSessionValue("numbers", []);
	$max = max($numbers);
    return array("last"=>$max, "numbers"=>$numbers);
}
?>
