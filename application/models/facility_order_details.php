<?php
/**
 * @author Kariuki
 */
class facility_order_details extends Doctrine_Record {	
	public function setTableDefinition()
	{
		        $this->hasColumn('id', 'int');
				$this->hasColumn('order_number_id', 'int');
				$this->hasColumn('commodity_id', 'int');
				$this->hasColumn('quantity_ordered_pack', 'int');
				$this->hasColumn('quantity_ordered_unit', 'int');
				$this->hasColumn('quantity_recieved_pack_pack', 'int');
                $this->hasColumn('quantity_recieved_pack_unit', 'int');
				$this->hasColumn('price', 'int');
				$this->hasColumn('o_balance', 'int');
				$this->hasColumn('t_receipts', 'int');
				$this->hasColumn('t_issues', 'int');
				$this->hasColumn('adjustpve', 'int');
				$this->hasColumn('adjustnve', 'int');
				$this->hasColumn('losses', 'int');
				$this->hasColumn('days', 'int');
				$this->hasColumn('comment', 'varchar',100);
				$this->hasColumn('s_quantity', 'int');
				$this->hasColumn('c_stock', 'int');
				$this->hasColumn('amc', 'int');
                $this->hasColumn('expiry_date', 'varchar',50);
                $this->hasColumn('batch_no', 'varchar',50);
                $this->hasColumn('maun', 'varchar',100);
				$this->hasColumn('status', 'int');	
	}

	public function setUp() {
		$this -> setTableName('facility_order_details');		
		$this -> hasMany('commodities as commodity_detail', array('local' => 'commodity_id', 'foreign' => 'id'));
		
	}
	////dumbing data into the issues table
	public static function update_facility_order_details_table($data_array){
		$o = new facility_order_details();
	    $o->fromArray($data_array);
		$o->save();
		return TRUE;
	}
	
	public static function get_order_details($order_id,$fill_rate=false){
		if($fill_rate){
		$group_by="fill_rate ASC,`a`.`id` ASC"; 
		$fill_rate_compute="ROUND( (`c`.`quantity_ordered_pack`/`c`.`quantity_recieved_pack`) *100 ) AS fill_rate,";
		}else{
		$group_by='a.id asc,b.commodity_name asc';
		$fill_rate_compute=null;
		}
$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("select
`a`.`sub_category_name` AS `sub_category_name`,
`b`.`commodity_name` AS `commodity_name`,
`b`.`commodity_code` AS `commodity_code`,
`b`.total_commodity_units,
`b`.`unit_size` AS `unit_size`,
$fill_rate_compute
`c`.`id`,
`c`.`price` AS `unit_cost`,
`c`.`commodity_id` AS `commodity_id`,
`c`.`quantity_ordered_pack`,
`c`.`quantity_ordered_unit`,
`c`.`quantity_recieved_pack` as quantity_recieved,
`c`.`quantity_recieved_unit`,
`c`.`expiry_date`,
`c`.`batch_no`,
`c`.`maun`,
`c`.`o_balance` AS `opening_balance`,
`c`.`t_receipts` AS `total_receipts`,
`c`.`t_issues` AS `total_issues`,
`c`.`comment` AS `comment`,
ceiling((`c`.`c_stock` / `b`.`total_commodity_units`)) AS `closing_stock_`,
`c`.`c_stock` AS `closing_stock`,
`c`.`days` AS `days_out_of_stock`,
`c`.`losses` AS `losses`,
`c`.`status` AS `status`,
`c`.`adjustpve` AS `adjustmentpve`,
`c`.`adjustnve` AS `adjustmentnve`,
`c`.`amc` AS `historical` 
from  `commodities` `b`,`commodity_sub_category` `a` ,`facility_order_details` `c`
where `b`.`id` = `c`.`commodity_id`
and `c`.`status` = '1' 
and `a`.`id` = `b`.`commodity_sub_category_id` 
and c.order_number_id=$order_id  order by $group_by ");
        return $inserttransaction ;
		
	 
	}
		public static function get_order_details_from_order($order_id,$commodity_id){	
$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("select ifnull(`c`.`quantity_ordered_pack`,0) as total,price
from `facility_order_details` `c`
where `c`.`commodity_id`=$commodity_id
and c.order_number_id=$order_id ");
        return $inserttransaction ;
	}

	
	
	
}
