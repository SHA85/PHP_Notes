<?php
// Count Leading Zero of string
$sample1 = "1000101";
$sample2 = "000101";

echo CountStartZero($sample1);
echo CountStartZero($sample2);

function CountStartZero($str) {
	$count = 0;
	foreach(str_split($str, 1) as $value ){
	    if($value == 0)
	    	$count++;
	    else return $count;
	}
}

// Other Ref :: https://www.geeksforgeeks.org/how-to-remove-all-leading-zeros-in-a-string-in-php/
