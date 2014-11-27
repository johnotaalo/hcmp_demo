<?php
class DP_facility_list extends MY_Controller {

	//required
	function __construct() {
		parent::__construct();
	}


 public function get_facility_list(){
		///page configuration 
		$data['title'] = "Facility List";
		$data['banner_text'] = "Facility List";
		$data['content_view'] = "district/facility_list_v";
		$data['quick_link'] = "facility_list";
		$district=$this -> session -> userdata('district');
		$data['facility_list_arry']=Facilities::get_d_facility($district);
	
		$this -> load -> view("template", $data);
			
	}
 public function actions(){
 	$data['pending_orders'] = Ordertbl::get_pending_o_count($this -> session -> userdata('district'));
	$data['content_view'] = "district/district_home_v";
 	$data['quick_link']="actions";
	$data['banner_text'] = "Actions";
	$data['title'] = "Actions";
	$this -> load -> view("template", $data);
 }
	public function get_facility_stock_details($facility_code){
		$facility_name=Facilities::get_facility_name($facility_code);
		$msg="Stock levels for :".$facility_name['facility_name']." as of ".date("d M, Y");
		$data['msg']=$msg;
		$data['facility_order'] = Facility_Transaction_Table::get_all($facility_code);
		$data['content_view'] = "district/district_report/facility_stock_level_v";
    	$data['quick_link']="actions";
	    $data['banner_text'] = "Stock Level";
	    $data['title'] = "Stock Level ";
	    $this -> load -> view("template", $data);
	}
	
	
}
	
	
	
	?>