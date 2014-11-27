<?php

class facility_stocks_temp extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('commodity_id', 'int');
		$this -> hasColumn('unit_size', 'varchar', 50);
		$this -> hasColumn('batch_no', 'varchar', 50);
		$this -> hasColumn('manu', 'varchar', 100);
		$this -> hasColumn('expiry_date', 'varchar', 50);
		$this -> hasColumn('stock_level', 'varchar', 50);
		$this -> hasColumn('total_units', 'int');
		$this -> hasColumn('source_of_item', 'int');
		$this -> hasColumn('total_unit_count', 'int');
		$this -> hasColumn('facility_code', 'varchar', 50);
		$this -> hasColumn('unit_issue', 'varchar', 50);
		$this -> hasColumn('supplier', 'varchar', 50);
	}

	public function setUp() {
		$this -> setTableName('facility_stocks_temp');
	}

	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("facility_stocks_temp");
		$facility_stocks = $query -> execute();
		return $facility_stocks;
	}

	public static function update_temp($data_array) {
		$o = new facility_stocks_temp();
		$o -> fromArray($data_array);
		$o -> save();
		return TRUE;
	}

	public static function get_current_stock_level($district_id) {
		$query_1 = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
		SELECT MONTHNAME (f_s.date_modified) as month, c.commodity_name as commodity, f_s.current_balance as stock
		FROM commodities c, facility_stocks f_s
		where c.status =1 and tracer_item =1
		and c.id = f_s.commodity_id
		");
		return $query_1;
	}

	public static function get_tracer_item_names() {
		$query_1 = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
		SELECT commodity_name from commodities where status = 1 and tracer_item = 1
		");
		//$result = $query_1 -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $query_1;
	}

	public static function get_months_of_stock($district_id = NULL, $county_id = NULL, $facility_code = NULL,$commodity_id=null, $option = null,$tracer = null) 
	{ 
		$month = date('F Y');
		$district_id=($district_id=="NULL") ? null :$district_id;
    	$graph_type=($graph_type=="NULL") ? null :$graph_type;
    	$facility_code=($facility_code=="NULL") ? null :$facility_code;
    	$county_id=($county_id=="NULL") ? null :$county_id;
    	$commodity_id=($commodity_id=="ALL" || $commodity_id=="NULL") ? null :$commodity_id;
		$option=($option=="NULL") ? null :$option;
		$tracer=($tracer=="NULL") ? null :$tracer;
   		$and_data =($district_id>0) ?" AND d1.id = '$district_id'" : null;
    	$and_data .=($facility_code>0) ?" AND f.facility_code = '$facility_code'" : null;
   		$and_data .=(isset($county_id)&& $county_id>0) ?" AND c.id=$county_id" : null;
		$and_data .=($commodity_id>0) ?" AND cm.id =$commodity_id " : null;
		$new=str_replace(" AND", ",", $and_data);
		$and_data .=($division_id>0) ? " AND cm.commodity_division =$division_id " :null;
		$and_data .=(isset($tracer)&&$tracer>0)? " AND cm.tracer_item =1" : null;
		
    	$and_data =isset( $and_data) ?  $and_data:null;
    	$group_by=(isset($option))? " group by cm.id $new" : " group by cm.id ";
		

    $query_1 = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
		 select 
    cm.commodity_name,
    ifnull(round(avg(IFNULL(f_s.current_balance, 0) / IFNULL(f_m_s.total_units, 0)),
            1),0) as total, d1.district, f.facility_name
			from
   				facilities f,
    			districts d1,
    			counties c,
    			facility_stocks f_s,
    			commodities cm
        	left join
    			facility_monthly_stock f_m_s ON f_m_s.`commodity_id` = cm.id
			where
    			f_s.facility_code = f.facility_code
        		and f.district = d1.id
        		and d1.county = c.id
        		and f_s.commodity_id = cm.id
        		and f_m_s.facility_code = f.facility_code
        		$and_data
				$group_by

		 ");
		

		return $query_1;
	}
	public static function get_division_commodities_stock($district_id = NULL, $county_id = NULL, $facility_code = NULL, $division_id = NULL) 
	{ 
		$month = date('F Y');
		$district_id=($district_id=="NULL") ? null :$district_id;
		$division_id=($division_id=="NULL") ? null :$division_id;
    	$graph_type=($graph_type=="NULL") ? null :$graph_type;
    	$facility_code=($facility_code=="NULL") ? null :$facility_code;
    	$county_id=($county_id=="NULL") ? null :$county_id;
    	$commodity_id=($commodity_id=="ALL" || $commodity_id=="NULL") ? null :$commodity_id;

   		$and_data =($district_id>0) ?" AND d1.id = '$district_id'" : null;
    	$and_data .=($facility_code>0) ?" AND f.facility_code = '$facility_code'" : null;
   		$and_data .=($county_id>0) ?" AND c.id='$county_id'" : null;
		$and_data .=($division_id>0) ? " AND cm.commodity_division =$division_id " :" AND cm.commodity_division >=1 ";
    	$and_data = isset($and_data) ?  $and_data:null;
    	
    	$query_1 = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
		 select 
	    cm.commodity_name,
	    round(avg(IFNULL(f_s.current_balance, 0) / IFNULL(f_m_s.total_units, 0)),
	            1) as total, d1.district, f.facility_name
				from
	   				facilities f,
	    			districts d1,
	    			counties c,
	    			facility_stocks f_s,
	    			commodities cm
	        	left join
	    			facility_monthly_stock f_m_s ON f_m_s.`commodity_id` = cm.id
				where
	    			f_s.facility_code = f.facility_code
	        		and f.district = d1.id
	        		and d1.county = c.id
	        		and f_s.commodity_id = cm.id
	        		and f_m_s.facility_code = f.facility_code
	        		$and_data
					group by cm.id

		 ");
		
		 
		return $query_1;
	}


	public static function get_all_facility($facility_code) {
		$query = Doctrine_Query::create() -> select("*") -> from("facility_stocks_temp") -> where("facility_code=$facility_code");
		$facility_stocks = $query -> execute();
		return $facility_stocks;
	}

	public static function check_if_facility_has_drug_in_temp($commodity_id, $facility_code, $batch_no) {
		$query = Doctrine_Query::create() -> select("*") -> from("facility_stocks_temp") -> where("facility_code=$facility_code and commodity_id=$commodity_id and `batch_no`='$batch_no'");
		$stocks = $query -> execute();
		return count($stocks);

	}

	public static function update_facility_temp_data($expiry_date, $batch_no, $manuf, $stock_level, $total_unit_count, $commodity_id, $facility_code, $unit_issue, $total_units, $source_of_item, $supplier) {
		$q = Doctrine_Manager::getInstance() -> getCurrentConnection() -> execute("
update facility_stocks_temp set `expiry_date`='$expiry_date',`manu`='$manuf',`stock_level`='$stock_level',`total_units`='$total_unit_count'
,`unit_issue`='$unit_issue' and `total_units`=$total_units and `source_of_item`= $source_of_itemand supplier='$supplier'
where `facility_code`='$facility_code' and `commodity_id`='$commodity_id' and `batch_no`='$batch_no'
");
	}

	public static function get_temp_stock($facility_code) {
		$query = Doctrine_Query::create() -> select("*") -> from("facility_stocks_temp") -> where("facility_code=$facility_code");
		$stocks = $query -> execute();
		return $stocks -> toArray();
	}

	public static function delete_facility_temp($commodity_id = null, $commodity_batch_no = null, $facility_code) {
		$condition = isset($commodity_id) ? "AND commodity_id=$commodity_id and `batch_no`='$commodity_batch_no'" : null;
		$query = Doctrine_Query::create() -> delete() -> from("facility_stocks_temp") -> where("facility_code=$facility_code $condition");
		$stocks = $query -> execute();
		return $stocks;

	}

}
?>
