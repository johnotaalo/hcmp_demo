<chart lowerLimit='1' upperLimit='31'  palette='1' bgColor='FFFFFF' numberSuffix='th' lowerLimitDisplay='1st' upperLimitDisplay='31st' chartRightMargin='20'>
   <colorRange>
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