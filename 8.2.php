<?php
$choice = $argv[2];
if($argv[2]=='name')
	$choice=0;
if($argv[2]=='total')
	$choice=3;
$cmp = function($x,$y) use($choice)
{
$tmp=explode(" ",$x);
if($choice==3)
	$a=$tmp[1]+$tmp[2];
else
	$a=$tmp[$choice];
    $c=$tmp[0];
$tmp=explode(" ",$y);
if($choice==3)
	$b=$tmp[1]+$tmp[2];
else
	$b=$tmp[$choice];
	$d=$tmp[0];
	if($a==$b)
	{
		if($c==$d)		
		return 0;
		if($c<$d)		
		return -1;
		if($c>$d)		
		return 1;
	}
	if($a<$b)
		return -1;
	if($a>$b)
		return 1;
};
$text = file_get_contents($argv[1]);
$tmp=explode("\r\n",$text);
array_shift($tmp);//Remove first element of array
usort($tmp,$cmp);

array_walk($tmp,function($item) {
	$tmp = explode(' ',$item);
	echo $item." = ".($tmp[1]+$tmp[2])."\n";});
