<?php
class Drug_Category extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('Category_Name', 'text');
	}

	public function setUp() {
		$this -> setTableName('drug_category');
		$this -> hasOne('Drug as Category', array('local' => 'id', 'foreign' => 'Drug_Category'));
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("Drug_Category")->OrderBy("Category_Name asc");
		$categories = $query -> execute();
		return $categories;
	}

}
