<?php
    function check_pressure($fr, $fl, $rr, $rl) {
        
        // echo "Pressure: " . $fr;
        if(badPressure($fr)){
            echo "<p>Your front right tire's pressure is off! Your pressure is at $fr .</p>";
        }
        elseif(badPressure($fl)){
            echo "<p>Your front left tire's pressure is off! Your pressure is at $fl .</p>";
        }
        elseif(badPressure($rr)){
            echo "<p>Your rear right tire's pressure is off! Your pressure is at $rr .</p>";
        }
        elseif(badPressure($rl)){
            echo "<p>Your rear left tire's pressure is off! Your pressure is at $rl .</p>";
        }
        elseif($fr != $fl) {
            echo "<p>Your front tire pressures are not equal!</p>";
        }
        elseif($rr != $rl) {
            echo "<p>Your rear tire pressures are not equal!</p>";
        }
        else{
            echo "<p>Your tires are all good!</p>";
        }
        

    }
    
    function badPressure($tire){
        if($tire < 35 || $tire > 45){
            return true;
        }
        else {
            return false;
        }
    }
?>