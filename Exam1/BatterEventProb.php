<?php
    
    # By Austin Thompson
    # Test links to showcase it works: 
    
    # Red Font:
    # https://server-side-pappyhands-1.c9users.io/Server-Side/Exam1/BatterEventProb.php?first=Austin&last=Thompson&bats=200&hits=78&homers=8
    
    # Divide by 0 Error:
    # https://server-side-pappyhands-1.c9users.io/Server-Side/Exam1/BatterEventProb.php?first=Austin&last=Thompson&bats=0&hits=78&homers=8
    
    require_once("../Utilities/functions.php");
    
    # variables
    $m_firstName = getValue("first",  "John");
    $m_lastName = getValue("last",  "Doe");
    $m_atBats = getValue("bats",  100);
    $m_hits = getValue("hits",  30);
    $m_homeRuns = getValue("homers",  5);
    
    
    
    # calling Main function
    echo Main($m_firstName,  $m_lastName ,  $m_atBats, $m_hits, $m_homeRuns);
    
    # performs calculation for batting average
    function battingAve($h, $ab){
        return $h / $ab;
    }
    
    # performs calculation for home run chance
    function hrChance($hr, $ab){
        return $hr / $ab;
    }
    
    # choices the text color for the batting average
    function fColor($batAvg){
        if ($batAvg >= 0.3)
            return "red";
        else 
            return "black";
    }
    
    # runs the all the code together and returns output
    function Main($f, $l, $ab, $h, $hr){
        $f_batAvg;
        $f_hrChance;
        
        if($ab == 0){
            $f_batAvg = 0;
            $f_hrChance = 0;
        }else{
            $f_batAvg = battingAve($h,$ab);
            $f_hrChance = hrChance($hr, $ab);
        }
        
        $f_fColor = fColor($f_batAvg);
       
        # building a simple html skeleton to display information 
        return "   
                <html>
                <head>
                  <title>Server-Side Exam #1</title>
                </head>
                <body>
                    <p>Player: $f $l</p>
                    <p>At Bats: $ab</p>
                    <p>Hits: $h</p>
                    <p>Home Runs: $hr</p>
                    <p>----------------</p>
                    <p><strong>Stats</strong></p>
                    <p>----------------</p>
                    <p>Batting Average: <span style='color:".$f_fColor."'>$f_batAvg</span></p>
                    <p>Home Run Chance: $f_hrChance</p>
                    
                    
                </body>
                </html>
                
                ";
    }
?>

