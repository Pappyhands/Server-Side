
<?php
require_once "functions.php";
require_once 'dblogin.php';

session_start();
header("Access-Control-Allow-Origin: *");

// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$cmd = getValue("cmd", "");
if ($cmd == "getStates")
{
    $response = getStates($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if ($cmd == "addState")
{
    $response = addState($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if ($cmd == "deleteState")
{
    $response = deleteState($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}

else // list all supported commands
{
  echo
  "
  
  
deleteState
    <pre>
        Command: getStates
      
            Description: Returns an array of all of the states in the database
            
            Parameters: none

            Example:
                Query string: ?cmd=getStates
                Returns: [{\"StateID\":\"26\",\"StateAbbrev\":\"kk\",\"StateName\":\"aaaaa\",\"Population\":\"222\"},
                {\"StateID\":\"28\",\"StateAbbrev\":\"aa\",\"StateName\":\"test\",\"Population\":\"1\"}]
                
        ******************************************************************************************************        
        -x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-
        ****************************************************************************************************** 
        
        Command: addState
      
            Description: Returns an array of all of the states in the database
            
            Parameters: StateAbbrev, StateName, Population

            Example:
                Query string: ?cmd=addState&StateAbbrev=MA&StateName=Massachusetts&Population=1000000
                Returns: [{\"StateID\":\"26\",\"StateAbbrev\":\"kk\",\"StateName\":\"aaaaa\",\"Population\":\"222\"},
                {\"StateID\":\"28\",\"StateAbbrev\":\"aa\",\"StateName\":\"test\",\"Population\":\"1\"},
                {\"StateID\":\"29\",\"StateAbbrev\":\"MA\",\"StateName\":\"Massachusetts\",\"Population\":\"1000000\"}]
                
        ******************************************************************************************************        
        -x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-x-
        ****************************************************************************************************** 
        
        Command: deleteState
      
            Description: Returns an array of all of the states in the database
            
            Parameters: none

            Example:
                Query string: ?cmd=deleteState&stateID=29
                Returns: [{\"StateID\":\"26\",\"StateAbbrev\":\"kk\",\"StateName\":\"aaaaa\",\"Population\":\"222\"},
                {\"StateID\":\"28\",\"StateAbbrev\":\"aa\",\"StateName\":\"test\",\"Population\":\"1\"}]
                
    </pre>            
  ";
}
function getStates($conn)
{
    $result = $conn->query("SELECT * FROM MyStates");
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) 
    {
        $rows[] = $r;
    }
    return $rows;
}

function addState($conn)
{
    $StateAbbrev = getValue("StateAbbrev", "");
    $StateName = getValue("StateName", "");
    $Population = getValue("Population", "");
    
    // Checks if population is an integer larger then 0.
    if ($Population <= 0)
    {
        return array("error"=>"Population must be a positive integer larger then 0."); 
    }
    // Checks the Abbreviation to see if it is composed of all letters and has a length of 2.
    elseif (strlen($StateAbbrev) != 2 or ctype_alpha($StateAbbrev) == false)
    {
        return array("error"=>"Invalid State Abbreviation."); 
    }
    // Checks to see if the State Name is at least 4 letters long and if it is composed of all letters.
    elseif (strlen($StateName) < 4 or ctype_alpha($StateName) == false)
    {
        return array("error"=>"Invalid State Name."); 
    }
    elseif ($StateAbbrev != "" && $StateName != "" && $Population != "")
    {
        $stmt = $conn->prepare("INSERT INTO MyStates(StateAbbrev, StateName, Population) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $StateAbbrev, $StateName, $Population);
        $stmt->execute();
        return getStates($conn);
    }
    else 
    {
        return array("error"=>"All fields are required");    
    }
}

function deleteState($conn)
{
    $stateID = getValue("stateID", "");

    if ($stateID != "")
    {
        $stmt = $conn->prepare("DELETE FROM MyStates WHERE StateID = ?");
        $stmt->bind_param("i", $stateID);
        $stmt->execute();
        return getStates($conn);
    }
    else 
    {
        return array("error"=>"All fields are required");    
    }
}



?>
