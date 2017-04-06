
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
$name = getValue("name", "");
if ($cmd == "getClasses")
{
    $response = getClasses($conn,$name);
    header('Content-type: application/json');
    echo json_encode($response);
}
else // list all supported commands
{
  echo
  "
    <pre>
        Command: 
      
            Description: 
            
            Parameters: 

            Example:
                Query string: 
                Returns: 

        Command: 
      
            Description:
            
            Parameters:

            Example:
                Query string: 
                Returns: 

    </pre>            
  ";
}

function getClasses($conn,$name)
{
    $result = $conn->query("SELECT ID, Class FROM Courses WHERE PROF ='" . $name ."'");
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) 
    {
        $rows[] = $r;
    }
    return $rows;
}

?>
