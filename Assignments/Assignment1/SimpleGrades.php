<?php
    
    # By Austin Thompson
    # Test link to showcase all calculations working: https://server-side-pappyhands-1.c9users.io/Server-Side/Assignments/SimpleGrades.php?num[]=69&num[]=21&num[]=2&num[]=8
    
    require_once("../../Utilities/functions.php");
    
    $numbers = getValue("num", array(0));
    # print_r($numbers);
    
    # practicing functions in php / calling said function
    solve($numbers);
    
    
    # performs calculations (avg, max, min)
    function solve($ary){
        
        $total = 0.0;
        $largest = 0.0;
        $smallest = 100000.0;
        
        # utilizing single foreach loop
        foreach ($ary as $num)
        {
            $total = $total + $num;
            
            if ($num > $largest)
                $largest = $num;
                
            if ($num < $smallest)
                $smallest = $num;
        }
        
        # echo'ing out results!
        echo "<p>Avg: " . $total/count($ary) . " Min: " . $smallest . " Max: " . $largest . "</p>";
    }
?>