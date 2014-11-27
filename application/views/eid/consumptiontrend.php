<chart canvasPadding="5" caption="" yAxisName="No. of Kits Used"   xAxisName="Months ( Year <?php echo $currentyear;?> )" bgColor="F7F7F7, E9E9E9" numVDivLines="100" divLineAlpha="10"  labelPadding ="10" yAxisValuesPadding ="5" showValues="0" rotateValues="0" valuePosition="above" bgcolor="#FFFFFF" showBorder="0" formatNumberScale="0">
    <categories>
            <category label="Jan" /> 
            <category label="Feb" /> 
            <category label="Mar" /> 
            <category label="Apr" /> 
            <category label="May" /> 
            <category label="Jun" /> 
			<category label="Jul" /> 
			<category label="Aug" /> 
			<category label="Sep" /> 
			<category label="Oct" /> 
			<category label="Nov" /> 
			<category label="Dec" /> 
    </categories>
	<?php echo $dataset; ?>
</chart>