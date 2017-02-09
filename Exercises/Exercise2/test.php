<?php
    require_once "../../Utilities/functions.php";
    require_once "bankAccount.php";
    require_once "tirePressure.php";

    echo service_charge(900,1800,3);
    echo service_charge(1500, 1000, 3);
    echo service_charge(900, 1000, 3);
    echo service_charge(1200, 1800, 3);
    
    $tirePressures = getValue("tire", array(0));
   
    check_pressure($tirePressures[0], $tirePressures[1], $tirePressures[2], $tirePressures[3]);
    
?>