<?php 
class drug_store_issues extends Doctrine_Record {
		
	public function setTableDefinition()
	{
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('facility_code', 'int'); 
		$this -> hasColumn('district_id', 'int'); 
		$this -> hasColumn('s11_No', 'int'); 
		$this -> hasColumn('commodity_id', 'int'); 
	    $this -> hasColumn('batch_no', 'varchar',20); 
		$this -> hasColumn('expiry_date', 'date'); 
		$this -> hasColumn('qty_issued', 'int');
		$this -> hasColumn('balance_as_of', 'int'); 
		$this -> hasColumn('adjustmentpve', 'int');
		$this -> hasColumn('adjustmentnve', 'int');
		$this -> hasColumn('date_issued', 'date'); 
		$this -> hasColumn('issued_to', 'varchar', 200);
		$this -> hasColumn('issued_by', 'int', 12);
		$this -> hasColumn('status', 'int');
			
	}

	 ////dumbing data into the issues table
	public static function update_drug_store_issues_table($data_array){
		$s = new facility_issues();
	    $s->fromArray($data_array);
		$s->save();
		return TRUE;
	}

	public static function get_store_commodity_total($district_id,$commodity_id=null){
		$commodity_id=isset($commodity_id)?"and commodity_id=$commodity_id" : null;
		$total_store_comm = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT
		c.id,ifnull(sum(dst.total_balance),0) as commodity_balance
		from commodities c,drug_store_totals dst
		where dst.district_id= '$district_id' and dst.commodity_id = c.id $commodity_id and status = 1 group by dst.commodity_id
		");
		return $total_store_comm;
}
}

 ?>