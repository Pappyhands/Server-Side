<?php
    
    # By Austin Thompson
    # Test link to showcase it works: 
    
    require_once("../../Utilities/functions.php");
    
   	$m_start = getValue("start", 1);
   	$m_end = getValue("end", 10);
    
    
    # practicing functions in php / calling said function
    solve($m_start, $m_end);
    
    
    # performs calculations
    function solve($start, $end){
        
        $sum = 0;
        
        for ($i = $start; $i <= $end; $i = $i + 1)
        { $sum = $sum + $i; }
        
        # echo'ing out results
        echo "<p>SUM: " . $sum . "</p>";
    }
?>