<?php
class Counties extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('county', 'varchar',30);
		$this -> hasColumn('kenya_map_id', 'int',11);	
	}

	public function setUp() {
		$this -> setTableName('counties');
		//$this -> hasOne('Drug_Category as Category', array('local' => 'Drug_Category', 'foreign' => 'id'));
		$this -> hasMany('districts as county_district', array('local' => 'id', 'foreign' => 'county'));
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("counties")-> OrderBy("county asc");
		$drugs = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $drugs;
	}
	public static function get_counties_all_using_HCMP()
	{
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT DISTINCT (d.county) as county, c.county as county_name
		from
		    facilities f,
		    districts d,
		    counties c
		where
		c.id = d.county
		AND f.district = d.id 
		AND using_hcmp = 1");
			
		return $q;
	}
	
	
	public static function get_county_map_data() {
		$query = Doctrine_Query::create() -> select("*") -> from("counties")-> OrderBy("kenya_map_id asc, county asc");
		$drugs = $query -> execute();
		return $drugs;
	}
	
	
	public static function get_county_name($county_id)
	{
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT county, id FROM counties WHERE counties.id='$county_id' ");
		return $q[0];
	}
	public static function get_district_expiry_summary($date,$county){
		$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT COUNT(DISTINCT stock.facility_code) as facility_count, stock.facility_code, stock.balance,stock.quantity,stock.status,stock.stock_date,stock.sheet_no, f.facility_name, d.id as district_id, d.district
			FROM Facility_Stock stock, facilities f, districts d, counties c
			WHERE stock.expiry_date<='$date'
			AND stock.status=1
			AND stock.facility_code=f.facility_code
			AND f.district=d.id
			AND d.county=c.id
			AND c.id='$county'
			GROUP BY d.district");	
		return $query;
	}


	public static function get_district_received($district){
		$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT o.id,o.orderDate,o.facilityCode, COUNT(o.facilityCode) as facility_count,o.deliverDate,o.remarks,o.orderStatus,o.dispatchDate,o.approvalDate,o.kemsaOrderid,o.orderTotal,o.status,o.orderby,o.order_no, f.facility_code, f.facility_name, d.id as district_id, d.district
			FROM ordertbl o, facilities f, districts d, counties c
			WHERE o.orderStatus='delivered'
			AND o.facilityCode=f.facility_code
			AND f.district=d.id
			AND d.id='$district' GROUP BY d.district");
		return $query;
	}


	public static function get_county_p_stockouts($date,$county,$date1){
		//echo $date.'<br>',$facility.'<br>',$date1.'<br>';
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT stock.facility_code,stock.kemsa_code,stock.batch_no,stock.manufacture,stock.expiry_date,stock.balance,stock.quantity,stock.status,stock.stock_date,stock.sheet_no, f.facility_code, f.facility_name, d.id as district_id, d.district
			FROM Facility_Stock stock, facilities f, districts d, counties c 
			WHERE stock.facilityCode=f.facility_code
			AND stock.expiry_date between '$date1' AND '$date'
			AND f.district=d.id
			AND d.county=c.id
			AND c.id='$county'");
		$stockouts = $query -> execute();
		return $stockouts;
	}
	public static function get_district_p_stockouts($date,$district,$date1){
		//echo $date.'<br>',$facility.'<br>',$date1.'<br>';
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT stock.facility_code,stock.kemsa_code,stock.batch_no,stock.manufacture,stock.expiry_date,stock.balance,stock.quantity, (stock.balance*stock.quantity) as total, stock.status,stock.stock_date,stock.sheet_no,f.facility_code, f.facility_name, d.id as district_id, d.district
			FROM Facility_Stock stock, facilities f, districts d, counties c 
			WHERE stock.facilityCode=f.facility_code
			AND stock.expiry_date between '$date1' AND '$date'
			AND f.district=d.id
			AND d.id='$district'");
		$stockouts = $query -> execute();
		return $stockouts;
	}


	public static function get_county_received($county_id,$district_id=NUll,$facility_code=null){
$and_data =(isset($district_id)&& ($district_id>0)) ?" AND d.id = '$district_id'" : 
		(isset($facility_code)&& ($facility_code>0)) ? " AND f.facility_code =$facility_code": " AND d.county =$county_id" ;
				
			
		
		$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select  temp.id, d.district, f.facility_name, f.facility_code,temp.orderDate,date_format( temp.orderDate, '%b %Y' ) as mwaka,
temp.orderTotal, temp.total_delivered, temp.fill_rate from  districts d,facilities f
left join
     (
SELECT o.id, orderDate, o.facilityCode, o.orderTotal, o.total_delivered, IFNULL( ROUND( (
SUM( o_d.quantityRecieved ) / ROUND( SUM( o_d.quantityOrdered ) * d.total_units ) ) *100 ) , 0
) AS fill_rate
FROM ordertbl o, orderdetails o_d, drug d
WHERE o.orderStatus like '%delivered%'
AND o_d.orderNumber = o.id
AND o_d.kemsa_code = d.id
GROUP BY d.id, o.id
) temp
on temp.facilityCode = f.facility_code
where  f.district = d.id
$and_data
group by f.facility_code having temp.id>0");		
		 
		   return $query;
   
	}
	public static function get_pending_county($county_id,$district_id=NUll,$facility_code=null){
$and_data =(isset($district_id)&& ($district_id>0)) ?" AND d.id = '$district_id'" : 
		(isset($facility_code)&& ($facility_code>0)) ? " AND f.facility_code =$facility_code": " AND d.county =$county_id" ;
		

				$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT o.id, d.district, f.facility_name, f.facility_code, o.orderDate, date_format( o.orderDate, '%b %Y' ) AS mwaka, o.orderTotal
FROM districts d, facilities f, ordertbl o
WHERE f.district = d.id
AND o.orderStatus LIKE '%pending%'
AND o.facilityCode = f.facility_code
$and_data");		
		 
		   return $query;
	}
		public static function get_rejected_county($county_id,$district_id=NUll,$facility_code=null){
$and_data =(isset($district_id)&& ($district_id>0)) ?"AND d.id = '$district_id'" : 
		(isset($facility_code)&& ($facility_code>0)) ? "AND f.facility_code =$facility_code": "AND d.county =$county_id" ;
		
	
				$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT o.id, d.district, f.facility_name, f.facility_code, o.orderDate, date_format( o.orderDate, '%b %Y' ) AS mwaka, o.orderTotal
FROM districts d, facilities f, ordertbl o
WHERE f.district = d.id
AND o.orderStatus LIKE '%rejected%'
AND o.facilityCode = f.facility_code
$and_data");		
		 
		   return $query;
	}
	
		public static function get_approved_county($county_id,$district_id=NUll,$facility_code=null){
$and_data =(isset($district_id)&& ($district_id>0)) ?"AND d.id = '$district_id'" : 
		(isset($facility_code)&& ($facility_code>0)) ? "AND f.facility_code =$facility_code": "AND d.county =$county_id" ;
		//'%approved%'

				$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT o.id, d.district, f.facility_name, f.facility_code, o.orderDate, date_format( o.orderDate, '%b %Y' ) AS mwaka, o.orderTotal
FROM districts d, facilities f, ordertbl o
WHERE f.district = d.id
AND o.orderStatus LIKE '%approved%'
AND o.facilityCode = f.facility_code
$and_data");		
		 
		   return $query;
	}
}
