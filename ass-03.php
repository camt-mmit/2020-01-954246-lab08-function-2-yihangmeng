<?php
/*ID: 602110195
Name: Zhang Hao(Henry)
Wechat: hikki*/
$f=fopen($_SERVER['argv'][1], 'r');
fscanf($f,"%d",$n);
$students=[];
for($i=0;$i<$n;$i++){
	$student=[];
	fscanf($f,"%s%s%f%f%f",$student['name'],$student['section'],$student['score1'],$student['score2'],$student['score3']);
	$sum=$student['score1']+$student['score2']+$student['score3'];
	$student['sum']=$sum;
	$students[]=$student;
}fclose($f);
if($_SERVER['argc']>=4){
    $sf=array_filter($students,function($student)use($avg){
        return$student['section']==$_SERVER['argv'][3];
    });
}elseif($_SERVER['argc']<=3){
    $sf=$students;
}function sortArrByManyField(){
    $args=func_get_args();
    if(empty($args)){
      return null;
    }$arr=array_shift($args);
    if(!is_array($arr)){
      throw new Exception("The first parameter is not a quantity");
    }foreach($args as$key=>$field){
      if(is_string($field)){
        $temp=array();
        foreach($arr as$index=>$val){
          $temp[$index]=$val[$field];
        }$args[$key]=$temp;
      }
    }$args[]=&$arr;
    call_user_func_array('array_multisort',$args);
    return array_pop($args);
}if($_SERVER['argv'][2]=="name"){
    $sf=sortArrByManyField($sf,'name',SORT_ASC,'section',SORT_ASC);
}elseif($_SERVER['argv'][2]=="section"){
    $sf=sortArrByManyField($sf,'section',SORT_ASC,'name',SORT_ASC);
}elseif($_SERVER['argv'][2]==1){
    $sf=sortArrByManyField($sf,'score1',SORT_ASC,'section',SORT_ASC,'name',SORT_ASC);
}elseif($_SERVER['argv'][2]==2){
    $sf=sortArrByManyField($sf,'score2',SORT_ASC,'section',SORT_ASC,'name',SORT_ASC);
}elseif($_SERVER['argv'][2]==3){
    $sf=sortArrByManyField($sf,'score3',SORT_ASC,'section',SORT_ASC,'name',SORT_ASC);
}elseif($_SERVER['argv'][2]=="total"){
    $sf=sortArrByManyField($sf,'sum',SORT_ASC,'section',SORT_ASC,'name',SORT_ASC);
}$printstudent=function($student){
    printf("%-11s%s:%7.2f%7.2f%7.2f = %7.2f\n",$student['name'],$student['section'],$student['score1'],$student['score2'],$student['score3'],$student['sum']);
};
$avg=array_reduce($sf,function($carry, $student){
	return$carry+$student['sum'];
},0)/count($sf);
array_walk($sf,$printstudent);
printf("\nAverage total score =%7.2f",$avg);
?>