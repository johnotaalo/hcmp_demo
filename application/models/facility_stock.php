<?php
class Facility_Stock extends Doctrine_Record {
		
	public function setTableDefinition()
	{
		$this -> hasColumn('facility_code', 'int'); 
		$this -> hasColumn('kemsa_code', 'varchar',20); 
	    $this -> hasColumn('batch_no', 'varchar',20); 
		$this -> hasColumn('manufacture', 'varchar',20); 
		$this -> hasColumn('expiry_date', 'date'); 
		$this -> hasColumn('balance', 'int'); 
		$this -> hasColumn('quantity', 'int'); 
		$this -> hasColumn('status', 'tinyint');
		$this -> hasColumn('stock_date', 'date');
		$this -> hasColumn('sheet_no', 'int',15);
		//$this -> hasColumn('warehouse', 'varchar',255);
		
	}

	public function setUp() {
		$this -> setTableName('Facility_Stock');		
		$this -> hasMany('drug as stock_Drugs', array('local' => 'kemsa_code', 'foreign' => 'Kemsa_Code'));
		$this -> hasMany('facilities as Coder', array('local' => 'facility_code', 'foreign' => 'facility_code'));
		$this -> hasMany('Drug as Code', array('local' => 'kemsa_code', 'foreign' => 'id'));
	}
	public static function getAllStock($facility)
		  {
$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("SELECT DISTINCT d.id,d.drug_name,d.unit_size,c.source_name from facility_stock fs, drug d, commodity_source c
 where fs.facility_code ='$facility' and fs.expiry_date >= NOW() and d.id=fs.kemsa_code and fs.status='1' and fs.balance>0 group by d.id order by d.drug_name asc
");

        return $inserttransaction ;
			 
		  }
	
	 public static function getAll($desc,$facility_c)
		  {
		  	
	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("
SELECT id , f.kemsa_code, f.batch_no ,
 f.expiry_date , f.balance , f.status , (
SELECT SUM( f.balance ) 
FROM Facility_Stock f
WHERE f.kemsa_code =  '$desc'
AND f.expiry_date >= NOW( ) 
AND f.facility_code =  '$facility_c'
AND f.status =  '1'
) AS total_balance
FROM Facility_Stock f
WHERE (
f.kemsa_code =  '$desc'
AND f.expiry_date >= NOW( ) 
AND f.facility_code =  '$facility_c'
AND f.status =  '1'
AND f.balance >0
)

ORDER BY f.expiry_date ASC ");

        return $inserttransaction ;
       
				
		  }
	public static function update_facility_stock($data_array){
		$o = new Facility_Stock ();
	    $o->fromArray($data_array);
		$o->save();		
		return TRUE;
	}
	public static function get_max_date($facility_c){
		
		$query = Doctrine_Query::create() -> select("MAX(stock_date)") -> from(" facility_stock") -> where("facility_code=$facility_c");
		$getDate = $query ->execute();
		return $getDate;
	}
	public static function count_facility_stock($facility_code,$date){
		$query = Doctrine_Query::create() -> select("kemsa_code,SUM(balance) AS quantity1") -> from(" facility_stock") -> where("facility_code=$facility_code AND
		status='1' and stock_date='$date'")->groupby( "kemsa_code");
		$stocktake = $query ->execute();
		
		return $stocktake;
	}
//get if the facility has stock
public static function count_facility_stock_first($facility_code){
		$query = Doctrine_Query::create() -> select("kemsa_code,SUM(balance) AS quantity1") -> from(" facility_stock") -> where("facility_code=$facility_code AND STATUS ='1'")->groupby( "kemsa_code");
		$stocktake = $query ->execute();
		
		return $stocktake;
	}
	public static function count_all_facility_stock(){
		$query = Doctrine_Query::create() -> select("kemsa_code,SUM( quantity ) AS quantity1") -> from(" facility_stock") -> where("status='1'")
		->groupby( "kemsa_code");
		$stocktake = $query ->execute();	
		return $stocktake;
	}
	public static function count_all_county_stock($county){
/*SELECT fs.kemsa_code, SUM( fs.quantity ) as quantity1
FROM districts d, counties c, facilities f, facility_stock fs
WHERE c.id = d.county
AND d.id = f.district
AND c.id =1
AND fs.facility_code = f.facility_code
AND fs.STATUS =1
GROUP BY fs.kemsa_code*/
		$query = Doctrine_Query::create() -> select("facility_stock.kemsa_code, SUM( facility_stock.quantity ) as quantity1") 
		-> from("facility_stock , districts, counties, facilities ") 
		-> where("counties.id = districts.county")
		->andWhere("districts.id = facilities.district")
        ->andWhere("counties.id =$county")
        ->andWhere("facility_stock.facility_code = facilities.facility_code")
        ->andWhere("facility_stock.STATUS ='1'")
		->groupby( "facility_stock.kemsa_code");
		$stocktake = $query ->execute();	
		return $stocktake;
	}
		public static function getStockouts($date,$facility,$date1){
		//echo $date.'<br>',$facility.'<br>',$date1.'<br>';
		$query = Doctrine_Query::create() -> select("*") -> from("Facility_Stock")->where("facility_code='$facility' and expiry_date between '$date1' and '$date'");
		$stockouts = $query -> execute();
		return $stockouts;
	}
	public static function expiries($facility_c){
		$query = Doctrine_Query::create() -> select("*") -> from("Facility_Stock") -> where("facility_code='$facility_c' and balance >0 and expiry_date BETWEEN CURDATE()AND DATE_ADD(CURDATE(), INTERVAL 6 MONTH)")->
		andwhere("status=1");
		
		$stocks= $query -> execute();
		return $stocks;
	}
	public static function expiries_count($facility_c){
		$query = Doctrine_Query::create() -> select("sum(balance) as balance") -> from("Facility_Stock") -> where("facility_code='$facility_c' and expiry_date BETWEEN CURDATE()AND DATE_ADD(CURDATE(), INTERVAL 6 MONTH)");	
		$stocks= $query -> execute();
		return $stocks[0];
	}
public static function getexp($facility,$status=NULL){
		
		$query=($status!='decommission')? Doctrine_query::create()->select("f_s.kemsa_code,round( (
SUM( f_s.balance ) / d.total_units ) * d.unit_cost,1
) AS total")->from("Facility_Stock f_s, drug d")->where ("facility_code='$facility' and `expiry_date` <= NOW( ) and f_s.kemsa_code=d.id and STATUS =( 1
OR 2 ) and balance >0")->groupby("f_s.batch_no") : 
Doctrine_query::create()->select("f_s.kemsa_code,round( (
SUM( f_s.balance ) / d.total_units ) * d.unit_cost,1) AS total")
->from("Facility_Stock f_s, drug d")
->where ("facility_code='$facility' and `expiry_date` <= NOW( ) and f_s.kemsa_code=d.id and STATUS =1 and balance >0")
->groupby("f_s.batch_no");

		
		$expire=$query->execute();
		
		return $expire;
	}
	public static function get_facility_expired_stuff($date,$facility){
	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT d.id as drug_id,d.kemsa_code,d.unit_size,d.drug_name,d.unit_cost,f_s.batch_no,f_s.manufacture,sum(f_s.balance) as balance ,f_s.expiry_date ,d.total_units from facility_stock f_s, drug d 
where f_s.kemsa_code=d.id and 
f_s.facility_code='$facility' and f_s.expiry_date<='$date' 
and f_s.STATUS ='1' GROUP BY d.id");

        return $inserttransaction ;	
	}
	
	public static function get_facility_drug_total($facility_code,$drug_code){
	$query = Doctrine_Query::create() -> select("sum(balance) as balance") -> from("Facility_Stock") -> where("facility_code='$facility_code' and kemsa_code=$drug_code")->andwhere("STATUS ='1'");	
		$stocks= $query -> execute();
		return $stocks;	
	}
	
	public static function get_exp_count($facility){
		$query=Doctrine_query::create()->select("batch_no")->from("Facility_Stock")
		->where ("facility_code='$facility' and expiry_date<=NOW() and balance >0")
		->andWhere("status='1'")->groupBy("batch_no");
		$expire=$query->execute();
		
		return count($expire);
	}
	
		public static function get_potential_count($facility){
		$query=Doctrine_query::create()->select("batch_no")->from("Facility_Stock")
		->where ("facility_code='$facility' and expiry_date BETWEEN CURDATE()AND DATE_ADD(CURDATE(), INTERVAL 6 MONTH) and balance >0")
		->andWhere("status='1'")->groupBy("batch_no");
		$expire=$query->execute();
		
		return count($expire);
	}
	public static function getAll1($facility)
		  {
	 
		$query = Doctrine_Query::create() -> select("facility_code,kemsa_code,SUM(quantity)") -> from(" facility_stock")->where("facility_code=$facility")->groupby( "kemsa_code");
		$stocktake = $query ->execute();
		
		return $stocktake;
				
		  }
		  //facility commodities
		  public static function get_commodities($facility){
		  	$query = Doctrine_Query::create() -> select("facility_code,kemsa_code,balance,SUM(balance)") -> from(" facility_stock")->where("facility_code='$facility'")->groupby( "kemsa_code");
			$stocktake = $query ->execute();
		
		return $stocktake;
		  }
		  public static function Allexpiries(){
		$query = Doctrine_Query::create() -> select("*") -> from("Facility_Stock") -> where("expiry_date BETWEEN CURDATE()AND DATE_ADD(CURDATE(), INTERVAL 6 MONTH)");
		
		$stocks= $query -> execute();
		return $stocks;
	}
	
	public static function poo($drug_id){
               $query = Doctrine_Query::create() -> select("SUM(`balance`) as total,expiry_date") -> from("Facility_Stock") -> where("kemsa_code='$drug_id'") -> andwhere("expiry_date BETWEEN CURDATE()AND DATE_ADD(CURDATE(), INTERVAL 12 MONTH)")
               ->groupby("MONTH(expiry_date) ASC");
               
               $bubu= $query -> execute();
               return $bubu->toArray();
       }

      public static function disable_facility_stock($facility){
      	$q = Doctrine_Manager::getInstance()->getCurrentConnection();
		$q->execute("UPDATE facility_stock SET balance='0',status='0' where facility_code=$facility");
      	
      }
////////////// getting district stock level
     public static function get_district_stock_level($distict){
     
$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT d.drug_name, ceil(SUM( fs.balance / d.total_units )) AS total
FROM facility_stock fs, drug d, facilities f
WHERE fs.facility_code = f.facility_code
AND f.district =  '$distict'
AND d.id = fs.kemsa_code
AND fs.STATUS ='1'
GROUP BY fs.kemsa_code
ORDER BY d.drug_name ASC  ");

        return $inserttransaction ;
        }      
        ////////////// getting facility stock level
     public static function get_facility_stock_level($distict){
     
$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT d.drug_name, CEIL( SUM( fs.balance / d.total_units ) ) AS total, ifnull(temp.consumption_level,0) as consumption_level
FROM  drug d, facility_stock fs
left join historical_stock temp on temp.drug_id=fs.kemsa_code and temp.facility_code='$distict'
WHERE fs.facility_code =  '$distict'
AND d.id = fs.kemsa_code
and fs.balance>0
AND fs.STATUS =  '1'
GROUP BY fs.kemsa_code
ORDER BY d.drug_name ASC");

        return $inserttransaction ;} 
      ////////////// getting district stock level
     public static function get_district_drug_stock_level($distict,$drug_id){
     
$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT f.facility_name AS drug_name, CEIL( SUM( fs.balance / d.total_units ) ) AS total
FROM facility_stock fs, drug d, facilities f
WHERE fs.facility_code = f.facility_code
AND f.district =  '$distict'
AND fs.kemsa_code ='$drug_id'
AND d.id = fs.kemsa_code
GROUP BY fs.kemsa_code
ORDER BY d.drug_name ASC ");

        return $inserttransaction ;}  
	 
	       ////////////// getting county stock level
public static function get_county_drug_stock_level_new($county_id,$category_id=NULL,$commodity_id=NULL,$district_id=null,$option=null,$facility_code=null){
     	
     $and_data=(isset($category_id)&& ($category_id>0)) ?"AND d.drug_category = '$category_id'" : null;
     $and_data .=(isset($commodity_id)&& ($commodity_id>0)) ?"AND d.id = '$commodity_id'" : null;
	 $and_data .=(isset($district_id)&& ($district_id>0)) ?"AND di.id = '$district_id'" : null;
	 $and_data .=(isset($facility_code)&& ($facility_code>0)) ?"AND f.facility_code = '$facility_code'" : null;
     
     switch ($option) :
         case 'ksh':
           $computation ="ifnull(CEIL( (SUM( fs.balance / d.total_units ))*d.unit_cost ),0) AS total";
             break;
         case 'units':
           $computation ="ifnull(CEIL( SUM( fs.balance ) ),0) AS total" ;
             break;
             case 'packs':
           $computation ="ifnull(CEIL( SUM( fs.balance/ d.total_units ) ),0) AS total" ;
             break;
         default:
               $computation ="ifnull(CEIL(SUM(fs.balance/d.total_units)),0) AS total" ;
             break;
     endswitch;
	 
	 //echo ; exit;
     	
	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("SELECT $computation
FROM facility_stock fs, drug d, facilities f, districts di
WHERE fs.facility_code = f.facility_code
AND f.district = di.id
AND fs.STATUS ='1'
AND di.county =  '$county_id'
   $and_data
AND d.id = fs.kemsa_code
");		

return $inserttransaction ;
}  
     public static function get_county_drug_stock_level($county_id,$category_id=NULL,$commodity_id=NULL,$district_id=null,$option=null,$facility_code=null){
     	
     $and_data=(isset($category_id)&& ($category_id>0)) ?"AND d.drug_category = '$category_id'" : null;
     $and_data .=(isset($commodity_id)&& ($commodity_id>0)) ?"AND d.id = '$commodity_id'" : null;
	 $and_data .=(isset($district_id)&& ($district_id>0)) ?"AND di.id = '$district_id'" : null;
	 $and_data .=(isset($facility_code)&& ($facility_code>0)) ?"AND f.facility_code = '$facility_code'" : null;
     
     switch ($option) :
         case 'ksh':
           $computation ="CEIL( (SUM( fs.balance / d.total_units ))*d.unit_cost ) AS total";
             break;
         case 'units':
           $computation ="CEIL( SUM( fs.balance ) ) AS total" ;
             break;
             case 'packs':
           $computation ="CEIL( SUM( fs.balance/ d.total_units ) ) AS total" ;
             break;
         default:
               $computation ="CEIL(SUM(fs.balance/d.total_units)) AS total" ;
             break;
     endswitch;
	 
     	
	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("SELECT d.drug_name, $computation
FROM facility_stock fs, drug d, facilities f, districts di
WHERE fs.facility_code = f.facility_code
AND f.district = di.id
AND fs.STATUS ='1'
AND di.county =  '$county_id'
   $and_data
AND d.id = fs.kemsa_code
GROUP BY fs.kemsa_code
ORDER BY d.drug_name ASC  ");		

return $inserttransaction ;
}  

 public static function get_county_drug_consumption_level($county_id,$category_id=null,$year=NULL,$month=NULL,$commodity_id=NULL,$district_id=null,$option=null){
     $year=isset($year)? $year : date("Y");
     $month=isset($month)?$month: date("m");		
     
     $and_data=(isset($category_id)&& ($category_id>0)) ?"AND d.drug_category = '$category_id'" : null;
     $and_data .=(isset($commodity_id)&& ($commodity_id>0)) ?"AND d.id = '$commodity_id'" : null;
	 $and_data .=(isset($district_id)&& ($district_id>0)) ?"AND di.id = '$district_id'" : null;
     
     switch ($option) :
         case 'ksh':
           $computation ="CEIL( (SUM( fs.qty_issued / d.total_units ))*d.unit_cost ) AS total";
             break;
         case 'units':
           $computation ="CEIL( SUM( fs.qty_issued ) ) AS total" ;
             break;
             case 'packs':
           $computation ="CEIL( SUM( fs.qty_issued / d.total_units ) ) AS total" ;
             break;
         default:
               $computation ="CEIL( SUM( fs.qty_issued / d.total_units ) ) AS total" ;
             break;
     endswitch;

	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT d.drug_name, $computation
FROM facility_issues fs, drug d, facilities f, districts di, counties c
WHERE fs.facility_code = f.facility_code
AND f.district = di.id
AND fs.availability ='1'
AND di.county = c.id
AND year(fs.date_issued)=$year
AND month(fs.date_issued)=$month
AND c.id =  '$county_id'
AND d.id = fs.kemsa_code
$and_data
GROUP BY fs.kemsa_code having total >=1
ORDER BY d.drug_name ASC ");		


 return $inserttransaction ;
 }    
 
 public static function get_county_drug_consumption_level2($facilities_filter,$county_id,$district_filter,$commodity_filter,$year_filter,$plot_value_filter){
     
		switch ($plot_value_filter) :
         case 'ksh':
           $computation ="CEIL( (SUM( fs.qty_issued / d.total_units ))*d.unit_cost ) AS total";
             break;
         case 'units':
           $computation ="CEIL( SUM( fs.qty_issued ) ) AS total" ;
             break;
             case 'packs':
           $computation ="CEIL( SUM( fs.qty_issued / d.total_units ) ) AS total" ;
             break;
         default:
               $computation ="CEIL( SUM( fs.qty_issued / d.total_units ) ) AS total" ;
             break;
     endswitch;
     
		if ($district_filter == 0 ||$facilities_filter == 0 || $commodity_filter > 0 ) {
	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT MONTH( fs.date_issued ) as monthno, $computation 
FROM facility_issues fs, drug d, facilities f, districts di, counties c
WHERE fs.facility_code = f.facility_code
AND f.district = di.id
AND fs.availability =  '1'
AND c.id = $county_id
AND fs.kemsa_code = $commodity_filter
AND YEAR( fs.date_issued ) =$year_filter
AND d.id = fs.kemsa_code
GROUP BY MONTH( fs.date_issued ) ");		


 return $inserttransaction ;
	
		}elseif ($district_filter > 0 ||$facilities_filter > 0) {
	
	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT MONTH( fs.date_issued )as monthno , $computation
FROM facility_issues fs, drug d, facilities f, districts di, counties c
WHERE fs.facility_code = f.facility_code
AND f.district = di.id
AND fs.availability =  '1'
AND c.id = $county_id
AND di.id= $district_filter
AND fs.kemsa_code = $commodity_filter
AND fs.facility_code = $facilities_filter
AND YEAR( fs.date_issued ) =$year_filter
AND d.id = fs.kemsa_code
GROUP BY MONTH( fs.date_issued )  ");		


 return $inserttransaction ;
		 }


 }    
        
        /////getting cost of exipries 
            public static function get_district_cost_of_exipries($distict){
     
$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT date_format( fs.expiry_date, '%b' ) as cal_month , ceil(sum( (fs.balance/ d.total_units) * d.unit_cost )) AS total
FROM facility_stock fs, facilities f, drug d
WHERE fs.facility_code = f.facility_code
AND `expiry_date` <= NOW( )
AND DATE_FORMAT( fs.expiry_date,  '%Y' ) = YEAR( NOW( ) ) 
AND f.district =$distict
AND d.id = fs.kemsa_code
GROUP BY month( expiry_date ) asc");
        return $inserttransaction ;
			} 
			
			public static function get_county_stock_out_trend($county_id,$year=NULL){
     $year=isset($year)? $year: date("Y");
$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT count(distinct f_t.facility_id) as total,date_format( `start_date`, '%b' ) as month, 
		month(`start_date`) as checker from facility_stock_out_tracker f_t, facilities f, districts d
where f.facility_code=f_t.`facility_id` and f.district=d.id and d.county=1 and year(`start_date`)=$year
 GROUP BY month( `start_date`) asc");

       return $inserttransaction ;
			}
      /////getting cost of exipries county
public static function get_county_cost_of_exipries_new($county_id,$year=null,
                  $month=null,$district_id=null,
                 $option=null,
                  $facility_code=null){
                  			
 if($month=="null"){
 	
$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("select temp.cal_month, sum(temp.total) as total from (
SELECT date_format( fs.expiry_date, '%b' ) as cal_month, 
ifnull(CEIL( (SUM(fs.balance/ d.total_units ))*d.unit_cost ),0) AS total 
FROM facility_stock fs, facilities f, drug d, counties c, districts di 
WHERE fs.facility_code = f.facility_code 
AND `expiry_date` <= NOW( ) 
AND DATE_FORMAT( fs.expiry_date,'%Y') =$year 
AND f.district =di.id AND di.county=c.id 
AND c.id='$county_id' 
AND d.id = fs.kemsa_code 
GROUP BY month(expiry_date),di.id) 
temp group by temp.cal_month 
");
 	
 }
 else{
 	  
	 $and_data =(isset($district_id)&& ($district_id>0)) ?"AND di.id = '$district_id'" : null;
	 $and_data .=(isset($facility_code)&& ($facility_code>0)) ?"AND f.facility_code = '$facility_code'" : null;
     
     switch ($option) :
         case 'ksh':
           $computation ="ifnull(CEIL( (SUM(fs.balance/ d.total_units ))*d.unit_cost ),0) AS total";
             break;
         case 'units':
           $computation ="ifnull(CEIL( SUM(fs.balance)),0) AS total" ;
             break;
             case 'packs':
           $computation ="ifnull(CEIL( SUM(fs.balance/ d.total_units ) ),0) AS total" ;
             break;
         default:
               $computation ="ifnull(CEIL( (SUM(fs.balance/ d.total_units ))*d.unit_cost ),0)  AS total" ;
             break;
     endswitch;
	 $string="AND date_format( fs.expiry_date, '%m')=$month" ;
	 $group_by =(($district_id=='all')) ?"GROUP BY month(expiry_date) asc" : null;
	 $group_by .=(($district_id=='facility')) ?"GROUP BY fs.kemsa_code having total>0 " : null;
     $select_option=($district_id=='facility') ?"d.drug_name," : null;
     $select_option .=($district_id=='all')?  "date_format( fs.expiry_date, '%b' ) as cal_month,": null;
	 
     $select_option_special=($district_id=='facility' || $month!="null") ? $string: null;
     
	 
	// echo ;
//exit;
$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("SELECT $select_option $computation
FROM facility_stock fs, facilities f, drug d, counties c, districts di
WHERE fs.facility_code = f.facility_code
AND `expiry_date` <= NOW( )
AND DATE_FORMAT( fs.expiry_date,'%Y') =$year
$select_option_special
AND f.district =di.id
AND di.county=c.id
AND c.id='$county_id'
$and_data
AND d.id = fs.kemsa_code
 $group_by
");
 	
 }

        return  $inserttransaction ;
			
			} 	
            public static function get_county_cost_of_exipries($county_id,$year=null,$district_id=null,$commodity_id=null,$option=null){  	
     //$year=isset($year)? $year: date("Y");
     $and_data =(isset($commodity_id)&& ($commodity_id>0)) ?"AND d.id = '$commodity_id'" : null;
	 $and_data .=(isset($district_id)&& ($district_id>0)) ?"AND di.id = '$district_id'" : null;
     
     switch ($option) :
         case 'ksh':
           $computation ="CEIL( (SUM(fs.balance/ d.total_units ))*d.unit_cost ) AS total";
             break;
         case 'units':
           $computation ="CEIL( SUM(fs.balance)) AS total" ;
             break;
             case 'packs':
           $computation ="CEIL( SUM(fs.balance/ d.total_units ) ) AS total" ;
             break;
         default:
               $computation ="CEIL( (SUM(fs.balance/ d.total_units ))*d.unit_cost )  AS total" ;
             break;
     endswitch;

$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT date_format( fs.expiry_date, '%b' ) as cal_month ,$computation
FROM facility_stock fs, facilities f, drug d, counties c, districts di
WHERE fs.facility_code = f.facility_code
AND `expiry_date` <= NOW( )
AND DATE_FORMAT( fs.expiry_date,'%Y') =$year
AND f.district =di.id
AND di.county=c.id
AND c.id='$county_id'
$and_data
AND d.id = fs.kemsa_code
GROUP BY month(expiry_date) asc");
        return  $inserttransaction ;
			
			} 			
			
public static function get_decom_count($district)
	{
		$query=Doctrine_Query::create()-> 
        select("DISTINCT(facility_stock.facility_code)")->from("facility_stock,facilities,districts")
        ->where("facility_stock.facility_code=facilities.facility_code")->andWhere("facilities.district=districts.id")
		->andWhere("facility_stock.status=2")->andWhere("districts.id=$district");
		$order=$query->execute();
		$order=count($order);
		//echo $order; exit;
		return ($order);
		
	}
	
	////get maufacuture for a given batch no
	
	public static function get_batch_details($batch_no,$kemsa_code){
		$query = Doctrine_Query::create() -> select("*") -> from("Facility_Stock") -> where("kemsa_code='$kemsa_code' and batch_no='$batch_no'")->andwhere("status='1'");
		
		$stocks= $query -> execute();
		$stocks=$stocks->toArray();
		return $stocks[0];
	}
	
		////get maufacuture for a given batch no
	
	public static function get_facility_commodity_stock_balance($kemsa_code,$facility_code){
		$query = Doctrine_Query::create() -> select("sum(balance) as total") -> from("Facility_Stock") -> where("kemsa_code='$kemsa_code' and facility_code='$facility_code'")->andwhere("status='1'");
		
		$stocks= $query -> execute();
		
		$stocks=$stocks[0]->toArray();
		return $stocks;
	}
	
	// get the stocks for a given facility 
	
	public static function get_facility_stock_detail($facility_code){
			$query = Doctrine_Query::create() -> select("*") -> 
			from("facility_stock")->where("facility_code=$facility_code and status='1'")->andwhere("balance>0");
		$stocktake = $query ->execute();
		
		return $stocktake;
	}
	
	public static function get_county_max_date($county_id){
$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT MAX(stock_date) as date_ FROM `facility_stock` f_s, districts d, facilities f WHERE f.facility_code=f_s.`facility_code` and f.district=d.id and d.county=$county_id");
        return  $inserttransaction ;
	}
	
	public static function get_decommisioned_count($county_id=null,$district_id=null){
				
	$condition=isset($district_id)? "d.id" : "d.county";	
	$id=	isset($district_id)?$district_id : $county_id;			
		
	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT ifnull(COUNT(f_s.id),0) AS total
FROM facilities f, facility_stock f_s, districts d
WHERE f.facility_code = f_s.facility_code
AND f.district = d.id
AND $condition =$id
AND f_s.`status` =2
AND DATE_FORMAT( f_s.`expiry_date` ,  '%Y' ) = DATE_FORMAT( NOW( ) ,  '%Y' ) 
GROUP BY $condition");

        return  $inserttransaction ;	
	}
	
}
