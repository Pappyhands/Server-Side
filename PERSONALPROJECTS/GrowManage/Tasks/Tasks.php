
<?php
require_once "../../functions.php";
require_once '../dblogin.php';

session_start();
header("Access-Control-Allow-Origin: *");

// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$cmd = getValue("cmd", "");
if ($cmd == "getTasks")
{
    $response = getTasks($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if ($cmd == "addTask")
{
    $response = addTask($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if ($cmd == "deleteTask")
{
    $response = deleteTask($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else if ($cmd == "grabTask")
{
    $response = grabTask($conn);
    header('Content-type: application/json');
    echo json_encode($response);
}
else // list all supported commands
{
  echo
  "
    <pre>
        Command: getCourses
      
            Description: Returns an array of all of the courses in the database
            
            Parameters: none

            Example:
                Query string: ?cmd=getCourses
                Returns: 
    </pre>            
  ";
}

function getTasks($conn)
{
    $result = $conn->query("SELECT * FROM MyTasks");
    $rows = array();
    while($r = mysqli_fetch_assoc($result)) 
    {
        $rows[] = $r;
    }
    return $rows;
}

function addTask($conn)
{
    $taskName = getValue("taskName", "");
    $personAssigned = getValue("personAssigned", "");
    
    if ($taskName != "" && $personAssigned != "")
    {
        $stmt = $conn->prepare("INSERT INTO MyTasks (TaskName, PersonAssigned) VALUES (? , ?)");
        $stmt->bind_param("ss", $taskName, $personAssigned);
        $stmt->execute();
        return getTasks($conn);
    }
    else 
    {
        return array("error"=>"All fields are required");    
    }
}


function editTask($conn)
{
    $taskName = getValue("taskName", "");
    $personAssigned = getValue("personAssigned", "");
    
    if ($taskName != "" && $personAssigned != "")
    {
        $stmt = $conn->prepare("INSERT INTO MyTasks (TaskName, PersonAssigned) VALUES (? , ?)");
        $stmt->bind_param("ss", $taskName, $personAssigned);
        $stmt->execute();
        return getTasks($conn);
    }
    else 
    {
        return array("error"=>"All fields are required");    
    }
}


function deleteTask($conn)
{
    $taskID = getValue("taskID", "");

    if ($taskID != "")
    {
        $stmt = $conn->prepare("DELETE FROM MyTasks WHERE TaskID = ?");
        $stmt->bind_param("i", $taskID);
        $stmt->execute();
        return getTasks($conn);
    }
    else 
    {
        return array("error"=>"A problem happened when trying to delete an entry.");    
    }
}



function grabTask($conn)
{
    $taskID = getValue("taskID", "");
    $fetchedInformation = [];
    
    if ($taskID != "")
    {
        $stmt = $conn->prepare("SELECT `TaskName`, `PersonAssigned`, `TaskStatus`, `Notes` FROM MyTasks WHERE TaskID = ?");
        $stmt->bind_param( "i", $taskID); 
        $stmt->execute();
       
       
        $meta = $stmt->result_metadata();

        while ($field = $meta->fetch_field()) {
          $parameters[] = &$row[$field->name];
        }
        
        call_user_func_array(array($stmt, 'bind_result'), $parameters);
        
        while ($stmt->fetch()) {
          foreach($row as $key => $val) {
            $x[$key] = $val;
          }
          $results[] = $x;
        }
        return $results;
    }
    else 
    {
        return array("error"=>"A problem happened when trying to grab an entry.");    
    }
}



?>
