<?php
class Districts extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('district', 'varchar',30);
		$this -> hasColumn('county', 'varchar',30);	
	}

	public function setUp() {
		$this -> setTableName('districts');
		$this -> hasOne('counties as district_county', array('local' => 'county', 'foreign' => 'id'));
		
	}

	public static function getAll() {

		$query = Doctrine_Query::create() -> select("*") -> from("districts")->orderby("district asc");
		$drugs = $query -> execute();
		
		return $drugs;
	}
	
	public static function getDistrict($county = null,$district_id=null)
	{
		$addition = (isset($district_id) && ($district_id>0))? "id=$district_id" : "county='$county'";
		$query = Doctrine_Query::create() -> select("*") -> from("districts")->where("$addition ")->orderby("district asc");
		$drugs = $query -> execute();
		return $drugs;

	}
	public static function get_county_id($district)
	{
		$query = Doctrine_Query::create() -> select("county") -> from("districts")->where("id='$district'");
		$drugs = $query -> execute();
		
		
		return $drugs;
	}
	
	public static function get_district_name($district)
	{
	$query = Doctrine_Query::create() -> select("district") -> from("districts")->where("id='$district'");
		$drugs = $query -> execute();
		return $drugs;	
	}
	
	public static function get_district_name_2($district)
	{
	$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
	Select district from districts where id= '$district'");
	return $query;	
	}
	
	//select district from districts where id= 2
	public static function get_district_name_($district){
	$query = Doctrine_Query::create() -> select("*") -> from("districts")->where("id='$district'");
	$drugs = $query -> execute();
	$drugs = $drugs->toArray();
	return $drugs[0];
	}
	


	public static function get_district_expiries($date,$district){
		$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT COUNT(DISTINCT stock.facility_code) as facility_count, COUNT(DISTINCT stock.batch_no) as batches, stock.facility_code,stock.kemsa_code,stock.batch_no,stock.manufacture,stock.expiry_date,stock.balance,stock.quantity,stock.status,stock.stock_date,stock.sheet_no, f.facility_name, d.district, d.id as district_id,
			FROM Facility_Stock stock, facilities f, districts d, counties c
			WHERE stock.expiry_date<='$date'
			AND stock.facility_code=f.facility_code
			AND f.district=d.id
			AND d.id='$district'
			GROUP BY d.district");	
		return $query;
	}
	public static function get_district_expiry_summary($date,$county){
		$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT COUNT(DISTINCT stock.facility_code) as facility_count, COUNT(DISTINCT stock.batch_no) as batches, stock.facility_code, stock.balance,stock.quantity,stock.status,stock.stock_date,stock.sheet_no, f.facility_name, d.id as district_id, d.district
			FROM Facility_Stock stock, facilities f, districts d, counties c
			WHERE stock.expiry_date<='$date'
			AND stock.status=1
			AND stock.facility_code=f.facility_code
			AND f.district=d.id
			AND d.county=c.id
			AND c.id='$county'");	
		return $query;
	}
	public static function get_county_received($county){
		$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT o.id,o.orderDate,o.facilityCode, COUNT(o.facilityCode) as facility_count,o.deliverDate,o.remarks,o.orderStatus,o.dispatchDate,o.approvalDate,o.kemsaOrderid,o.orderTotal,o.status,o.orderby,o.order_no, f.facility_code, f.facility_name, d.id as district_id, d.district
			FROM ordertbl o, facilities f, districts d, counties c
			WHERE o.orderStatus='delivered'
			AND o.facilityCode=f.facility_code
			AND f.district=d.id
			AND d.county=c.id
			AND c.id='$county' GROUP BY d.district");
		return $query;
	}
	public static function get_potential_expiry_summary($county){
		$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT COUNT(stock.facility_code) as facility_count, stock.facility_code, stock.balance,stock.quantity,stock.status,stock.stock_date,stock.sheet_no, f.facility_name, d.id as district_id, d.district
			FROM Facility_Stock stock, facilities f, districts d, counties c
			WHERE stock.expiry_date BETWEEN CURDATE()AND DATE_ADD(CURDATE(), INTERVAL 12 MONTH)
			AND stock.status=1
			AND stock.facility_code=f.facility_code
			AND f.district=d.id
			AND d.county=c.id
			AND c.id='$county'
			GROUP BY d.district");	
		return $query;
	}
	
	public static function get_district_coverage($district_id){
	$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT d.district, (select count(id) from facilities f where district=$district_id) as total, (select count(id) from 
facilities f where district=$district_id and using_hcmp=1) as total_2 from districts d where d.id=$district_id");	
		return $query;
	}	
	
	public static function get_districts($county_id){
	
		$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT d.id,d.district FROM districts d ,counties c where d.county=c.id AND d.county='$county_id'");	
		return $query;
	}
	
}
