<?php
$choice = 1;
$cmp = function($x,$y) use($choice)
{
	$tmp=explode(" ",$x);
	$a=$tmp[$choice];
	$tmp=explode(" ",$y);
	$b=$tmp[$choice];
	if($a==$b)
		return 0;
	if($a<$b)
		return 1;
	if($a>$b)
		return -1;
};
$text = file_get_contents('ass-01-input.txt');
$ar_number=explode("\r\n",$text);
array_shift($ar_number);//Remove first element of array
usort($ar_number,$cmp);
array_walk($ar_number,function($item) {echo $item."\n";});
