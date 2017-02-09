<?php
require_once("../Utilities/functions.php");

$numbers = getValue("num", array(0));
$ave = average($numbers);
$big = maximum($numbers);
$small = minimum($numbers);

echo "<p>Ave: $ave Max: $big Min: $small</p>";

function average($ary)
{
    $total = 0.0;
    foreach ($ary as $num)
    {
        $total = $total + $num;
    }
    return $total/count($ary);
}

function maximum($ary)
{
    $largest = 0.0;
    foreach ($ary as $num)
    {
        if ($num > $largest)
            $largest = $num;
    }
    return $largest;
}

function minimum($ary)
{
    $smalest = 100000.0;
    foreach ($ary as $num)
    {
        if ($num < $smalest)
            $smalest = $num;
    }
    return $smalest;
}
?>