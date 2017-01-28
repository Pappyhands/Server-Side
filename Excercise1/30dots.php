<?php
	require_once "../Utilities/functions.php";

	$word1 = getValue("word1", "no word entered");
	$word2 = getValue("word2", "no word entered");
	$wordsLength = strlen($word1 . $word2);
	$dots = (30 - $wordsLength);
	
	$finalWord = $word1;

	 for ($i = 0; $i < $dots; $i +=1)
	{
		$finalWord = $finalWord . ".";
	}
	
	$finalWord = $finalWord . $word2;
   
  	
	echo "$finalWord";
	echo strlen($finalWord);
?>