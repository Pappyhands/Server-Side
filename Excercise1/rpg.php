<?php
	require_once "../Utilities/functions.php";

	$name = getValue("name", "NULL");
	$strength = getValue("strength", "0");
	$health = getValue("health", "0");
	$luck = getValue("luck", "0");
	
    $totalPoints = ($strength + $health + $luck);
    
    if($totalPoints > 15){
        $strength = 5;
        $health = 5;
        $luck = 5;
        
        echo "Warning: Your total points exceeds 15. We will assign 5 points for each.";
    }
    
    echo "
        <html>
            <body>
          
                <p>You're name is '$name'.</p>
                <p>You're strength is '$strength'.</p>
                <p>You're health is '$health'.</p>
                <p>You're luck is '$luck'.</p>
            
            </body>
        </html>
    
    
    ";
    
?>