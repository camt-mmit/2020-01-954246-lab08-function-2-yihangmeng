<?php
/*ID: 602110195
Name: Zhang Hao(Henry)
Wechat: hikki*/
$f=fopen($_SERVER['argv'][1], 'r');
fscanf($f,"%d",$n);
$students=[];
for($i=0;$i<$n;$i++){
	$student=[];
	fscanf($f,"%s%s%f",$student['name'],$student['section'],$student['score']);
	$students[]=$student;
}fclose($f);
function build_sorter($key){
    return function($a,$b)use($key){
        return strnatcmp($b[$key],$a[$key]);
    };
}usort($students, build_sorter('score'));
$printstudent=function($student){
    printf("%-11s%s:%7.2f\n",$student['name'],$student['section'],$student['score']);
};
array_walk($students,$printstudent);
?>