<?php
	require_once "../Utilities/functions.php";

	$word = getValue("word", "no word entered");
	$output;
	
	for ($i = 0; $i < strlen($word); $i +=1)
	{
		$output = $output . $word . "<br>";
	}
	
echo "
<html>
	<head>
		<title>BasicInputs.php</title>
	</head>

	<body>
		<p>You entered '$word' .</p>
		<p>$output</p>
		
		
	</body>
</html>";

    

?>