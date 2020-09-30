<?php
/*ID: 602110195
Name: Zhang Hao(Henry)
Wechat: hikki*/
$f=fopen($_SERVER['argv'][1], 'r');
fscanf($f,"%d",$n);
$students=[];
for($i=0;$i<$n;$i++){
	$student=[];
	fscanf($f,"%s%s%f%f",$student['name'],$student['section'],$student['score1'],$student['score2']);
	$sum=$student['score1']+$student['score2'];
	$student['sum']=$sum;
	$students[]=$student;
}fclose($f);
$avg=array_reduce($students,function($carry, $student){
	return$carry+$student['sum'];
},0)/count($students);
$printstudent=function($student){
    printf("%-11s%s:%7.2f%7.2f =%7.2f\n",$student['name'],$student['section'],$student['score1'],$student['score2'],$student['sum']);
};
$GoE=array_filter($students,function($student)use($avg){
	return$student['sum']>=$avg;
});
$SoGoE=array_reduce($GoE,function($carry,$student){
	return$carry+$student['sum'];
});
array_walk($students,$printstudent);
printf("Average total score :%7.2f\n",$avg);
printf("Summation of total score greater than or equal%7.2f  :%7.2f",$avg,$SoGoE);
?>