<?php
    function service_charge($checking, $savings, $checks) {
        $checkingFee = 0;
        if($checking < 1000 || $savings < 1500) {
            $checkingFee = 0.15;
        }
        
        return "<p> You service charge is " . ($checkingFee * $checks) . "</p>.";
    }
?>