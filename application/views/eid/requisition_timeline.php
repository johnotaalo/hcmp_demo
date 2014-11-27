
<chart lowerLimit='1' upperLimit='31'  palette='1' bgColor='FFFFFF' numberSuffix='th' lowerLimitDisplay='1st' upperLimitDisplay='31st' chartRightMargin='20'>
   <colorRange>
       
       <?php 
       $color = array(
           'low' => 'FF654F', //red
           'moderate' =>'F6BD0F', //orange
           'done' => '8BBA00' //Green
           
       );
       
       $color_submission = '';
       $color_approval = '';
       $color_distribution = '';
       
include ('kisumu.php');

$percentDone_submission = 7;
$percentDone_approval = 0;

for($i=1;$i<8;$i++){
    
    $lab_submitted = lab_submission($i);
    if($lab_submitted['kisumu_kit_imgtype'] === 'red'){
     $percentDone_submission --;
    }else{
 
        if($lab_submitted['approved'] === '1'){
            $percentDone_approval++;
            
        }
        
    
    }
    
    
}

$percentDone_submission = ceil($percentDone_submission*100/7);


if ($percentDone_submission < 70 ){
    
    $color_submission = $color['low'];
    
}elseif ($percentDone_submission > 70  && $percentDone_submission < 99 ) {
     $color_submission = $color['moderate'];
    
}else {
     $color_submission = $color['done'];
}
   




$percentDone_approval = ceil($percentDone_approval*100/7);


if ($percentDone_approval < 70 ){
    
    $color_approval = $color['low'];
    
}elseif ($percentDone_approval > 70  && $percentDone_approval < 99 ) {
     $color_approval = $color['moderate'];
    
}else {
     $color_approval = $color['done'];
}
     


       
       
       
       $max_submission = '10';
       $max_approval = '18';
       $percentage_submission = 'Report Submission ('.$percentDone_submission."% )";
       $percentage_approval = 'Report Approval ('.$percentDone_approval."%)";
       $percentage_distribution = 'Report Distribution ('. ceil($percentDone_Distribution/7)."% )";
       
       
       ?>
       
       
       
      <color minValue='1' 
             maxValue='<?php echo $max_submission; ?>' 
             code='<?php echo $color_submission;?>' 
             label='<?php echo $percentage_submission; ?>'/>
      
      <color minValue='<?php echo $max_submission; ?>' 
             maxValue='<?php echo $max_approval; ?>' 
             code='<?php echo $color_approval; ?>' 
             label='<?php echo $percentage_approval; ?>'/>
      
      <color minValue='<?php echo $max_approval; ?>' 
             maxValue='31' 
             code='<?php echo $color_distribution; ?>' 
             label='<?php echo $percentage_distribution; ?>'/>
      
      
      
      
   </colorRange>
   <pointers>
       //current date
      <pointer value='<?php echo date("d"); ?>' />
   </pointers>
</chart>