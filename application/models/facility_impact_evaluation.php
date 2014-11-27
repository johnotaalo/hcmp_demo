<?php
class Facility_Impact_Evaluation extends Doctrine_Record 
{
	public function setTableDefinition() 
	{
		$this -> hasColumn('id', 'int',11);
		$this -> hasColumn('facility_code','int', 11);
		$this -> hasColumn('user_id','varchar', 30);
		$this -> hasColumn('no_of_personnel','varchar', 30);
		$this -> hasColumn('no_still_using_tool','varchar', 30);
		$this -> hasColumn('cadres_of_users','varchar', 255)	;
		$this -> hasColumn('no_of_times_a_week','int', 10);
		$this -> hasColumn('does_physical_count_tally','int', 2);
		$this -> hasColumn('amount_of_commodities_stocked','varchar', 30);
		$this -> hasColumn('duration_of_stockout','varchar', 30);
		$this -> hasColumn('amount_of_expired_commodities','varchar', 30);
		$this -> hasColumn('amount_of_overstocked_commodities','varchar', 30);
		$this -> hasColumn('adequate_storage','int', 2);
		$this -> hasColumn('date_of_last_order','date');
		$this -> hasColumn('quarter_served','varchar', 30);
		$this -> hasColumn('discrepancies','int', 2);
		$this -> hasColumn('reasons_for_discrepancies','varchar', 255);
		$this -> hasColumn('date_of_delivery','date');
		$this -> hasColumn('general_challenges','varchar', 255);
		$this -> hasColumn('report_time','date');
	}

	public function setUp() 
	{
		$this -> setTableName('facility_impact_evaluation');		
	}
	public static function get_all($facility_code, $user_id)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("facility_impact_evaluation")-> where("facility_code=$facility_code and user_id=$user_id");
		$level = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		
		return $level[0];
	}
}	