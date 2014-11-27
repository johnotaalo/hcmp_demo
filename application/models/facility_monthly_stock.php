<?php
class  facility_monthly_stock extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('commodity_id', 'int');
		$this -> hasColumn('facility_code', 'int');
		$this -> hasColumn('consumption_level', 'int');
		$this -> hasColumn('selected_option', 'varchar', 100);
		$this -> hasColumn('total_units', 'int');
		$this -> hasColumn('status', 'int');
	}

	public function setUp() {
		$this -> setTableName('facility_monthly_stock');
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("facility_monthly_stock");
		$facility_monthly_stock = $query -> execute();
		return facility_monthly_stock;
	}

	
}
?>
