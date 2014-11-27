<div class="panel-group " id="accordion" style="padding: 0;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="" id="roll_out"><span class="glyphicon glyphicon-bullhorn">
                            </span>Roll out at a glance</a>
                        </h4>
                    </div>

                </div>
             <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a  data-toggle="collapse" data-parent="#accordion" href="#collapsec" id="subcounities"><span class="glyphicon glyphicon-list-alt">
                            </span>Sub counties in the county</a>
                        </h4>
                    </div>
                     <div id="collapsec" class="panel-collapse collapse">
           <ol>
<?php
foreach($district_data as $district_detail){
echo "<li>
<a class='ajax_call' id='$district_detail->id' href='#'>$district_detail->district</a>
</li>";			
		}
?>		
</ol>
                </div> 
                </div>   
                </div>

            
