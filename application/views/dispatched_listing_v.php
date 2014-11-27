<?php
$p=count ($order_list);
	if($p==0):	
	echo '<div id="notification">No order has been dispatched from KEMSA</div>';
	else :?>
<table class="data-table">
    <caption> Dispatched Orders</caption>
    <tr>
        <th>Facility Order No</th>
        <th>KEMSA Order No</th>
        <th>Order Total Ksh</th>
        <th>Date Ordered</th>
        <th>Date Reviewed</th>
        <th>Date Dispatched</th>
        <th>Days Pending</th>
        <th>Action</th>
    </tr>
        <?php
        foreach($order_list as $rows):	
        ?>
    <tr>
        <td><?php echo $rows->id;?></td>
        <td><?php echo $rows->kemsa_order_no;?></td>
        <td><?php echo number_format($rows->order_total, 2, '.', ',');?></td>
        <td><?php
        $datea= $rows->order_date;
		$fechaa = new DateTime($datea);
        $datea= $fechaa->format(' d M Y');
		echo $datea;?></td>
		<td><?php
        $datea1= $rows->recieve_date;
		$fechaa1 = new DateTime($datea1);
        $datea1= $fechaa1->format(' d M Y');
		echo $datea1;?></td>
        <td><?php 
        	$dateb= $rows->dispatch_date;
		$fechab = new DateTime($dateb);
        $dateb= $fechab->format(' d M Y');
		echo $dateb;
        	?></td>
        	<td><?php $days1=$myClass->getWorkingDays($fechaa,$fechab,0);
        	echo $days1;?></td>
        <td><?php echo anchor('order_management/dispatch_order/'.$rows->id.'/'.$rows->kemsa_order_no,'Update',array('class' => 'link'))?></td>
    </tr>
    <?php			
endforeach;
endif;
    ?>
</table>